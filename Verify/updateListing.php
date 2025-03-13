<?php
session_start();
include "../Connection/db_connect.php";

// Check if the form is submitted
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['business_id'])) {
    $id = intval($_POST['business_id']);
    $name = mysqli_real_escape_string($conn, $_POST['name']);
    $description = mysqli_real_escape_string($conn, $_POST['description']);
    $location = mysqli_real_escape_string($conn, $_POST['location']);

    // ✅ Handle image upload
    if (!empty($_FILES['image']['name'])) {
        $target_dir = "../Resources/BusinessImg/";
        $timestamp = time(); // Add timestamp to avoid caching issues
        $image_name = $timestamp . '_' . basename($_FILES["image"]["name"]);
        $target_file = $target_dir . $image_name;

        // ✅ Step 1: Delete old image from database and filesystem
        $query = "SELECT image_path FROM business_images WHERE business_id = ?";
        $stmt = mysqli_prepare($conn, $query);
        mysqli_stmt_bind_param($stmt, "i", $id);
        mysqli_stmt_execute($stmt);
        $result = mysqli_stmt_get_result($stmt);

        if ($row = mysqli_fetch_assoc($result)) {
            $old_image = $row['image_path'];
            $old_image_path = $target_dir . $old_image;

            if (file_exists($old_image_path)) {
                unlink($old_image_path); // Delete the old file
            }

            // ✅ Delete the old image record from the database
            $delete_query = "DELETE FROM business_images WHERE business_id = ?";
            $delete_stmt = mysqli_prepare($conn, $delete_query);
            mysqli_stmt_bind_param($delete_stmt, "i", $id);
            mysqli_stmt_execute($delete_stmt);
            mysqli_stmt_close($delete_stmt);
        }
        mysqli_stmt_close($stmt);

        // ✅ Step 2: Move uploaded file to target directory
        if (move_uploaded_file($_FILES["image"]["tmp_name"], $target_file)) {
            // ✅ Step 3: Insert new image into database
            $insert_query = "INSERT INTO business_images (business_id, image_path) VALUES (?, ?)";
            $stmt = mysqli_prepare($conn, $insert_query);
            mysqli_stmt_bind_param($stmt, "is", $id, $image_name);

            if (!mysqli_stmt_execute($stmt)) {
                $_SESSION['message'] = "Error updating image: " . mysqli_stmt_error($stmt);
                $_SESSION['message_type'] = "danger";
                header("Location: ../Frames/BusinessDash.php");
                exit();
            }
            mysqli_stmt_close($stmt);
        } else {
            $_SESSION['message'] = "Error uploading image.";
            $_SESSION['message_type'] = "danger";
            header("Location: ../Frames/BusinessDash.php");
            exit();
        }
    }

    // ✅ Update business details
    $query = "UPDATE businesses SET name=?, description=?, location=? WHERE id=?";
    $stmt = mysqli_prepare($conn, $query);
    mysqli_stmt_bind_param($stmt, "sssi", $name, $description, $location, $id);

    if (mysqli_stmt_execute($stmt)) {
        $_SESSION['message'] = "Business listing updated successfully.";
        $_SESSION['message_type'] = "success";
    } else {
        $_SESSION['message'] = "Error updating listing: " . mysqli_error($conn);
        $_SESSION['message_type'] = "danger";
    }

    // ✅ Close connections
    mysqli_stmt_close($stmt);
    mysqli_close($conn);

    // ✅ Redirect
    header("Location: ../Frames/BusinessDash.php");
    exit();
}

// ❌ Invalid access
$_SESSION['message'] = "Invalid request.";
$_SESSION['message_type'] = "danger";
header("Location: ../Frames/BusinessDash.php");
exit();
?>

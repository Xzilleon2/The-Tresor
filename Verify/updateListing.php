<?php
session_start();
include "../Connection/db_connect.php";

// Check if the form is submitted
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['business_id'])) {
    $id = intval($_POST['business_id']); // Convert ID to integer
    $name = mysqli_real_escape_string($conn, $_POST['name']);
    $description = mysqli_real_escape_string($conn, $_POST['description']);
    $location = mysqli_real_escape_string($conn, $_POST['location']);
    
    // Handle image upload
    $image_path = null;
    if (!empty($_FILES['image']['name'])) {
        $target_dir = "../Resources/BusinessImg/";
        $image_name = basename($_FILES["image"]["name"]);
        $target_file = $target_dir . $image_name;

        // Move uploaded file
        if (move_uploaded_file($_FILES["image"]["tmp_name"], $target_file)) {
            $image_path = $image_name;
        } else {
            $_SESSION['message'] = "Error uploading image.";
            $_SESSION['message_type'] = "danger";
            header("Location: ../Frames/BusinessDash.php");
            exit();
        }
    }

    // SQL query to update listing
    if ($image_path) {
        $query = "UPDATE businesses SET name=?, description=?, location=?, image_path=? WHERE id=?";
        $stmt = mysqli_prepare($conn, $query);
        mysqli_stmt_bind_param($stmt, "ssssi", $name, $description, $location, $image_path, $id);
    } else {
        $query = "UPDATE businesses SET name=?, description=?, location=? WHERE id=?";
        $stmt = mysqli_prepare($conn, $query);
        mysqli_stmt_bind_param($stmt, "sssi", $name, $description, $location, $id);
    }

    // Execute query and handle errors
    if (mysqli_stmt_execute($stmt)) {
        $_SESSION['message'] = "Business listing updated successfully.";
        $_SESSION['message_type'] = "success";
    } else {
        $_SESSION['message'] = "Error updating listing: " . mysqli_error($conn);
        $_SESSION['message_type'] = "danger";
    }

    // Close connections
    mysqli_stmt_close($stmt);
    mysqli_close($conn);

    // Redirect
    header("Location: ../Frames/BusinessDash.php");
    exit();
}

// Invalid access
$_SESSION['message'] = "Invalid request.";
$_SESSION['message_type'] = "danger";
header("Location: ../Frames/BusinessDash.php");
exit();
?>

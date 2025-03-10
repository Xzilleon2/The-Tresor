<?php
session_start(); // Start the session
include("../Connection/db_connect.php");

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $id = $_POST['id'];
    $name = $_POST['name'];
    $description = $_POST['description'];
    $location = $_POST['location'];

    // Insert into the `businesses` table
    $query = "INSERT INTO businesses (owner_id, name, description, location) VALUES (?, ?, ?, ?)";
    $stmt = $conn->prepare($query);
    $stmt->bind_param("isss", $id, $name, $description, $location);

    if ($stmt->execute()) {
        $business_id = $stmt->insert_id; // Get the last inserted ID

        // Check if a file is being uploaded
        if (!empty($_FILES['image']['name'])) {
            $target_dir = "../Resources/BusinessImg/";
            $file_name = basename($_FILES["image"]["name"]);
            $target_file = $target_dir . $file_name;
            $imageFileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));

            if (in_array($imageFileType, ["jpg", "jpeg", "png"])) {
                if (move_uploaded_file($_FILES['image']["tmp_name"], $target_file)) {
                    $Business_image = $file_name;

                    // Upload the image to the database
                    $Query = "INSERT INTO business_images (business_id, image_path) VALUES (?, ?)";
                    $img_stmt = $conn->prepare($Query);
                    $img_stmt->bind_param("is", $business_id, $Business_image);
                    $img_stmt->execute();
                } else {
                    $_SESSION['message'] = "Error uploading image.";
                    $_SESSION['message_type'] = "danger";
                    header('Location: ../Frames/BusinessDash.php');
                    exit();
                }
            } else {
                $_SESSION['message'] = "Unsupported image type. Allowed: JPG, JPEG, PNG.";
                $_SESSION['message_type'] = "warning";
                header('Location: ../Frames/BusinessDash.php');
                exit();
            }
        } else {
            // If no image is uploaded, set a default image
            $Business_image = "images.png";
        }

        $_SESSION['message'] = "Business listed successfully.";
        $_SESSION['message_type'] = "success";
        header('Location: ../Frames/BusinessDash.php');
        exit();
    } else {
        $_SESSION['message'] = "Error listing business: " . $stmt->error;
        $_SESSION['message_type'] = "danger";
        header('Location: ../Frames/BusinessDash.php');
        exit();
    }
}

// Handle invalid request
$_SESSION['message'] = "Invalid request.";
$_SESSION['message_type'] = "danger";
header('Location: ../Frames/BusinessDash.php');
exit();
?>

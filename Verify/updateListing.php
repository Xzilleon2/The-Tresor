<?php
include("../Connection/db_connect.php");

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $id = $_POST['id'];
    $name = $_POST['name'];
    $description = $_POST['description'];
    $location = $_POST['location'];

    // Update the `businesses` table
    $query = "UPDATE businesses SET name = ?, description = ?, location = ? WHERE owner_id = ? ";
    $stmt = $conn->prepare($query);
    $stmt->bind_param("sssi", $name, $description, $location, $id);

    if ($stmt->execute()) {
        $business_id = $stmt->insert_id; // Get the last inserted ID

        //Check if a file is being uploaded or got existing file
        if (!empty($_FILES['image']['name'])) {
            $target_dir = "../Resources/BusinessImg/";
            $file_name = basename($_FILES["image"]["name"]);
            $target_file = $target_dir . $file_name;
            $imageFileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));
        
            if (in_array($imageFileType, ["jpg", "jpeg", "png"])) {
                if (move_uploaded_file($_FILES['image']["tmp_name"], $target_file)) {
                    $Business_image =  $file_name;

                    //Upload the Image to Database
                    $Query = "UPDATE business_images SET image_path = ? WHERE business_id = ? ";
                    $img_stmt = $conn->prepare($Query);
                    $img_stmt->bind_param("si", $business_id, $Business_image);
                    $img_stmt->execute();

                } else {
                    echo "<script>alert('Error in Uploading')</script>";
                }
            } else {
                echo "<script>alert('Not Supported Type')</script>";
            }
        } else {
            // If no image is uploaded, keep the existing one or set a default image
            $Business_image = "../Resources/BusinessImg/images.png"; 
        }

        echo "<script>alert('Listed Successfully');</script>";
        header('Location: ../Frames/BusinessDash.php');
        exit();
        
    } else {
        echo "Error: " . $stmt->error;
    }
}
?>

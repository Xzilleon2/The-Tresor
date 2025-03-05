<?php
include("../Connection/db_connect.php");

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $id = $_POST['id'];
    $name = $_POST['name'];
    $description = $_POST['description'];
    $location = $_POST['location'];

    // Insert into the `businesses` table
    $query = "INSERT INTO businesses (owner_id,name, description, location) VALUES (?, ?, ?, ?)";
    $stmt = $conn->prepare($query);
    $stmt->bind_param("isss", $id, $name, $description, $location);

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
                    $Query = "INSERT INTO business_images (business_id, image_path) VALUES (?, ?)";
                    $img_stmt = $conn->prepare($Query);
                    $img_stmt->bind_param("is", $business_id, $Business_image);
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

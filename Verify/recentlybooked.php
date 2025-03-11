<?php
include ("../Connection/db_connect.php");

//Storing the User ID From SESSION
$user_id = $_SESSION['id'];

// Fetch the most recent bookings with a business image
$query = "SELECT b.id AS business_id, 
                b.name AS business_name, 
                b.description, 
                b.location, 
                bk.booking_date,
                bk.CheckOut_Date,
                bk.Persons,
                bk.status, 
                (SELECT bi.image_path FROM business_images bi 
                 WHERE bi.business_id = b.id 
                 ORDER BY bi.uploaded_at DESC LIMIT 1) AS image_path
           FROM bookings bk
           JOIN businesses b ON bk.business_id = b.id
           WHERE bk.user_id = ?
           ORDER BY bk.booking_date DESC";

$stmt = $conn->prepare($query);
$stmt->bind_param("i", $user_id);
$stmt->execute();
$result = $stmt->get_result();
?>

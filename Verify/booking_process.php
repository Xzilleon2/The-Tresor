<?php
session_start();
include("../Connection/db_connect.php");

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $business_id = $_POST['business_id'];
    $user_id = $_SESSION['id'];
    $booking_date = $_POST['booking_date'];
    $booking_status = "Pending";

    $query = "INSERT INTO bookings ( user_id, business_id, booking_date, status) VALUES (?, ?, ?, ?)";
    $stmt = $conn->prepare($query);
    $stmt->bind_param("iiss", $user_id, $business_id, $booking_date, $booking_status);
    
    if ($stmt->execute()) {
        header ('Location:../Frames/Dashboard.php');
        exit();
    } else {
        echo "Error: " . $conn->error;
    }
}
?>

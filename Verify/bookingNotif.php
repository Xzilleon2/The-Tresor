<?php 
include ("../Connection/db_connect.php");

//Retrieving the booking data from the database
$query = "SELECT 
            b.id AS booking_id, 
            bs.id AS business_id, 
            bs.name AS business_name, 
            u.email AS user_email, 
            b.booking_date AS booking_date, 
            b.status AS booking_status
          FROM bookings b
          JOIN businesses bs ON b.business_id = bs.id
          JOIN users u ON b.user_id = u.id";

$result_bookingnotif = mysqli_query($conn, $query);
?>
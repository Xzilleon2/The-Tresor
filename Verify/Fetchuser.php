<?php 
include ("../Connection/db_connect.php");

$query = "SELECT id, fname, lname, email, role FROM users";
$result = mysqli_query($conn, $query);
?>
<?php 
include ("../Connection/db_connect.php");

$query = "SELECT list_title, list_price, list_description, list_location FROM listings";
$result = mysqli_query($conn, $query);
?>
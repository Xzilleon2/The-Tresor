<?php 
include ("../Connection/db_connect.php");

$query = "SELECT name, description, location FROM businesses";
$result = mysqli_query($conn, $query);
?>
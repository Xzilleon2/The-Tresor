<?php 
include ("../Connection/db_connect.php");

$query = "SELECT usr_id, usr_FirstName, usr_LastName, usr_email, usr_contactNum FROM users";
$result = mysqli_query($conn, $query);
?>
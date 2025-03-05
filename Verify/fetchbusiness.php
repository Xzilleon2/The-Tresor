<?php 
include ("../Connection/db_connect.php");

$query = "SELECT b.id, b.name, b.description, b.location, bi.image_path
          FROM businesses b
          LEFT JOIN business_images bi ON b.id = bi.business_id"; 

$result = mysqli_query($conn, $query);
?>
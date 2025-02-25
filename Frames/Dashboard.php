<?php 
session_start();
include("../Connection/db_connect.php");

// Check if user is logged in
if (!isset($_SESSION['email']) && !isset($_SESSION['password'])) {
    header("Location: ../index.php"); // Redirect to login if session is empty
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <H1>THIS IS THE DASHBOARD!!</H1>
</body>
</html>
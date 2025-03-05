<?php
// update_user.php

// Include the database connection
include "../Connection/db_connect.php";

// Start session for notifications
session_start();

// Check if the form is submitted via POST
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Get form data
    $id = $_POST['id'];
    $firstname = $_POST['fname'];
    $lastname = $_POST['lname'];
    $email = $_POST['email'];
    $role = $_POST['role'];

    // SQL query to update the user record
    $query = "UPDATE users SET fname = ?, lname = ?, email = ?, role = ? WHERE id = ?";

    // Prepare the statement
    $stmt = mysqli_prepare($conn, $query);

    // Bind the parameters (sssi means: string, string, string, integer)
    mysqli_stmt_bind_param($stmt, "ssssi", $firstname, $lastname, $email, $role, $id);
    mysqli_stmt_execute($stmt);

    // Close the statement
    mysqli_stmt_close($stmt);

    // Redirect back to the dashboard or the users list page
    header('Location: ../Frames/adminDashboard.php');
    exit();
}
?>

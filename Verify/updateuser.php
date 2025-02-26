<?php
// update_user.php

// Include the database connection
include "../Connection/db_connect.php";

// Start session for notifications
session_start();

// Check if the form is submitted via POST
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Get form data
    $id = $_POST['usr_id'];
    $firstname = $_POST['usr_FirstName'];
    $lastname = $_POST['usr_LastName'];
    $email = $_POST['usr_email'];
    $contactNum = $_POST['usr_contactNum'];

    // SQL query to update the user record
    $query = "UPDATE users SET usr_FirstName = ?, usr_LastName = ?, usr_email = ?, usr_contactNum = ? WHERE usr_id = ?";

    // Prepare the statement
    $stmt = mysqli_prepare($conn, $query);

    // Bind the parameters (sssi means: string, string, string, integer)
    mysqli_stmt_bind_param($stmt, "ssssi", $firstname, $lastname, $email, $contactNum, $id);
    mysqli_stmt_execute($stmt);
    /*
    // Execute the query
    if (mysqli_stmt_execute($stmt)) {
        // Set success message in session
        $_SESSION['notification'] = [
            'type' => 'success', // 'success' for success message
            'message' => 'User updated successfully!' // Success message
        ];
    } else {
        // Set error message in session
        $_SESSION['notification'] = [
            'type' => 'danger', // 'danger' for error message
            'message' => 'Error updating user: ' . mysqli_error($conn) // Error message with specific MySQL error
        ];
    }
    */
    // Close the statement
    mysqli_stmt_close($stmt);

    // Redirect back to the dashboard or the users list page
    header('Location: ../Frames/Dashboard.php');
    exit();
}
?>

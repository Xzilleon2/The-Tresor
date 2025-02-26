<?php
// delete_user.php

// Include database connection
include "../Connection/db_connect.php";

// Check if the form is submitted via POST
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Get the user ID to delete
    $id = $_POST['usr_id'];

    // SQL query to delete the user
    $query = "DELETE FROM users WHERE usr_id = ?";

    // Prepare the statement
    $stmt = mysqli_prepare($conn, $query);

    // Bind the parameter to the SQL query (i = integer)
    mysqli_stmt_bind_param($stmt, "i", $id);
    mysqli_stmt_execute($stmt);
    /*
    if (mysqli_stmt_execute($stmt)) {
        // Set success message
        $_SESSION['notification'] = [
            'type' => 'success',
            'message' => 'User deleted successfully!'
        ];
    } else {
        // Set error message
        $_SESSION['notification'] = [
            'type' => 'danger',
            'message' => 'Error deleting record: ' . mysqli_error($conn)
        ];
    }
    */
    // Close the statement
    mysqli_stmt_close($stmt);

    // Redirect back to the dashboard
    header('Location: ../Frames/Dashboard.php');
    exit();
}
?>
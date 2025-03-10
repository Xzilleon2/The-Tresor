<?php
session_start(); // Start the session

// Include database connection
include "../Connection/db_connect.php";

// Check if the form is submitted via POST and booking_id is set
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['booking_id'])) {
    // Get the booking ID
    $id = intval($_POST['booking_id']); // Ensure it's an integer
    $status = "Approved";

    // SQL query to update the status of a booking
    $query = "UPDATE bookings SET status = ? WHERE id = ?";

    // Prepare the statement
    if ($stmt = mysqli_prepare($conn, $query)) {
        // Bind parameters (string, integer)
        mysqli_stmt_bind_param($stmt, "si", $status, $id);

        // Execute the statement
        if (mysqli_stmt_execute($stmt)) {
            $_SESSION['message'] = "Booking approved successfully.";
            $_SESSION['message_type'] = "success";
        } else {
            $_SESSION['message'] = "Error approving booking: " . mysqli_error($conn);
            $_SESSION['message_type'] = "danger";
        }

        // Close the statement
        mysqli_stmt_close($stmt);
    } else {
        $_SESSION['message'] = "Database error: Unable to prepare statement.";
        $_SESSION['message_type'] = "danger";
    }

    // Close the database connection
    mysqli_close($conn);

    // Redirect back to the dashboard
    header('Location: ../Frames/BusinessDash.php');
    exit();
}

// Handle invalid access (not a POST request or missing ID)
$_SESSION['message'] = "Invalid request.";
$_SESSION['message_type'] = "danger";
header('Location: ../Frames/BusinessDash.php');
exit();
?>

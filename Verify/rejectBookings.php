<?php
// Start the session
session_start();

// Include database connection
include "../Connection/db_connect.php";

// Check if the form is submitted via POST
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['booking_id'])) {
    $id = $_POST['booking_id'];
    $status = "Rejected";

    // SQL query to update the status of a booking
    $query = "UPDATE bookings SET status = ? WHERE id = ?";

    // Prepare the statement
    $stmt = mysqli_prepare($conn, $query);

    if ($stmt) {
        // Bind the parameter to the SQL query
        mysqli_stmt_bind_param($stmt, "si", $status, $id);
        
        // Execute and set session message
        if (mysqli_stmt_execute($stmt)) {
            $_SESSION['message'] = "Booking rejected.";
            $_SESSION['message_type'] = "warning";
        } else {
            $_SESSION['message'] = "Error rejecting booking: " . mysqli_error($conn);
            $_SESSION['message_type'] = "danger";
        }

        mysqli_stmt_close($stmt);
    } else {
        $_SESSION['message'] = "Database error: Unable to prepare statement.";
        $_SESSION['message_type'] = "danger";
    }

    mysqli_close($conn);

    // Redirect back to the dashboard
    header('Location: ../Frames/BusinessDash.php');
    exit();
} else {
    $_SESSION['message'] = "Invalid request.";
    $_SESSION['message_type'] = "danger";
    header('Location: ../Frames/BusinessDash.php');
    exit();
}
?>

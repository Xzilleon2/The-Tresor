<?php
session_start(); // Start the session to use session variables
include("../Connection/db_connect.php"); // Include database connection file

// Check if the form was submitted using the POST method
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Retrieve form data from POST request
    $business_id = $_POST['business_id'];
    $user_id = $_SESSION['id']; // Get the logged-in user's ID from the session
    $booking_date = $_POST['booking_date'];
    $booking_status = "Pending"; // Default status for a new booking

    // Convert the date to MySQL's YYYY-MM-DD format to ensure proper storage
    $formatted_date = date('Y-m-d', strtotime($booking_date));

    // Prepare an SQL query to insert the booking details into the database
    $query = "INSERT INTO bookings (user_id, business_id, booking_date, status) VALUES (?, ?, ?, ?)";
    $stmt = $conn->prepare($query);

    if ($stmt) { // Check if the statement was prepared successfully
        $stmt->bind_param("iiss", $user_id, $business_id, $formatted_date, $booking_status); // Bind parameters to prevent SQL injection

        // Execute the prepared statement
        if ($stmt->execute()) {
            // Store a success message in the session to display on the dashboard
            $_SESSION['message'] = "Booking request sent successfully!";
            $_SESSION['message_type'] = "success";
        } else {
            // Store an error message in case of execution failure
            $_SESSION['message'] = "Error processing booking: " . $stmt->error;
            $_SESSION['message_type'] = "error";
        }

        $stmt->close(); // Close the prepared statement
    } else {
        // Store an error message if statement preparation failed
        $_SESSION['message'] = "Database error: " . $conn->error;
        $_SESSION['message_type'] = "error";
    }

    $conn->close(); // Close the database connection

    // Redirect the user back to the dashboard after processing the request
    header("Location: ../Frames/Dashboard.php");
    exit();
}
?>

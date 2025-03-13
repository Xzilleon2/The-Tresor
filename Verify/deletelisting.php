<?php
session_start(); // Start the session
include "../Connection/db_connect.php"; // Include database connection

// Check if the form is submitted via POST
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Get the user ID and business name from the form
    if (isset($_POST['id'], $_POST['name'])) {
        $id = $_POST['id'];
        $businessName = $_POST['name'];

        // SQL query to delete the business
        $query = "DELETE FROM businesses WHERE owner_id = ? AND name = ?";

        // Prepare the statement
        $stmt = $conn->prepare($query);

        if ($stmt) {
            // Bind parameters to the prepared statement
            $stmt->bind_param("is", $id, $businessName);

            // Execute the statement
            if ($stmt->execute()) {
                // ✅ Successfully deleted, set success message
                $_SESSION['message'] = "Business deleted successfully.";
                $_SESSION['message_type'] = "success";
                header('Location: ../Frames/BusinessDash.php');
                exit();
            } else {
                // ❌ Failed to delete, set error message
                $_SESSION['message'] = "Error deleting business: " . $stmt->error;
                $_SESSION['message_type'] = "danger";
                header('Location: ../Frames/BusinessDash.php');
                exit();
            }

            // Close the statement
            $stmt->close();
        } else {
            // ❌ Error preparing the statement
            $_SESSION['message'] = "SQL Prepare Error: " . $conn->error;
            $_SESSION['message_type'] = "danger";
            header('Location: ../Frames/BusinessDash.php');
            exit();
        }
    } else {
        // ❌ Missing required fields
        $_SESSION['message'] = "Error: Missing required fields.";
        $_SESSION['message_type'] = "warning";
        header('Location: ../Frames/BusinessDash.php');
        exit();
    }
} else {
    // ❌ Invalid request method
    $_SESSION['message'] = "Invalid request.";
    $_SESSION['message_type'] = "danger";
    header('Location: ../Frames/BusinessDash.php');
    exit();
}

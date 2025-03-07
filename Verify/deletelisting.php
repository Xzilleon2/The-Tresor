<?php
include "../Connection/db_connect.php";

// Check if the form is submitted via POST
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Get the user ID and business name from the form
    if (isset($_POST['id'], $_POST['name'])) {
        $id = $_POST['id'];
        $businessName = $_POST['name'];

        // SQL query to delete the business
        $query = "DELETE FROM businesses WHERE owner_id = ? AND name = ?";

        // Prepare the statement
        if ($stmt = mysqli_prepare($conn, $query)) {
            // Bind parameters
            mysqli_stmt_bind_param($stmt, "is", $id, $businessName);

            // Execute the statement
            if (mysqli_stmt_execute($stmt)) {
                // ✅ Successfully deleted, redirect to dashboard
                header('Location: ../Frames/Dashboard.php');
                exit();
            } else {
                echo "Error deleting business: " . mysqli_error($conn); // Debugging
            }

            // Close the statement
            mysqli_stmt_close($stmt);
        } else {
            echo "SQL Prepare Error: " . mysqli_error($conn); // Debugging
        }
    } else {
        echo "Error: Missing required fields.";
    }
} else {
    echo "Invalid request.";
}
?>

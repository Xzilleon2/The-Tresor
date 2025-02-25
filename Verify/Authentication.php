<?php 
session_start();
include 'Connection/db_connect.php';

// Redirect user if already logged in
if(isset($_SESSION['username'])){
    header("Location: Frames/Homepage.php");
    exit();
}

// Handles Login
if($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['login'])){
    $username = $_POST['username'];
    $password = $_POST['password'];

    // QUERY
    $Query = "SELECT * FROM users WHERE usr_name = ?";
    $stmt = $conn->prepare($Query);

    if($stmt === false){
        die("Error preparing statement: " . $conn->error);
    }

    $stmt->bind_param("s", $username);
    $stmt->execute();
    $result = $stmt->get_result();

    if($result->num_rows > 0){
        $row = $result->fetch_assoc();
            $_SESSION['username'] = $username;
            header('Location: Frames/Homepage.php');
            exit();
    } else {
        echo "<script>alert('Invalid username or password');</script>";
    }
}
?>

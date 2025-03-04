<?php 
session_start();
include 'Connection/db_connect.php';

// Redirect user if already logged in
if(isset($_SESSION['email']) && isset($_SESSION['password'])){
    header("Location: Frames/Homepage.php");
    exit();
}

// Handles Login
if($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['login'])){
    $email = $_POST['email'];
    $password = $_POST['password'];

    // QUERY
    $Query = "SELECT * FROM users WHERE email = ?";
    $stmt = $conn->prepare($Query);

    if($stmt === false){
        die("Error preparing statement: " . $conn->error);
    }

    $stmt->bind_param("s", $email);
    $stmt->execute();
    $result = $stmt->get_result();

    if($result->num_rows > 0){
        $row = $result->fetch_assoc();

            if(password_verify($password, $row['password'])){
                $_SESSION['email'] = $row['email'];
                $_SESSION['role'] = $row['role'] ;
                
                if($_SESSION['role'] == "admin"){
                    header('Location: Frames/adminDashboard.php');
                    exit();
                } elseif($_SESSION['role'] == "owner"){ 
                    header('Location: Frames/BusinessDash.php');
                    exit();
                } elseif($_SESSION['role'] == "user"){
                    header('Location: Frames/Homepage.php');
                    exit();
                } else {
                    echo "<script>alert('Error in finding role');</script>";
                }
            } 
    } else {
        echo "<script>alert('Invalid username or password');</script>";
    }
}

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['register'])){
    $firstname = $_POST['fname'];
    $lastname = $_POST['lname'];
    $password = $_POST['password'];
    $email = $_POST['email'];
    $role = "user";

    $hashed_password = password_hash($password, PASSWORD_DEFAULT);

    $query = 'INSERT INTO users(fname, lname, email, password, role) VALUES (?,?,?,?,?)';
    $stmt = $conn->prepare($query);

    if($stmt === false){
        die("Error Preparing Statement".$conn->error);
    }

    $stmt->bind_param("sssss", $firstname, $lastname, $email, $hashed_password, $role);
    $stmt ->execute();

    if($stmt->affected_rows > 0){
        echo "<script>alert('Registration Complete');</script>";
    } else{
        echo "<script>alert('Error, Please try again');</script>";
    }
}
?>

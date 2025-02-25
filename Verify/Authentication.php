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
    $Query = "SELECT * FROM users WHERE usr_email = ?";
    $stmt = $conn->prepare($Query);

    if($stmt === false){
        die("Error preparing statement: " . $conn->error);
    }

    $stmt->bind_param("s", $email);
    $stmt->execute();
    $result = $stmt->get_result();

    if($result->num_rows > 0){
        $row = $result->fetch_assoc();

            if(password_verify($password, $row['usr_password'])){
                $_SESSION['email'] = $email;
                header('Location: Frames/Homepage.php');
                exit();
            }
    } else {
        echo "<script>alert('Invalid username or password');</script>";
    }
}

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['register'])){
    $firstname = $_POST['Fname'];
    $Lastname = $_POST['Lname'];
    $password = $_POST['password'];
    $email = $_POST['email'];
    $contactnumber = $_POST['contactNum'];
    $role = $_POST['role'];

    $hashed_password = password_hash($password, PASSWORD_DEFAULT);

    $query = 'INSERT INTO users(usr_FirstName, usr_LastName, usr_password, usr_email, usr_contactNum ,usr_role) VALUES (?,?,?,?,?,?)';
    $stmt = $conn->prepare($query);

    if($stmt === false){
        die("Error Preparing Statement".$conn->error);
    }

    $stmt->bind_param("ssssss", $firstname, $Lastname, $hashed_password, $email, $contactnumber, $role);
    $stmt ->execute();

    if($stmt->affected_rows > 0){
        echo "<script>alert('Registration Complete');</script>";
    } else{
        echo "<script>alert('Error, Please try again');</script>";
    }
}
?>

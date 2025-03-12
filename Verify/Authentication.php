<?php 
session_start();
include ('../Connection/db_connect.php');

// Redirect user if already logged in to avoid multiple logins
if(isset($_SESSION['email']) && isset($_SESSION['password'])){
    header("Location: Frames/Homepage.php");
    exit();
}

// Handle Login Request
if($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['login'])){
    $email = $_POST['email'];
    $password = $_POST['password'];

    // Prepare SQL query to select user by email
    $Query = "SELECT * FROM users WHERE email = ?";
    $stmt = $conn->prepare($Query);

    if($stmt === false){
        die("Error preparing statement: " . $conn->error);
    }

    $stmt->bind_param("s", $email);
    $stmt->execute();
    $result = $stmt->get_result();

    // Check if the user exists in the database
    if($result->num_rows > 0){
        $row = $result->fetch_assoc();

        // Verify the provided password with the hashed password from the database
        if(password_verify($password, $row['password'])){
            $_SESSION['email'] = $row['email'];
            $_SESSION['id'] = $row['id'];
            $_SESSION['role'] = $row['role'];

            // Redirect user based on their role after showing an alert
            if($_SESSION['role'] == 'admin'){
                echo "<script>
                    alert('Login Success');
                    window.location.href = '../Frames/adminDashboard.php';
                </script>";
                exit();
            } elseif($_SESSION['role'] == 'owner'){ 
                echo "<script>
                    alert('Login Success');
                    window.location.href = '../Frames/BusinessDash.php';
                </script>";
                exit();
            } elseif($_SESSION['role'] == 'user'){
                echo "<script>
                    alert('Login Success');
                    window.location.href = '../Frames/Homepage.php';
                </script>";
                exit();
            } else {
                echo "<script>
                    alert('Error in finding role');
                    window.location.href = '../index.php';
                </script>";
                exit();
            }
        }
    } else {
        // If no user is found or incorrect password
        echo "<script>
            alert('Invalid username or password');
            window.location.href = '../index.php';
        </script>";
        exit();
    }
}

// Handle Registration Request
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['register'])){
    $firstname = $_POST['fname'];
    $lastname = $_POST['lname'];
    $password = $_POST['password'];
    $email = $_POST['email'];
    $role = "user";

    // Hash the password before storing it
    $hashed_password = password_hash($password, PASSWORD_DEFAULT);

    // Prepare SQL query to insert new user data into the database
    $query = 'INSERT INTO users(fname, lname, email, password, role) VALUES (?,?,?,?,?)';
    $stmt = $conn->prepare($query);

    if($stmt === false){
        die("Error Preparing Statement".$conn->error);
    }

    $stmt->bind_param("sssss", $firstname, $lastname, $email, $hashed_password, $role);
    $stmt->execute();

    // Check if the insertion was successful
    if($stmt->affected_rows > 0){
        echo "<script>
            alert('Registration Complete');
            window.location.href = '../index.php';
        </script>";
        exit();
    } else{
        echo "<script>
            alert('Error, Please try again');
            window.location.href = '../index.php';
        </script>";
        exit();
    }
}
?>

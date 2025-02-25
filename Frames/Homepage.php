<?php
session_start();
include('../Connection/db_connect.php');
// Check if user is logged in
if (!isset($_SESSION['email']) && !isset($_SESSION['password'])) {
    header("Location: ../index.php"); // Redirect to login if session is empty
    exit();
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>HOMEPAGE</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" 
    rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;700&display=swap" rel="stylesheet">

</head>
<body>
    <!-- Navbar -->
    <nav class="navbar navbar-expand-lg navbar-light bg-dark bg-opacity-25 fixed-top">
        <div class="container">
            <!-- Brand and Toggler -->
            <a class="navbar-brand text-dark" href="#">
                <img src="../Resources/Tresor.png" alt="" style="height: 100px; width: 130px;">
            </a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
                <span class="navbar-toggler-icon"></span>
            </button>

            <!-- Collapsible Menu -->
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav mx-auto text-center">
                <li class="nav-item mx-2"><a class="nav-link text-white" href="../Verify/Logout.php">Logout</a></li>
                    <li class="nav-item mx-2"><a class="nav-link text-white" href="#Services">Services</a></li>
                    <li class="nav-item mx-2"><a class="nav-link text-white" href="#Rooms">Rooms</a></li>
                    <li class="nav-item mx-2"><a class="nav-link text-white" href="#About">About</a></li>
                    <li class="nav-item mx-2"><a class="nav-link text-white" href="#Contact">Contact</a></li>
                </ul> 
                <!-- BOOK NOW button -->
                <button class="btn bg-transparent text-light btn-outline-light" data-bs-toggle="modal"
                data-bs-target="#LoginVerify">BOOK NOW</button>
                
            </div>
        </div>
    </nav>

        <!-- Bootstrap Script -->
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>

</body>
</html>
<?php
session_start();
include('../Connection/db_connect.php');
include('../Verify/fetchlistingdata.php');

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
    <nav class="navbar navbar-expand-lg navbar-light bg-dark bg-opacity-25 d-flex justify-content-center">
        <div class="container p-0 m-0">
            <!-- Brand and Toggler -->
            <a class="navbar-brand text-dark" href="#">
                <img src="../Resources/Tresor.png" alt="" style="height: 70px; width: 80px;">
            </a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
                <span class="navbar-toggler-icon"></span>
            </button>

            <!-- Collapsible Menu -->
            <div class="collapse navbar-collapse d-flex text-center" id="navbarNav">
                <ul class="navbar-nav mx-auto text-center px-5">
                    <li class="nav-item mx-2"><a class="nav-link text-white" href="#Services">HOME</a></li>
                    <li class="nav-item mx-2"><a class="nav-link text-white" href="#Rooms">Rooms</a></li>
                    <li class="nav-item mx-2"><a class="nav-link text-white" href="#About">About</a></li>
                    <li class="nav-item mx-2"><a class="nav-link text-white" href="#Contact">Contact</a></li>
                </ul> 
                <ul class="navbar-nav">
                        <li class="nav-item"><a class="nav-link text-white text-decoration-none"
                         href="Dashboard.php"><?php echo $_SESSION['email'] ?></a></li> <br>
                         <li class="nav-item"><a class="nav-link text-white" href="../Verify/Logout.php">Logout</a></li>
                </ul>
            </div>
        </div>
    </nav>
    <!--Product Section-->
    <div class="container-fluid bg-light d-flex align-items-end justify-content-center p-3" style="height: 100vh;">
        <div class="container-fluid h-75" style="width: 100%; overflow-y: scroll; scrollbar-width: none;">
            <div class="row">
            <?php while($row = mysqli_fetch_assoc($result)) { ?>
                <div class="card d-flex flex-column align-items-center justify-content-center
                border border-dark w-25 m-3 p-5 shadow-md">
                        <h3><?= $row['list_title'] ?></h3>
                        <p><?= $row['list_price'] ?></p>
                        <p><?= $row['list_description'] ?></P>
                        <p><?= $row['list_location'] ?></p>
                </div>
            <?php }?>
            </div>
        </div>
    </div>

    <!-- Bootstrap Script -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>

</body>
</html>
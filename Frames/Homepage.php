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
    <style>
        body{
            background: url(../Resources/Back.jpg) cover;
        }
        body p{
            font-family: 'Roboto', san-serif;
        }
        body h1{
            font-family: 'Analogue', san-serif;
        }
        body a{
            text-decoration: none;
            color: white;
        }
        body a:hover{
            text-decoration: underline;
        }
    </style>

</head>
<body>
    <!-- Navbar -->
    <nav class="navbar navbar-expand-lg navbar-light d-flex justify-content-center" style="background-color: #405751;">
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
                    <li class="nav-item mx-2"><a class="nav-link text-white" href="#Services">Home</a></li>
                    <li class="nav-item mx-2"><a class="nav-link text-white" href="#Rooms">Rooms</a></li>
                    <li class="nav-item mx-2"><a class="nav-link text-white" href="#About">About</a></li>
                    <li class="nav-item mx-2"><a class="nav-link text-white" href="#Contact">Contact</a></li>
                </ul> 
                <ul class="navbar-nav">
                    <li class="nav-item"><a class="nav-link text-white text-decoration-none"
                    href="Dashboard.php"><?php echo $_SESSION['email'] ?></a></li> <br>
                </ul>
            </div>
        </div>
    </nav>
    <!--Icons and search Panels-->
    <div class="container-fluid">
        <div class="row my-4">
            <div class="container-fluid d-flex justify-content-end">
                <form action="">
                    <input class="form-control border-dark rounded-pill text-dark px-4" type="text" name="search" placeholder="Search">
                </form>
            </div>
        </div>
    </div>
    <!--Product Section-->
    <div class="container-fluid d-flex align-items-center justify-content-center" style="height: 100vh;">
        <div class="container-fluid h-75" style="width: 100%;">
            <div class="d-flex flex-wrap gap-2 bg-dark bg-opacity-25">
                <?php while($row = mysqli_fetch_assoc($result)) { ?>
                    <a href="Dashboard.php" class="text-decoration-none text-dark m-5 w-25">
                        <div class="card d-flex flex-column justify-content-center border border-dark p-3 shadow-md">
                            <h1><?= $row['list_title'] ?></h1>
                            <p><?= $row['list_description'] ?></p>
                            <p><?= $row['list_location'] ?></p>
                            <p><?= $row['list_price'] ?></p>
                        </div>
                    </a>
                <?php } ?>
            </div>
        </div>
    </div>

    <!-- Bootstrap Script -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>

</body>
</html>
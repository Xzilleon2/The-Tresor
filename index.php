<?php 
include("Connection/db_connect.php");
include("Verify/Login.php");

// Check if user is logged in and redirect to a frame base on the role
if (isset($_SESSION['email']) && isset($_SESSION['password'])) {
    if($_SESSION['role'] == 'admin'){
        header("Location: Frames/adminDashboard.php");
        exit();
    } elseif($_SESSION['role'] == 'owner') {
        header("Location: Frames/BusinessDash.php");
        exit();
    } else {
        header("Location: Frames/Homepage.php");
        exit();
    }
}

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>The Tresor</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" 
    rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-icons/1.11.3/font/bootstrap-icons.min.css">
    <link rel="stylesheet" href="./Resources/styles/Style.css">
</head>
<body>
    <!-- Navbar -->
    <nav class="navbar navbar-expand-lg navbar-light bg-dark bg-opacity-25 fixed-top">
        <div class="container">
            <!-- logo -->
            <a class="navbar-brand text-light" href="#" id="Logo">
                <h3>Stay <span id="stayscan">Scan</span></h3>
            </a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
                <span class="navbar-toggler-icon"></span>
            </button>

            <!-- Collapsible Menu -->
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav mx-auto text-center">
                    <li class="nav-item mx-2"><a class="nav-link text-white" href="#">Home</a></li>
                    <li class="nav-item mx-2"><a class="nav-link text-white" href="#featured">Room</a></li>
                    <li class="nav-item mx-2"><a class="nav-link text-white" href="#About">About</a></li>
                    <li class="nav-item mx-2"><a class="nav-link text-white" href="#Contact">Contact</a></li>
                </ul> 
                <!-- Login button -->
                <button class="btn bg-transparent text-light btn-outline-light" data-bs-toggle="modal"
                data-bs-target="#LoginVerify">Login</button>
                
            </div>
        </div>
    </nav>


    <!-- Banner Section/ Image Cover -->
    <div class="container-fluid d-flex flex-column align-items-center justify-content-center
     text-center text-light p-0 m-0" id="banner">
        <div class="container">
            <h1 class="display-6 fw-bold m-3" id="discover">DISCOVER</h1>
            <h1 class="display-1 fw-bold m-3" id="davao">DAVAO</h1>
            <p class="fs-6 px-3 m-3">
                Stayscan is your ultimate guide to discovering, <br>
                comparing, and booking the finest local resorts in Davao<br>
                seamlessly and stress-free!
            </p>
            <a href="#About" class="btn btn-outline-light border rounded-pill px-4 py-2"
             id="explorebtn">Explore</a>
        </div>
    </div>

        <!--Information Section-->
        <div class="container-fluid text-light p-5 my-5" id="About">
            <div class="row">
                <div class="col-lg">
                    <div class="row w-75 ps-5">
                        <div class="container d-flex justify-content-center pe-5" id="AboutContent">
                            <h1 class="me-4">All ABOUT</h1>
                        </div>
                        <div class="container d-flex justify-content-center ps-5">
                            <h1 class="me-4">STAY <h1 id="stayscan">SCAN</h1></h1>
                        </div>
                    </div>
                    <div class="row">
                        <div class="container-fluid p-5 mx-5">
                            <p>
                            Welcome to Stayscan, your go-to platform for discovering the best local resorts in Davao!
                            Whether you're planning a weekend escape or a long-awaited vacation,
                            we make it easy to find, compare, and book the perfect stay. <br> <br>

                            At Stayscan, we believe that every traveler deserves a seamless and stress-free booking experience.
                            That’s why we bring together a curated selection of resorts, detailed insights,
                            and real-time availability—all in one place.
                            Our mission is simple: to connect travelers with the best accommodations that Davao has
                            to offer while ensuring a smooth and hassle-free booking process. <br> <br>

                            Start your journey with Stayscan today and experience Davao like never before!
                            </p>

                        </div>
                    </div>
                </div>

                <!--Water Fall Image-->
                <div class="col-lg">
                    <img src="Resources/waterfall.jpg" alt="waterfall Image">
                </div>
            </div>
        </div>
        
        <!--Featured Places-->
        <div class="container-fluid p-0 my-5 text-light d-flex justify-content-center" id="featured">
            <div class="row w-100">
                <div class="row d-flex align-items-center">
                    <div class="container text-center">
                        <h3 class="m-3" id="stayscan">EXPLORE RESORTS</h3>
                        <p class="m-2">Start your journey with Stayscan today and experience Davao like never before!</p>
                    </div>
                </div>

                <!-- CARDS for Featured Places -->
                <div class="container-fluid px-5 overflow-hidden d-flex justify-content-center">
                    <!-- First Card -->
                    <div class="col-lg-3 col-md-6 col-sm-12 d-flex flex-column justify-content-center">
                        <div class="card border-primary rounded-4 overflow-hidden shadow w-75 h-75">
                            <img class="h-100 w-100" src="Resources/pic1.jpg" alt="Featured Image">
                        </div>
                        <h3 class="my-3"><strong> RESORT 1</strong></h3>
                    </div>

                    <!-- Second Card -->
                    <div class="col-lg-3 col-md-6 col-sm-12 d-flex flex-column justify-content-center">
                        <div class="card border-primary rounded-4 overflow-hidden shadow w-75 h-75">
                            <img class="h-100 w-100" src="Resources/pic2.jpg" alt="Featured Image">
                        </div>
                        <h3 class="my-3"><strong> RESORT 2</strong></h3>
                    </div>

                    <!-- Third Card -->
                    <div class="col-lg-3 col-md-6 col-sm-12 d-flex flex-column justify-content-center">
                        <div class="card border-primary rounded-4 overflow-hidden shadow w-75 h-75">
                            <img class="h-100 w-100" src="Resources/pic3.jpg" alt="Featured Image">
                        </div>
                        <h3 class="my-3"><strong> RESORT 3</strong></h3>
                    </div>

                    <!-- Fourth Card -->
                    <div class="col-lg-3 col-md-6 col-sm-12 d-flex flex-column justify-content-center">
                        <div class="card border-primary rounded-4 overflow-hidden shadow w-75 h-75">
                            <img class="h-100 w-100" src="Resources/pic4.jpg" alt="Featured Image">
                        </div>
                        <h3 class="my-3"><strong> RESORT 4</strong></h3>
                    </div>
                </div>
            </div>
        </div>

        <!--Contact Informations-->
        <footer class="container-fluid text-light" id="Contact">
            <div class="row p-5">
                <div class="col">
                    <p>
                    CONTACT <br>
                    stayscan@gmail.com <br>
                    112 239 4612 <br> <br>

                    Saint St. Bario Obrero, <br>
                    Davao City Davao Del Sur <br>
                    </p>
                </div>
                <div class="col-lg-8 d-flex justify-content-start">
                    <h2 id="AboutContent">FEATURE RESORT <i class="bi bi-arrow-right mx-3"></i></h2>
                    <form action="" method="POST">
                        <input class="border-0 border-bottom border-light bg-transparent text-light" type="email"
                         name="email" placeholder="Enter your email">
                    </form>
                </div>
            </div>
        </footer>


    <!-- Bootstrap Script -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
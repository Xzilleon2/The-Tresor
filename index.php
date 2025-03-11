<?php 
include("Connection/db_connect.php");
include("Verify/Login.php");

// Check if user is logged in
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
    <style>
        #banner {
            background: url('Resources/Banner.png') no-repeat center center;
            background-size: cover;
            position: relative;
            height: 700px;
        }
        body{
            background: url(Resources/Back.jpg) cover;
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
    <nav class="navbar navbar-expand-lg navbar-light bg-dark bg-opacity-25 fixed-top">
        <div class="container">
            <!-- Brand and Toggler -->
            <a class="navbar-brand text-dark" href="#">
                <img src="Resources/Tresor.png" alt="" style="height: 80px; width: 100px;">
            </a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
                <span class="navbar-toggler-icon"></span>
            </button>

            <!-- Collapsible Menu -->
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav mx-auto text-center">
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


    <!-- Banner Section -->
    <div class="container-fluid d-flex flex-column align-items-center justify-content-center text-center text-light" id="banner">
        <div class="container">
            <h1 class="display-4 fw-bold m-3" style="font-family: 'rosarivo', serif;">DISCOVER SERENITY<br>AWAY FROM HOME</h1>
            <p class="fs-6 px-3 m-3">
                Tresor is a smart platform that helps travelers find, compare, and <br>
                book the best local hotels and Airbnb stays with ease.
            </p>
            <a href="#About" class="btn btn-outline-light px-4 py-2" >Explore</a>
        </div>
    </div>

    <!--About Section-->
    <div class="container-fluid text-dark py-5">
        <div class="container text-center">
            <p>Sunrises and sunsets are simply beautiful. Enjoy them while you’re on vacation! <br>
                Let the journey begin, a world of adventures, <br>
                relaxation, and memories awaits!
            </p>
        </div>
        <div class="container">
            <div class="row m-5">
                <div class="col-md-12 col-lg-6 text-center text-lg-start">
                    <p id="About">About</p>
                    <h1>Welcome To <br> The Tresor</h1>
                    <p>Lorem ipsum dolor sit amet consectetur adipisicing elit...</p>
                </div>
                <div class="col-md-12 col-lg-6 d-flex align-items-center justify-content-center">
                    <img class="img-fluid w-80 h-120" src="Resources/Buenavista.jpg" alt="">
                </div>
            </div>
        </div>

        <!--1st column-->
        <div class="row d-flex" style="height: auto;">
            <div class="col-12 col-md-6 d-flex flex-column p-3">
                <div class="row mb-5 justify-content-center align-items-start">
                    <img class="img-fluid w-75" src="Resources/Urya.jpg" alt="">
                </div>
                <div class="row mt-5 p-5 d-flex justify-content-center align-items-end">
                    <img class="img-fluid w-75" src="Resources/Heavens.jpg" alt="">
                </div>
            </div>

            <!--2nd Column-->
            <div class="col-12 col-md-6 d-flex flex-column justify-content-center align-items-center p-3">
                <div class="row justify-content-center align-items-end mt-5 p-5">
                    <img class="img-fluid w-100" src="Resources/Mergrande.jpg" alt="">
                </div>
                <div class="mt-auto w-50">
                    <p id="Services">Services</p>
                    <h1>Luxury Plaza <br> Resort For You</h1>
                    <p>Lorem ipsum dolor sit amet consectetur adipisicing elit...</p>
                    <a href="#" class="btn btn-outline-dark w-50">Explore</a>
                </div>
            </div>
        </div>

         <!-- High Light Container -->
        <div class="container-fluid p-2 my-5" style="background-color: #405751;">
            <div class="container m-5 position-relative d-flex justify-content-center">
                
                <!-- Image Container (Reference for Overlapping) -->
                <div class="col-12 col-md-8 position-relative">
                    <img class="img-fluid w-80" src="Resources/Beach.jpg" alt="Image" style="height: 400px; object-fit: cover;">
                </div>

                <!-- Text Container (Overlapping Card) -->
                <div class="col-12 col-md-5 bg-transparent border-none shadow-lg p-5 text-center text-dark
                    text-md-start position-absolute top-50 start-50 translate-middle"
                    style="border-radius: 10px; max-width: 400px;">
                    <p>Pool Bar</p>
                    <h1>The Canal <br> Club Poolside</h1>
                    <p>Enjoy a luxury poolside experience with refreshing cocktails and an unforgettable ambiance.</p>
                    <a class="btn btn-outline-dark w-50" href="">Explore</a>
                </div>
                
            </div>
        </div>
        
        <!--Listing-->
        <div class="container-fluid p-2 d-flex flex-column align-items-center">
            <div class="col-md-8 p-3 my-5">
                <p id="Rooms">Rooms</p>
                <h1>Stay With Us</h1>
                <div class="row">
                    <div class="col-lg my-3">
                        <img src="Resources/Room1.jpg" alt="" style="height: 150px; width: 180px;">
                        <h1>Room1</h1>
                        <p>Bla Bla Bla Bla</p>
                        <a class="btn btn-outline-dark" href="">View here ></a>
                    </div>
                    <div class="col-md my-3">
                        <img src="Resources/Room2.jpg" alt="" style="height: 150px; width: 180px;">
                        <h1>Room2</h1>
                        <p>Bla Bla Bla Bla</p>
                        <a class="btn btn-outline-dark" href="">View here ></a>
                    </div>
                    <div class="col-md my-3">
                        <img src="Resources/Room3.jpg" alt="" style="height: 150px; width: 180px;">
                        <h1>Room3</h1>
                        <p>Bla Bla Bla Bla</p>
                        <a class="btn btn-outline-dark" href="">View here ></a>
                    </div>
                </div>
                <div class="container d-flex flex-column align-items-center">
                    <h1 class="d-flex my-4 flex-column align-items-center text-center">
                        Come as you are and we will <br> 
                        take care of the rest
                    </h1>
                    <a class="btn btn-outline-dark" href="">Check Availability</a>
                </div>
            </div>
        </div>  
    </div>

        <!--Email Subs-->
        <div class="container-fluid p-5 text-light" style="background-color: #282B32;">
            <div class="row">
                <div class="col-lg p-3">
                    <h1>
                        Signup For Special <br>
                        Offers and Promotions
                    </h1>
                </div>
                <div class="col-lg p-5">
                    <form action="">
                        <input type="email" name="emailForm" placeholder="Enter Your Email Address"
                        style="background: transparent; border: none; border-bottom: 1px solid white;
                        width: 300px; padding-bottom: 8px; color: white;">
                        <input type="submit" value="Subscribe >"
                        style="border: none; background: transparent; padding-bottom: 8px; color: white;">
                    </form>
                </div>
               
            </div>
        </div>

        <!--Footer-->
        <footer class="container-fluid text-light d-flex" style="background-color: #405751;" id="Contact">
            <div class="col-sm-16 p-5 mx-3">
                <div class="row mb-3">
                    <img src="Resources/Tresor.png" alt="" style="height: 150px; width: 200px;">
                </div>
                <div class="row">
                    <p>Copyright The Tresor. All Right Reserved.</p>
                </div>
            </div>
            <div class="col-sm-2 p-5 mx-3">
                <p>MENU</p>
                <div class="row">
                    <a href="#banner">Home</a>
                    <a href="#Rooms">Rooms</a>
                    <a href="#About">About</a>
                    <a href="#Contact">Contact</a>
                </div>
            </div>
            <div class="col-sm-16 p-5 mx-3">
                <p>CONTACT</p>
                <div class="row">
                    <p>TheTresor@gmail.com</p>
                    <P>112 239 4612</P>
                    <p>Saint St. Bario Obrero, <br>
                        Davao City Davao Del Sur
                    </p>
                    <p><a href="">Terms of Service</a></p>
                </div>
            </div>
        </footer>

    <!-- Bootstrap Script -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
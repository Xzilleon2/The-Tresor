<?php 
session_start();

if (!isset($_SESSION["email"])){
    header("Location:../index.php");
    exit();
}
if($_SESSION['role'] != 'user'){
    header("Location: Homepage.php"); 
    exit();
}

include('../Connection/db_connect.php');
include('../Verify/fetchbusiness.php');

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" 
    rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;700&display=swap" rel="stylesheet">
    <style>
        #banner {
            background: url('../Resources/Banner.png') no-repeat center center;
            background-size: cover;
            position: relative;
            width: 100%;
            height: 35vh; /* Make banner full height */
        }
        body {
            margin: 0;
            padding: 0;
            font-family: 'Roboto', san-serif;
        }
        body p{
            font-family: 'Roboto', san-serif;
        }
        body h2{
            font-family: 'Analogue', san-serif;
        }
        body a{
            text-decoration: none;
            color: white;
        }
        .sidebar {
            color: white;
            height: 100vh; /* Full height */
            padding: 20px;
        }
        .sidebar a {
            color: white;
            text-decoration: none;
            display: block;
            padding: 10px 0;
        }
        .sidebar a:hover {
            background: #555;
            padding-left: 10px;
            transition: 0.3s;
        }
        #RecentlyListed {
            max-height: 350px; /* Adjust height as needed */
            overflow-y: auto;
            overflow-x: hidden;
            scrollbar-width: none;
        }
        #BusinessImg {
            height: 100%;
            width: 100%;
        }
    </style>
</head>
<body>
    <div class="container-fluid d-flex p-0">
        <!-- Sidebar -->
        <div class="sidebar col-md-2 col-lg-2 d-flex flex-column text-center" style="background-color: #405751;">
            <h5><?php echo $_SESSION['email'] ?></h5>
            <a href="../frames/Homepage.php">Home</a>
            <a href="Dashboard.php">Profile</a>
            <a href="#">Settings</a>
            <a href="../Verify/Logout.php">Logout</a>
        </div>

        <div class="col">
            <!-- Main Content -->
            <div class="row-lg bg-success">
                <div class="container p-0 d-flex justify-content-end col-md-9 col-lg-10 w-100">
                    <div class="row-lg-10 m-0 w-100">
                        <div class="d-flex justify-content-end w-100 p-3 shadow-sm" id="banner">
                            <div class="row-lg-8 w-25 h-25 d-flex align-items-center">
                                <input class="border-light text-light px-3 rounded-pill bg-transparent h-75 w-100"
                                type="text" name="search" placeholder="search">
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!--Listing Content-->
            <div class="container">
                <div class="row">
                    <!-- Left Column (Recently Visited) -->
                    <div class="col-md-8">
                        <div class="p-3">
                            <h3>Recently Visited</h3>
                            <div class="container-fluid">
                                <div class="d-flex flex-wrap gap-2 bg-dark bg-opacity-25 justify-content-center"id="RecentlyListed">
                                    <?php while($row = mysqli_fetch_assoc($result)) { ?>
                                        <a href="business_details.php?id=<?= $row['id'] ?>" class="text-decoration-none text-dark w-50 m-5">
                                            <div class="card d-flex flex-column justify-content-center border border-dark p-3 shadow-md">
                                                <div class="container-fluid d-flex justify-content-center">
                                                    <img src="../Resources/BusinessImg/<?= $row['image_path'] ?>" alt="Business image" id="BusinessImg">
                                                </div>
                                                <h1><?= $row['name'] ?></h1>
                                                <p><?= $row['description'] ?></p>
                                                <p><?= $row['location'] ?></p>
                                            </div>
                                        </a>
                                    <?php } ?>
                                </div>
                            </div>
                        </div>
                    </div>

                <!-- Right Column (Test Part) -->
                <div class="col-md-4 my-5">
                    <div class="container bg-success bg-opacity-25 p-3 text-center">
                        <h1>Test Part</h1>
                    </div>
                </div>
            </div>
        </div>
                
    <!-- Bootstrap Script -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>

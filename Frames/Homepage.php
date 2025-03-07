<?php
session_start();
include('../Connection/db_connect.php');
include('../Verify/fetchbusiness.php');

// Check if user is logged in
if (!isset($_SESSION['email'])) {
    header("Location: ../index.php");
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
        #ListedContents{
            max-height: 60vh;
            overflow-y: auto;
            overflow-x: hidden;
            scrollbar-width: none;
            display: block;
        }
        .card {
            height: 100%;
            min-height: 250px;
            display: flex;
            flex-direction: column;
            justify-content: space-between;
        }
        #BusinessImg {
            height: 100%;
            width: 100%;
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
    <div class="container">
        <div class="row row-cols-1 row-cols-md-2 row-cols-lg-3 my-5 p-2 d-flex justify-content-center" id="ListedContents">
            <?php while ($row = $result->fetch_assoc()) { ?>
                <div class="col-lg-5 m-4">
                    <a href="business_details.php?id=<?= htmlspecialchars($row['id']) ?>" 
                    class="text-decoration-none text-dark">
                        <div class="card border-dark p-3 shadow-md w-100">
                            <div class="row">
                                <!-- Text Column -->
                                <div class="col-lg-7 d-flex flex-column">
                                    <h1><?= htmlspecialchars($row['name']) ?></h1>
                                    <p><?= htmlspecialchars($row['description']) ?></p>
                                    <p><?= htmlspecialchars($row['location']) ?></p>
                                </div>

                                <!-- Image Column -->
                                <div class="col-lg p-0 mx-2 d-flex justify-content-center align-items-center">
                                    <img src="../Resources/BusinessImg/<?= htmlspecialchars($row['image_path'] ?? 'default.png') ?>" 
                                        alt="Business image" class="img-fluid">
                                </div>
                            </div>
                        </div>
                    </a>
                </div>
            <?php } ?>
        </div>
    </div> 


    <!-- Bootstrap Script -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>

</body>
</html>
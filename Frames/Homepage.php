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
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-icons/1.11.3/font/bootstrap-icons.min.css">
    <style>
        body{
            background-color: #05152c;
        }
        body p{
            font-family: 'Roboto', san-serif;
            text-align: justify;
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
        #Banner {
            background: url('../Resources/banner.jpg') no-repeat center center;
            background-size: cover;
            position: relative;
            height: 350px;

        }
    </style>

</head>
<body>
    <!-- Navbar -->
    <?php include('../includes/navbar.php')?>
    <div class="container-fluid text-light border-dark d-flex flex-column justify-content-center align-items-center" id="Banner">
        <h1>Discover Serinity <br> Away From Home</h1>
        <p class="m-2">Sunrises and sunsets are simply beautiful. Enjoy them while you’re on vacation!</p>
        <div class="container d-flex justify-content-center mt-5">
            <a href="Dashboard.php" class="btn btn-md mx-2 text-dark bg-light text-decoration-none"> Popular Destinations </a>
            <a href="Dashboard.php" class="btn btn-md mx-2 text-dark bg-light text-decoration-none"> Most Viewed </a>
            <a href="Dashboard.php" class="btn btn-md mx-2 text-dark bg-light text-decoration-none"> Recently Discovered </a>
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
                                        alt="Business image" class="img-fluid h-100">
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
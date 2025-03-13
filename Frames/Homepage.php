<?php
session_start();
include('../Connection/db_connect.php');
include('../Verify/fetchbusinessuser.php');

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
    <link rel="stylesheet" href="../Resources/styles/HomepageStyle.css">

</head>
<body>
    <!-- Banner Image -->
    <div class="container-fluid" id="Banner">
        <div class="row text-light border-dark d-flex flex-column justify-content-center align-items-center">
            <div class="row">
                <div class="container-fluid">
                    <!-- Navbar include --> 
                    <?php include('../includes/navbar.php')?>
                </div>
            </div>
            <div class="row">
                <div class="container-fluid d-flex flex-column justify-content-center align-items-center p-5">
                    <h1 class="display-3">Welcome to StayScan!</h1>
                    <p class="m-2">Find the best resorts and book your perfect stay.</p> 
                    <div class="container d-flex justify-content-center p-4">
                        <a href="Dashboard.php" class="btn btn-md mx-2 text-dark bg-light text-decoration-none"> Book Now </a>
                    </div> 
                </div>
            </div>
        </div>
    </div>

    <!--Product Section-->
    <div class="container">
        <div class="row">
            <div class="row">
                <div class="container-fluid text-light p-5">
                    <h1 class="display-5">Best Offer this month</h1>
                    <p>Top-rated stays at special prices only for this month!</p>
                </div>
            </div>
            <div class="row mx-4">                
                <div class="container-fluid text-light d-flex flex-column justify-content-center align-items-center">
                    <h4>Popular Destinations</h4>
                    <p>Explore our handpicked collection of stunning locations</p>
                </div>
            </div>
            
            <!--This section shows the available businesses listed in the database using fetchbusinessuser-->
            <div class="row row-cols-1 row-cols-md-2 row-cols-lg-3 my-5 p-2 d-flex justify-content-center" id="ListedContents">
                <?php while ($row = $result->fetch_assoc()) { ?>

                    <div class="col-lg-5 m-4">
                        <a href="business_details.php?id=<?= htmlspecialchars($row['id']) ?>" 
                        class="text-decoration-none text-dark">

                            <div class="card border-dark p-3 m-3 shadow-md w-100" id="businessCard" 
                             style="background: url('../Resources/BusinessImg/<?= htmlspecialchars($row['image_path'] ?? 'default.png') ?>');">

                                <div class="row align-items-end h-100">
                                    <!-- Information Area -->
                                    <div class="col-lg-7 w-100 text-light">
                                        <h1><?= htmlspecialchars($row['name']) ?></h1>
                                        <p><i class="bi bi-geo-alt-fill"> </i><?= htmlspecialchars($row['location']) ?></p>
                                    </div>
                                </div>

                            </div>
                        </a>
                    </div>
                <?php } ?>
            </div>
        </div>
    </div> 
    
            
    <div class="row" id="footerHome">
        <div class="container-fluid p-5 text-light d-flex flex-column justify-content-center align-items-center">
            <h3>StayScan</h3>
            <h1><strong>Subscribe to Our Newsletter</strong></h1>
            <h4>Get exclusive offers, travel tips, and updates on our newest resort destinations.</h4>
        </div>
    </div>

    <!-- Bootstrap Script -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>

</body>
</html>
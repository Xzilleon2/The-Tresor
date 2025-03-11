<?php 
session_start();

if (!isset($_SESSION["email"])){
    header("Location:../index.php");
    exit();
}
if($_SESSION['role'] != 'user'){
    if($_SESSION['role'] == 'owner'){
        header("Location: BusinessDash.php");
        exit();
    }elseif($_SESSION['role'] == 'admin'){
        header("Location: adminDashboard.php");
        exit();
    }else{
        header("Location: Homepage.php");
        exit();
    }
}

include('../Connection/db_connect.php');
include('../Verify/recentlybooked.php');

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
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-icons/1.11.3/font/bootstrap-icons.min.css">
    <style>
        #banner {
            background: url('../Resources/Banner.png') no-repeat center center;
            background-size: cover;
            position: relative;
            width: 100%;
            height: 30vh; /* Make banner full height */
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
            height: 100vh;
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
            max-height: 350px;
            overflow-y: auto;
            overflow-x: hidden;
            scrollbar-width: thin;
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
         <?php include('../includes/sidebar.php');?>

        <div class="col">
            <!-- Main Content -->
            <div class="row-lg bg-success">
                <div class="container p-0 d-flex justify-content-end col-md-9 col-lg-10 w-100">
                    <div class="row-lg-10 m-0 w-100">
                        <div class="d-flex justify-content-end w-100 p-3 shadow-sm" id="banner">
                            <div class="row-lg-8 w-25 h-25 d-flex align-items-center">
                                <?php include('../includes/displayMessage.php'); ?>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!--Listing Content-->
            <div class="container">
                <div class="row">
                    <!-- (Recently Visited) -->
                    <div class="col-md-12">
                        <div class="p-3">
                            <h3>Recently Booked</h3>
                            <div class="container-fluid">
                                <div class="d-flex flex-wrap justify-content-center" id="RecentlyListed">
                                <?php if (isset($result) && $result->num_rows > 0) { ?>
                                    <?php while ($row = $result->fetch_assoc()) { ?>
                                        <a href="business_details.php?id=<?= htmlspecialchars($row['business_id']) ?>
                                          " class="text-decoration-none text-dark w-75 m-5">

                                            <div class="card d-flex flex-column justify-content-center border-dark p-3 shadow-md">
                                                <div class="row">
                                                    <div class="col-lg-7 ">
                                                        <h1><?= htmlspecialchars($row['business_name']) ?></h1>
                                                        <p><?= htmlspecialchars($row['description']) ?></p>
                                                        <p><?= htmlspecialchars($row['location']) ?></p>
                                                        <p><strong>CheckIn Date:</strong> <?= htmlspecialchars($row['booking_date']) ?></p>
                                                        <p><strong>CheckOut Date:</strong> <?= htmlspecialchars($row['CheckOut_Date']) ?></p>
                                                        <p><strong>Number of Persons:</strong> <?= htmlspecialchars($row['Persons']) ?></p>
                                                        <p><strong>Status:</strong> <?= htmlspecialchars($row['status']) ?></p>
                                                    </div>

                                                    <!--Image Column-->
                                                    <div class="col-lg p-0 mx-2 d-flex justify-content-center">
                                                        <div class="container-fluid p-0">
                                                            <img src="../Resources/BusinessImg/<?= htmlspecialchars($row['image_path'] ?? 'default.png') ?>" 
                                                                alt="Business image" id="BusinessImg">
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </a>
                                    <?php } ?>
                                <?php } else { ?>
                                    <p>No recent bookings found.</p>
                                <?php } ?>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>    
            </div>
        </div>
                
    <!-- Bootstrap Script -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>

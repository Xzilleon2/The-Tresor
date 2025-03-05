<?php 
session_start();

if (!isset($_SESSION["email"]) && !isset($_SESSION["passowrd"])){
    header("Location:../index.php");
    exit();
}
if($_SESSION['role'] != 'owner'){
    header("Location: Homepage.php"); // Redirect to login if session is empty
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
    <title>Owner Dashboard</title>
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
        body h1{
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
            <h2>PROFILE</h2>
            <a href="../frames/Homepage.php">Home</a>
            <a href="#">Profile</a>
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
                            <h3>Recently Listed</h3>
                            <div class="container-fluid">
                                <div class="d-flex flex-wrap gap-2 bg-dark bg-opacity-25" id="RecentlyListed">
                                    <?php while($row = mysqli_fetch_assoc($result)) { ?>
                                        <a href="Dashboard.php" class="text-decoration-none text-dark m-5 w-50">
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

                <!-- Right Column (Action Part) -->
                <div class="col-md-4 my-5">
                    <div class="container text-light bg-opacity-25 p-3" style="background-color: #405751;">
                        <h4>Actions</h4>
                        <!--Add Button-->
                        <button class="btn btn-light btn-sm my-2 w-75" data-bs-toggle="modal"
                        data-bs-target="#addModal">List Business</button> <br>
                        <!--Update Button-->
                        <button class="btn btn-light btn-sm my-2 w-75" data-bs-toggle="modal"
                        data-bs-target="#updateModal">Update Listed</button> <br>
                        <!--Delete Button-->
                        <button class="btn btn-light btn-sm my-2 w-75" data-bs-toggle="modal"
                        data-bs-target="#deleteModal">Delete Listed</button></li>     
                    </div>
                </div>
            </div>
        </div>

        <!--Modals-->
        <!-- Add Modal -->
        <div class="modal fade" id="addModal" tabindex="-1"
            role="dialog" aria-labelledby="addModalLabel" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="addModalLabel">Business Informations</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal"
                            aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <form action="../Verify/addBusiness.php" method="POST" enctype="multipart/form-data">
                            <div class="form-group">
                                <label for="name">Name</label>
                                <input type="text" class="form-control" id="name"
                                    name="name" required>
                            </div>
                            <div class="form-group">
                                <label for="description">Description</label>
                                <input type="text" class="form-control" id="description"
                                    name="description" required>
                            </div>
                            <div class="form-group">
                                <label for="location">Location</label>
                                <input type="text" class="form-control" id="location"
                                    name="location" required>
                            </div>
                            <div class="form-group">
                                <label for="image">Image</label>
                                <input type="file" class="form-control" id="image" name="image" required> <br>
                            </div>
                            <input type="hidden" name="id" value="<?= $_SESSION['id'] ?>">
                            <button type="submit" class="btn btn-primary">Save Changes</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>

        <!-- Delete Modal -->
        <div class="modal fade" id="deleteModal<?= $row['id'] ?>" tabindex="-1"
            role="dialog" aria-labelledby="deleteModalLabel" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="deleteModalLabel">Delete User</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal"
                            aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <p>Are you sure you want to delete this user?</p>
                        <form action="../Verify/deleteuser.php" method="POST">
                            <input type="hidden" name="id"
                                value="<?= $row['id'] ?>">
                            <button type="submit" class="btn btn-danger">Delete</button>
                            <button type="button" class="btn btn-secondary"
                                data-dismiss="modal">Cancel</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        
    <!-- Bootstrap Script -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>

<?php 
session_start();

//check if the user is in session
if (!isset($_SESSION["email"]) && !isset($_SESSION["password"])){
    header("Location:../index.php");
    exit();
}

//Check if the user has the proper role to access this dashboard
if($_SESSION['role'] != 'owner'){
    if($_SESSION['role'] == 'user'){
        header("Location: Dashboard.php");
        exit();
    }elseif($_SESSION['role'] == 'admin'){
        header("Location: adminDashboard.php");
        exit();
    }else{
        header("Location: Homepage.php");
        exit();
    }
}
//Include necessary imports
include('../Connection/db_connect.php');
include('../Verify/fetchbusiness.php');
include('../Verify/bookingNotif.php');

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
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-icons/1.11.3/font/bootstrap-icons.min.css">
    <link rel="stylesheet" href="../Resources/styles/DashboardStyle.css">

</head>
<body>

    <div class="row">    
        <!-- Navbar -->
        <?php include('../includes/navbar.php');?>
    </div>
    
    <div class="container-fluid d-flex p-0">
        <div class="col">
            <!-- Main Content -->
            <div class="row-lg">
                <div class="container p-0 d-flex justify-content-end col-md-9 col-lg-10 w-100">
                    <div class="row-lg-10 m-0 w-100">
                        <div class="d-flex justify-content-end w-100 p-3 shadow-sm" id="banner">
                            <div class="row-lg-8 w-25 h-25 my-3 d-flex align-items-center">
                                    <?php include('../includes/displayMessage.php'); ?>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!--Listing Content-->
            <div class="container">
                <div class="row">
                    <!-- Display the listed businesses of the owner from database using fetchbusiness-->
                    <div class="col-md-8 text-light">
                        <div class="p-3">
                            <h3>Recently Listed</h3>
                            <div class="container-fluid">
                                <div class="d-flex flex-wrap" id="RecentlyListed">
                                <?php if (isset($result) && $result->num_rows > 0) { ?>
                                    <?php while ($row = $result->fetch_assoc()) { ?>
                                        <a href="business_details.php?id=<?= htmlspecialchars($row['id']) ?>" 
                                        class="text-decoration-none text-dark w-75 m-5">
                                            <div class="card d-flex flex-column justify-content-center border-dark p-3 shadow-md" id="recentBook">
                                                <div class="row">
                                                    <div class="col-lg-7 ">
                                                        <h1><?= htmlspecialchars($row['name']) ?></h1>
                                                        <p><?= htmlspecialchars($row['description']) ?></p>
                                                        <p><?= htmlspecialchars($row['location']) ?></p>

                                                    </div>
                                                    <div class="col-lg p-0 mx-2 d-flex justify-content-center">
                                                        <div class="container-fluid p-0">
                                                            <img src="../Resources/BusinessImg/<?= htmlspecialchars($row['image_path'] ?? 'default.png') ?>" 
                                                                alt="Business image" id="BusinessImg">
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </a>

                                        <!-- Update Button -->
                                        <button class="btn btn-sm mt-2 text-light" data-bs-toggle="modal" 
                                        data-bs-target="#updateModal<?= $row['id'] ?>"
                                        style="background-color: #0b3063;">Update</button>

                                        <!-- Update Listing Modal -->
                                        <div class="modal fade" id="updateModal<?= $row['id'] ?>" tabindex="-1" role="dialog" 
                                            aria-labelledby="updateModalLabel<?= $row['id'] ?>" aria-hidden="true">
                                            <div class="modal-dialog" role="document">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h5 class="modal-title" id="updateModalLabel<?= $row['id'] ?>">Update Listing</h5>
                                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                    </div>
                                                    <div class="modal-body text-dark">
                                                        <form action="../Verify/updateListing.php" method="POST" enctype="multipart/form-data">
                                                            <input type="hidden" name="business_id" value="<?= $row['id'] ?>">

                                                            <div class="form-group">
                                                                <label for="name">Name</label>
                                                                <input type="text" class="form-control" name="name" value="<?= htmlspecialchars($row['name']) ?>" required>
                                                            </div>

                                                            <div class="form-group">
                                                                <label for="description">Description</label>
                                                                <input type="text" class="form-control" name="description" value="<?= htmlspecialchars($row['description']) ?>" required>
                                                            </div>

                                                            <div class="form-group">
                                                                <label for="location">Location</label>
                                                                <input type="text" class="form-control" name="location" value="<?= htmlspecialchars($row['location']) ?>" required>
                                                            </div>

                                                            <div class="form-group">
                                                                <label for="image">Image</label>
                                                                <input type="file" class="form-control" name="image">
                                                            </div>

                                                            <button type="submit" class="btn btn-primary mt-3">Save Changes</button>
                                                        </form>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    <?php } ?>

                                <?php } else { ?>
                                    <p>No recent bookings found.</p>
                                <?php } ?>
                                </div>
                            </div>
                        </div>
                    </div>

                <!-- Right Column (Action Part) -->
                <div class="col-md-4 my-5">
                    <div class="container text-light bg-opacity-25 p-3" style="background-color: #0b3063;">
                        <h4>Business Settings</h4>
                        <!--Add Button-->
                        <button class="btn btn-light btn-sm my-2 w-75" data-bs-toggle="modal"
                        data-bs-target="#addModal">List Business</button> <br>
                        <!--Delete Button-->
                        <button class="btn btn-light btn-sm my-2 w-75" data-bs-toggle="modal"
                        data-bs-target="#deleteModal">Delete Listed</button></li>
                        <!--Notification Button-->
                        <button class="btn btn-light btn-sm my-2 w-75" data-bs-toggle="modal"
                        data-bs-target="#notificationModal">Notifications</button></li>         
                    </div>
                </div>
            </div>
        </div>

        <!--Modals-->
        <!-- Add Listing Modal -->
        <div class="modal fade" id="addModal" tabindex="-1" role="dialog" aria-labelledby="addModalLabel" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="addModalLabel">Business Informations</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
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
                            <input type="hidden" name="id" value="<?php echo $_SESSION['id'];?>">
                            <button type="submit" class="btn btn-primary">Save Changes</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>

        <!-- Delete Listing Modal -->
        <div class="modal fade" id="deleteModal" tabindex="-1" role="dialog" aria-labelledby="deleteModalLabel" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="deleteModalLabel">Delete listing</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <p>Are you sure you want to delete this listing?</p>
                        <form action="../Verify/deletelisting.php" method="POST">
                            <label for="name">Listed Business Name</label>
                            <input type="text" name="name">
                            <input type="hidden" name="id" value="<?= htmlspecialchars($_SESSION['id']) ?>"">
                            <button type="submit" class="btn btn-danger">Delete</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>

        <!-- Notification Modal -->
        <!-- Used to review the bookings of customers using business notif-->
        <div class="modal fade" id="notificationModal" tabindex="-1" aria-labelledby="notificationModalLabel" 
        aria-hidden="true">
            <div class="modal-dialog modal-xl">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="notificationModalLabel">Recent Bookings</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <!-- Scrollable Table Container -->
                        <div class="table-responsive" style="max-height: 400px; overflow-y: auto;">
                            <table id="bookingNotif" class="table table-striped table-bordered">
                                <thead class="table-dark text-center">
                                    <tr>
                                        <th>TITLE</th>
                                        <th>EMAIL</th>
                                        <th>CHECK-IN DATE</th>
                                        <th>CHECK-OUT DATE</th>
                                        <th>#PERSONS</th>
                                        <th>STATUS</th>
                                        <th>ACTION</th>
                                    </tr>
                                </thead>
                                <tbody class="text-center">
                                <?php if (isset($result_bookingnotif) && $result_bookingnotif->num_rows > 0) { ?>
                                    <?php while ($row = $result_bookingnotif->fetch_assoc()) { ?>
                                        <tr>
                                            <td><?= htmlspecialchars($row['business_name']) ?></td>
                                            <td><?= htmlspecialchars($row['user_email']) ?></td>
                                            <td><?= htmlspecialchars($row['booking_checkIn']) ?></td>
                                            <td><?= htmlspecialchars($row['booking_checkOut']) ?></td>
                                            <td><?= htmlspecialchars($row['booking_persons']) ?></td>
                                            <td>
                                                <span class="badge bg-<?= $row['booking_status'] == 'Approved' ? 'success' :
                                                ($row['booking_status'] == 'Rejected' ? 'danger' : 'warning') ?>">
                                                    <?= htmlspecialchars($row['booking_status']) ?>
                                                </span>

                                            </td>
                                            <td>
                                                <!-- Approve Button (Direct Submission) -->
                                                <form action="../Verify/acceptBookings.php" method="POST" style="display: inline;">
                                                    <input type="hidden" name="booking_id" value="<?= htmlspecialchars($row['booking_id']) ?>">
                                                    <button type="submit" class="btn btn-success btn-sm">Approve</button>
                                                </form>

                                                <!-- Reject Button (Direct Submission) -->
                                                <form action="../Verify/rejectBookings.php" method="POST" style="display: inline;">
                                                    <input type="hidden" name="booking_id" value="<?= htmlspecialchars($row['booking_id']) ?>">
                                                    <button type="submit" class="btn btn-danger btn-sm">Reject</button>
                                                </form>
                                            </td>
                                        </tr>
                                    <?php } ?>
                                <?php } else { ?>
                                    <tr><td colspan="5" class="text-center">No Bookings Yet.</td></tr>
                                <?php } ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    
    <!-- Bootstrap Script -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>

</body>
</html>
<?php 
session_start();
include("../Connection/db_connect.php");
include("../Verify/Fetchuser.php");

// Check if user is logged in
if (!isset($_SESSION['email']) && !isset($_SESSION['password'])) {
    header("Location: ../index.php");
    exit();
}
if($_SESSION['role'] != 'admin'){
    if($_SESSION['role'] == 'owner'){
        header("Location: BusinessDash.php");
        exit();
    } elseif($_SESSION['role'] == 'user'){
        header("Location: Dashboard.php");
        exit();
    } else {
        header("Location: Homepage.php");
        exit();
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/5.3.0/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/2.2.2/css/dataTables.bootstrap5.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-icons/1.11.3/font/bootstrap-icons.min.css">
    <style>
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
    </style>
</head>
<body>
    <div class="container-fluid">
        <div class="row">
            <!-- Sidebar -->
            <?php include('../includes/sidebar.php'); ?>


            <!-- User Table Data -->
            <div class="col-md-10">
                <div class="mt-4">
                    <table id="example" class="table table-striped table-bordered">
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>First Name</th>
                                <th>Last Name</th>
                                <th>Email</th>
                                <th>Role</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php while ($row = mysqli_fetch_assoc($result)) { ?>
                            <tr>
                                <td><?= $row['id'] ?></td>
                                <td><?= $row['fname'] ?></td>
                                <td><?= $row['lname'] ?></td>
                                <td><?= $row['email'] ?></td>
                                <td><?= $row['role'] ?></td>
                                <td>
                                    <button class="btn btn-warning btn-sm" data-bs-toggle="modal"
                                        data-bs-target="#updateModal<?= $row['id'] ?>">Update</button>
                                    <button class="btn btn-danger btn-sm" data-bs-toggle="modal"
                                        data-bs-target="#deleteModal<?= $row['id'] ?>">Delete</button>
                                </td>
                            </tr>

                            <!--Update User Modal-->
                            <div class="modal fade" id="updateModal<?= $row['id'] ?>" tabindex="-1" role="dialog" 
                            aria-labelledby="updateModalLabel<?= $row['id'] ?>" aria-hidden="true">
                                <div class="modal-dialog" role="document">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="updateModalLabel<?= $row['id'] ?>">Update Listing</h5>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                        </div>
                                        <div class="modal-body">
                                            <form action="../Verify/updateuser.php" method="POST">
                                                <input type="hidden" name="id" value="<?= $row['id'] ?>">

                                                <div class="form-group">
                                                    <label for="fname">First Name</label>
                                                    <input type="text" class="form-control" name="fname" value="<?= htmlspecialchars($row['fname']) ?>" required>
                                                </div>

                                                <div class="form-group">
                                                    <label for="lname">Last Name</label>
                                                    <input type="text" class="form-control" name="lname" value="<?= htmlspecialchars($row['lname']) ?>" required>
                                                </div>

                                                <div class="form-group">
                                                    <label for="email">Email</label>
                                                    <input type="email" class="form-control" name="email" value="<?= htmlspecialchars($row['email']) ?>" required>
                                                </div>

                                                <div class="form-group">
                                                    <label for="role">Role</label>
                                                    <input type="text" class="form-control" name="role" value="<?= htmlspecialchars($row['role']) ?>" required>
                                                </div>

                                                <button type="submit" class="btn btn-primary mt-3">Save Changes</button>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <!--Delete User Modal-->
                            <div class="modal fade" id="deleteModal<?= $row['id'] ?>" tabindex="-1" role="dialog" 
                            aria-labelledby="deleteModalLabel<?= $row['id'] ?>" aria-hidden="true">
                                <div class="modal-dialog" role="document">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="deleteModalLabel<?= $row['id'] ?>">Delete User</h5>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                        </div>
                                        <div class="modal-body">
                                            <p>Are you sure you want to delete this user?</p>
                                            <form action="../Verify/deleteuser.php" method="POST">
                                                <input type="hidden" name="id" value="<?= $row['id'] ?>">
                                                <button type="submit" class="btn btn-danger">Delete</button>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <?php } ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

    <!-- Scripts -->
    <script src="https://code.jquery.com/jquery-3.7.1.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/5.3.0/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdn.datatables.net/2.2.2/js/dataTables.js"></script>
    <script src="https://cdn.datatables.net/2.2.2/js/dataTables.bootstrap5.js"></script>

    <script>
        $(document).ready(function() {
            $('#example').DataTable(); // Correct initialization
        });
    </script>
</body>
</html>

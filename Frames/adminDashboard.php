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
    }elseif($_SESSION['role'] == 'user'){
        header("Location: Dashboard.php");
        exit();
    }else{
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
</head>
<body>
    <div class="container-fluid">
        <div class="container mt-4">
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
                         data-bs-target="#updateModal<?= $row['id']?>">Update</button>

                         <button class="btn btn-warning btn-sm" data-bs-toggle="modal"
                         data-bs-target="#deleteModal<?= $row['id']?>">Delete</button>
                    </td>
                </tr>
                <!-- Update Modal -->
                <div class="modal fade" id="updateModal<?= $row['id'] ?>" tabindex="-1"
                    role="dialog" aria-labelledby="updateModalLabel" aria-hidden="true">
                    <div class="modal-dialog" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="updateModalLabel">Update User</h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal"
                                    aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <div class="modal-body">
                                <form action="../Verify/updateuser.php" method="POST">
                                    <div class="form-group">
                                        <label for="fname">First Name</label>
                                        <input type="text" class="form-control" id="fname"
                                            name="fname" value="<?= $row['fname'] ?>"
                                            required>
                                    </div>
                                    <div class="form-group">
                                        <label for="lname">Last Name</label>
                                        <input type="text" class="form-control" id="lname"
                                            name="lname" value="<?= $row['lname'] ?>"
                                            required>
                                    </div>
                                    <div class="form-group">
                                        <label for="email">Email</label>
                                        <input type="text" class="form-control" id="email"
                                            name="email" value="<?= $row['email'] ?>"
                                            required>
                                    </div>
                                    <div class="form-group">
                                        <label for="role">Role</label>
                                        <input type="text" class="form-control" id="role"
                                            name="role" value="<?= $row['role'] ?>"
                                            required>
                                    </div>
                                    <input type="hidden" name="usr_id"
                                        value="<?= $row['id'] ?>">
                                    <button type="submit" class="btn btn-primary">Save
                                        Changes</button>
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
                <?php }?>
            </tbody>
        </table>
    </div>

    </div>

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
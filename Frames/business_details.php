<?php 
include ("../Connection/db_connect.php");
include ("../Verify/booking_process.php");

// Check if `id` is provided in the URL
if (isset($_GET['id'])) {
    $business_id = $_GET['id'];

    // Fetch business details
    $query = "SELECT b.id, b.name, b.description, b.location, bi.image_path
              FROM businesses b
              LEFT JOIN business_images bi ON b.id = bi.business_id
              WHERE b.id = ?";
    
    $stmt = $conn->prepare($query);
    $stmt->bind_param("i", $business_id);
    $stmt->execute();
    $result = $stmt->get_result();

    // Check if business exists
    if ($row = $result->fetch_assoc()) {
?>
        <!DOCTYPE html>
        <html lang="en">
        <head>
            <meta charset="UTF-8">
            <meta name="viewport" content="width=device-width, initial-scale=1.0">
            <title><?= $row['name'] ?></title>
            <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" 
             rel="stylesheet">
            <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;700&display=swap" rel="stylesheet">
            <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-icons/1.11.3/font/bootstrap-icons.min.css">
            <style>
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
                    height: 100vh; 
                    width: 100%; 
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
            <div class="container-fluid vh-100">
                <div class="row h-100">
                    <div class="col-lg-2 d-flex flex-column vh-100 p-0">
                        <!-- Sidebar -->
                        <div class="sidebar d-flex flex-column text-center" style="background-color: #405751;">
                            <h2>The Tresor</h2> <br>
                            <a href="../frames/Homepage.php">Home</a>
                            <a href="Dashboard.php">Profile</a>
                            <a href="#">Settings</a>
                            <a href="../Verify/Logout.php">Logout</a>
                        </div>
                    </div>

                    <div class="col-lg-10 bg-success">
                        <h1><?= $row['name'] ?></h1>
                        <img src="../Resources/BusinessImg/<?= $row['image_path'] ?? 'default.jpg' ?>" alt="Business Image" style="width:300px; height:auto;">
                        <p><strong>Description:</strong> <?= $row['description'] ?></p>
                        <p><strong>Location:</strong> <?= $row['location'] ?></p>

                        <!--Add Button-->
                        <button class="btn btn-light btn-sm my-2 w-25" data-bs-toggle="modal"
                        data-bs-target="#bookModal">Book</button> <br>
                    </div>
                </div>
            </div>

            <!-- Booking Modal -->
            <div class="modal fade" id="bookModal" tabindex="-1"
                role="dialog" aria-labelledby="bookModalLabel" aria-hidden="true">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="bookModalLabel">Reservation Details</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal"
                                aria-label="Close">
                            </button>
                        </div>
                        <div class="modal-body">
                            <form action="../Verify/booking_process.php" method="POST">
                                <div class="form-group">
                                    <input type="hidden" class="form-control" id="business_id"
                                        name="business_id" value="<?= $row['id'] ?>" required>
                                </div>
                                <div class="form-group">
                                    <label for="booking_date">Date</label>
                                    <input class="form-control" type="date"  min="2025-01-01" max="2025-12-31" id="booking_date"
                                        name="booking_date" required> <br>
                                </div>
                                <button type="submit" class="btn btn-primary">Save
                                    Changes</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Bootstrap Script -->
            <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
        </body>
        </html>
<?php
    } else {
        echo "<h1>Business not found.</h1>";
    }
} else {
    echo "<h1>Invalid request.</h1>";
}
?>

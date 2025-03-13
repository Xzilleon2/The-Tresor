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

    // Check if business exists in booking_process
    if ($row = $result->fetch_assoc()) {
?>
        <!DOCTYPE html>
        <html lang="en">
            <meta charset="UTF-8">
            <meta name="viewport" content="width=device-width, initial-scale=1.0">
            <title><?= $row['name'] ?></title>
            <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" 
             rel="stylesheet">
            <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;700&display=swap" rel="stylesheet">
            <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-icons/1.11.3/font/bootstrap-icons.min.css">
            <link rel="stylesheet" href="../Resources/styles/DashboardStyle.css">
        </head>
        <body>

            <div class="row">
                <div class="row-lg w-100 p-0 d-flex justify-content-center p-3">
                    <img class="w-75 shadow-md" src="../Resources/BusinessImg/<?= $row['image_path'] ?? 'default.jpg' ?>"
                    alt="Business Image" style="height: 320px;">
                </div>
                <div class="row d-flex justify-content-center">
                    <!-- Content design for the main panel -->
                    <div class="col-lg-8 d-flex flex-column justify-content-center align-items-center">
                        <!-- Business Details -->
                        <div class="row-lg d-flex justify-content-center w-75">
                            <div class="col-lg text-light m-3 p-3" style="background-color: #0b3063; border-radius: 20px;">
                                    <h1><?= $row['name'] ?></h1>
                                    <p><strong>Description:</strong> <?= $row['description'] ?></p>
                                    <p><strong>Location:</strong> <?= $row['location'] ?></p>
                                    <!--Add Button-->
                                    <button class="btn btn-dark text-light btn-sm my-2 w-25" data-bs-toggle="modal"
                                    data-bs-target="#bookModal">Book</button> <br>
                            </div>
                        </div>
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
                                    <label for="booking_people">Number of Persons</label>
                                    <input class="form-control" type="text" id="booking_people"
                                        name="booking_people" required> <br>
                                    <label for="booking_startdate">Check-In Date</label>
                                    <input class="form-control" type="date"  min="2025-01-01" max="2025-12-31" id="booking_startdate"
                                        name="booking_startdate" required> <br>
                                        <label for="booking_enddate">Check-Out Date</label>
                                    <input class="form-control" type="date"  min="2025-01-01" max="2025-12-31" id="booking_enddate"
                                        name="booking_enddate" required> <br>
                                </div>
                                <button type="submit" class="btn btn-primary">Book</button>
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

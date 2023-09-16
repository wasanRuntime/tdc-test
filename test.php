<?php include 'includes/header.php'; ?>
<!DOCTYPE html>
<html>

<head>
    <!-- Include your CSS and Bootstrap links here -->
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Car Details</title>
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css">
</head>

<body>
    <div class="container">
        <?php
        // Include the database connection script
        require_once(__DIR__ . '../db/dbconnect.php');

        // Check if the car_id parameter is set in the URL
        if (isset($_GET['car_id'])) {
            // Retrieve the car ID from the URL
            $car_id = $_GET['car_id'];

            // Retrieve car data from the database for the specified car ID
            $query = "SELECT car_makes.*, sellers.phone_number FROM car_makes 
                      INNER JOIN sellers ON car_makes.seller_id = sellers.id 
                      WHERE car_makes.id = :car_id";
            $stmt = $pdo->prepare($query);
            $stmt->bindParam(':car_id', $car_id);
            $stmt->execute();

            // Fetch car data
            $car = $stmt->fetch(PDO::FETCH_ASSOC);

            if ($car) {
        ?>
                <h2 class="text-center">Car Details</h2>
                <div class="row">
                    <div class="col-md-6">
                        <!-- Display car images -->
                        <div id="carouselExampleControls" class="carousel slide" data-ride="carousel">
                            <div class="carousel-inner">
                                <!-- Display up to 5 car images -->
                                <?php for ($i = 0; $i <= 5; $i++) {
                                    $carImagePathKey = 'car_image_path' . (($i > 0) ? '_' . $i : ''); // Updated variable name
                                    if (!empty($car[$carImagePathKey])) {
                                        $activeClass = ($i === 0) ? 'active' : '';
                                ?>
                                        <div class="carousel-item <?php echo $activeClass; ?>">
                                            <!-- Adjust the image path to include the relative path to the "uploads" folder -->
                                            <img class="d-block w-100 carousel-img" src="sellers/<?php echo $car[$carImagePathKey]; ?>" alt="<?php echo $car['make']; ?>">
                                        </div>
                                <?php }
                                } ?>
                            </div>
                            <a class="carousel-control-prev" href="#carouselExampleControls" role="button" data-slide="prev">
                                <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                                <span class="sr-only">Previous</span>
                            </a>
                            <a class="carousel-control-next" href="#carouselExampleControls" role="button" data-slide="next">
                                <span class="carousel-control-next-icon" aria-hidden="true"></span>
                                <span class="sr-only">Next</span>
                            </a>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <!-- Display car details -->
                        <p>Make: <?php echo $car['make']; ?></p>
                        <p>Model: <?php echo $car['model']; ?></p>
                        <p>Year of Manufacture: <?php echo $car['year_of_manufacture']; ?></p>
                        <p>Transmission: <?php echo $car['transmission']; ?></p>
                        <p>Mileage: <?php echo $car['mileage']; ?></p>
                        <p>Price: KSh. <?php echo number_format($car['price'], 2); ?></p> <!-- Format price as currency -->
                        <p>Seller Phone Number: <?php echo $car['phone_number']; ?></p>
                        <!-- You can add more car details here -->
                    </div>
                </div>
        <?php
            } else {
                echo '<p>Car not found.</p>';
            }
        } else {
            echo '<p>Car ID not specified.</p>';
        }
        ?>
    </div>

    <!-- Bootstrap JavaScript and jQuery -->
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.4/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js"></script>
</body>

</html>

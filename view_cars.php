<?php include 'includes/header.php'; ?>

<!DOCTYPE html>
<html>

<head>
    <!-- Include your CSS and Bootstrap links here -->
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Available Cars</title>
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css">
</head>

<body>
    <div class="container">
        <h2 class="text-center">Available Cars</h2>

        <div class="row">
            <?php
            // Include the database connection script
            require_once(__DIR__ . '../db/dbconnect.php');

            // Retrieve car data from the database (customize your SQL query)
            $query = "SELECT * FROM car_makes";
            $stmt = $pdo->query($query);

            while ($car = $stmt->fetch(PDO::FETCH_ASSOC)) {
            ?>
                <div class="col-lg-3 col-md-6 mb-4">
                    <div class="card">
                        <!-- Link to the car details page, passing the car's ID as a parameter -->
                        <a class="card-link" href="car_details.php?car_id=<?php echo $car['id']; ?>">
                            <!-- Adjust the image path to include the relative path from "view_cars.php" to the "uploads" folder -->
                            <img class="card-img-top" src="sellers/<?php echo $car['car_image_path']; ?>" alt="<?php echo $car['make']; ?>">
                            <div class="card-body">
                                <h5 class="card-title"><?php echo $car['make']; ?> <?php echo $car['model']; ?></h5>
                                <p class="card-text">Price: KSh. <?php echo number_format($car['price'], 2); ?></p>
                                <a href="car_details.php?car_id=<?php echo $car['id']; ?>" class="btn btn-warning">View Details</a>
                            </div>
                        </a>
                        <!-- Add more details as needed -->
                    </div>
                </div>
            <?php
            }
            ?>
        </div>
    </div>

    <!-- Bootstrap JavaScript and jQuery -->
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.4/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js"></script>
</body>

</html>

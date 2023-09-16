<!-- Featured Car Section -->
<section class="py-5 bg-light">
    <div class="container">
        <h2 class="text-center mb-4">Featured</h2>
        <div class="row">
            <?php
            // Include the database connection script
            require_once(__DIR__ . '/../db/dbconnect.php');

            // Retrieve the latest four cars from the database based on the upload date
            $query = "SELECT * FROM car_makes ORDER BY upload_timestamp DESC LIMIT 4";


            $stmt = $pdo->query($query);

            while ($car = $stmt->fetch(PDO::FETCH_ASSOC)) {
                // Your existing code to display each car here
            ?>
                <div class="col-lg-3 col-md-6 mb-4">
                    <div class="featured-card">
                        <img src="sellers/<?php echo $car['car_image_path']; ?>" class="card-img-top" alt="Featured Car <?php echo $car['id']; ?>">
                        <div class="card-body">
                            <h5 class="card-title"><?php echo $car['make']; ?> <?php echo $car['model']; ?></h5>
                            <p class="card-text">Price: KSh. <?php echo number_format($car['price'], 2); ?></p>
                            <a href="car_details.php?car_id=<?php echo $car['id']; ?>" class="btn btn-warning">View Details</a>
                        </div>
                    </div>
                </div>
            <?php
            } // End of the while loop
            ?>
        </div>
    </div>
</section>

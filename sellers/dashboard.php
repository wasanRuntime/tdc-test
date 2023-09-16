<?php
session_start();

// Check if the seller is logged in. If not, redirect to the login page.
if (!isset($_SESSION['seller_id'])) {
    header('Location: login.php');
    exit();
}

// Fetch seller details from the database (you can customize this query).
require_once('../db/dbconnect.php');

$seller_id = $_SESSION['seller_id'];

$query = "SELECT * FROM sellers WHERE id = :seller_id";
$stmt = $pdo->prepare($query);
$stmt->bindParam(':seller_id', $seller_id);

if ($stmt->execute()) {
    $seller = $stmt->fetch(PDO::FETCH_ASSOC);
    if (!$seller) {
        // Handle the case where no seller data was found.
        die("Seller data not found.");
    }
} else {
    // Handle database query execution errors.
    die("Error fetching seller data: " . $stmt->errorInfo()[2]);
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Seller Dashboard</title>
    <!-- Add any CSS stylesheets or links here for styling -->
    <style>
        /* Add your custom styles here */
        .dashboard-links {
            list-style-type: none;
            padding: 0;
        }

        .dashboard-links li {
            margin-bottom: 10px;
        }

        .dashboard-links a {
            text-decoration: none;
            background-color: #4CAF50;
            color: #fff;
            padding: 10px 20px;
            border-radius: 5px;
        }

        .dashboard-links a:hover {
            background-color: #45a049;
        }
    </style>
</head>
<body>
    <h2>Welcome, <?php echo $seller['seller_name']; ?>!</h2>
    
    <!-- Display seller information (customize this as needed) -->
    <p>Email: <?php echo $seller['email']; ?></p>
    <p>Phone Number: <?php echo $seller['phone_number']; ?></p>

    <!-- Add more content or functionality to the dashboard as needed -->
    <ul class="dashboard-links">
        <li><a href="upload_car.php">Upload a Car</a></li>
        <li><a href="view_buyers.php">View Buyers</a></li>
        <!-- Additional dashboard links -->
        <li><a href="edit_profile.php">Edit Profile</a></li>
        <li><a href="change_password.php">Change Password</a></li>
        <li><a href="list_uploaded_cars.php">List Uploaded Cars</a></li>
        <li><a href="view_inquiries.php">View Inquiries</a></li>
        <li><a href="statistics.php">Statistics</a></li>
        <!-- End of additional dashboard links -->
    </ul>

    <p><a href="../logout.php">Logout</a></p>
</body>
</html>

<?php
session_start();

// Check if the seller is already logged in, redirect to the dashboard if so.
if (isset($_SESSION['seller_id'])) {
    header('Location: dashboard.php');
    exit();
}

$error_message = ""; // Initialize an empty error message.

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Include the database connection script.
    require_once('../db/dbconnect.php');

    $username = $_POST['username'];
    $password = $_POST['password'];

    // Query the database to retrieve the seller's information.
    $query = "SELECT * FROM sellers WHERE username = :username";
    $stmt = $pdo->prepare($query);
    $stmt->bindParam(':username', $username);
    $stmt->execute();
    $seller = $stmt->fetch(PDO::FETCH_ASSOC);

    // Check if a seller with the given username exists and the password is correct.
    if ($seller && password_verify($password, $seller['password'])) {
        // Store seller's ID in the session to mark them as logged in.
        $_SESSION['seller_id'] = $seller['id'];
        header('Location: dashboard.php');
        exit();
    } else {
        // Display an error message if login fails.
        $error_message = "Invalid username or password. Please try again.";
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Seller Login</title>
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css">
    <!-- Font Awesome CSS -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
    <!-- Custom CSS -->
    <link rel="stylesheet" href="css/style.css"> <!-- Adjust the path to your CSS file -->
</head>
<body>
    <div class="container mt-5">
        <div class="row">
            <div class="col-md-4 offset-md-4">
                <div class="card">
                    <div class="card-body">
                        <h3 class="card-title text-center">You have to login to sell</h3>
                        <form method="POST" action="login.php">
                            <div class="form-group">
                                <label for="username">Username:</label>
                                <input type="text" name="username" id="username" class="form-control" required>
                            </div>
                            <div class="form-group">
                                <label for="password">Password:</label>
                                <input type="password" name="password" id="password" class="form-control" required>
                            </div>
                            <button type="submit" class="btn btn-primary btn-block">Login</button>
                        </form>
                        <?php if (!empty($error_message)) : ?>
                            <p class="text-danger text-center mt-3"><?php echo $error_message; ?></p>
                        <?php endif; ?>
                        <p class="text-center mt-3">Not registered? <a href="register.php">Register here</a></p>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Include Bootstrap JavaScript (after jQuery) -->
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js"></script>
</body>
</html>

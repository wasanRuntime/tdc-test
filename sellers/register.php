<?php
session_start();

$success_message = ""; // Initialize an empty success message.
$error_message = "";   // Initialize an empty error message.

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Include the database connection script.
    require_once('../db/dbconnect.php');

    $seller_name = $_POST['seller_name'];
    $email = $_POST['email'];
    $phone_number = $_POST['phone_number'];
    $username = $_POST['username'];
    $password = $_POST['password'];

    // Hash the password before storing it in the database.
    $hashed_password = password_hash($password, PASSWORD_DEFAULT);

    // Insert seller information into the database.
    $query = "INSERT INTO sellers (seller_name, email, phone_number, username, password) VALUES (:seller_name, :email, :phone_number, :username, :password)";
    $stmt = $pdo->prepare($query);
    $stmt->bindParam(':seller_name', $seller_name);
    $stmt->bindParam(':email', $email);
    $stmt->bindParam(':phone_number', $phone_number);
    $stmt->bindParam(':username', $username);
    $stmt->bindParam(':password', $hashed_password);

    if ($stmt->execute()) {
        // Registration was successful, set the success message.
        $success_message = "Registration successful. You can now <a href='login.php'>login here</a>.";
    } else {
        // Display an error message if registration fails.
        $error_message = "Registration failed. Please try again.";
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Seller Registration</title>
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
                        <h3 class="card-title text-center">Seller Registration</h3>
                        <form method="POST" action="register.php">
                            <div class="form-group">
                                <label for="seller_name">Full Name:</label>
                                <input type="text" name="seller_name" id="seller_name" class="form-control" required>
                            </div>
                            <div class="form-group">
                                <label for="email">Email:</label>
                                <input type="email" name="email" id="email" class="form-control" required>
                            </div>
                            <div class="form-group">
                                <label for="phone_number">Phone Number:</label>
                                <input type="text" name="phone_number" id="phone_number" class="form-control" required>
                            </div>
                            <div class="form-group">
                                <label for="username">Username:</label>
                                <input type="text" name="username" id="username" class="form-control" required>
                            </div>
                            <div class="form-group">
                                <label for="password">Password:</label>
                                <input type="password" name="password" id="password" class="form-control" required>
                            </div>
                            <button type="submit" class="btn btn-primary btn-block">Register</button>
                        </form>
                        <?php if (!empty($success_message)) : ?>
                            <p class="text-success text-center mt-3"><?php echo $success_message; ?></p>
                        <?php endif; ?>
                        <?php if (!empty($error_message)) : ?>
                            <p class="text-danger text-center mt-3"><?php echo $error_message; ?></p>
                        <?php endif; ?>
                        <p class="text-center mt-3">Already have an account? <a href="login.php">Login here</a></p>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Include Bootstrap JavaScript (after jQuery) -->
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js"></script>
</body>
</html>

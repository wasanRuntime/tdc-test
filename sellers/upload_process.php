<?php
session_start(); // Start the session

// Include the database connection script
require_once('../db/dbconnect.php');

// Check if the form was submitted
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Retrieve form data
    $make = $_POST['make'];
    $model = $_POST['model'];
    $year_of_manufacture = $_POST['year_of_manufacture'];
    $transmission = $_POST['transmission'];
    $mileage = $_POST['mileage'];
    $price = $_POST['price'];

    // File upload handling
    if (isset($_FILES['car_image'])) {
        $file_count = count($_FILES['car_image']['name']);
        $upload_success = true;
        $image_paths = array(); // Array to store image paths

        if ($file_count >= 3 && $file_count <= 5) {
            $upload_dir = 'uploads/';

            for ($i = 0; $i < $file_count; $i++) {
                $file_name = $_FILES['car_image']['name'][$i];
                $file_tmp = $_FILES['car_image']['tmp_name'][$i];
                $file_type = $_FILES['car_image']['type'][$i];

                // Check if the uploaded file is an image
                $allowed_types = array('image/jpeg', 'image/png', 'image/gif');
                if (in_array($file_type, $allowed_types)) {
                    $upload_path = $upload_dir . $file_name;

                    // Move the uploaded file to the specified directory
                    if (move_uploaded_file($file_tmp, $upload_path)) {
                        // Add the image path to the array
                        $image_paths[] = $upload_path;
                    } else {
                        $upload_success = false;
                        break;
                    }
                } else {
                    $upload_success = false;
                    break;
                }
            }

            if ($upload_success) {
                // Get the seller_id from the session
                if (isset($_SESSION['seller_id'])) {
                    $seller_id = $_SESSION['seller_id'];

                    // Insert car information into the database
                    $query = "INSERT INTO car_makes (seller_id, make, model, year_of_manufacture, transmission, mileage, price, car_image_path, car_image_path_1, car_image_path_2, car_image_path_3, car_image_path_4) VALUES (:seller_id, :make, :model, :year_of_manufacture, :transmission, :mileage, :price, :car_image_path, :car_image_path_1, :car_image_path_2, :car_image_path_3, :car_image_path_4)";
                    $stmt = $pdo->prepare($query);

                    $stmt->bindParam(':seller_id', $seller_id);
                    $stmt->bindParam(':make', $make);
                    $stmt->bindParam(':model', $model);
                    $stmt->bindParam(':year_of_manufacture', $year_of_manufacture);
                    $stmt->bindParam(':transmission', $transmission);
                    $stmt->bindParam(':mileage', $mileage);
                    $stmt->bindParam(':price', $price);
                    $stmt->bindParam(':car_image_path', $image_paths[0]);
                    $stmt->bindParam(':car_image_path_1', $image_paths[1]);
                    $stmt->bindParam(':car_image_path_2', $image_paths[2]);
                    $stmt->bindParam(':car_image_path_3', $image_paths[3]);
                    $stmt->bindParam(':car_image_path_4', $image_paths[4]);

                    if ($stmt->execute()) {
                        // Redirect to a success page or display a success message
                        header('Location: upload_success.php');
                        exit();
                    } else {
                        // Handle database insertion error
                        echo "Error inserting car information into the database.";
                    }
                } else {
                    // Handle the case where the seller is not logged in
                    echo "Seller is not logged in.";
                }
            } else {
                // Handle file upload error
                echo "Error uploading car images. Please make sure they are valid image files.";
            }
        } else {
            // Handle the case where the number of images is not within the allowed range
            echo "You can only upload between 3 and 5 car images.";
        }
    } else {
        // Handle missing file error
        echo "Car image files are missing.";
    }
} else {
    // Handle invalid form submission error
    echo "Invalid form submission.";
}
?>

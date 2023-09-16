<!DOCTYPE html>
<html>
<head>
    <title>Upload Car</title>
</head>
<body>
    <h2>Upload Car Information</h2>
    <form action="upload_process.php" method="post" enctype="multipart/form-data">
        <label for="make">Car Make:</label>
        <input type="text" id="make" name="make" required><br><br>

        <label for="model">Car Model:</label>
        <input type="text" id="model" name="model" required><br><br>

        <label for="year_of_manufacture">Year of Manufacture:</label>
        <input type="number" id="year_of_manufacture" name="year_of_manufacture" required><br><br>

        <label for="transmission">Transmission:</label>
        <select id="transmission" name="transmission" required>
            <option value="automatic">Automatic</option>
            <option value="manual">Manual</option>
        </select><br><br>

        <label for="mileage">Mileage (in kilometers):</label>
        <input type="number" id="mileage" name="mileage" required><br><br>

        <label for="price">Price:</label>
        <input type="text" id="price" name="price" required><br><br>

        <label for="car_image">Car Images (Up to 5):</label>
        <input type="file" id="car_image[]" name="car_image[]" accept="image/*" multiple required><br><br>

        <input type="submit" value="Upload Car">
    </form>
</body>
</html>

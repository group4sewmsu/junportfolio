<?php
// Include database connection
include_once 'db_connection.php';

// Create (Insert) operation
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['upload_image'])) {
    // Check if file was uploaded without errors
    if (isset($_FILES["header_image"]) && $_FILES["header_image"]["error"] == 0) {
        // Retrieve file details
        $image_data = file_get_contents($_FILES['header_image']['tmp_name']);
        $image_type = $_FILES['header_image']['type'];

        // SQL query to insert image data into database
        $sql_insert = "INSERT INTO images (image_data, image_type) VALUES ('$image_data', '$image_type')";

        // Execute SQL query
        if ($conn->query($sql_insert) === TRUE) {
            echo "Image uploaded successfully.";
        } else {
            echo "Error: " . $sql_insert . "<br>" . $conn->error;
        }
    } else {
        echo "Error uploading image.";
    }
}

// Read (Select) operation
// Retrieve the latest uploaded image
$sql_select = "SELECT image_data, image_type FROM images ORDER BY id DESC LIMIT 1";
$result = $conn->query($sql_select);

// Check if there are rows returned
if ($result->num_rows > 0) {
    $row = $result->fetch_assoc();
    $imageData = $row['image_data'];
    $imageType = $row['image_type'];
    $base64 = base64_encode($imageData);
    $src = "data:image/" . $imageType . ";base64," . $base64;
    echo "<img src='$src' alt='Header Image'><br>";
} else {
    echo "<h3>No image uploaded yet.</h3>";
}

// Close the database connection
$conn->close();
?>

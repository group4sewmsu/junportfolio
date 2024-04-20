<?php
include_once("db_connection.php");

// Read
$sql = "SELECT * FROM images";
$result = $conn->query($sql);
$images = [];

if ($result->num_rows > 0) {
    while($row = $result->fetch_assoc()) {
        $images[] = $row;
    }
}

// Update, Insert, Delete - Similar to other CRUD operations

?>

<!-- Display existing images -->
<?php foreach ($images as $image) : ?>
    <div>
        <!-- Display image -->
        <img src="<?php echo $image['image_data']; ?>" alt="Image">
        <!-- Include edit and delete buttons -->
    </div>
<?php endforeach; ?>

<!-- Form for adding new image -->
<form action="images_crud.php" method="post" enctype="multipart/form-data">
    <input type="file" name="image_file">
    <button type="submit">Upload Image</button>
</form>

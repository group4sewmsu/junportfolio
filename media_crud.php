<?php
include_once("db_connection.php");

// Read
$sql = "SELECT * FROM media";
$result = $conn->query($sql);
$media = [];

if ($result->num_rows > 0) {
    while($row = $result->fetch_assoc()) {
        $media[] = $row;
    }
}

// Update, Insert, Delete - Similar to other CRUD operations

?>

<!-- Display existing media -->
<?php foreach ($media as $item) : ?>
    <div>
        <!-- Display media item -->
        <img src="<?php echo $item['media_data']; ?>" alt="Media">
        <!-- Include edit and delete buttons -->
    </div>
<?php endforeach; ?>

<!-- Form for adding new media -->
<form action="media_crud.php" method="post" enctype="multipart/form-data">
    <input type="file" name="media_file">
    <button type="submit">Upload Media</button>
</form>

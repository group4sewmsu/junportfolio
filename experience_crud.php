<?php
include_once("db_connection.php");

// Read
$sql = "SELECT * FROM experience";
$result = $conn->query($sql);
$experiences = [];

if ($result->num_rows > 0) {
    while($row = $result->fetch_assoc()) {
        $experiences[] = $row;
    }
}

// Update, Insert, Delete - Similar to other CRUD operations

?>

<!-- Display existing experiences -->
<?php foreach ($experiences as $experience) : ?>
    <div>
        <h3><?php echo $experience['position']; ?></h3>
        <p><?php echo $experience['company']; ?></p>
        <p><?php echo $experience['description']; ?></p>
        <!-- Include edit and delete buttons -->
    </div>
<?php endforeach; ?>

<!-- Form for adding new experience -->
<form action="experience_crud.php" method="post">
    <input type="text" name="position" placeholder="Position">
    <input type="text" name="company" placeholder="Company">
    <textarea name="description" placeholder="Description"></textarea>
    <button type="submit">Add Experience</button>
</form>

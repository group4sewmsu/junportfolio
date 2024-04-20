<?php
include_once("db_connection.php");

// Read
$sql = "SELECT * FROM languages";
$result = $conn->query($sql);
$languages = [];

if ($result->num_rows > 0) {
    while($row = $result->fetch_assoc()) {
        $languages[] = $row;
    }
}

// Update, Insert, Delete - Similar to other CRUD operations

?>

<!-- Display existing languages -->
<?php foreach ($languages as $language) : ?>
    <div>
        <h3><?php echo $language['language_name']; ?></h3>
        <!-- Include edit and delete buttons -->
    </div>
<?php endforeach; ?>

<!-- Form for adding new language -->
<form action="languages_crud.php" method="post">
    <input type="text" name="language_name" placeholder="Language Name">
    <button type="submit">Add Language</button>
</form>

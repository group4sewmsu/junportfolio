<?php
include_once("db_connection.php");

// Read
$sql = "SELECT * FROM projects";
$result = $conn->query($sql);
$projects = [];

if ($result->num_rows > 0) {
    while($row = $result->fetch_assoc()) {
        $projects[] = $row;
    }
}

// Update, Insert, Delete - Similar to other CRUD operations

?>

<!-- Display existing projects -->
<?php foreach ($projects as $project) : ?>
    <div>
        <h3><?php echo $project['title']; ?></h3>
        <p><?php echo $project['description']; ?></p>
        <!-- Include edit and delete buttons -->
    </div>
<?php endforeach; ?>

<!-- Form for adding new project -->
<form action="projects_crud.php" method="post">
    <input type="text" name="title" placeholder="Title">
    <textarea name="description" placeholder="Description"></textarea>
    <button type="submit">Add Project</button>
</form>

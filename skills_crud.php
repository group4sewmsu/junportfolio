<?php
include_once("db_connection.php");

// Read
$sql = "SELECT * FROM skills";
$result = $conn->query($sql);
$skills = [];

if ($result->num_rows > 0) {
    while($row = $result->fetch_assoc()) {
        $skills[] = $row;
    }
}

// Update, Insert, Delete - Similar to other CRUD operations

?>

<!-- Display existing skills -->
<?php foreach ($skills as $skill) : ?>
    <div>
        <h3><?php echo $skill['skill_name']; ?></h3>
        <!-- Include edit and delete buttons -->
    </div>
<?php endforeach; ?>

<!-- Form for adding new skill -->
<form action="skills_crud.php" method="post">
    <input type="text" name="skill_name" placeholder="Skill Name">
    <button type="submit">Add Skill</button>
</form>

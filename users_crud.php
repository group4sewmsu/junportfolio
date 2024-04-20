<?php
include_once("db_connection.php");

// Read
$sql = "SELECT * FROM users";
$result = $conn->query($sql);
$users = [];

if ($result->num_rows > 0) {
    while($row = $result->fetch_assoc()) {
        $users[] = $row;
    }
}

// Update, Insert, Delete - Similar to other CRUD operations

?>

<!-- Display existing users -->
<?php foreach ($users as $user) : ?>
    <div>
        <h3><?php echo $user['username']; ?></h3>
        <!-- Include edit and delete buttons -->
    </div>
<?php endforeach; ?>

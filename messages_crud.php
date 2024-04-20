<?php
include_once("db_connection.php");

// Read
$sql = "SELECT * FROM messages";
$result = $conn->query($sql);
$messages = [];

if ($result->num_rows > 0) {
    while($row = $result->fetch_assoc()) {
        $messages[] = $row;
    }
}

// Update, Insert, Delete - Similar to other CRUD operations

?>

<!-- Display existing messages -->
<?php foreach ($messages as $message) : ?>
    <div>
        <h3><?php echo $message['subject']; ?></h3>
        <p><?php echo $message['message']; ?></p>
        <!-- Include reply and delete buttons -->
    </div>
<?php endforeach; ?>

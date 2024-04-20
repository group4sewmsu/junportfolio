<?php
include_once("db_connection.php");

// Read
$sql = "SELECT * FROM about";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    $row = $result->fetch_assoc();
    $about_text = $row['about_text'];
} else {
    $about_text = '';
}

// Update
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $about_text = $_POST["about_text"];

    $sql = "UPDATE about SET about_text='$about_text' WHERE id=1"; // Assuming about id is 1

    if ($conn->query($sql) === TRUE) {
        echo "About information updated successfully";
    } else {
        echo "Error updating about information: " . $conn->error;
    }
}
?>

<form action="" method="post">
    <textarea name="about_text"><?php echo $about_text; ?></textarea>
    <button type="submit">Update</button>
</form>

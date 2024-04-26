<?php
include 'db_connection.php';

// Create
function addImage($image_data, $image_type) {
    global $conn;
    $stmt = $conn->prepare("INSERT INTO images (image_data, image_type) VALUES (?, ?)");
    $stmt->bind_param("sb", $image_data, $image_type);
    return $stmt->execute();
}

// Read
function getImages() {
    global $conn;
    $result = $conn->query("SELECT * FROM images");
    $images = [];
    while ($row = $result->fetch_assoc()) {
        $images[] = $row;
    }
    return $images;
}

// Delete
function deleteImage($id) {
    global $conn;
    $stmt = $conn->prepare("DELETE FROM images WHERE id = ?");
    $stmt->bind_param("i", $id);
    return $stmt->execute();
}
?>

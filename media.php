<?php
include 'db_connection.php';

// Create
function addMedia($media_data, $media_type) {
    global $conn;
    $stmt = $conn->prepare("INSERT INTO media (media_data, media_type) VALUES (?, ?)");
    $stmt->bind_param("sb", $media_data, $media_type);
    return $stmt->execute();
}

// Read
function getMedia() {
    global $conn;
    $result = $conn->query("SELECT * FROM media");
    $media = [];
    while ($row = $result->fetch_assoc()) {
        $media[] = $row;
    }
    return $media;
}

// Delete
function deleteMedia($id) {
    global $conn;
    $stmt = $conn->prepare("DELETE FROM media WHERE id = ?");
    $stmt->bind_param("i", $id);
    return $stmt->execute();
}
?>

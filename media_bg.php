<?php
include 'db_connection.php';

// Create
function addMediaBg($media_data, $media_type) {
    global $conn;
    $stmt = $conn->prepare("INSERT INTO media_bg (media_data, media_type) VALUES (?, ?)");
    $stmt->bind_param("sb", $media_data, $media_type);
    return $stmt->execute();
}

// Read
function getMediaBg() {
    global $conn;
    $result = $conn->query("SELECT * FROM media_bg");
    $media_bg = [];
    while ($row = $result->fetch_assoc()) {
        $media_bg[] = $row;
    }
    return $media_bg;
}

// Delete
function deleteMediaBg($id) {
    global $conn;
    $stmt = $conn->prepare("DELETE FROM media_bg WHERE id = ?");
    $stmt->bind_param("i", $id);
    return $stmt->execute();
}
?>

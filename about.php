<?php
include 'db_connection.php';

// Create
function addAbout($about_text) {
    global $conn;
    $stmt = $conn->prepare("INSERT INTO about (about_text) VALUES (?)");
    $stmt->bind_param("s", $about_text);
    return $stmt->execute();
}

// Read
function getAbout() {
    global $conn;
    $result = $conn->query("SELECT * FROM about");
    return $result->fetch_assoc();
}

// Update
function updateAbout($about_text) {
    global $conn;
    $stmt = $conn->prepare("UPDATE about SET about_text = ?");
    $stmt->bind_param("s", $about_text);
    return $stmt->execute();
}

// Delete
function deleteAbout() {
    global $conn;
    return $conn->query("DELETE FROM about");
}
?>

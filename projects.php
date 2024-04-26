<?php
include 'db_connection.php';

// Create
function addProject($title, $description, $image_data, $image_type) {
    global $conn;
    $stmt = $conn->prepare("INSERT INTO projects (title, description, image_data, image_type) VALUES (?, ?, ?, ?)");
    $stmt->bind_param("sssb", $title, $description, $image_data, $image_type);
    return $stmt->execute();
}

// Read
function getProjects() {
    global $conn;
    $result = $conn->query("SELECT * FROM projects");
    $projects = [];
    while ($row = $result->fetch_assoc()) {
        $projects[] = $row;
    }
    return $projects;
}

// Delete
function deleteProject($id) {
    global $conn;
    $stmt = $conn->prepare("DELETE FROM projects WHERE id = ?");
    $stmt->bind_param("i", $id);
    return $stmt->execute();
}
?>

<?php
include 'db_connection.php';

// Create
function addUser($username, $password) {
    global $conn;
    $stmt = $conn->prepare("INSERT INTO users (username, password) VALUES (?, ?)");
    $stmt->bind_param("ss", $username, $password);
    return $stmt->execute();
}

// Read
function getUsers() {
    global $conn;
    $result = $conn->query("SELECT * FROM users");
    $users = [];
    while ($row = $result->fetch_assoc()) {
        $users[] = $row;
    }
    return $users;
}

// Delete
function deleteUser($id) {
    global $conn;
    $stmt = $conn->prepare("DELETE FROM users WHERE id = ?");
    $stmt->bind_param("i", $id);
    return $stmt->execute();
}
?>

<?php
include 'db_connection.php';

// Create
function addMessage($name, $email, $subject, $message) {
    global $conn;
    $stmt = $conn->prepare("INSERT INTO messages (name, email, subject, message) VALUES (?, ?, ?, ?)");
    $stmt->bind_param("ssss", $name, $email, $subject, $message);
    return $stmt->execute();
}

// Read
function getMessages() {
    global $conn;
    $result = $conn->query("SELECT * FROM messages");
    $messages = [];
    while ($row = $result->fetch_assoc()) {
        $messages[] = $row;
    }
    return $messages;
}

// Delete
function deleteMessage($id) {
    global $conn;
    $stmt = $conn->prepare("DELETE FROM messages WHERE id = ?");
    $stmt->bind_param("i", $id);
    return $stmt->execute();
}
?>

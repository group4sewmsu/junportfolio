<?php
include 'db_connection.php';

// Create
function addLanguage($language_name) {
    global $conn;
    $stmt = $conn->prepare("INSERT INTO languages (language_name) VALUES (?)");
    $stmt->bind_param("s", $language_name);
    return $stmt->execute();
}

// Read
function getLanguages() {
    global $conn;
    $result = $conn->query("SELECT * FROM languages");
    $languages = [];
    while ($row = $result->fetch_assoc()) {
        $languages[] = $row;
    }
    return $languages;
}

// Delete
function deleteLanguage($id) {
    global $conn;
    $stmt = $conn->prepare("DELETE FROM languages WHERE id = ?");
    $stmt->bind_param("i", $id);
    return $stmt->execute();
}
?>

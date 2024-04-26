<?php
include 'db_connection.php';

// Create
function addSkill($skill_name) {
    global $conn;
    $stmt = $conn->prepare("INSERT INTO skills (skill_name) VALUES (?)");
    $stmt->bind_param("s", $skill_name);
    return $stmt->execute();
}

// Read
function getSkills() {
    global $conn;
    $result = $conn->query("SELECT * FROM skills");
    $skills = [];
    while ($row = $result->fetch_assoc()) {
        $skills[] = $row;
    }
    return $skills;
}

// Delete
function deleteSkill($id) {
    global $conn;
    $stmt = $conn->prepare("DELETE FROM skills WHERE id = ?");
    $stmt->bind_param("i", $id);
    return $stmt->execute();
}
?>

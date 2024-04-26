<?php
include 'db_connection.php';

// Create
function addExperience($start_date, $end_date, $position, $company, $description) {
    global $conn;
    $stmt = $conn->prepare("INSERT INTO experience (start_date, end_date, position, company, description) VALUES (?, ?, ?, ?, ?)");
    $stmt->bind_param("sssss", $start_date, $end_date, $position, $company, $description);
    return $stmt->execute();
}

// Read
function getExperience() {
    global $conn;
    $result = $conn->query("SELECT * FROM experience");
    $experiences = [];
    while ($row = $result->fetch_assoc()) {
        $experiences[] = $row;
    }
    return $experiences;
}

// Update
function updateExperience($id, $start_date, $end_date, $position, $company, $description) {
    global $conn;
    $stmt = $conn->prepare("UPDATE experience SET start_date = ?, end_date = ?, position = ?, company = ?, description = ? WHERE id = ?");
    $stmt->bind_param("sssssi", $start_date, $end_date, $position, $company, $description, $id);
    return $stmt->execute();
}

// Delete
function deleteExperience($id) {
    global $conn;
    $stmt = $conn->prepare("DELETE FROM experience WHERE id = ?");
    $stmt->bind_param("i", $id);
    return $stmt->execute();
}
?>

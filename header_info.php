<?php
include 'db_connection.php';

// Create
function addHeaderInfo($name, $job_title, $linkedin_link, $facebook_link, $messenger_link, $telegram_link, $whatsapp_link, $github_link) {
    global $conn;
    $stmt = $conn->prepare("INSERT INTO header_info (name, job_title, linkedin_link, facebook_link, messenger_link, telegram_link, whatsapp_link, github_link) VALUES (?, ?, ?, ?, ?, ?, ?, ?)");
    $stmt->bind_param("ssssssss", $name, $job_title, $linkedin_link, $facebook_link, $messenger_link, $telegram_link, $whatsapp_link, $github_link);
    return $stmt->execute();
}

// Read
function getHeaderInfo() {
    global $conn;
    $result = $conn->query("SELECT * FROM header_info");
    return $result->fetch_assoc();
}

// Update
function updateHeaderInfo($name, $job_title, $linkedin_link, $facebook_link, $messenger_link, $telegram_link, $whatsapp_link, $github_link) {
    global $conn;
    $stmt = $conn->prepare("UPDATE header_info SET name = ?, job_title = ?, linkedin_link = ?, facebook_link = ?, messenger_link = ?, telegram_link = ?, whatsapp_link = ?, github_link = ?");
    $stmt->bind_param("ssssssss", $name, $job_title, $linkedin_link, $facebook_link, $messenger_link, $telegram_link, $whatsapp_link, $github_link);
    return $stmt->execute();
}

// Delete
function deleteHeaderInfo() {
    global $conn;
    return $conn->query("DELETE FROM header_info");
}
?>

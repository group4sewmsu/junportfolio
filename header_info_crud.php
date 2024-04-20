<?php
include_once("db_connection.php");

// Read
function getHeaderInfo($conn) {
    $sql = "SELECT * FROM header_info";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        return $result->fetch_assoc();
    } else {
        return false;
    }
}

// Update
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = $_POST["name"];
    $job_title = $_POST["job_title"];
    $linkedin_link = $_POST["linkedin_link"];
    $facebook_link = $_POST["facebook_link"];
    $messenger_link = $_POST["messenger_link"];
    $telegram_link = $_POST["telegram_link"];
    $whatsapp_link = $_POST["whatsapp_link"];
    $github_link = $_POST["github_link"];

    $sql = "UPDATE header_info SET 
                name='$name', 
                job_title='$job_title',
                linkedin_link='$linkedin_link',
                facebook_link='$facebook_link',
                messenger_link='$messenger_link',
                telegram_link='$telegram_link',
                whatsapp_link='$whatsapp_link',
                github_link='$github_link'
            WHERE id=1"; // Assuming header_info id is 1

    if ($conn->query($sql) === TRUE) {
        echo "Header information updated successfully";
    } else {
        echo "Error updating header information: " . $conn->error;
    }
}
?>

<form action="" method="post">
    <?php $headerInfo = getHeaderInfo($conn); ?>
    <input type="text" name="name" value="<?php echo $headerInfo['name']; ?>" placeholder="Name">
    <input type="text" name="job_title" value="<?php echo $headerInfo['job_title']; ?>" placeholder="Job Title">
    <input type="text" name="linkedin_link" value="<?php echo $headerInfo['linkedin_link']; ?>" placeholder="LinkedIn Link">
    <input type="text" name="facebook_link" value="<?php echo $headerInfo['facebook_link']; ?>" placeholder="Facebook Link">
    <input type="text" name="messenger_link" value="<?php echo $headerInfo['messenger_link']; ?>" placeholder="Messenger Link">
    <input type="text" name="telegram_link" value="<?php echo $headerInfo['telegram_link']; ?>" placeholder="Telegram Link">
    <input type="text" name="whatsapp_link" value="<?php echo $headerInfo['whatsapp_link']; ?>" placeholder="WhatsApp Link">
    <input type="text" name="github_link" value="<?php echo $headerInfo['github_link']; ?>" placeholder="GitHub Link">
    <button type="submit">Update</button>
</form>

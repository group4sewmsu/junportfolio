<?php
include_once 'connection.php';
session_start(); // Start session

// Check if user is logged in
if (!isset($_SESSION['loggedin']) || $_SESSION['loggedin'] !== true) {
    // Redirect user to login page if not logged in
    header("Location: login.php");
    exit;
}

// Logout logic
if (isset($_POST['logout'])) {
    // Unset all session variables
    $_SESSION = array();

    // Destroy the session
    session_destroy();

    // Redirect to login page
    header("Location: index.php");
    exit;
}
?>

<!DOCTYPE html>
<html lang="en">

  <head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>AdminPanel</title>
    <link rel="icon" type="image/x-icon" href="/img/JunJutsu3x3.png">
    <link rel="stylesheet" href="style.css">
  </head>

  <body>
    <!--=============== FONT AWESOME ===============-->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.1/css/all.min.css" />

    <nav id="navbar" class="navbar"><a href="#"></a></nav>

    <div class="container">
      <!--=============== NAVIGATION MENU ===============-->
      <div class="menu">
        <!-- Navigation links for different sections -->
        <a href="#header-info" class="menu-icon fa-solid fa-address-card"></a>
        <a href="#about" class="menu-icon fa-solid fa-user"></a>
        <a href="#experiences" class="menu-icon fa-solid fa-briefcase"></a>
        <a href="#projects" class="menu-icon fa-solid fa-project-diagram"></a>
        <a href="#skills" class="menu-icon fa-solid fa-cogs"></a>
        <a href="#languages" class="menu-icon fa-solid fa-language"></a>
        <a href="#media" class="menu-icon fa-solid fa-photo-video"></a>
        <a href="#messages" class="menu-icon fa-solid fa-envelope"></a>
        <a href="#users" class="menu-icon fa-solid fa-users"></a>
        <a href="#images" class="menu-icon fa-solid fa-images"></a>
        <a href="$_POST['logout']" class="menu-icon fa-solid fa-person-running"></a>
    </div>
    
</body>

</html>

<?php
// Close the database connection after all queries are executed
$conn->close();
?>

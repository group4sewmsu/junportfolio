<?php
include_once("db_connection.php");

// Start the session
session_start();

// Check if the user is logged in
if(!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true){
    header("location: login.php");
    exit;
}

// Display the dashboard content
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
            <a href="#logout" class="menu-icon fa-solid fa-person-running"></a>
        </div>

        <!-- Portfolio -->
<div class="portfolio">
    <!-- Header Information Section -->
    <section class="content-card header-info" id="header-info">
        <?php include_once('header_info_crud.php'); ?>
    </section>

    <!-- About Section -->
    <section class="content-card about" id="about">
        <?php include_once('about_crud.php'); ?>
    </section>

    <!-- Experiences & Projects -->
    <div class="row">
        <!-- Experiences Section -->
        <section class="content-card experiences" id="experiences">
            <?php include_once('experience_crud.php'); ?>
        </section>

        <!-- Projects Section -->
        <section class="content-card projects" id="projects">
            <?php include_once('projects_crud.php'); ?>
        </section>
    </div>

    <!-- Skills & Languages -->
    <div class="row">
        <!-- Skills Section -->
        <section class="content-card skills" id="skills">
            <?php include_once('skills_crud.php'); ?>
        </section>

        <!-- Languages Section -->
        <section class="content-card languages" id="languages">
            <?php include_once('languages_crud.php'); ?>
        </section>
    </div>

    <!-- Media & Messages -->
    <div class="row">
        <!-- Media Section -->
        <section class="content-card media" id="media">
            <?php include_once('media_crud.php'); ?>
        </section>

        <!-- Messages Section -->
        <section class="content-card messages" id="messages">
            <?php include_once('messages_crud.php'); ?>
        </section>
    </div>

    <!-- Users & Images -->
    <div class="row">
        <!-- Users Section -->
        <section class="content-card users" id="users">
            <?php include_once('users_crud.php'); ?>
        </section>

        <!-- Images Section -->
        <section class="content-card images" id="images">
            <?php include_once('images_crud.php'); ?>
        </section>
    </div>
</div>


    <!-- Footer -->
    <footer>
        <!-- Footer content -->
    </footer>

</body>

</html>

<?php
// Close the database connection after all queries are executed
$conn->close();
?>

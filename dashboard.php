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

// Fetch header information
$sql_header = "SELECT * FROM header_info"; 
$result_header = mysqli_query($conn, $sql_header);
if(mysqli_num_rows($result_header) > 0) {
    $row_header = mysqli_fetch_assoc($result_header);
    $name = $row_header['name'];
    $job_title = $row_header['job_title'];
}

// Fetch about section
$sql_about = "SELECT * FROM about";
$result_about = mysqli_query($conn, $sql_about);
if ($row_about = mysqli_fetch_assoc($result_about)) {
    $about_text = $row_about['about_text'];
} else {
    $about_text = "Default about if no description is found in the database.";
}

// Fetch experiences
$sql_experiences = "SELECT * FROM experience";
$result_experiences = mysqli_query($conn, $sql_experiences);

// Fetch projects
$sql_projects = "SELECT * FROM projects";
$result_projects = mysqli_query($conn, $sql_projects);

// Fetch skills
$sql_skills = "SELECT * FROM skills";
$result_skills = mysqli_query($conn, $sql_skills);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard</title>
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <!-- Bootstrap JS -->
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <!-- Custom CSS -->
    <link rel="stylesheet" href="styles.css">
</head>
<body>
<div class="container">
    <h2>Dashboard</h2>
    <?php if(isset($error_message)) { ?>
        <p class="error"><?php echo $error_message; ?></p>
    <?php } ?>

    <!-- Header Information -->
    <div class="card">
        <div class="card-header">
            Header Information
        </div>
        <div class="card-body">
            <p><strong>Name:</strong> <?php echo $name; ?></p>
            <p><strong>Job Title:</strong> <?php echo $job_title; ?></p>
        </div>
    </div>

    <!-- About Section -->
    <div class="card">
        <div class="card-header">
            About Section
        </div>
        <div class="card-body">
            <p><?php echo $about_text; ?></p>
            <button class="btn btn-primary" data-toggle="modal" data-target="#aboutModal">Edit About</button>
        </div>
    </div>

    <!-- Experiences -->
    <div class="card">
        <div class="card-header">
            Experiences
        </div>
        <div class="card-body">
            <ul>
                <?php while($row_experience = mysqli_fetch_assoc($result_experiences)) { ?>
                    <li>
                        <p><strong><?php echo $row_experience['position']; ?></strong> at <?php echo $row_experience['company']; ?></p>
                        <p><?php echo $row_experience['description']; ?></p>
                    </li>
                <?php } ?>
            </ul>
        </div>
    </div>

    <!-- Projects -->
    <div class="card">
        <div class="card-header">
            Projects
        </div>
        <div class="card-body">
            <ul>
                <?php while($row_project = mysqli_fetch_assoc($result_projects)) { ?>
                    <li>
                        <p><strong><?php echo $row_project['title']; ?></strong></p>
                        <p><?php echo $row_project['description']; ?></p>
                    </li>
                <?php } ?>
            </ul>
        </div>
    </div>

    <!-- Skills -->
    <div class="card">
        <div class="card-header">
            Skills
        </div>
        <div class="card-body">
            <ul>
                <?php while($row_skill = mysqli_fetch_assoc($result_skills)) { ?>
                    <li><?php echo $row_skill['skill_name']; ?></li>
                <?php } ?>
            </ul>
        </div>
    </div>

    <!-- Edit About Modal -->
    <div id="aboutModal" class="modal fade">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Edit About</h5>
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                </div>
                <div class="modal-body">
                    <form id="editAboutForm" method="post">
                        <div class="form-group">
                            <label for="aboutTextarea">About:</label>
                            <textarea class="form-control" id="aboutTextarea" rows="5"><?php echo $about_text; ?></textarea>
                        </div>
                        <button type="submit" class="btn btn-primary">Update</button>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <!-- Logout Button -->
    <form method="post" action="">
        <div class="form-group mt-3">
            <button type="submit" name="logout" class="btn btn-danger">Logout</button>
        </div>
    </form>
</div>

<!-- Custom script for handling About Section editing -->
<script>
    $(document).ready(function() {
        $("#editAboutForm").submit(function(event) {
            event.preventDefault();
            var aboutText = $("#aboutTextarea").val();
            // Send AJAX request to update about section
            $.ajax({
                url: "update_about.php", // Update this with your PHP script to handle the update
                type: "POST",
                data: { about_text: aboutText },
                success: function(response) {
                    alert(response); // Display success or error message
                    // You can also update the about section on the page without refreshing
                }
            });
        });
    });
</script>

</body>
</html>

<?php
include_once 'db_connection.php';
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

// Functions for managing the 'about' table

// Add functionality to add data to the 'about' table
function addAbout($about_text) {
    global $conn;
    $stmt = $conn->prepare("INSERT INTO about (about_text) VALUES (?)");
    $stmt->bind_param("s", $about_text);
    return $stmt->execute();
}

// Read functionality to fetch data from the 'about' table
function getAbout() {
    global $conn;
    $result = $conn->query("SELECT * FROM about");
    return ($result->num_rows > 0) ? $result->fetch_assoc() : null;
}

// Update functionality to modify data in the 'about' table
function updateAbout($about_text) {
    global $conn;
    $stmt = $conn->prepare("UPDATE about SET about_text = ?");
    $stmt->bind_param("s", $about_text);
    return $stmt->execute();
}

// Functions for managing the 'experience' table

// Add functionality to add data to the 'experience' table
function addExperience($start_date, $end_date, $position, $company, $description) {
    global $conn;
    $stmt = $conn->prepare("INSERT INTO experience (start_date, end_date, position, company, description) VALUES (?, ?, ?, ?, ?)");
    $stmt->bind_param("sssss", $start_date, $end_date, $position, $company, $description);
    return $stmt->execute();
}

// Read functionality to fetch data from the 'experience' table
function getExperience() {
    global $conn;
    $result = $conn->query("SELECT * FROM experience");
    $experience = array();
    while ($row = $result->fetch_assoc()) {
        $experience[] = $row;
    }
    return $experience;
}

// Update functionality to modify data in the 'experience' table
function updateExperience($id, $start_date, $end_date, $position, $company, $description) {
    global $conn;
    $stmt = $conn->prepare("UPDATE experience SET start_date = ?, end_date = ?, position = ?, company = ?, description = ? WHERE id = ?");
    $stmt->bind_param("sssssi", $start_date, $end_date, $position, $company, $description, $id);
    return $stmt->execute();
}

// Functions for managing the 'header_info' table

// Read functionality to fetch data from the 'header_info' table
function getHeaderInfo() {
    global $conn;
    $result = $conn->query("SELECT * FROM header_info");
    return ($result->num_rows > 0) ? $result->fetch_assoc() : null;
}

// Update functionality to modify data in the 'header_info' table
function updateHeaderInfo($name, $job_title, $linkedin_link, $facebook_link, $messenger_link, $telegram_link, $whatsapp_link, $github_link) {
    global $conn;
    $stmt = $conn->prepare("UPDATE header_info SET name = ?, job_title = ?, linkedin_link = ?, facebook_link = ?, messenger_link = ?, telegram_link = ?, whatsapp_link = ?, github_link = ?");
    $stmt->bind_param("ssssssss", $name, $job_title, $linkedin_link, $facebook_link, $messenger_link, $telegram_link, $whatsapp_link, $github_link);
    return $stmt->execute();
}

// Functions for managing the 'images' table

// Add functionality to add image data to the 'images' table
function addImages($image_data, $image_type) {
  global $conn;
  $stmt = $conn->prepare("INSERT INTO images (image_data, image_type) VALUES (?, ?)");
  $stmt->bind_param("ss", $image_data, $image_type);
  return $stmt->execute();
}

// Read functionality to fetch image data from the 'images' table
function getImages() {
  global $conn;
  $result = $conn->query("SELECT * FROM images");
  return ($result->num_rows > 0) ? $result->fetch_assoc() : null;
}

// Update functionality to modify image data in the 'images' table
function updateImages($image_data, $image_type) {
  global $conn;
  $stmt = $conn->prepare("UPDATE images SET image_data = ?, image_type = ?");
  $stmt->bind_param("ss", $image_data, $image_type);
  return $stmt->execute();
}

// Functions for managing the 'project' table

// Add functionality to add data to the 'project' table
function addProject($project_name, $project_description, $project_link) {
    global $conn;
    $stmt = $conn->prepare("INSERT INTO project (project_name, project_description, project_link) VALUES (?, ?, ?)");
    $stmt->bind_param("sss", $project_name, $project_description, $project_link);
    return $stmt->execute();
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>JunPortfolio</title>
    <link rel="icon" type="image/x-icon" href="/img/JunJutsu3x3.png">
    <link rel="stylesheet" href="style.css">
</head>

<body>

    <!-- PHP code for background media -->
    <?php
    // Retrieve the latest uploaded media
    $sql = "SELECT media_data, media_type FROM media_bg ORDER BY id DESC LIMIT 1";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        $mediaData = $row['media_data'];
        $mediaType = $row['media_type'];
        $base64 = base64_encode($mediaData);
        $src = "data:image/gif;base64," . $base64; // Specify image/gif as media type
        echo "<div class='background-media' style='background-image: url($src);'></div>"; // Div for background media
    }
    ?>

    <!--=============== FONT AWESOME ===============-->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.1/css/all.min.css" />

    <nav id="navbar" class="navbar"><a href="#"></a></nav>

    <div class="container">
        <!--=============== NAVIGATION MENU ===============-->

        <div class="menu">
            <a href="#welcome-section" class="menu-icon fa-solid fa-house"></a>
            <a href="#about" class="menu-icon fa-solid fa-user"></a>
            <a href="#projects" class="menu-icon fa-solid fa-code"></a>
            <a href="#experience" class="menu-icon fa-solid fa-briefcase"></a>
            <form method="post">
                <button type="submit" name="logout" class="menu-icon fa-solid fa-right-from-bracket"></button>
            </form>
        </div>

        <!--=============== MAIN "WINDOW" ===============-->

        <!--=============== CONTENT SECTION ===============-->

        <div class="content">
            <!--=============== HOME ===============-->

            <section class="content-card home" id="welcome-section">

                <h1>
                    <!-- Header info here -->
                    <?php
                    $headerInfo = getHeaderInfo();
                    if ($headerInfo !== null) {
                        echo "<span>{$headerInfo['name']}</span>";
                        echo "<p>{$headerInfo['job_title']}</p>";
                    }
                    ?>
                </h1>
                <form action="admin.php" method="post">
                    <input type="text" name="name" placeholder="Name" value="<?php echo $headerInfo['name'] ?? ''; ?>">
                    <input type="text" name="job_title" placeholder="Job Title" value="<?php echo $headerInfo['job_title'] ?? ''; ?>">
                    <input type="text" name="linkedin_link" placeholder="LinkedIn Link" value="<?php echo $headerInfo['linkedin_link'] ?? ''; ?>">
                    <input type="text" name="facebook_link" placeholder="Facebook Link" value="<?php echo $headerInfo['facebook_link'] ?? ''; ?>">
                    <input type="text" name="messenger_link" placeholder="Messenger Link" value="<?php echo $headerInfo['messenger_link'] ?? ''; ?>">
                    <input type="text" name="telegram_link" placeholder="Telegram Link" value="<?php echo $headerInfo['telegram_link'] ?? ''; ?>">
                    <input type="text" name="whatsapp_link" placeholder="WhatsApp Link" value="<?php echo $headerInfo['whatsapp_link'] ?? ''; ?>">
                    <input type="text" name="github_link" placeholder="GitHub Link" value="<?php echo $headerInfo['github_link'] ?? ''; ?>">
                    <button type="submit" name="update_header_info">Update Header Info</button>
                </form>
            </section>

            <!--=============== ABOUT ME ===============-->

            <section class="content-card about" id="about">
              <h1>About Me</h1>
              <form action="admin.php" method="post">
                  <label for="about_text">About Text:</label><br>
                  <textarea name="about_text" id="about_text" cols="30" rows="5"><?php echo (getAbout() !== null) ? getAbout()['about_text'] : ''; ?></textarea><br>
                  <button type="submit" name="update_about">Update About</button>
              </form>

              <!-- Display existing about text -->
              <?php
              $about = getAbout();
              if ($about !== null) {
                  echo "<div class='about-text'>";
                  echo "<h3>About Text:</h3>";
                  echo "<p>" . $about['about_text'] . "</p>";
                  echo "</div>";
              } else {
                  echo "<p>No existing about text.</p>";
              }
              ?>
            </section>


            <!--=============== PROJECTS ===============-->

            <section class="content-card projects" id="projects">
                <h1>Projects</h1>
                <div class="col-2 project-list">
                    <!-- Button to add a new project -->
                    <button onclick="toggleAddProjectForm()">Add Project</button>
                </div>
                <a href="https://github.com/group4sewmsu">see more...</a>
            </section>

            <!-- Form to add a new project -->
            <div id="add-project-form" style="display: none;">
                <form action="admin.php" method="post">
                    <input type="text" name="project_name" placeholder="Project Name" required>
                    <textarea name="project_description" placeholder="Project Description" required></textarea>
                    <input type="text" name="project_link" placeholder="Project Link" required>
                    <button type="submit" name="add_project">Add Project</button>
                </form>
            </div>

            

            <!--=============== EXPERIENCE ===============-->

            <section class="content-card experience" id="experience">
                <h1>Experience</h1>
                <!-- Form to add new experience -->
                <form action="admin.php" method="post">
                    <input type="date" name="start_date" placeholder="Start Date" required>
                    <input type="date" name="end_date" placeholder="End Date" required>
                    <input type="text" name="position" placeholder="Position" required>
                    <input type="text" name="company" placeholder="Company" required>
                    <textarea name="description" placeholder="Description" required></textarea>
                    <button type="submit" name="add_experience">Add Experience</button>
                </form>

                <!-- Display existing experiences -->
                <?php
                $experiences = getExperience();
                foreach ($experiences as $experience) {
                    echo "<div class='timeline-item'>";
                    echo "<div class='timeline-date'>" . $experience['start_date'] . " - " . $experience['end_date'] . "</div>";
                    echo "<div class='timeline-content'>";
                    echo "<h3>" . $experience['position'] . "</h3>";
                    echo "<p>" . $experience['company'] . "</p>";
                    echo "<p>" . $experience['description'] . "</p>";
                    echo "</div>";
                    echo "</div>";
                }
                ?>
            </section>
             <!--=============== IMAGE ===============-->

             <section class="content-card image" id="image">
                <h1>Image</h1>
                <form action="admin.php" method="post" enctype="multipart/form-data">
                    <input type="file" name="image" accept="image/*" required>
                    <button type="submit" name="update_image">Update Image</button>
                </form>
            </section>

        </div>
    </div>

    <!-- JavaScript to toggle the add project form -->
    <script>
        function toggleAddProjectForm() {
            var x = document.getElementById("add-project-form");
            if (x.style.display === "none") {
                x.style.display = "block";
            } else {
                x.style.display = "none";
            }
        }
    </script>

</body>

</html>

<?php
// Handle form submissions for updating records

// Update About
if (isset($_POST['update_about'])) {
    $about_text = $_POST['about_text'];
    updateAbout($about_text);
    header("Location: admin.php"); // Redirect to admin after updating
    exit();
}

// Add new experience
if (isset($_POST['add_experience'])) {
    $start_date = $_POST['start_date'];
    $end_date = $_POST['end_date'];
    $position = $_POST['position'];
    $company = $_POST['company'];
    $description = $_POST['description'];
    addExperience($start_date, $end_date, $position, $company, $description);
    header("Location: admin.php"); // Redirect to admin after adding
    exit();
}

// Update header info
if (isset($_POST['update_header_info'])) {
    $name = $_POST['name'];
    $job_title = $_POST['job_title'];
    $linkedin_link = $_POST['linkedin_link'];
    $facebook_link = $_POST['facebook_link'];
    $messenger_link = $_POST['messenger_link'];
    $telegram_link = $_POST['telegram_link'];
    $whatsapp_link = $_POST['whatsapp_link'];
    $github_link = $_POST['github_link'];
    updateHeaderInfo($name, $job_title, $linkedin_link, $facebook_link, $messenger_link, $telegram_link, $whatsapp_link, $github_link);
    header("Location: admin.php"); // Redirect to admin after updating
    exit();
}

// Handle form submission for updating image
if (isset($_POST['update_image'])) {
  if (isset($_FILES['image'])) {
      $image_data = file_get_contents($_FILES['image']['tmp_name']);
      $image_type = $_FILES['image']['type'];
      updateImages($image_data, $image_type);
      header("Location: admin.php"); // Redirect to admin after updating
      exit();
  }
}

// Handle form submission for adding a new project
if (isset($_POST['add_project'])) {
    $project_name = $_POST['project_name'];
    $project_description = $_POST['project_description'];
    $project_link = $_POST['project_link'];
    addProject($project_name, $project_description, $project_link);
    header("Location: admin.php"); // Redirect to admin after adding
    exit();
}

// Close the database connection
$conn->close();
?>

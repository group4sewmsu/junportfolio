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

                </h1>
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

                </div>
                <a href="https://github.com/group4sewmsu">see more...</a>
            </section>

            <!--=============== EXPERIENCE ===============-->

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

        </div>
    </div>
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
// Close the database connection
$conn->close();
?>

<?php
include_once 'db_connection.php';
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
        <a href="#contact" class="menu-icon fa-solid fa-envelope"></a>
        <a href="logout.php" class="menu-icon fa-solid fa-right-from-bracket"></a>
    </div>

      <!--=============== MAIN "WINDOW" ===============-->

      <div class="portfolio">
        <!--=============== HEADER SECTION ===============-->

        <section class="header">
          <img class="header-img">

          <?php
                    // Retrieve the latest uploaded image
                    $sql = "SELECT image_data, image_type FROM images ORDER BY id DESC LIMIT 1";
                    $result = $conn->query($sql);

                    if ($result->num_rows > 0) {
                        $row = $result->fetch_assoc();
                        $imageData = $row['image_data'];
                        $imageType = $row['image_type'];
                        $base64 = base64_encode($imageData);
                        $src = "data:image/" . $imageType . ";base64," . $base64;
                        echo "<img src='$src' '><br>";
                    } else {
                        echo "<h3>No image uploaded yet.</h3>";
                    }

                    ?>

          <h1>
                    <?php
                      // Fetch name
                      $name_sql = "SELECT name FROM header_info LIMIT 1";
                      $name_result = $conn->query($name_sql);
                      if ($name_result->num_rows > 0) {
                          $name_row = $name_result->fetch_assoc();
                          echo "<h1>" . $name_row['name'] . "</h1>";
                      } else {
                          echo "<p>No about information available.</p>";
                      }
                    ?>
          </h1>
          <h2>
                    <?php
                      // Fetch job_title
                      $job_title_sql = "SELECT job_title FROM header_info LIMIT 1";
                      $job_title_result = $conn->query($job_title_sql);
                      if ($job_title_result->num_rows > 0) {
                          $job_title_row = $job_title_result->fetch_assoc();
                          echo "<h2>" . $job_title_row['job_title'] . "</h2>";
                      } else {
                          echo "<p>No about information available.</p>";
                      }
                    ?>
          </h2>

          <?php
                        // Social Media Links
                        $sql = "SELECT linkedin_link, facebook_link, messenger_link, telegram_link, whatsapp_link, github_link FROM header_info";
                        $result = $conn->query($sql);
                        $social_links = $result->fetch_assoc(); // Fetch the social media links

                        // Output the HTML with the fetched social media links
                    ?>

          <div class="socials">
            <a href="<?php echo $social_links['linkedin_link']; ?>" target="_blank" class="fab fa-linkedin-in"></a>
            <a href="<?php echo $social_links['facebook_link']; ?>" target="_blank" class="fab fa-facebook"></a>
            <a href="<?php echo $social_links['messenger_link']; ?>" target="_blank" class="fab fa-facebook-messenger"></a>
            <a href="<?php echo $social_links['telegram_link']; ?>" target="_blank" class="fab fa-telegram"></a>
            <a href="<?php echo $social_links['whatsapp_link']; ?>" target="_blank" class="fab fa-whatsapp"></a>
            <a href="<?php echo $social_links['github_link']; ?>" target="_blank" class="fab fa-github"></a>
          </div>


          <a href="" class="cta">Download CV</a>
        </section>

        <!--=============== CONTENT SECTION ===============-->

        <div class="content">
          <!--=============== HOME ===============-->

          <section class="content-card home" id="welcome-section">
            <h1>

              <?php
                                // Retrieve the latest uploaded media
                                $sql = "SELECT media_data, media_type FROM media ORDER BY id DESC LIMIT 1";
                                $result = $conn->query($sql);

                                if ($result->num_rows > 0) {
                                    $row = $result->fetch_assoc();
                                    $mediaData = $row['media_data'];
                                    $mediaType = $row['media_type'];
                                    $base64 = base64_encode($mediaData);
                                    $src = "data:gif$mediaType;base64," . $base64;
                                    echo "<media src='$src'><br>";
                                } else {
                                    echo "<h3>No media uploaded yet.</h3>";
                                }
                            ?>

            </h1>
          </section>

          <!--=============== ABOUT ME ===============-->

          <section class="content-card about" id="about">
            <h1>About me</h1>
            <div class="about-item about-me">
                    <?php
                        // Fetch About Me title and description
                        $about_sql = "SELECT about_text FROM about LIMIT 1";
                        $about_result = $conn->query($about_sql);
                        if ($about_result->num_rows > 0) {
                            $about_row = $about_result->fetch_assoc();
                            echo "<h2>" . $about_row['about_text'] . "</h2>";
                        } else {
                            echo "<p>No about information available.</p>";
                        }
                    ?>
             </div>
            <div class="col-2">
              <div class="about-item skills">
                <h1>Skills</h1>
                <?php
                                $sql = "SELECT skill_name FROM skills";
                                $result = $conn->query($sql);

                                if ($result->num_rows > 0) {
                                    while($row = $result->fetch_assoc()) {
                                        echo "<span class='skill'>" . $row['skill_name'] . "</span>";
                                    }
                                } else {
                                    echo "<p>No skills available.</p>";
                                }
                            ?>
              </div>

              <div class="about-item languages">
                <h1>Languages</h1>
                <?php
                                $sql = "SELECT language_name FROM languages";
                                $result = $conn->query($sql);

                                if ($result->num_rows > 0) {
                                    while($row = $result->fetch_assoc()) {
                                        echo "<div class='language'>";
                                        echo "<p>" . $row['language_name'] . "</p>";
                                        echo "<span class='bar'><span class='" . $row['language_name'] . "'></span></span>";
                                        echo "</div>";
                                    }
                                } else {
                                    echo "<p>No languages available.</p>";
                                }
                            ?>
              </div>
            </div>
          </section>

          <!--=============== PROJECTS ===============-->

          <section class="content-card projects" id="projects">
            <h1>Projects</h1>
            <div class="col-2 project-list">
              <?php
                            $sql = "SELECT title, description, image_project, image_type FROM projects";
                            $result = $conn->query($sql);

                            if ($result->num_rows > 0) {
                                while($row = $result->fetch_assoc()) {
                                    echo "<div class='project-tile'>";
                                    $imageData = $row['image_project'];
                                    $imageType = $row['image_type'];
                                    $base64 = base64_encode($imageData);
                                    $src = "data:image/" . $imageType . ";base64," . $base64;
                                    echo "<img src='$src' '><br>";
                                    echo "<div class='overlay'>";
                                    echo "<div class='project-description'>";
                                    echo "<h3>" . $row['title'] . "</h3>";
                                    echo "<p>" . $row['description'] . "</p>";
                                    echo "</div>";
                                    echo "</div>";
                                    echo "</div>";
                                }
                            } else {
                                echo "<p>No projects available.</p>";
                            }
                        ?>
            </div>
            <a href="https://github.com/group4sewmsu">see more...</a>
          </section>

          <!--=============== EXPERIENCE ===============-->

          <section class="content-card experience" id="experience">
            <h1>Experience</h1>
            <div class="timeline">
              <div class="timeline-items">
                <?php
                                $sql = "SELECT start_date, end_date, position, company, description FROM experience";
                                $result = $conn->query($sql);

                                if ($result->num_rows > 0) {
                                    while($row = $result->fetch_assoc()) {
                                        echo "<div class='timeline-item'>";
                                        echo "<div class='timeline-date'>" . $row['start_date'] . " - " . $row['end_date'] . "</div>";
                                        echo "<div class='timeline-content'>";
                                        echo "<h3>" . $row['position'] . "</h3>";
                                        echo "<p>" . $row['company'] . "</p>";
                                        echo "<p>" . $row['description'] . "</p>";
                                        echo "</div>";
                                        echo "</div>";
                                    }
                                } else {
                                    echo "<p>No experience available.</p>";
                                }
                            ?>
              </div>
            </div>
          </section>

          <!--=============== CONTACT ===============-->

          <section class="content-card contact" id="contact">
            <h1>Contact</h1>
            <form class="form" id="form" action="#">
              <div class="input-box">
                <input type="text" class="text-input" name="name" placeholder="Name" />
              </div>
              <div class="input-box">
                <input type="email" class="text-input" name="email" id="email" placeholder="Email" />
              </div>
              <div class="input-box">
                <input type="subject" class="text-input" name="subject" id="subject" placeholder="Subject" />
              </div>
              <div class="input-box">
                <textarea name="text" class="message" placeholder="Message..."></textarea>
              </div>
              <div class="input-box">
                <input type="submit" class="submit-btn" id="submit" value="submit" />
              </div>
            </form>
          </section>
        </div>
      </div>
    </div>
  </body>

</html>

<?php
// Close the database connection after all queries are executed
$conn->close();
?>

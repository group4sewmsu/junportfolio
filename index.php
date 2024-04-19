<?php
include_once 'connection.php';
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
            <a href="index.php" class="menu-icon fa-solid fa-house"></a>
            <a href="#about" class="menu-icon fa-solid fa-user"></a>
            <a href="#projects" class="menu-icon fa-solid fa-code"></a>
            <a href="#experience" class="menu-icon fa-solid fa-briefcase"></a>
            <a href="#contact" class="menu-icon fa-solid fa-envelope"></a>
			<a href="login.php" class="menu-icon fa-solid fa-user-secret"></a>
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

                    $conn->close();
                    ?>

                <h1>Joseph&nbsp;L.&nbsp;Harun</h1>
                <h2>IT&nbsp;Analyst</h2>
                <div class="socials">
                    <a href="https://www.linkedin.com/in/joseph-harun/" target="_blank" class="fa-brands fa-linkedin-in" id="profile-link"></a>
                    <a href="#" target="_blank" class="fa-brands fa-facebook"></a>
                    <a href="#" target="_blank" class="fa-brands fa-facebook-messenger"></a>
                    <a href="#" target="_blank" class="fa-brands fa-telegram"></a>
                    <a href="#" target="_blank" class="fa-brands fa-whatsapp"></a>
                    <a href="#" target="_blank" class="fa-brands fa-github"></a>
                </div>
                <a href="" class="cta">DownIoad CV</a>
            </section>

            <!--=============== CONTENT SECTION ===============-->

            <div class="content">
                <!--=============== HOME ===============-->

                <section class="content-card home" id="welcome-section">
                    <h1>

                            <?php
                                // Retrieve the latest uploaded media
                                $sql = "SELECT content_data, content_type FROM media ORDER BY id DESC LIMIT 1";
                                $result = $conn->query($sql);

                                if ($result->num_rows > 0) {
                                    $row = $result->fetch_assoc();
                                    $mediaData = $row['media_data'];
                                    $mediaType = $row['media_type'];
                                    $base64 = base64_encode($imageData);
                                    $src = "data:media/" . $contentType . ";base64," . $base64;
                                    echo "<media src='$src' '><br>";
                                } else {
                                    echo "<h3>No media uploaded yet.</h3>";
                                }

                                $conn->close();
                            ?>
                            
                    </h1>
                </section>

                <!--=============== ABOUT ME ===============-->

                <section class="content-card about" id="about">
                    <h1>About me</h1>
                    <div class="about-item about-me">
                        <p>
                            Hi, I'm Naem Azam, a passionate self-taught Programmer, an open-source enthusiast, and a maintainer. My passion for Systems lies in dreaming up ideas and making them come true with elegant interfaces.
                        </p>
                        <p>
                            I’m a research scientist working to better understand About AI. My expertise includes Linux System Administration, IT Support Specialist, Web development, and implementation of AI research tools.
                        </p>
                    </div>
                    <div class="col-2">
                        <div class="about-item skills">
                            <h1>Skills</h1>
                            <span class="skill">HTML</span>
                            <span class="skill">CSS</span>
                            <span class="skill">JavaScript</span>
                            <span class="skill">Node.js</span>
                            <span class="skill">React</span>
                            <span class="skill">SQL</span>
                            <span class="skill">Git</span>
                            <span class="skill">API</span>
                            <span class="skill">Unix/Linux</span>
                            <span class="skill">Jira</span>
                            <span class="skill">Confluence</span>
                            <span class="skill">Figma</span>
                        </div>

                        <div class="about-item languages">
                            <h1>Languages</h1>
                            <div class="language">
                                <p>Bangla</p>
                                <span class="bar"><span class="bangla"></span></span>
                            </div>
                            <div class="language">
                                <p>English</p>
                                <span class="bar"><span class="english"></span></span>
                            </div>
                            <div class="language">
                                <p>Chinese</p>
                                <span class="bar"><span class="chinese"></span></span>
                            </div>
                        </div>
                    </div>
                </section>

                <!--=============== PROJECTS ===============-->

                <section class="content-card projects" id="projects">
                    <h1>Projects</h1>
                    <div class="col-2 project-list">
                        <div class="project-tile">
                            <img src="./img/1.PNG"
                                alt="" />
                            <div class="overlay">
                                <div class="project-description">
                                    <h3>Project 1</h3>
                                    <p>
                                        Lorem ipsum dolor sit amet, consectetur adipisicing elit.
                                        Nisi aperiam voluptate accusamus velit omnis.
                                    </p>
                                </div>
                            </div>
                        </div>
                        <div class="project-tile">
                            <img src="./img/2.PNG"
                                alt="" />
                            <div class="overlay">
                                <div class="project-description">
                                    <h3>Project 2</h3>
                                    <p>
                                        Lorem ipsum dolor sit amet, consectetur adipisicing elit.
                                        Nisi aperiam voluptate accusamus velit omnis.
                                    </p>
                                </div>
                            </div>
                        </div>
                        <div class="project-tile">
                            <img src="./img/3.jpg"
                                alt="" />
                            <div class="overlay">
                                <div class="project-description">
                                    <h3>Project 3</h3>
                                    <p>
                                        Lorem ipsum dolor sit amet, consectetur adipisicing elit.
                                        Nisi aperiam voluptate accusamus velit omnis.
                                    </p>
                                </div>
                            </div>
                        </div>
                        <div class="project-tile">
                            <img src="./img/4.jpg"
                                alt="" />
                            <div class="overlay">
                                <div class="project-description">
                                    <h3>Project 4</h3>
                                    <p>
                                        Lorem ipsum dolor sit amet, consectetur adipisicing elit.
                                        Nisi aperiam voluptate accusamus velit omnis.
                                    </p>
                                </div>
                            </div>
                        </div>
                    </div>
                    <a href="https://github.com/group4sewmsu">see more...</a>
                </section>

                <!--=============== EXPERIENCE ===============-->

                <section class="content-card experience" id="experience">
                    <h1>Experience</h1>
                    <div class="timeline">
                        <div class="timeline-items">
                            <div class="timeline-item">
                                <div class="timeline-date">2022 - now</div>
                                <div class="timeline-content">
                                    <h3>timeline item 1</h3>
                                    <p>
                                        Lorem ipsum dolor sit, amet consectetur adipisicing elit.
                                        Ab iusto accusantium nostrum eligendi debitis quisquam.
                                        Corporis at voluptatem culpa officia.
                                    </p>
                                </div>
                            </div>
                            <div class="timeline-item">
                                <div class="timeline-date">2015 - 2022</div>
                                <div class="timeline-content">
                                    <h3>timeline item 2</h3>
                                    <p>
                                        Lorem ipsum dolor sit, amet consectetur adipisicing elit.
                                        Ab iusto accusantium nostrum eligendi debitis quisquam.
                                        Corporis at voluptatem culpa officia.
                                    </p>
                                </div>
                            </div>
                            <div class="timeline-item">
                                <div class="timeline-date">2014 - 2015</div>
                                <div class="timeline-content">
                                    <h3>timeline item 3</h3>
                                    <p>
                                        Lorem ipsum dolor sit, amet consectetur adipisicing elit.
                                        Ab iusto accusantium nostrum eligendi debitis quisquam.
                                        Corporis at voluptatem culpa officia.
                                    </p>
                                </div>
                            </div>
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
                            <input type="subject" class="text-input" name="subject" id="subject"
                                placeholder="Subject" />
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

<?php
session_start();
$errors = $_SESSION['errors'] ?? [];
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Local Art Gallery - Exhibitions</title>
    <!-- Link to the CSS files -->
    <link rel="stylesheet" href="../CSS/exhibitions.css"> 
    <link rel="stylesheet" href="../CSS/navbar.css">
</head>
<body>
    <!-- Conditionally add an unshown element if the user is logged in -->
    <?php if (isset($_SESSION['user_id'])): ?>
        <span id="userLoggedIn" style="display: none;"></span>
    <?php endif; ?>
    
    <div class="content">
        <nav id="navbar">
            <!-- Navbar generated by JavaScript -->
        </nav>

        <header>
            <h1>Exhibitions</h1>
        </header>

        <main id="content">
            <section id="current-exhibitions">
                <h2>Current Exhibitions</h2>
                <!-- List of current exhibitions -->
                <!-- Repeat the article for each exhibition -->
                <article class="exhibition-item">
                    <picture>
                        <source media="(max-width: 768px)" srcset="../images/lowres/henrik-donnestad-t2Sai-AqIpI-unsplash.jpg">
                        <source media="(min-width: 769px)" srcset="../images/highres/henrik-donnestad-t2Sai-AqIpI-unsplash.jpg">
                        <img src="../images/lowres/henrik-donnestad-t2Sai-AqIpI-unsplash.jpg" alt="Impressionist Icons">
                    </picture>
                    <h3>Impressionist Icons</h3>
                    <p>Experience the timeless beauty of the Impressionist era.</p>
                    <a href="#" class="button">Learn More</a> <!-- Placeholder that would lead to an artist's personal website -->
                </article>

                <article class="exhibition-item">
                    <picture>
                        <source media="(max-width: 768px)" srcset="../images/lowres/mcgill-library-y4PqRPqSako-unsplash.jpg">
                        <source media="(min-width: 769px)" srcset="../images/highres/mcgill-library-y4PqRPqSako-unsplash.jpg">
                        <img src="../images/lowres/mcgill-library-y4PqRPqSako-unsplash.jpg" alt="Modern Marvels">
                    </picture>
                    <h3>Modern Marvels</h3>
                    <p>Dive into the dynamic and bold world of modern art.</p>
                    <a href="#" class="button">Learn More</a> <!-- Placeholder that would lead to an artist's personal website -->
                </article>

                <article class="exhibition-item">
                    <picture>
                        <source media="(max-width: 768px)" srcset="../images/lowres/steve-johnson-e5LdlAMpkEw-unsplash.jpg">
                        <source media="(min-width: 769px)" srcset="../images/highres/steve-johnson-e5LdlAMpkEw-unsplash.jpg">
                        <img src="../images/lowres/steve-johnson-e5LdlAMpkEw-unsplash.jpg" alt="Avant-Garde Expressions">
                    </picture>
                    <h3>Avant-Garde Expressions</h3>
                    <p>Explore avant-garde art that breaks boundaries and challenges conventions.</p>
                    <a href="#" class="button">Learn More</a> <!-- Placeholder that would lead to an artist's personal website -->
                </article>

            </section>

            <section id="upcoming-exhibitions">
                <h2>Upcoming Exhibitions</h2>
                <p>No upcoming exhibitions</p>
                <!-- List of upcoming exhibitions -->
                <!-- Similar structure to current exhibitions -->
            </section>
        </main>

    </div>
    <footer>
        <p>&copy; 2023 Local Art Gallery</p>
    </footer>

    <script src="../Javascript/navbar.js"></script> <!-- Link to JavaScript file for the navbar -->
</body>
</html>
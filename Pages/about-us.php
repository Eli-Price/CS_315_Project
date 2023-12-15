<?php
session_start();
$errors = $_SESSION['errors'] ?? [];
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>About Us</title>
    <!-- Include the navbar JavaScript file -->
    <link rel="stylesheet" href="../CSS/navbar.css">
    <link rel="stylesheet" href="../CSS/visitor-info.css">
</head>
<body>
    <!-- Conditionally add an unshown element if the user is logged in -->
    <?php if (isset($_SESSION['user_id'])): ?>
        <span id="userLoggedIn" style="display: none;"></span>
    <?php endif; ?>

    <nav id="navbar">
        <!-- The navigation bar will be injected here by JavaScript -->
    </nav>

    <div class="content">
        <header class="container">
            <h1>About Artistic Expressions Gallery</h1>
        </header>

        <main>
            <section id="about-us">
                <h2>Our Story</h2>
                <p>Founded in 2000, Artistic Expressions Gallery has been a cornerstone in the Art City community, showcasing a diverse array of contemporary art. Our gallery is dedicated to providing a platform for emerging talent and established artists alike.</p>
                
                <h3>Our Mission</h3>
                <p>To inspire and engage audiences with innovative and thought-provoking art exhibitions, fostering an appreciation for the vibrant art scene in Art City.</p>

                <h3>Meet Our Team</h3>
                <ul>
                    <li><strong>Jane Doe:</strong> Founder & Curator</li>
                    <li><strong>John Smith:</strong> Art Director</li>
                    <li><strong>Emily Johnson:</strong> Exhibition Coordinator</li>
                    <!-- More team members -->
                </ul>

                <!-- Additional sections like Gallery History, Community Involvement, etc. -->
            </section>
        </main>
    </div>

    <footer>
        <p>&copy; 2023 Artistic Expressions Gallery</p>
    </footer>

    <script src="../Javascript/navbar.js"></script>
</body>
</html>
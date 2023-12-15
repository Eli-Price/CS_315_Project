<?php
session_start();
$errors = $_SESSION['errors'] ?? [];
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Visitor</title>
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
            <h1>Welcome to Artistic Expressions Gallery</h1>
        </header>

        <main>
            <section id="visitor-info">
                <h2>Plan Your Visit</h2>
                <p>Explore the world of contemporary art at the heart of Art City. Our gallery offers a unique collection of artworks from renowned international artists.</p>
                
                <h3>Location & Directions</h3>
                <p>123 Palette Lane, Art City, AC 12345</p>
                <!-- Embed Google Maps -->

                <h3>Hours of Operation</h3>
                <p>Monday to Friday: 10 am - 6 pm<br>Saturday: 11 am - 5 pm<br>Sunday: Closed</p>

                <h3>Admission Fees</h3>
                <p>Adults: $15<br>Students and Seniors: $10<br>Children under 12: Free</p>

                <!-- Additional sections like Facilities, Exhibitions, Rules, Contact, etc. -->
            </section>
        </main>
    </div>

    <footer>
        <p>&copy; 2023 Artistic Expressions Gallery</p>
    </footer>

    <script src="../Javascript/navbar.js"></script>
</body>
</html>
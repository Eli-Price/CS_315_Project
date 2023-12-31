<?php
session_start();
$errors = $_SESSION['errors'] ?? [];
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Local Art Gallery - Community Art</title>
    <!-- Link to the CSS files -->
    <link rel="stylesheet" href="../CSS/community.css">
    <link rel="stylesheet" href="../CSS/navbar.css">
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
        <header>
            <h1>Community Art</h1>
            <p>Explore the vibrant art created by our community members, with diverse genres and mediums.</p>
        </header>
    
        <!-- Search functionality for the Community Art Page -->
        <section id="search-section">
            <form id="search-form">
                <input type="text" id="search-genre" name="genre" placeholder="Search by genre">
                <input type="text" id="search-medium" name="medium" placeholder="Search by medium">
                <button type="submit">Search</button>
            </form>
            <p id="search-output"> <!-- This is where the output that would go to the server goes --> </p>
        </section>
    
        <!-- Gallery of community art -->
        <section id="art-gallery" class="art-gallery">
            <!-- Art pieces will be displayed here via JavaScript -->
        </section>
    </div>

    <!-- Footer of the website -->
    <footer>
        <p>© 2023 Local Art Gallery. All Rights Reserved.</p>
    </footer>

    <!-- Link to the JavaScript file for generating the navigation bar -->
    <script src="../Javascript/navbar.js"></script>
    <!-- Link to the JavaScript file for search functionality -->
    <script src="../Javascript/search.js"></script>
</body>
</html>
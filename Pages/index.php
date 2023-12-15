<?php
session_start();
$errors = $_SESSION['errors'] ?? [];
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Local Art Gallery - Home</title>
    <!-- Other head elements -->

    <link rel="stylesheet" href="../CSS/navbar.css">
    <link rel="stylesheet" href="../CSS/home.css">
    
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

        <!-- Welcome Section -->
        <section class="container">
            <h2 class="section-heading">Welcome to the Local Art Gallery</h2>
            <p>Explore a world where art and community meet. Discover pieces from contemporary artists and revel in the creativity that surrounds us.</p>

            <h2 class="section-heading">About Our Gallery</h2>
            <p>Founded in the heart of the city, our gallery has been a sanctuary for art lovers for over a decade. We celebrate the diversity of art and offer a platform for artists from all walks of life.</p>

            <h2 class="section-heading">Current Exhibitions</h2>
            <p>Immerse yourself in our latest exhibitions. Each piece tells a story and connects you to the artist's unique vision. Visit us today to experience the power of art.</p>

            <h2 class="section-heading">Become a Member</h2>
            <p>Join our community and enjoy exclusive benefits, including special invitations to openings, artist talks, and more. Support the arts and become a member today!</p>
        </section>

        <section class="container">
            <h2>Current Exhibitions</h2>
            <p>Discover the breathtaking artwork from local and international artists currently on display.</p>

        </section>
    </div>

    <footer>
        <p>&copy; 2023 Local Art Gallery</p>
    </footer>

    <script src="../Javascript/navbar.js"></script>
</body>
</html>
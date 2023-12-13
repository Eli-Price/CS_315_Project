<?php
session_start();
$errors = $_SESSION['errors'] ?? [];
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Visitor</title>
    <!-- Other head elements -->

    <!-- Include the navbar JavaScript file -->
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


    <script src="../Javascript/navbar.js"></script>
</body>
</html>
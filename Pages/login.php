<?php
session_start();
$errors = $_SESSION['errors'] ?? [];
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Local Art Gallery - Login</title>
    <link rel="stylesheet" href="../CSS/login.css">
    <link rel="stylesheet" href="../CSS/navbar.css">
</head>
<body>
    <nav id="navbar">
        <!-- The navigation bar will be injected here by JavaScript -->
    </nav>

    <!-- Conditionally display an element if the user is logged in -->
    <?php if (isset($_SESSION['user_id'])): ?>
        <span id="userLoggedInIndicator" style="display: none;"></span>
    <?php endif; ?>

    <div class="content">
      <div class="login-container" id="form">
        <h1>Login</h1>
        <form action="../PHP/login.php" method="post">
            <div class="form-group">
                <label for="username">Username:</label>
                <input type="text" id="username" name="username" value="<?php echo htmlspecialchars($_SESSION['form_data']['username'] ?? ''); ?>" required>
                <!-- Returns username with an error -->
                <?php if (isset($errors['username'])): ?>
                <p style="color: red;"><?php echo $errors['username']; ?></p>
                <?php endif; ?>
            </div>
            <div class="form-group">
                <label for="password">Password:</label>
                <input type="text" id="password" name="password" value="<?php echo htmlspecialchars($_SESSION['form_data']['password'] ?? ''); ?>" required>
                <!-- Returns password with an error -->
                <?php if (isset($errors['password'])): ?>
                <p style="color: red;"><?php echo $errors['password']; ?></p>
                <?php endif; ?>
            </div>
            <button type="submit" class="btn">Confirm</button>
        </form>
        <button class="btn" onclick="document.location='../Pages/registration.php'">Register</button>
        <button class="btn" onclick="document.location='../PHP/logout.php'">Logout</button>
        <script src="../Javascript/inputValidation.js"></script>
        <?php
        // Clear errors and last input after displaying them
        unset($_SESSION['form_data']);
        unset($_SESSION['errors']);
        ?>
      </div>
    </div>

    <!-- Footer of the website -->
    <footer>
        <p>© 2023 Local Art Gallery. All Rights Reserved.</p>
    </footer>

    <!-- Link to the JavaScript file for generating the navigation bar -->
    <script src="../Javascript/navbar.js"></script>
    
</body>
</html>
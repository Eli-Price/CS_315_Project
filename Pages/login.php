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

    <div class="content">
      <div class="login-container">
        <h1>Login</h1>
        <form action="../PHP/login.php" method="post">
            <div class="form-group">
                <label for="username">Username:</label>
                <input type="text" id="username" name="username" required>
            </div>
            <div class="form-group">
                <label for="password">Password:</label>
                <input type="password" id="password" name="password" required>
            </div>
            <button type="submit" class="btn">Confirm</button>
        </form>
        <button class="btn" onclick="document.location='../Pages/registration.php'">Register</button>
        <button class="btn" onclick="document.location='../PHP/logout.php'">Logout</button>
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
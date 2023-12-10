<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register - Local Art Gallery</title>
    <link rel="stylesheet" href="../CSS/login.css">
    <link rel="stylesheet" href="../CSS/navbar.css">
</head>
<body>
    <nav id="navbar">
      <!-- The navigation bar will be injected here by JavaScript -->
    </nav>

    <div class="content">
      <div class="login-container">
          <h1>Register</h1>
          <form action="../PHP/register.php" method="post">
              <div class="form-group">
                  <label for="username">Username:</label>
                  <input type="text" id="username" name="username" required>
              </div>
              <div class="form-group">
                  <label for="password">Password:</label>
                  <input type="password" id="password" name="password" required>
              </div>
              <div class="form-group">
                  <label for="email">Email:</label>
                  <input type="email" id="email" name="email" required>
              </div>
              <button type="submit" class="btn">Submit</button>
              <button class="btn" onclick="document.location='../Pages/login.php'">Login</button>
          </form>
      </div>
    </div>
    <footer>
        <p>&copy; 2023 Local Art Gallery</p>
    </footer>

    <!-- Link to the JavaScript file for generating the navigation bar -->
    <script src="../Javascript/navbar.js"></script>
</body>
</html>
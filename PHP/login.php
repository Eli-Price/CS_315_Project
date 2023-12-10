<?php
session_start();

require '../Database/dblogin.php';

/*if ((isset($_SESSION['user_id']))) {
  echo "Already logged in"
}*/

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['username'], $_POST['password'])) {
    $username = $_POST['username'];
    $password = $_POST['password'];

    // Prepare SQL statement to prevent SQL injection
    $stmt = $pdo->prepare("SELECT * FROM users WHERE username = ?");
    $stmt->execute([$username]);
    $user = $stmt->fetch();

    if ($user && password_verify($password, $user['password'])) {
      // If password is correct, set session variables
      $_SESSION['username'] = $user['username'];
      $_SESSION['user_id'] = $user['id'];
      // Redirect to a protected page or home page
      header("Location: ../Pages/index.html");
      exit;
    } else {
      // Authentication failed
      header("Location: ../Pages/login.php");
      echo "Invalid username or password.";
    }
}
?>
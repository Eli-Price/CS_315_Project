<?php
session_start();
require '../Database/dblogin.php';

// If user is already logged in go back to login page
if (isset($_SESSION['user_id'])) {
  header("Location: ../Pages/login.php");
  exit;
}

$errors = [];
$form_data = [];

if ($_SERVER["REQUEST_METHOD"] == "POST") {
  $username = $_POST['username'];
  $password = $_POST['password'];

  // Store form data for repopulating the form if there are errors
  $form_data['username'] = $username;
  $form_data['password'] = $password;

  // Validation
  if (!preg_match("/^[a-zA-Z0-9_]{5,}$/", $username)) {
      $errors['username'] = "Invalid username";
  }

  if (!preg_match("/^(?=.*\d)(?=.*[a-zA-Z]).{6,}$/", $password)) {
      $errors['password'] = "Invalid password";
  }

  // If there are no errors, proceed with login
  // If there are errors, store them in the session and redirect back to the login form
  if (!empty($errors)) {
    $_SESSION['errors'] = $errors;
    $_SESSION['form_data'] = $form_data;
    header("Location: ../Pages/login.php");
    exit;
  } else {
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
        header("Location: ../Pages/index.php");
        exit;
      } else {
        // Authentication failed
        header("Location: ../Pages/login.php");
        echo "Invalid username or password.";
      }
    }
  }

  // Store errors in session
  $_SESSION['errors'] = $errors;
}

// Redirect back to the form with errors
header("Location: login.php");
exit;
?>
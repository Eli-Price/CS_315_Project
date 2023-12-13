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
    $username = trim($_POST['username']);
    $password = trim(password_hash($_POST['password'], PASSWORD_DEFAULT));
    $email = trim($_POST['email']);

    $form_data = ['username' => $username, 'password' => $password, 'email' => $email];

    // Validation
    if (!preg_match("/^[a-zA-Z0-9_]{5,}$/", $username)) {
        $errors['username'] = "Invalid username";
    }

    if (!preg_match("/^(?=.*\d)(?=.*[a-zA-Z]).{6,}$/", $password)) {
        $errors['password'] = "Invalid password";
    }

    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $errors['email'] = "Invalid email";
    }

    if (!empty($errors)) {
        $_SESSION['errors'] = $errors;
        $_SESSION['form_data'] = $form_data;
        header("Location: ../Pages/registration.php");
        exit;
    } else {
        // Handle the registration when there are no errors
        // Check if username already exists
        $stmt = $pdo->prepare("SELECT * FROM users WHERE username = ?");
        $stmt->execute([$username]);
        if ($stmt->rowCount() > 0) {
            $errors['username'] = "Username already exists";
            $_SESSION['errors'] = $errors;
            header("Location: ../Pages/registration.php");
        } else {
            // Insert new user into database
            $stmt = $pdo->prepare("INSERT INTO users (username, password, email) VALUES (?, ?, ?)");
            $stmt->execute([$username, $password, $email]);
            // Set session variable to show that a successful registration has occurred
            $_SESSION['register_success'] = "Registration successful. Please log in.";
            header("Location: ../Pages/login.php");
        }
    }
}
?>
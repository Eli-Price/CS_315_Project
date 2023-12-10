<?php
// Include database connection
require '../Database/dblogin.php';

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['username'], $_POST['password'], $_POST['email'])) {
    $username = $_POST['username'];
    $password = password_hash($_POST['password'], PASSWORD_DEFAULT); // Hashing the password
    $email = $_POST['email'];

    // Check if username already exists
    $stmt = $pdo->prepare("SELECT * FROM users WHERE username = ?");
    $stmt->execute([$username]);
    if ($stmt->rowCount() > 0) {
        echo "Username already exists. Please choose a different username.";
    } else {
        // Insert new user into database
        $stmt = $pdo->prepare("INSERT INTO users (username, password, email) VALUES (?, ?, ?)");
        $stmt->execute([$username, $password, $email]);
        echo "Registration successful. <a href='login.html'>Login here</a>";
    }
}
?>
<?php
session_start();
require '../Database/dblogin.php';

if (!isset($_SESSION['user_id'])) {
    // Redirect to login if the user is not logged in
    header("Location: login.html");
    exit;
}

if (isset($_GET['ticket_id'])) {
    $userId = $_SESSION['user_id'];
    $ticketId = $_GET['ticket_id'];
    // $status = $_GET['status'];

    // Check if the user already has any tickets to the event
    $stmt = $pdo->prepare("SELECT * FROM user_tickets WHERE user_id = ? AND ticket_id = ? AND status = 'in_cart'");
    $stmt->execute([$userId, $ticketId]);

    if ($stmt->rowCount() > 0) {
      $row = $stmt->fetch();
      $newQuantity = $row['quantity'] + 1;
      $stmt = $pdo->prepare("UPDATE user_tickets SET quantity = ? WHERE user_id = ? AND ticket_id = ? AND status = 'in_cart'");
      $stmt->execute([$newQuantity, $userId, $ticketId]);
    }
    else {
      // User does not have ticket in cart, add new row to database
      $stmt = $pdo->prepare("INSERT INTO user_tickets (user_id, ticket_id, status, quantity) VALUES (?, ?, 'in_cart', 1)");
      $stmt->execute([$userId, $ticketId]);
    }

    // Redirect back to events page or to the cart page
    header("Location: ../HTML/events.php");
    exit;
}

// Redirect to the events page if the ticket_id is not set
header("Location: ../HTML/events.php");
exit;
?>
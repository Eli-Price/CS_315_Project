<?php
session_start();
require '../Database/dblogin.php';

if (!isset($_SESSION['user_id'])) {
    // Redirect to login if the user is not logged in
    header("Location: login.php");
    exit;
}

if (isset($_GET['ticket_id'])) {
    $userId = $_SESSION['user_id'];
    $ticketId = $_GET['ticket_id'];

    // First, get the current available quantity
    $stmt = $pdo->prepare("SELECT available_quantity FROM tickets WHERE ticket_id = ?");
    $stmt->execute([$ticketId]);
    $row = $stmt->fetch();
    $current_quantity = $row['available_quantity'];

    // Then, decrease the quantity by 1
    $new_quantity = $current_quantity - 1;

    // Finally, update the quantity in the database
    $stmt = $pdo->prepare("UPDATE tickets SET available_quantity = ? WHERE ticket_id = ?");
    $stmt->execute([$new_quantity, $ticketId]);

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
    header("Location: ../Pages/events.php");
    exit;
}

// Redirect to the events page if the ticket_id is not set
header("Location: ../Pages/events.php");
exit;
?>
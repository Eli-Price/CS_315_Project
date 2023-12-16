<?php
session_start();
require '../Database/dblogin.php';

if (!isset($_SESSION['user_id'])) {
    header("Location: ../Pages/login.php");
    exit;
}

$userId = $_SESSION['user_id'];

$pdo->beginTransaction();

try {
    // Get all tickets in the user's cart
    $stmt = $pdo->prepare("SELECT * FROM user_tickets WHERE user_id = ? AND status = 'in_cart'");
    $stmt->execute([$userId]);

    while ($row = $stmt->fetch()) {
        $ticketId = $row['ticket_id'];
        $quantity = $row['quantity'];

        // Check if the user already has any tickets of the same type
        $stmt2 = $pdo->prepare("SELECT * FROM user_tickets WHERE user_id = ? AND ticket_id = ? AND status = 'purchased'");
        $stmt2->execute([$userId, $ticketId]);

        if ($stmt2->rowCount() > 0) {
            // User already has tickets of this type, update the quantity
            $row2 = $stmt2->fetch();
            $newQuantity = $row2['quantity'] + $quantity;
            $stmt3 = $pdo->prepare("UPDATE user_tickets SET quantity = ? WHERE user_id = ? AND ticket_id = ? AND status = 'purchased'");
            $stmt3->execute([$newQuantity, $userId, $ticketId]);
        } else {
            // User does not have tickets of this type, add new row to database
            $stmt3 = $pdo->prepare("INSERT INTO user_tickets (user_id, ticket_id, status, quantity) VALUES (?, ?, 'purchased', ?)");
            $stmt3->execute([$userId, $ticketId, $quantity]);
        }

        // Remove the tickets from the user's cart
        $stmt4 = $pdo->prepare("DELETE FROM user_tickets WHERE user_id = ? AND ticket_id = ? AND status = 'in_cart'");
        $stmt4->execute([$userId, $ticketId]);
    }

    $pdo->commit();
    $_SESSION['checkout_success'] = "Purchase successful.";
} catch (Exception $e) {
    $pdo->rollBack();
    $_SESSION['checkout_error'] = "An error occurred during checkout.";
}

header("Location: ../Pages/shopping-cart.php");
exit;
?>
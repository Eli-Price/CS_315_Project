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
    // Update the status of cart items to 'purchased'
    $stmt = $pdo->prepare("UPDATE user_tickets SET status = 'purchased' WHERE user_id = ? AND status = 'in_cart'");
    $stmt->execute([$userId]);

    $pdo->commit();
    $_SESSION['checkout_success'] = "Purchase successful.";
} catch (Exception $e) {
    $pdo->rollBack();
    $_SESSION['checkout_error'] = "An error occurred during checkout.";
}

header("Location: ../Pages/shopping-cart.php");
exit;
?>
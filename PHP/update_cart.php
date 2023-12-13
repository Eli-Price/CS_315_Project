<?php
session_start();
require '../Database/dblogin.php';

// Check if the user is logged in
if (!isset($_SESSION['user_id'])) {
    header("Location: ../Pages/login.php");
    exit;
}

// Check for required parameters
if (!isset($_GET['action']) || !isset($_GET['id'])) {
    header("Location: ../Pages/shopping-cart.php");
    exit;
}

$userId = $_SESSION['user_id'];
$action = $_GET['action'];
$userTicketId = $_GET['id'];
$source = $_GET['source'];

// Fetch the current quantity of the ticket
$stmt = $pdo->prepare("SELECT quantity, ticket_id FROM user_tickets WHERE user_ticket_id = ? AND user_id = ?");
$stmt->execute([$userTicketId, $userId]);
$item = $stmt->fetch();

if (!$item) {
    // Handle error - item not found
    header("Location: ../Pages/shopping-cart.php");
    exit;
}

$currentQuantity = $item['quantity'];
$ticketId = $item['ticket_id'];

$pdo->beginTransaction();

try {
  // Check available ticket quantity if adding
  if ($action === 'add') {
      $stmt = $pdo->prepare("SELECT available_quantity FROM tickets WHERE ticket_id = ?");
      $stmt->execute([$ticketId]);
      $ticket = $stmt->fetch();

      if ($ticket['available_quantity'] > 0/*$currentQuantity < $ticket['available_quantity']*/) {
          // Increment the quantity in user's cart
          $newQuantity = $currentQuantity + 1;

          // Update user_tickets
          $updateStmt = $pdo->prepare("UPDATE user_tickets SET quantity = ? WHERE user_ticket_id = ? AND user_id = ?");
          $updateStmt->execute([$newQuantity, $userTicketId, $userId]);

          // Decrement available quantity in tickets
          $newAvailableQuantity = $ticket['available_quantity'] - 1;
          $updateTicketStmt = $pdo->prepare("UPDATE tickets SET available_quantity = ? WHERE ticket_id = ?");
          $updateTicketStmt->execute([$newAvailableQuantity, $ticketId]);
      } else {
          // Handle error - no more tickets available
          throw new Exception("No more tickets available");
      }
  } elseif ($action === 'subtract' && $currentQuantity > 0) {
      // Decrement the quantity in user's cart
      $newQuantity = $currentQuantity - 1;

      // Update user_tickets
      $updateStmt = $pdo->prepare("UPDATE user_tickets SET quantity = ? WHERE user_ticket_id = ? AND user_id = ?");
      $updateStmt->execute([$newQuantity, $userTicketId, $userId]);

      // Increment available quantity in tickets
      $updateTicketStmt = $pdo->prepare("UPDATE tickets SET available_quantity = available_quantity + 1 WHERE ticket_id = ?");
      $updateTicketStmt->execute([$ticketId]);
  } else {
      // Handle error - invalid action or quantity
      throw new Exception("Invalid action or quantity");
  }

  // Commit the transaction
  $pdo->commit();

} catch (Exception $e) {
    // Rollback the transaction if there was an error
    $pdo->rollBack();
    // Redirect back to the cart with error message
    header("Location: ../Pages/shopping-cart.php?error=" . urlencode($e->getMessage()));
    exit;
}
// Redirect back to the shopping cart
if (isset($_GET['source'])) {
    header("Location: ../Pages/" . $source . ".php");
    exit;
}
else {
    header("Location: ../Pages/shopping-cart.php");
    exit;
}
?>
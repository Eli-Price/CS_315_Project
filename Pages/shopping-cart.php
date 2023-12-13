<!-- Contains both the php to fetch the cart items and the HTML to display them -->

<?php
session_start();
require '../Database/dblogin.php';

// Check if user is logged in
if (!isset($_SESSION['user_id'])) {
    header("Location: ../Pages/login.php");
    exit;
}

$userId = $_SESSION['user_id'];
$cartItems = [];

// Fetch cart items from the database
$stmt = $pdo->prepare("SELECT ut.user_ticket_id, ut.quantity, t.event_name, t.price, t.available_quantity 
                       FROM user_tickets ut 
                       JOIN tickets t ON ut.ticket_id = t.ticket_id 
                       WHERE ut.user_id = ? AND ut.status = 'in_cart'");
$stmt->execute([$userId]);
$cartItems = $stmt->fetchAll();

// Calculate total and taxes
$total = 0;
$taxRate = 0.10; // Example tax rate of 10%

foreach ($cartItems as $item) {
    $total += $item['price'] * $item['quantity'];
}
$tax = $total * $taxRate;
$grandTotal = $total + $tax;

// Logic for updating ticket quantities

// HTML for the shopping cart
?>

<!-- Start of the html -->
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Local Art Gallery - Event Calender</title>
    <!-- Link to the CSS files -->
    <link rel="stylesheet" href="../CSS/navbar.css">
    <link rel="stylesheet" href="../CSS/shopping-cart.css">  
</head>
<body>
    <!-- Conditionally add an unshown element if the user is logged in -->
    <?php if (isset($_SESSION['user_id'])): ?>
        <span id="userLoggedIn" style="display: none;"></span>
    <?php endif; ?>

    <nav id="navbar">
        <!-- The navigation bar will be injected here by JavaScript -->
    </nav>

    <div class="content">
        <header class="container">
            <h1>Your Shopping Cart</h1>
        </header>

        <main>
            <section id="cart-section">
                <div id="cart">
                    <table>
                        <thead>
                            <tr>
                                <th>Event</th>
                                <th>Date</th>
                                <th>Price</th>
                                <th>Quantity</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($cartItems as $item): ?>
                                <tr>
                                    <td>
                                        <?php echo htmlspecialchars($item['event_name']); ?>
                                    </td>
                                    <td>
                                        $<?php echo htmlspecialchars($item['price']); ?>
                                    </td>
                                    <td>
                                        <!-- Subtract Button -->
                                        <?php if ($item['quantity'] > 0): ?>
                                            <a href="../PHP/update_cart.php?action=subtract&id=<?php echo $item['user_ticket_id']; ?>&source=shopping-cart">-</a>
                                        <?php endif; ?>
                                        <?php echo $item['quantity']; ?>
                                        <!-- Add Button -->
                                        <?php if (/*$item['quantity'] <*/ $item['available_quantity'] > 0): ?>
                                            <a href="../PHP/update_cart.php?action=add&id=<?php echo $item['user_ticket_id']; ?>&source=shopping-cart">+</a>
                                        <?php endif; ?>
                                    </td>
                                    <td>
                                        $<?php echo htmlspecialchars($item['price'] * $item['quantity']); ?>
                                    </td>
                                </tr>
                            <?php endforeach; ?>
                        </tbody>
                        <tr>
                            <td colspan="3">Tax (10%)</td>
                            <td>
                                $<?php echo number_format($tax, 2); ?>
                            </td>
                        </tr>
                        <tr>
                            <td colspan="3">Total</td>
                            <td>
                                $<?php echo number_format($grandTotal, 2); ?>
                            </td>
                        </tr>
                    </table>
                </div>
            </section>
            <div class="checkout-section" id="form">
                <h2>Checkout</h2>
                <form action="../PHP/checkout.php" method="post">
                    <div class="form-group">
                        <label for="creditCard">Credit Card Number:</label>
                        <input type="text" id="creditCard" name="creditCard" maxlength="19" placeholder="1234 5678 9012 3456" required>
                    </div>
                    <button type="submit" class="btn">Checkout</button>
                </form>
            </div>
            <script src="../Javascript/inputValidation.js"></script>
        </main>
    </div>

    <footer>
        <p>&copy; 2023 Local Art Gallery</p>
    </footer>

    <!-- Include the navbar JavaScript file -->
    <script src="../Javascript/navbar.js"></script>
    <script src="../Javascript/inputValidation.js"></script>
</body>
</html>
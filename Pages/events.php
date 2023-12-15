<?php
session_start();
require '../Database/dblogin.php'; //Database connection

$events = [];

if (isset($_SESSION['user_id'])) {
    $user_id = $_SESSION['user_id'];

    // Fetch events along with quantities in cart and purchased tickets
    $stmt = $pdo->prepare("
    SELECT t.ticket_id, t.event_name, t.event_date, t.price, t.available_quantity, 
        COALESCE(utc.quantity, 0) AS cart_quantity, 
        COALESCE(utp.quantity, 0) AS purchased_quantity,
        utc.user_ticket_id AS cart_user_ticket_id,
        utp.user_ticket_id AS purchased_user_ticket_id
    FROM tickets t
    LEFT JOIN user_tickets utc ON t.ticket_id = utc.ticket_id AND utc.user_id = ? AND utc.status = 'in_cart'
    LEFT JOIN user_tickets utp ON t.ticket_id = utp.ticket_id AND utp.user_id = ? AND utp.status = 'purchased'
    WHERE utc.user_id = ? OR utp.user_id = ? OR (utc.user_id IS NULL AND utp.user_id IS NULL)
    ORDER BY t.event_date ASC
    ");

    $stmt->execute([$user_id, $user_id, $user_id, $user_id]);
    $events = $stmt->fetchAll();
} else {
    // Fetch events
    $stmt = $pdo->prepare("
    SELECT t.event_name, t.event_date, t.price, t.available_quantity 
    FROM tickets t
    ORDER BY t.event_date ASC
    ");
    $stmt->execute();
    $events = $stmt->fetchAll();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Local Art Gallery - Event Calender</title>
    <!-- Other head elements -->

    <!-- Link to the CSS files -->
    <link rel="stylesheet" href="../CSS/navbar.css">
    <link rel="stylesheet" href="../CSS/events.css">  
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
            <h1>Event Calendar</h1>
        </header>

        <main>
            <section id="calendar-section">
                <h2>Upcoming Events</h2>
                <div id="calendar">
                    <table>
                        <thead>
                            <tr>
                                <th>Event</th>
                                <th>Date</th>
                                <th>Price</th>
                                <th>Available</th>
                                <?php if (isset($_SESSION['user_id'])) : ?>
                                    <?php echo "<th>In Cart</th>"; ?>
                                    <?php echo "<th>Purchased</th>"; ?>
                                    <?php echo "<th>Action</th>"; ?>
                                <?php endif; ?>
                            </tr>
                        </thead>
                        <tbody>
                            <?php if (isset($_SESSION['user_id'])): ?>
                                <?php foreach ($events as $event): ?>
                                    <tr>
                                        <td><?php echo htmlspecialchars($event['event_name']); ?></td>
                                        <td><?php echo htmlspecialchars($event['event_date']); ?></td>
                                        <td>$<?php echo htmlspecialchars($event['price']); ?></td>
                                        <td><?php echo htmlspecialchars($event['available_quantity']); ?></td>
                                        <td><?php echo htmlspecialchars($event['cart_quantity']); ?></td>
                                        <td><?php echo htmlspecialchars($event['purchased_quantity']); ?></td>
                                        <td>
                                            <?php if ($event['available_quantity'] > 0): ?>
                                                <a href="../PHP/add_to_cart.php?action=subtract&ticket_id=<?php echo $event['ticket_id']; ?> &source=events" class="button">Add to Cart</a>
                                            <?php endif; ?>

                                            <?php if ($event['cart_quantity'] > 0): ?>
                                                <a href="../PHP/update_cart.php?action=subtract&id=<?php echo $event['cart_user_ticket_id']; ?> &source=events" class="button">-</a>
                                                <a href="../PHP/update_cart.php?action=add&id=<?php echo $event['cart_user_ticket_id']; ?> &source=events" class="button">+</a>
                                            <?php endif; ?>
                                        </td>
                                    </tr>
                                <?php endforeach; ?>
                            <?php else: ?>
                                <?php foreach ($events as $event): ?>
                                    <tr>
                                        <td><?php echo htmlspecialchars($event['event_name']); ?></td>
                                        <td><?php echo htmlspecialchars($event['event_date']); ?></td>
                                        <td>$<?php echo htmlspecialchars($event['price']); ?></td>
                                        <td><?php echo htmlspecialchars($event['available_quantity']); ?></td>
                                    </tr>
                                <?php endforeach; ?>
                            <?php endif; ?>
                        </tbody>
                    </table>
                </div>
            </section>
        </main>
    </div>

    <footer>
        <p>&copy; 2023 Local Art Gallery</p>
    </footer>
    
    <!-- Include the navbar JavaScript file -->
    <script src="../Javascript/navbar.js"></script>
</body>
</html>
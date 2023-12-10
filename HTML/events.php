<?php
session_start();
require '../Database/dblogin.php'; //Database connection
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
                                <th>Date</th>
                                <th>Event</th>
                                <th>Price</th>
                                <?php if (isset($_SESSION['user_id'])) echo "<th>Action</th>"; ?>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            

                            $stmt = $pdo->query("SELECT * FROM tickets ORDER BY event_date ASC");
                            while ($row = $stmt->fetch()) {
                                echo "<tr>";
                                echo "<td>" . htmlspecialchars($row['event_date']) . "</td>";
                                echo "<td>" . htmlspecialchars($row['event_name']) . "</td>";
                                echo "<td>$" . htmlspecialchars($row['price']) . "</td>";
                                if (isset($_SESSION['user_id'])) {
                                    echo "<td><a href='../PHP/add_to_cart.php?ticket_id=" . $row['ticket_id'] . "' class='button'>Add to Cart</a></td>";
                                }
                                echo "</tr>";
                            }
                            ?>
                        </tbody>
                    </table>
                </div>
            </section>
        </main>
    </div>

    <footer>
        <p>&copy; 2023 Local Art Gallery</p>
    </footer>

<!-- The rest of your page content -->

<!-- Include the navbar JavaScript file -->
<script src="../Javascript/navbar.js"></script>
</body>
</html>
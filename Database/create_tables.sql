use ticketdb;

-- user_tickets first because it has foreign_keys to the other tables 
DROP TABLE if EXISTS user_tickets;
DROP TABLE if EXISTS users;
DROP TABLE if EXISTS tickets;

-- The users that are registered
CREATE TABLE users (
    id INT AUTO_INCREMENT PRIMARY KEY,
    username VARCHAR(50) NOT NULL UNIQUE,
    password VARCHAR(255) NOT NULL,
    email VARCHAR(100),
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

-- The tickets that are available
CREATE TABLE tickets (
    ticket_id INT AUTO_INCREMENT PRIMARY KEY,
    event_name VARCHAR(255) NOT NULL,
    price DECIMAL(10, 2) NOT NULL,
    event_date DATETIME,
    available_quantity INT NOT NULL
);

-- The tickets the user has bought
CREATE TABLE user_tickets (
    user_ticket_id INT AUTO_INCREMENT PRIMARY KEY,
    user_id INT NOT NULL,
    ticket_id INT NOT NULL,
    status ENUM('in_cart', 'purchased') NOT NULL,
    quantity INT NOT NULL,
    purchase_date TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (user_id) REFERENCES users(id),
    FOREIGN KEY (ticket_id) REFERENCES tickets(ticket_id)
);
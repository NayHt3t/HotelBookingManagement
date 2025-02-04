--For Category
INSERT INTO categories (name) VALUES
('Luxury Hotel'),
('Business Hotel'),
('Budget Hotel'),
('Resort Hotel'),
('Boutique Hotel');

--For Rooms
INSERT INTO rooms (room_type_id, room_number, location) VALUES
(1, '01', 'North Wing - 1st Floor'),
(1, '02', 'North Wing - 1st Floor'),
(1, '03', 'North Wing - 1st Floor'),
(1, '04', 'North Wing - 1st Floor'),
(1, '05', 'North Wing - 2nd Floor'),
(1, '06', 'North Wing - 2nd Floor'),
(1, '07', 'North Wing - 2nd Floor'),
(1, '08', 'North Wing - 2nd Floor'),
(1, '09', 'North Wing - 3rd Floor'),
(1, '10', 'North Wing - 3rd Floor');



//Price_Types
INSERT INTO price_types (name) VALUES 
('Regular'),
('Weekend'),
('Seasonal');


-- Presidential Suite
INSERT INTO room_prices (room_type_id, price_type_id, price) VALUES
(1, 1, 1500000),  -- Regular
(1, 2, 1700000),  -- Weekend
(1, 3, 2000000);  -- Seasonal

-- Royal Suite
INSERT INTO room_prices (room_type_id, price_type_id, price) VALUES
(2, 1, 1200000),
(2, 2, 1400000),
(2, 3, 1600000);

-- Deluxe King Room
INSERT INTO room_prices (room_type_id, price_type_id, price) VALUES
(3, 1, 1000000),
(3, 2, 1100000),
(3, 3, 1300000);

-- Single Room
INSERT INTO room_prices (room_type_id, price_type_id, price) VALUES
(4, 1, 50000),
(4, 2, 60000),
(4, 3, 70000);

-- Double Room
INSERT INTO room_prices (room_type_id, price_type_id, price) VALUES
(5, 1, 80000),
(5, 2, 90000),
(5, 3, 100000);

-- Family Room
INSERT INTO room_prices (room_type_id, price_type_id, price) VALUES
(6, 1, 120000),
(6, 2, 130000),
(6, 3, 150000);

-- Dormitory Room
INSERT INTO room_prices (room_type_id, price_type_id, price) VALUES
(7, 1, 20000),
(7, 2, 25000),
(7, 3, 30000);

--Customer
INSERT INTO customers (name, email, password, status) VALUES
('John Doe', 'john.doe@example.com', '$2y$10$DhvQw8H0KjtFjvXEi2uK8zqDgGeNcVxSij8PwpDbG6XLOuYGGuwR4', 1),
('Jane Smith', 'jane.smith@example.com', '$2y$10$hD8gGpXLCt9tZcHhNzXxu0gpeJtZKv7hX9G6TYtYlS17gHbgYPQYy', 1),
('Michael Johnson', 'michael.johnson@example.com', '$2y$10$Pr9vNJHg2gf9ZPfvRR5lAsWhtsT0kdg1bSFTBvAdz1eb20dtCT27u', 1),
('Emma Brown', 'emma.brown@example.com', '$2y$10$3uzOAN6w6L4PczIM4wmS7Pq9SxX56GVmES3c4w5NBlYZxt06E0uQO', 1),
('William Green', 'william.green@example.com', '$2y$10$jsDwEXQOEwtM1uF0J66Tx.JshFJ.pndD0OZCkhqBhE7w46dbZ7kt.', 1);




1. Luxury Hotel
Presidential Suite
Royal Suite
Executive Suite
Deluxe King Room
Penthouse Suite

2. Business Hotel
Executive King Room
Business Suite
Conference Suite
Standard Queen Room
Twin Executive Room

3. Budget Hotel
Single Room
Double Room
Economy Twin Room
Family Room
Dormitory Room

4. Resort Hotel
Beachfront Villa
Overwater Bungalow
Garden View Room
Private Pool Villa
Ocean View Suite
5. Boutique Hotel
Artistic Loft Room
Designer Suite
Cozy Queen Room
Themed Deluxe Room
Romantic Honeymoon Suite

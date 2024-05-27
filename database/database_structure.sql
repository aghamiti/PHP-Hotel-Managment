create database hotel_database;

use hotel_database;

CREATE TABLE rooms (
    RoomID INT PRIMARY KEY AUTO_INCREMENT,
    RoomNumber VARCHAR(10),
    RoomType VARCHAR(50),
    Description TEXT,
    Price DECIMAL(10, 2)
);

CREATE TABLE Bookings (
    BookingID INT PRIMARY KEY AUTO_INCREMENT,
    RoomID INT,
    GuestName VARCHAR(100),
    CheckInDate DATE,
    CheckOutDate DATE,
    Adults INT,
    Children INT,
    FOREIGN KEY (RoomID) REFERENCES Rooms(RoomID)
);

CREATE TABLE BlogPosts (
    PostID INT PRIMARY KEY AUTO_INCREMENT,
    Title VARCHAR(255),
    Content TEXT,
    ImageURL VARCHAR(255),
    PostedDate DATE
);

CREATE TABLE NewsletterSubscribers (
    SubscriberID INT PRIMARY KEY AUTO_INCREMENT,
    Email VARCHAR(255),
    SubscriptionDate DATE
);

CREATE TABLE Users (
    UserID INT PRIMARY KEY AUTO_INCREMENT,
    Username VARCHAR(100),
    Email VARCHAR(255),
    Password VARCHAR(255),
    NewsletterSubscription BOOLEAN,
    UserRole ENUM('admin', 'client') NOT NULL DEFAULT 'client',
    RegistrationDate DATE
);

CREATE TABLE contact_us (
    id INT AUTO_INCREMENT PRIMARY KEY AUTO_INCREMENT,
    name VARCHAR(255) NOT NULL,
    phone VARCHAR(20),
    email VARCHAR(255) NOT NULL,
    message TEXT NOT NULL,
    submission_date TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);
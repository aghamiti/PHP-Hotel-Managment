create database hotel_database;

use hotel_database;

CREATE TABLE rooms (
    RoomID INT PRIMARY KEY auto_increment,
    RoomNumber VARCHAR(10),
    RoomType VARCHAR(50),
    Description TEXT,
    ImageURL VARCHAR(255),
    Price DECIMAL(10, 2)
);

CREATE TABLE Bookings (
    BookingID INT PRIMARY KEY auto_increment,
    RoomID INT,
    GuestName VARCHAR(100),
    CheckInDate DATE,
    UserID INT,
    CheckOutDate DATE,
    Adults INT,
    Children INT,
    FOREIGN KEY (RoomID) REFERENCES Rooms(RoomID)
    FOREIGN KEY (UserID) REFERENCES Users(UserID)
);

CREATE TABLE BlogPosts (
    PostID INT PRIMARY KEY auto_increment,
    Title VARCHAR(255),
    Content TEXT,
    ImageURL VARCHAR(255),
    PostedDate DATE
);

CREATE TABLE NewsletterSubscribers (
    SubscriberID INT PRIMARY KEY auto_increment,
    Email VARCHAR(255),
    SubscriptionDate DATE
);

CREATE TABLE Users (
    UserID INT PRIMARY KEY auto_increment,
    Username VARCHAR(100),
    Email VARCHAR(255),
    Password VARCHAR(255),
    NewsletterSubscription BOOLEAN,
    UserRole ENUM('admin', 'client') NOT NULL DEFAULT 'client',
    RegistrationDate DATE
);

CREATE TABLE contact_us (
    id INT AUTO_INCREMENT PRIMARY KEY auto_increment,
    name VARCHAR(255) NOT NULL,
    phone VARCHAR(20),
    email VARCHAR(255) NOT NULL,
    message TEXT NOT NULL,
    submission_date TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);
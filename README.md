# Organ-donation-management-system
A full-stack web application designed to streamline and digitalize the organ donation workflow. The system enables donors, recipients, and administrators to interact through a unified platform that ensures transparency, quick matching, and efficient data handling.

![Organ donation management system Screenshot](https://i.imgur.com/mWM4kiC.png)
![Organ donation management system Screenshot](https://i.imgur.com/N3ak4tk.png)
![Organ donation management system Screenshot](https://i.imgur.com/IZyHSht.png)

# Donor Module

Register as an organ donor

Submit personal details, medical info & organ preferences

Track donation status

Secure data storage using MySQL

# Recipient Module
Apply for organ requirements
Provide medical details


# 💻 Tech Stack
# Frontend

HTML5, CSS3
JavaScript

# Backend

PHP
MySQL Database (via phpMyAdmin or VS Code MySQL extension)

# Tools

VS Code
XAMPP / MySQL Server
Git & GitHub

# PROJECT STRUCTURE *
/Organ-Donation-Management-System
│── index.html
│── donor_form.html
│── recipient_form.html
│── contact.html
│── /css
│     └── styles.css
│── /php
│     ├── connect.php
│     ├── saveDonor.php
│     ├── saveRecipient.php
│     └── saveContact.php
│── /assets
│     └── images, icons
│── README.md

# How to Run Locally
1. Clone the Repository
git clone https://github.com/yourusername/organ-donation-management-system.git
cd organ-donation-management-system

2. Start Apache & MySQL

Use XAMPP or MySQL server.

3. Import Database

Open phpMyAdmin
Create database:
organ_donation


4. Configure DB Connection

Edit /php/connect.php:

$servername = "localhost";
$username = "root";
$password = "";
$dbname = "organ_donation";

5. Run the Project

Place the project inside:

htdocs (if using XAMPP)


# Then visit:

http://localhost/organ-donation-management-system/




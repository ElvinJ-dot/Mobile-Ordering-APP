# Mobile-Ordering-APP
A mobile ordering app with secure user registration, login, and logout using PDO to prevent SQL Injection and XSS attacks. Users can select food items, and their orders are sent directly to the restaurant. Built with pure HTML, CSS, and JavaScript to strengthen foundational web development skills.
# Features
User Registration: Allows users to create an account with secure password storage (hashed using PHP’s password_hash()).
User Login/Logout: Secure user authentication with session management for logging in and out.
Food Selection: Users can browse a menu of food items and select their desired orders.
Order Submission: Selected items are sent as requests to the restaurant for processing.
Secure Database Interaction: All database queries are handled using PDO with prepared statements to prevent SQL Injection and protect against malicious input.
XSS Protection: Input from users is sanitized to prevent Cross-Site Scripting (XSS) attacks.
Minimalist Frontend: Built with pure HTML, CSS, and JavaScript to focus on core web development concepts and improve base knowledge.
Responsive Design: Optimized for use on mobile devices for a seamless ordering experience.
# Technologies Used
Frontend: Pure HTML, CSS, and JavaScript
Backend: PHP (with PDO for secure database interactions)
Server: XAMPP(Apache)
Database: MySQL
# Security
SQL Injection Prevention: All database interactions use PDO prepared statements to safely handle user input.
XSS Protection: User inputs are sanitized to ensure malicious scripts cannot be executed.
Password Security: Passwords are hashed using PHP’s password_hash() function for secure storage.
# Preview
![screencapture-localhost-35th-Street-Online-Ordering-2025-01-22-15_39_19](https://github.com/user-attachments/assets/16ba1fbd-6820-4c3f-9a8b-e161155893cd)
:)

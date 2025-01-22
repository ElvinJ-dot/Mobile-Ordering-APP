<link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;600&display=swap" rel="stylesheet">
<link rel="stylesheet" href="styles.css">
<?php

echo '<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>User Dashboard</title>
    <link rel="stylesheet" href="styles.css">


    <style>

body {
    justify-content: center;
    align-items: center;
    height: 100vh; /* Full viewport height */
    margin: 0; /* Remove default margin */
    background-color: #f9f9f9; /* Optional: Add a subtle background color */

}

#user-details {
    text-align: center;
    background-color: #ffffff; /* Optional: Add a background color to the div */
    padding: 20px;
    border-radius: 10px;
    box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1); /* Optional: Add a subtle shadow */
}
        
    h2 {
            color: #444;
        }

        a {
            color: #007BFF;
            text-decoration: none;
        }

        a:hover {
            text-decoration: underline;
        }

        .alert {
            margin: 20px auto;
            padding: 10px;
            background-color: #d4edda;
            color: #155724;
            border: 1px solid #c3e6cb;
            border-radius: 5px;
            text-align: center;
            width: 90%;
            max-width: 500px;
        }



        p {
            margin: 10px 0;
        }

.logout-link {
    display: inline-block;
    margin-top: 20px;
    padding: 10px 20px;
    background-color: red;
    color: white;
    border: none;
    border-radius: 5px;
    text-decoration: none;
    font-size: 14px;
    cursor: pointer;
    box-shadow: 0 2px 4px rgba(0, 0, 0, 0.2);
    transition: background-color 0.3s ease;
}

.logout-link:hover {
    background-color: darkorange;
}
    </style>

    <link rel="stylesheet" href="styles.css">
</head>
<body>';

include_once("header.php");
include_once("db_connection.php");
include_once("session.php");

if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

if (!isset($_SESSION["username"])): ?>
    <div class="alert">
        <p>You are currently not logged in. <a href="login.php">Login</a>. Not a member yet? <a href="signup.php">Sign up</a>.</p>
    </div>
<?php
else:
    if (!isset($_SESSION["first_login_shown"]) || $_SESSION["first_login_shown"] === false) {
        $showAlert = true;
        $_SESSION["first_login_shown"] = true;
        $alertScript = "
        <script>
            Swal.fire({
                title: 'Success',
                text: 'You are logged in as " . htmlspecialchars($_SESSION["username"]) . "',
                icon: 'success',
                confirmButtonText: 'OK'
            });
        </script>";
        
        if ($showAlert) {
            echo $alertScript;
        }
    }

    $username = $_SESSION["username"];
    $query = "SELECT email, join_date FROM users WHERE username = :username";
    $stmt = $conn->prepare($query);
    $stmt->execute(["username" => $username]);

    if ($stmt->rowCount() > 0) {
        $user = $stmt->fetch(PDO::FETCH_ASSOC);
        ?>
        <div id="user-details">
            <h2>Welcome, <?php echo htmlspecialchars($username); ?>!</h2>
            <p>Email: <?php echo htmlspecialchars($user["email"]); ?></p>
            <p>Join Date: <?php echo htmlspecialchars($user["join_date"]); ?></p>
            <a href="logout.php" class="logout-link">Logout</a>

        </div>
        <?php
    } else {
        echo "<p>Error fetching user details. Please try again later.</p>";
    }
    ?>
<?php endif;

include_once("footer.php");
echo '</body>
</html>';
?>

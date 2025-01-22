<?php
include_once('session.php');
include_once('utilities.php');
include_once('db_connection.php');

if (isset($_POST['loginBtn'])) {
    $form_errors = array();

    $required_fields = array('username', 'password');
    $form_errors = array_merge($form_errors, check_empty_fields($required_fields));

    if (empty($form_errors)) {
        $username = htmlspecialchars($_POST['username']);
        $password = $_POST['password'];
        isset($_POST['rememberMe']) ? $rememberMe = $_POST['rememberMe'] : $rememberMe = "";

        $sqlQuery = "SELECT * FROM users WHERE username = :username";
        $statement = $conn->prepare($sqlQuery);
        $statement->execute(array(':username' => $username));

        if ($statement->rowCount() > 0) {
            $row = $statement->fetch();
            $id = $row['id'];
            $hashed_password = $row['password'];

            if (password_verify($password, $hashed_password)) {
                session_regenerate_id(true);
                $_SESSION['id'] = $id;
                $_SESSION['username'] = $username;

                if ($rememberMe === "yes") {
                    rememberMe($id);
                }

                header('Location: account.php');
                exit;
            } else {
                $result = "<p style='padding: 20px; color: red; border: 1px solid gray;'>Invalid username or password</p>";
            }
        } else {
            $result = "<p style='padding: 20px; color: red; border: 1px solid gray;'>Invalid username or password</p>";
        }
    }
}

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <link rel="stylesheet" href="styles.css">
</head>
<body>
    <style>



main {
    justify-content: center;
    align-items: center;
    min-height: 100vh;
}

.login-form {
    background-color: #ffffff;
    border: 1px solid #ddd;
    border-radius: 10px;
    padding: 30px 20px;
    width: 100%;
    max-width: 400px;
    box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
    text-align: center;
    position: absolute;
       top: 50%;
       left: 50%;
       transform: translate(-50%, -50%);
}

form label {
    display: block;
    font-weight: bold;
    color: #333;
    margin-bottom: 8px;
    text-align: left;
}

form input[type="text"], 
form input[type="password"] {
    width: 90%;
    padding: 10px;
    margin-bottom: 20px;
    border: 1px solid #ddd;
    border-radius: 5px;
    font-size: 16px;
}

.checkbox {
    display: flex;
    align-items: center;
    justify-content: flex-start;
    margin-bottom: 20px;
}

.checkbox input {
    margin-right: 8px;
}

form input[type="submit"], 
button {
    background-color: #f57c00; 
    color: #fff;
    border: none;
    border-radius: 25px;
    padding: 12px 20px;
    font-size: 16px;
    cursor: pointer;
    transition: background-color 0.3s ease;
    width: 45%;
    margin-left: 10px;
    margin-top: 20px;

    float: left;
}

form input[type="submit"]:hover,
button:hover {
    background-color: #e65100;
}

/* Links */
a {
    color: #f57c00;
    text-decoration: none;
    margin-top: 10px;
    display: block;
}

a:hover {
    text-decoration: underline;
}

.result, .error-messages {
    color: #d32f2f; 
    margin: 10px 0;
    padding: 10px;
    border: 1px solid #d32f2f;
    background-color: #ffebee;
    border-radius: 5px;
}
</style>
    <main>
        <?php include('header.php'); ?>

        <div class="login-form">
    <?php if (isset($result)) echo "<div class='result'>$result</div>"; ?>
    <?php if (!empty($form_errors)) echo "<div class='error-messages'>" . show_errors($form_errors) . "</div>"; ?>

    <form action="login.php" method="post">
        <label for="username">Username:</label>
        <input type="text" id="username" name="username" placeholder="Enter your username" required>

        <label for="password">Password:</label>
        <input type="password" id="password" name="password" placeholder="Enter your password" required>
        

        <div class="checkbox">
            <input type="checkbox" id="rememberMe" name="rememberMe" value="yes">
            <label for="rememberMe">Remember Me</label>
        </div>
        <a href="forgot_password.php">Forgot Password</a>
        <a href="signup.php">Create an Account</a>
        <button onclick="window.history.back();">Go Back</button>


        <input type="submit" value="Login" name="loginBtn">

        
        
    </form>

    
</div>

        
       
    </main>
    <?php include('footer.php'); ?> 
</body>
</html>

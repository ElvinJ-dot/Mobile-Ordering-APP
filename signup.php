<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Signup</title>
    <link rel="stylesheet" href="styles.css">
</head>
<body>
    <?php 
    include('header.php');
    include_once('db_connection.php');
    include_once('utilities.php');

    $result = ""; // Initialize result message

    // Processing the form
    if (isset($_POST['signupBtn'])) {
        $form_errors = array();
        $required_fields = array('email', 'username', 'password', 'confirm_password');
        
        $form_errors = array_merge($form_errors, check_empty_fields($required_fields));
        $fields_to_check_length = array('username' => 4, 'password' => 6);  
        $form_errors = array_merge($form_errors, check_min_length($fields_to_check_length));
        $form_errors = array_merge($form_errors, check_email($_POST));

        // If no errors, proceed with insertion
        if (empty($form_errors)) {
            $email = htmlspecialchars($_POST['email']);
            $username = htmlspecialchars($_POST['username']);
            $password = htmlspecialchars($_POST['password']);
            $hashed_password = password_hash($password, PASSWORD_DEFAULT);

            $sqlinsert = "INSERT INTO users (email, username, password, join_date) VALUES (:email, :username, :password, NOW())";

            try {
                $statement = $conn->prepare($sqlinsert);
                $statement->execute(array(':email' => $email, ':username' => $username, ':password' => $hashed_password));

                if ($statement->rowCount() == 1) {
                    $result = "<p class='success'>Account created successfully!</p>";
                }
            } catch (PDOException $e) {
                // Log the error in a file for debugging
                error_log($e->getMessage(), 3, 'errors.log');
                $result = "<p class='error'>An error occurred. Please try again later.</p>";
            }
        }
    }
    ?>
    <h2>Signup Form</h2>
    <?php if (!empty($result)) echo $result; ?>
    <br>
    <?php if (!empty($form_errors)) echo show_errors($form_errors); ?>
    <form action="" method="post">
        <label for="email">Email:</label><br>
        <input type="email" id="email" name="email" required><br><br>
        
        <label for="username">Username:</label><br>
        <input type="text" id="username" name="username" required><br><br>
        
        <label for="password">Password:</label><br>
        <input type="password" id="password" name="password" required><br><br>
        
        <label for="confirm_password">Confirm Password:</label><br>
        <input type="password" id="confirm_password" name="confirm_password" required><br><br>
        
        <input type="submit" name="signupBtn" value="Sign Up">
    </form>
    <br>
    <button onclick="window.location.href='index.php';">Go Back</button>
</body>
</html>

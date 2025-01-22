<?php 
include_once('db_connection.php');
include_once('utilities.php');

if(isset($_POST['passwordResetBtn'])){

    $form_errors = array();

    $required_fields = array('email', 'new_password', 'confirm_password');
    $form_errors = array_merge($form_errors, check_empty_fields($required_fields));

    $fields_to_check_length = array('new_password' => 6, 'confirm_password' => 6);
    $form_errors = array_merge($form_errors, check_min_length($fields_to_check_length));

    $form_errors = array_merge($form_errors, check_email($_POST));

    if(empty($form_errors)){

        $email = $_POST['email'];
        $password1 = $_POST['new_password'];
        $password2 = $_POST['confirm_password'];

        if($password1 != $password2){
            $result = flash_message("Passwords do not match!", "Fail");
        } else {
            try {
                $sqlQuery = "SELECT email FROM users WHERE email = :email";
                $statement = $conn->prepare($sqlQuery);
                $statement->execute(array(':email' => $email));

                if($statement->rowCount() == 1){
                    $hashed_password = password_hash($password1, PASSWORD_DEFAULT);
                    $sqlUpdate = "UPDATE users SET password = :password WHERE email = :email";
                    $statement = $conn->prepare($sqlUpdate);
                    $statement->execute(array(':password' => $hashed_password, ':email' => $email));
                    $result = "<p style='color: green;'>Password Reset Successful!</p>";
                } else {
                    $result = "<p style='color: red;'>The email address does not exist in our database!</p>";
                }

            } catch (PDOException $ex) {
                $result = "<p style='color: red;'>An error occurred: ".$ex->getMessage()."</p>";
            }
        }
    } else {
        $error_count = count($form_errors);
        $result = "<p style='color: red;'>There " . ($error_count == 1 ? "is 1 error" : "are $error_count errors") . " in the form:</p>";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Password Reset</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 2rem;
        }
        form {
            width: 100%;
            max-width: 400px;
        }
        table {
            width: 100%;
        }
        input[type="email"], input[type="password"], input[type="submit"] {
            width: 100%;
            padding: 0.5rem;
            margin: 0.5rem 0;
        }
        input[type="submit"] {
            background-color: #007BFF;
            color: white;
            border: none;
            cursor: pointer;
        }
        input[type="submit"]:hover {
            background-color: #0056b3;
        }
    </style>
</head>
<body>

<h3>Password Reset</h3>

<?php if(isset($result)) echo $result; ?>
<?php if(!empty($form_errors)) echo show_errors($form_errors); ?>

<form method="POST" action="">
    <table>
        <tr>
            <td>Email:</td>
            <td><input type="email" name="email" value="<?php if(isset($email)) echo htmlspecialchars($email); ?>" required></td>
        </tr>
        <tr>
            <td>New Password:</td>
            <td><input type="password" name="new_password" required></td>
        </tr>
        <tr>
            <td>Confirm Password:</td>
            <td><input type="password" name="confirm_password" required></td>
        </tr>
        <tr>
            <td></td>
            <td><input type="submit" name="passwordResetBtn" value="Reset Password"></td>
        </tr>
    </table>
</form>

<p><a href="index.php">Go back</a></p>

</body>
</html>

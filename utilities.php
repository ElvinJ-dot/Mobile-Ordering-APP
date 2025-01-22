<?php

function check_empty_fields($required_fields_array) {
    $form_errors = [];

    foreach ($required_fields_array as $name_of_field) {
        if (!isset($_POST[$name_of_field]) || trim($_POST[$name_of_field]) === '') {
            $form_errors[] = "{$name_of_field} is a required field.";
        }
    }

    return $form_errors;
}

function check_min_length($fields_to_check_length) {
    $form_errors = [];

    foreach ($fields_to_check_length as $name_of_field => $minimum_length_required) {
        if (!isset($_POST[$name_of_field]) || strlen(trim($_POST[$name_of_field])) < $minimum_length_required) {
            $form_errors[] = "{$name_of_field} is too short, must be {$minimum_length_required} characters long.";
        }
    }

    return $form_errors;
}

function check_email($data) {
    $form_errors = [];
    $key = 'email';

    if (array_key_exists($key, $data)) {
        if (isset($data[$key]) && !empty($data[$key])) {
            $email = filter_var(trim($data[$key]), FILTER_SANITIZE_EMAIL);

            if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
                $form_errors[] = "{$key} is not a valid email address.";
            }
        }
    }

    return $form_errors;
}

function show_errors($form_errors_array) {
    $errors = "<p><ul style='color: red;'>";

    foreach ($form_errors_array as $the_error) {
        $errors .= "<li>{$the_error}</li>";
    }

    $errors .= "</ul></p>";

    return $errors;
}

function flash_message($message, $passOrFail = "Fail") {
    $color = $passOrFail === "Pass" ? "green" : "red";
    return "<p style='padding: 20px; color: {$color}; border: 1px solid gray;'>{$message}</p>";
}

function redirectTo($page) {
    header("Location: {$page}.php");
    exit;
}

function rememberMe($user_id) {
    $encryptCookieData = base64_encode("UaQteh5i4y3dntstemYODEC{$user_id}");
    setcookie(
        "rememberUserCookie",
        $encryptCookieData,
        time() + 60 * 60 * 24 * 30, 
        "/",
        "", // Use your domain or leave empty for default
        isset($_SERVER['HTTPS']), // Secure flag if using HTTPS
        true // HttpOnly flag
    );
}

function isCookieValid($conn, $cookie_name) {
    if (!isset($_COOKIE[$cookie_name])) {
        return false;
    }

    $decryptCookieData = base64_decode($_COOKIE[$cookie_name]);
    $user_id = explode("UaQteh5i4y3dntstemYODEC", $decryptCookieData);

    if (count($user_id) < 2) {
        return false;
    }

    $userID = $user_id[1];
    $sql = "SELECT * FROM users WHERE id = :id";
    $statement = $conn->prepare($sql);
    $statement->execute([':id' => $userID]);

    if ($row = $statement->fetch()) {
        return $row;
    }

    return false;
}

function signout() {
    unset($_SESSION['username']);
    unset($_SESSION['id']);

    if (isset($_COOKIE['rememberUserCookie'])) {
        unset($_COOKIE['rememberUserCookie']);
        setcookie('rememberUserCookie', '', time() - 3600, "/");
    }

    session_destroy();
    session_regenerate_id(true);
    redirectTo('index');
}

?>

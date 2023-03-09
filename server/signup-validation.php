<?php

session_start();

require_once 'app/DataBase.php';

$db = new DataBase();

$_SESSION['error'] = false;

function checkValidEmail($str) {
    if (!empty($str) && filter_var($str, FILTER_VALIDATE_EMAIL)) {
        return true;
    }
    return false;
}

if (isset($_POST['email'])) {
    if (!checkValidEmail($_POST['email'])) {
        $_SESSION['email-error'] = 'Enter correct email';
        $_SESSION['error'] = true;
    }
    if (checkValidEmail($_POST['email'])) {
        $userEmail = $_POST['email'];
        $dbEmail = $db->query("SELECT `email` FROM `users` WHERE `email` = '$userEmail'");
        if (empty($dbEmail)) {
            $_SESSION['email'] = $_POST['email'];
            $_SESSION['email-error'] = '';
            $_SESSION['error'] = false;
        } else {
            $_SESSION['email-error'] = 'This email is already being used';
            $_SESSION['error'] = true;
        }
    }
}

function checkValidLogin($str) {
    if (!empty($_POST['login']) && mb_strlen($_POST['login']) > 3 && mb_strlen($_POST['login']) <15) {
        return true;
    }
    return false;
}


if (isset($_POST['login'])) {
    if (!checkValidLogin($_POST['login'])) {
        $_SESSION['login-error'] = 'Enter correct login';
        $_SESSION['error'] = true;
    }
    if (checkValidLogin($_POST['login'])) {
        $userLogin = $_POST['login'];
        $dbLogin = $db->query("SELECT `login` FROM `users` WHERE `login` = '$userLogin'");
        if (empty($dbLogin)) {
            $_SESSION['login'] = $_POST['login'];
            $_SESSION['login-error'] = '';
            $_SESSION['error'] = false;
        } else {
            $_SESSION['login-error'] = 'This login is already being used';
            $_SESSION['error'] = true;
        }
    }
}

if (isset($_POST['city'])) {
    if (empty($_POST['city'])
        || mb_strlen($_POST['city']) < 3
        || preg_match('~[0-9]+~', $_POST['city'])) {
            $_SESSION['city-error'] = 'Enter correct city';
            $_SESSION['error'] = true;
    } else {
        $_SESSION['city'] = $_POST['city'];
        $_SESSION['city-error'] = '';
        $_SESSION['error'] = false;
    }
}

if (isset($_POST['gender']) && in_array($_POST['gender'], ['Male', 'Female'])) {
    $_SESSION['gender'] = $_POST['gender'];
    $_SESSION['gender-error'] = '';
    $_SESSION['error'] = false;
} else {
    $_SESSION['gender-error'] = 'Choose gender';
    $_SESSION['error'] = true;
}

$phone_number_regex = "/^\+[1-9][0-9]{11}$/";

if (isset($_POST['phone'])) {
    if (empty($_POST['phone'])
        || mb_strlen(trim($_POST['phone'])) !== 13
        || preg_match($phone_number_regex, trim($_POST['phone']) != 1)
    ) {
        $_SESSION['phone-error'] = 'Enter correct phone number';
        $_SESSION['error'] = true;
    } else {
        $_SESSION['phone'] = $_POST['phone'];
        $_SESSION['phone-error'] = '';
        $_SESSION['error'] = false;
    }
}

if (isset($_POST['password'])) {
    if (empty($_POST['password'])
        || mb_strlen(trim($_POST['password'])) < 5
        || mb_strlen(trim($_POST['password'])) > 10
    ) {
        $_SESSION['password-error'] = 'Enter correct password';
        $_SESSION['error'] = true;
    } else {
        $_SESSION['password'] = $_POST['password'];
        $_SESSION['password-error'] = '';
        $_SESSION['error'] = false;
    }
}

if (isset($_POST['confirm']) && isset($_POST['password'])) {
    if (empty($_POST['confirm'])
        || empty($_POST['password'])
        || trim($_POST['password']) != trim($_POST['confirm'])
    ) {
        $_SESSION['confirm-error'] = 'Confirm password correctly';
        $_SESSION['error'] = true;
    } else {
        $_SESSION['confirm'] = $_POST['confirm'];
        $_SESSION['confirm-error'] = '';
        $_SESSION['error'] = false;
    }
}

if ($_SESSION['error'] === false
    && !empty($_SESSION['email'])
    && !empty($_SESSION['login'])
    && !empty($_SESSION['city'])
    && !empty($_POST['gender'])
    && !empty($_SESSION['phone'])
    && !empty($_SESSION['password'])
) {
    $email = trim($_SESSION['email']);
    $login = trim($_SESSION['login']);
    $city = trim($_SESSION['city']);
    $gender = trim($_SESSION['gender']);
    $phone = trim($_SESSION['phone']);
    $password = trim($_SESSION['password']);

    $db->execute("INSERT INTO `users` (`email`, `login`, `city`, `gender`, `phone_number`, `password`) 
        VALUES ('$email', '$login', '$city', '$gender', '$phone', '$password')");

    $dbUserId = $db->query("
        SELECT `id` FROM `users` 
        WHERE (`email` = '$email' AND `password` = '$password')
        ");

    $_SESSION['user_id'] = $dbUserId[0]['id'];

    $host = $_SERVER['HTTP_HOST'];
    $uri = 'forms-php-mysql';
    $extra = 'client/posts-form.php';
    header("Location: http://$host/$uri/$extra");
    exit;

    session_destroy();
}

$host = $_SERVER['HTTP_HOST'];
$uri = 'forms-php-mysql';
$extra = 'client/signup-form.php';
header("Location: http://$host/$uri/$extra");
exit;

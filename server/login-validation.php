<?php

session_start();

require_once 'app/DataBase.php';

$db = new DataBase();

$_SESSION['login-valid-error'] = false;

if (isset($_SESSION['user_id'])) {
    unset($_SESSION['lf-error']);
}

if (isset($_POST['login-email']) && isset($_POST['password'])) {
    if (empty($_POST['login-email'])) {
        $_SESSION['lf-email-error'] = 'Email field cannot be empty';
    } else {
        if (empty($_POST['password'])) {
            $_SESSION['lf-password-error'] = 'Password field cannot be empty';
        }
    }
    $login = $_POST['login-email'];
    $password = $_POST['password'];
    $dbUserId = $db->query("
        SELECT `id` FROM `users` 
        WHERE (`email` = '$login' AND `password` = '$password')
        OR (`login` = '$login' AND `password` = '$password')
        ");
    if (!empty($dbUserId)) {
        $_SESSION['user_id'] = $dbUserId[0]['id'];
        $host = $_SERVER['HTTP_HOST'];
        $uri = 'forms-php-mysql';
        $extra = 'client/posts-form.php';
        header("Location: http://$host/$uri/$extra");
        exit;
    } else {
        $_SESSION['login-valid-error'] = true;
    }

}

if ($_SESSION['login-valid-error']) {
    $_SESSION['lf-error'] = 'Wrong email/login or password';
}


$host = $_SERVER['HTTP_HOST'];
$uri = 'forms-php-mysql';
$extra = 'client/login-form.php';
header("Location: http://$host/$uri/$extra");
exit;

<?php

session_start();

require_once 'app/DataBase.php';

$db = new DataBase();

$_SESSION['login-error'] = false;

if (isset($_POST['login-email']) && isset($_POST['password'])) {
    if (empty($_POST['login-email'])) {
        $_SESSION['lf-email-error'] = 'Email field cannot be empty';
    } else {
        if (empty($_POST['password'])) {
            $_SESSION['lf-password-error'] = 'Password field cannot be empty';
        }
    }
    $dbUserId = $db->query("
        SELECT `id` FROM `users` 
        WHERE (`email` = '" . $_POST['login-email'] . "' AND `password` = '" . $_POST['password'] . "')
        OR (`login` = '" . $_POST['login-email'] . "' AND `password` = '" . $_POST['password'] . "')
        ");
    if (!empty($dbUserId)) {
        $_SESSION['user_id'] = $dbUserId[0]['id'];
        $host = $_SERVER['HTTP_HOST'];
        $uri = 'forms-php-mysql';
        $extra = 'client/posts-form.php';
        header("Location: http://$host/$uri/$extra");
        exit;
    } else {
        $_SESSION['login-error'] = true;
    }

}

if ($_SESSION['login-error']) {
    $_SESSION['lf-error'] = 'You are not an authorised user';
}


$host = $_SERVER['HTTP_HOST'];
$uri = 'forms-php-mysql';
$extra = 'client/login-form.php';
header("Location: http://$host/$uri/$extra");
exit;
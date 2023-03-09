<?php

session_start();

if (isset($_SESSION['user_id'])) {
    session_destroy();
    echo "<h2>You left your account</h2>", PHP_EOL;
    echo "<a class='nav-link text-danger' href='index.php'>Back to home page</a>";
} else {
    $host = $_SERVER['HTTP_HOST'];
    $uri = 'forms-php-mysql';
    $extra = 'client/login-form.php';
    header("Location: http://$host/$uri/$extra");
    exit;
}



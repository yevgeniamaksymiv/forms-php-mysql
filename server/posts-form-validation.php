<?php

session_start();

require_once 'app/DataBase.php';

$db = new DataBase();

$_SESSION['error'] = false;

function checkValidTitle(string $str): bool {
    if (!empty($str) && mb_strlen($str) > 2 && mb_strlen($str) < 255) {
        return true;
    }
    return false;
}

if (isset($_POST['title'])) {
    if (!checkValidTitle($_POST['title'])) {
        $_SESSION['title-error'] = 'Enter correct title';
        $_SESSION['error'] = true;
    }
    if (checkValidTitle($_POST['title'])) {
        $dbTitle = $db->query("SELECT `post_title` FROM `posts` WHERE `post_title` = '".$_POST['title']."'");
        if (empty($dbTitle)) {
            $_SESSION['title'] = $_POST['title'];
            $_SESSION['title-error'] = '';
            $_SESSION['error'] = false;
        } else {
            $_SESSION['title-error'] = 'This title is already being used. Enter a different one';
            $_SESSION['error'] = true;
        }
    }
}

if (isset($_POST['annotation'])) {
    if (mb_strlen($_POST['annotation']) > 500) {
        $_SESSION['annotation-error'] = 'The number of character must be less than 500';
        $_SESSION['error'] = true;
    } else {
        $_SESSION['annotation'] = $_POST['annotation'];
        $_SESSION['annotation-error'] = '';
        $_SESSION['error'] = false;
    }
}

if (isset($_POST['content'])) {
    if (mb_strlen($_POST['content']) > 30000) {
        $_SESSION['content-error'] = 'The number of character must be less than 30000';
        $_SESSION['error'] = true;
    } else {
        $_SESSION['content'] = $_POST['content'];
        $_SESSION['content-error'] = '';
        $_SESSION['error'] = false;

    }
}

if (isset($_POST['email'])) {
    if (empty($_POST['email']) || !filter_var($_POST['email'], FILTER_VALIDATE_EMAIL)) {
        $_SESSION['email-error'] = 'Enter correct email';
        $_SESSION['error'] = true;
    } else {
        $_SESSION['email'] = $_POST['email'];
        $_SESSION['email-error'] = '';
        $_SESSION['error'] = false;
    }
}

if (isset($_POST['views'])) {
    if (!preg_match("/^[0-9]*$/", (int) $_POST['views']) || (int) $_POST['views'] < 0) {
        $_SESSION['views-error'] = 'Views must be a number and greater than zero';
        $_SESSION['error'] = true;
    } else {
        $_SESSION['views'] = $_POST['views'];
        $_SESSION['views-error'] = '';
        $_SESSION['error'] = false;
    }
}

function checkBiggerThanToday($date)
{
    $today = date("Y-m-d");
    if ($date < $today) {
        return true;
    }
}

if (isset($_POST['date']) && !empty($_POST['date'])) {
    $date = explode('-', $_POST['date']);

    if (!checkdate((int) $date[1], (int) $date[2], (int) $date[0])
        || !checkBiggerThanToday($_POST['date'])) {

        $_SESSION['date-error'] = 'Enter correct date';
        $_SESSION['error'] = true;
    } else {
        $_SESSION['date'] = $_POST['date'];
        $_SESSION['date-error'] = '';
        $_SESSION['error'] = false;
    }
}

if (!isset($_POST['publish_in_index'])) {
    $_SESSION['publish-error'] = 'Check Yes or No';
}

if (isset($_POST['category']) && in_array($_POST['category'], ['Спорт', 'Культура', 'Политика'])) {
    $_SESSION['category'] = $_POST['category'];
    $_SESSION['category-error'] = '';
    $_SESSION['error'] = false;
} else {
    $_SESSION['category-error'] = 'Choose category';
    $_SESSION['error'] = true;
}

if ($_SESSION['error'] === false
    && !empty($_SESSION['title'])
    && !empty($_SESSION['annotation'])
    && !empty($_SESSION['content'])
    && !empty($_SESSION['email'])
    && !empty($_SESSION['views'])
    && !empty($_SESSION['date'])
    && !empty($_POST['publish_in_index'])
    && !empty($_POST['category'])
//    && !empty($_SESSION['user-id'])
) {
    $title = trim($_SESSION['title']);
    $annotation = trim($_SESSION['annotation']);
    $content = trim($_SESSION['content']);
    $email = trim($_SESSION['email']);
    $views = (int) trim($_SESSION['views']);
    $date = trim($_SESSION['date']);
    $is_publish = trim($_POST['publish_in_index']);
    $category = trim($_SESSION['category']);
    $user_id = $_SESSION['user-id'];
    $db->execute("
        INSERT INTO `posts` (
            `user_id`, 
            `post_title`,
            `post_annotation`, 
            `post_content`, 
            `user_email`, 
            `views_count`,
            `publish_date`,
            `is_published`,
            `is_published_on_main`,
            `post_category`
            ) 
        VALUES (
            '$user_id', '$title', '$annotation', '$content', '$email', '$views', '$date', null, '$is_publish', '$category'
        )
        ");

//    session_destroy();
}

//$host = $_SERVER['HTTP_HOST'];
//$uri = 'forms-php-mysql';
//$extra = 'client/posts-form.php';
//header("Location: http://$host/$uri/$extra");
//exit;


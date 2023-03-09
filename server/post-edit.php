<?php

session_start();

require_once 'app/DataBase.php';

$db = new DataBase();

if (isset($_POST['delete'])) {
    $postId = $_POST['delete_post'];
    $db->query("DELETE FROM `posts` WHERE `id` = '$postId'");

    $_SESSION['delete-info'] = 'Post was successfully deleted';

    $host = $_SERVER['HTTP_HOST'];
    $uri = 'forms-php-mysql';
    $extra = 'client/all-posts.php';
    header("Location: http://$host/$uri/$extra");
    exit;
    return;
}

function checkValidTitle(string $str): bool
{
    if (!empty($str) && mb_strlen($str) > 2 && mb_strlen($str) < 255) {
        return true;
    }
    return false;
}

function checkBiggerThanToday($date)
{
    $today = date("Y-m-d");
    if ($date < $today) {
        return true;
    }
}
function validateForm($db): bool
{
    $_SESSION['error'] = false;
    $_SESSION['non-valid-title'] = false;

    if (isset($_POST['title'])) {
        if (!checkValidTitle($_POST['title'])) {
            $_SESSION['title-error'] = 'Enter correct title';
            $_SESSION['error'] = true;
        }
        if (checkValidTitle($_POST['title'])) {
            $id = $_POST['edit_post'];
            $dbTitles = $db->query("SELECT `post_title` FROM `posts` WHERE `id` <> '$id'");

            foreach ($dbTitles as $el) {
                    if ($el['post_title'] !== $_POST['title']) {
                        $_SESSION['title'] = $_POST['title'];
                        $_SESSION['title-error'] = '';
                        $_SESSION['error'] = false;
                    } else {
                        $_SESSION['title-error'] = 'This title is already being used. Enter a different one';
                        $_SESSION['non-valid-title'] = true;
                        $_SESSION['error'] = true;
                    }
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

    if (isset($_POST['views'])) {
        if (!preg_match("/^[0-9]*$/", (int)$_POST['views']) || (int)$_POST['views'] < 0) {
            $_SESSION['views-error'] = 'Views must be a number and greater than zero';
            $_SESSION['error'] = true;
        } else {
            $_SESSION['views'] = $_POST['views'];
            $_SESSION['views-error'] = '';
            $_SESSION['error'] = false;
        }
    }


    if (isset($_POST['date']) && !empty($_POST['date'])) {
        $date = explode('-', $_POST['date']);

        if (!checkdate((int)$date[1], (int)$date[2], (int)$date[0])
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

    if ($_SESSION['error'] === false && $_SESSION['non-valid-title'] === false) {
        return true;
    }
    return false;
}

if (isset($_POST['edit'])) {
    $postIdEdit = $_POST['edit_post'];
    $isValid = validateForm($db);

    if ($isValid) {
        $titleNew = trim($_SESSION['title']);
        $annotationNew = trim($_SESSION['annotation']);
        $contentNew = trim($_SESSION['content']);
        $viewsNew = (int)trim($_SESSION['views']);
        $dateNew = trim($_SESSION['date']);
        $is_publishNew = trim($_POST['publish_in_index']);
        $categoryNew = trim($_SESSION['category']);
        $user_id = (int)$_SESSION['user_id'];

        $db->execute("UPDATE `posts` 
           SET `user_id` = '$user_id', 
            `post_title` = '$titleNew',
            `post_annotation` = '$annotationNew', 
            `post_content` = '$contentNew', 
            `views_count` = '$viewsNew',
            `publish_date` = '$dateNew',
            `is_published` = null,
            `is_published_on_main` = '$is_publishNew',
            `post_category` = '$categoryNew'
            WHERE `id` = '$postIdEdit'
           ");

        $_SESSION['update-info'] = 'Post was successfully updated';

        unset(
            $_SESSION['title'],
            $_SESSION['title-error'],
            $_SESSION['annotation'],
            $_SESSION['content'],
            $_SESSION['views'],
            $_SESSION['date'],
            $_POST['publish_in_index'],
            $_POST['category']
        );

        $host = $_SERVER['HTTP_HOST'];
        $uri = 'forms-php-mysql';
        $extra = 'client/all-posts.php';
        header("Location: http://$host/$uri/$extra");
        exit;
        return;
    } else {
        $host = $_SERVER['HTTP_HOST'];
        $uri = 'forms-php-mysql';
        $extra = 'client/post.php';
        header("Location: http://$host/$uri/$extra");
        exit;
    }
}


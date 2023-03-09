<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
    <title>Posts</title>
</head>
<body>

    <nav class="navbar navbar-expand-lg navbar-light bg-light">
    <ul class="navbar-nav">
        <li class="nav-item active">
            <a class="nav-link" href="signup-form.php">SIGN UP</a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="login-form.php">LOG IN</a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="posts-form.php">ADD POST</a>
        </li>
        <li>
            <a class="nav-link text-primary" href="all-posts.php">ALL POSTS</a>
        </li>
        <li>
            <a class="nav-link text-danger" href="logout.php">LOG OUT</a>
        </li>
    </ul>
</nav>
    <div class="container">
        <h2 class="py-3">All posts</h2>

        <ul class="list-group list-group-flush">

            <?php
            session_start();

            if (!isset($_SESSION['user_id'])) {
                $host = $_SERVER['HTTP_HOST'];
                $uri = 'forms-php-mysql';
                $extra = 'client/login-form.php';
                header("Location: http://$host/$uri/$extra");
                exit;
            }

            require_once '../server/app/DataBase.php';
            $db = new DataBase();
            $titles = $db->query("SELECT `id`, `post_title` FROM `posts`");

            foreach ($titles as $el) {
                echo "
                <li class='list-group-item'>
                    <form method='post' action='post.php'>
                        <input type='hidden' name='post_id' value='{$el['id']}'>
                        <input class='form-control shadow-none' type='submit' name='post_title' value='{$el['post_title']}' readonly>
                    </form>
                </li>
                ";
            }

            ?>
        </ul>

    </div>
</body>
</html>

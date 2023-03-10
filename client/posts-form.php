<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Palmo</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
</head>
<body>

<?php
session_start();

if (!isset($_SESSION['user_id'])) {
    $host = $_SERVER['HTTP_HOST'];
    $uri = 'forms-php-mysql';
    $extra = 'client/login-form.php';
    header("Location: http://$host/$uri/$extra");
    exit;
}

?>

<br>
<div class="container">
    <div class="row">

        <form style="width: 100%" method="post" action="../server/posts-form-validation.php">
            <div class="form-group row">
                <label for="title" class="col-md-2 col-form-label">Заголовок</label>
                <div class="col-md-10">
                    <input
                            type="text"
                            class="form-control"
                            id="title"
                            name="title"
                            value="<?php
if (isset($_SESSION['title-error'])) {
    echo '';
}
if (isset($_SESSION['title'])) {
    echo $_SESSION['title'];
}
?>
">
                    <div class="invalid-feedback d-block"><?php
                        echo $_SESSION['title-error'] ?? '';
                        ?>
                    </div>
                </div>
            </div>

            <div class="form-group row">
                <label for="annotation" class="col-md-2 col-form-label">Аннотация</label>
                <div class="col-md-10">
                    <textarea
                            name="annotation"
                            id="annotation"
                            class="form-control"
                            cols="30"
                            rows="10"><?php
if (isset($_SESSION['annotation-error'])) {
    echo '';
}
if (isset($_SESSION['annotation'])) {
    echo $_SESSION['annotation'];
}
?>
</textarea>
                    <div class="invalid-feedback d-block">
                      <?php
                      echo $_SESSION['annotation-error'] ?? '';
                      ?>
                    </div>
                </div>
            </div>

            <div class="form-group row">
                <label for="content" class="col-md-2 col-form-label">Текст новости</label>
                <div class="col-md-10">
                    <textarea
                            name="content"
                            id="content"
                            class="form-control"
                            cols="30"
                            rows="10">
                            <?php
if (isset($_SESSION['content-error'])) {
    echo '';
}
if (isset($_SESSION['content'])) {
    echo $_SESSION['content'];
}
?>
                          </textarea>
                    <div class="invalid-feedback d-block">
                      <?php
                      echo $_SESSION['content-error'] ?? '';
                      ?>
                    </div>
                </div>
            </div>

            <div class="form-group row">
                <label for="views" class="col-md-2 col-form-label">Кол-во просмотров</label>
                <div class="col-md-10">
                    <input
                            type="text"
                            class="form-control"
                            id="views"
                            name="views"
                            value="
                            <?php
if (isset($_SESSION['views-error'])) {
    echo '';
}
if (isset($_SESSION['views'])) {
    echo $_SESSION['views'];
}
?>
">
                    <div class="invalid-feedback d-block">
                      <?php
                      echo $_SESSION['views-error'] ?? '';
                      ?>
                    </div>
                </div>
            </div>

            <div class="form-group row">
                <label for="date" class="col-md-2 col-form-label">Дата публикации</label>
                <div class="col-md-10">
                    <input
                            type="date"
                            class="form-control"
                            id="date"
                            name="date"
                            value="
                            <?php
if (isset($_SESSION['date-error'])) {
    echo '';
}
if (isset($_SESSION['date'])) {
    echo $_SESSION['date'];
}
?>
">
                    <div class="invalid-feedback d-block">
                      <?php
                      echo $_SESSION['date-error'] ?? '';
                      ?>
                    </div>
                </div>
            </div>

            <div class="form-group row">
                <label for="is_publish" class="col-md-2 col-form-label">Публичная новость</label>
                <div class="col-md-10">
                    <input
                            type="checkbox"
                            class="form-control"
                            id="is_publish"
                            name="is_publish"
                    >
                    <div class="invalid-feedback"></div>
                </div>
            </div>

            <div class="form-group row">
                <label class="col-md-2 col-form-label">Публиковать на главной</label>
                <div class="col-md-10">
                    <div class="form-check">
                        <input class="form-check-input" type="radio" name="publish_in_index" id="publish_in_index_yes" value="yes" checked>
                        <label class="form-check-label" for="publish_in_index_yes">
                            Да
                        </label>
                    </div>
                    <div class="form-check">
                        <input class="form-check-input" type="radio" name="publish_in_index" id="publish_in_index_no" value="no">
                        <label class="form-check-label" for="publish_in_index_no">
                            Нет
                        </label>
                    </div>
                    <div class="invalid-feedback d-block">
                      <?php
                      echo $_SESSION['publish-error'] ?? '';
                      ?>
                    </div>
                </div>
            </div>

            <div class="form-group row">
                <label for="category" class="col-md-2 col-form-label">Категория</label>
                <div class="col-md-10">
                    <select id="category" class="form-control" name="category">
                        <option disabled selected>Выберете категорию из списка..</option>
                        <option value="Спорт">Спорт</option>
                        <option value="Культура">Культура</option>
                        <option value="Политика">Политика</option>
                    </select>
                    <div class="invalid-feedback d-block">
                      <?php
                      echo $_SESSION['category-error'] ?? '';
                      ?>
                    </div>
                </div>
            </div>

            <div class="form-group row">
                <div class="col-md-9">
                    <button type="submit" class="btn btn-primary">Отправить</button>
                </div>
                <div class="col-md-3">
                      <?php
if (isset($_SESSION['error']) && $_SESSION['error'] === true) {
    echo '<div class="alert alert-danger">Невалідна форма</div>';
} else {
    echo '<div class="alert alert-success">Валідна форма</div>';
}

?>
                </div>
            </div>
        </form>

    </div>
</div>
</body>
</html>
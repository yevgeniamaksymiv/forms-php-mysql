<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
    <title>Login</title>
</head>
<body>

<?php
session_start();

?>
    <div class="container">
        <h2 class="py-3">Authorisation form</h2>

        <form style="width: 100%" method="post" action="../server/login-validation.php">
            <div class="form-group row">
                <label for="login-email" class="col-md-2 col-form-label">Enter login or email</label>
                <div class="col-md-10">
                    <input
                        type="text"
                        class="form-control"
                        id="login-email"
                        name="login-email"
                        value="<?php
                        if (isset($_SESSION['lf-email-error'])) {
                            echo '';
                        }
                        if (isset($_SESSION['lf-email'])) {
                            echo $_SESSION['lf-email'];
                        }
                        ?>
">
                    <div class="invalid-feedback d-block">
                        <?php
                        echo $_SESSION['lf-email-error'] ?? '';
                        ?>
                    </div>
                </div>
            </div>

            <div class="form-group row">
                <label for="password" class="col-md-2 col-form-label">Password</label>
                <div class="col-md-10">
                    <input
                        type="password"
                        name="password"
                        id="password"
                        class="form-control"
                        value="<?php
                        if (isset($_SESSION['lf-password-error'])) {
                            echo '';
                        }
                        if (isset($_SESSION['lf-password'])) {
                            echo $_SESSION['lf-password'];
                        }
                        ?>"
                    />
                    <div class="invalid-feedback d-block">
                        <?php
                        echo $_SESSION['lf-password-error'] ?? '';
                        ?>
                    </div>
                </div>
            </div>
            <div class="form-group row">
                <div class="col-md-9">
                    <button type="submit" class="btn btn-primary">Login</button>
                </div>
            </div>
            <div class="invalid-feedback d-block">
                <?php
                if (isset($_SESSION['lf-error'])) {
                    echo "<h5>{$_SESSION['lf-error']}</h5>", PHP_EOL;
                    echo "
                    <div class='mt-3'>
                        <a class='btn btn-success' href='signup-form.php'>Sign up</a>
                    </div>";
                }
                ?>
            </div>

        </form>
    </div>

</body>
</html>

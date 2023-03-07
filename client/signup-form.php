<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Signup</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
</head>
<body>

<?php
session_start();

?>

<br>
<div class="container">
    <div class="row">
        <h2 class="py-3">Registration form</h2>

        <form style="width: 100%" method="post" action="../server/signup-validation.php">
            <div class="form-group row">
                <label for="email" class="col-md-2 col-form-label">Email</label>
                <div class="col-md-10">
                    <input
                        type="email"
                        class="form-control"
                        id="email"
                        name="email"
                        value="<?php
                        if (isset($_SESSION['email-error'])) {
                            echo '';
                        }
                        if (isset($_SESSION['email'])) {
                            echo $_SESSION['email'];
                        }
                        ?>
">
                    <div class="invalid-feedback d-block"><?php
                        if (isset($_SESSION['email-error'])) {
                            echo $_SESSION['email-error'];
                        }?>
                    </div>
                </div>
            </div>

            <div class="form-group row">
                <label for="login" class="col-md-2 col-form-label">Login</label>
                <div class="col-md-10">
                    <input
                        name="login"
                        id="login"
                        class="form-control"
                        value="<?php
                        if (isset($_SESSION['login-error'])) {
                            echo '';
                        }
                        if (isset($_SESSION['login'])) {
                            echo $_SESSION['login'];
                        }
                        ?>"
                    />
                    <div class="invalid-feedback d-block">
                        <?php
                        if (isset($_SESSION['login-error'])) {
                            echo $_SESSION['login-error'];
                        }
                        ?>
                    </div>
                </div>
            </div>

            <div class="form-group row">
                <label for="city" class="col-md-2 col-form-label">City</label>
                <div class="col-md-10">
                    <input
                        name="city"
                        id="city"
                        class="form-control"
                        value="<?php
                        if (isset($_SESSION['city-error'])) {
                            echo '';
                        }
                        if (isset($_SESSION['city'])) {
                            echo $_SESSION['city'];
                        }
                        ?>"
                        />
                    <div class="invalid-feedback d-block">
                        <?php
                        if (isset($_SESSION['city-error'])) {
                            echo $_SESSION['city-error'];
                        }
                        ?>
                    </div>
                </div>
            </div>

            <div class="form-group row">
                <label for="gender" class="col-md-2 col-form-label">Sex</label>
                <div class="col-md-10">
                    <select id="gender" class="form-control" name="gender">
                        <option disabled selected>Select</option>
                        <option value="Male">Male</option>
                        <option value="Female">Female</option>
                    </select>
                    <div class="invalid-feedback d-block">
                        <?php
                        if (isset($_SESSION['gender-error'])) {
                            echo $_SESSION['gender-error'];
                        }
                        ?>
                    </div>
                </div>
            </div>

            <div class="form-group row">
                <label for="phone" class="col-md-2 col-form-label">Phone number</label>
                <div class="col-md-10">
                    <input
                        type="text"
                        class="form-control"
                        id="phone"
                        name="phone"
                        placeholder="+380123456789"
                        value="
                            <?php
                        if (isset($_SESSION['phone-error'])) {
                            echo '';
                        }
                        if (isset($_SESSION['phone'])) {
                            echo $_SESSION['phone'];
                        }
                        ?>
">
                    <div class="invalid-feedback d-block">
                        <?php
                        if (isset($_SESSION['phone-error'])) {
                            echo $_SESSION['phone-error'];
                        }
                        ?>
                    </div>
                </div>
            </div>

            <div class="form-group row">
                <label for="password" class="col-md-2 col-form-label">Password</label>
                <div class="col-md-10">
                    <input
                        type="password"
                        class="form-control"
                        id="password"
                        name="password"
                        value="<?php
                        if (isset($_SESSION['password-error'])) {
                            echo '';
                        }
                        if (isset($_SESSION['password'])) {
                            echo $_SESSION['password'];
                        }
                        ?>"
                    >
                    <div class="invalid-feedback d-block">
                        <?php
                        if (isset($_SESSION['password-error'])) {
                            echo $_SESSION['password-error'];
                        }
                        ?>
                    </div>
                </div>
            </div>

            <div class="form-group row">
                <label for="confirm" class="col-md-2 col-form-label">Confirm password</label>
                <div class="col-md-10">
                    <input
                        type="password"
                        class="form-control"
                        id="confirm"
                        name="confirm"
                        value="<?php
                        if (isset($_SESSION['confirm-error'])) {
                            echo '';
                        }
                        if (isset($_SESSION['confirm'])) {
                            echo $_SESSION['confirm'];
                        }
                        ?>"
                    >
                    <div class="invalid-feedback d-block">
                        <?php
                        if (isset($_SESSION['confirm-error'])) {
                            echo $_SESSION['confirm-error'];
                        }
                        ?>
                    </div>
                </div>
            </div>

            <div class="form-group row">
                <div class="col-md-9">
                    <button type="submit" class="btn btn-primary">Submit</button>
                </div>
                <div class="col-md-3">
                    <?php
                    if (isset($_SESSION['error']) && $_SESSION['error'] === true) {
                        echo '<div class="alert alert-danger">Invalid form</div>';
                    } else {
                        echo '<div class="alert alert-success">Valid form</div>';
                    }

                    ?>
                </div>
            </div>
        </form>

    </div>
</div>
</body>
</html>


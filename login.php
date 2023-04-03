<?php require_once "template-part/header.php" ?>

<?php

if (isset($_SESSION["name"]))
    echo "<script>window.location = window.location.origin</script>";

if (isset($_POST["submit"])) {
    $login = trim(htmlspecialchars($_POST["login"]));
    $pass = trim(htmlspecialchars($_POST["password"]));
    $errors = [];

    $ps = 'SELECT * FROM users WHERE login = "' . $login . '"';
    $query = mysqli_query(connect(), $ps);
    $user = mysqli_fetch_array($query);

    if ($login == "")
        $errors["login"] = "Заполните это поле.";

    if (!$user)
        $errors["login"] = isset($errors["login"]) ? $errors["login"] : "Пользователь с таким логином не найден.";

    if ($user && $user["password"] !== md5($pass))
        $errors["pass"] = "Логин или пароль введен не верно.";

    $success = [];
    if (count($errors) === 0) {
        $_SESSION["name"] = $user["login"];
        echo "<script>window.location = window.location.origin</script>";
    }
}
?>
    <main class="d-flex justify-content-center align-items-center">
        <div class="container">
            <div class="row">
                <div class="col-lg-4 col-12 offset-lg-4">
                    <?php if (!isset($success["success"])) : ?>
                        <h1 class="text-center mb-5">Вход в аккаунт</h1>
                        <form action="" method="POST" class="login-form">
                            <div class="form-group mb-3">
                                <label for="login">Логин</label>
                                <input type="text" name="login" id="login" class="form-control"
                                       value="<?php echo isset($login) ? $login : "" ?>">
                                <?php if (isset($errors["login"])) : ?>
                                    <small class="text-danger"><?php echo $errors["login"] ?></small>
                                <?php endif; ?>
                            </div>
                            <div class="form-group mb-3">
                                <label for="password">Пароль</label>
                                <input type="password" name="password" id="password" class="form-control"
                                       value="<?php echo isset($pass) ? $pass : "" ?>">
                                <?php if (isset($errors["pass"])) : ?>
                                    <small class="text-danger"><?php echo $errors["pass"] ?></small>
                                <?php endif; ?>
                            </div>
                            <div class="text-center">
                                <button class="btn btn-primary m-auto" name="submit">Войти</button>
                            </div>
                        </form>
                    <?php else: ?>
                        <h1 class="text-center text-success mb-5">
                            <?php echo $success["success"] ?>
                            <a href="/login.php" class="btn btn-primary">Войти в аккаунт</a>
                        </h1>
                    <?php endif; ?>
                </div>
            </div>
        </div>
    </main>
<?php require_once "template-part/footer.php" ?>
<?php require_once "template-part/header.php" ?>

<?php
if (isset($_POST["submit"])) {
    $login = trim(htmlspecialchars($_POST["login"]));
    $surname = trim(htmlspecialchars($_POST["surname"]));
    $name = trim(htmlspecialchars($_POST["name"]));
    $pass = trim(htmlspecialchars($_POST["password"]));
    $country = trim(htmlspecialchars($_POST["country"]));
    $city = trim(htmlspecialchars($_POST["city"]));
    $errors = [];

    if (strlen($login) < 3 || strlen($login) > 20)
        $errors["login"] = "Логин должен содержать от 3 до 20 символов.";

    $ps = 'SELECT * FROM users WHERE login = "' . $login . '"';
    $query = mysqli_query(connect(), $ps);
    $loginExists = mysqli_fetch_array($query);

    if ($loginExists)
        $errors["login"] = "Пользователь с таким логином уже существует.";

    if (strlen($surname) < 3 || strlen($surname) > 20)
        $errors["surname"] = "Фамилия должна содержать от 3 до 20 символов.";

    if (strlen($name) < 3 || strlen($name) > 20)
        $errors["name"] = "Имя должно содержать от 3 до 20 символов.";

    if (strlen($pass) < 6)
        $errors["pass"] = "Пароль должен содержать минимум 6 символов.";

    if (strlen($country) < 3 || strlen($country) > 20)
        $errors["country"] = "Страна должна содержать от 2 до 20 символов.";

    if (strlen($city) < 3 || strlen($city) > 20)
        $errors["city"] = "Город должен содержать от 2 до 20 символов.";

    $success = [];
    if (count($errors) === 0) {
        $ps = 'INSERT INTO users(login, surname, name, password, country, city) 
                VALUES("' . $login . '", "' . $surname . '", "' . $name . '", "' . md5($pass) . '", "' . $country . '", "' . $city . '")';
        mysqli_query(connect(), $ps);
        $success["success"] = "Вы успешно зарегистрированы!";
    }
}
?>
    <main class="d-flex justify-content-center align-items-center">
        <div class="container">
            <div class="row">
                <div class="col-lg-4 col-12 offset-lg-4">
                    <?php if (!isset($success["success"])) : ?>
                        <h1 class="text-center mb-5">Регистрация</h1>
                        <form action="" method="POST" class="register-form">
                            <div class="form-group mb-3">
                                <label for="login">Логин</label>
                                <input type="text" name="login" id="login" class="form-control"
                                       value="<?php echo isset($login) ? $login : "" ?>">
                                <?php if (isset($errors["login"])) : ?>
                                    <small class="text-danger"><?php echo $errors["login"] ?></small>
                                <?php endif; ?>
                            </div>
                            <div class="form-group mb-3">
                                <label for="surname">Фамилия</label>
                                <input type="text" name="surname" id="surname" class="form-control"
                                       value="<?php echo isset($surname) ? $surname : "" ?>">
                                <?php if (isset($errors["surname"])) : ?>
                                    <small class="text-danger"><?php echo $errors["surname"] ?></small>
                                <?php endif; ?>
                            </div>
                            <div class="form-group mb-3">
                                <label for="name">Имя</label>
                                <input type="text" name="name" id="name" class="form-control"
                                       value="<?php echo isset($name) ? $name : "" ?>">
                                <?php if (isset($errors["name"])) : ?>
                                    <small class="text-danger"><?php echo $errors["name"] ?></small>
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
                            <div class="form-group mb-3">
                                <label for="country">Страна</label>
                                <input type="text" name="country" id="country" class="form-control"
                                       value="<?php echo isset($country) ? $country : "" ?>">
                                <?php if (isset($errors["country"])) : ?>
                                    <small class="text-danger"><?php echo $errors["country"] ?></small>
                                <?php endif; ?>
                            </div>
                            <div class="form-group mb-4">
                                <label for="city">Город</label>
                                <input type="text" name="city" id="city" class="form-control"
                                       value="<?php echo isset($city) ? $city : "" ?>">
                                <?php if (isset($errors["city"])) : ?>
                                    <small class="text-danger"><?php echo $errors["city"] ?></small>
                                <?php endif; ?>
                            </div>
                            <div class="text-center">
                                <button class="btn btn-primary m-auto" name="submit" disabled>Регистрация</button>
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
<?php
require_once "template-part/header.php";


$sectorsQuery = mysqli_query(connect(), 'SELECT * FROM sectors');
$sectors = mysqli_fetch_all($sectorsQuery, MYSQLI_ASSOC);

if (isset($_POST["submit"])) {
    $name = trim(htmlspecialchars($_POST["name"]));
    $sector = $_POST["sector"];
    $ps = 'INSERT INTO categories(sector_id, name) VALUES(' . $sector . ',"' . $name . '")';
    mysqli_query(connect(), $ps);
    echo "<script>window.location=window.location.origin</script>";
}
?>
    <main class="d-flex justify-content-center align-items-center">
        <div class="container">
            <div class="row">
                <div class="col-lg-4 col-12 offset-lg-4">
                    <form action="" method="POST" class="validate-form">
                        <?php if ($sectors) : ?>
                            <div class="form-group mb-3">
                                <label for="sector">Выберите сектор</label>
                                <select name="sector" id="sector" class="form-select">
                                    <?php foreach ($sectors as $sector) : ?>
                                        <option value="<?php echo $sector["id"] ?>">
                                            <?php echo $sector["name"] ?>
                                        </option>
                                    <?php endforeach; ?>
                                </select>
                            </div>
                        <?php endif; ?>
                        <div class="form-group mb-3">
                            <label for="name">Название категории</label>
                            <input type="text" name="name" id="name" class="form-control">
                        </div>
                        <div class="text-center">
                            <button class="btn btn-primary m-auto" name="submit" disabled>Добавить</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </main>
<?php require_once "template-part/footer.php" ?>
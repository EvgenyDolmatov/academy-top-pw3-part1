<?php
require_once "template-part/header.php";


$catQuery = mysqli_query(connect(), 'SELECT * FROM categories');
$categories = mysqli_fetch_all($catQuery, MYSQLI_ASSOC);

if (isset($_POST["submit"])) {
    $category = $_POST["category"];
    $brand = trim(htmlspecialchars($_POST["brand"]));
    $model = trim(htmlspecialchars($_POST["model"]));
    $price = trim(htmlspecialchars($_POST["price"]));

    $ps = 'INSERT INTO products(brand, model, price, category_id) VALUES("' . $brand . '", "' . $model . '", "' . $price . '", ' . $category . ')';
    mysqli_query(connect(), $ps);
    echo "<script>window.location=window.location.origin</script>";
}
?>
    <main class="d-flex justify-content-center align-items-center">
        <div class="container">
            <div class="row">
                <div class="col-lg-4 col-12 offset-lg-4">
                    <form action="" method="POST" class="validate-form">
                        <?php if ($categories) : ?>
                            <div class="form-group mb-3">
                                <label for="category">Категория товара</label>
                                <select name="category" id="category" class="form-select">
                                    <?php foreach ($categories as $category) : ?>
                                        <option value="<?php echo $category["id"] ?>">
                                            <?php echo $category["name"] ?>
                                        </option>
                                    <?php endforeach; ?>
                                </select>
                            </div>
                        <?php endif; ?>
                        <div class="form-group mb-3">
                            <label for="brand">Бренд</label>
                            <input type="text" name="brand" id="brand" class="form-control">
                        </div>
                        <div class="form-group mb-3">
                            <label for="model">Модель</label>
                            <input type="text" name="model" id="model" class="form-control">
                        </div>
                        <div class="form-group mb-3">
                            <label for="price">Цена, руб.</label>
                            <input type="text" name="price" id="price" class="form-control">
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
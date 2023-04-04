<?php
require_once "template-part/header.php";


$psProd = 'SELECT * FROM products';
$prodParams = "";


if (count($_GET)) {
    $prodParams = "?";
    $psConditions = [];
    $psSort = [];
    foreach ($_GET as $prop => $val) {

        $prodParams .= $prop . "=" . $val;

        if ($prop == "category") {
            $psConditions[] = 'category_id=' . $val;
        }

        if ($prop == "min_price") {
            $psConditions[] = 'price >= ' . $val;
        }

        if ($prop == "max_price") {
            $psConditions[] = 'price <= ' . $val;
        }

        if ($prop == "brand") {
            $list = '';
            for ($i = 0; $i < count($val); $i++) {
                $list .= '"' . $val[$i] . '"';
                $list .= $i !== count($val) - 1 ? "," : "";
            }

            $psConditions[] = 'brand IN (' . $list . ')';
        }
    }

    if (isset($_GET["sort_price"])) {
        $psSort[] = "price " . $_GET["sort_price"];
    }

    if (isset($_GET["sort_brand"])) {
        $psSort[] = "brand " . $_GET["sort_brand"];
    }

    if (count($psConditions)) {
        $psProd .= " WHERE " . implode(" AND ", $psConditions);
    }

    if (count($psSort)) {
        $psProd .= " ORDER BY " . implode(", ", $psSort);
    }
}

$prodQuery = mysqli_query(connect(), $psProd);
$products = mysqli_fetch_all($prodQuery, MYSQLI_ASSOC);
?>

<main>
    <div class="container">
        <div class="content my-5">

            <div class="row">
                <div class="col-lg-3 col-12">
                    <form action="" method="GET">

                        <h5 class="mb-3">Цена</h5>
                        <div class="form-group mb-3 d-flex justify-content-start align-items-center">
                            <label for="min_price" style="margin-right: 10px;">От</label>
                            <input type="number" id="min_price" name="min_price" class="form-control"
                                   value="<?php echo $_GET["min_price"] ?? getMinPrice() ?>">
                        </div>
                        <div class="form-group mb-3 d-flex justify-content-start align-items-center">
                            <label for="max_price" style="margin-right: 10px;">До</label>
                            <input type="number" id="max_price" name="max_price" class="form-control"
                                   value="<?php echo $_GET["max_price"] ?? getMaxPrice() ?>">
                        </div>
                        <hr>
                        <h5 class="mb-3">Производитель</h5>
                        <?php
                        $brands = getBrands();
                        foreach ($brands as $key => $brand):
                            ?>
                            <div class="form-group mb-2">
                                <label for="<?php echo "brand" . ($key + 1) ?>" style="margin-right: 10px;">
                                    <input type="checkbox" id="<?php echo "brand" . ($key + 1) ?>" name="brand[]"
                                           class="form-check-input"
                                           value="<?php echo $brand["brand"] ?>" <?php echo isCheckedBrand($brand) ?>>
                                    <?php echo $brand["brand"] ?>
                                </label>
                            </div>
                        <?php endforeach; ?>
                        <hr>
                        <button class="btn btn-primary" name="filter_btn">Фильтр</button>
                    </form>
                </div>

                <div class="col-lg-9 col-12">
                    <div class="sort d-flex mb-3">
                        <p style="margin-right: 20px;">Сортировать по бренду:
                            <?php if (isset($_GET) && $_GET["sort"] === "asc") : ?>
                                <span>возрастанию</span>
                            <?php else: ?>
                                <a href="<?php echo $_SERVER['REQUEST_URI'] . "&sort_brand=ASC" ?>">возрастанию</a>
                            <?php endif; ?> /

                            <?php if (isset($_GET) && $_GET["sort"] === "desc") : ?>
                                <span>убыванию</span>
                            <?php else: ?>
                                <a href="<?php echo $_SERVER['REQUEST_URI'] . "&sort_brand=DESC" ?>">убыванию</a>
                            <?php endif; ?>
                        </p>

                        <p>Сортировать по цене:
                            <?php if (isset($_GET) && $_GET["price"] === "asc") : ?>
                                <span>возрастанию</span>
                            <?php else: ?>
                                <a href="<?php echo $_SERVER['REQUEST_URI'] . "&sort_price=DESC" ?>">возрастанию</a>
                            <?php endif; ?> /

                            <?php if (isset($_GET) && $_GET["price"] === "desc") : ?>
                                <span>убыванию</span>
                            <?php else: ?>
                                <a href="<?php echo $_SERVER['REQUEST_URI'] . "&sort_price=DESC" ?>">убыванию</a>
                            <?php endif; ?>
                        </p>
                    </div>

                    <div class="row">
                        <?php if ($products): ?>
                            <?php foreach ($products as $prod) : ?>
                                <div class="col-md-4 col-6">
                                    <div class="card mb-3">
                                        <div class="card-header"><?php echo $prod["brand"] . " " . $prod["model"] ?></div>
                                        <ul class="list-group list-group-flush">
                                            <li class="list-group-item">
                                                <?php echo "Производитель: " . $prod["brand"] ?>
                                            </li>
                                            <li class="list-group-item">
                                                <?php echo "Модель: " . $prod["model"] ?>
                                            </li>
                                            <li class="list-group-item">
                                                <?php echo "Цена: " . $prod["price"] . " руб." ?>
                                            </li>
                                        </ul>
                                    </div>
                                </div>
                            <?php endforeach; ?>
                        <?php else: ?>
                            <div class="col-12">
                                <p>В этой категории товары не найдены.</p>
                            </div>
                        <?php endif; ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
</main>

<?php require_once "template-part/footer.php" ?>

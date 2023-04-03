<?php
require_once "template-part/header.php";


$psProd = 'SELECT * FROM products WHERE category_id=' . $_GET["category"];
if (isset($_GET["sort"])) {
    $psProd .= $_GET["sort"] == "asc" ? " ORDER BY brand" : " ORDER BY brand DESC";
}
if (isset($_GET["price"])) {
    $psProd .= $_GET["price"] == "asc" ? " ORDER BY price" : " ORDER BY price DESC";
}
$prodQuery = mysqli_query(connect(), $psProd);
$products = mysqli_fetch_all($prodQuery, MYSQLI_ASSOC);
?>

<main>
    <div class="container">
        <div class="content my-5">

            <div class="sort d-flex">
                <p style="margin-right: 20px;">Сортировать по бренду:
                    <?php if (isset($_GET) && $_GET["sort"] === "asc") : ?>
                        <span>возрастанию</span>
                    <?php else: ?>
                        <a href="<?php echo "/products.php?category=" . $_GET["category"] . "&sort=asc" ?>">возрастанию</a>
                    <?php endif; ?> /

                    <?php if (isset($_GET) && $_GET["sort"] === "desc") : ?>
                        <span>убыванию</span>
                    <?php else: ?>
                        <a href="<?php echo "/products.php?category=" . $_GET["category"] . "&sort=desc" ?>">убыванию</a>
                    <?php endif; ?>
                </p>

                <p>Сортировать по цене:
                    <?php if (isset($_GET) && $_GET["price"] === "asc") : ?>
                        <span>возрастанию</span>
                    <?php else: ?>
                        <a href="<?php echo "/products.php?category=" . $_GET["category"] . "&price=asc" ?>">возрастанию</a>
                    <?php endif; ?> /

                    <?php if (isset($_GET) && $_GET["price"] === "desc") : ?>
                        <span>убыванию</span>
                    <?php else: ?>
                        <a href="<?php echo "/products.php?category=" . $_GET["category"] . "&price=desc" ?>">убыванию</a>
                    <?php endif; ?>
                </p>
            </div>

            <h1 class="mb-4">Товары</h1>
            <div class="row">
                <?php if ($products): ?>
                    <?php foreach ($products as $prod) : ?>
                        <div class="col-lg-3 col-md-4 col-6">
                            <div class="card">
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
</main>

<?php require_once "template-part/footer.php" ?>

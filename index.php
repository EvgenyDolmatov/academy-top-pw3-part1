<?php
require_once "template-part/header.php";


$psSectors = 'SELECT * FROM sectors';
$sectorsQuery = mysqli_query(connect(), $psSectors);
$sectors = mysqli_fetch_all($sectorsQuery, MYSQLI_ASSOC);

$psCategories = 'SELECT * FROM categories';
$categoriesQuery = mysqli_query(connect(), $psCategories);
$categories = mysqli_fetch_all($categoriesQuery, MYSQLI_ASSOC);
?>

<main>
    <div class="container">
        <div class="actions my-5">
            <a href="/add-sector.php" class="btn btn-primary">Добавить сектор</a>
            <?php if ($sectors) : ?>
                <a href="add-category.php" class="btn btn-primary">Добавить категорию</a>
            <?php else: ?>
                <button class="btn btn-dark" disabled>Добавить категорию</button>
            <?php endif; ?>

            <?php if ($categories) : ?>
                <a href="add-product.php" class="btn btn-primary">Добавить товар</a>
            <?php else: ?>
                <button class="btn btn-dark" disabled>Добавить товар</button>
            <?php endif; ?>
        </div>

        <div class="content">
            <h1 class="mb-4">Секторы</h1>
            <div class="d-flex justify-content-start">
                <?php foreach ($sectors as $sector) : ?>
                    <a href="<?php echo "/categories.php?sector=" . $sector["id"] ?>"
                       class="btn btn-lg btn-outline-primary" style="margin-right: 10px;">
                        <?php echo $sector["name"] ?>
                    </a>
                <?php endforeach; ?>
            </div>
        </div>
    </div>
</main>

<?php require_once "template-part/footer.php" ?>

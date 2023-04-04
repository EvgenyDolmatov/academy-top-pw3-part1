<?php
require_once "template-part/header.php";


$psCategories = 'SELECT * FROM categories WHERE sector_id=' . $_GET["sector"];
$catQuery = mysqli_query(connect(), $psCategories);
$categories = mysqli_fetch_all($catQuery, MYSQLI_ASSOC);
?>

<main>
    <div class="container">
        <div class="content my-5">
            <h1 class="mb-4">Категории</h1>
            <?php if ($categories) : ?>
                <div class="d-flex justify-content-start">
                    <?php foreach ($categories as $category) : ?>
                        <a href="<?php echo "/products.php?category=" . $category["id"] ?>"
                           class="btn btn-lg btn-outline-primary" style="margin-right: 10px;">
                            <?php echo $category["name"] ?>
                        </a>
                    <?php endforeach; ?>
                </div>
            <?php else: ?>
                <p>В этом секторе категории не найдены.</p>
            <?php endif; ?>
        </div>
    </div>
</main>

<?php require_once "template-part/footer.php" ?>

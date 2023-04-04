<?php
require_once "template-part/header.php";


if (isset($_POST["submit"])) {
    $name = trim(htmlspecialchars($_POST["name"]));
    $ps = 'INSERT INTO sectors(name) VALUES("' . $name . '")';
    mysqli_query(connect(), $ps);
    echo "<script>window.location=window.location.origin</script>";
}
?>
    <main class="d-flex justify-content-center align-items-center">
        <div class="container">
            <div class="row">
                <div class="col-lg-4 col-12 offset-lg-4">
                    <form action="" method="POST" class="validate-form">
                        <div class="form-group mb-3">
                            <label for="name">Название сектора</label>
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
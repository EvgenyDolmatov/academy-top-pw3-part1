<?php
session_start();

function connect($host = "localhost", $name = "evgeniy", $pass = "Evgeniy@1989", $db = "php_hw3")
{
    $connect = new mysqli($host, $name, $pass, $db);

    if ($connect->connect_errno) {
        echo "Неверное подключение к базе данных: " . $connect->connect_error;
        exit();
    }

    return $connect;
}

function getMinPrice()
{
    $priceSel = 'SELECT MIN(price) AS price FROM products';
    $priceQuery = mysqli_query(connect(), $priceSel);
    return mysqli_fetch_all($priceQuery, MYSQLI_ASSOC)[0]["price"];
}

function getMaxPrice()
{
    $priceSel = 'SELECT MAX(price) AS price FROM products';
    $priceQuery = mysqli_query(connect(), $priceSel);
    return mysqli_fetch_all($priceQuery, MYSQLI_ASSOC)[0]["price"];
}

function getBrands()
{
    $sel = 'SELECT DISTINCT brand FROM products';
    $query = mysqli_query(connect(), $sel);
    return mysqli_fetch_all($query, MYSQLI_ASSOC);
}

function isCheckedBrand($brand)
{
    if (isset($_GET["brand"]) && in_array($brand["brand"], $_GET["brand"])) {
        return "checked";
    }
    return "";
}
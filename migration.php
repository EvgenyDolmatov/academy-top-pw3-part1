<?php
require_once "functions.php";

$db_name = "php_hw3";

// Создаем таблицу Users
$createUsersTable = 'CREATE TABLE users(
    id INT NOT NULL AUTO_INCREMENT PRIMARY KEY,
    login VARCHAR(128) NOT NULL UNIQUE,
    surname VARCHAR(128) NOT NULL,
    name VARCHAR(128) NOT NULL,
    password VARCHAR(255) NOT NULL,
    country VARCHAR(128),
    city VARCHAR(128)
) DEFAULT charset="utf8"';
$usersQuery = mysqli_query(connect(), 'SELECT * FROM information_schema.tables WHERE table_schema = "' . $db_name . '" AND table_name = "users" LIMIT 1');
if (mysqli_fetch_array($usersQuery) === null)
    mysqli_query(connect(), $createUsersTable);

// Создаем таблицу Sectors
$createSectorsTable = 'CREATE TABLE sectors(
    id INT NOT NULL AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(128) NOT NULL UNIQUE
) DEFAULT charset="utf8"';
$sectorsQuery = mysqli_query(connect(), 'SELECT * FROM information_schema.tables WHERE table_schema = "' . $db_name . '" AND table_name = "sectors" LIMIT 1');
if (!mysqli_fetch_array($sectorsQuery))
    mysqli_query(connect(), $createSectorsTable);

// Создаем таблицу Categories
$createCategoriesTable = 'CREATE TABLE categories(
    id INT NOT NULL AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(128) NOT NULL UNIQUE,
    sector_id INT,
    FOREIGN KEY (sector_id) REFERENCES sectors(id) ON DELETE CASCADE
) DEFAULT charset="utf8"';
$categoriesQuery = mysqli_query(connect(), 'SELECT * FROM information_schema.tables WHERE table_schema = "' . $db_name . '" AND table_schema = "' . $db_name . '" AND table_name = "categories" LIMIT 1');
if (!mysqli_fetch_array($categoriesQuery))
    mysqli_query(connect(), $createCategoriesTable);

// Создаем таблицу Products
$createProductsTable = 'CREATE TABLE products(
    id INT NOT NULL AUTO_INCREMENT PRIMARY KEY,
    brand VARCHAR(128) NOT NULL,
    model VARCHAR(128) NOT NULL,
    price FLOAT DEFAULT 0,
    category_id INT,
    FOREIGN KEY (category_id) REFERENCES categories(id) ON DELETE CASCADE
) DEFAULT charset="utf8"';
$productsQuery = mysqli_query(connect(), 'SELECT * FROM information_schema.tables WHERE table_schema = "' . $db_name . '" AND table_name = "products" LIMIT 1');
if (mysqli_fetch_array($productsQuery) == null)
    mysqli_query(connect(), $createProductsTable);
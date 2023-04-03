<?php
require_once "functions.php";

$db_name = "php_hw3";

// Создаем таблицу USERS
$createUsersTable = 'CREATE TABLE users(
    id INT NOT NULL AUTO_INCREMENT PRIMARY KEY,
    login VARCHAR(128) NOT NULL UNIQUE,
    surname VARCHAR(128) NOT NULL,
    name VARCHAR(128) NOT NULL,
    password VARCHAR(255) NOT NULL,
    country VARCHAR(128),
    city VARCHAR(128)
) DEFAULT charset="utf8"';

$usersQuery = mysqli_query(connect(), 'SELECT * FROM information_schema.tables WHERE table_name = "users" LIMIT 1');
if (!mysqli_fetch_array($usersQuery))
    mysqli_query(connect(), $createUsersTable);


// Создаем таблицу SECTORS
$createSectorsTable = 'CREATE TABLE sectors(
    id INT NOT NULL AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(128) NOT NULL UNIQUE
) DEFAULT charset="utf8"';

$sectorsQuery = mysqli_query(connect(), 'SELECT * FROM information_schema.tables WHERE table_name = "sectors" LIMIT 1');
if (!mysqli_fetch_array($sectorsQuery))
    mysqli_query(connect(), $createSectorsTable);
<?php
require_once "functions.php";


$users = 'CREATE TABLE users(
    id INT NOT NULL AUTO_INCREMENT PRIMARY KEY,
    login VARCHAR(128) NOT NULL UNIQUE,
    surname VARCHAR(128) NOT NULL,
    name VARCHAR(128) NOT NULL,
    password VARCHAR(255) NOT NULL,
    country VARCHAR(128),
    city VARCHAR(128)
) DEFAULT charset="utf8"';

mysqli_query(connect(), $users);
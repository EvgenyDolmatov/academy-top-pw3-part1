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
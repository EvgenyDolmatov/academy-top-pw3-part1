<?php

function connect($host = "localhost", $name = "root", $pass = "", $db = "test")
{
    $connect = new mysqli($host, $name, $pass, $db);

    if ($connect->connect_errno) {
        echo "Неверное подключение к базе данных: " . $connect->connect_error;
        exit();
    }

    return $connect;
}
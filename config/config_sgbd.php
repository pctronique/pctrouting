<?php
require __DIR__ . "/filedotenv.php";
load_file_env(__DIR__);

$type = "mysql";
$server = $_ENV['NAME_PROJECT'] . "_mariadb";
$port = "0";
$dbname = $_ENV['SGBD_DATABASE'];
$user = "root";
$pass = $_ENV['SGBD_PASSWORD'];
$prefix = "";

<?php
define('DB_HOST', 'localhost');
define('DB_USER', 'sansteelo17');
define('DB_PASS', '123456');
define('DB_NAME', 'feedback_app');

//create connection
$connection = new mysqli(DB_HOST, DB_USER, DB_PASS, DB_NAME);

//check connection
if ($connection->connect_error) {
    die("Failed! $connection->connect_error");
}
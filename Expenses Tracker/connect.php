<?php
define('DB_HOST', 'localhost');
define('DB_USER', 'carl');
define('DB_PASS', '9807oipu');//@9807Oip
define('DB_NAME', 'testone');

$conn = new mysqli(DB_HOST, DB_USER, DB_PASS, DB_NAME);

if ($conn->connect_error) {
    die('Connection Failed' . $conn->connect_error);
}

?>
<?php
define('DB_HOST', 'localhost');
define('DB_USER', 'id21296534_expensestracker');
define('DB_PASS', '@Unity9807oipu');
define('DB_NAME', 'id21296534_expensestracker');

$conn = new mysqli(DB_HOST, DB_USER, DB_PASS, DB_NAME);

if ($conn->connect_error) {
    die('Connection Failed' . $conn->connect_error);
}

?>
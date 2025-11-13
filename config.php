<?php

define('DB_HOST', 'localhost');
define('DB_USER', 'root');
define('DB_PASS', '');         
define('DB_NAME', 'organshare');

function get_db_connection() {
    $mysqli = new mysqli(DB_HOST, DB_USER, DB_PASS, DB_NAME);
    if ($mysqli->connect_errno) {
        http_response_code(500);
        die("DB connect failed: " . $mysqli->connect_error);
    }
    // set charset to utf8mb4
    $mysqli->set_charset("utf8mb4");
    return $mysqli;
}

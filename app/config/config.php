<?php


define("BASE_URL", "http://localhost/yws/public");
define('DB_HOST', 'DESKTOP-BPCB1F9');
define('DB_USER', '');
define('DB_PASS', '');
define('DB_NAME', 'final_project_db');

$connect = sqlsrv_connect(DB_HOST, array("Database" => DB_NAME, "UID" => DB_USER, "PWD" => DB_PASS));

if ($connect) {
    // echo "Connection established.<br />";
} else {
    echo "Connection could not be established.<br />";
    die(print_r(sqlsrv_errors(), true));
}



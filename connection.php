<?php
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Methods: POST, GET, OPTIONS");
header("Access-Control-Allow-Headers: Origin, X-Requested-With, Content-Type, Accept");

$host = "localhost";
$db_user = "root";
$db_pass = null;
$db_name = "hospitals_db";

$mysqli = new mysqli($host, $db_user, $db_pass, $db_name);
?>
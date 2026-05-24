<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

$db_server = 'db';
$db_andmebaas = 'autorent';
$db_kasutaja = 'autorent_user';
$db_salasona = 'autorent_pass';

$yhendus = mysqli_connect($db_server, $db_kasutaja, $db_salasona, $db_andmebaas);

if (!$yhendus) {
    die('Ei saa ühendust andmebaasiga');
}

mysqli_set_charset($yhendus, 'utf8mb4');

require_once __DIR__ . '/functions.php';
?>

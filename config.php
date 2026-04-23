<?php
// Sinu andmed
$db_server = 'localhost';
$db_andmebaas = 'autorent';
$db_kasutaja = 'erik';
$db_salasona = 'passw0rd';


// Ühendus andmebaasiga
$yhendus = mysqli_connect($db_server, $db_kasutaja, $db_salasona, $db_andmebaas);


// Ühenduse kontroll
if (!$yhendus) {
    die('Ei saa ühendust andmebaasiga');
}
?>
<?php
include('../config.php');
require_admin();

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['delid'])) {
    $id = (int)$_POST['delid'];
    $stmt = mysqli_prepare($yhendus, 'DELETE FROM cars WHERE id = ?');
    mysqli_stmt_bind_param($stmt, 'i', $id);
    mysqli_stmt_execute($stmt);
}

header('Location: index.php?msg=kustutatud');
exit();
?>

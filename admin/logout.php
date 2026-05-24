<?php
include('../config.php');
require_admin();
session_destroy();
header('Location: login.php');
exit();
?>

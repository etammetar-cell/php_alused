<?php
function e($value) {
    return htmlspecialchars((string)$value, ENT_QUOTES, 'UTF-8');
}

function is_admin() {
    return isset($_SESSION['user_id'], $_SESSION['role']) && $_SESSION['role'] === 'admin';
}

function is_logged_in() {
    return isset($_SESSION['user_id']);
}

function require_admin() {
    if (!is_admin()) {
        header('Location: login.php');
        exit();
    }
}

function app_path($path = '') {
    $in_admin = strpos($_SERVER['SCRIPT_NAME'], '/admin/') !== false;
    $prefix = $in_admin ? '../' : '';
    return $prefix . ltrim($path, '/');
}
?>

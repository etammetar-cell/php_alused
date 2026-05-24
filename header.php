<?php
if (!function_exists('e')) {
    require_once __DIR__ . '/functions.php';
}
?>
<!doctype html>
<html lang="et">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Autorent</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-sRIl4kxILFvY47J16cr9ZwB07vP4J8+LH7qKQnuqkuIAvNWLzeN8tE5YBujZqJLB" crossorigin="anonymous">
    <link href="<?php echo e(app_path('style.css')); ?>" rel="stylesheet">
  </head>
  <body>
    <nav class="navbar navbar-expand-lg navbar-light bg-white border-bottom sticky-top">
      <div class="container">
        <a class="navbar-brand fw-semibold" href="<?php echo e(app_path('index.php')); ?>">Autorent</a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarContent" aria-controls="navbarContent" aria-expanded="false" aria-label="Ava menu">
          <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarContent">
          <ul class="navbar-nav me-auto mb-2 mb-lg-0">
            <li class="nav-item"><a class="nav-link" href="<?php echo e(app_path('register.php')); ?>">Registreeru</a></li>
            <?php if (is_admin()) { ?>
              <li class="nav-item"><a class="nav-link" href="<?php echo e(app_path('admin/index.php')); ?>">Autod</a></li>
              <li class="nav-item"><a class="nav-link" href="<?php echo e(app_path('admin/reservations.php')); ?>">Broneeringud</a></li>
            <?php } ?>
          </ul>
          <form class="d-flex me-2 site-search" role="search" method="get" action="<?php echo e(app_path('index.php')); ?>">
            <input class="form-control" type="search" placeholder="Otsi marki" aria-label="Otsi" name="otsi">
            <button class="btn btn-outline-primary" type="submit">Otsi</button>
          </form>
          <?php if (is_admin()) { ?>
            <a href="<?php echo e(app_path('admin/logout.php')); ?>" class="btn btn-outline-danger">Logi välja</a>
          <?php } else { ?>
            <a href="<?php echo e(app_path('admin/login.php')); ?>" class="btn btn-outline-primary">Admin</a>
          <?php } ?>
        </div>
      </div>
    </nav>

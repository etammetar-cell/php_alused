<?php
include('../config.php');
require_admin();

$error = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $mark = trim($_POST['mark'] ?? '');
    $model = trim($_POST['model'] ?? '');
    $engine = trim($_POST['engine'] ?? '');
    $fuel = trim($_POST['fuel'] ?? '');
    $price = (int)($_POST['price'] ?? 0);

    if ($mark === '' || $model === '' || $engine === '' || $fuel === '' || $price <= 0) {
        $error = 'Täida kõik väljad korrektselt.';
    } else {
        $stmt = mysqli_prepare($yhendus, 'INSERT INTO cars (mark, model, engine, fuel, price) VALUES (?, ?, ?, ?, ?)');
        mysqli_stmt_bind_param($stmt, 'ssssi', $mark, $model, $engine, $fuel, $price);
        mysqli_stmt_execute($stmt);
        header('Location: index.php?msg=lisatud');
        exit();
    }
}
?>
<?php include('../header.php'); ?>

<main class="container">
  <h1 class="h3 mb-3">Auto lisamine</h1>
  <?php if ($error !== '') { ?>
    <div class="alert alert-danger" role="alert"><?php echo e($error); ?></div>
  <?php } ?>
  <form action="lisa.php" method="post" class="row g-3">
    <div class="col-md-6">
      <label for="mark" class="form-label">Mark</label>
      <input type="text" class="form-control" id="mark" name="mark" required>
    </div>
    <div class="col-md-6">
      <label for="model" class="form-label">Mudel</label>
      <input type="text" class="form-control" id="model" name="model" required>
    </div>
    <div class="col-md-6">
      <label for="engine" class="form-label">Mootor</label>
      <input type="text" class="form-control" id="engine" name="engine" required>
    </div>
    <div class="col-md-6">
      <label for="fuel" class="form-label">Kütus</label>
      <input type="text" class="form-control" id="fuel" name="fuel" required>
    </div>
    <div class="col-md-6">
      <label for="price" class="form-label">Hind päevas</label>
      <input type="number" class="form-control" id="price" name="price" min="1" required>
    </div>
    <div class="col-12">
      <button type="submit" class="btn btn-success">Salvesta</button>
      <a href="index.php" class="btn btn-outline-secondary">Tagasi</a>
    </div>
  </form>
</main>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js" integrity="sha384-FKyoEForCGlyvwx9Hj09JcYn3nv7wiPVlz7YYwJrWVcXK/BmnVDxM+D2scQbITxI" crossorigin="anonymous"></script>
  </body>
</html>

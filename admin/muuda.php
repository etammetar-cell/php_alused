<?php
include('../config.php');
require_admin();

$id = (int)($_GET['editid'] ?? $_POST['updateid'] ?? 0);
$error = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $mark = trim($_POST['mark'] ?? '');
    $model = trim($_POST['model'] ?? '');
    $engine = trim($_POST['engine'] ?? '');
    $fuel = trim($_POST['fuel'] ?? '');
    $price = (int)($_POST['price'] ?? 0);

    if ($id <= 0 || $mark === '' || $model === '' || $engine === '' || $fuel === '' || $price <= 0) {
        $error = 'Täida kõik väljad korrektselt.';
    } else {
        $stmt = mysqli_prepare($yhendus, 'UPDATE cars SET mark = ?, model = ?, engine = ?, fuel = ?, price = ? WHERE id = ?');
        mysqli_stmt_bind_param($stmt, 'ssssii', $mark, $model, $engine, $fuel, $price, $id);
        mysqli_stmt_execute($stmt);
        header('Location: index.php?msg=uuendatud');
        exit();
    }
}

$stmt = mysqli_prepare($yhendus, 'SELECT id, mark, model, engine, fuel, price FROM cars WHERE id = ?');
mysqli_stmt_bind_param($stmt, 'i', $id);
mysqli_stmt_execute($stmt);
$car = mysqli_fetch_assoc(mysqli_stmt_get_result($stmt));
?>
<?php include('../header.php'); ?>

<main class="container">
  <h1 class="h3 mb-3">Auto muutmine</h1>
  <?php if ($error !== '') { ?>
    <div class="alert alert-danger" role="alert"><?php echo e($error); ?></div>
  <?php } ?>
  <?php if (!$car) { ?>
    <div class="alert alert-danger" role="alert">Autot ei leitud.</div>
  <?php } else { ?>
    <form action="muuda.php" method="post" class="row g-3">
      <input type="hidden" name="updateid" value="<?php echo e($car['id']); ?>">
      <div class="col-md-6">
        <label for="mark" class="form-label">Mark</label>
        <input type="text" class="form-control" id="mark" name="mark" value="<?php echo e($car['mark']); ?>" required>
      </div>
      <div class="col-md-6">
        <label for="model" class="form-label">Mudel</label>
        <input type="text" class="form-control" id="model" name="model" value="<?php echo e($car['model']); ?>" required>
      </div>
      <div class="col-md-6">
        <label for="engine" class="form-label">Mootor</label>
        <input type="text" class="form-control" id="engine" name="engine" value="<?php echo e($car['engine']); ?>" required>
      </div>
      <div class="col-md-6">
        <label for="fuel" class="form-label">Kütus</label>
        <input type="text" class="form-control" id="fuel" name="fuel" value="<?php echo e($car['fuel']); ?>" required>
      </div>
      <div class="col-md-6">
        <label for="price" class="form-label">Hind päevas</label>
        <input type="number" class="form-control" id="price" name="price" min="1" value="<?php echo e($car['price']); ?>" required>
      </div>
      <div class="col-12">
        <button type="submit" class="btn btn-success">Salvesta</button>
        <a href="index.php" class="btn btn-outline-secondary">Tagasi</a>
      </div>
    </form>
  <?php } ?>
</main>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js" integrity="sha384-FKyoEForCGlyvwx9Hj09JcYn3nv7wiPVlz7YYwJrWVcXK/BmnVDxM+D2scQbITxI" crossorigin="anonymous"></script>
  </body>
</html>

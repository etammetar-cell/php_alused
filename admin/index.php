<?php
include('../config.php');
require_admin();

$search = trim($_GET['otsi'] ?? '');
if ($search !== '') {
    $like = '%' . $search . '%';
    $stmt = mysqli_prepare($yhendus, 'SELECT id, mark, model, engine, fuel, price FROM cars WHERE mark LIKE ? OR model LIKE ? ORDER BY id DESC');
    mysqli_stmt_bind_param($stmt, 'ss', $like, $like);
} else {
    $stmt = mysqli_prepare($yhendus, 'SELECT id, mark, model, engine, fuel, price FROM cars ORDER BY id DESC');
}
mysqli_stmt_execute($stmt);
$cars = mysqli_stmt_get_result($stmt);
?>
<?php include('../header.php'); ?>

<main class="container">
  <div class="d-flex justify-content-between align-items-center mb-3">
    <h1 class="h3">Admini ala: autod</h1>
    <a href="lisa.php" class="btn btn-success">+ Lisa auto</a>
  </div>

  <?php if (isset($_GET['msg'])) { ?>
    <div class="alert alert-success" role="alert">Muudatus salvestatud.</div>
  <?php } ?>

  <div class="table-responsive">
    <table class="table table-striped align-middle">
      <thead>
        <tr>
          <th>ID</th>
          <th>Mark</th>
          <th>Mudel</th>
          <th>Mootor</th>
          <th>Kütus</th>
          <th>Hind</th>
          <th>Tegevused</th>
        </tr>
      </thead>
      <tbody>
        <?php while ($car = mysqli_fetch_assoc($cars)) { ?>
          <tr>
            <td><?php echo e($car['id']); ?></td>
            <td><?php echo e($car['mark']); ?></td>
            <td><?php echo e($car['model']); ?></td>
            <td><?php echo e($car['engine']); ?></td>
            <td><?php echo e($car['fuel']); ?></td>
            <td><?php echo e($car['price']); ?> €</td>
            <td class="d-flex gap-2">
              <a href="muuda.php?editid=<?php echo e($car['id']); ?>" class="btn btn-sm btn-warning">Muuda</a>
              <form method="post" action="kustuta.php" onsubmit="return confirm('Kas kustutan auto?');">
                <input type="hidden" name="delid" value="<?php echo e($car['id']); ?>">
                <button class="btn btn-sm btn-danger" type="submit">Kustuta</button>
              </form>
            </td>
          </tr>
        <?php } ?>
      </tbody>
    </table>
  </div>
</main>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js" integrity="sha384-FKyoEForCGlyvwx9Hj09JcYn3nv7wiPVlz7YYwJrWVcXK/BmnVDxM+D2scQbITxI" crossorigin="anonymous"></script>
  </body>
</html>

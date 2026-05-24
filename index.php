<?php
include('config.php');

$message = $_GET['msg'] ?? '';
$search = trim($_GET['otsi'] ?? '');

if ($search !== '') {
    $like = '%' . $search . '%';
    $stmt = mysqli_prepare($yhendus, 'SELECT id, mark, model, engine, fuel, price FROM cars WHERE mark LIKE ? OR model LIKE ? ORDER BY id DESC LIMIT 6');
    mysqli_stmt_bind_param($stmt, 'ss', $like, $like);
} else {
    $stmt = mysqli_prepare($yhendus, 'SELECT id, mark, model, engine, fuel, price FROM cars ORDER BY id DESC LIMIT 6');
}
mysqli_stmt_execute($stmt);
$cars = mysqli_stmt_get_result($stmt);
?>
<?php include('header.php'); ?>

<main class="container py-4">
  <?php if ($message === 'registered') { ?>
    <div class="alert alert-success" role="alert">Registreerimine õnnestus. Nüüd saad auto valida ja rentida.</div>
  <?php } ?>

  <section class="hero-section mb-5">
    <div class="row align-items-center g-4">
      <div class="col-lg-7">
        <span class="hero-kicker text-uppercase fw-semibold small">Autorent igaks sõiduks</span>
        <h1 class="display-5 fw-semibold mt-2 mb-3">Leia sobiv auto ja broneeri rendiperiood mugavalt veebis.</h1>
        <p class="lead text-secondary mb-0">Vali auto, märgi kuupäevad ja saada broneering. </p>
      </div>
      <div class="col-lg-5 text-lg-end">
        <?php if (!is_logged_in()) { ?>
          <a href="register.php" class="btn btn-primary btn-lg">Alusta broneeringut</a>
        <?php } else { ?>
          <div class="alert alert-info mb-0 d-inline-block text-start" role="alert">Oled sisse logitud. Vali auto ja broneeri sobiv periood.</div>
        <?php } ?>
      </div>
    </div>
  </section>

  <div class="d-flex justify-content-between align-items-end gap-3 mb-3">
    <div>
      <h2 class="h4 fw-semibold mb-1">Populaarsed rendiautod</h2>
      <p class="text-secondary mb-0">Vaata valikut ja ava auto detailid rendiperioodi valimiseks.</p>
    </div>
  </div>

  <div class="row row-cols-1 row-cols-md-2 row-cols-xl-3 g-4">
    <?php while ($car = mysqli_fetch_assoc($cars)) { ?>
      <div class="col">
        <div class="card car-card h-100">
          <img src="https://loremflickr.com/640/360/<?php echo e(str_replace(' ', '', $car['mark'])); ?>" class="card-img-top car-card-img" alt="<?php echo e($car['mark'] . ' ' . $car['model']); ?>">
          <div class="card-body d-flex flex-column">
            <div class="d-flex justify-content-between gap-3 mb-2">
              <h3 class="h5 card-title mb-0"><?php echo e($car['mark']); ?> <?php echo e($car['model']); ?></h3>
              <span class="price-badge"><?php echo e($car['price']); ?> €</span>
            </div>
            <p class="card-text text-secondary mb-4">
              <?php echo e($car['engine']); ?> · <?php echo e($car['fuel']); ?>
            </p>
            <a href="single_car.php?id=<?php echo e($car['id']); ?>" class="btn btn-outline-primary mt-auto">Vaata ja rendi</a>
          </div>
        </div>
      </div>
    <?php } ?>
  </div>
</main>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js" integrity="sha384-FKyoEForCGlyvwx9Hj09JcYn3nv7wiPVlz7YYwJrWVcXK/BmnVDxM+D2scQbITxI" crossorigin="anonymous"></script>
  </body>
</html>

<?php
include('config.php');

$car_id = (int)($_GET['id'] ?? $_POST['car_id'] ?? 0);
$message = '';
$message_type = 'success';

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['rent'])) {
    $start_date = $_POST['start_date'] ?? '';
    $end_date = $_POST['end_date'] ?? '';

    if (!is_logged_in() || $_SESSION['role'] !== 'user') {
        $message = 'Auto rentimiseks registreeru esmalt kliendiks avalehel.';
        $message_type = 'danger';
    } elseif ($car_id <= 0 || $start_date === '' || $end_date === '' || $end_date < $start_date) {
        $message = 'Vali korrektne rendiperiood.';
        $message_type = 'danger';
    } else {
        $stmt = mysqli_prepare($yhendus, 'SELECT COUNT(*) AS total FROM reservations WHERE car_id = ? AND status <> ? AND start_date <= ? AND end_date >= ?');
        $cancelled = 'cancelled';
        mysqli_stmt_bind_param($stmt, 'isss', $car_id, $cancelled, $end_date, $start_date);
        mysqli_stmt_execute($stmt);
        $overlap = mysqli_fetch_assoc(mysqli_stmt_get_result($stmt));

        if ((int)$overlap['total'] > 0) {
            $message = 'Valitud periood on juba kinni. Palun vali teine periood.';
            $message_type = 'danger';
        } else {
            $stmt = mysqli_prepare($yhendus, 'SELECT price FROM cars WHERE id = ?');
            mysqli_stmt_bind_param($stmt, 'i', $car_id);
            mysqli_stmt_execute($stmt);
            $price_row = mysqli_fetch_assoc(mysqli_stmt_get_result($stmt));

            if (!$price_row) {
                $message = 'Autot ei leitud.';
                $message_type = 'danger';
            } else {
                $days = (new DateTime($start_date))->diff(new DateTime($end_date))->days + 1;
                $total_price = $days * (float)$price_row['price'];
                $status = 'pending';
                $user_id = (int)$_SESSION['user_id'];

                $stmt = mysqli_prepare($yhendus, 'INSERT INTO reservations (user_id, car_id, start_date, end_date, total_price, status) VALUES (?, ?, ?, ?, ?, ?)');
                mysqli_stmt_bind_param($stmt, 'iissds', $user_id, $car_id, $start_date, $end_date, $total_price, $status);
                mysqli_stmt_execute($stmt);

                $message = 'Broneering salvestati. Staatus: pending.';
            }
        }
    }
}

$stmt = mysqli_prepare($yhendus, 'SELECT id, mark, model, engine, fuel, price FROM cars WHERE id = ?');
mysqli_stmt_bind_param($stmt, 'i', $car_id);
mysqli_stmt_execute($stmt);
$car = mysqli_fetch_assoc(mysqli_stmt_get_result($stmt));
?>
<?php include('header.php'); ?>

<main class="container py-4">
  <a href="index.php" class="btn btn-outline-secondary mb-3">Tagasi</a>

  <?php if ($message !== '') { ?>
    <div class="alert alert-<?php echo e($message_type); ?>" role="alert"><?php echo e($message); ?></div>
  <?php } ?>

  <?php if (!$car) { ?>
    <div class="alert alert-danger" role="alert">Autot ei leitud.</div>
  <?php } else { ?>
    <div class="row g-4 align-items-start">
      <div class="col-lg-6">
        <span class="text-uppercase text-primary fw-semibold small">Auto detailid</span>
        <h1 class="display-6 fw-semibold mt-2"><?php echo e($car['mark']); ?> <?php echo e($car['model']); ?></h1>
        <div class="d-flex flex-wrap gap-2 my-3">
          <span class="badge text-bg-light border">Mootor: <?php echo e($car['engine']); ?></span>
          <span class="badge text-bg-light border">Kütus: <?php echo e($car['fuel']); ?></span>
          <span class="badge text-bg-primary"><?php echo e($car['price']); ?> €/päev</span>
        </div>

        <div class="card mt-4">
          <div class="card-body">
            <h2 class="h5 card-title mb-3">Rendi auto</h2>
            <?php if (!is_logged_in() || $_SESSION['role'] !== 'user') { ?>
              <div class="alert alert-info" role="alert">Rentimiseks registreeru avalehel kliendiks.</div>
            <?php } ?>
            <form method="post" action="single_car.php?id=<?php echo e($car['id']); ?>">
              <input type="hidden" name="car_id" value="<?php echo e($car['id']); ?>">
              <input type="hidden" name="rent" value="1">
              <div class="mb-3">
                <label class="form-label" for="start_date">Alguskuupäev</label>
                <input class="form-control" id="start_date" name="start_date" type="date" required>
              </div>
              <div class="mb-3">
                <label class="form-label" for="end_date">Lõppkuupäev</label>
                <input class="form-control" id="end_date" name="end_date" type="date" required>
              </div>
              <button class="btn btn-dark w-100" type="submit">Salvesta broneering</button>
            </form>
          </div>
        </div>
      </div>
      <div class="col-lg-6">
        <img src="https://loremflickr.com/900/620/<?php echo e(str_replace(' ', '', $car['mark'])); ?>" class="img-fluid rounded car-detail-img" alt="<?php echo e($car['mark'] . ' ' . $car['model']); ?>">
      </div>
    </div>
  <?php } ?>
</main>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js" integrity="sha384-FKyoEForCGlyvwx9Hj09JcYn3nv7wiPVlz7YYwJrWVcXK/BmnVDxM+D2scQbITxI" crossorigin="anonymous"></script>
  </body>
</html>

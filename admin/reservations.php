<?php
include('../config.php');
require_admin();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $reservation_id = (int)($_POST['reservation_id'] ?? 0);

    if (isset($_POST['status'])) {
        $allowed_statuses = ['pending', 'confirmed', 'cancelled'];
        $status = $_POST['status'];
        if ($reservation_id > 0 && in_array($status, $allowed_statuses, true)) {
            $stmt = mysqli_prepare($yhendus, 'UPDATE reservations SET status = ? WHERE id = ?');
            mysqli_stmt_bind_param($stmt, 'si', $status, $reservation_id);
            mysqli_stmt_execute($stmt);
        }
    }

    if (isset($_POST['delete'])) {
        $stmt = mysqli_prepare($yhendus, 'DELETE FROM reservations WHERE id = ?');
        mysqli_stmt_bind_param($stmt, 'i', $reservation_id);
        mysqli_stmt_execute($stmt);
    }

    header('Location: reservations.php?msg=salvestatud');
    exit();
}

$sql = 'SELECT r.id, r.start_date, r.end_date, r.total_price, r.status,
               u.first_name, u.last_name, u.email,
               c.mark, c.model
        FROM reservations r
        JOIN users u ON r.user_id = u.id
        JOIN cars c ON r.car_id = c.id
        ORDER BY r.start_date DESC, r.id DESC';
$stmt = mysqli_prepare($yhendus, $sql);
mysqli_stmt_execute($stmt);
$reservations = mysqli_stmt_get_result($stmt);
?>
<?php include('../header.php'); ?>

<main class="container">
  <h1 class="h3 mb-3">Broneeringud</h1>

  <?php if (isset($_GET['msg'])) { ?>
    <div class="alert alert-success" role="alert">Broneering uuendatud.</div>
  <?php } ?>

  <div class="table-responsive">
    <table class="table table-striped align-middle">
      <thead>
        <tr>
          <th>ID</th>
          <th>Klient</th>
          <th>Auto</th>
          <th>Periood</th>
          <th>Summa</th>
          <th>Staatus</th>
          <th>Tegevused</th>
        </tr>
      </thead>
      <tbody>
        <?php while ($reservation = mysqli_fetch_assoc($reservations)) { ?>
          <tr>
            <td><?php echo e($reservation['id']); ?></td>
            <td>
              <?php echo e($reservation['first_name'] . ' ' . $reservation['last_name']); ?><br>
              <span class="text-muted"><?php echo e($reservation['email']); ?></span>
            </td>
            <td><?php echo e($reservation['mark'] . ' ' . $reservation['model']); ?></td>
            <td><?php echo e($reservation['start_date']); ?> - <?php echo e($reservation['end_date']); ?></td>
            <td><?php echo e($reservation['total_price']); ?> €</td>
            <td>
              <form method="post" action="reservations.php" class="d-flex gap-2">
                <input type="hidden" name="reservation_id" value="<?php echo e($reservation['id']); ?>">
                <select name="status" class="form-select form-select-sm">
                  <?php foreach (['pending', 'confirmed', 'cancelled'] as $status) { ?>
                    <option value="<?php echo e($status); ?>" <?php echo $reservation['status'] === $status ? 'selected' : ''; ?>><?php echo e($status); ?></option>
                  <?php } ?>
                </select>
                <button class="btn btn-sm btn-primary" type="submit">Muuda</button>
              </form>
            </td>
            <td>
              <form method="post" action="reservations.php" onsubmit="return confirm('Kas kustutan broneeringu?');">
                <input type="hidden" name="reservation_id" value="<?php echo e($reservation['id']); ?>">
                <button class="btn btn-sm btn-danger" type="submit" name="delete" value="1">Kustuta</button>
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

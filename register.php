<?php
include('config.php');

$message = '';
$message_type = 'danger';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $first_name = trim($_POST['first_name'] ?? '');
    $last_name = trim($_POST['last_name'] ?? '');
    $email = trim($_POST['email'] ?? '');
    $phone = trim($_POST['phone'] ?? '');
    $password = $_POST['password'] ?? '';

    if ($first_name === '' || $last_name === '' || $email === '' || $phone === '' || strlen($password) < 6) {
        $message = 'Täida kõik väljad. Parool peab olema vähemalt 6 märki.';
    } else {
        $stmt = mysqli_prepare($yhendus, 'SELECT id FROM users WHERE email = ? LIMIT 1');
        mysqli_stmt_bind_param($stmt, 's', $email);
        mysqli_stmt_execute($stmt);
        $existing = mysqli_fetch_assoc(mysqli_stmt_get_result($stmt));

        if ($existing) {
            $message = 'Selle e-postiga kasutaja on juba olemas.';
        } else {
            $password_hash = password_hash($password, PASSWORD_DEFAULT);
            $role = 'user';
            $stmt = mysqli_prepare($yhendus, 'INSERT INTO users (role, first_name, last_name, email, phone, password_hash) VALUES (?, ?, ?, ?, ?, ?)');
            mysqli_stmt_bind_param($stmt, 'ssssss', $role, $first_name, $last_name, $email, $phone, $password_hash);
            mysqli_stmt_execute($stmt);

            $_SESSION['user_id'] = mysqli_insert_id($yhendus);
            $_SESSION['role'] = 'user';
            header('Location: index.php?msg=registered');
            exit();
        }
    }
}
?>
<?php include('header.php'); ?>

<main class="container py-4">
  <div class="row justify-content-center">
    <div class="col-md-7 col-lg-5">
      <div class="text-center mb-4">
        <span class="text-uppercase text-primary fw-semibold small">Uus klient</span>
        <h1 class="h3 fw-semibold mt-2 mb-2">Kliendi registreerimine</h1>
        <p class="text-secondary mb-0">Loo konto, et saaksid auto detailvaates broneeringu esitada.</p>
      </div>
      <?php if ($message !== '') { ?>
        <div class="alert alert-<?php echo e($message_type); ?>" role="alert"><?php echo e($message); ?></div>
      <?php } ?>
      <div class="card">
        <div class="card-body">
          <form method="post" action="register.php">
            <div class="mb-3">
              <label class="form-label" for="first_name">Eesnimi</label>
              <input class="form-control" id="first_name" name="first_name" value="<?php echo e($_POST['first_name'] ?? ''); ?>" required>
            </div>
            <div class="mb-3">
              <label class="form-label" for="last_name">Perekonnanimi</label>
              <input class="form-control" id="last_name" name="last_name" value="<?php echo e($_POST['last_name'] ?? ''); ?>" required>
            </div>
            <div class="mb-3">
              <label class="form-label" for="email">E-post</label>
              <input class="form-control" id="email" name="email" type="email" value="<?php echo e($_POST['email'] ?? ''); ?>" required>
            </div>
            <div class="mb-3">
              <label class="form-label" for="phone">Telefon</label>
              <input class="form-control" id="phone" name="phone" value="<?php echo e($_POST['phone'] ?? ''); ?>" required>
            </div>
            <div class="mb-4">
              <label class="form-label" for="password">Parool</label>
              <input class="form-control" id="password" name="password" type="password" minlength="6" required>
            </div>
            <div class="d-flex gap-2">
              <button class="btn btn-primary flex-fill" type="submit">Registreeru</button>
              <a href="index.php" class="btn btn-outline-secondary">Tagasi</a>
            </div>
          </form>
        </div>
      </div>
    </div>
  </div>
</main>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js" integrity="sha384-FKyoEForCGlyvwx9Hj09JcYn3nv7wiPVlz7YYwJrWVcXK/BmnVDxM+D2scQbITxI" crossorigin="anonymous"></script>
  </body>
</html>

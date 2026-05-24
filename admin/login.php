<?php
include('../config.php');

if (is_admin()) {
    header('Location: index.php');
    exit();
}

$msg = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $email = trim($_POST['email'] ?? '');
    $password = $_POST['password'] ?? '';

    $stmt = mysqli_prepare($yhendus, 'SELECT id, role, first_name, password_hash FROM users WHERE email = ? AND role = ? LIMIT 1');
    $role = 'admin';
    mysqli_stmt_bind_param($stmt, 'ss', $email, $role);
    mysqli_stmt_execute($stmt);
    $user = mysqli_fetch_assoc(mysqli_stmt_get_result($stmt));

    if ($user && password_verify($password, $user['password_hash'])) {
        $_SESSION['user_id'] = (int)$user['id'];
        $_SESSION['role'] = $user['role'];
        $_SESSION['name'] = $user['first_name'];
        header('Location: index.php');
        exit();
    }

    $msg = 'Vale e-post või parool.';
}
?>
<?php include('../header.php'); ?>

<main class="container">
  <div class="row justify-content-center">
    <div class="col-md-5">
      <div class="card">
        <div class="card-body">
          <h1 class="h4 card-title mb-3">Admini sisselogimine</h1>
          <?php if ($msg !== '') { ?>
            <div class="alert alert-danger" role="alert"><?php echo e($msg); ?></div>
          <?php } ?>
          <form method="post" action="login.php">
            <div class="mb-3">
              <label for="email" class="form-label">E-post</label>
              <input name="email" type="email" class="form-control" id="email" required>
            </div>
            <div class="mb-3">
              <label for="password" class="form-label">Parool</label>
              <input name="password" type="password" class="form-control" id="password" required>
            </div>
            <button type="submit" class="btn btn-primary w-100">Logi sisse</button>
          </form>
        </div>
      </div>
    </div>
  </div>
</main>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js" integrity="sha384-FKyoEForCGlyvwx9Hj09JcYn3nv7wiPVlz7YYwJrWVcXK/BmnVDxM+D2scQbITxI" crossorigin="anonymous"></script>
  </body>
</html>

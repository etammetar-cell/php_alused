<?php
    session_start();
    ?>

<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Bootstrap demo</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-sRIl4kxILFvY47J16cr9ZwB07vP4J8+LH7qKQnuqkuIAvNWLzeN8tE5YBujZqJLB" crossorigin="anonymous">
  </head>
  <body>
    <?php
    $msg = "";
        if (!empty($_POST)) {



          $uname = $_POST['user'];
          $password = $_POST['password'];


          $paring = "SELECT user, password FROM users WHERE user='".$uname."'";
          $valjund = mysqli_query($yhendus, $paring);
          $rida = mysqli_fetch_assoc($valjund);
          //$hash = '$2y$10$I1tDWSrtH3eycwNxvDVSs.oVcfXEgATXUGfhLq52TxGGwcGCDGIRW';
           $hash = $rida['password'];
          
           if ($uname=="admin" && password_verify($password, $hash)) {
            $_SESSION['tuvastamine'] = 'misiganes';
            header("Location: index.php");

            # code...
           } else {
            $msg = "kasutaja vale!";
           }
        }
        ?>

    <div class="container">
        <div class="row">
            <div class="col-sm-4">
                
            </div>
            <div class="col-sm-4">
                <form method="post" action="login.php">
                <form>
                 <div class="mb-3">
                    <label for="exampleInputEmail1" class="form-label">Username</label>
                    <input name="user" type="text" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp">
                    <div id="emailHelp" class="form-text">Kasutaja</div>
                     </div>
                    <div class="mb-3">
                     <label for="exampleInputPassword1" class="form-label">Password</label>
                    <input name="password" type="password" class="form-control" id="exampleInputPassword1">
                </div>
                
                 <button type="submit" class="btn btn-primary">Logi sisse</button>
                    </form>
                    <?php echo $msg; ?>
            </div>
            <div class="col-sm-4"></div>
        </div>
    </div>
    
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js" integrity="sha384-FKyoEForCGlyvwx9Hj09JcYn3nv7wiPVlz7YYwJrWVcXK/BmnVDxM+D2scQbITxI" crossorigin="anonymous"></script>
  </body>
</html>
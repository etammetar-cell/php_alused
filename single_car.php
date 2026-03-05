<?php include('config.php'); ?>

<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>'Autorent'</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-sRIl4kxILFvY47J16cr9ZwB07vP4J8+LH7qKQnuqkuIAvNWLzeN8tE5YBujZqJLB" crossorigin="anonymous">
  </head>
  <body>
    <!-- /menüü -->
<nav class="navbar navbar-expand-lg bg-body-tertiary mb-4">
  <div class="container">
    <a class="navbar-brand" href="#">Autorent</a>
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarSupportedContent">
      <ul class="navbar-nav me-auto mb-2 mb-lg-0">
        <li class="nav-item">
          <a class="nav-link active" aria-current="page" href="#">Home</a>
        </li>
        <li class="nav-item">
          <a class="nav-link active" aria-current="page" href="#">Home</a>
        </li>
        <li class="nav-item">
          <a class="nav-link active" aria-current="page" href="#">Home</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="#">Link</a>
        </li>
          </ul>
      <form class="d-flex" role="search" method="get" action="index.php">
        <input class="form-control me-2" type="search" placeholder="Search" aria-label="Search" name="otsi">
        <button class="btn btn-outline-success" type="submit">Otsi</button>
      </form>
    </div>
  </div>
</nav>
 <!-- /menüü -->
<!-- /sisu -->
 <div class="container">
        <div class="row">

  <?php
     $id = $_GET['id'];
     $paring = "SELECT * FROM cars WHERE id=".$id."";
     $valjund = mysqli_query($yhendus, $paring);  //saadan päringu andmebaasi
     $rida = mysqli_fetch_assoc($valjund); //sikutan vastuse alla
     print_r($rida);
     ?>
            <div class="col">
                <h1>Nimi: <?php echo $rida["mark"]; ?><?php echo $rida["model"]; ?></h1>
                <p>Mootor:<?php echo $rida["engine"]; ?></p>
                <p>Kütus:<?php echo $rida["fuel"]; ?></p>
                <p>Hind:<?php echo $rida["price"]; ?></p>
                
            </div>
            <div class="col">
                 <img src="https://loremflickr.com/800/500/<?php echo str_replace(" ","", $rida["mark"]); ?>" class="card-img-top" alt="<?php echo str_replace(" ","", $rida["mark"]) ?>">
            </div>
        </div>
</div>
 <!-- /sisu -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js" integrity="sha384-FKyoEForCGlyvwx9Hj09JcYn3nv7wiPVlz7YYwJrWVcXK/BmnVDxM+D2scQbITxI" crossorigin="anonymous"></script>
  </body>
</html>
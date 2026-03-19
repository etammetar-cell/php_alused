<?php include('config.php'); ?>
<?php include('header.php'); ?>
<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>'Autorent'</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-sRIl4kxILFvY47J16cr9ZwB07vP4J8+LH7qKQnuqkuIAvNWLzeN8tE5YBujZqJLB" crossorigin="anonymous">
  </head>
  <body>
    
<!-- /sisu -->
 <div class="container">
    <a href="index.php" class="btn btn-success">Tagasi</a>


        <div class="row">
 <?php
     $id = $_GET['id'];
     $paring = "SELECT * FROM cars WHERE id=".$id."";
     $valjund = mysqli_query($yhendus, $paring);  //saadan päringu andmebaasi
     $rida = mysqli_fetch_assoc($valjund); //sikutan vastuse alla
     //print_r($rida);
     ?>
            <div class="col">
                <h1>Nimi: <?php echo $rida["mark"]; ?><?php echo $rida["model"]; ?></h1>
                <p>Mootor: <?php echo $rida["engine"]; ?></p>
                <p>Kütus: <?php echo $rida["fuel"]; ?></p>
                <p>Aasta: <?php echo $rida["year"]; ?></p>
                <p>Staatus: <?php echo $rida["status"]; ?></p>
                <p>Käigukast: <?php echo $rida["transmission"]; ?></p>
                <p>Istmed: <?php echo $rida["seats"]; ?></p>
                <p class="fs-5"><p>Hind: <?php echo $rida["price"]; ?>€/päev</p>
                <a href="#" class="btn btn-dark w-100">Rendi auto</a>
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
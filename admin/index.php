<?php include('../config.php'); ?>
<?php include('../header.php'); ?>
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
<div class="row row-cols-1 row-cols-md-4 g-4">
    <!-- /1auto -->
     <?php
     
     $paring = "SELECT * FROM cars";
     if (!empty($_GET["otsi"])){
        $otsing = $_GET["otsi"];
        $paring .= " WHERE mark LIKE '%".$otsing."%'";

     }
     
     $paring .= " LIMIT 8";                  //valmistan ette päringu stringiga

     //var_dump($_GET["otsi"]);
     $valjund = mysqli_query($yhendus, $paring);  //saadan päringu andmebaasi
     
                //Kuvan testvastuse
     ?>
     <table class="table">
  <thead>
    <tr>
      <th scope="col">id</th>
      <th scope="col">Mudel</th>
      <th scope="col">Hind</th>
      <th scope="col">Mootor</th>
      <th scope="col">Kütus</th>
      <th scope="col">Mark</th>
      <th scope="col">Aasta</th>
      <th scope="col">Staatus</th>
      <th scope="col">Engine</th>
      <th scope="col">Engine</th>
      <th scope="col">Engine</th>
      <th scope="col">Engine</th>
    </tr>
  </thead>
  <tbody>
    <?php
      while($rida = mysqli_fetch_assoc($valjund)){ //sikutan vastuse alla
     //var_dump($rida);
    ?>
    <tr>
      <th scope="row"><?php echo $rida["id"]; ?></th>
      <td><?php echo $rida["model"]; ?></td>
      <td><?php echo $rida["price"]; ?></td>
      <td><?php echo $rida["engine"]; ?></td>
      <td><?php echo $rida["fuel"]; ?></td>
      <td><?php echo $rida["mark"]; ?></td>
      <td><?php echo $rida["year"]; ?></td>
      <td><?php echo $rida["status"]; ?></td>
      <td><?php echo $rida["engine"]; ?></td>
      <td><?php echo $rida["engine"]; ?></td>
      <td><?php echo $rida["engine"]; ?></td>
      <td><?php echo $rida["engine"]; ?></td>
      
    </tr>
   <?php } ?>

  </tbody>
</table>
  <!-- <div class="col">
    <div class="card">
      <img src="https://loremflickr.com/400/250/<?php echo str_replace(" ","", $rida["mark"]); ?>" class="card-img-top" alt="<?php echo str_replace(" ","", $rida["mark"]) ?>">
      <div class="card-body">
        <h5 class="card-title"><?php echo $rida["mark"]; ?><?php echo $rida["model"]; ?></h5>
        <p class="card-text">
            Mootor: <?php echo $rida["engine"]; ?> <br>
            Kütus: <?php echo $rida["fuel"]; ?> <br>
            Hind: <?php echo $rida["price"]; ?>€/päev <br>               
        </p>
        <a href="single_car.php?id=<?php echo $rida["id"]; ?>" class="btn btn-primary w-100">Rendi</a>
      </div>
      </div>
</div> -->
<!-- /1auto -->
</div>
</div>





 <!-- /sisu -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js" integrity="sha384-FKyoEForCGlyvwx9Hj09JcYn3nv7wiPVlz7YYwJrWVcXK/BmnVDxM+D2scQbITxI" crossorigin="anonymous"></script>
  </body>
</html>
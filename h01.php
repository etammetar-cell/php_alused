<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>PHP Alused</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-sRIl4kxILFvY47J16cr9ZwB07vP4J8+LH7qKQnuqkuIAvNWLzeN8tE5YBujZqJLB" crossorigin="anonymous">
  </head>
  <body>
    <h1>Harjutus 01 - muutujad</h1>
    <?php
        $nimi = "Imre";
        $synniaasta = 1990;
        $tahtkuju = "jäär";

        echo $nimi,"<br>",$synniaasta,"<br>",$tahtkuju;
        echo "<br>";
        echo $nimi,"<br>".$synniaasta."<br>",$tahtkuju;
        echo "<br>";
        echo '"It\'s My Life" - Dr. Alban';
        echo '<br>';
    ?>
        <h2>Harjutus 02 - 04 vormid ja if</h2>
        <form action="h01.php" method="get">
            Arv1:<input type="number" name="arv1"><br>
            Arv2:<input type="number" name="arv2"><br>
            <input type="submit" value="Liida"><br>
        </form>

        <?php

            if(!empty($_GET["arv1"]) && !empty($_GET["arv2"])){

            
              $nr1 = $_GET["arv1"];
              $nr2 = $_GET["arv2"];
              $liida = $nr1 + $nr2;
        
              echo '<div class="alert alert-primary" role="alert">
              Vastus:'.$liida.' </div>';
            }
    ?>
<h2>Harjutus 05 - massiivid ja tsükkel</h2>
    <?php
        $margid = array("Subaru","BMW","Acura","Mercedes-Benz","Lexus","GMC","Volvo","Toyota","Volkswagen","Volkswagen","GMC","Jeep","Saab","Hyundai","Subaru","Mercedes-Benz",
        "Honda","Kia","Mercedes-Benz","Chevrolet","Chevrolet","Porsche","Buick","Dodge","GMC","Dodge","Nissan","Dodge","Jaguar","Ford","Honda","Toyota","Jeep",
        "Kia","Buick","Chevrolet","Subaru","Chevrolet","Chevrolet","Pontiac","Maybach","Chevrolet","Plymouth","Dodge","Nissan","Porsche","Nissan","Mercedes-Benz",
        "Suzuki","Nissan","Ford","Acura","Volkswagen","Lincoln","Mazda","BMW","Mercury","Mitsubishi","Ram","Audi","Kia","Pontiac","Toyota","Acura","Toyota","Toyota",
        "Chevrolet","Oldsmobile","Acura","Pontiac","Lexus","Chevrolet","Cadillac","GMC","Jeep","Audi","Acura","Acura","Honda","Dodge","Hummer","Chevrolet","BMW",
        "Honda","Lincoln","Hummer","Acura","Buick","BMW","Chevrolet","Cadillac","BMW","Pontiac","Audi","Hummer","Suzuki","Mitsubishi","Jeep","Buick","Ford");

        for ($i=0; $i < count($margid) ; $i++) { 
            echo ($i+1).".".$margid[$i]."<br>";
        }

    ?>

    <div class="container">
        <?php for ($i=0; $i < count($margid); $i++) { ?>
            
            <div class="row">
            <div class="col-sm-3">
            <img src="https://picsum.photos/id/1020/200/200" alt="autopilt" class="img-fluid">
            </div>
            <div class="col-sm-9"><?php echo $margid[$i];  ?></div>
        </div>
        <?php } ?>
    </div>


    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js" integrity="sha384-FKyoEForCGlyvwx9Hj09JcYn3nv7wiPVlz7YYwJrWVcXK/BmnVDxM+D2scQbITxI" crossorigin="anonymous"></script>
  </body>
</html>
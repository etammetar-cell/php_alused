<?php include('../config.php'); ?>
<?php include('../header.php'); ?>

    
<!-- /sisu -->
<div class="container">
    <h2>Auto lisamine</h2>
    <form action="lisa.php" method="get">
        <div class="row g-4">
            <div class="col-sm-6">
                <label for="mark" class="form-label">Mark</label>
                <input type="text" class="form-control" id="mark" name="mark" value="test">
                <label for="model" class="form-label">Model</label>
                <input type="text" class="form-control" id="model" name="model" value="test">
                <label for="engine" class="form-label">Mootor</label>
                <input type="text" class="form-control" id="engine" name="engine" value="test">
                <label for="fuel" class="form-label">Kütus</label>
                <input type="text" class="form-control" id="fuel" name="fuel" value="test">
                <label for="price" class="form-label">Hind</label>
                <input type="number" class="form-control" id="price" name="price" value="123">
            </div>
            <div class="col-sm-6">
                 <label for="year" class="form-label">Aasta</label>
                <input type="number" class="form-control" id="year" name="year" value="2000">
                <label for="transmission" class="form-label">Käigukast</label>
                <input type="text" class="form-control" id="transmission" name="transmission" value="automaat">
                <label for="seats" class="form-label">Istmete arv</label>
                <input type="number" class="form-control" id="seats" name="seats" value="5">
                <label for="description" class="form-label">Muu info</label>
                <input type="text" class="form-control" id="description" name="description" value="test">
                <label for="status" class="form-label">Olek</label>
                <input type="text" class="form-control" id="status" name="status" value="vaba">
            </div>

            </div>
            <input type="submit" value="Salvesta" class="btn btn-success">
        </div>
    </form>
   

</div>




 <!-- /sisu -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js" integrity="sha384-FKyoEForCGlyvwx9Hj09JcYn3nv7wiPVlz7YYwJrWVcXK/BmnVDxM+D2scQbITxI" crossorigin="anonymous"></script>
  </body>
</html>
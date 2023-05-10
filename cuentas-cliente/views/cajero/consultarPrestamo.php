<!DOCTYPE html>
<html lang="es">

<head>

  <?php require_once '../components/layout/head.php';
  if ($_SESSION['rol'] != 1) {
    header('Location: ../login_admin/');
  }
  ?>
</head>

<body>
  <?php require_once '../components/layout/nav-cajero.php'; ?>
  <div class="container mt-4 mb-4 pt-4">
    <h1 class="titulo mb-5">Detalles del préstamo</h1>
    <form action="#" method="post" class="formA p-5" style="margin: auto;">
      <?php
 
      include '../../models/prestamo.php';      
      $prestamo = new Prestamo();
      if ($_GET) {
        if (isset($_GET['prestamo'])) {
          $prestamo = unserialize($_GET['prestamo']);
        }
      }
      ?>
      <div class="row">
      <div class="col-md-12 form-group">
          <label for="cliente" class="col-sm-12 col-form-label">Nombre del cliente:</label>
          <input type="text" class="form-control" name="cliente" id="cliente" value="<?php print($prestamo->getnombreCliente()); ?>" readonly>
        </div>
        <div class="col-md-4 form-group">
          <label for="estado" class="col-sm-12 col-form-label">Estado del préstamo:</label>
          <input type="text" class="form-control" name="estado" id="estado"
            value="<?php print($prestamo->getestadoprestamo()); ?>" readonly>
        </div>
        <div class="col-md-4 form-group">
          <label for="fechaApertura" class="col-sm-12 col-form-label">Fecha de apertura:</label>
          <input type="text" class="form-control" name="fechaApertura" id="fechaApertura"
            value="<?php print($prestamo->getfechaApertura()); ?>" readonly />
        </div>
        <div class="col-md-4 form-group">
          <label for="montoprestamo" class="col-sm-12 col-form-label">Monto del préstamo:</label>
          <input type="text" class="form-control"
            value="$ <?php print($prestamo->getmontoprestamo()); ?>" name="montoprestamo" id="montoprestamo" readonly/>
        </div>
        <div class="col-md-4 form-group">
          <label for="porcentajeInteres" class="col-sm-12 col-form-label">Porcentaje de interes:</label>
          <input type="text" class="form-control" name="porcentajeInteres" id="porcentajeInteres" value="<?php print($prestamo->getporcentajeInteres()); ?> %" readonly>
        </div>
        <div class="col-md-3 form-group">
          <label for="cuotaMensual" class="col-sm-12 col-form-label">Cuota mensual:</label>
          <input type="text" class="form-control" name="cuotaMensual" id="cuotaMensual" value="$ <?php print($prestamo->getcuotaMensual()); ?>" readonly>
        </div>
        <div class="col-md-5 form-group">
          <label for="cantYearAPagar" class="col-sm-12 col-form-label">Cantidad de años para cancelar:</label>
          <input type="text" class="form-control" name="cantYearAPagar" id="cantYearAPagar" value="<?php print($prestamo->getcantYearAPagar()); ?>" readonly>
        </div>
        
        <div class="col-md-12">
          <a href="./administrar_prestamos.php" class="btn btn-primary mt-5  btn-sm btn-block"
            style="width: 50%; margin: auto;">Atras</a>
        </div>
      </div>
    </form>
    <br><br>
  </div>
  <?php
  require_once '../components/layout/footer.php';
  require_once '../components/layout/scripts.php';
  ?>
</body>

</html>
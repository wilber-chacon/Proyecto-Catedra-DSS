<!DOCTYPE html>
<html lang="es">

<head>

  <?php require_once '../components/layout/head.php';
  if ($_SESSION['rol'] != 6) {
    header('Location: ../login_admin/');
  }
  ?>
</head>

<body>
  <?php require_once '../components/layout/nav-gerente-banco.php'; ?>
  <div class="container mt-4 mb-4 pt-4">
    <h1 class="titulo mb-5">Detalles de la sucursal</h1>
    <form id="form-register">
      <?php

      if ($_GET) {
        if (isset($_GET['sucursal'])) {
          $sucursal = unserialize($_GET['sucursal']);
        }
      } ?>
      <div class="row m-5 p-5">
        <div class="col-md-6 mb-3">
          <label for="nombreSucursal" class="form-label">Nombre de la sucursal:</label>
          <input type="text" class="form-control border border-primary" id="nombreSucursal" name="nombreSucursal"
            value="<?php echo $sucursal[0]['nombre_sucursal'] ?>" readonly>
        </div>
        <div class="col-md-6 mb-5">
          <label for="direccion" class="form-label">Dirección:</label>
          <input type="text" class="form-control border border-primary" id="direccion" name="direccion"
            value="<?php echo $sucursal[0]['direccion_sucursal'] ?>" readonly>
        </div>
        <div class="col-md-6 m-auto mt-5 mb-3">
          <label for="direccion" class="form-label">Gerente de la sucursal:</label>
          <input type="text" class="form-control border border-primary" id="direccion" name="direccion"
            value="<?php echo $sucursal[0]['nombre_empleado'] ?>" readonly>
        </div>
        <div class="col-md-12">
          <a href="./administrar_sucursales.php" class="btn btn-primary mt-5  btn-sm btn-block"
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

  <script src="../components/js/registroS.js"></script>
</body>

</html>
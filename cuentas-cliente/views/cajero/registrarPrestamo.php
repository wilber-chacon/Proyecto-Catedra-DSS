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
    <h1 class="titulo mb-5">Aperturar préstamo</h1>
    <form id="form-register">


      <fieldset class="row border m-5 p-5">
        <legend>Datos del cliente</legend>
        <?php
        include '../../models/cliente.php';   
        $cliente = new Cliente();
        if ($_GET) {
          /* Comprobamos que ha llegado correctamente el campo 'cliente' */
          if (isset($_GET['cliente'])) {
            /* Deshacemos el trabajo hecho por 'serialize' */
            $cliente = unserialize($_GET['cliente']);

          }
        }
        ?>
        <input type="hidden" name="id" id="id" value="<?php echo $cliente->getcodigoC(); ?>">
        <div class="col-md-4 mb-3">
          <label for="dui" class="form-label">DUI:</label>
          <input type="text" class="form-control border border-primary" value="<?php echo $cliente->getdui(); ?>" id="dui" name="dui" placeholder="Ingrese el DUI del cliente"
            autocomplete="off">
        </div>
        <div class="col-md-4 mb-3">
          <label for="nombre" class="form-label">Nombre:</label>
          <input type="text" class="form-control border border-primary" id="nombre" name="nombre"
            placeholder="----------------------" value="<?php echo $cliente->getNombre(); ?>" readonly autocomplete="off">
        </div>

        <div class="col-md-4 mb-3">
          <label for="sueldo" class="form-label">Sueldo:</label>
          <input type="text" class="form-control border border-primary" id="sueldo" name="sueldo"
            placeholder="----------------------" value="<?php echo $cliente->getsueldo(); ?>" readonly autocomplete="off">
        </div>
        <div class="col-md-12">
          <button class="btn btn-primary" type="submit" id="btn-buscarCliente">Buscar</button>
        </div>
      </fieldset>

      <fieldset class="row border m-5 p-5">
        <legend>Datos del prestamo</legend>
        <div class="col-md-6 mb-3">
          <label for="tel" class="form-label">Monto del préstamo:</label>
          <input type="number" min="1.0" step="0.01" class="form-control border border-primary" id="monto" name="monto"
            placeholder="Ingrese el monto del préstamo" autocomplete="off">
        </div>
        <div class="col-md-6 mb-3">
          <label for="cuota" class="form-label">Cuota mensual:</label>
          <input type="number" min="1.0" step="0.01" class="form-control border border-primary" id="cuota" name="cuota"
            placeholder="Ingrese la cuota mensual" autocomplete="off">
        </div>
        <div class="col-md-12">
          <button class="btn btn-primary" type="submit" id="btn-register">Enviar</button>
        </div>
      </fieldset>
    </form>
    <br><br>
  </div>
  <?php
  require_once '../components/layout/footer.php';
  require_once '../components/layout/scripts.php';
  ?>

  <script src="../components/js/registroP.js"></script>
</body>

</html>
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
    <h1 class="titulo mb-5">Cliente</h1>
    <form action="#" method="post" class="formA p-5" style="margin: auto;">
      <?php
 
      include '../../models/cliente.php';      
      $cliente = new Cliente();
      if ($_GET) {
        if (isset($_GET['cliente'])) {
          $cliente = unserialize($_GET['cliente']);
        }
      }
      ?>
      <div class="row">
        <div class="col-md-4 form-group">
          <label for="nombre" class="col-sm-12 col-form-label">Nombre:</label>
          <input type="text" class="form-control" name="nombre" id="nombre"
            value="<?php print($cliente->getnombre()); ?>" readonly>
        </div>
        <div class="col-md-4 form-group">
          <label for="correo" class="col-sm-12 col-form-label">Correo electronico:</label>
          <input type="email" class="form-control" name="correo" id="correo"
            value="<?php print($cliente->getcorreo()); ?>" readonly />
        </div>
        <div class="col-md-4 form-group">
          <label for="dui" class="col-sm-12 col-form-label">DUI:</label>
          <input type="text" class="form-control" name="dui" id="dui" value="<?php print($cliente->getdui()); ?>"
            pattern="^[0-9]{8}-[0-9]{8}{1}$" placeholder="00000000-0" readonly>
        </div>
        <div class="col-md-4 form-group">
          <label for="telefono" class="col-sm-12 col-form-label">Telefono:</label>
          <input type="tel" class="form-control" placeholder="0000-0000"
            value="<?php print($cliente->gettelefono()); ?>" name="telefono" id="telefono" readonly
            pattern="^[0-9]{4}-[0-9]{4}$" />
        </div>
        <div class="col-md-8 form-group">
          <label for="domicilio" class="col-sm-12 col-form-label">Domicilio:</label>
          <textarea name="domicilio" id="domicilio" cols="15" class="form-control" rows="2"
            readonly><?php print($cliente->getdireccion()); ?></textarea>
        </div>
        <div class="col-md-4 form-group">
          <label for="fechanacimiento" class="col-sm-12 col-form-label">Fecha de nacimiento:</label>
          <input type="date" name="fechanacimiento" id="fechanacimiento"
            value="<?php print($cliente->getfechanacimiento()); ?>" class="form-control datepicker" readonly>
        </div>
        <div class="col-md-4 form-group">
          <label for="sueldo" class="col-sm-12 col-form-label">Sueldo:</label>
          <input type="text" class="form-control" name="sueldo" id="sueldo" value="$ <?php print($cliente->getsueldo()); ?>" readonly>
        </div>
        <div class="col-md-4 form-group">
          <label for="usuario" class="col-sm-12 col-form-label">Usuario:</label>
          <input type="text" class="form-control" name="usuario" id="usuario" value="<?php print($cliente->getusuario()); ?>" readonly>
        </div>

        <div class="col-md-12">
          <a href="./administrar_clientes.php" class="btn btn-primary mt-5  btn-sm btn-block"
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
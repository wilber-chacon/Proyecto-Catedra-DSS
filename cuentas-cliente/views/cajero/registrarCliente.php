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
    <form class="row" id="form-register">
        <div class="col-md-4 mb-3">
          <label for="nombre" class="form-label">Nombre:</label>
          <input type="text" class="form-control border border-primary" id="nombre" name="nombre" placeholder="Ingrese su nombre" autocomplete="off">
        </div>
        <div class="col-md-4 mb-3">
          <label for="dui" class="form-label">DUI:</label>
          <input type="text" class="form-control border border-primary" id="dui" name="dui" placeholder="Ingrese su DUI" autocomplete="off">
        </div>
        <div class="col-md-4 mb-3">
          <label for="correo" class="form-label">Correo:</label>
          <input type="text" class="form-control border border-primary" id="correo" name="correo" placeholder="Ingrese su correo" autocomplete="off">
        </div>
        <div class="col-md-4 mb-3">
          <label for="tel" class="form-label">Teléfono:</label>
          <input type="text" class="form-control border border-primary" id="tel" name="tel" placeholder="Ingrese su teléfono" autocomplete="off">
        </div>
        <div class="col-md-4 mb-3">
          <label for="domicilio" class="form-label">Domicilio:</label>
          <input type="text" class="form-control border border-primary" id="domicilio" name="domicilio" placeholder="Ingrese su domicilio" autocomplete="off">
        </div>
        <div class="col-md-4 mb-3">
          <label for="fecha_naci" class="form-label">Fecha Nacimiento:</label>
          <input type="date" class="form-control border border-primary" id="fecha_naci" name="fecha_naci" placeholder="Ingrese su fecha de nacimiento" autocomplete="off">
        </div>
        <div class="col-md-4 mb-3">
          <label for="sueldo" class="form-label">Sueldo:</label>
          <input type="text" class="form-control border border-primary" id="sueldo" name="sueldo" placeholder="Ingrese su sueldo" autocomplete="off">
        </div>
        <div class="col-md-4 mb-3">
          <label for="usuario" class="form-label">Usuario:</label>
          <input type="text" class="form-control border border-primary" id="usuario" name="usuario" placeholder="Ingrese su usuario" autocomplete="off">
        </div>
        <div class="col-md-4 mb-3">
          <label for="contrasenia" class="form-label">Contraseña:</label>
          <input type="password" class="form-control border border-primary" id="contrasenia" name="contrasenia" placeholder="Ingrese su contraseña" autocomplete="off">
        </div>
        <div class="col-md-12">
          <button class="btn btn-primary" type="submit" id="btn-register">Registrar</button>
        </div>
      </form>
    <br><br>
  </div>
  <?php
  require_once '../components/layout/footer.php';
  require_once '../components/layout/scripts.php';
  ?>

  <script src="../components/js/registrocj.js"></script>
</body>

</html>
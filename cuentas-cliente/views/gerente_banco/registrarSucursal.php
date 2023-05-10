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
    <h1 class="titulo mb-5">Registrar sucursal</h1>
    <form id="form-register">


      <fieldset class="row border m-5 p-5">
        <legend>Datos de la sucursal</legend>        
        
        <div class="col-md-6 mb-3">
          <label for="nombreSucursal" class="form-label">Nombre de la sucursal:</label>
          <input type="text" class="form-control border border-primary" id="nombreSucursal" name="nombreSucursal" placeholder="Ingrese el nombre de la sucursal"
            >
        </div>
        <div class="col-md-6 mb-3">
          <label for="direccion" class="form-label">Dirección:</label>
          <input type="text" class="form-control border border-primary" id="direccion" name="direccion"
            placeholder="Ingrese la dirección de la sucursal">
        </div>
      </fieldset>

      <fieldset class="row border m-5 p-5">
        <legend>Datos del gerente de la sucursal</legend>
        <div class="col-md-4 form-group">
          <label for="nombre" class="col-sm-12 col-form-label">Nombre:</label>
          <input type="text" class="form-control border border-primary" placeholder="Ingrese el nombre del empleado" name="nombre" id="nombre" required>
        </div>
        <div class="col-md-4 form-group">
          <label for="correo" class="col-sm-12 col-form-label">Correo electronico:</label>
          <input type="email" class="form-control border border-primary" placeholder="Ingrese el correo del empleado" name="correo" id="correo"  required />
        </div>
        <div class="col-md-4 form-group">
          <label for="dui" class="col-sm-12 col-form-label">DUI:</label>
          <input type="text" class="form-control border border-primary" name="dui" id="dui" placeholder="00000000-0" required>
        </div>
        <div class="col-md-4 form-group">
          <label for="telefono" class="col-sm-12 col-form-label">Telefono:</label>
          <input type="tel" class="form-control border border-primary" placeholder="0000-0000" name="telefono" id="telefono" required pattern="^[0-9]{4}-[0-9]{4}$" />
        </div>
        <div class="col-md-8 form-group">
          <label for="domicilio" class="col-sm-12 col-form-label">Domicilio:</label>
          <textarea name="domicilio" id="domicilio" cols="15" class="form-control border border-primary" rows="3" required></textarea>
        </div>
        <div class="col-md-4 form-group">
          <label for="fechanacimiento" class="col-sm-12 col-form-label">Fecha de nacimiento:</label>
          <input type="date" name="fechanacimiento" id="fechanacimiento"  class="form-control border border-primary datepicker" required>
        </div>
        <div class="col-md-8 form-group">
          <label for="acciones" class="col-sm-12 col-form-label">Acciones:</label>
          <textarea name="acciones" id="acciones" cols="15" class="form-control border border-primary" rows="3" required></textarea>
        </div>
        <div class="col-md-4 form-group">
          <label for="pass" class="col-sm-12 col-form-label">Contrase&ntilde;a:</label>
          <input type="text" class="form-control border border-primary" name="pass" id="pass" required>
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

  <script src="../components/js/registroS.js"></script>
</body>

</html>
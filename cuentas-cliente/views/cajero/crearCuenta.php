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
    <h1 class="titulo mb-5">Crear cuenta bancaria</h1>
    <form class="row p-5" id="form-register">
        <div class="col-md-6 mb-4">
          <label for="dui" class="form-label">DUI del cliente:</label>
          <input type="text" class="form-control border border-primary" id="dui" name="dui" placeholder="Ingrese el DUI del cliente" autocomplete="off">
        </div>
        <div class="col-md-6 mb-4">
          <label for="correo" class="form-label">Tipo de cuenta:</label>
          <select id="tipo_cuenta" name="tipo_cuenta" class="form-control border border-primary">
                    <option value="">Seleccione tipo</option>
                    <option value="Ahorro">Cuenta Ahorro</option>
                    <option value="Corriente">Cuenta Corriente</option>
                  </select>
        </div>
        <div class="col-md-6 mb-4">
          <label for="saldo" class="form-label">Saldo de la cuenta:</label>
          <input type="number" min="0.0" step="0.01" class="form-control border border-primary" id="saldo" name="saldo" placeholder="Ingrese el saldo de la cuenta" autocomplete="off">
        </div>
        
        <div class="col-md-12">
          <button class="btn btn-primary" type="submit" id="btn-crear-cuenta">Crear</button>
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
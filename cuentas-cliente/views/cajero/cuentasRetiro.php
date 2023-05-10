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
  <div class="container mt-4 mb-4 p-5">
  <form action="../../controllers/CajeroController.php" method="post" class="formA p-5" style="background-color: #EEEEEE; margin: auto;">
  <h3 class="text-center m-3 mb-5">Consultar cuentas</h3>
      <?php
      if ($_GET) {
        /* Comprobamos que ha llegado correctamente el campo 'lstError' */
        if (isset($_GET['lstError'])) { ?>

          <div class="alert alert-danger">
            <ul>
              <?php
              /* Deshacemos el trabajo hecho por 'serialize' */
              $lista = unserialize($_GET['lstError']);
              foreach ($lista as $er) {
                echo ("<li>{$er}</li>");
              }
              ?>
            </ul>
          </div>
      <?php
        }
      }
      
      ?>
      <div class="row m-auto">
        
        <div class="col-md-9 m-auto form-group">
          <label for="dui" class="col-sm-12 col-form-label">DUI:</label>
          <input type="text" class="form-control" name="dui" id="dui" pattern="^[0-9]{8}-[0-9]{8}{1}$" placeholder="00000000-0" required>
        </div>
    
        <div class="col-md-12">
          <input type="hidden" name="operacion" id="operacion" value="verCuentasRetiro">
          <input type="submit" value="Enviar" class="btn btn-success btn-sm mt-5 mb-4 btn-block" style="width: 50%; margin: auto;">
        </div>
      </div>
    </form>
  </div>

  <?php
  require_once '../components/layout/footer.php';
  require_once '../components/layout/scripts.php';
  ?>
</body>

</html>
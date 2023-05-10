<!DOCTYPE html>
<html lang="es">

<head>
  <?php require_once '../components/layout/head-Prestamista.php'; ?>
</head>

<body>
  <?php require_once '../components/layout/nav-prestamista.php'; ?>

  <div class="container mt-4 mb-4 p-5">
    <h1 class="titulo">Cliente: <?= $_SESSION['usuario'][0]["nombre_cliente"]; ?></h1>
    <!-- Button trigger modal -->
    <button type="button" id="btn-abrir-modal" class="btn btn-success mt-3" data-toggle="modal" data-target="#modalCuenta">
      Crear Cuenta
    </button>

    <!-- Modal -->
    <form id="form-cuenta">
      <div class="modal fade" id="modalCuenta" data-backdrop="static" data-keyboard="false" tabindex="-1" aria-labelledby="modalCuentaLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
          <div class="modal-content">
            <div class="modal-header">
              <h5 class="modal-title" id="modalCuentaLabel">Formulario Crear Cuenta</h5>

            </div>
            <div class="modal-body">
              <div class="row">
                <div class="col-md-12 mb-3">
                  <label for="tipo_cuenta" class="form-label">Tipo Cuenta:</label>
                  <select id="tipo_cuenta" name="tipo_cuenta" class="form-control border border-primary">
                    <option value="">Seleccione tipo</option>
                    <option value="Ahorro">Cuenta Ahorro</option>
                    <option value="Corriente">Cuenta Corriente</option>
                  </select>
                </div>
               
              </div>
            </div>
            <div class="modal-footer">
              <button type="submit" class="btn btn-primary" id="btn-crear">Crear</button>
              <button type="button" class="btn btn-danger" id="btn-cancelar" data-dismiss="modal">Cancelar</button>
            </div>
          </div>
        </div>
      </div>
    </form>
    <div class="row" id="contenedor-cuentas">

    </div>
  </div>

  <?php
  require_once '../components/layout/footer.php';
  require_once '../components/layout/scripts.php';
  ?>
  <script src="../components/js/prestamista.main.js"></script>
  <script>
    document.addEventListener('DOMContentLoaded', async () => {
      await obtenerCuentas();
    });
  </script>
</body>

</html>
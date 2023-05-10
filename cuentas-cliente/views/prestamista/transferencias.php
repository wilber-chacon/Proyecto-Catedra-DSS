<!DOCTYPE html>
<html lang="es">

<head>
  <?php require_once '../components/layout/head-Prestamista.php'; ?>
</head>

<body>
  <?php require_once '../components/layout/nav-prestamista.php'; ?>

  <div class="container mt-4 mb-4 p-5">
    <h1 class="titulo">Cliente: <?= $_SESSION['usuario'][0]["nombre_cliente"]; ?></h1>
    <div class="row">
      <div class="col-md-12 mt-4 mb-4">
      <div class="table-responsive">
        <table id="tbl_Transferencias" class="table table-bordered display" cellspacing="0" width="100%">
          <thead>
            <tr>
              <th style="width: 16%;">Núm. Transacción</th>              
              <th style="width: 16%;">Fecha Transacción</th>
              <th style="width: 16%;">Monto Transacción</th>
              <th style="width: 16%;">Cuenta de destino</th>
              <th style="width: 16%;">Concepto de transferencia</th>
              <th style="width: 16%;">Cuenta de origen</th>
            </tr>
          </thead>
          <tbody>

          </tbody>
          <tfoot>
            <tr>
            <th style="width: 16%;">Núm. Transacción</th>              
              <th style="width: 16%;">Fecha Transacción</th>
              <th style="width: 16%;">Monto Transacción</th>
              <th style="width: 16%;">Cuenta de destino</th>
              <th style="width: 16%;">Concepto de transferencia</th>
              <th style="width: 16%;">Cuenta de origen</th>
            </tr>
          </tfoot>
        </table>
      </div>
      </div>
    </div>
  </div>

  <?php
  require_once '../components/layout/footer.php';
  require_once '../components/layout/scripts.php';
  ?>
  <script src="../components/js/prestamistaTransferencias.js"></script>
  <script>
    document.addEventListener('DOMContentLoaded', async () => {
      await listarTransferencias();
    });
  </script>
</body>

</html>
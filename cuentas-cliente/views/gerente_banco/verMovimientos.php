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
  <div class="container mt-4 mb-4 p-5">
    <h1 class="titulo mb-5">Movimientos de las cuentas</h1>
    <ul class="nav nav-tabs" id="myTab" role="tablist">
      <li class="nav-item">
        <a class="nav-link active" id="home-tab" data-toggle="tab" href="#home" role="tab" aria-controls="home"
          aria-selected="true">
          Cuentas de sucursal
        </a>
      </li>
      <li class="nav-item">
        <a class="nav-link" id="independientes-tab" data-toggle="tab" href="#independientes" role="tab"
          aria-controls="independientes" aria-selected="false">
          Cuentas independientes de sucursal
        </a>
      </li>
    </ul>


    <div class="tab-content" id="myTabContent">
      <div class="tab-pane fade show active" id="home" role="tabpanel" aria-labelledby="home-tab">
        <div class="card shadow mb-4">
          <div class="card-body">
            <div class="table-responsive">
              <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                <thead>
                  <tr>
                    <th style="width: 16%;">Núm. Transacción</th>
                    <th style="width: 16%;">Tipo Transacción</th>
                    <th style="width: 16%;">Fecha Transacción</th>
                    <th style="width: 16%;">Monto Transacción</th>
                    <th style="width: 16%;">Lugar Transacción</th>
                    <th style="width: 16%;">Cuenta Transacción</th>
                  </tr>
                </thead>
                <tbody>
                  <?php
                  require_once '../../connection/conexion.class.php';
                  $con = new Conexion();
                  $sql = "SELECT a.numTransaccion, a.tipoTransaccion, DATE_FORMAT(a.fechaTransaccion, '%d/%m/%Y') fechaTransaccion,
                  a.montoTransaccion, a.lugarTransaccion, a.numCuenta
                  FROM movimientos a
                  INNER JOIN cuentabancaria b ON a.numCuenta = b.numCuenta
                  INNER JOIN cliente c ON b.codigo_cliente = c.codigo_cliente
                  WHERE b.lugarCreacion = 'En sucursal'
                  ORDER BY a.fechaTransaccion DESC";

                  $stmt = $con->conectar()->prepare($sql);
                  $stmt->execute();
                  $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
                  $con->desconectar();

                  foreach ($result as $fila) {
                    ?>
                    <tr>
                      <td>
                        <?php echo $fila["numTransaccion"] ?>
                      </td>
                      <td>
                        <?php echo $fila["tipoTransaccion"] ?>
                      </td>
                      <td>
                        <?php echo $fila["fechaTransaccion"] ?>
                      </td>
                      <td>
                        <?php echo $fila["montoTransaccion"] ?>
                      </td>
                      <td>
                        <?php echo $fila["lugarTransaccion"] ?>
                      </td>
                      <td>
                        <?php echo $fila["numCuenta"] ?>
                      </td>

                    </tr>
                  <?php } ?>
                </tbody>
                <tfoot>
                  <tr>
                    <th style="width: 16%;">Núm. Transacción</th>
                    <th style="width: 16%;">Tipo Transacción</th>
                    <th style="width: 16%;">Fecha Transacción</th>
                    <th style="width: 16%;">Monto Transacción</th>
                    <th style="width: 16%;">Lugar Transacción</th>
                    <th style="width: 16%;">Cuenta Transacción</th>
                  </tr>
                </tfoot>
              </table>
            </div>
          </div>
        </div>
      </div>

      <div class="tab-pane fade" id="independientes" role="tabpanel" aria-labelledby="independientes-tab">
        <div class="card shadow mb-4">
          <div class="card-body">
            <div class="table-responsive">
              <table class="table table-bordered" id="dataTable2" width="100%" cellspacing="0">
                <thead>
                  <tr>
                    <th style="width: 16%;">Núm. Transacción</th>
                    <th style="width: 16%;">Tipo Transacción</th>
                    <th style="width: 16%;">Fecha Transacción</th>
                    <th style="width: 16%;">Monto Transacción</th>
                    <th style="width: 16%;">Lugar Transacción</th>
                    <th style="width: 16%;">Cuenta Transacción</th>
                  </tr>
                </thead>
                <tbody>
                  <?php
                  require_once '../../connection/conexion.class.php';
                  $con = new Conexion();
                  $sql = "SELECT a.numTransaccion, a.tipoTransaccion, DATE_FORMAT(a.fechaTransaccion, '%d/%m/%Y') fechaTransaccion,
                  a.montoTransaccion, a.lugarTransaccion, a.numCuenta
                  FROM movimientos a
                  INNER JOIN cuentabancaria b ON a.numCuenta = b.numCuenta
                  INNER JOIN cliente c ON b.codigo_cliente = c.codigo_cliente
                  WHERE b.lugarCreacion = 'En linea'
                  ORDER BY a.fechaTransaccion DESC";

                  $stmt = $con->conectar()->prepare($sql);
                  $stmt->execute();
                  $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
                  $con->desconectar();

                  foreach ($result as $fila) {
                    ?>
                    <tr>
                      <td>
                        <?php echo $fila["numTransaccion"] ?>
                      </td>
                      <td>
                        <?php echo $fila["tipoTransaccion"] ?>
                      </td>
                      <td>
                        <?php echo $fila["fechaTransaccion"] ?>
                      </td>
                      <td>
                        <?php echo $fila["montoTransaccion"] ?>
                      </td>
                      <td>
                        <?php echo $fila["lugarTransaccion"] ?>
                      </td>
                      <td>
                        <?php echo $fila["numCuenta"] ?>
                      </td>

                    </tr>
                  <?php } ?>
                </tbody>
                <tfoot>
                  <tr>
                    <th style="width: 16%;">Núm. Transacción</th>
                    <th style="width: 16%;">Tipo Transacción</th>
                    <th style="width: 16%;">Fecha Transacción</th>
                    <th style="width: 16%;">Monto Transacción</th>
                    <th style="width: 16%;">Lugar Transacción</th>
                    <th style="width: 16%;">Cuenta Transacción</th>
                  </tr>
                </tfoot>
              </table>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>

  <?php
  require_once '../components/layout/footer.php';
  require_once '../components/layout/scripts.php';
  ?>

</body>

</html>
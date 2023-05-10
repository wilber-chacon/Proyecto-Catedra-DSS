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
  <?php
  require_once '../components/layout/nav-cajero.php';
  require_once '../../connection/conexion.class.php';
  $con = new Conexion();
  ?>
  <div class="container mt-4 mb-4 p-5">
    <h1 class="titulo mb-5">Préstamos</h1>
    <div class="card shadow mb-4">
      <div class="card-body">
        <a href="registrarPrestamo.php" class="btn btn-primary mb-5"><i class="fas fa-plus"></i> Aperturar
          prestamo</a>
        <div class="table-responsive">
          <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
            <thead>
              <tr>
                <th>Cliente</th>
                <th>Estado</th>
                <th>Fecha de apertura</th>
                <th>Monto</th>
                <th>Cuota mensual</th>
                <th>Interes</th>
                <th>Operaciones</th>
              </tr>
            </thead>
            <tbody>
              <?php
              $sql = "SELECT p.numPrestamo, c.nombre_cliente, p.estado_prestamo, p.fechaApertura,
                    p.monto_prestamo, p.cuotaMensual, p.porcentajeInteres
                  FROM prestamos as p
                  INNER JOIN cliente as c ON p.codigo_cliente = c.codigo_cliente
                  WHERE p.estado_prestamo = 'En espera'";

              $stmt = $con->conectar()->prepare($sql);
              $stmt->execute();
              $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
              $con->desconectar();

              foreach ($result as $fila) {
                ?>
                <tr>
                  <td>
                    <?php echo $fila["nombre_cliente"] ?>
                  </td>
                  <td>
                    <?php echo $fila["estado_prestamo"] ?>
                  </td>
                  <td>
                    <?php echo $fila["fechaApertura"] ?>
                  </td>
                  <td>
                    $
                    <?php echo $fila["monto_prestamo"] ?>
                  </td>
                  <td>
                    $
                    <?php echo $fila["cuotaMensual"] ?>
                  </td>
                  <td>
                    <?php echo $fila["porcentajeInteres"] ?>%
                  </td>
                  <td style=" display: flex; align-items: center;">
                    <a onclick="consultar('<?php echo $fila['numPrestamo']; ?>')" class="btn btn-info m-3" title="Ver">
                      <i class="fas fa-fw fa-eye"></i>
                    </a>
                  </td>
                </tr>
              <?php } ?>
            </tbody>
          </table>
        </div>
      </div>
    </div>
  </div>

  <?php
  require_once '../components/layout/footer.php';
  require_once '../components/layout/scripts.php';
  ?>

  <script>
    function consultar(id) {
      location.href = "../../controllers/CajeroController.php?operacion=consultarPrestamo&id=" + id;
    }
  </script>
</body>

</html>









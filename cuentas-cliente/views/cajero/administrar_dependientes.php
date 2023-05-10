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
    <h1 class="titulo mb-5">Dependientes del banco</h1>
    <div class="card shadow mb-4">
      <div class="card-body">
        <a href="registrarDependiente.php" class="btn btn-primary mb-5"><i class="fas fa-user-plus"></i> Registrar dependiente</a>
        <div class="table-responsive">
          <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
            <thead>
              <tr>
                <th>Nombre</th>
                <th>DUI</th>
                <th>Correo</th>
                <th>Telefono</th>
                <th>Negocio</th>
                <th>Operaciones</th>
              </tr>
            </thead>
            <tbody>
              <?php
              require_once '../../connection/conexion.class.php';
              $con = new Conexion();
              $sql = "SELECT d.codigo_dependiente, d.nombre_dependiente, d.DUI_dependiente, d.correo_dependiente, d.telefono_dependiente, d.tipoNegocio FROM dependiente as d";

              $stmt = $con->conectar()->prepare($sql);
              $stmt->execute();
              $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
              $con->desconectar();

              foreach ($result as $fila) {
                ?>
                <tr>
                  <td>
                    <?php echo $fila["nombre_dependiente"] ?>
                  </td>
                  <td>
                    <?php echo $fila["DUI_dependiente"] ?>
                  </td>
                  <td>
                    <?php echo $fila["correo_dependiente"] ?>
                  </td>
                  <td>
                    <?php echo $fila["telefono_dependiente"] ?>
                  </td>
                  <td>
                    <?php echo $fila["tipoNegocio"] ?>
                  </td>
                  <td style=" display: flex; align-items: center;">
                    <a onclick="consultar('<?php echo $fila['codigo_dependiente']; ?>')" class="btn m-auto btn-info m-3"
                      title="Ver">
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
      location.href = "../../controllers/CajeroController.php?operacion=consultarD&id=" + id;
    }
  </script>
</body>

</html>
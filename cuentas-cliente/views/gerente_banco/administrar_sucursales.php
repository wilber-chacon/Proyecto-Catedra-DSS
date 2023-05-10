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
    <h1 class="titulo mb-5">Sucursales</h1>
    <div class="card shadow mb-4">
      <div class="card-body">
        <a href="registrarSucursal.php" class="btn btn-primary mb-5"><i class="fas fa-plus"></i> Registrar sucursal</a>
        <div class="table-responsive">
          <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
            <thead>
              <tr>
                <th>Nombre</th>                
                <th>Dirección</th>
                <th>Operaciones</th>
              </tr>
            </thead>
            <tbody>
              <?php
              require_once '../../connection/conexion.class.php';
              $con = new Conexion();
              $sql = "SELECT s.codigo_sucursal, s.nombre_sucursal, s.direccion_sucursal
              FROM sucursal AS s";

              $stmt = $con->conectar()->prepare($sql);
              $stmt->execute();
              $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
              $con->desconectar();

              foreach ($result as $fila) {
                ?>
                <tr>
                  <td>
                    <?php echo $fila["nombre_sucursal"] ?>
                  </td>
                  <td>
                    <?php echo $fila["direccion_sucursal"] ?>
                  </td>                  
                  <td class="text-center">                    
                    <a onclick="obtener('<?php echo $fila['codigo_sucursal']; ?>')" class="btn text-white btn-info m-3"
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
    function obtener(id) {
      location.href = "../../controllers/gerenteGeneralController.php?operacion=obtenerSu&id=" + id;
    }
  </script>
</body>

</html>
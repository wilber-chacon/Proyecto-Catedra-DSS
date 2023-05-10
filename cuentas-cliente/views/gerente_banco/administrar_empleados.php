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
    <h1 class="titulo mb-5">Empleados</h1>
    <ul class="nav nav-tabs" id="myTab" role="tablist">
      <li class="nav-item">
        <a class="nav-link active" id="home-tab" data-toggle="tab" href="#home" role="tab" aria-controls="home"
          aria-selected="true">
          Solicitudes de aprobación
        </a>
      </li>
      <li class="nav-item">
        <a class="nav-link" id="Aprobados-tab" data-toggle="tab" href="#Aprobados" role="tab" aria-controls="Aprobados"
          aria-selected="false">
          Aprobados
        </a>
      </li>
      <li class="nav-item">
        <a class="nav-link" id="Rechazados-tab" data-toggle="tab" href="#Rechazados" role="tab" aria-controls="Rechazados"
          aria-selected="false">
          Rechazados
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
                    <th>Nombre</th>
                    <th>Rol</th>
                    <th>Sucursal</th>
                    <th>DUI</th>
                    <th>Estado</th>
                    <th>Telefono</th>
                    <th>Operaciones</th>
                  </tr>
                </thead>
                <tbody>
                  <?php
                  require_once '../../connection/conexion.class.php';
                  $con = new Conexion();
                  $sql = "SELECT e.codigo_empleado, e.nombre_empleado, r.nombre_rol, s.nombre_sucursal, e.DUI_empleado,
                  e.Estado_empleado, e.telefono_empleado
                  FROM empleados as e
                  INNER JOIN roles as r ON e.codigo_rol = r.codigo_rol
                  INNER JOIN sucursal as s ON e.codigo_sucursal = s.codigo_sucursal 
                  WHERE e.Estado_empleado = 'En espera de aprobación'";

                  $stmt = $con->conectar()->prepare($sql);
                  $stmt->execute();
                  $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
                  $con->desconectar();

                  foreach ($result as $fila) {
                    ?>
                    <tr>
                      <td>
                        <?php echo $fila["nombre_empleado"] ?>
                      </td>
                      <td>
                        <?php echo $fila["nombre_rol"] ?>
                      </td>
                      <td>
                        <?php echo $fila["nombre_sucursal"] ?>
                      </td>
                      <td>
                        <?php echo $fila["DUI_empleado"] ?>
                      </td>
                      <td>
                        <?php echo $fila["Estado_empleado"] ?>
                      </td>
                      <td>
                        <?php echo $fila["telefono_empleado"] ?>
                      </td>
                      <td style=" display: flex; align-items: center;">
                        <a onclick="obtener('<?php echo $fila['codigo_empleado']; ?>')" class="btn btn-info m-3"
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

      <div class="tab-pane fade" id="Aprobados" role="tabpanel" aria-labelledby="Aprobados-tab">
      <div class="card shadow mb-4">
          <div class="card-body">
            <div class="table-responsive">
              <table class="table table-bordered" id="dataTable2" width="100%" cellspacing="0">
                <thead>
                  <tr>
                    <th>Nombre</th>
                    <th>Rol</th>
                    <th>Sucursal</th>
                    <th>DUI</th>
                    <th>Estado</th>
                    <th>Telefono</th>
                    <th>Operaciones</th>
                  </tr>
                </thead>
                <tbody>
                  <?php
                  require_once '../../connection/conexion.class.php';
                  $con = new Conexion();
                  $sql = "SELECT e.codigo_empleado, e.nombre_empleado, r.nombre_rol, s.nombre_sucursal, e.DUI_empleado,
                  e.Estado_empleado, e.telefono_empleado
                  FROM empleados as e
                  INNER JOIN roles as r ON e.codigo_rol = r.codigo_rol
                  INNER JOIN sucursal as s ON e.codigo_sucursal = s.codigo_sucursal 
                  WHERE e.Estado_empleado = 'Activo'";

                  $stmt = $con->conectar()->prepare($sql);
                  $stmt->execute();
                  $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
                  $con->desconectar();

                  foreach ($result as $fila) {
                    ?>
                    <tr>
                      <td>
                        <?php echo $fila["nombre_empleado"] ?>
                      </td>
                      <td>
                        <?php echo $fila["nombre_rol"] ?>
                      </td>
                      <td>
                        <?php echo $fila["nombre_sucursal"] ?>
                      </td>
                      <td>
                        <?php echo $fila["DUI_empleado"] ?>
                      </td>
                      <td>
                        <?php echo $fila["Estado_empleado"] ?>
                      </td>
                      <td>
                        <?php echo $fila["telefono_empleado"] ?>
                      </td>
                      <td style=" display: flex; align-items: center;">
                        <a onclick="consultar('<?php echo $fila['codigo_empleado']; ?>')" class="btn btn-info m-3"
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

      <div class="tab-pane fade" id="Rechazados" role="tabpanel" aria-labelledby="Rechazados-tab">
      <div class="card shadow mb-4">
          <div class="card-body">
            <div class="table-responsive">
              <table class="table table-bordered" id="dataTable3" width="100%" cellspacing="0">
                <thead>
                  <tr>
                    <th>Nombre</th>
                    <th>Rol</th>
                    <th>Sucursal</th>
                    <th>DUI</th>
                    <th>Estado</th>
                    <th>Telefono</th>
                    <th>Operaciones</th>
                  </tr>
                </thead>
                <tbody>
                  <?php
                  require_once '../../connection/conexion.class.php';
                  $con = new Conexion();
                  $sql = "SELECT e.codigo_empleado, e.nombre_empleado, r.nombre_rol, s.nombre_sucursal, e.DUI_empleado,
                  e.Estado_empleado, e.telefono_empleado
                  FROM empleados as e
                  INNER JOIN roles as r ON e.codigo_rol = r.codigo_rol
                  INNER JOIN sucursal as s ON e.codigo_sucursal = s.codigo_sucursal 
                  WHERE e.Estado_empleado = 'Inactivo' OR e.Estado_empleado = 'Rechazado'";

                  $stmt = $con->conectar()->prepare($sql);
                  $stmt->execute();
                  $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
                  $con->desconectar();

                  foreach ($result as $fila) {
                    ?>
                    <tr>
                      <td>
                        <?php echo $fila["nombre_empleado"] ?>
                      </td>
                      <td>
                        <?php echo $fila["nombre_rol"] ?>
                      </td>
                      <td>
                        <?php echo $fila["nombre_sucursal"] ?>
                      </td>
                      <td>
                        <?php echo $fila["DUI_empleado"] ?>
                      </td>
                      <td>
                        <?php echo $fila["Estado_empleado"] ?>
                      </td>
                      <td>
                        <?php echo $fila["telefono_empleado"] ?>
                      </td>
                      <td style=" display: flex; align-items: center;">
                        <a onclick="consultar('<?php echo $fila['codigo_empleado']; ?>')" class="btn btn-info m-3"
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
    </div>
  </div>

  <?php
  require_once '../components/layout/footer.php';
  require_once '../components/layout/scripts.php';
  ?>

  <script>
    function consultar(id) {
      location.href = "../../controllers/gerenteGeneralController.php?operacion=consultarE&id=" + id;
    }
    function obtener(id) {
      location.href = "../../controllers/gerenteGeneralController.php?operacion=verEmpleado&id=" + id;
    }
  </script>
</body>

</html>
<!DOCTYPE html>
<html lang="es">

<head>
  
  <?php require_once '../components/layout/head.php';
  if ($_SESSION['rol'] != 5) {
    header('Location: ../login_admin/');
  }
  ?>
</head>

<body>
  <?php require_once '../components/layout/nav.php'; ?>
  <div class="container mt-4 mb-4 p-5">
    <h1 class="titulo">Operaciones</h1>
    <div class="row">
      <div class="col-xl-4 col-md-6 mb-4 mt-5">
        <div class="card border-left-info shadow h-100 py-2">
          <div class="card-body">
            <div class="row no-gutters align-items-center">
              <div class="col mr-2">
                <div class="h5 mb-0 font-weight-bold text-gray-800 text-uppercase">
                  <a href="administrar_empleados.php" class="text-info" style="display: block; margin: 25px 10px">Administrar
                    empleados</a>
                </div>
              </div>
              <div class="col-auto">
                <i class="fas fa-table fa-2x text-gray-300"></i>
              </div>
            </div>
          </div>
        </div>
      </div>
      <div class="col-xl-4 col-md-6 mb-4 mt-5">
        <div class="card border-left-warning shadow h-100 py-2">
          <div class="card-body">
            <div class="row no-gutters align-items-center">
              <div class="col mr-2">
                <div class="h5 mb-0 font-weight-bold text-gray-800 text-uppercase">
                  <a href="./administrar_prestamos.php" class="text-warning" style="display: block; margin: 25px 10px">Administrar
                    prestamos</a>
                </div>
              </div>
              <div class="col-auto">
                <i class="fas fa-table fa-2x text-gray-300"></i>
              </div>
            </div>
          </div>
        </div>
      </div>
      <div class="col-xl-4 col-md-6 mb-4 mt-5">
        <div class="card border-left-danger shadow h-100 py-2">
          <div class="card-body">
            <div class="row no-gutters align-items-center">
              <div class="col mr-2">
                <div class="h5 mb-0 font-weight-bold text-gray-800 text-uppercase">
                  <a href="#" class="text-danger" data-toggle="modal" data-target="#logoutModal" style="display: block; margin: 25px 10px">Salir</a>
                </div>
              </div>
              <div class="col-auto">
                <i class="fas fa-sign-out-alt fa-2x text-gray-300"></i>
              </div>
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
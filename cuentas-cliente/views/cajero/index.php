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
    <h1 class="titulo">Operaciones</h1>
    <div class="row">
      <div class="col-xl-4 col-md-6 mb-4 mt-5">
        <div class="card border-left-info shadow h-100 py-2">
          <div class="card-body">
            <div class="row no-gutters align-items-center">
              <div class="col mr-2">
                <div class="h5 mb-0 font-weight-bold text-gray-800 text-uppercase">
                  <a href="administrar_clientes.php" class="text-info" style="display: block; margin: 25px 10px">Ingresar cliente</a>
                </div>
              </div>
              <div class="col-auto">
                <i class="fas fa-user-plus fa-2x text-gray-300"></i>
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
                  <a href="administrar_dependientes.php" class="text-warning" style="display: block; margin: 25px 10px">Agregar dependiente de banco</a>
                </div>
              </div>
              <div class="col-auto">
              <i class="fas fa-user-plus fa-2x text-gray-300"></i>
              </div>
            </div>
          </div>
        </div>
      </div>
      <div class="col-xl-4 col-md-6 mb-4 mt-5">
        <div class="card border-left-primary shadow h-100 py-2">
          <div class="card-body">
            <div class="row no-gutters align-items-center">
              <div class="col mr-2">
                <div class="h5 mb-0 font-weight-bold text-gray-800 text-uppercase">
                  <a href="./cuentasIngreso.php" class="text-primary" style="display: block; margin: 25px 10px">Depositar dinero</a>
                </div>
              </div>
              <div class="col-auto">
                <i class="fas fa-hand-holding-usd fa-2x text-gray-300"></i>
              </div>
            </div>
          </div>
        </div>
      </div>
      <div class="col-xl-4 col-md-6 mb-4 mt-5">
        <div class="card border-left-success shadow h-100 py-2">
          <div class="card-body">
            <div class="row no-gutters align-items-center">
              <div class="col mr-2">
                <div class="h5 mb-0 font-weight-bold text-gray-800 text-uppercase">
                  <a href="./cuentasRetiro.php" class="text-success" style="display: block; margin: 25px 10px">Retirar dinero</a>
                </div>
              </div>
              <div class="col-auto">
              <i class="fas fa-hand-holding-usd fa-2x text-gray-300"></i>
              </div>
            </div>
          </div>
        </div>
      </div>
      <div class="col-xl-4 col-md-6 mb-4 mt-5">
        <div class="card border-left-secondary shadow h-100 py-2">
          <div class="card-body">
            <div class="row no-gutters align-items-center">
              <div class="col mr-2">
                <div class="h5 mb-0 font-weight-bold text-gray-800 text-uppercase">
                  <a href="./transferenciaDinero.php" class="text-secondary" style="display: block; margin: 25px 10px">Transferencia de dinero</a>
                </div>
              </div>
              <div class="col-auto">
                <i class="fas fa-file-invoice-dollar fa-2x text-gray-300"></i>
              </div>
            </div>
          </div>
        </div>
      </div>
      <div class="col-xl-4 col-md-6 mb-4 mt-5">
        <div class="card border-left-success shadow h-100 py-2">
          <div class="card-body">
            <div class="row no-gutters align-items-center">
              <div class="col mr-2">
                <div class="h5 mb-0 font-weight-bold text-gray-800 text-uppercase">
                  <a href="./administrar_prestamos.php" class="text-success" style="display: block; margin: 25px 10px">Administrar préstamos</a>
                </div>
              </div>
              <div class="col-auto">
                <i class="fas fa-dollar-sign fa-2x text-gray-300"></i>
              </div>
            </div>
          </div>
        </div>
      </div>
      <div class="col-xl-4 col-md-6 mb-4 mt-5">
        <div class="card border-left-dark shadow h-100 py-2">
          <div class="card-body">
            <div class="row no-gutters align-items-center">
              <div class="col mr-2">
                <div class="h5 mb-0 font-weight-bold text-gray-800 text-uppercase">
                  <a href="./crearCuenta.php" class="text-dark" style="display: block; margin: 25px 10px">Crear cuenta bancaria</a>
                </div>
              </div>
              <div class="col-auto">
                <i class="fas fa-file-invoice-dollar fa-2x text-gray-300"></i>
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
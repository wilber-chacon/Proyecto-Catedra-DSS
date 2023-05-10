<!DOCTYPE html>
<html lang="es">

<head>
  <?php require_once 'components/layout/head.php'; ?>
</head>

<body>
  <?php require_once 'components/layout/nav.php'; ?>

  <div class="container mt-4 mb-4 p-5">
    <?php
    if ($_GET) {

      if (isset($_GET['datos'])) { ?>

        <?php
        /* Deshacemos el trabajo hecho por 'serialize' */
        $lista = unserialize($_GET['datos']); ?>

        <h1 class="titulo">Cliente:
          <?= $lista->cliente; ?>
        </h1>

        <div class="row" id="contenedor-cuentas">

          <?php

          foreach ($lista->cuentas as $c) {
            $html = "<div class=\"col-xl-4 col-md-6 mb-4 mt-4\">
                    <div class=\"card border-left-primary shadow h-100 py-2\">
                      <div class=\"card-body\">
                        <div class=\"row no-gutters align-items-center\">
                          <div class=\"col mr-2\">
                            <div class=\"h5 mb-0 font-weight-bold text-gray-800 text-uppercase\">
                              <p class=\"text-info\" style=\"display: block; margin: 25px 10px\">
                                <b>Cuenta: </b>
                                <span class=\"text-dark\">$c->numCuenta</span>
                              </p>
                            </div>
                            <div class=\"h5 mb-0 font-weight-bold text-gray-800 text-uppercase\">
                              <p class=\"text-info\" style=\"display: block; margin: 25px 10px\">
                                <b>Tipo: </b><span class=\"text-dark\">$c->tipoCuenta</span>
                              </p>
                            </div>
                            <div class=\"h5 mb-0 font-weight-bold text-gray-800 text-uppercase\">
                              <p class=\"text-info\" style=\"display: block; margin: 25px 10px\">
                                <b>Saldo: </b><span class=\"text-dark\">$ $c->saldoCuenta</span>
                              </p>
                            </div>
                            <div class=\"h5 mb-0 font-weight-bold text-gray-800\">
                            <a href=\"completarIngreso.php?num=$c->numCuenta&saldo=$c->saldoCuenta\" class=\"btn btn-success\">Seleccionar</a>
                            </div>
                          </div>
                          <div class=\"col-auto\">
                            <i class=\"fas fa-dollar-sign fa-5x text-gray-300\"></i>
                          </div>
                        </div>
                      </div>
                    </div>
                  </div>";
            echo ($html);
          }
          ?>


          <?php
      }
    }

    ?>

    </div>
  </div>

  <?php
  require_once 'components/layout/footer.php';
  require_once 'components/layout/scripts.php';
  ?>
  <script src="components/js/dependiente.main.js"></script>
  <script>
    // document.addEventListener('DOMContentLoaded', async () => {
    //   await obtenerCuentas();
    // });
  </script>
</body>

</html>
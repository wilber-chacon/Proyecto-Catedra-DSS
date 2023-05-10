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
  <div class="container mt-4 mb-4 pt-4">
    <h1 class="titulo mb-5">Detalles del empleado</h1>
    <form action="#" method="post" class="formA p-5" style="margin: auto;">
      <?php

      include '../../models/empleado.php';
      $empleado = new Empleado();
      if ($_GET) {
        if (isset($_GET['empleado'])) {
          $empleado = unserialize($_GET['empleado']); ?>
          <fieldset>
            <div class="form-group row">
              <label for="Nombre" class="col-sm-3 col-form-label">Nombre:</label>
              <div class="col-sm-9">
                <input type="text" class="form-control" value="<?php print($empleado->getnombre()); ?>" name="Nombre"
                  id="Nombre" readonly>
              </div>
            </div>
            <div class="form-group row">
              <label for="Correo" class="col-sm-3 col-form-label">Correo electronico:</label>
              <div class="col-sm-9">
                <input type="text" class="form-control" value="<?php print($empleado->getcorreo()); ?>" name="Correo"
                  id="Correo" readonly />
              </div>
            </div>
            <div class="form-group row">
              <label for="DUI" class="col-sm-3 col-form-label">DUI:</label>
              <div class="col-sm-9">
                <input type="text" class="form-control" value="<?php print($empleado->getdui()); ?>" name="DUI" id="DUI"
                  readonly>
              </div>
            </div>
            <div class="form-group row">
              <label for="Telefono" class="col-sm-3 col-form-label">Telefono:</label>
              <div class="col-sm-9">
                <input type="text" class="form-control" value="<?php print($empleado->gettelefono()); ?>" name="Telefono"
                  id="Telefono" readonly />
              </div>
            </div>
            <div class="form-group row">
              <label for="domicilio" class="col-sm-3 col-form-label">Domicilio:</label>
              <div class="col-sm-9">
                <textarea name="domicilio" id="domicilio" cols="15" class="form-control" rows="3"
                  readonly><?php print($empleado->getdireccion()); ?></textarea>
              </div>
            </div>
            <div class="form-group row">
              <label for="fechanacimiento" class="col-sm-3 col-form-label">Fecha de nacimiento:</label>
              <div class="col-sm-9">
                <input type="text" name="fechanacimiento" id="fechanacimiento"
                  value="<?php print($empleado->getfechanacimiento()); ?>" class="form-control" readonly>
              </div>
            </div>
            <div class="form-group row">
              <label for="acciones" class="col-sm-3 col-form-label">Acciones:</label>
              <div class="col-sm-9">
                <textarea name="acciones" id="acciones" cols="15" class="form-control" rows="3"
                  readonly><?php print($empleado->getacciones()); ?></textarea>
              </div>
            </div>
            <div class="form-group row">
              <label for="Rol" class="col-sm-3 col-form-label">Rol:</label>
              <div class="col-sm-9">
                <input type="text" name="Rol" id="Rol" value="<?php print($empleado->getnombrerol()); ?>"
                  class="form-control" readonly>
              </div>
            </div>
            <div class="form-group row">
              <label for="Sucursal" class="col-sm-3 col-form-label">Sucursal:</label>
              <div class="col-sm-9">
                <input type="text" name="Sucursal" id="Sucursal" value="<?php print($empleado->getsucursal()); ?>"
                  class="form-control" readonly>
              </div>
            </div>
            <div class="form-group row">
              <label for="Estado" class="col-sm-3 col-form-label">Estado:</label>
              <div class="col-sm-9">
                <input type="text" name="Estado" id="Estado" value="<?php print($empleado->getestado()); ?>"
                  class="form-control" readonly>
              </div>
            </div>
            <?php
        }
      } ?>
      </fieldset>
      <div class="row">
        <div class="col">
          <a href="#" data-toggle="modal" data-target="#AprobarModal" class="btn btn-success mt-5  btn-sm btn-block"
            style="width: 100%; margin: auto;">Aprobar</a>
        </div>
        <div class="col">
          <a href="#" data-toggle="modal" data-target="#RechazarModal" class="btn btn-danger mt-5  btn-sm btn-block"
            style="width: 100%; margin: auto;">Rechazar</a>
        </div>
        <div class="col">
          <a href="./administrar_empleados.php" class="btn btn-primary mt-5  btn-sm btn-block"
            style="width: 100%; margin: auto;">Atras</a>
        </div>
      </div>
    </form>
    <br><br><br>
  </div>

  <div class="modal fade" id="AprobarModal" tabindex="-1" role="dialog" aria-labelledby="Aprobar" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">Aprobar</h5>
          <button class="close" type="button" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">×</span>
          </button>
        </div>
        <div class="modal-body">
          ¿Seguro que desea aprobar al empleado?
        </div>
        <div class="modal-footer">
          <button class="btn btn-secondary" type="button" data-dismiss="modal">
            Cancelar
          </button>
          <form id="form-aprobar">
            <input type="hidden" name="id" id="id" value="<?php print($empleado->getcodigoE()); ?>">
            <button class="btn btn-primary" type="submit" id="btn-aprobar">Aceptar</button>
          </form>
        </div>
      </div>
    </div>
  </div>

  <div class="modal fade" id="RechazarModal" tabindex="-1" role="dialog" aria-labelledby="Rechazar" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">Rechazar</h5>
          <button class="close" type="button" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">×</span>
          </button>
        </div>
        <div class="modal-body">
          ¿Seguro que desea rechazar al empleado?
        </div>
        <div class="modal-footer">
          <button class="btn btn-secondary" type="button" data-dismiss="modal">
            Cancelar
          </button>
          <form id="form-rechazar">
            <input type="hidden" name="id" id="id" value="<?php print($empleado->getcodigoE()); ?>">
            <button class="btn btn-primary" type="submit" id="btn-rechazar">Aceptar</button>
          </form>

        </div>
      </div>
    </div>
  </div>

  <?php
  require_once '../components/layout/footer.php';
  require_once '../components/layout/scripts.php';
  ?>
  <script src="../components/js/gestionarEmp.js"></script>
</body>

</html>
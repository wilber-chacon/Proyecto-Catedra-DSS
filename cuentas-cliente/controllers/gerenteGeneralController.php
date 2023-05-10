<?php

header('Content-Type: text/html; charset=ISO-8859-1');

require_once '../connection/conexion.class.php';
require_once '../models/empleado.php';
require_once '../models/prestamo.php';
require_once '../models/dependiente.php';
require_once '../models/auth.class.php';
require_once '../models/gerenteGeneralModel.php';
require_once '../helpers/helper.class.php';

if ($_GET) {
  $op = $_GET['operacion'];
} else if ($_POST) {
  $op = $_POST['operacion'];
}

switch ($op) {
  case 'consultarE':
    $id = $_GET['id'];
    consultarE($id);
    break;
  case 'verEmpleado':
    $id = $_GET['id'];
    verEmpleado($id);
    break;
  case 'rechazarE':
    rechazarE();
    break;
  case 'aprobarE':
    aprobarE();
    break;
  case 'registrarS':
    registrarS();
    break;
  case 'obtenerSu':
    $id = $_GET['id'];
    obtenerSu($id);
    break;
}


function registrarS()
{
  $hlp = new Helper();
  $am = new Auth();
  $model = new GerenteGeneralModel();

  $nombre = isset($_POST['nombre']) ? $hlp->limpiarParametro($_POST['nombre']) : false;
  $dui = isset($_POST['dui']) ? $hlp->limpiarParametro($_POST['dui']) : false;
  $correo = isset($_POST['correo']) ? $hlp->limpiarParametro($_POST['correo']) : false;
  $tel = isset($_POST['telefono']) ? $hlp->limpiarParametro($_POST['telefono']) : false;
  $domicilio = isset($_POST['domicilio']) ? $hlp->limpiarParametro($_POST['domicilio']) : false;
  $fechanacimiento = isset($_POST['fechanacimiento']) ? $hlp->limpiarParametro($_POST['fechanacimiento']) : false;
  $acciones = isset($_POST['acciones']) ? $hlp->limpiarParametro($_POST['acciones']) : false;
  $contrasenia = isset($_POST['pass']) ? $hlp->limpiarParametro($_POST['pass']) : false;
  $nombreSucursal = isset($_POST['nombreSucursal']) ? $hlp->limpiarParametro($_POST['nombreSucursal']) : false;
  $direccionS = isset($_POST['direccion']) ? $hlp->limpiarParametro($_POST['direccion']) : false;

  if (!$nombre || !$dui || !$correo || !$tel || !$domicilio || !$fechanacimiento || !$acciones || !$contrasenia || !$nombreSucursal || !$direccionS) {
    print_r(json_encode([
      "ok" => false,
      "mensaje" => "¡Debe ingresar todos los datos!",
    ], JSON_PRETTY_PRINT, JSON_UNESCAPED_UNICODE));
  } elseif (!$hlp->validarDui($dui)) {
    print_r(json_encode([
      "ok" => false,
      "mensaje" => "¡El DUI ingresado es inválido!",
    ], JSON_PRETTY_PRINT, JSON_UNESCAPED_UNICODE));
  } elseif (!filter_var($correo, FILTER_VALIDATE_EMAIL)) {
    print_r(json_encode([
      "ok" => false,
      "mensaje" => "¡El correo ingresado es inválido!",
    ], JSON_PRETTY_PRINT, JSON_UNESCAPED_UNICODE));
  } elseif (!$hlp->validarTelefono($tel)) {
    print_r(json_encode([
      "ok" => false,
      "mensaje" => "¡El teléfono ingresado es inválido!",
    ], JSON_PRETTY_PRINT, JSON_UNESCAPED_UNICODE));
  } else {
    $existencia = $model->validarEmpleadoSucursal($nombreSucursal);
    if ($existencia) {
      print_r(json_encode([
        "ok" => false,
        "mensaje" => "¡La sucursal ya cuenta con un gerente!",
      ], JSON_PRETTY_PRINT, JSON_UNESCAPED_UNICODE));
    } else {

      $ejec = $model->registrarSesion($correo, $contrasenia);
      $ejec2 = $model->registrarSucursal($nombreSucursal, $direccionS);

      if ($ejec) {
        $estado = "Activo";
        $rol = 5;
        $cod_sesion = $am->obtenerUltimoCodSesion();
        $codSu = $am->obtenerUltimoCodSu();
        $cod_sesion = $cod_sesion['codigo_sesion'];
        $codSu = $codSu['codigo_sucursal'];

        $registro = $model->registrarGerenteS($nombre, $dui, $correo, $tel, $estado, $domicilio, $acciones, $fechanacimiento, $rol, $cod_sesion, $codSu);

        if ($registro) {
          print_r(json_encode([
            "ok" => true,
            "mensaje" => "¡Se ha registrado correctamente!",
          ], JSON_PRETTY_PRINT, JSON_UNESCAPED_UNICODE));
          $hlp->enviarCorreo2($correo, $correo, $contrasenia);
        } else {
          print_r(json_encode([
            "ok" => false,
            "mensaje" => "¡Ocurrió un error al registrarse!",
          ], JSON_PRETTY_PRINT, JSON_UNESCAPED_UNICODE));
        }
      } else {
        print_r(json_encode([
          "ok" => false,
          "mensaje" => "¡Ocurrió un error al registrarse!",
        ], JSON_PRETTY_PRINT, JSON_UNESCAPED_UNICODE));
      }


    }
  }

}

function rechazarE()
{
  $id = $_POST['id'];
  $model = new GerenteGeneralModel();
  $estdo = 'Rechazado';
  $result = $model->actualizarEstado($id, $estdo);
  if ($result) {
    print_r(json_encode([
      "ok" => true,
      "mensaje" => "¡El empleado fue rechazado!",
    ], JSON_PRETTY_PRINT, JSON_UNESCAPED_UNICODE));
  } else {
    print_r(json_encode([
      "ok" => false,
      "mensaje" => "¡Error al rechazar el empleado!",
    ], JSON_PRETTY_PRINT, JSON_UNESCAPED_UNICODE));
  }
}


function aprobarE()
{
  $id = $_POST['id'];
  $model = new GerenteGeneralModel();
  $estdo = 'Activo';
  $result = $model->actualizarEstado($id, $estdo);
  if ($result) {
    print_r(json_encode([
      "ok" => true,
      "mensaje" => "¡El empleado fue aprobado!",
    ], JSON_PRETTY_PRINT, JSON_UNESCAPED_UNICODE));
  } else {
    print_r(json_encode([
      "ok" => false,
      "mensaje" => "¡Error al aprobar el empleado!",
    ], JSON_PRETTY_PRINT, JSON_UNESCAPED_UNICODE));
  }
}

function consultarE($codigo_)
{
  $empleado = new Empleado();
  $model = new GerenteGeneralModel();
  $result = $model->consultarEmpleado($codigo_);

  foreach ($result as $row) {
    $empleado->setcodigoE($row["codigo_empleado"]);
    $empleado->setnombre($row["nombre_empleado"]);
    $empleado->setcorreo($row["usuario"]);
    $empleado->setdui($row["DUI_empleado"]);
    $empleado->settelefono($row["telefono_empleado"]);
    $empleado->setdireccion($row["domicilio_empleado"]);
    $empleado->setfechanacimiento($row["fechaNacimiento_empleado"]);
    $empleado->setacciones($row["acciones"]);
    $empleado->setidrol($row["codigo_rol"]);
    $empleado->setnombrerol($row["nombre_rol"]);
    $empleado->setcodigoSucursal($row["codigo_sucursal"]);
    $empleado->setsucursal($row["nombre_sucursal"]);
    $empleado->setestado($row["Estado_empleado"]);
    $empleado->setpass($row["pass"]);
    $empleado->setcodigosesion($row["codigo_sesion"]);
  }

  //convertiendo el objeto $empleado en una cadena
  $empleado = serialize($empleado);
  //codificando en URL el objeto con urlencode() para poder agregarlo a la URL
  $empleado = urlencode($empleado);
  //redireccionando
  header('Location:../views/gerente_banco/consultarE.php?empleado=' . $empleado);
  //finalizando el script actual
  exit();
}



function verEmpleado($codigo_)
{
  $empleado = new Empleado();
  $model = new GerenteGeneralModel();
  $result = $model->consultarEmpleado($codigo_);

  foreach ($result as $row) {
    $empleado->setcodigoE($row["codigo_empleado"]);
    $empleado->setnombre($row["nombre_empleado"]);
    $empleado->setcorreo($row["usuario"]);
    $empleado->setdui($row["DUI_empleado"]);
    $empleado->settelefono($row["telefono_empleado"]);
    $empleado->setdireccion($row["domicilio_empleado"]);
    $empleado->setfechanacimiento($row["fechaNacimiento_empleado"]);
    $empleado->setacciones($row["acciones"]);
    $empleado->setidrol($row["codigo_rol"]);
    $empleado->setnombrerol($row["nombre_rol"]);
    $empleado->setcodigoSucursal($row["codigo_sucursal"]);
    $empleado->setsucursal($row["nombre_sucursal"]);
    $empleado->setestado($row["Estado_empleado"]);
    $empleado->setpass($row["pass"]);
    $empleado->setcodigosesion($row["codigo_sesion"]);
  }

  //convertiendo el objeto $empleado en una cadena
  $empleado = serialize($empleado);
  //codificando en URL el objeto con urlencode() para poder agregarlo a la URL
  $empleado = urlencode($empleado);
  //redireccionando
  header('Location:../views/gerente_banco/verEmpleado.php?empleado=' . $empleado);
  //finalizando el script actual
  exit();
}



function obtenerSu($codigo_)
{
  $model = new GerenteGeneralModel();
  $result = $model->consultarSucursal($codigo_);
  //convertiendo el objeto $empleado en una cadena
  $result = serialize($result);
  //codificando en URL el objeto con urlencode() para poder agregarlo a la URL
  $result = urlencode($result);
  //redireccionando
  header('Location:../views/gerente_banco/verSucursal.php?sucursal=' . $result);
  //finalizando el script actual
  exit();
}
// CE211044
?>
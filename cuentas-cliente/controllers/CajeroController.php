<?php

header('Content-Type: text/html; charset=ISO-8859-1');

require_once '../connection/conexion.class.php';
require_once '../models/cliente.php';
require_once '../models/prestamo.php';
require_once '../models/dependiente.php';
require_once '../models/auth.class.php';
require_once '../models/cajeroModel.php';
require_once '../helpers/helper.class.php';

if ($_GET) {
  $op = $_GET['operacion'];
} else if ($_POST) {
  $op = $_POST['operacion'];
}

switch ($op) {
  case 'obtenerc':
    $id = $_GET['id'];
    consultarC($id);
    break;
  case 'registrarC':
    registrarC();
    break;
  case 'registrard':
    registrard();
    break;
  case 'consultarD':
    $id = $_GET['id'];
    consultarD($id);
    break;
  case 'vercuentasIngreso':
    vercuentasIngreso();
    break;
  case 'ingreso':
    ingreso();
    break;
  case 'verCuentasRetiro':
    verCuentasRetiro();
    break;
  case 'retiro':
    retiro();
    break;
  case 'crearC':
    crearC();
    break;
  case 'buscarCliente':
    buscarCliente();
    break;
  case 'registrarP':
    registrarP();
    break;
  case 'consultarPrestamo':
    $id = $_GET['id'];
    consultarPrestamo($id);
    break;
  case 'registrarTr':
    registrarTr();
    break;
}


function crearC()
{

  $am = new Auth();
  $hlp = new Helper();
  $model = new CajeroModel();

  $dui = isset($_POST['dui']) ? $hlp->limpiarParametro($_POST['dui']) : false;
  $tipo_cuenta = isset($_POST['tipo_cuenta']) ? $hlp->limpiarParametro($_POST['tipo_cuenta']) : false;
  $saldo = isset($_POST['saldo']) ? $hlp->limpiarParametro($_POST['saldo']) : false;

  if (!$tipo_cuenta || !$dui || !$saldo) {
    print_r(json_encode([
      "ok" => false,
      "mensaje" => "¡Debe ingresar todos los datos!",
    ], JSON_PRETTY_PRINT, JSON_UNESCAPED_UNICODE));
  } elseif (!$hlp->validarDui($dui)) {
    print_r(json_encode([
      "ok" => false,
      "mensaje" => "¡El DUI ingresado es inválido!",
    ], JSON_PRETTY_PRINT, JSON_UNESCAPED_UNICODE));
  } elseif (!$hlp->validarSaldo($saldo)) {
    print_r(json_encode([
      "ok" => false,
      "mensaje" => "¡El saldo ingresado es inválido!",
    ], JSON_PRETTY_PRINT, JSON_UNESCAPED_UNICODE));
  } else {
    if (!$model->validarCliente($dui)) {
      print_r(json_encode([
        "ok" => false,
        "mensaje" => "¡El cliente con DUI $dui aun no ha sido registrado!",
      ], JSON_PRETTY_PRINT, JSON_UNESCAPED_UNICODE));
    } else {
      $contador = $model->obtenerContadorCuentasPorCliente($dui);
      if ($contador >= 3) {
        print_r(json_encode([
          "ok" => false,
          "mensaje" => "¡Solo se puede tener un máximo de 3 cuentas por cliente!",
        ], JSON_PRETTY_PRINT, JSON_UNESCAPED_UNICODE));
      } else {
        $cuenta = $model->registrarCuentaBancaria($tipo_cuenta, $saldo, $dui);
        if ($cuenta) {
          print_r(json_encode([
            "ok" => true,
            "mensaje" => "¡Se ha creado la cuenta correctamente!",
          ], JSON_PRETTY_PRINT, JSON_UNESCAPED_UNICODE));
        } else {
          print_r(json_encode([
            "ok" => false,
            "mensaje" => "¡Ocurrió un error al crear la cuenta!",
          ], JSON_PRETTY_PRINT, JSON_UNESCAPED_UNICODE));
        }

      }
    }
  }

}

// CE211044
function registrarC()
{

  $am = new Auth();
  $hlp = new Helper();

  // $accion = isset($_GET["accion"]) ? (string) $_GET["accion"] : false;
  $nombre = isset($_POST['nombre']) ? $hlp->limpiarParametro($_POST['nombre']) : false;
  $dui = isset($_POST['dui']) ? $hlp->limpiarParametro($_POST['dui']) : false;
  $correo = isset($_POST['correo']) ? $hlp->limpiarParametro($_POST['correo']) : false;
  $tel = isset($_POST['tel']) ? $hlp->limpiarParametro($_POST['tel']) : false;
  $domicilio = isset($_POST['domicilio']) ? $hlp->limpiarParametro($_POST['domicilio']) : false;
  $fecha_naci = isset($_POST['fecha_naci']) ? $hlp->limpiarParametro($_POST['fecha_naci']) : false;
  $sueldo = isset($_POST['sueldo']) ? $hlp->limpiarParametro($_POST['sueldo']) : false;
  $usuario = isset($_POST['usuario']) ? $hlp->limpiarParametro($_POST['usuario']) : false;
  $contrasenia = isset($_POST['contrasenia']) ? $hlp->limpiarParametro($_POST['contrasenia']) : false;
  $contrasenia = md5($contrasenia);
  // $cod = isset($_POST['cod']) ? $hlp->limpiarParametro($_POST['cod']) : false;

  if (!$nombre || !$dui || !$correo || !$tel || !$domicilio || !$fecha_naci || !$sueldo || !$usuario || !$contrasenia) {
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
  } elseif (!$hlp->validarDecimal($sueldo)) {
    print_r(json_encode([
      "ok" => false,
      "mensaje" => "¡El sueldo ingresado es inválido!",
    ], JSON_PRETTY_PRINT, JSON_UNESCAPED_UNICODE));
  } else {
    $cliente = $am->obtenerClientePorUsuarioCorreoDuiTel($usuario, $correo, $dui, $tel);
    if (count($cliente) > 0) {
      print_r(json_encode([
        "ok" => false,
        "mensaje" => "¡Un dato ingresado ya se ha registrado!",
      ], JSON_PRETTY_PRINT, JSON_UNESCAPED_UNICODE));
    } else {
      $sesion = $am->registrarSesion2($usuario, $contrasenia);
      if ($sesion) {
        $cod_sesion = $am->obtenerUltimoCodSesion();
        $registro = $am->registrarCliente($nombre, $dui, $correo, $tel, $domicilio, $fecha_naci, $sueldo, $cod_sesion["codigo_sesion"]);
        $hlp->enviarCorreo2($correo, $usuario, $_POST['contrasenia']);
      }
      if ($registro) {
        print_r(json_encode([
          "ok" => true,
          "mensaje" => "¡Se ha registrado correctamente!",
        ], JSON_PRETTY_PRINT, JSON_UNESCAPED_UNICODE));
      } else {
        print_r(json_encode([
          "ok" => false,
          "mensaje" => "¡Ocurrió un error al registrarse!",
        ], JSON_PRETTY_PRINT, JSON_UNESCAPED_UNICODE));
      }
    }
  }

}




function consultarC($codigo_)
{
  $cliente = new Cliente();
  $model = new CajeroModel();
  $result = $model->consultarCliente($codigo_);

  foreach ($result as $row) {
    $cliente->setcodigoC($row["codigo_cliente"]);
    $cliente->setnombre($row["nombre_cliente"]);
    $cliente->setcorreo($row["correo_cliente"]);
    $cliente->setdui($row["DUI_cliente"]);
    $cliente->settelefono($row["telefono_cliente"]);
    $cliente->setdireccion($row["domicilio_cliente"]);
    $cliente->setfechanacimiento($row["fechaNacimiento_cliente"]);
    $cliente->setsueldo($row["sueldoCliente"]);
    $cliente->setusuario($row["usuario"]);
    $cliente->setcodigosesion($row["codigo_sesion"]);
  }

  //convertiendo el objeto $empleado en una cadena
  $cliente = serialize($cliente);
  //codificando en URL el objeto con urlencode() para poder agregarlo a la URL
  $cliente = urlencode($cliente);
  //redireccionando
  header('Location:../views/cajero/consultarC.php?cliente=' . $cliente);
  //finalizando el script actual
  exit();
}




function registrard()
{

  $am = new Auth();
  $hlp = new Helper();

  $nombre = isset($_POST['nombre']) ? $hlp->limpiarParametro($_POST['nombre']) : false;
  $dui = isset($_POST['dui']) ? $hlp->limpiarParametro($_POST['dui']) : false;
  $correo = isset($_POST['correo']) ? $hlp->limpiarParametro($_POST['correo']) : false;
  $tel = isset($_POST['tel']) ? $hlp->limpiarParametro($_POST['tel']) : false;
  $domicilio = isset($_POST['domicilio']) ? $hlp->limpiarParametro($_POST['domicilio']) : false;
  $tipoNegocio = isset($_POST['negocio']) ? $hlp->limpiarParametro($_POST['negocio']) : false;
  $usuario = isset($_POST['usuario']) ? $hlp->limpiarParametro($_POST['usuario']) : false;
  $contrasenia = isset($_POST['contrasenia']) ? $hlp->limpiarParametro($_POST['contrasenia']) : false;

  if (!$nombre || !$dui || !$correo || !$tel || !$domicilio || !$tipoNegocio || !$usuario || !$contrasenia) {
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
    $cliente = $am->obtenerClientePorUsuarioCorreoDuiTel($usuario, $correo, $dui, $tel);
    if (count($cliente) > 0) {
      print_r(json_encode([
        "ok" => false,
        "mensaje" => "¡Un dato ingresado ya se ha registrado!",
      ], JSON_PRETTY_PRINT, JSON_UNESCAPED_UNICODE));
    } else {
      $con = new Conexion();
      $queryS = "INSERT INTO sesiones (usuario, pass) VALUES ('" . $usuario . "', aes_encrypt('" . $contrasenia . "', 'hunter2'))";
      $stmt = $con->conectar()->prepare($queryS);
      $ejec = $stmt->execute();
      $con->desconectar();
      // $sesion = $am->registrarSesion2($usuario, $contrasenia);
      if ($ejec) {
        $cod_sesion = $am->obtenerUltimoCodSesion();
        $registro = $am->registrarDependiente($nombre, $dui, $correo, $tel, $domicilio, $tipoNegocio, $cod_sesion["codigo_sesion"]);
        $hlp->enviarCorreo2($correo, $usuario, $_POST['contrasenia']);
      }
      if ($registro) {
        print_r(json_encode([
          "ok" => true,
          "mensaje" => "¡Se ha registrado correctamente!",
        ], JSON_PRETTY_PRINT, JSON_UNESCAPED_UNICODE));
      } else {
        print_r(json_encode([
          "ok" => false,
          "mensaje" => "¡Ocurrió un error al registrarse!",
        ], JSON_PRETTY_PRINT, JSON_UNESCAPED_UNICODE));
      }
    }
  }

}



function consultarD($codigo_)
{

  $dependiente = new Dependiente();
  $model = new CajeroModel();
  $result = $model->consultarDependiente($codigo_);

  foreach ($result as $row) {
    $dependiente->setcodigoD($row["codigo_dependiente"]);
    $dependiente->setnombre($row["nombre_dependiente"]);
    $dependiente->setcorreo($row["correo_dependiente"]);
    $dependiente->setdui($row["DUI_dependiente"]);
    $dependiente->settelefono($row["telefono_dependiente"]);
    $dependiente->setdireccion($row["direccionNegocio"]);
    $dependiente->settipoNegocio($row["tipoNegocio"]);
    $dependiente->setusuario($row["usuario"]);
    $dependiente->setcodigosesion($row["codigo_sesion"]);
  }
  //convertiendo el objeto $empleado en una cadena
  $dependiente = serialize($dependiente);
  //codificando en URL el objeto con urlencode() para poder agregarlo a la URL
  $dependiente = urlencode($dependiente);
  //redireccionando
  header('Location:../views/cajero/consultarD.php?dependiente=' . $dependiente);
  //finalizando el script actual
  exit();
}

function vercuentasIngreso()
{

  $lstError = array();
  $dui = $_POST['dui'];
  $regexDUI = "/^[0-9]{8}-[0-9]{1}$/";


  if (!preg_match($regexDUI, $dui)) {
    array_push($lstError, "Ingrese DUI valido.");
  }

  if (count($lstError) > 0) {

    //convertiendo la matriz $lstError en una cadena
    $lstError = serialize($lstError);
    //codificando en URL la matriz con urlencode() para poder agregarla a la URL
    $lstError = urlencode($lstError);
    //redireccionando
    header('Location:../views/cajero/cuentasIngreso.php?lstError=' . $lstError);
    //finalizando el script actual
    exit();
  } else {

    $model = new CajeroModel();
    $result = $model->vercuentasIngreso($dui);


    $cliente = $result[0]['nombre_cliente'];


    if (count($result) > 0) {

      $cliente = serialize($cliente);
      $cliente = urlencode($cliente);
      $result = serialize($result);
      $result = urlencode($result);
      //redireccionando
      header('Location:../views/cajero/ingreso.php?datos=' . $result . '&cliente=' . $cliente);
      //finalizando el script actual
      exit();

    } else {
      array_push($lstError, "El cliente no posee cuentas.");
      //convertiendo la matriz $lstError en una cadena
      $lstError = serialize($lstError);
      //codificando en URL la matriz con urlencode() para poder agregarla a la URL
      $lstError = urlencode($lstError);
      //redireccionando
      header('Location:../views/cajero/cuentasIngreso.php?lstError=' . $lstError);
      //finalizando el script actual
      exit();
    }
  }
}



function ingreso()
{
  $lstError = array();
  $montod = $_POST['montor'];
  $numc = $_POST['numc'];
  $saldoc = $_POST['saldoc'];
  $model = new CajeroModel();


  if ($montod < 0.01) {
    array_push($lstError, "Ingrese un monto de dinero valido.");
  }// CE211044

  if (count($lstError) > 0) {

    //convertiendo la matriz $lstError en una cadena
    $lstError = serialize($lstError);
    //codificando en URL la matriz con urlencode() para poder agregarla a la URL
    $lstError = urlencode($lstError);
    //redireccionando
    header('Location:../views/cajero/completarIngreso.php?num=' . $numc . '&saldo=' . $saldoc . '&lstError=' . $lstError);
    //finalizando el script actual
    exit();
  } else {
    //generando codigo de identificacion
    $cadena_base = '0123456789';
    $code = 'MO';
    $limite = strlen($cadena_base) - 1;
    for ($i = 0; $i < 5; $i++) {
      $code .= $cadena_base[rand(0, $limite)];
    }

    $fecha = new DateTime();
    $fecha->setTimezone(new DateTimeZone('America/El_Salvador'));
    $date = $fecha->format("Y-m-d");

    $result = $model->ingreso($montod, $numc);

    if ($result) {

      $tipo = 'Ingreso de dinero';
      $lugar = 'Sucursal';
      $registrado = $model->registrarMovimiento($code, $tipo, $date, $montod, $lugar, $numc);

      if ($registrado) {
        $mensaje = 'si';
        $titulo = 'El ingreso de dinero a la cuenta se realizó exitosamente.';
      } else {
        $mensaje = 'no';
        $titulo = 'Error, no se logró realizar el ingreso de dinero, por favor intente nuevamente.';
      }
    } else {
      $mensaje = 'no';
      $titulo = 'Error, no se logró realizar el ingreso de dinero, por favor intente nuevamente.';
    }

    //redireccion a la pagina donde se muestran los registros
    header('location:../views/cajero/cuentasIngreso.php?msj=' . $mensaje . '&titulo=' . $titulo);

    //finalizacion del proceso
    exit();


  }
}




function verCuentasRetiro()
{

  $lstError = array();
  $dui = $_POST['dui'];
  $regexDUI = "/^[0-9]{8}-[0-9]{1}$/";


  if (!preg_match($regexDUI, $dui)) {
    array_push($lstError, "Ingrese DUI valido.");
  }

  if (count($lstError) > 0) {

    //convertiendo la matriz $lstError en una cadena
    $lstError = serialize($lstError);
    //codificando en URL la matriz con urlencode() para poder agregarla a la URL
    $lstError = urlencode($lstError);
    //redireccionando
    header('Location:../views/cajero/cuentasRetiro.php?lstError=' . $lstError);
    //finalizando el script actual
    exit();
  } else {

    $model = new CajeroModel();
    $result = $model->vercuentasIngreso($dui);


    $cliente = $result[0]['nombre_cliente'];


    if (count($result) > 0) {

      $cliente = serialize($cliente);
      $cliente = urlencode($cliente);
      $result = serialize($result);
      $result = urlencode($result);
      //redireccionando
      header('Location:../views/cajero/retiro.php?datos=' . $result . '&cliente=' . $cliente);
      //finalizando el script actual
      exit();

    } else {
      array_push($lstError, "El cliente no posee cuentas.");
      //convertiendo la matriz $lstError en una cadena
      $lstError = serialize($lstError);
      //codificando en URL la matriz con urlencode() para poder agregarla a la URL
      $lstError = urlencode($lstError);
      //redireccionando
      header('Location:../views/cajero/cuentasRetiro.php?lstError=' . $lstError);
      //finalizando el script actual
      exit();
    }
  }
}



function retiro()
{
  $lstError = array();
  $montor = $_POST['montor'];
  $numc = $_POST['numc'];
  $saldoc = $_POST['saldoc'];


  if ($montor < 0.01) {
    array_push($lstError, "Ingrese un monto de retiro valido.");
  }

  if ($montor > $saldoc) {
    array_push($lstError, "No posee fondos suficientes en la cuenta.");
  }


  if (count($lstError) > 0) {

    //convertiendo la matriz $lstError en una cadena
    $lstError = serialize($lstError);
    //codificando en URL la matriz con urlencode() para poder agregarla a la URL
    $lstError = urlencode($lstError);
    //redireccionando
    header('Location:../views/cajero/completarRetiro.php?num=' . $numc . '&saldo=' . $saldoc . '&lstError=' . $lstError);
    //finalizando el script actual
    exit();
  } else {


    //generando codigo de identificacion
    $cadena_base = '0123456789';
    $code = 'MO';
    $limite = strlen($cadena_base) - 1;
    for ($i = 0; $i < 5; $i++) {
      $code .= $cadena_base[rand(0, $limite)];
    }

    $fecha = new DateTime();
    $fecha->setTimezone(new DateTimeZone('America/El_Salvador'));
    $date = $fecha->format("Y-m-d");

    $model = new CajeroModel();
    $result = $model->retiro($montor, $numc);

    if ($result) {
      $tipo = 'Retiro de dinero';
      $lugar = 'Sucursal';
      $registrado = $model->registrarMovimiento($code, $tipo, $date, $montor, $lugar, $numc);

      if ($registrado) {
        $mensaje = 'si';
        $titulo = 'El retiro se realizó exitosamente.';
      } else {
        $mensaje = 'no';
        $titulo = 'Error, no se logró realizar el retiro, por favor intente nuevamente.';
      }
    } else {
      $mensaje = 'no';
      $titulo = 'Error2, no se logró realizar el retiro, por favor intente nuevamente.';
    }

    //redireccion a la pagina donde se muestran los registros
    header('location:../views/cajero/cuentasRetiro.php?msj=' . $mensaje . '&titulo=' . $titulo);

    //finalizacion del proceso
    exit();



  }
}



function buscarCliente()
{
  $hlp = new Helper();
  $dui = isset($_POST['dui']) ? $hlp->limpiarParametro($_POST['dui']) : false;
  $cliente = new Cliente();
  $model = new CajeroModel();


  if (!$dui) {
    print_r(json_encode([
      "ok" => false,
      "mensaje" => "¡Debe ingresar el DUI",
    ], JSON_PRETTY_PRINT, JSON_UNESCAPED_UNICODE));
  } elseif (!$hlp->validarDui($dui)) {
    print_r(json_encode([
      "ok" => false,
      "mensaje" => "¡El DUI ingresado es inválido!",
    ], JSON_PRETTY_PRINT, JSON_UNESCAPED_UNICODE));
  } else {

    $result = $model->obtenerCliente($dui);

    foreach ($result as $row) {
      $cliente->setcodigoC($row["codigo_cliente"]);
      $cliente->setnombre($row["nombre_cliente"]);
      $cliente->setdui($row["DUI_cliente"]);
      $cliente->setsueldo($row["sueldoCliente"]);
    }

    if ($cliente->getcodigoC() != null || $cliente->getcodigoC() != "") {
      //convertiendo el objeto $empleado en una cadena
      $cliente = serialize($cliente);
      //codificando en URL el objeto con urlencode() para poder agregarlo a la URL
      $cliente = urlencode($cliente);

      print_r(json_encode([
        "ok" => true,
        "mensaje" => "$cliente",
      ], JSON_PRETTY_PRINT, JSON_UNESCAPED_UNICODE));
    } else {
      print_r(json_encode([
        "ok" => false,
        "mensaje" => "¡El cliente aun no ha sido registrado!",
      ], JSON_PRETTY_PRINT, JSON_UNESCAPED_UNICODE));
    }


  }

}// CE211044


function registrarP()
{
  $hlp = new Helper();
  $id = isset($_POST['id']) ? $hlp->limpiarParametro($_POST['id']) : false;
  $monto = isset($_POST['monto']) ? $hlp->limpiarParametro($_POST['monto']) : false;
  $cuota = isset($_POST['cuota']) ? $hlp->limpiarParametro($_POST['cuota']) : false;
  $sueldo = isset($_POST['sueldo']) ? $hlp->limpiarParametro($_POST['sueldo']) : false;

  if (!$id || !$monto || !$cuota) {
    print_r(json_encode([
      "ok" => false,
      "mensaje" => "¡Debe completar correctamente todos los datos!",
    ], JSON_PRETTY_PRINT, JSON_UNESCAPED_UNICODE));
  } elseif (!$hlp->validarDecimal($monto)) {
    print_r(json_encode([
      "ok" => false,
      "mensaje" => "¡El monto de prestamo ingresado es inválido!",
    ], JSON_PRETTY_PRINT, JSON_UNESCAPED_UNICODE));
  } elseif (!$hlp->validarDecimal($cuota)) {
    print_r(json_encode([
      "ok" => false,
      "mensaje" => "¡El monto de cuota ingresado es inválido!",
    ], JSON_PRETTY_PRINT, JSON_UNESCAPED_UNICODE));
  } else {
    $estado = "En espera";
    $fecha = new DateTime();
    $fecha->setTimezone(new DateTimeZone('America/El_Salvador'));
    $date = $fecha->format("Y-m-d");
    $interes = 0;

    switch ($sueldo) {
      case $sueldo < 365:
        if ($monto > 10000) {
          print_r(json_encode([
            "ok" => false,
            "mensaje" => "¡No puede solicitar un prestamo mayor a $10,000!",
          ], JSON_PRETTY_PRINT, JSON_UNESCAPED_UNICODE));
        } else {
          $interes = 3;
        }
        break;
      case $sueldo < 600:
        if ($monto > 25000) {
          print_r(json_encode([
            "ok" => false,
            "mensaje" => "¡No puede solicitar un prestamo mayor a $25,000!",
          ], JSON_PRETTY_PRINT, JSON_UNESCAPED_UNICODE));
        } else {
          $interes = 3;
        }
        break;
      case $sueldo < 900:
        if ($monto > 35000) {
          print_r(json_encode([
            "ok" => false,
            "mensaje" => "¡No puede solicitar un prestamo mayor a $35,000!",
          ], JSON_PRETTY_PRINT, JSON_UNESCAPED_UNICODE));
        } else {
          $interes = 4;
        }
        break;
      case $sueldo > 1000:
        if ($monto > 50000) {
          print_r(json_encode([
            "ok" => false,
            "mensaje" => "¡No puede solicitar un prestamo mayor a $50,000!",
          ], JSON_PRETTY_PRINT, JSON_UNESCAPED_UNICODE));
        } else {
          $interes = 5;
        }
        break;
    }

    $porcentajeSueldo = $sueldo * 0.3;

    if ($cuota > $porcentajeSueldo) {
      print_r(json_encode([
        "ok" => false,
        "mensaje" => "¡La cuota mensual a pagar no debe superar el 30% del salario!",
      ], JSON_PRETTY_PRINT, JSON_UNESCAPED_UNICODE));
    } else {

      //Calculando la cantidad de años en la que se pagara el total del préstamo.
      $cantYears = 0;
      $i = ($interes / 100) / 12;
      $a = $i * $monto;
      $b = $a / $cuota;
      $c = 1 - $b;
      $cantYears = -(log(abs($c))) / (log(1 + $i));
      $cantYears = $cantYears / 12;
      $cantYears = round($cantYears);

      $model = new CajeroModel();
      $estado = 'En espera';
      $registrado = false;
      $registrado = $model->registrarPrestamo($estado, $date, $monto, $interes, $cuota, $cantYears, $id);

      if ($registrado) {
        print_r(json_encode([
          "ok" => true,
          "mensaje" => "¡El préstamo se aperturó exitosamente!",
        ], JSON_PRETTY_PRINT, JSON_UNESCAPED_UNICODE));
      } else {
        print_r(json_encode([
          "ok" => false,
          "mensaje" => "¡No fue posible aperturar el préstamo!",
        ], JSON_PRETTY_PRINT, JSON_UNESCAPED_UNICODE));
      }
    }

  }
}




function consultarPrestamo($codigo_)
{

  $prestamo = new Prestamo();
  $model = new CajeroModel();
  $result = $model->consultarPrestamo($codigo_);


  foreach ($result as $row) {
    $prestamo->setnumPrestamo($row["numPrestamo"]);
    $prestamo->setestadoprestamo($row["estado_prestamo"]);
    $prestamo->setfechaApertura($row["fechaApertura"]);
    $prestamo->setmontoprestamo($row["monto_prestamo"]);
    $prestamo->setporcentajeInteres($row["porcentajeInteres"]);
    $prestamo->setcuotaMensual($row["cuotaMensual"]);
    $prestamo->setcantYearAPagar($row["cantYearAPagar"]);
    $prestamo->setnombreCliente($row["nombre_cliente"]);

  }

  //convertiendo el objeto $empleado en una cadena
  $prestamo = serialize($prestamo);
  //codificando en URL el objeto con urlencode() para poder agregarlo a la URL
  $prestamo = urlencode($prestamo);
  //redireccionando
  header('Location:../views/cajero/consultarPrestamo.php?prestamo=' . $prestamo);
  //finalizando el script actual
  exit();
}



function registrarTr()
{
  $hlp = new Helper();
  $model = new CajeroModel();

  $numcOrigen = isset($_POST['numcOrigen']) ? $hlp->limpiarParametro($_POST['numcOrigen']) : false;
  $numcDestino = isset($_POST['numcDestino']) ? $hlp->limpiarParametro($_POST['numcDestino']) : false;
  $monto = isset($_POST['monto']) ? $hlp->limpiarParametro($_POST['monto']) : false;
  $Concepto = isset($_POST['Concepto']) ? $hlp->limpiarParametro($_POST['Concepto']) : false;


  if (!$numcOrigen || !$numcDestino || !$monto || !$Concepto) {
    print_r(json_encode([
      "ok" => false,
      "mensaje" => "¡Debe ingresar todos los datos!",
    ], JSON_PRETTY_PRINT, JSON_UNESCAPED_UNICODE));
  } elseif (!$hlp->validarSaldo($monto)) {
    print_r(json_encode([
      "ok" => false,
      "mensaje" => "¡El monto ingresado es inválido!",
    ], JSON_PRETTY_PRINT, JSON_UNESCAPED_UNICODE));
  } elseif ($numcOrigen == $numcDestino) {
    print_r(json_encode([
      "ok" => false,
      "mensaje" => "¡Los números de cuenta no pueden ser los mismos!",
    ], JSON_PRETTY_PRINT, JSON_UNESCAPED_UNICODE));
  } else {
    $existenciaO = $model->validarExietenciaDeCuenta($numcOrigen);
    $existenciaD = $model->validarExietenciaDeCuenta($numcDestino);
    if (!$existenciaO) {
      print_r(json_encode([
        "ok" => false,
        "mensaje" => "¡La cuenta de origen aun no ha sido creada en el banco!",
      ], JSON_PRETTY_PRINT, JSON_UNESCAPED_UNICODE));
    } elseif (!$existenciaD) {
      print_r(json_encode([
        "ok" => false,
        "mensaje" => "¡La cuenta de destino aun no ha sido creada en el banco!",
      ], JSON_PRETTY_PRINT, JSON_UNESCAPED_UNICODE));
    } else {
      //generando codigo de identificacion
      $cadena_base = '0123456789';
      $code = 'TF';
      $limite = strlen($cadena_base) - 1;
      for ($i = 0; $i < 5; $i++) {
        $code .= $cadena_base[rand(0, $limite)];
      }

      $fecha = new DateTime();
      $fecha->setTimezone(new DateTimeZone('America/El_Salvador'));
      $date = $fecha->format("Y-m-d");

      $result = $model->registrarTransferencia($code, $date, $monto, $numcDestino, $Concepto, $numcOrigen);

      if ($result) {
        print_r(json_encode([
          "ok" => true,
          "mensaje" => "¡La transferencia se realizó exitosamente!",
        ], JSON_PRETTY_PRINT, JSON_UNESCAPED_UNICODE));
      } else {
        print_r(json_encode([
          "ok" => false,
          "mensaje" => "¡No se pudo realizar la transferencia!",
        ], JSON_PRETTY_PRINT, JSON_UNESCAPED_UNICODE));
      }
    }
  }
}

// CE211044
?>
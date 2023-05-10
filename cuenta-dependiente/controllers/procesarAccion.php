<?php
header('Content-Type: text/html; charset=ISO-8859-1');

if ($_GET) {
  $op = $_GET['operacion'];
} else if ($_POST) {
  $op = $_POST['operacion'];
}

switch ($op) {
  case 'verCuentasRetiro':
    verCuentasRetiro();
    break;
  case 'retiro':
    retiro();
    break;
  case 'vercuentasIngreso':
    vercuentasIngreso();
    break;
  case 'ingreso':
    ingreso();
    break;
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
    header('Location:../views/cuentasRetiro.php?lstError=' . $lstError);
    //finalizando el script actual
    exit();
  } else {

    $url = "http://127.0.0.1:8000/api/cuentas/$dui";
    $client = curl_init($url);
    curl_setopt($client, CURLOPT_RETURNTRANSFER, true);
    $response = curl_exec($client);
    $result = json_decode($response);


    if ($result->cliente != null) {

      $result = serialize($result);

      $result = urlencode($result);
      //redireccionando
      header('Location:../views/retiro.php?datos=' . $result);
      //finalizando el script actual
      exit();

    } else {
      array_push($lstError, "El cliente no posee cuentas.");
      //convertiendo la matriz $lstError en una cadena
      $lstError = serialize($lstError);
      //codificando en URL la matriz con urlencode() para poder agregarla a la URL
      $lstError = urlencode($lstError);
      //redireccionando
      header('Location:../views/CuentasRetiro.php?lstError=' . $lstError);
      //finalizando el script actual
      exit();
    }
  }
}// CE211044






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
    header('Location:../views/completarRetiro.php?num=' . $numc . '&saldo=' . $saldoc . '&lstError=' . $lstError);
    //finalizando el script actual
    exit();
  } else {// CE211044

    $url = "http://127.0.0.1:8000/api/retiro";
    $curl = curl_init($url);
    curl_setopt($curl, CURLOPT_URL, $url);
    curl_setopt($curl, CURLOPT_POST, true);
    curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);

    $headers = array(
      "Accept: application/json",
      "Content-Type: application/json",
    );
    curl_setopt($curl, CURLOPT_HTTPHEADER, $headers);


    $fecha = new DateTime();
    $fecha->setTimezone(new DateTimeZone('America/El_Salvador'));
    $date = $fecha->format("Y-m-d");

    $data = <<<DATA
    {
    "monto": "$montor",
    "cuenta": "$numc",
    "fecha": "$date"
    }
    DATA;

    curl_setopt($curl, CURLOPT_POSTFIELDS, $data);
    $resp = curl_exec($curl);
    curl_close($curl);
    $result = json_decode($resp);
    if ($result->msg == "Exito") {
      $mensaje = 'si';
      $titulo = 'El retiro se realizó exitosamente.';
    } else {
      $mensaje = 'no';
      $titulo = 'Error, no se logró realizar el retiro, por favor intente nuevamente.';
    }

    //redireccion a la pagina donde se muestran los registros
    header('location:../views/principal.php?msj=' . $mensaje . '&titulo=' . $titulo);

    //finalizacion del proceso
    exit();


  }
}



function vercuentasIngreso()
{

  $lstError = array();
  $dui = $_POST['dui'];
  $regexDUI = "/^[0-9]{8}-[0-9]{1}$/";

// CE211044
  if (!preg_match($regexDUI, $dui)) {
    array_push($lstError, "Ingrese DUI valido.");
  }

  if (count($lstError) > 0) {

    //convertiendo la matriz $lstError en una cadena
    $lstError = serialize($lstError);
    //codificando en URL la matriz con urlencode() para poder agregarla a la URL
    $lstError = urlencode($lstError);
    //redireccionando
    header('Location:../views/cuentasIngreso.php?lstError=' . $lstError);
    //finalizando el script actual
    exit();
  } else {

    $url = "http://127.0.0.1:8000/api/cuentas/$dui";
    $client = curl_init($url);
    curl_setopt($client, CURLOPT_RETURNTRANSFER, true);
    $response = curl_exec($client);
    $result = json_decode($response);


    if ($result->cliente != null) {

      $result = serialize($result);

      $result = urlencode($result);
      //redireccionando
      header('Location:../views/ingreso.php?datos=' . $result);
      //finalizando el script actual
      exit();// CE211044

    } else {
      array_push($lstError, "El cliente no posee cuentas.");
      //convertiendo la matriz $lstError en una cadena
      $lstError = serialize($lstError);
      //codificando en URL la matriz con urlencode() para poder agregarla a la URL
      $lstError = urlencode($lstError);
      //redireccionando
      header('Location:../views/cuentasIngreso.php?lstError=' . $lstError);
      //finalizando el script actual
      exit();
    }
  }
}





function ingreso()
{
  $lstError = array();
  $montor = $_POST['montor'];
  $numc = $_POST['numc'];
  $saldoc = $_POST['saldoc'];


  if ($montor < 0.01) {
    array_push($lstError, "Ingrese un monto de dinero valido.");
  }

  if (count($lstError) > 0) {

    // CE211044
    //convertiendo la matriz $lstError en una cadena
    $lstError = serialize($lstError);
    //codificando en URL la matriz con urlencode() para poder agregarla a la URL
    $lstError = urlencode($lstError);
    //redireccionando
    header('Location:../views/completarIngreso.php?num=' . $numc . '&saldo=' . $saldoc . '&lstError=' . $lstError);
    //finalizando el script actual
    exit();
  } else {

    $url = "http://127.0.0.1:8000/api/ingreso";
    $curl = curl_init($url);
    curl_setopt($curl, CURLOPT_URL, $url);
    curl_setopt($curl, CURLOPT_POST, true);
    curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);

    $headers = array(
      "Accept: application/json",
      "Content-Type: application/json",
    );
    curl_setopt($curl, CURLOPT_HTTPHEADER, $headers);


    $fecha = new DateTime();
    $fecha->setTimezone(new DateTimeZone('America/El_Salvador'));
    $date = $fecha->format("Y-m-d");

    $data = <<<DATA
    {
    "monto": "$montor",
    "cuenta": "$numc",
    "fecha": "$date"
    }
    DATA;

    curl_setopt($curl, CURLOPT_POSTFIELDS, $data);
    $resp = curl_exec($curl);
    curl_close($curl);
    $result = json_decode($resp);
    if ($result->msg == "Exito") {
      $mensaje = 'si';
      $titulo = 'El ingreso de dinero a la cuenta se realizó exitosamente.';
    } else {
      $mensaje = 'no';
      $titulo = 'Error, no se logró realizar el ingreso de dinero, por favor intente nuevamente.';
    }

    //redireccion a la pagina donde se muestran los registros
    header('location:../views/principal.php?msj=' . $mensaje . '&titulo=' . $titulo);

    //finalizacion del proceso
    exit();


  }
}// CE211044
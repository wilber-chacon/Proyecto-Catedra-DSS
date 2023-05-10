<?php
header('Content-Type: text/html; charset=ISO-8859-1');

if ($_GET) {
  $op = $_GET['operacion'];
} else if ($_POST) {
  $op = $_POST['operacion'];
}

switch ($op) {
  case 'ingresar':
    ingresar();
    break;
  case 'salir':
    salir();
    break;
}

function salir()
{
  session_start();
  if (isset($_SESSION['usuario'])) {
    unset($_SESSION['usuarioD']);
    unset($_SESSION['dependiente']);
    header('Location:../views/login.php');
  }
}

function ingresar()
{// CE211044

  session_start();
  $lstError = array();
  $user = $_POST['username'];
  $pass = $_POST['pass'];

  if (empty($user)) {
    array_push($lstError, "Complete el campo de correo.");
  }
  if (empty($user)) {
    array_push($lstError, "Complete el campo de contraseña.");
  }

  if (count($lstError) > 0) {
    //convertiendo la matriz $lstError en una cadena
    $lstError = serialize($lstError);
    //codificando en URL la matriz con urlencode() para poder agregarla a la URL
    $lstError = urlencode($lstError);
    //redireccionando
    header('Location:../views/login.php?lstError=' . $lstError);
    //finalizando el script actual
    exit();

  } else {
    $url = "http://127.0.0.1:8000/api/logueo";
    $curl = curl_init($url);
    curl_setopt($curl, CURLOPT_URL, $url);
    curl_setopt($curl, CURLOPT_POST, true);
    curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);

    $headers = array(
      "Accept: application/json",
      "Content-Type: application/json",
    );
    curl_setopt($curl, CURLOPT_HTTPHEADER, $headers);

    $data = <<<DATA
    {
    "user": "$user",
    "pass": "$pass"
    }
    DATA;

    curl_setopt($curl, CURLOPT_POSTFIELDS, $data);
    $resp = curl_exec($curl);
    curl_close($curl);
    $result = json_decode($resp);

    

    if ($result[0]->nombre_dependiente != null) {
      $_SESSION['usuarioD'] = $result[0]->nombre_dependiente;
      $_SESSION['dependiente'] = true;
      header('Location:../views/principal.php');
    } else {
      array_push($lstError, "Usuario y contraseña incorrectos.");
      //convertiendo la matriz $lstError en una cadena
      $lstError = serialize($lstError);
      //codificando en URL la matriz con urlencode() para poder agregarla a la URL
      $lstError = urlencode($lstError);
      //redireccionando
      header('Location:../views/login.php?lstError=' . $lstError);
      //finalizando el script actual
      exit();
    }
  }
}// CE211044
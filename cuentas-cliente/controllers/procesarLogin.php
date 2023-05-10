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
  case 'salirP':
    salirP();
    break;
}

function salir()
{
  session_start();
  if (isset($_SESSION['usuarioG'])) {
    unset($_SESSION['usuarioG']);
    unset($_SESSION['rol']);
    header('Location:../views/login_admin');
  }
}

function salirP()
{
  session_start();
  if (isset($_SESSION['usuario'])) {
    unset($_SESSION['usuario']);
    header('Location:../views/login');
  }
}

function ingresar()
{
  require("../connection/conexion.class.php");
  //aplicando la interpretacion del español a la conexion de la base de datos
  $con = new Conexion();
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
  // CE211044

  if (count($lstError) > 0) {
    //convertiendo la matriz $lstError en una cadena
    $lstError = serialize($lstError);
    //codificando en URL la matriz con urlencode() para poder agregarla a la URL
    $lstError = urlencode($lstError);
    //redireccionando
    header('Location:../views/login_admin/index.php?lstError=' . $lstError);
    //finalizando el script actual
    exit();
  } else {
    $rol = 0;
    $query = "SELECT e.nombre_empleado, e.codigo_rol
        FROM sesiones as s
        INNER JOIN empleados as e
        ON e.codigo_sesion = s.codigo_sesion
        WHERE aes_decrypt(s.pass, 'hunter2') = '" . $pass . "' AND s.usuario = '" . $user . "' AND e.Estado_empleado='Activo'";

    $stmt = $con->conectar()->prepare($query);
    $stmt->execute();
    $result = $stmt->fetchAll(PDO::FETCH_ASSOC);

    if (count($result) > 0) {

      $_SESSION['usuarioG'] = $result[0]["nombre_empleado"];
      $_SESSION['rol'] = $result[0]["codigo_rol"];
      $rol = $result[0]["codigo_rol"];
      // cambiar la ruta por la de su pagina principal
      switch ($rol) {
        case 1:
          header('Location:../views/cajero/');
          break;
        case 5:
          header('Location:../views/gerente_sucursal/');
          break;
        case 6:
          header('Location:../views/gerente_banco/');
          break;
        default:
          array_push($lstError, "Usuario y contraseña incorrectos.");
          //convertiendo la matriz $lstError en una cadena
          $lstError = serialize($lstError);
          //codificando en URL la matriz con urlencode() para poder agregarla a la URL
          $lstError = urlencode($lstError);
          //redireccionando
          header('Location:../views/login_admin/index.php?lstError=' . $lstError);
          break;
      }
    } else {
      array_push($lstError, "Usuario y contraseña incorrectos.");
      //convertiendo la matriz $lstError en una cadena
      $lstError = serialize($lstError);
      //codificando en URL la matriz con urlencode() para poder agregarla a la URL
      $lstError = urlencode($lstError);
      //redireccionando
      header('Location:../views/login_admin/index.php?lstError=' . $lstError);
      //finalizando el script actual
      exit();
    }
  }
  // CE211044
}
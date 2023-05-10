<?php
// header('Content-Type: text/html; charset=ISO-8859-1');
session_start();
$uri = $_SERVER['REQUEST_URI'];
$uri = explode('/', $uri);
$pagina = str_replace('.php', '', array_slice($uri, -2, 1))[0];

if ($pagina != "prestamista") {
  if (!isset($_SESSION['usuarioG']) && empty($_SESSION['usuarioG'])) {
    header('Location: ../login_admin/');
  }
} elseif ($pagina == "login_admin") {
  if (isset($_SESSION['usuarioG']) && !empty($_SESSION['usuarioG'])) {
    exit();
  }
}
?>

<meta charset="UTF-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<link rel="shortcut icon" href="../components/template/img/logo.png" type="image/x-icon">
<title>Banco de agricultura</title>
<link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet" />
<link rel="stylesheet" href="../components/template/fontawesome/all.min.css" type="text/css" />
<link rel="stylesheet" href="../components/template/styles/style.css">
<link rel="stylesheet" href="../components/template/styles/estilos.css">
<link rel="stylesheet" href="../components/template/bootstrap-4.6.2/css/bootstrap.min.css" type="text/css" />
<link rel="stylesheet" href="../components/template/alertify/css/alertify.core.css" />
<link rel="stylesheet" href="../components/template/alertify/css/alertify.default.css" />
<link rel="stylesheet" href="../components/template/datatable/datatables.min.css">
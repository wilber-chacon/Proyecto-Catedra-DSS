<?php

class Dependiente
{
  private $codigoD;
  private $nombre;
  private $correo;
  private $dui;
  private $telefono;
  private $direccion;
  private $tipoNegocio;
  private $usuario;
  private $pass;
  private $codigosesion;


  public function __construct()
  {
    $this->codigoD = "";
    $this->nombre = "";
    $this->correo = "";
    $this->correo = "";
    $this->dui = "";
    $this->telefono = "";
    $this->direccion = "";
    $this->usuario = "";
    $this->tipoNegocio = "";
    $this->pass = "";
    $this->codigosesion = "";
  }

  public function getcodigoD()
  {
    return $this->codigoD;
  }
  public function setcodigoD($codigoD_)
  {
    $this->codigoD = $codigoD_;
  }
  public function getnombre()
  {
    return $this->nombre;
  }
  public function setnombre($nombre_)
  {
    $this->nombre = $nombre_;
  }
  public function getcorreo()
  {
    return $this->correo;
  }
  public function setcorreo($correo_)
  {
    $this->correo = $correo_;
  }
  public function getdui()
  {
    return $this->dui;
  }
  public function setdui($dui_)
  {
    $this->dui = $dui_;
  }
  public function gettelefono()
  {
    return $this->telefono;
  }
  public function settelefono($telefono_)
  {
    $this->telefono = $telefono_;
  }
  public function getdireccion()
  {
    return $this->direccion;
  }
  public function setdireccion($direccion_)
  {
    $this->direccion = $direccion_;
  }
  public function gettipoNegocio()
  {
    return $this->tipoNegocio;
  }
  public function settipoNegocio($tipoNegocio_)
  {
    $this->tipoNegocio = $tipoNegocio_;
  }
  public function getusuario()
  {
    return $this->usuario;
  }
  public function setusuario($usuario_)
  {
    $this->usuario = $usuario_;
  }
  public function getpass()
  {
    return $this->pass;
  }
  public function setpass($pass_)
  {
    $this->pass = $pass_;
  }
  public function getcodigosesion()
  {
    return $this->codigosesion;
  }
  public function setcodigosesion($codigosesion_)
  {
    $this->codigosesion = $codigosesion_;
  }
}

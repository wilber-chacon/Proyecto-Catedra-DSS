<?php

class Cliente
{
  private $codigoC;
  private $nombre;
  private $correo;
  private $dui;
  private $telefono;
  private $direccion;
  private $fechanacimiento;
  private $sueldo;
  private $usuario;
  private $pass;
  private $codigosesion;


  public function __construct()
  {
    $this->codigoC = "";
    $this->nombre = "";
    $this->correo = "";
    $this->correo = "";
    $this->dui = "";
    $this->telefono = "";
    $this->direccion = "";
    $this->fechanacimiento = "";
    $this->sueldo = "";
    $this->usuario = "";
    $this->pass = "";
    $this->codigosesion = "";
  }

  public function getcodigoC()
  {
    return $this->codigoC;
  }
  public function setcodigoC($codigoC_)
  {
    $this->codigoC = $codigoC_;
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
  public function getfechanacimiento()
  {
    return $this->fechanacimiento;
  }
  public function setfechanacimiento($fechanacimiento_)
  {
    $this->fechanacimiento = $fechanacimiento_;
  }
  public function getsueldo()
  {
    return $this->sueldo;
  }
  public function setsueldo($sueldo_)
  {
    $this->sueldo = $sueldo_;
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

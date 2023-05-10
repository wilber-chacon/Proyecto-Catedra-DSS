<?php
require_once('../connection/conexion.class.php');
$con = new Conexion();

class CajeroModel
{

    public function consultarCliente($id)
    {
        global $con;
        $result = null;
        $query = "SELECT c.codigo_cliente, c.nombre_cliente, c.DUI_cliente, c.telefono_cliente, c.correo_cliente, c.domicilio_cliente, c.sueldoCliente, c.fechaNacimiento_cliente, s.codigo_sesion, s.usuario 
        FROM cliente as c
        INNER JOIN sesiones as s
        ON c.codigo_sesion = s.codigo_sesion
        WHERE c.codigo_cliente = :n1";

        try {
            $stmt = $con->conectar()->prepare($query);
            $stmt->bindParam(':n1', $id, PDO::PARAM_STR);
            $stmt->execute();
            $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
            $con->desconectar();

        } catch (PDOException $e) {
            $con->desconectar();
            die("Error: " . $e->getMessage());
        }
        return $result;
    }


    public function consultarPrestamo($id)
    {
        global $con;
        $result = null;
        $query = "SELECT p.numPrestamo, p.estado_prestamo, p.fechaApertura, p.monto_prestamo, p.porcentajeInteres, p.cuotaMensual, p.cantYearAPagar, c.nombre_cliente
        FROM prestamos as p
        JOIN cliente as c
        ON c.codigo_cliente = p.codigo_cliente
        WHERE p.numPrestamo = :n1";

        try {
            $stmt = $con->conectar()->prepare($query);
            $stmt->bindParam(':n1', $id, PDO::PARAM_STR);
            $stmt->execute();
            $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
            $con->desconectar();

        } catch (PDOException $e) {
            $con->desconectar();
            die("Error: " . $e->getMessage());
        }
        return $result;
    }


    public function consultarDependiente($id)
    {
        global $con;
        $result = null;
        $query = "SELECT d.codigo_dependiente, d.nombre_dependiente, d.DUI_dependiente, d.telefono_dependiente, d.correo_dependiente, d.direccionNegocio, d.tipoNegocio, s.codigo_sesion, s.usuario 
        FROM dependiente as d
        INNER JOIN sesiones as s
        ON d.codigo_sesion = s.codigo_sesion
        WHERE d.codigo_dependiente = :n1";

        try {
            $stmt = $con->conectar()->prepare($query);
            $stmt->bindParam(':n1', $id, PDO::PARAM_STR);
            $stmt->execute();
            $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
            $con->desconectar();

        } catch (PDOException $e) {
            $con->desconectar();
            die("Error: " . $e->getMessage());
        }
        return $result;
    }


    public function vercuentasIngreso($dui)
    {
        global $con;
        $result = null;
        $query = "SELECT c.numCuenta, c.tipoCuenta, c.saldoCuenta, cl.nombre_cliente 
        FROM Cuentabancaria as c
        JOIN Cliente as cl
        ON c.codigo_cliente = cl.codigo_cliente WHERE cl.DUI_cliente = :n1";

        try {
            $stmt = $con->conectar()->prepare($query);
            $stmt->bindParam(':n1', $dui, PDO::PARAM_STR);
            $stmt->execute();
            $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
            $con->desconectar();

        } catch (PDOException $e) {
            $con->desconectar();
            die("Error: " . $e->getMessage());
        }
        return $result;
    }




    public function validarCliente($dui)
    {
        global $con;
        $result = null;
        $registrado = false;
        $sql = "SELECT COUNT(*) as num FROM cliente WHERE DUI_cliente = :n1";
        try {
            $stmt = $con->conectar()->prepare($sql);
            $stmt->bindParam(':n1', $dui, PDO::PARAM_STR);
            $stmt->execute();
            $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
            $con->desconectar();
            if ($result[0]['num'] > 0) {
                $registrado = true;
            }

        } catch (PDOException $e) {
            $con->desconectar();
            die("Error: " . $e->getMessage());
        }
        return $registrado;
    }

    public function obtenerContadorCuentasPorCliente($dui)
    {
        global $con;
        $cantidad = 0;
        $sql = "SELECT COUNT(a.codigo_cliente) contador FROM cuentabancaria a JOIN cliente as c ON c.codigo_cliente = a.codigo_cliente WHERE c.DUI_cliente = :n1";
        try {
            $stmt = $con->conectar()->prepare($sql);
            $stmt->bindParam(':n1', $dui, PDO::PARAM_STR);
            $stmt->execute();
            $cantidad = $stmt->fetch(PDO::FETCH_ASSOC);
            $con->desconectar();
        } catch (PDOException $e) {
            $con->desconectar();
            die("Error: " . $e->getMessage());
        }
        return $cantidad["contador"];
    }


    public function obtenerCodigoCliente($dui)
    {
        global $con;
        $result = null;

        $sql = "SELECT codigo_cliente FROM cliente WHERE DUI_cliente = :n1";
        try {
            $stmt = $con->conectar()->prepare($sql);
            $stmt->bindParam(':n1', $dui, PDO::PARAM_STR);
            $stmt->execute();
            $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
            $con->desconectar();

        } catch (PDOException $e) {
            $con->desconectar();
            die("Error: " . $e->getMessage());
        }
        return $result[0]['codigo_cliente'];
    }// CE211044

    public function registrarCuentaBancaria($tipo_cuenta, $saldo, $dui)
    {
        global $con;
        $registrada = false;
        $num_cuenta = rand(100000, 999999);
        $cod_cliente = $this->obtenerCodigoCliente($dui);
        $sql = "INSERT INTO cuentabancaria VALUES (:n1, NOW(), :n2, :n3, 'En sucursal', :n4);";
        try {
            $stmt = $con->conectar()->prepare($sql);
            $stmt->bindParam(':n1', $num_cuenta, PDO::PARAM_STR);
            $stmt->bindParam(':n2', $tipo_cuenta, PDO::PARAM_STR);
            $stmt->bindParam(':n3', $saldo, PDO::PARAM_STR);
            $stmt->bindParam(':n4', $cod_cliente, PDO::PARAM_STR);
            $registrada = $stmt->execute();
            $con->desconectar();
        } catch (PDOException $e) {
            $con->desconectar();
            die("Error: " . $e->getMessage());
        }
        return $registrada;
    }// CE211044

    public function ingreso($montod, $numc)
    {
        global $con;
        $result = false;
        $sql = "UPDATE cuentabancaria SET saldoCuenta = saldoCuenta + :n1 WHERE numCuenta = :n2";
        try {
            $stmt = $con->conectar()->prepare($sql);
            $stmt->bindParam(':n1', $montod, PDO::PARAM_STR);
            $stmt->bindParam(':n2', $numc, PDO::PARAM_STR);
            $result = $stmt->execute();
            $con->desconectar();
        } catch (PDOException $e) {
            $con->desconectar();
            die("Error: " . $e->getMessage());
        }
        return $result;
    }


    public function registrarMovimiento($code, $tipo, $date, $montod, $lugar, $numc)
    {
        global $con;
        $registrado = false;
        $sql = "INSERT INTO movimientos VALUES (:n1, :n2, :n3, :n4, :n5, :n6);";
        try {
            $stmt = $con->conectar()->prepare($sql);
            $stmt->bindParam(':n1', $code, PDO::PARAM_STR);
            $stmt->bindParam(':n2', $tipo, PDO::PARAM_STR);
            $stmt->bindParam(':n3', $date, PDO::PARAM_STR);
            $stmt->bindParam(':n4', $montod, PDO::PARAM_STR);
            $stmt->bindParam(':n5', $lugar, PDO::PARAM_STR);
            $stmt->bindParam(':n6', $numc, PDO::PARAM_STR);
            $registrado = $stmt->execute();
            $con->desconectar();
        } catch (PDOException $e) {
            $con->desconectar();
            die("Error: " . $e->getMessage());
        }
        return $registrado;
    }
// CE211044

    public function retiro($montor, $numc)
    {
        global $con;
        $result = false;
        $sql = "UPDATE cuentabancaria SET saldoCuenta = saldoCuenta - :n1 WHERE numCuenta = :n2";
        try {
            $stmt = $con->conectar()->prepare($sql);
            $stmt->bindParam(':n1', $montor, PDO::PARAM_STR);
            $stmt->bindParam(':n2', $numc, PDO::PARAM_STR);
            $result = $stmt->execute();
            $con->desconectar();
        } catch (PDOException $e) {
            $con->desconectar();
            die("Error: " . $e->getMessage());
        }
        return $result;
    }


    public function obtenerCliente($dui)
    {
        global $con;
        $result = null;

        $sql = "SELECT c.codigo_cliente, c.nombre_cliente, c.DUI_cliente, c.sueldoCliente FROM cliente as c WHERE c.DUI_cliente = :n1";
        try {
            $stmt = $con->conectar()->prepare($sql);
            $stmt->bindParam(':n1', $dui, PDO::PARAM_STR);
            $stmt->execute();
            $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
            $con->desconectar();

        } catch (PDOException $e) {
            $con->desconectar();
            die("Error: " . $e->getMessage());
        }
        return $result;
    }


    public function registrarPrestamo($estado, $fecha, $monto, $interes, $cuota, $cantYears, $idCliente)
    {
        global $con;
        $registrado = false;
        $sql = "INSERT INTO prestamos VALUES (NULL, :n1, :n2, :n3, :n4, :n5, :n6, :n7)";
        try {
            $stmt = $con->conectar()->prepare($sql);
            $stmt->bindParam(':n1', $estado, PDO::PARAM_STR);
            $stmt->bindParam(':n2', $fecha, PDO::PARAM_STR);
            $stmt->bindParam(':n3', $monto, PDO::PARAM_STR);
            $stmt->bindParam(':n4', $interes, PDO::PARAM_STR);
            $stmt->bindParam(':n5', $cuota, PDO::PARAM_STR);
            $stmt->bindParam(':n6', $cantYears, PDO::PARAM_STR);
            $stmt->bindParam(':n7', $idCliente, PDO::PARAM_STR);
            $registrado = $stmt->execute();
            $con->desconectar();
        } catch (PDOException $e) {
            $con->desconectar();
            die("Error: " . $e->getMessage());
        }
        return $registrado;
    }


    public function validarExietenciaDeCuenta($num)
    {
        global $con;
        $result = null;
        $existencia = false;
        $sql = "SELECT COUNT(*) as num FROM cuentabancaria WHERE numCuenta = :n1";
        try {
            $stmt = $con->conectar()->prepare($sql);
            $stmt->bindParam(':n1', $num, PDO::PARAM_STR);
            $stmt->execute();
            $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
            $con->desconectar();
            if ($result[0]['num'] > 0) {
                $existencia = true;
            }

        } catch (PDOException $e) {
            $con->desconectar();
            die("Error: " . $e->getMessage());
        }
        return $existencia;
    }


    public function registrarTransferencia($code, $date, $monto, $cuentaD, $concepto, $cuentaO)
    {
        global $con;
        $registrado = false;
        $sql = "INSERT INTO transferencias VALUES (:n1, :n2, :n3, :n4, :n5, :n6);";

        if ($this->retiro($monto, $cuentaO) && $this->ingreso($monto, $cuentaD)) {

            try {
                $stmt = $con->conectar()->prepare($sql);
                $stmt->bindParam(':n1', $code, PDO::PARAM_STR);
                $stmt->bindParam(':n2', $date, PDO::PARAM_STR);
                $stmt->bindParam(':n3', $monto, PDO::PARAM_STR);
                $stmt->bindParam(':n4', $cuentaD, PDO::PARAM_STR);
                $stmt->bindParam(':n5', $concepto, PDO::PARAM_STR);
                $stmt->bindParam(':n6', $cuentaO, PDO::PARAM_STR);
                $registrado = $stmt->execute();
                $con->desconectar();
            } catch (PDOException $e) {
                $con->desconectar();
                die("Error: " . $e->getMessage());
            }
        }
        return $registrado;
    }

}// CE211044

?>
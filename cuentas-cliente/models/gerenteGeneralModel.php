<?php
require_once('../connection/conexion.class.php');
$con = new Conexion();

class GerenteGeneralModel
{

    public function consultarEmpleado($id)
    {
        global $con;
        $result = null;
        $query = "SELECT e.codigo_empleado, e.nombre_empleado, e.DUI_empleado, e.telefono_empleado, e.Estado_empleado, e.domicilio_empleado, e.acciones, e.fechaNacimiento_empleado, r.codigo_rol, r.nombre_rol, s.codigo_sesion, s.usuario, aes_decrypt(s.pass, 'hunter2') AS pass, su.codigo_sucursal, su.nombre_sucursal 
        FROM empleados as e
        INNER JOIN sesiones as s
        ON e.codigo_sesion = s.codigo_sesion
        INNER JOIN roles as r
        ON e.codigo_rol = r.codigo_rol
        INNER JOIN sucursal as su
        ON e.codigo_sucursal = su.codigo_sucursal WHERE e.codigo_empleado = :n1";

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


    public function consultarSucursal($id)
    {
        global $con;
        $result = null;
        $query = "SELECT s.codigo_sucursal, s.nombre_sucursal, s.direccion_sucursal, e.nombre_empleado 
        FROM sucursal AS s
        JOIN empleados AS e
        ON e.codigo_sucursal = s.codigo_sucursal
        WHERE s.codigo_sucursal = :n1 AND e.codigo_rol = 5";

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
// CE211044

    public function actualizarEstado($id, $estado)
    {
        global $con;
        $result = false;
        $sql = "UPDATE empleados SET Estado_empleado = :n1 WHERE codigo_empleado = :n2";
        try {
            $stmt = $con->conectar()->prepare($sql);
            $stmt->bindParam(':n1', $estado, PDO::PARAM_STR);
            $stmt->bindParam(':n2', $id, PDO::PARAM_STR);
            $result = $stmt->execute();
            $con->desconectar();
        } catch (PDOException $e) {
            $con->desconectar();
            die("Error: " . $e->getMessage());
        }
        return $result;
    }


    public function validarEmpleadoSucursal($nombre)
    {
        global $con;
        $result = null;
        $existencia = false;
        $query = "SELECT COUNT(*) AS num
        FROM sucursal AS s
        JOIN empleados AS e
        ON e.codigo_sucursal = s.codigo_sucursal
        WHERE s.nombre_sucursal = :n1 AND e.Estado_empleado = 'Activo'";

        try {
            $stmt = $con->conectar()->prepare($query);
            $stmt->bindParam(':n1', $nombre, PDO::PARAM_STR);
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


    public function registrarGerenteS($nombre, $dui, $correo, $tel, $estado, $domicilio, $acciones, $fechaN, $codRol, $cod_sesion, $codSuc)
    {
        global $con;
        $registrado = false;
        $sql = "INSERT INTO empleados VALUES (NULL, :n1, :n2, :n3, :n4, :n5, :n6, :n7, :n8, :n9, :a1, :a2);";
        try {
            $stmt = $con->conectar()->prepare($sql);
            $stmt->bindParam(':n1', $nombre, PDO::PARAM_STR);
            $stmt->bindParam(':n2', $dui, PDO::PARAM_STR);
            $stmt->bindParam(':n3', $correo, PDO::PARAM_STR);
            $stmt->bindParam(':n4', $tel, PDO::PARAM_STR);
            $stmt->bindParam(':n5', $estado, PDO::PARAM_STR);
            $stmt->bindParam(':n6', $domicilio, PDO::PARAM_STR);
            $stmt->bindParam(':n7', $acciones, PDO::PARAM_STR);
            $stmt->bindParam(':n8', $fechaN, PDO::PARAM_STR);
            $stmt->bindParam(':n9', $codRol, PDO::PARAM_STR);
            $stmt->bindParam(':a1', $cod_sesion, PDO::PARAM_STR);
            $stmt->bindParam(':a2', $codSuc, PDO::PARAM_STR);
            $registrado = $stmt->execute();
            $con->desconectar();
        } catch (PDOException $e) {
            $con->desconectar();
            die("Error: " . $e->getMessage());
        }
        return $registrado;
    }

// CE211044
    public function registrarSucursal($nombre, $direccion)
    {
        global $con;
        $registrado = false;
        $sql = "INSERT INTO sucursal VALUES (NULL, :n1, :n2);";
        try {
            $stmt = $con->conectar()->prepare($sql);
            $stmt->bindParam(':n1', $nombre, PDO::PARAM_STR);
            $stmt->bindParam(':n2', $direccion, PDO::PARAM_STR);
            $registrado = $stmt->execute();
            $con->desconectar();
        } catch (PDOException $e) {
            $con->desconectar();
            die("Error: " . $e->getMessage());
        }
        return $registrado;
    }


    public function registrarSesion($user, $pass)
    {
        global $con;
        $registrado = false;
        $queryS = "INSERT INTO sesiones (usuario, pass) VALUES ('" . $user . "', aes_encrypt('" . $pass . "', 'hunter2'))";
        try {

            $stmt = $con->conectar()->prepare($queryS);
            $registrado = $stmt->execute();
            $con->desconectar();

        } catch (PDOException $e) {
            $con->desconectar();
            die("Error: " . $e->getMessage());
        }
        return $registrado;
    }

}
// CE211044
?>
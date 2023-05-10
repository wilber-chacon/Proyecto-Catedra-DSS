-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1:3306
-- Tiempo de generación: 07-05-2023 a las 22:13:51
-- Versión del servidor: 5.7.36
-- Versión de PHP: 7.4.26

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `banco_agricultura`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `cliente`
--

DROP TABLE IF EXISTS `cliente`;
CREATE TABLE IF NOT EXISTS `cliente` (
  `codigo_cliente` int(11) NOT NULL AUTO_INCREMENT,
  `nombre_cliente` varchar(200) NOT NULL,
  `DUI_cliente` varchar(10) NOT NULL,
  `correo_cliente` varchar(100) DEFAULT NULL,
  `telefono_cliente` varchar(9) DEFAULT NULL,
  `domicilio_cliente` text NOT NULL,
  `fechaNacimiento_cliente` date NOT NULL,
  `sueldoCliente` double(6,2) NOT NULL,
  `codigo_sesion` int(11) NOT NULL,
  PRIMARY KEY (`codigo_cliente`),
  KEY `sesionfk_3` (`codigo_sesion`)
) ENGINE=InnoDB AUTO_INCREMENT=14 DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `cliente`
--

INSERT INTO `cliente` (`codigo_cliente`, `nombre_cliente`, `DUI_cliente`, `correo_cliente`, `telefono_cliente`, `domicilio_cliente`, `fechaNacimiento_cliente`, `sueldoCliente`, `codigo_sesion`) VALUES
(11, 'Davis Merlos', '06523406-5', 'davis15merlos@gmail.com', '7956-9665', 'San Salvador', '2002-07-25', 365.00, 10),
(12, 'Roberto Vásquez', '06231336-2', 'desarrollo@acaces.com.sv', '7953-5632', 'San Marcos', '1992-09-09', 600.00, 11),
(13, 'Elena Landaverde', '06532565-6', 'marialandaverde1993@gmail.com', '7956-6262', 'Apopa', '1993-12-26', 966.00, 12);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `cuentabancaria`
--

DROP TABLE IF EXISTS `cuentabancaria`;
CREATE TABLE IF NOT EXISTS `cuentabancaria` (
  `numCuenta` varchar(12) NOT NULL,
  `fechaCreacion` date NOT NULL,
  `tipoCuenta` varchar(200) NOT NULL,
  `saldoCuenta` double(6,2) NOT NULL,
  `lugarCreacion` varchar(100) NOT NULL,
  `codigo_cliente` int(11) NOT NULL,
  PRIMARY KEY (`numCuenta`),
  KEY `clientefk_2` (`codigo_cliente`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `cuentabancaria`
--

INSERT INTO `cuentabancaria` (`numCuenta`, `fechaCreacion`, `tipoCuenta`, `saldoCuenta`, `lugarCreacion`, `codigo_cliente`) VALUES
('104535', '2023-04-17', 'Corriente', 56.43, 'En linea', 11),
('688431', '2023-04-17', 'Ahorro', 40.00, 'En linea', 11),
('691816', '2023-05-02', 'Ahorro', 25.00, 'En sucursal', 12),
('824659', '2023-04-17', 'Ahorro', 0.00, 'En linea', 11);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `dependiente`
--

DROP TABLE IF EXISTS `dependiente`;
CREATE TABLE IF NOT EXISTS `dependiente` (
  `codigo_dependiente` int(11) NOT NULL AUTO_INCREMENT,
  `nombre_dependiente` varchar(200) NOT NULL,
  `DUI_dependiente` varchar(10) NOT NULL,
  `correo_dependiente` varchar(100) DEFAULT NULL,
  `telefono_dependiente` varchar(9) DEFAULT NULL,
  `direccionNegocio` text NOT NULL,
  `tipoNegocio` varchar(200) NOT NULL,
  `codigo_sesion` int(11) NOT NULL,
  PRIMARY KEY (`codigo_dependiente`),
  KEY `sesionfk_2` (`codigo_sesion`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `dependiente`
--

INSERT INTO `dependiente` (`codigo_dependiente`, `nombre_dependiente`, `DUI_dependiente`, `correo_dependiente`, `telefono_dependiente`, `direccionNegocio`, `tipoNegocio`, `codigo_sesion`) VALUES
(1, 'Luis Andres Hernandez Flores', '63827346-9', 'luis.hernandez@gmail.com', '4735-4365', 'Soyapango', 'Farmacia', 17);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `empleados`
--

DROP TABLE IF EXISTS `empleados`;
CREATE TABLE IF NOT EXISTS `empleados` (
  `codigo_empleado` int(11) NOT NULL AUTO_INCREMENT,
  `nombre_empleado` varchar(200) NOT NULL,
  `DUI_empleado` varchar(10) NOT NULL,
  `correo_empleado` varchar(100) DEFAULT NULL,
  `telefono_empleado` varchar(9) DEFAULT NULL,
  `Estado_empleado` varchar(50) NOT NULL,
  `domicilio_empleado` text NOT NULL,
  `acciones` text NOT NULL,
  `fechaNacimiento_empleado` date NOT NULL,
  `codigo_rol` int(11) NOT NULL,
  `codigo_sesion` int(11) NOT NULL,
  `codigo_sucursal` int(11) DEFAULT NULL,
  PRIMARY KEY (`codigo_empleado`),
  KEY `rolfk_1` (`codigo_rol`),
  KEY `sucursalfk_1` (`codigo_sucursal`),
  KEY `sesionfk_1` (`codigo_sesion`)
) ENGINE=InnoDB AUTO_INCREMENT=16 DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `empleados`
--

INSERT INTO `empleados` (`codigo_empleado`, `nombre_empleado`, `DUI_empleado`, `correo_empleado`, `telefono_empleado`, `Estado_empleado`, `domicilio_empleado`, `acciones`, `fechaNacimiento_empleado`, `codigo_rol`, `codigo_sesion`, `codigo_sucursal`) VALUES
(1, 'Wilber Francisco Chacón Erroa', '12345678-9', 'wilber.franciscochacon@gmail.com', '6543-4352', 'Activo', 'Soyapango', 'Administrar empleados y aprobar o rechazar prestamos', '2002-03-21', 5, 14, 3),
(3, 'Pedro Alvarez', '06532665-9', 'pedro@gmail.com', '7895-5653', 'Activo', 'San Salvador', 'Ingresar nuevos clientes, agregar dependientes del banco, ingresar o retirar dinero y aperturar préstamos', '2000-09-03', 1, 16, 1),
(9, 'Andrés Rene Garcia Lopez', '34212683-9', 'andres.garcia@gmail.com', '7542-7952', 'Activo', 'Soyapango', 'Administrar empleados y aprobar o rechazar prestamos', '1998-01-21', 5, 45, 6),
(10, 'Ana Diaz', '47293753-0', 'ana.diaz@gmail.com', '4513-4352', 'Activo', 'Ilopango', 'Administrar empleados y aprobar o rechazar prestamos', '1996-03-15', 5, 46, 4),
(11, 'Eric Ruiz', '37485329-1', 'eric.ruiz@gmail.com', '2572-7952', 'Activo', 'San Martin', 'Administrar empleados y aprobar o rechazar prestamos', '1999-01-21', 5, 47, 2),
(12, 'Sara Castillo', '72385274-2', 'sara.castillo@gmail.com', '3612-7953', 'Activo', 'San Salvador', 'Administrar empleados y aprobar o rechazar prestamos', '2002-02-21', 5, 48, 1),
(13, 'Ulises Castro', '83956374-5', 'ulises.castro@gmail.com', '3732-4832', 'Activo', 'Santa Tecla', 'Administrar empleados y aprobar o rechazar prestamos', '2002-05-10', 5, 49, 5),
(15, 'Juan Guillermo Juárez', '05451244-5', 'juan.juarez@gmail.com', '9562-5653', 'En espera de aprobación', 'Soyapango', 'Atender a los clientes y brindar acompañamiento', '1999-07-21', 3, 51, 3);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `movimientos`
--

DROP TABLE IF EXISTS `movimientos`;
CREATE TABLE IF NOT EXISTS `movimientos` (
  `numTransaccion` varchar(12) NOT NULL,
  `tipoTransaccion` varchar(200) NOT NULL,
  `fechaTransaccion` date NOT NULL,
  `montoTransaccion` double(6,2) NOT NULL,
  `lugarTransaccion` varchar(200) NOT NULL,
  `numCuenta` varchar(12) NOT NULL,
  PRIMARY KEY (`numTransaccion`),
  KEY `cuentafk_2` (`numCuenta`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `movimientos`
--

INSERT INTO `movimientos` (`numTransaccion`, `tipoTransaccion`, `fechaTransaccion`, `montoTransaccion`, `lugarTransaccion`, `numCuenta`) VALUES
('MO03780', 'Retiro de dinero', '2023-04-22', 10.00, 'En local', '104535'),
('MO06284', 'Retiro de dinero', '2023-05-01', 10.00, 'Sucursal', '688431'),
('MO07789', 'Retiro de dinero', '2023-04-22', 10.00, 'En local', '104535'),
('MO08372', 'Ingreso de dinero', '2023-04-23', 10.00, 'En local', '688431'),
('MO11480', 'Ingreso de dinero', '2023-04-24', 10.00, 'Sucursal', '104535'),
('MO15482', 'Ingreso de dinero', '2023-04-24', 10.00, 'Sucursal', '104535'),
('MO16486', 'Ingreso de dinero', '2023-04-24', 10.00, 'Sucursal', '688431'),
('MO21213', 'Ingreso de dinero', '2023-04-24', 10.00, 'Sucursal', '104535'),
('MO23424', 'Ingreso de dinero', '2023-04-24', 10.00, 'Sucursal', '688431'),
('MO24188', 'Ingreso de dinero', '2023-04-24', 10.00, 'Sucursal', '688431'),
('MO42687', 'Retiro de dinero', '2023-04-22', 10.00, 'En local', '104535'),
('MO60790', 'Ingreso de dinero', '2023-05-01', 10.00, 'Sucursal', '688431'),
('MO65693', 'Ingreso de dinero', '2023-04-23', 10.00, 'En local', '104535'),
('MO94781', 'Ingreso de dinero', '2023-05-02', 15.00, 'Sucursal', '691816');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `prestamos`
--

DROP TABLE IF EXISTS `prestamos`;
CREATE TABLE IF NOT EXISTS `prestamos` (
  `numPrestamo` int(11) NOT NULL AUTO_INCREMENT,
  `estado_prestamo` varchar(50) NOT NULL,
  `fechaApertura` date NOT NULL,
  `monto_prestamo` double(6,2) NOT NULL,
  `porcentajeInteres` int(11) NOT NULL,
  `cuotaMensual` double(6,2) NOT NULL,
  `cantYearAPagar` int(11) NOT NULL,
  `codigo_cliente` int(11) NOT NULL,
  PRIMARY KEY (`numPrestamo`),
  KEY `clientefk_1` (`codigo_cliente`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `prestamos`
--

INSERT INTO `prestamos` (`numPrestamo`, `estado_prestamo`, `fechaApertura`, `monto_prestamo`, `porcentajeInteres`, `cuotaMensual`, `cantYearAPagar`, `codigo_cliente`) VALUES
(1, 'Rechazado', '2023-03-10', 2000.00, 3, 58.16, 3, 11);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `roles`
--

DROP TABLE IF EXISTS `roles`;
CREATE TABLE IF NOT EXISTS `roles` (
  `codigo_rol` int(11) NOT NULL AUTO_INCREMENT,
  `nombre_rol` varchar(100) NOT NULL,
  PRIMARY KEY (`codigo_rol`)
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `roles`
--

INSERT INTO `roles` (`codigo_rol`, `nombre_rol`) VALUES
(1, 'Cajero'),
(2, 'Limpieza'),
(3, 'Recepcionista'),
(4, 'Mesa'),
(5, 'Gerente de sucursal'),
(6, 'Gerente general del banco'),
(7, 'Cliente'),
(8, 'Dependiente del banco');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `sesiones`
--

DROP TABLE IF EXISTS `sesiones`;
CREATE TABLE IF NOT EXISTS `sesiones` (
  `codigo_sesion` int(11) NOT NULL AUTO_INCREMENT,
  `usuario` varchar(100) NOT NULL,
  `pass` text NOT NULL,
  `cod_verificacion` varchar(10) DEFAULT NULL,
  `date_verficacion` datetime DEFAULT NULL,
  PRIMARY KEY (`codigo_sesion`)
) ENGINE=InnoDB AUTO_INCREMENT=52 DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `sesiones`
--

INSERT INTO `sesiones` (`codigo_sesion`, `usuario`, `pass`, `cod_verificacion`, `date_verficacion`) VALUES
(10, 'dmerlos', 'e10adc3949ba59abbe56e057f20f883e', '244013', '2023-03-10 11:13:39'),
(11, 'rvasquez', 'e10adc3949ba59abbe56e057f20f883e', NULL, NULL),
(12, 'elandaverde', 'e10adc3949ba59abbe56e057f20f883e', '102396', '2023-03-10 11:42:23'),
(13, 'mario.hernandez@gmail.com', 'Ãä÷Ù¹¨Oîû|¿AaÛo', NULL, NULL),
(14, 'wilber.franciscochacon@gmail.com', 'Ãä÷Ù¹¨Oîû|¿AaÛo', NULL, NULL),
(16, 'pedro@gmail.com', 'Ãä÷Ù¹¨Oîû|¿AaÛo', NULL, NULL),
(17, 'luis.hernandez@gmail.com', 'Ãä÷Ù¹¨Oîû|¿AaÛo', NULL, '2023-04-21 22:57:09'),
(45, 'andres.garcia@gmail.com', 'Ãä÷Ù¹¨Oîû|¿AaÛo', NULL, '2023-05-03 19:40:30'),
(46, 'ana.diaz@gmail.com', 'Ãä÷Ù¹¨Oîû|¿AaÛo', NULL, '2023-05-03 19:42:21'),
(47, 'eric.ruiz@gmail.com', 'Ãä÷Ù¹¨Oîû|¿AaÛo', NULL, '2023-05-03 19:42:58'),
(48, 'sara.castillo@gmail.com', 'Ãä÷Ù¹¨Oîû|¿AaÛo', NULL, '2023-05-03 19:43:58'),
(49, 'ulises.castro@gmail.com', 'Ãä÷Ù¹¨Oîû|¿AaÛo', NULL, '2023-05-03 19:44:38'),
(51, 'juan.juarez@gmail.com', 'Ãä÷Ù¹¨Oîû|¿AaÛo', NULL, NULL);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `sucursal`
--

DROP TABLE IF EXISTS `sucursal`;
CREATE TABLE IF NOT EXISTS `sucursal` (
  `codigo_sucursal` int(11) NOT NULL AUTO_INCREMENT,
  `nombre_sucursal` varchar(100) NOT NULL,
  `direccion_sucursal` text NOT NULL,
  PRIMARY KEY (`codigo_sucursal`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `sucursal`
--

INSERT INTO `sucursal` (`codigo_sucursal`, `nombre_sucursal`, `direccion_sucursal`) VALUES
(1, 'Agencia plaza futura', 'Edif. Torre Futura y Plaza Futura, Col. Escalón, SS.'),
(2, 'Agencia masferrer', 'Final Paseo General Escalón No. 5148, S. S.'),
(3, 'Agencia galerias', 'Centro Com. Galerías Escalón, 1er. Nivel Local 117 y 118-A.'),
(4, 'Agencia bambu', 'Boulevard El Hipódromo y Avenida Las Magnolias, San Salvador'),
(5, 'Agencia roosevelt san salvador', '43 Avenida Norte y Alameda Franklin Delano Roosevelt No. 2222, San Salvador'),
(6, 'Agencia altavista', 'Ctro. Comercial Unicentro Altavista, Local 6B a 8B, Ilopango');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `transferencias`
--

DROP TABLE IF EXISTS `transferencias`;
CREATE TABLE IF NOT EXISTS `transferencias` (
  `numTransferencia` varchar(12) NOT NULL,
  `fechaTransferencia` date NOT NULL,
  `montoTransferencia` double(6,2) NOT NULL,
  `cuentaDestino` varchar(12) NOT NULL,
  `conceptoTransferencia` text NOT NULL,
  `numCuenta` varchar(12) NOT NULL,
  PRIMARY KEY (`numTransferencia`),
  KEY `cuentafk_1` (`numCuenta`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `transferencias`
--

INSERT INTO `transferencias` (`numTransferencia`, `fechaTransferencia`, `montoTransferencia`, `cuentaDestino`, `conceptoTransferencia`, `numCuenta`) VALUES
('TF73235', '2023-05-02', 10.00, '691816', 'Compra de celular', '688431');

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `cliente`
--
ALTER TABLE `cliente`
  ADD CONSTRAINT `sesionfk_3` FOREIGN KEY (`codigo_sesion`) REFERENCES `sesiones` (`codigo_sesion`);

--
-- Filtros para la tabla `cuentabancaria`
--
ALTER TABLE `cuentabancaria`
  ADD CONSTRAINT `clientefk_2` FOREIGN KEY (`codigo_cliente`) REFERENCES `cliente` (`codigo_cliente`);

--
-- Filtros para la tabla `dependiente`
--
ALTER TABLE `dependiente`
  ADD CONSTRAINT `sesionfk_2` FOREIGN KEY (`codigo_sesion`) REFERENCES `sesiones` (`codigo_sesion`);

--
-- Filtros para la tabla `empleados`
--
ALTER TABLE `empleados`
  ADD CONSTRAINT `rolfk_1` FOREIGN KEY (`codigo_rol`) REFERENCES `roles` (`codigo_rol`),
  ADD CONSTRAINT `sesionfk_1` FOREIGN KEY (`codigo_sesion`) REFERENCES `sesiones` (`codigo_sesion`),
  ADD CONSTRAINT `sucursalfk_1` FOREIGN KEY (`codigo_sucursal`) REFERENCES `sucursal` (`codigo_sucursal`);

--
-- Filtros para la tabla `movimientos`
--
ALTER TABLE `movimientos`
  ADD CONSTRAINT `cuentafk_2` FOREIGN KEY (`numCuenta`) REFERENCES `cuentabancaria` (`numCuenta`);

--
-- Filtros para la tabla `prestamos`
--
ALTER TABLE `prestamos`
  ADD CONSTRAINT `clientefk_1` FOREIGN KEY (`codigo_cliente`) REFERENCES `cliente` (`codigo_cliente`);

--
-- Filtros para la tabla `transferencias`
--
ALTER TABLE `transferencias`
  ADD CONSTRAINT `cuentafk_1` FOREIGN KEY (`numCuenta`) REFERENCES `cuentabancaria` (`numCuenta`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

-- phpMyAdmin SQL Dump
-- version 5.0.1
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 01-03-2021 a las 19:36:42
-- Versión del servidor: 10.4.11-MariaDB
-- Versión de PHP: 7.4.2

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `prueba_tecnica`
--

DELIMITER $$
--
-- Procedimientos
--
CREATE DEFINER=`root`@`localhost` PROCEDURE `CREAR_PRODUCTO` (IN `CODIGO` VARCHAR(50), IN `NOMBRE` VARCHAR(50), IN `DESCRIPCION` VARCHAR(100), IN `MARCA` VARCHAR(50), IN `CATEGORIA` VARCHAR(50), IN `PRECIO` FLOAT)  BEGIN
	INSERT INTO productos (CODIGO,NOMBRE,DESCRIPCION,MARCA,CATEGORIA,PRECIO)
	VALUES (CODIGO,NOMBRE,DESCRIPCION,MARCA,CATEGORIA,PRECIO);
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `SP_ACTUALIZAR_CATEGORIA` (IN `CODIGO` VARCHAR(50), IN `NOMBRE` VARCHAR(50), IN `DESCRIPCION` VARCHAR(50), IN `ACTIVO` VARCHAR(50), IN `P_ID` INT)  BEGIN
	UPDATE categorias_producto SET CODIGO = CODIGO, NOMBRE = NOMBRE, DESCRIPCION = DESCRIPCION,
	ACTIVO = ACTIVO	WHERE ID = P_ID;
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `SP_ACTUALIZAR_PRODUCTO` (IN `CODIGO` VARCHAR(50), IN `NOMBRE` VARCHAR(50), IN `DESCRIPCION` VARCHAR(50), IN `MARCA` VARCHAR(50), IN `CATEGORIA` VARCHAR(50), IN `PRECIO` FLOAT, IN `P_ID` INT)  BEGIN
	UPDATE productos SET CODIGO = CODIGO, NOMBRE = NOMBRE, DESCRIPCION = DESCRIPCION,
	MARCA = MARCA, CATEGORIA = CATEGORIA, PRECIO = PRECIO	WHERE ID = P_ID;								
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `SP_BORRAR_CATEGORIA` (IN `P_ID` VARCHAR(50))  BEGIN
	DELETE FROM categorias_producto WHERE ID = P_ID;
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `SP_BORRAR_PRODUCTO` (IN `P_ID` INT)  BEGIN
	DELETE FROM productos WHERE ID = P_ID; 
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `SP_CREAR_CATEGORIA` (IN `CODIGO` VARCHAR(50), IN `NOMBRE` VARCHAR(50), IN `DESCRIPCION` VARCHAR(100), IN `ACTIVO` CHAR(10))  BEGIN
	INSERT INTO categorias_producto (CODIGO,NOMBRE,DESCRIPCION,ACTIVO)
	VALUES (CODIGO,NOMBRE,DESCRIPCION,ACTIVO);
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `SP_LLENAR_SELECT_CATEGORIAS` ()  BEGIN
	SELECT NOMBRE FROM categorias_producto;
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `SP_PRODUCTOS_ALL` ()  BEGIN
	SELECT * FROM productos; 
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `SP_ULTIMA_CATEGORIA_AGREGADA` ()  BEGIN
	SELECT * FROM categorias_producto ORDER BY ID DESC LIMIT 1;
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `SP_ULTIMO_PRODUCTO_AGREGADO` ()  BEGIN
	SELECT * FROM productos ORDER BY ID DESC LIMIT 1;
END$$

DELIMITER ;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `categorias_producto`
--

CREATE TABLE `categorias_producto` (
  `ID` int(11) NOT NULL,
  `CODIGO` varchar(50) COLLATE utf8_spanish_ci NOT NULL,
  `NOMBRE` varchar(50) COLLATE utf8_spanish_ci NOT NULL,
  `DESCRIPCION` varchar(100) COLLATE utf8_spanish_ci NOT NULL,
  `ACTIVO` char(10) COLLATE utf8_spanish_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Volcado de datos para la tabla `categorias_producto`
--

INSERT INTO `categorias_producto` (`ID`, `CODIGO`, `NOMBRE`, `DESCRIPCION`, `ACTIVO`) VALUES
(10, '643453', 'ZAPATOS', 'ZAPATOS EN GENERAL', 'S'),
(11, '54334', 'LICRA', 'sueter para caballero', 'S'),
(13, '4235353', 'pantalones', 'pantalones en general', 'N');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `productos`
--

CREATE TABLE `productos` (
  `ID` int(11) NOT NULL,
  `CODIGO` varchar(10) COLLATE utf8_spanish_ci NOT NULL,
  `NOMBRE` varchar(50) COLLATE utf8_spanish_ci NOT NULL,
  `DESCRIPCION` varchar(50) COLLATE utf8_spanish_ci NOT NULL,
  `MARCA` varchar(50) COLLATE utf8_spanish_ci NOT NULL,
  `CATEGORIA` varchar(50) COLLATE utf8_spanish_ci NOT NULL,
  `PRECIO` float NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Volcado de datos para la tabla `productos`
--

INSERT INTO `productos` (`ID`, `CODIGO`, `NOMBRE`, `DESCRIPCION`, `MARCA`, `CATEGORIA`, `PRECIO`) VALUES
(73, '988899', 'bermuda', 'bermudas de caballeros', 'ARTURO CALLE', 'pantalones', 5433210),
(96, '64534353', 'pantalon negro', 'LAS MISMAS', 'LEVIS', 'pantalones', 53442700000);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `respuesta`
--

CREATE TABLE `respuesta` (
  `EXITO` varchar(50) COLLATE utf8_spanish_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Volcado de datos para la tabla `respuesta`
--

INSERT INTO `respuesta` (`EXITO`) VALUES
('exito');

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `categorias_producto`
--
ALTER TABLE `categorias_producto`
  ADD PRIMARY KEY (`ID`),
  ADD UNIQUE KEY `CODIGO` (`CODIGO`),
  ADD UNIQUE KEY `NOMBRE` (`NOMBRE`);

--
-- Indices de la tabla `productos`
--
ALTER TABLE `productos`
  ADD PRIMARY KEY (`ID`),
  ADD UNIQUE KEY `CODIGO` (`CODIGO`),
  ADD UNIQUE KEY `NOMBRE` (`NOMBRE`),
  ADD KEY `FK_CATEGORIA` (`CATEGORIA`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `categorias_producto`
--
ALTER TABLE `categorias_producto`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- AUTO_INCREMENT de la tabla `productos`
--
ALTER TABLE `productos`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=100;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `productos`
--
ALTER TABLE `productos`
  ADD CONSTRAINT `FK_CATEGORIA` FOREIGN KEY (`CATEGORIA`) REFERENCES `categorias_producto` (`NOMBRE`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

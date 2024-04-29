-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 18-10-2022 a las 10:16:34
-- Versión del servidor: 10.4.20-MariaDB
-- Versión de PHP: 7.4.21

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `dbbarberia`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tbcliente`
--

CREATE TABLE `tbcliente` (
  `tbclienteid` int(11) NOT NULL,
  `tbclientenombre` varchar(1000) DEFAULT NULL,
  `tbclienteapellido` varchar(1000) DEFAULT NULL,
  `tbclientetelefono` int(11) NOT NULL,
  `tbclientecorreo` varchar(500) NOT NULL,
  `tbclienteactivo` tinyint(4) NOT NULL DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `tbcliente`
--

INSERT INTO `tbcliente` (`tbclienteid`, `tbclientenombre`, `tbclienteapellido`, `tbclientetelefono`, `tbclientecorreo`, `tbclienteactivo`) VALUES
(1, 'LUIS', 'Castro', 86317744, 'luiscastroaleman@gmail.com', 1),
(3, 'GAMA', 'rodriguez', 777777, 'gama@asdasd', 1),
(4, 'Yeilan', 'Zuñiga', 5555555, 'yeilan', 1),
(5, 'marvin', 'rodriguez', 3333333, 'marvin@gmail.com', 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tbclientecategoria`
--

CREATE TABLE `tbclientecategoria` (
  `tbclientecategoriaid` int(11) NOT NULL,
  `tbclientecategoriadescripcion` varchar(10000) DEFAULT NULL,
  `tbclientecategoriaactivo` tinyint(4) DEFAULT 1,
  `tbclientecategorianombre` varchar(1000) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `tbclientecategoria`
--

INSERT INTO `tbclientecategoria` (`tbclientecategoriaid`, `tbclientecategoriadescripcion`, `tbclientecategoriaactivo`, `tbclientecategorianombre`) VALUES
(1, 'corte1', 1, 'LUIS');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tbclientepagohistorico`
--

CREATE TABLE `tbclientepagohistorico` (
  `tbclientepagohistoricoid` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `tbclientepagohistorico`
--

INSERT INTO `tbclientepagohistorico` (`tbclientepagohistoricoid`) VALUES
(1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tbclientetipo`
--

CREATE TABLE `tbclientetipo` (
  `tbclientetipoid` int(11) NOT NULL,
  `tbclientetipoperiodicidad` float DEFAULT NULL,
  `tbclientetipocancelacion` float DEFAULT NULL,
  `tbclientetipoingresomensual` float DEFAULT NULL,
  `tbclientetipopuntaje` float NOT NULL,
  `tbclientetipoactivo` tinyint(4) NOT NULL DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `tbclientetipo`
--

INSERT INTO `tbclientetipo` (`tbclientetipoid`, `tbclientetipoperiodicidad`, `tbclientetipocancelacion`, `tbclientetipoingresomensual`, `tbclientetipopuntaje`, `tbclientetipoactivo`) VALUES
(1, 2, 3003, 3301, 0, 1),
(2, 1, 2, 3, 0, 1),
(3, 2, 2, 2, 100, 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tbfactura`
--

CREATE TABLE `tbfactura` (
  `tbfacturaid` int(11) NOT NULL,
  `tbfacturafecha` date DEFAULT NULL,
  `tbfacturamonto` float NOT NULL,
  `tbfacturaimpuesto` float NOT NULL,
  `tbfacturatotal` float NOT NULL,
  `tbfacturaclienteid` int(11) NOT NULL,
  `tbfacturaactivo` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `tbfactura`
--

INSERT INTO `tbfactura` (`tbfacturaid`, `tbfacturafecha`, `tbfacturamonto`, `tbfacturaimpuesto`, `tbfacturatotal`, `tbfacturaclienteid`, `tbfacturaactivo`) VALUES
(1, '2022-09-19', 0, 0, 0, 0, 0),
(2, '2022-09-20', 0, 0, 0, 0, 0),
(3, '2022-09-20', 0, 0, 0, 0, 0),
(4, '2022-09-21', 0, 0, 0, 0, 0);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tbfacturadetalle`
--

CREATE TABLE `tbfacturadetalle` (
  `tbfacturadetalleid` int(11) NOT NULL,
  `tbfacturadetallefacturaid` int(11) NOT NULL,
  `tbfacturadetalleservicioid` int(11) NOT NULL,
  `tbfacturadetallecantidadservicio` int(11) NOT NULL,
  `tbfacturadetalleactivo` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `tbfacturadetalle`
--

INSERT INTO `tbfacturadetalle` (`tbfacturadetalleid`, `tbfacturadetallefacturaid`, `tbfacturadetalleservicioid`, `tbfacturadetallecantidadservicio`, `tbfacturadetalleactivo`) VALUES
(1, 4, 3, 2, 1),
(2, 2, 2, 2, 1),
(3, 2, 3, 5, 0);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tbimpuestoventa`
--

CREATE TABLE `tbimpuestoventa` (
  `tbimpuestoventaid` int(11) NOT NULL,
  `tbimpuestoventaporcentaje` float NOT NULL,
  `tbimpuestoventafechaactualizacion` date NOT NULL,
  `tbimpuestoventaactivo` tinyint(4) DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `tbimpuestoventa`
--

INSERT INTO `tbimpuestoventa` (`tbimpuestoventaid`, `tbimpuestoventaporcentaje`, `tbimpuestoventafechaactualizacion`, `tbimpuestoventaactivo`) VALUES
(1, 1, '2022-10-05', 0),
(2, 3, '2022-10-19', 0),
(3, 3, '2022-10-18', 1),
(4, 15, '2022-10-17', 0);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tbmetodopago`
--

CREATE TABLE `tbmetodopago` (
  `tbmetodopagoid` int(100) NOT NULL,
  `tbmetodopagonombre` varchar(100) NOT NULL,
  `tbmetodopagodescripcion` varchar(500) DEFAULT NULL,
  `tbmetodopagoactivo` tinyint(4) DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `tbmetodopago`
--

INSERT INTO `tbmetodopago` (`tbmetodopagoid`, `tbmetodopagonombre`, `tbmetodopagodescripcion`, `tbmetodopagoactivo`) VALUES
(1, 'Efectivo', 'Billete de 5000', NULL),
(2, 'prueba', 'prueba', 0),
(5, 'Efectivo', 'Pago con 5000', 1),
(6, 'sinpe', 'realiza una transferencia por numero de teléfono', 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tbservicio`
--

CREATE TABLE `tbservicio` (
  `tbserviciosid` int(11) NOT NULL,
  `tbserviciosnombre` varchar(500) DEFAULT NULL,
  `tbserviciosdescripcion` varchar(1000) DEFAULT NULL,
  `tbserviciosactivo` tinyint(4) DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `tbservicio`
--

INSERT INTO `tbservicio` (`tbserviciosid`, `tbserviciosnombre`, `tbserviciosdescripcion`, `tbserviciosactivo`) VALUES
(2, 'corte masculino', 'corte tijera ', 1),
(3, 'corte de barba', 'corte maquina', 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tbserviciotarifa`
--

CREATE TABLE `tbserviciotarifa` (
  `tbserviciotarifaid` int(11) NOT NULL,
  `tbserviciotarifafechaactualizada` date DEFAULT NULL,
  `tbserviciotarifamonto` float DEFAULT NULL,
  `tbserviciotarifaactivo` tinyint(4) DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `tbserviciotarifa`
--

INSERT INTO `tbserviciotarifa` (`tbserviciotarifaid`, `tbserviciotarifafechaactualizada`, `tbserviciotarifamonto`, `tbserviciotarifaactivo`) VALUES
(1, '2022-09-12', 5000, 0),
(2, '2022-10-13', 1, 0),
(3, '2022-10-12', 2, 1),
(4, '2022-10-12', 1, 0),
(5, '2022-10-11', 1, 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tbsilla`
--

CREATE TABLE `tbsilla` (
  `tbsillaid` int(11) NOT NULL,
  `tbsillaserie` varchar(1000) DEFAULT NULL,
  `tbsillamarca` varchar(1000) DEFAULT NULL,
  `tbsillamodelo` varchar(1000) DEFAULT NULL,
  `tbsillapreciocompra` float DEFAULT NULL,
  `tbsillaactivo` tinyint(4) DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `tbsilla`
--

INSERT INTO `tbsilla` (`tbsillaid`, `tbsillaserie`, `tbsillamarca`, `tbsillamodelo`, `tbsillapreciocompra`, `tbsillaactivo`) VALUES
(1, '55551', 'I-gaming', '2022', 65000, 1),
(2, '4444', 'Red dragon', '2021', 150000, 1);

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `tbcliente`
--
ALTER TABLE `tbcliente`
  ADD PRIMARY KEY (`tbclienteid`),
  ADD UNIQUE KEY `tbclientetelefono` (`tbclientetelefono`,`tbclientecorreo`),
  ADD UNIQUE KEY `tbclientetelefono_2` (`tbclientetelefono`),
  ADD UNIQUE KEY `tbclientecorreo` (`tbclientecorreo`);

--
-- Indices de la tabla `tbclientecategoria`
--
ALTER TABLE `tbclientecategoria`
  ADD PRIMARY KEY (`tbclientecategoriaid`),
  ADD UNIQUE KEY `tbclientecategorianombre` (`tbclientecategorianombre`) USING HASH;

--
-- Indices de la tabla `tbclientepagohistorico`
--
ALTER TABLE `tbclientepagohistorico`
  ADD PRIMARY KEY (`tbclientepagohistoricoid`);

--
-- Indices de la tabla `tbclientetipo`
--
ALTER TABLE `tbclientetipo`
  ADD PRIMARY KEY (`tbclientetipoid`);

--
-- Indices de la tabla `tbfactura`
--
ALTER TABLE `tbfactura`
  ADD PRIMARY KEY (`tbfacturaid`);

--
-- Indices de la tabla `tbfacturadetalle`
--
ALTER TABLE `tbfacturadetalle`
  ADD PRIMARY KEY (`tbfacturadetalleid`);

--
-- Indices de la tabla `tbimpuestoventa`
--
ALTER TABLE `tbimpuestoventa`
  ADD PRIMARY KEY (`tbimpuestoventaid`);

--
-- Indices de la tabla `tbmetodopago`
--
ALTER TABLE `tbmetodopago`
  ADD PRIMARY KEY (`tbmetodopagoid`);

--
-- Indices de la tabla `tbservicio`
--
ALTER TABLE `tbservicio`
  ADD PRIMARY KEY (`tbserviciosid`),
  ADD UNIQUE KEY `tbserviciosnombre` (`tbserviciosnombre`);

--
-- Indices de la tabla `tbserviciotarifa`
--
ALTER TABLE `tbserviciotarifa`
  ADD PRIMARY KEY (`tbserviciotarifaid`);

--
-- Indices de la tabla `tbsilla`
--
ALTER TABLE `tbsilla`
  ADD PRIMARY KEY (`tbsillaid`),
  ADD UNIQUE KEY `tbsillaserie` (`tbsillaserie`) USING HASH;

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `tbclientepagohistorico`
--
ALTER TABLE `tbclientepagohistorico`
  MODIFY `tbclientepagohistoricoid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT de la tabla `tbservicio`
--
ALTER TABLE `tbservicio`
  MODIFY `tbserviciosid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

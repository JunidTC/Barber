-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 23-10-2022 a las 23:32:04
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
-- Base de datos: `bdbarberia`
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
  `tbclienteactivo` tinyint(4) NOT NULL DEFAULT 1,
  `tbclientecategoriaid` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `tbcliente`
--

INSERT INTO `tbcliente` (`tbclienteid`, `tbclientenombre`, `tbclienteapellido`, `tbclientetelefono`, `tbclientecorreo`, `tbclienteactivo`, `tbclientecategoriaid`) VALUES
(1, 'LUIS', 'Castro', 86317744, 'luiscastroaleman@gmail.com', 1, 1),
(3, 'GAMA', 'rodriguez', 777777, 'gama@asdasd', 1, 2),
(4, 'Yeilan', 'Zuñiga', 5555555, 'yeilan', 1, 2),
(5, 'marvin', 'rodriguez', 3333333, 'marvin@gmail.com', 1, 1),
(6, 'ariel', 'powell', 252525, 'correo@correo.com', 1, 3);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tbclientecategoria`
--

CREATE TABLE `tbclientecategoria` (
  `tbclientecategoriaid` int(11) NOT NULL,
  `tbclientecategoriadescripcion` varchar(10000) DEFAULT NULL,
  `tbclientecategoriaactivo` tinyint(4) DEFAULT 1,
  `tbclientecategorianombre` varchar(1000) DEFAULT NULL,
  `tbclientetipoid` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `tbclientecategoria`
--

INSERT INTO `tbclientecategoria` (`tbclientecategoriaid`, `tbclientecategoriadescripcion`, `tbclientecategoriaactivo`, `tbclientecategorianombre`, `tbclientetipoid`) VALUES
(1, 'casi no viene', 1, 'malo', 3),
(2, 'cliente que usualmente nos visita', 1, 'basico', 2),
(3, 'cliente muy frecuente', 1, 'premiun', 1);

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
(2, 1, 2, 3500, 0, 1),
(3, 2, 2, 3, 100, 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tbfactura`
--

CREATE TABLE `tbfactura` (
  `tbfacturaid` int(11) NOT NULL,
  `tbfacturafecha` date DEFAULT NULL,
  `tbfacturamonto` float NOT NULL,
  `tbimpuestoventaid` int(11) NOT NULL,
  `tbfacturatotal` float NOT NULL,
  `tbclienteid` int(11) NOT NULL,
  `tbfacturaactivo` int(11) NOT NULL,
  `tbmetodopagoid` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `tbfactura`
--

INSERT INTO `tbfactura` (`tbfacturaid`, `tbfacturafecha`, `tbfacturamonto`, `tbimpuestoventaid`, `tbfacturatotal`, `tbclienteid`, `tbfacturaactivo`, `tbmetodopagoid`) VALUES
(4, '2022-10-23', 3000, 5, 3240, 4, 1, 5),
(5, '2022-10-23', 6000, 5, 6480, 5, 1, 6),
(6, '2022-10-23', 4500, 5, 4860, 6, 1, 1),
(7, '2022-10-23', 1500, 5, 1620, 4, 1, 6);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tbfacturadetalle`
--

CREATE TABLE `tbfacturadetalle` (
  `tbfacturadetalleid` int(11) NOT NULL,
  `tbfacturaid` int(11) NOT NULL,
  `tbservicioid` int(11) NOT NULL,
  `tbfacturadetallecantidadservicio` int(11) NOT NULL,
  `tbfacturadetalleactivo` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `tbfacturadetalle`
--

INSERT INTO `tbfacturadetalle` (`tbfacturadetalleid`, `tbfacturaid`, `tbservicioid`, `tbfacturadetallecantidadservicio`, `tbfacturadetalleactivo`) VALUES
(4, 4, 4, 2, 1),
(5, 5, 5, 4, 1),
(6, 6, 3, 3, 1),
(7, 7, 3, 1, 0);

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
(3, 5, '2022-10-18', 1),
(5, 8, '2022-10-22', 1);

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
(1, 'Efectivo', 'Pago con dinero efectivo', 1),
(5, 'Tarjeta', 'Pago con tarjeta credito-debito', 1),
(6, 'Sinpe', 'realiza una transferencia por numero de teléfono', 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tbservicio`
--

CREATE TABLE `tbservicio` (
  `tbserviciosid` int(11) NOT NULL,
  `tbserviciosnombre` varchar(500) DEFAULT NULL,
  `tbserviciosdescripcion` varchar(1000) DEFAULT NULL,
  `tbserviciosactivo` tinyint(4) DEFAULT 1,
  `tbserviciotarifaid` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `tbservicio`
--

INSERT INTO `tbservicio` (`tbserviciosid`, `tbserviciosnombre`, `tbserviciosdescripcion`, `tbserviciosactivo`, `tbserviciotarifaid`) VALUES
(2, 'corte masculino', 'corte tijera ', 1, 1),
(3, 'corte de barba', 'corte maquina', 1, 3),
(4, 'marcado de cejas', 'retoque de cejas', 1, 3),
(5, 'dibujo creativo', 'un lindo dibujo de una estrella', 1, 3);

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
(1, '2022-09-12', 5000, 1),
(3, '2022-10-12', 1500, 1),
(4, '2022-10-12', 3500, 1);

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
(1, '55551', 'I-gaming', '2022', 150000, 1),
(2, '4444', 'Red dragon', '2021', 200000, 1);

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
  MODIFY `tbserviciosid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

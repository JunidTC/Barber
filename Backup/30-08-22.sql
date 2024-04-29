-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1:3307
-- Tiempo de generación: 24-10-2022 a las 00:04:50
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
(1, 'Luis', 'Castro', 86317744, 'luiscastroaleman@gmail.com', 1, 1),
(3, 'Gamaliel', 'Rodríguez', 85101001, 'gamarodri@gmail.com', 1, 2),
(4, 'Yeilan', 'Zúñiga', 89102011, 'yeilanzu@gmail.com', 1, 2),
(5, 'Junid', 'Tinoco', 85191601, 'junidtinoco@gmail.com', 1, 1),
(6, 'Austin', 'Powell', 84854622, 'powellq@gmail.com', 1, 3);

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
(1, 'Nos visita muy frecuente', 1, 'Premiun', 3),
(2, 'Nos visita frecuentemente', 1, 'Básico', 2),
(3, 'Casi no nos visita', 1, 'Malo', 1);

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
(1, 1, 3, 4000, 10, 1),
(2, 2, 2, 8000, 50, 1),
(3, 3, 1, 10000, 100, 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tbcredito`
--

CREATE TABLE `tbcredito` (
  `tbcreditoid` int(11) NOT NULL,
  `tbcreditofacturaid` int(11) NOT NULL,
  `tbcreditofechalimite` date NOT NULL,
  `tbcreditocancelacion` bit(2) NOT NULL,
  `tbcreditoactivo` bit(2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

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
(7, '2022-10-23', 1500, 5, 1620, 4, 1, 6),
(8, '2022-10-23', 2500, 3, 2625, 5, 1, 6),
(9, '2022-10-23', 5000, 3, 5250, 4, 1, 1),
(10, '2022-10-23', 7000, 3, 7350, 3, 1, 5);

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
(4, 4, 4, 2, 0),
(5, 5, 5, 4, 0),
(6, 6, 3, 3, 1),
(7, 7, 3, 1, 0),
(8, 8, 4, 1, 1),
(9, 9, 2, 1, 1),
(10, 10, 6, 2, 1);

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
(5, 8, '2022-10-22', 1),
(6, 13, '2022-09-14', 1);

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
(1, 'Efectivo', 'Pago con dinero físico', 1),
(5, 'Tarjeta', 'Pago con tarjeta crédito-debito', 1),
(6, 'SinpeMovil', 'Transferecia ', 1);

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
(2, 'Corte masculino', 'Corte con tijera  y máquina', 1, 1),
(3, 'Corte de barba', 'Corte con máquina', 0, 3),
(4, 'Diseño y perfilado de cejas', 'Marcado con navajilla', 1, 3),
(5, 'Dibujo creativo', 'Dibujo con máquina o navajilla', 1, 3),
(6, 'Recorte', 'Servicio de recorte con tijera', 1, 4),
(7, 'Afeitado', 'Servicio con navajilla', 1, 6),
(8, 'Marcado', 'Marcado con navajilla', 1, 6),
(9, 'Corte barba', 'Corte con navajilla y máquina', 1, 4);

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
(1, '2022-09-12', 4000, 1),
(3, '2022-10-12', 2500, 1),
(4, '2022-10-12', 3500, 1),
(5, '2022-10-11', 1000, 1),
(6, '2022-10-05', 2000, 1);

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
(1, 'C1002', 'Stay Elit', '2022', 150000, 1),
(2, '1F003', 'Nanofort', '2021', 200000, 1),
(3, '6R013', 'Levine', '2018', 69900, 1),
(4, '31R40', 'Onof', '2020', 90000, 1),
(5, '59T11', 'Vanlig', '2018', 70000, 1);

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
-- Indices de la tabla `tbcredito`
--
ALTER TABLE `tbcredito`
  ADD PRIMARY KEY (`tbcreditoid`);

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
  MODIFY `tbserviciosid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

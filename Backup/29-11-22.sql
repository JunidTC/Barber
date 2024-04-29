-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Servidor: localhost
-- Tiempo de generación: 29-11-2022 a las 08:17:18
-- Versión del servidor: 10.4.25-MariaDB
-- Versión de PHP: 8.1.10

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
-- Estructura de tabla para la tabla `tbabono`
--

CREATE TABLE `tbabono` (
  `tbabonoid` int(11) NOT NULL,
  `tbabonofecha` date NOT NULL,
  `tbabonomonto` float NOT NULL,
  `tbcreditoid` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tbbarbero`
--

CREATE TABLE `tbbarbero` (
  `tbbarberoid` int(11) NOT NULL,
  `tbbarberonombre` varchar(1000) NOT NULL,
  `tbbarberotelefono` int(11) NOT NULL,
  `tbbarberocorreo` varchar(1000) NOT NULL,
  `tbbarberoactivo` tinyint(2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `tbbarbero`
--

INSERT INTO `tbbarbero` (`tbbarberoid`, `tbbarberonombre`, `tbbarberotelefono`, `tbbarberocorreo`, `tbbarberoactivo`) VALUES
(1, 'Dylan', 45465655, 'dylan968@gmail.com', 1),
(2, 'Gabriel', 88877777, 'gabriel@gmail.com', 1),
(3, 'Austin Powell', 23423453, 'austinapq28@gmail.com', 1),
(4, 'Juan ', 23543642, 'sdasf@gmail.com', 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tbcita`
--

CREATE TABLE `tbcita` (
  `tbcitaid` int(11) NOT NULL,
  `tbcitahora` time NOT NULL,
  `tbbarberoid` int(11) NOT NULL,
  `tbservicioid` int(11) NOT NULL,
  `tbcitaactivo` int(11) NOT NULL,
  `tbclienteid` int(11) NOT NULL,
  `tbcitafecha` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `tbcita`
--

INSERT INTO `tbcita` (`tbcitaid`, `tbcitahora`, `tbbarberoid`, `tbservicioid`, `tbcitaactivo`, `tbclienteid`, `tbcitafecha`) VALUES
(1, '08:00:00', 1, 1, 1, 3, '2022-11-28'),
(2, '09:00:00', 1, 1, 1, 3, '2022-11-29'),
(3, '09:00:00', 2, 1, 1, 5, '2022-11-28'),
(4, '10:00:00', 1, 1, 1, 1, '2022-11-29'),
(5, '11:00:00', 2, 1, 1, 5, '2022-11-30'),
(6, '08:00:00', 1, 1, 1, 1, '2022-11-29');

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
(2, 'Gamaliel', 'Rodríguez', 85101001, 'gamarodri@gmail.com', 1, 1),
(3, 'Yeilan', 'Zúñiga', 89102011, 'yeilanzu@gmail.com', 1, 3),
(4, 'Junid', 'Tinoco', 85191601, 'junidtinoco@gmail.com', 1, 1),
(5, 'Austin', 'Powell', 84854622, 'powfgell@gmail.com', 1, 2),
(6, 'Juan', 'Lopez', 34346665, 'sdasf@gmail.com', 1, 3);

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
(3, 3, 1, 10500, 100, 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tbcredito`
--

CREATE TABLE `tbcredito` (
  `tbcreditoid` int(11) NOT NULL,
  `tbcreditofacturaid` int(11) NOT NULL,
  `tbcreditofechalimite` date NOT NULL,
  `tbcreditocancelacion` int(11) NOT NULL,
  `tbcreditoactivo` bit(2) NOT NULL,
  `tbcreditomontototal` float NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `tbcredito`
--

INSERT INTO `tbcredito` (`tbcreditoid`, `tbcreditofacturaid`, `tbcreditofechalimite`, `tbcreditocancelacion`, `tbcreditoactivo`, `tbcreditomontototal`) VALUES
(1, 2, '2022-12-29', 1, b'01', 5085);

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
(1, '2022-11-29', 4500, 3, 5085, 3, 1, 1),
(2, '2022-11-29', 4500, 3, 5085, 5, 1, 4);

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
(1, 1, 1, 1, 1),
(2, 2, 1, 1, 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tbhorario`
--

CREATE TABLE `tbhorario` (
  `tbhorarioid` int(11) NOT NULL,
  `tbbarberoid` int(11) NOT NULL,
  `tbhorariodia` int(11) NOT NULL,
  `tbhorarioinicial` time NOT NULL,
  `tbhorariofinal` time NOT NULL,
  `tbhorarioactivo` bit(2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `tbhorario`
--

INSERT INTO `tbhorario` (`tbhorarioid`, `tbbarberoid`, `tbhorariodia`, `tbhorarioinicial`, `tbhorariofinal`, `tbhorarioactivo`) VALUES
(1, 1, 1, '08:00:00', '15:00:00', b'01'),
(2, 1, 2, '08:00:00', '18:00:00', b'01'),
(3, 1, 3, '10:00:00', '18:00:00', b'01'),
(4, 1, 4, '10:00:00', '18:00:00', b'01'),
(5, 1, 5, '09:00:00', '19:00:00', b'01'),
(6, 1, 6, '07:00:00', '19:00:00', b'01'),
(7, 2, 1, '08:00:00', '15:00:00', b'01'),
(8, 2, 2, '09:00:00', '15:00:00', b'01'),
(9, 2, 3, '08:00:00', '16:00:00', b'01'),
(10, 2, 4, '08:00:00', '17:00:00', b'01'),
(11, 2, 5, '08:00:00', '18:00:00', b'01'),
(12, 2, 6, '08:00:00', '19:00:00', b'01');

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
(1, 5, '2022-10-18', 1),
(2, 9, '2022-11-13', 1),
(3, 13, '2022-09-14', 1);

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
(2, 'Tarjeta', 'Pago con tarjeta crédito-debito', 1),
(3, 'SinpeMovil', 'Transferecia ', 1),
(4, 'credito', 'se habilita un plazo en dias para pagar', 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tbproveedor`
--

CREATE TABLE `tbproveedor` (
  `tbproveedorid` int(11) NOT NULL,
  `tbproveedornombre` varchar(1000) NOT NULL,
  `tbproveedorlineaproducto` varchar(1000) NOT NULL,
  `tbproveedortelefono` int(11) NOT NULL,
  `tbproveedorcorreo` varchar(500) NOT NULL,
  `tbproveedordireccion` varchar(1000) NOT NULL,
  `tbproveedoractivo` tinyint(2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `tbproveedor`
--

INSERT INTO `tbproveedor` (`tbproveedorid`, `tbproveedornombre`, `tbproveedorlineaproducto`, `tbproveedortelefono`, `tbproveedorcorreo`, `tbproveedordireccion`, `tbproveedoractivo`) VALUES
(1, 'Gamaliel Rodriguez', 'vende sillas', 67558844, 'gamaro968@gmail.com', 'La victoria', 1),
(2, 'yeilan', 'amacas', 23423444, 'yeilan@asd.com', 'finca 6', 1),
(3, 'austin', 'tijeras', 66635542, 'austin@cosas.com', 'cariari', 1),
(4, 'junid', 'navajillas ', 66655544, 'jundi@jun.com', 'la alegria', 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tbservicio`
--

CREATE TABLE `tbservicio` (
  `tbservicioid` int(11) NOT NULL,
  `tbservicionombre` varchar(500) DEFAULT NULL,
  `tbserviciodescripcion` varchar(1000) DEFAULT NULL,
  `tbservicioactivo` tinyint(4) DEFAULT 1,
  `tbserviciotarifaid` int(11) NOT NULL,
  `tbservicioduracion` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `tbservicio`
--

INSERT INTO `tbservicio` (`tbservicioid`, `tbservicionombre`, `tbserviciodescripcion`, `tbservicioactivo`, `tbserviciotarifaid`, `tbservicioduracion`) VALUES
(1, 'Corte masculino', 'Corte con tijera  y máquina', 1, 1, 1),
(2, 'Corte de barba', 'Corte con máquina', 1, 5, 1),
(3, 'Diseño y perfilado de cejas', 'Marcado con navajilla', 1, 3, 1),
(4, 'Dibujo creativo', 'Dibujo con máquina o navajilla', 1, 1, 1),
(5, 'Recorte', 'Servicio de recorte con tijera', 1, 2, 1),
(6, 'Afeitado', 'Servicio con navajilla', 1, 5, 1),
(7, 'Marcar cejas', 'marcado con gillette', 1, 4, 1);

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
(1, '2022-09-12', 4500, 1),
(2, '2022-10-12', 2500, 1),
(3, '2022-10-12', 3500, 1),
(4, '2022-10-11', 1000, 1),
(5, '2022-11-13', 2000, 1),
(6, '2022-11-29', 6050, 0);

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
-- Indices de la tabla `tbabono`
--
ALTER TABLE `tbabono`
  ADD PRIMARY KEY (`tbabonoid`);

--
-- Indices de la tabla `tbbarbero`
--
ALTER TABLE `tbbarbero`
  ADD PRIMARY KEY (`tbbarberoid`);

--
-- Indices de la tabla `tbcita`
--
ALTER TABLE `tbcita`
  ADD PRIMARY KEY (`tbcitaid`);

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
-- Indices de la tabla `tbhorario`
--
ALTER TABLE `tbhorario`
  ADD PRIMARY KEY (`tbhorarioid`);

--
-- Indices de la tabla `tbimpuestoventa`
--
ALTER TABLE `tbimpuestoventa`
  ADD PRIMARY KEY (`tbimpuestoventaid`);

--
-- Indices de la tabla `tbmetodopago`
--
ALTER TABLE `tbmetodopago`
  ADD PRIMARY KEY (`tbmetodopagoid`),
  ADD UNIQUE KEY `tbmetodopagonombre` (`tbmetodopagonombre`);

--
-- Indices de la tabla `tbproveedor`
--
ALTER TABLE `tbproveedor`
  ADD PRIMARY KEY (`tbproveedorid`),
  ADD UNIQUE KEY `tbprovedorcorreo` (`tbproveedorcorreo`),
  ADD UNIQUE KEY `tbprovedortelefono` (`tbproveedortelefono`);

--
-- Indices de la tabla `tbservicio`
--
ALTER TABLE `tbservicio`
  ADD PRIMARY KEY (`tbservicioid`),
  ADD UNIQUE KEY `tbserviciosnombre` (`tbservicionombre`);

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
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

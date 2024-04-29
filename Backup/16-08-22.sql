-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Nov 15, 2022 at 08:58 PM
-- Server version: 10.4.24-MariaDB
-- PHP Version: 8.1.6

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `bdbarberia`
--

-- --------------------------------------------------------

--
-- Table structure for table `tbabono`
--

CREATE TABLE `tbabono` (
  `tbabonoid` int(11) NOT NULL,
  `tbabonofecha` date NOT NULL,
  `tbabonomonto` float NOT NULL,
  `tbcreditoid` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tbabono`
--

INSERT INTO `tbabono` (`tbabonoid`, `tbabonofecha`, `tbabonomonto`, `tbcreditoid`) VALUES
(1, '2022-11-01', 5085, 5),
(2, '2022-11-01', 5085, 4);

-- --------------------------------------------------------

--
-- Table structure for table `tbcliente`
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
-- Dumping data for table `tbcliente`
--

INSERT INTO `tbcliente` (`tbclienteid`, `tbclientenombre`, `tbclienteapellido`, `tbclientetelefono`, `tbclientecorreo`, `tbclienteactivo`, `tbclientecategoriaid`) VALUES
(1, 'Luis', 'Castro', 86317744, 'luiscastroaleman@gmail.com', 1, 1),
(3, 'Gamaliel', 'Rodríguez', 85101001, 'gamarodri@gmail.com', 1, 2),
(4, 'Yeilan', 'Zúñiga', 89102011, 'yeilanzu@gmail.com', 1, 2),
(5, 'Junid', 'Tinoco', 85191601, 'junidtinoco@gmail.com', 1, 1),
(6, 'Austin', 'Powell', 84854622, 'powfgell@gmail.com', 1, 3);

-- --------------------------------------------------------

--
-- Table structure for table `tbclientecategoria`
--

CREATE TABLE `tbclientecategoria` (
  `tbclientecategoriaid` int(11) NOT NULL,
  `tbclientecategoriadescripcion` varchar(10000) DEFAULT NULL,
  `tbclientecategoriaactivo` tinyint(4) DEFAULT 1,
  `tbclientecategorianombre` varchar(1000) DEFAULT NULL,
  `tbclientetipoid` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tbclientecategoria`
--

INSERT INTO `tbclientecategoria` (`tbclientecategoriaid`, `tbclientecategoriadescripcion`, `tbclientecategoriaactivo`, `tbclientecategorianombre`, `tbclientetipoid`) VALUES
(1, 'Nos visita muy frecuente', 1, 'Premiun', 3),
(2, 'Nos visita frecuentemente', 1, 'Básico', 2),
(3, 'Casi no nos visita', 1, 'Malo', 1);

-- --------------------------------------------------------

--
-- Table structure for table `tbclientepagohistorico`
--

CREATE TABLE `tbclientepagohistorico` (
  `tbclientepagohistoricoid` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tbclientepagohistorico`
--

INSERT INTO `tbclientepagohistorico` (`tbclientepagohistoricoid`) VALUES
(1);

-- --------------------------------------------------------

--
-- Table structure for table `tbclientetipo`
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
-- Dumping data for table `tbclientetipo`
--

INSERT INTO `tbclientetipo` (`tbclientetipoid`, `tbclientetipoperiodicidad`, `tbclientetipocancelacion`, `tbclientetipoingresomensual`, `tbclientetipopuntaje`, `tbclientetipoactivo`) VALUES
(1, 1, 3, 4000, 10, 1),
(2, 2, 2, 8000, 50, 1),
(3, 3, 1, 10000, 100, 1);

-- --------------------------------------------------------

--
-- Table structure for table `tbcredito`
--

CREATE TABLE `tbcredito` (
  `tbcreditoid` int(11) NOT NULL,
  `tbcreditofacturaid` int(11) NOT NULL,
  `tbcreditofechalimite` date NOT NULL,
  `tbcreditocancelacion` bit(2) NOT NULL,
  `tbcreditoactivo` bit(2) NOT NULL,
  `tbcreditomontototal` float NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tbcredito`
--

INSERT INTO `tbcredito` (`tbcreditoid`, `tbcreditofacturaid`, `tbcreditofechalimite`, `tbcreditocancelacion`, `tbcreditoactivo`, `tbcreditomontototal`) VALUES
(1, 11, '2022-10-31', b'01', b'01', 1520),
(2, 12, '2022-11-04', b'01', b'01', 2825),
(3, 13, '2022-11-04', b'01', b'01', 4520),
(4, 15, '2022-11-01', b'00', b'00', 0),
(5, 16, '2022-11-07', b'01', b'01', 1085),
(6, 17, '2022-11-06', b'01', b'01', 5085),
(7, 14, '2022-11-18', b'01', b'01', 4905);

-- --------------------------------------------------------

--
-- Table structure for table `tbfactura`
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
-- Dumping data for table `tbfactura`
--

INSERT INTO `tbfactura` (`tbfacturaid`, `tbfacturafecha`, `tbfacturamonto`, `tbimpuestoventaid`, `tbfacturatotal`, `tbclienteid`, `tbfacturaactivo`, `tbmetodopagoid`) VALUES
(4, '2022-10-23', 3000, 5, 3240, 4, 1, 5),
(5, '2022-10-23', 6000, 5, 6480, 5, 1, 6),
(6, '2022-10-23', 4500, 5, 4860, 6, 1, 1),
(7, '2022-10-23', 1500, 5, 1620, 4, 1, 6),
(8, '2022-10-23', 2500, 3, 2625, 5, 1, 6),
(9, '2022-10-23', 5000, 3, 5250, 4, 1, 1),
(10, '2022-10-23', 7000, 3, 7350, 3, 1, 5),
(11, '2022-10-27', 4000, 6, 4520, 1, 1, 5),
(12, '2022-10-27', 2500, 6, 2825, 5, 1, 1),
(13, '2022-11-13', 2500, 6, 2825, 1, 1, 5),
(14, '2022-11-13', 4500, 5, 4905, 6, 1, 7);

-- --------------------------------------------------------

--
-- Table structure for table `tbfacturadetalle`
--

CREATE TABLE `tbfacturadetalle` (
  `tbfacturadetalleid` int(11) NOT NULL,
  `tbfacturaid` int(11) NOT NULL,
  `tbservicioid` int(11) NOT NULL,
  `tbfacturadetallecantidadservicio` int(11) NOT NULL,
  `tbfacturadetalleactivo` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tbfacturadetalle`
--

INSERT INTO `tbfacturadetalle` (`tbfacturadetalleid`, `tbfacturaid`, `tbservicioid`, `tbfacturadetallecantidadservicio`, `tbfacturadetalleactivo`) VALUES
(4, 4, 4, 2, 1),
(5, 5, 5, 4, 1),
(6, 6, 3, 3, 1),
(7, 7, 3, 1, 1),
(8, 8, 4, 1, 1),
(9, 9, 2, 1, 1),
(10, 10, 6, 2, 1),
(11, 11, 2, 1, 1),
(12, 12, 4, 1, 1),
(13, 13, 3, 1, 1),
(14, 14, 2, 1, 1);

-- --------------------------------------------------------

--
-- Table structure for table `tbimpuestoventa`
--

CREATE TABLE `tbimpuestoventa` (
  `tbimpuestoventaid` int(11) NOT NULL,
  `tbimpuestoventaporcentaje` float NOT NULL,
  `tbimpuestoventafechaactualizacion` date NOT NULL,
  `tbimpuestoventaactivo` tinyint(4) DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tbimpuestoventa`
--

INSERT INTO `tbimpuestoventa` (`tbimpuestoventaid`, `tbimpuestoventaporcentaje`, `tbimpuestoventafechaactualizacion`, `tbimpuestoventaactivo`) VALUES
(3, 5, '2022-10-18', 1),
(5, 9, '2022-11-13', 1),
(6, 13, '2022-09-14', 1);

-- --------------------------------------------------------

--
-- Table structure for table `tbmetodopago`
--

CREATE TABLE `tbmetodopago` (
  `tbmetodopagoid` int(100) NOT NULL,
  `tbmetodopagonombre` varchar(100) NOT NULL,
  `tbmetodopagodescripcion` varchar(500) DEFAULT NULL,
  `tbmetodopagoactivo` tinyint(4) DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tbmetodopago`
--

INSERT INTO `tbmetodopago` (`tbmetodopagoid`, `tbmetodopagonombre`, `tbmetodopagodescripcion`, `tbmetodopagoactivo`) VALUES
(1, 'Efectivo', 'Pago con dinero físico', 1),
(5, 'Tarjeta', 'Pago con tarjeta crédito-debito', 1),
(6, 'SinpeMovil', 'Transferecia ', 1),
(7, 'credito', 'se habilita un plazo en dias para pagar', 1);

-- --------------------------------------------------------

--
-- Table structure for table `tbproveedor`
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
-- Dumping data for table `tbproveedor`
--

INSERT INTO `tbproveedor` (`tbproveedorid`, `tbproveedornombre`, `tbproveedorlineaproducto`, `tbproveedortelefono`, `tbproveedorcorreo`, `tbproveedordireccion`, `tbproveedoractivo`) VALUES
(1, 'Gamaliel Rodriguez', 'vende sillas', 67558844, 'gamaro968@gmail.com', 'La victoria', 1),
(2, 'yeilan', 'amacas', 23423444, 'yeilan@asd.com', 'finca 6', 1),
(3, 'austin', 'tijeras', 66635542, 'austin@cosas.com', 'cariari', 1),
(4, 'junid', 'navajillas ', 66655544, 'jundi@jun.com', 'la alegria', 0);

-- --------------------------------------------------------

--
-- Table structure for table `tbservicio`
--

CREATE TABLE `tbservicio` (
  `tbservicioid` int(11) NOT NULL,
  `tbservicionombre` varchar(500) DEFAULT NULL,
  `tbserviciodescripcion` varchar(1000) DEFAULT NULL,
  `tbservicioactivo` tinyint(4) DEFAULT 1,
  `tbserviciotarifaid` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tbservicio`
--

INSERT INTO `tbservicio` (`tbservicioid`, `tbservicionombre`, `tbserviciodescripcion`, `tbservicioactivo`, `tbserviciotarifaid`) VALUES
(2, 'Corte masculino', 'Corte con tijera  y máquina', 1, 1),
(3, 'Corte de barba', 'Corte con máquina', 1, 3),
(4, 'Diseño y perfilado de cejas', 'Marcado con navajilla', 1, 3),
(5, 'Dibujo creativo', 'Dibujo con máquina o navajilla', 1, 3),
(6, 'Recorte', 'Servicio de recorte con tijera', 1, 4),
(7, 'Afeitado', 'Servicio con navajilla', 1, 6),
(8, 'Marcado', 'Marcado con navajilla', 1, 6),
(9, 'Corte barba', 'Corte con navajilla y máquina', 1, 4);

-- --------------------------------------------------------

--
-- Table structure for table `tbserviciotarifa`
--

CREATE TABLE `tbserviciotarifa` (
  `tbserviciotarifaid` int(11) NOT NULL,
  `tbserviciotarifafechaactualizada` date DEFAULT NULL,
  `tbserviciotarifamonto` float DEFAULT NULL,
  `tbserviciotarifaactivo` tinyint(4) DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tbserviciotarifa`
--

INSERT INTO `tbserviciotarifa` (`tbserviciotarifaid`, `tbserviciotarifafechaactualizada`, `tbserviciotarifamonto`, `tbserviciotarifaactivo`) VALUES
(1, '2022-09-12', 4500, 1),
(3, '2022-10-12', 2500, 1),
(4, '2022-10-12', 3500, 1),
(5, '2022-10-11', 1000, 1),
(6, '2022-11-13', 2000, 1);

-- --------------------------------------------------------

--
-- Table structure for table `tbsilla`
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
-- Dumping data for table `tbsilla`
--

INSERT INTO `tbsilla` (`tbsillaid`, `tbsillaserie`, `tbsillamarca`, `tbsillamodelo`, `tbsillapreciocompra`, `tbsillaactivo`) VALUES
(1, 'C1002', 'Stay Elit', '2022', 150000, 1),
(2, '1F003', 'Nanofort', '2021', 200000, 1),
(3, '6R013', 'Levine', '2018', 69900, 1),
(4, '31R40', 'Onof', '2020', 90000, 1),
(5, '59T11', 'Vanlig', '2018', 70000, 1);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `tbabono`
--
ALTER TABLE `tbabono`
  ADD PRIMARY KEY (`tbabonoid`);

--
-- Indexes for table `tbcliente`
--
ALTER TABLE `tbcliente`
  ADD PRIMARY KEY (`tbclienteid`),
  ADD UNIQUE KEY `tbclientetelefono` (`tbclientetelefono`,`tbclientecorreo`),
  ADD UNIQUE KEY `tbclientetelefono_2` (`tbclientetelefono`),
  ADD UNIQUE KEY `tbclientecorreo` (`tbclientecorreo`);

--
-- Indexes for table `tbclientecategoria`
--
ALTER TABLE `tbclientecategoria`
  ADD PRIMARY KEY (`tbclientecategoriaid`),
  ADD UNIQUE KEY `tbclientecategorianombre` (`tbclientecategorianombre`) USING HASH;

--
-- Indexes for table `tbclientepagohistorico`
--
ALTER TABLE `tbclientepagohistorico`
  ADD PRIMARY KEY (`tbclientepagohistoricoid`);

--
-- Indexes for table `tbclientetipo`
--
ALTER TABLE `tbclientetipo`
  ADD PRIMARY KEY (`tbclientetipoid`);

--
-- Indexes for table `tbcredito`
--
ALTER TABLE `tbcredito`
  ADD PRIMARY KEY (`tbcreditoid`);

--
-- Indexes for table `tbfactura`
--
ALTER TABLE `tbfactura`
  ADD PRIMARY KEY (`tbfacturaid`);

--
-- Indexes for table `tbfacturadetalle`
--
ALTER TABLE `tbfacturadetalle`
  ADD PRIMARY KEY (`tbfacturadetalleid`);

--
-- Indexes for table `tbimpuestoventa`
--
ALTER TABLE `tbimpuestoventa`
  ADD PRIMARY KEY (`tbimpuestoventaid`);

--
-- Indexes for table `tbmetodopago`
--
ALTER TABLE `tbmetodopago`
  ADD PRIMARY KEY (`tbmetodopagoid`),
  ADD UNIQUE KEY `tbmetodopagonombre` (`tbmetodopagonombre`);

--
-- Indexes for table `tbproveedor`
--
ALTER TABLE `tbproveedor`
  ADD PRIMARY KEY (`tbproveedorid`),
  ADD UNIQUE KEY `tbprovedorcorreo` (`tbproveedorcorreo`),
  ADD UNIQUE KEY `tbprovedortelefono` (`tbproveedortelefono`);

--
-- Indexes for table `tbservicio`
--
ALTER TABLE `tbservicio`
  ADD PRIMARY KEY (`tbservicioid`),
  ADD UNIQUE KEY `tbserviciosnombre` (`tbservicionombre`);

--
-- Indexes for table `tbserviciotarifa`
--
ALTER TABLE `tbserviciotarifa`
  ADD PRIMARY KEY (`tbserviciotarifaid`);

--
-- Indexes for table `tbsilla`
--
ALTER TABLE `tbsilla`
  ADD PRIMARY KEY (`tbsillaid`),
  ADD UNIQUE KEY `tbsillaserie` (`tbsillaserie`) USING HASH;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Sep 21, 2022 at 06:49 PM
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
-- Database: `dbbarberia`
--

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
  `tbclienteactivo` tinyint(4) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tbcliente`
--

INSERT INTO `tbcliente` (`tbclienteid`, `tbclientenombre`, `tbclienteapellido`, `tbclientetelefono`, `tbclientecorreo`, `tbclienteactivo`) VALUES
(1, 'LUIS', 'Castro', 86317744, 'luiscastroaleman@gmail.com', 1),
(2, 'Yeilan', 'Zuniga', 87665544, 'yeizu@gmail.com', 0),
(3, 'gamaliel', 'rodriguez', 777777, 'gama@asdasd', 1);

-- --------------------------------------------------------

--
-- Table structure for table `tbclientecategoria`
--

CREATE TABLE `tbclientecategoria` (
  `tbclientecategoriaid` int(11) NOT NULL,
  `tbclientecategoriadescripcion` varchar(10000) DEFAULT NULL,
  `tbclientecategoriaactivo` tinyint(4) DEFAULT NULL,
  `tbclientecategorianombre` varchar(1000) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tbclientecategoria`
--

INSERT INTO `tbclientecategoria` (`tbclientecategoriaid`, `tbclientecategoriadescripcion`, `tbclientecategoriaactivo`, `tbclientecategorianombre`) VALUES
(1, 'corte', 1, 'LUIS');

-- --------------------------------------------------------

--
-- Table structure for table `tbclientepagohistorico`
--

CREATE TABLE `tbclientepagohistorico` (
  `tbclientepagohistoricoid` int(11) NOT NULL,
  `tbclientepagohistoricofacturadetallefk` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tbclientepagohistorico`
--

INSERT INTO `tbclientepagohistorico` (`tbclientepagohistoricoid`, `tbclientepagohistoricofacturadetallefk`) VALUES
(1, 1);

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
  `tbclientetipoactivo` tinyint(4) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tbclientetipo`
--

INSERT INTO `tbclientetipo` (`tbclientetipoid`, `tbclientetipoperiodicidad`, `tbclientetipocancelacion`, `tbclientetipoingresomensual`, `tbclientetipopuntaje`, `tbclientetipoactivo`) VALUES
(1, 2, 3003, 3301, 0, 1),
(2, 1, 2, 3, 0, 1),
(3, 2, 2, 2, 100, 1);

-- --------------------------------------------------------

--
-- Table structure for table `tbfactura`
--

CREATE TABLE `tbfactura` (
  `tbfacturaid` int(11) NOT NULL,
  `tbfacturafecha` date DEFAULT NULL,
  `tbfacturaclientefk` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tbfactura`
--

INSERT INTO `tbfactura` (`tbfacturaid`, `tbfacturafecha`, `tbfacturaclientefk`) VALUES
(1, '2022-09-19', 5),
(2, '2022-09-20', 3),
(3, '2022-09-20', 4),
(4, '2022-09-21', 4);

-- --------------------------------------------------------

--
-- Table structure for table `tbfacturadetalle`
--

CREATE TABLE `tbfacturadetalle` (
  `tbfacturadetalleid` int(11) NOT NULL,
  `tbfacturadetalleserviciofk` int(11) NOT NULL,
  `tbfacturadetallefacturafk` int(11) NOT NULL,
  `tbfacturadetallemontototal` float NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tbfacturadetalle`
--

INSERT INTO `tbfacturadetalle` (`tbfacturadetalleid`, `tbfacturadetalleserviciofk`, `tbfacturadetallefacturafk`, `tbfacturadetallemontototal`) VALUES
(1, 1, 3, 20000),
(2, 2, 2, 3000);

-- --------------------------------------------------------

--
-- Table structure for table `tbservicio`
--

CREATE TABLE `tbservicio` (
  `tbserviciosid` int(11) NOT NULL,
  `tbserviciosnombre` varchar(500) DEFAULT NULL,
  `tbserviciosdescripcion` varchar(1000) DEFAULT NULL,
  `tbserviciosactivo` tinyint(4) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tbservicio`
--

INSERT INTO `tbservicio` (`tbserviciosid`, `tbserviciosnombre`, `tbserviciosdescripcion`, `tbserviciosactivo`) VALUES
(1, 'yeilan', 'adulto', 0),
(2, 'corte masculino', 'corte tijera ', 1);

-- --------------------------------------------------------

--
-- Table structure for table `tbserviciotarifa`
--

CREATE TABLE `tbserviciotarifa` (
  `tbserviciotarifaid` int(11) NOT NULL,
  `tbserviciotarifafechaactualizada` date DEFAULT NULL,
  `tbserviciotarifamonto` float DEFAULT NULL,
  `tbserviciotarifaactivo` tinyint(4) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tbserviciotarifa`
--

INSERT INTO `tbserviciotarifa` (`tbserviciotarifaid`, `tbserviciotarifafechaactualizada`, `tbserviciotarifamonto`, `tbserviciotarifaactivo`) VALUES
(1, '2022-09-12', 4500, 1);

-- --------------------------------------------------------

--
-- Table structure for table `tbsilla`
--

CREATE TABLE `tbsilla` (
  `idtbsilla` int(11) NOT NULL,
  `tbsillaserie` varchar(1000) DEFAULT NULL,
  `tbsillamarca` varchar(1000) DEFAULT NULL,
  `tbsillamodelo` varchar(1000) DEFAULT NULL,
  `tbsillapreciocompra` float DEFAULT NULL,
  `tbsillaactivo` tinyint(4) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tbsilla`
--

INSERT INTO `tbsilla` (`idtbsilla`, `tbsillaserie`, `tbsillamarca`, `tbsillamodelo`, `tbsillapreciocompra`, `tbsillaactivo`) VALUES
(1, '5555', 'I-gaming', '2022', 65000, 1),
(2, '5656', 'chair-G', '2020', 50000, 0);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `tbcliente`
--
ALTER TABLE `tbcliente`
  ADD PRIMARY KEY (`tbclienteid`);

--
-- Indexes for table `tbclientecategoria`
--
ALTER TABLE `tbclientecategoria`
  ADD PRIMARY KEY (`tbclientecategoriaid`);

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
-- Indexes for table `tbservicio`
--
ALTER TABLE `tbservicio`
  ADD PRIMARY KEY (`tbserviciosid`);

--
-- Indexes for table `tbserviciotarifa`
--
ALTER TABLE `tbserviciotarifa`
  ADD PRIMARY KEY (`tbserviciotarifaid`);

--
-- Indexes for table `tbsilla`
--
ALTER TABLE `tbsilla`
  ADD PRIMARY KEY (`idtbsilla`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `tbcliente`
--
ALTER TABLE `tbcliente`
  MODIFY `tbclienteid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `tbclientepagohistorico`
--
ALTER TABLE `tbclientepagohistorico`
  MODIFY `tbclientepagohistoricoid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `tbservicio`
--
ALTER TABLE `tbservicio`
  MODIFY `tbserviciosid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

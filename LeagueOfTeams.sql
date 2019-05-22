-- phpMyAdmin SQL Dump
-- version 4.6.6deb4
-- https://www.phpmyadmin.net/
--
-- Servidor: localhost:3306
-- Tiempo de generación: 23-05-2019 a las 00:19:31
-- Versión del servidor: 10.1.38-MariaDB-0+deb9u1
-- Versión de PHP: 7.0.33-0+deb9u3

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `lolapi`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `CardPlayer`
--

CREATE TABLE `CardPlayer` (
  `idCard` tinyint(4) NOT NULL,
  `idPlayer` tinyint(4) NOT NULL,
  `dateCreation` date NOT NULL,
  `position` mediumtext COLLATE utf8_spanish_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `Equipamiento`
--

CREATE TABLE `Equipamiento` (
  `idPowerUp` int(11) NOT NULL,
  `name` varchar(100) COLLATE utf8_spanish_ci NOT NULL,
  `type` varchar(50) COLLATE utf8_spanish_ci NOT NULL,
  `idManager` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `League`
--

CREATE TABLE `League` (
  `leagueid` int(11) NOT NULL,
  `name` varchar(55) COLLATE utf8_spanish_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `Manager`
--

CREATE TABLE `Manager` (
  `idManager` int(11) NOT NULL,
  `name` varchar(70) COLLATE utf8_spanish_ci NOT NULL,
  `lastname` varchar(100) COLLATE utf8_spanish_ci DEFAULT NULL,
  `email` varchar(100) COLLATE utf8_spanish_ci NOT NULL,
  `password` varchar(100) COLLATE utf8_spanish_ci NOT NULL,
  `phone` varchar(40) COLLATE utf8_spanish_ci DEFAULT NULL,
  `birthDay` date DEFAULT NULL,
  `gold` int(11) DEFAULT '0',
  `elo` int(11) DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `Match`
--

CREATE TABLE `Match` (
  `idGame` int(11) NOT NULL,
  `idManager1` int(11) NOT NULL,
  `idManager2` int(11) NOT NULL,
  `winner` int(11) NOT NULL,
  `date` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `Player`
--

CREATE TABLE `Player` (
  `idPlayer` mediumint(9) NOT NULL,
  `accountId` int(11) NOT NULL,
  `summonerId` int(11) NOT NULL,
  `KDA` float NOT NULL,
  `numMatches` smallint(6) NOT NULL,
  `name` varchar(100) COLLATE utf8_spanish_ci NOT NULL,
  `leagueId` int(11) NOT NULL,
  `leagueRank` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `TeamPlayer`
--

CREATE TABLE `TeamPlayer` (
  `idCard` int(11) NOT NULL,
  `idManager` smallint(6) NOT NULL,
  `aligned` tinyint(1) NOT NULL,
  `contractDaysLeft` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `CardPlayer`
--
ALTER TABLE `CardPlayer`
  ADD PRIMARY KEY (`idCard`);

--
-- Indices de la tabla `Equipamiento`
--
ALTER TABLE `Equipamiento`
  ADD PRIMARY KEY (`idPowerUp`),
  ADD KEY `idManager` (`idManager`);

--
-- Indices de la tabla `League`
--
ALTER TABLE `League`
  ADD PRIMARY KEY (`leagueid`);

--
-- Indices de la tabla `Manager`
--
ALTER TABLE `Manager`
  ADD PRIMARY KEY (`idManager`);

--
-- Indices de la tabla `Match`
--
ALTER TABLE `Match`
  ADD PRIMARY KEY (`idGame`),
  ADD KEY `idManager1` (`idManager1`),
  ADD KEY `idManager2` (`idManager2`);

--
-- Indices de la tabla `Player`
--
ALTER TABLE `Player`
  ADD PRIMARY KEY (`idPlayer`),
  ADD KEY `leagueId` (`leagueId`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `CardPlayer`
--
ALTER TABLE `CardPlayer`
  MODIFY `idCard` tinyint(4) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT de la tabla `Equipamiento`
--
ALTER TABLE `Equipamiento`
  MODIFY `idPowerUp` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT de la tabla `League`
--
ALTER TABLE `League`
  MODIFY `leagueid` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT de la tabla `Manager`
--
ALTER TABLE `Manager`
  MODIFY `idManager` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
--
-- AUTO_INCREMENT de la tabla `Match`
--
ALTER TABLE `Match`
  MODIFY `idGame` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT de la tabla `Player`
--
ALTER TABLE `Player`
  MODIFY `idPlayer` mediumint(9) NOT NULL AUTO_INCREMENT;
--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `Equipamiento`
--
ALTER TABLE `Equipamiento`
  ADD CONSTRAINT `equipamiento_ibfk_1` FOREIGN KEY (`idManager`) REFERENCES `Manager` (`idManager`);

--
-- Filtros para la tabla `Match`
--
ALTER TABLE `Match`
  ADD CONSTRAINT `match_ibfk_1` FOREIGN KEY (`idManager1`) REFERENCES `Manager` (`idManager`),
  ADD CONSTRAINT `match_ibfk_2` FOREIGN KEY (`idManager2`) REFERENCES `Manager` (`idManager`);

--
-- Filtros para la tabla `Player`
--
ALTER TABLE `Player`
  ADD CONSTRAINT `player_ibfk_1` FOREIGN KEY (`leagueId`) REFERENCES `League` (`leagueid`);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

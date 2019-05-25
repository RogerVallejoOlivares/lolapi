-- phpMyAdmin SQL Dump
-- version 4.6.6
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1:3306
-- Tiempo de generación: 25-05-2019 a las 21:23:18
-- Versión del servidor: 5.6.35
-- Versión de PHP: 7.1.1

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";

--
-- Base de datos: `lolapi`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `cardplayer`
--

CREATE TABLE `cardplayer` (
  `idCard` tinyint(4) NOT NULL,
  `idPlayer` tinyint(4) NOT NULL,
  `dateCreation` date NOT NULL,
  `position` mediumtext COLLATE utf8_spanish_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `equipamiento`
--

CREATE TABLE `equipamiento` (
  `idPowerUp` int(11) NOT NULL,
  `name` varchar(100) COLLATE utf8_spanish_ci NOT NULL,
  `type` varchar(50) COLLATE utf8_spanish_ci NOT NULL,
  `idManager` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `league`
--

CREATE TABLE `league` (
  `leagueid` int(11) NOT NULL,
  `name` varchar(55) COLLATE utf8_spanish_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `manager`
--

CREATE TABLE `manager` (
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
-- Estructura de tabla para la tabla `match`
--

CREATE TABLE `match` (
  `idGame` int(11) NOT NULL,
  `idManager1` int(11) NOT NULL,
  `idManager2` int(11) NOT NULL,
  `winner` int(11) NOT NULL,
  `date` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `player`
--

CREATE TABLE `player` (
  `idPlayer` mediumint(9) NOT NULL,
  `accountId` text COLLATE utf8_spanish_ci NOT NULL,
  `summonerId` text COLLATE utf8_spanish_ci NOT NULL,
  `KDA` float NOT NULL,
  `numMatches` smallint(6) NOT NULL,
  `name` varchar(100) COLLATE utf8_spanish_ci NOT NULL,
  `leagueId` int(11) NOT NULL,
  `leagueRank` text COLLATE utf8_spanish_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `teamplayer`
--

CREATE TABLE `teamplayer` (
  `idCard` int(11) NOT NULL,
  `idManager` smallint(6) NOT NULL,
  `aligned` tinyint(1) NOT NULL,
  `contractDaysLeft` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `cardplayer`
--
ALTER TABLE `cardplayer`
  ADD PRIMARY KEY (`idCard`);

--
-- Indices de la tabla `equipamiento`
--
ALTER TABLE `equipamiento`
  ADD PRIMARY KEY (`idPowerUp`),
  ADD KEY `idManager` (`idManager`);

--
-- Indices de la tabla `league`
--
ALTER TABLE `league`
  ADD PRIMARY KEY (`leagueid`);

--
-- Indices de la tabla `manager`
--
ALTER TABLE `manager`
  ADD PRIMARY KEY (`idManager`);

--
-- Indices de la tabla `match`
--
ALTER TABLE `match`
  ADD PRIMARY KEY (`idGame`),
  ADD KEY `idManager1` (`idManager1`),
  ADD KEY `idManager2` (`idManager2`);

--
-- Indices de la tabla `player`
--
ALTER TABLE `player`
  ADD PRIMARY KEY (`idPlayer`),
  ADD KEY `leagueId` (`leagueId`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `cardplayer`
--
ALTER TABLE `cardplayer`
  MODIFY `idCard` tinyint(4) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT de la tabla `equipamiento`
--
ALTER TABLE `equipamiento`
  MODIFY `idPowerUp` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT de la tabla `league`
--
ALTER TABLE `league`
  MODIFY `leagueid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;
--
-- AUTO_INCREMENT de la tabla `manager`
--
ALTER TABLE `manager`
  MODIFY `idManager` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT de la tabla `match`
--
ALTER TABLE `match`
  MODIFY `idGame` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT de la tabla `player`
--
ALTER TABLE `player`
  MODIFY `idPlayer` mediumint(9) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `equipamiento`
--
ALTER TABLE `equipamiento`
  ADD CONSTRAINT `equipamiento_ibfk_1` FOREIGN KEY (`idManager`) REFERENCES `manager` (`idManager`);

--
-- Filtros para la tabla `match`
--
ALTER TABLE `match`
  ADD CONSTRAINT `match_ibfk_1` FOREIGN KEY (`idManager1`) REFERENCES `manager` (`idManager`),
  ADD CONSTRAINT `match_ibfk_2` FOREIGN KEY (`idManager2`) REFERENCES `manager` (`idManager`);

--
-- Filtros para la tabla `player`
--
ALTER TABLE `player`
  ADD CONSTRAINT `player_ibfk_1` FOREIGN KEY (`leagueId`) REFERENCES `league` (`leagueid`);

-- phpMyAdmin SQL Dump
-- version 4.6.6
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1:3306
-- Tiempo de generación: 28-05-2019 a las 16:16:06
-- Versión del servidor: 5.6.35
-- Versión de PHP: 7.1.1

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
-- Estructura de tabla para la tabla `cardplayer`
--

CREATE TABLE `cardplayer` (
  `idCard` int(11) NOT NULL,
  `idPlayer` int(11) NOT NULL,
  `idManager` int(11) NOT NULL,
  `dateCreation` date NOT NULL,
  `position` mediumtext COLLATE utf8_spanish_ci NOT NULL,
  `inMarket` tinyint(1) NOT NULL,
  `aligned` tinyint(1) NOT NULL,
  `contractDaysLeft` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Volcado de datos para la tabla `cardplayer`
--

INSERT INTO `cardplayer` (`idCard`, `idPlayer`, `idManager`, `dateCreation`, `position`, `inMarket`, `aligned`, `contractDaysLeft`) VALUES
(1, 152, 1, '2019-05-28', 'top', 0, 0, 50),
(2, 153, 1, '2019-05-28', 'jungle', 0, 1, 50),
(3, 154, 1, '2019-05-28', 'mid', 0, 1, 50),
(4, 155, 1, '2019-05-28', 'adc', 0, 1, 50),
(5, 156, 1, '2019-05-28', 'support', 0, 1, 50),
(6, 152, 2, '2019-05-28', 'top', 0, 1, 50),
(7, 153, 2, '2019-05-28', 'jungle', 0, 1, 50),
(8, 154, 2, '2019-05-28', 'mid', 0, 1, 50),
(9, 155, 2, '2019-05-28', 'adc', 0, 1, 50),
(10, 156, 2, '2019-05-28', 'support', 0, 1, 50),
(11, 152, 3, '2019-05-28', 'top', 0, 1, 50),
(12, 153, 3, '2019-05-28', 'jungle', 0, 1, 50),
(13, 154, 3, '2019-05-28', 'mid', 0, 1, 50),
(14, 155, 3, '2019-05-28', 'adc', 0, 1, 50),
(15, 156, 3, '2019-05-28', 'support', 0, 1, 50),
(16, 152, 4, '2019-05-28', 'top', 0, 1, 50),
(17, 153, 4, '2019-05-28', 'jungle', 0, 1, 50),
(18, 154, 4, '2019-05-28', 'mid', 0, 1, 50),
(19, 155, 4, '2019-05-28', 'adc', 0, 1, 50),
(20, 156, 4, '2019-05-28', 'support', 0, 1, 50),
(26, 152, 7, '2019-05-28', 'top', 0, 1, 50),
(27, 153, 7, '2019-05-28', 'jungle', 0, 1, 50),
(28, 154, 7, '2019-05-28', 'mid', 0, 1, 50),
(29, 155, 7, '2019-05-28', 'adc', 0, 1, 50),
(30, 156, 7, '2019-05-28', 'support', 0, 1, 50),
(31, 1, 1, '2019-05-09', 'top', 0, 1, 72),
(32, 55, 1, '2019-05-28', 'jungle', 0, 0, 0),
(33, 152, 8, '2019-05-28', 'top', 0, 1, 50),
(34, 153, 8, '2019-05-28', 'jungle', 0, 1, 50),
(35, 154, 8, '2019-05-28', 'mid', 0, 1, 50),
(36, 155, 8, '2019-05-28', 'adc', 0, 1, 50),
(37, 156, 8, '2019-05-28', 'support', 0, 1, 50);

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

--
-- Volcado de datos para la tabla `league`
--

INSERT INTO `league` (`leagueid`, `name`) VALUES
(1, 'Unranked'),
(2, 'Iron'),
(3, 'Bronze'),
(4, 'Silver'),
(5, 'Gold'),
(6, 'Platinum'),
(7, 'Diamond'),
(8, 'Master'),
(9, 'Grandmaster'),
(10, 'Challenger');

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

--
-- Volcado de datos para la tabla `manager`
--

INSERT INTO `manager` (`idManager`, `name`, `lastname`, `email`, `password`, `phone`, `birthDay`, `gold`, `elo`) VALUES
(1, 'Erik', 'Asís', 'test@domain.com', 'MTIzNA==', '600708090', '1993-07-21', 100680, 15),
(2, 'Name1', 'Last Name', 'test1@domain.com', 'MTIzNA==', '600708090', '0000-00-00', 1000, 0),
(3, 'Name2', 'Last Name', 'test2@domain.com', 'MTIzNA==', '600708090', '0000-00-00', 0, 2),
(4, 'Name3', 'Last Name', 'test3@domain.com', 'MTIzNA==', '600708090', '0000-00-00', 0, 3),
(5, 'Name4', 'Last Name', 'test4@domain.com', 'MTIzNA==', '600708090', '0000-00-00', 0, 0),
(7, 'Name5', 'Last Name', 'test5@domain.com', 'MTIzNA==', '600708090', '0000-00-00', 0, 0),
(8, 'Name6', 'Last Name', 'test6@domain.com', 'MTIzNA==', '', '0000-00-00', 0, 0);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `matchhistory`
--

CREATE TABLE `matchhistory` (
  `idGame` int(11) NOT NULL,
  `idManager1` int(11) NOT NULL,
  `idManager2` int(11) NOT NULL,
  `winner` int(11) NOT NULL,
  `date` timestamp NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Volcado de datos para la tabla `matchhistory`
--

INSERT INTO `matchhistory` (`idGame`, `idManager1`, `idManager2`, `winner`, `date`) VALUES
(1, 1, 2, 1, '2019-05-28 14:35:59'),
(2, 1, 2, 1, '2019-05-28 14:36:08'),
(3, 1, 5, 0, '2019-05-28 14:36:10'),
(4, 1, 2, 1, '2019-05-28 14:36:19'),
(5, 1, 7, 1, '2019-05-28 14:37:47'),
(6, 1, 2, 1, '2019-05-28 14:38:25'),
(7, 1, 4, 1, '2019-05-28 15:14:01'),
(8, 1, 4, 1, '2019-05-28 15:14:41'),
(9, 1, 4, 1, '2019-05-28 15:14:44'),
(10, 1, 4, 1, '2019-05-28 15:14:46'),
(11, 1, 4, 1, '2019-05-28 15:14:47'),
(12, 1, 4, 1, '2019-05-28 15:14:48'),
(13, 1, 4, 1, '2019-05-28 15:14:49'),
(14, 1, 2, 1, '2019-05-28 15:15:08'),
(15, 1, 4, 1, '2019-05-28 15:15:10'),
(16, 1, 4, 1, '2019-05-28 15:15:11'),
(17, 1, 4, 1, '2019-05-28 15:15:12'),
(18, 1, 4, 1, '2019-05-28 15:15:13');

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

--
-- Volcado de datos para la tabla `player`
--

INSERT INTO `player` (`idPlayer`, `accountId`, `summonerId`, `KDA`, `numMatches`, `name`, `leagueId`, `leagueRank`) VALUES
(1, '-Uk6z8z11l6U_QvfAP3qnaImPVkkoGgIw-x3zQiiqDA', '0vM9CRLm--lwKuw4H7x4t0fg2jARq2ni7JSMeYvbPgfK', 3.11, 114, 'matalords', 5, 'IV'),
(2, 'FCgbrt2FotVeeSVi9R11wbopFdhYZ88xx0Ay26nVIlDxvnc', 'huVa5IJqNb8zs3NTFh0Q_mGm1_ZRGzB-7cmImMoNxvS3E4Y', 4.01, 5, 'Golken', 5, 'III'),
(3, 'DdWcpNYl63zNk8QEagqzpb6G9SuyoGy6pdM7Bb-N9s7idvI', 'AVDUZBMUB8e5Lwl28Mqy1zsnmKOLm2vmujifL8E4ASEjlmg', 1.95, 5, 'iTak3uRmAmA', 4, 'IV'),
(4, 'IJTthUuklre8eAiFMdEVK2iOgsKrGuVbikNRf0j91GLZqSw', 'tDFkD6rqnjOQVt7CDwbJG_6skZtuJGrCu0QhYuHFxx8iNGo', 3.9, 97, 'inferno0529', 4, 'IV'),
(5, 'E9H9C7mft-CecPGy3n0bI2i6_DG6YkEhJ6VaJCpSNjB47ks', '2GxzfMCX1S7ecth3NiByWJoBaYm82YdPQ5Jh6zCFpmMV11M', 4.03, 123, 'mapilol', 4, 'I'),
(6, 'WxyKHwuCNopvRjrTY7yHj8DrwDkaL4oaeZKiC-7-e8ujFw', 'pj5_Hg0N6GSUkNkRD3bAhm32FvPv3WzsKGb1N19vk_3CHI4', 1.38, 5, 'Kire287', 4, 'IV'),
(7, 'UPCgFDzr1krmPQVEL5Hz6RmvAK-6nXZv_uGJ39po_LXJS7U', '9VA3A1wYR7kVMV7tvYobKNIQGCrtD7SljXa16jqaxLfYLKw', 2.07, 5, 'atlo16', 5, 'III'),
(8, 'SWdfzjwJF3A_ICx1cZTc-P9q_NHbAvOhKPNUarblH-tnflA', 'K7hEdECNddH3mx6xZSN5lS0k7AvfeweMazIQx37_EktW-B0', 4.86, 5, 'merlintheperfect', 4, 'I'),
(9, 'Arxqltut-YcdZTC6DcnNymfoUAsHbpdi9RJyMGyv5NSQ__c', 'YrW1bI1vSlUxM45woYjmlMqIL4eOVLfipvuvGc27uTCmVn7E', 1.56, 6, 'Made in MD', 4, 'IV'),
(10, 'QP-JAfXq1yO4_YyDYFJRd-5L3uBbd7VXsPSQKhnF1vBorY8', 'rJc3MdeO_ud7jUv60LWSUoU_dw6-SBg8LwMao6nXw1wihlg', 2.02, 6, 'Vater Uhu', 4, 'II'),
(11, 'AuO1O0sRWHOwGwLK-kahjtk8wwjDTqhi1Fo8f3g_LofWBC4', 'ysYiDtoBT7Dk8DBZzYSOHSt1qwmc2LfQqARsTiUk5_jpn5s', 3.12, 5, 'darkal13', 5, 'II'),
(12, 'TBxYQFHIMFDVrE85FO-qdNIO15g5KGlnhlsd3sgNVqLq2G4', 'uLDqf26yINfWw1wo7umMZvlMKYYToQG11Cmbe3U13KwKo-8', 2.45, 6, 'Reklius', 5, 'I'),
(13, 'OAhV1KDrlwjHEf7e_l0ESKbyeuGNf7H64W8uHOpH35ZRcbQ', 'VLvIwneqI83aUFksQsYOc6QiAPh72N6M7yibnzqPzGZ7_-Jk', 1.54, 6, 'AmyPond', 5, 'IV'),
(14, 'IffOHB1cd4muETxE4gdDANpXWJ7BwAK6iaKmkhvqznbUJA', 'ZvwO1Vp8mjDc7MrKNwPbdgFgw_aIutUi7iLKx_ctQeh6OSs', 2.02, 6, 'armscoffa', 5, 'IV'),
(15, 'i-5LZnRPyNwTXIO9Pq1nhAkx8gjCyl9VVKDCcPA1iJY-1Eg', 'YJ4y_84QN3vW3OHHlPuDUU0iPBuVb_RfNALc1-SnY-z1Hak', 2.54, 6, 'Elguillo18', 5, 'III'),
(16, 'p9RtgmZtANHNWFU-lVq_peCRiICsj4IHBNR53j2ccCaEQQA', 'WTXz3CoO8pHcnpd8WDxou7pQQ5Ma-4jeDf255c3xKZoOsH0', 1.76, 6, 'apasin21', 4, 'II'),
(17, 'pcLQ8ACTqmb8alPL5Cpj_7NhCXeXnyHVHCgXjMtyaiErjEA', 'eQ5JoJnMEnY5O5B9q6s_qGkh83XaaLgmtlm2W3tpgApHT08', 2.58, 5, 'ImZECK', 3, 'I'),
(18, 'Uw-j7aZlaZ6-d0Mb2DX5m2P8W8snNIRQjeBeAzpwrLORxWY', 'FQXMvV1do1ldnEqim6FUdfMZEpkDmEZ_UfFBnkzZR4Dj7w8', 7.13, 5, 'TheOnlyChick', 4, 'IV'),
(19, 'wAj0kZeTjNvtbyWxFfcABS5btBrYm71Uc2gkTGymObpBA_U', 'moLHF2rC_c7XbrLO886oun4AGiPxUJCsJPIRpizEAW0RaE4', 3.91, 6, 'El Tito Segu', 4, 'IV'),
(20, 'Ov4zXLX9EiPuCAeNMQFmuAB4jFdg2a-tcruJrH7I7tEwPg', 'qPCYXc4deJUIEH4JftJL0DQXV1g_hTjHfom4CGVZJ_acA6A', 3.7, 5, 'Wakaibushi', 4, 'II'),
(21, 'R0pEE7ue25nb_7-2G4JXrDqCbNiFI6pB--hHi_XhRjOwh6E', 'M5u2Sp3K1dP2BfVFkuMQ3-_idR47gtyHkxXe9gou7Yy5ycA', 3.98, 5, 'The Green Guy', 4, 'IV'),
(22, 'E5EbLKYsP_g2p0NVB0uRi3RBTh4lRKD_K6iYcdaS2Hmvmxk', 'GCPq12wcnASoCbUEqQnNq1EoSwvlR94JES-ltd6qvyIjd-c', 2, 5, 'Gimly', 5, 'IV'),
(23, 'y3ZA7p9Ldifb9CBAzvhXje7hPnjHyChotDIGB2kdCJsOKlI', 'pg0LqzqjBRuYSMV5xlHL1tC0p7RtgpwZ66ArKob8nK6Z8DQ', 1.06, 5, 'Zaliasblynas', 3, 'IV'),
(24, 'Bs73f-i7tVEIZFiHx0C9PdYJsM9hzYY-6wun2L9wDj8GcWU', 'zic5_4WLff9h7jLncULGM7qr0-G9X2WnwQF4YS0GNDQopMs', 3.4, 5, 'Kenji Kawai', 4, 'III'),
(25, 'zhkjsIvTsNFlLGg9CfrmfCgZxdVRs_3zJrjUKFnHDsiB-g', '1lPAJTEGIYuw1jrJYD_j2Qbbwyq0Q6vz8J8ci_7wVRg8YVA', 2.1, 6, 'SoniAdo', 3, 'I'),
(26, 'AvUSy_bWXn79Jk4y5_xUwjF5Dn3K3BHvKphKTSC2o3Ji-w', 'T8iUdBT9FHKs2HdYhk6165jIwoJDultOHggofq67-ug0Cig', 2.7, 5, 'Ashman', 4, 'II'),
(27, 'wmDWCpnEccJeAT8sLjNvBtShsWSIrcfXYzt5Lu1TY6Tur6c', 'ANOJeM54pqscNKMn6qtI_wgabBsBMz8iMR8wMp9V3Eht3OQ', 5.72, 6, 'Kindelein', 3, 'II'),
(28, '8LMeux3kpshg5T0fz4fMvpDipJkmwWZIfKjkeXMCzuHCWw', 'q4hr7n24B1IO9LH-wYy_LL0S_it9ETcCVxGlNtqqUFlPcsQ', 2.14, 5, 'Panomalixme', 4, 'II'),
(29, 'poqa3D14BHJQpaWROdAJZ4aPgfJ5Ggejs40KnVigkwtT-UY', 'SbOjqPt4reWi5aVCiAbGplawawwr-Ax2_FNeBCHzZj_hH8w', 2.41, 5, 'King Pengo', 4, 'II'),
(30, 'IyQsCbggOQ071RIrBznuDTmNVk-8o1J82Uzr4BUPEqSRtqw', 'xYEvSkIPJ3BvgO4F0wgTPxpkezF-ejDp5oIu1ReWvZ5n7YU', 4.08, 6, 'Afremh', 5, 'IV'),
(31, 'tU81VxyLLmrEV9NCMenuw7Dc47o-HUDXpwMqL-3FFgXBSw', 'BHsXE-B5FfgR_-Rf9suNewPceE94A3-uRv4rA3m1T9Zrk8o', 6.12, 5, 'RyKiOmG', 5, 'III'),
(32, 'BE07IdrArcxrMm62xHR6DT088C6KW5_XwO2ACbaEtMvqtA', 'pkKz6KaNLfkHxJCp5cV5L6WmotdloXhnbrkF7_cm3EDCaoY', 2.36, 5, 'Viveldop', 4, 'II'),
(33, 'VgJ65UFy0xx8yUnR9-FMcfv1CamKNuVQsqhyxL_cg2M47CU', '0fVD59CISFkbaLofsLyRGJlG2lYzLD0igAbV5ql29VrK5X4', 6.02, 6, 'CynicalDeer', 3, 'I'),
(34, '9z9WEKkYo1ppJ_KrP3hQH3hqfJOKm-DaSCwTBvhyU1qIFw', 'QHwNXmh3EWWwQBP6SaaOlM7rrhZ_NyGcep6DpssWNFdRfS0', 5.34, 6, 'Kwaokaa', 5, 'IV'),
(35, 'J0bM8kx2yt4W7dTYH7Fc6-EUsrIHczeJVhz1yp11OLZ8kJI', 'oB7J7biuW5SaAfORRJ64YxoWEXW5vvx7vVPL1Xt3kYEiwnU', 2.98, 5, 'harvEy xd', 4, 'III'),
(36, 'SXdYZ8kzO8MOQai1yzqth_QTJ2RPvp9vTXf_BX_t0w0oC_w', '34Lc-e8TrbDrlNyhkndz7mepfKupraDZtb2NeXr9BZs9_Mg', 1.52, 6, 'TQ Event Horizon', 4, 'IV'),
(37, 'v89Mu5uJl9-Dror_muCnHV8s6qxpLpDmqNrNiwQuY2u-ZXQ', 'nRtVAl4VMsOfwqKrNqU0tesNmK1rEbY677y6n9Vr9z4RqmE', 1.66, 5, 'SelGaD0o', 3, 'II'),
(38, 'O3HPIO7kWxn4SGXEvkt94IO_uHA4B-yyFxDtpABO2JtTiNg', '_OsSFKlsk5XQLeady1fYTkO3RfKh23kcXCR_ly69vDeULUDU', 1.59, 6, 'SirGammaa', 4, 'III'),
(39, 'mM_CuvbUEgh-stA-fsFZ4pdLMLxY5cjCdApO1IHvbt4c398', 'MrquwT8y47OldnxJC0__a37sJyDIN6os4Okdc5I01SGB_24', 4.31, 6, 'GnomoFunky', 4, 'II'),
(40, 'kluFlS30xETwZyFj0KLYI1QvKRCNQ36HG9EZOgD94ushPZA', 'GI1nV4oMVsEE34TYCZDn-MchJ4YzVlZhdnrupixHKzzW-1Pt', 2.36, 6, 'RockyFighter017', 3, 'II'),
(41, 'm5S2dRudkyi5uLb8AlGxpS9ahf1FynM0lzQ3qweKGeb00pM', '9FO0Nrjyav4fb1O6BQDAQOXbfN8Wozgqyd3MDUxHWbwpO1k', 1.47, 5, 'RETALERO01', 3, 'II'),
(42, 's3eMnnayZf7mzPEVmHcJXamA-TODHJ-igIK7HvSUymmixCs', 'rSy3VVNu5zITqT1JAv3UnoVbe16z-ccrEBHY9tDVAxsrZrk', 5.4, 5, 'conqueremotion', 3, 'II'),
(43, 'uPjabvtVJ-T55dHkDiSvziN566-2dRGF6OrMoMe798DZiik', 't3-6oHtiFOdXFZwRFx2CHkpT6czsWLfnLeHMURurTPtJmlg', 6.73, 6, 'Hidetaka', 5, 'IV'),
(44, 'FMS4x9Lx1tc6TqgAfAC_rwO_6vayd0uIVdc_pOIUveN_Vw', 'aOUj2e57xawJTNhATOrjTCedXrx9GSlOYBPYx0HciM-IJvY', 2.84, 5, 'EdMcSchleck', 4, 'I'),
(45, 'ckwgHqVk-4n3SGerW4UKrt7fHUpZZK6tNyTQneQdgV58GMg', 'X6q_hzzxbSKTcRIMJXn_cA5WwTGreFMPkAtk6jE2zNrfGwk', 1.43, 5, 'TLG Edusenpai', 5, 'IV'),
(46, 'i2JpnlswmfF_iatirrggPEPO3f-hMR0P4IWB8C81LPNRzw', 'yHayNLmhTSq4hFJVgce3gr9NV0e_8Yb1gSEmlnKbpmbfTkQ', 1.1, 5, 'Warwick Stap Plz', 3, 'II'),
(47, 'Y2xFYXiCKx8pNCKhvKBPqJjHrzJ0hn-pH9D_Mne0KStBays', 'uQVEOegMB-6R7e85WqFesF7Jm2QmTKVIFinLW3wxw6C8Op4', 3.86, 5, 'Raduvinovich', 4, 'III'),
(48, 'Q_fG37iYdzk3jLv_7f4C5C2iBVD6y23444J7q8YRcK1JmPM', 'UXIkQaMntuDwypg4jbU1I6KiUxRZ6D8VTiOqqxwFPe4YwBk', 5.91, 6, 'LordbaschaFanboy', 5, 'IV'),
(49, 'vgkqSaOejmMu9M_bCxC7SL39PKSSOGKQ238KYobJ_BteYAM', 'TPd9tv6hYMg2nIjwhbWeP59KZdOvzLInP8ljrogEZwWvufE', 14.23, 6, 'TSY NEXUS', 4, 'IV'),
(50, 'JiskUEUA700UW5FmFtAGyP21DRPhxRVkkowrVulXyNDo9IM', '1n7IyYLjrO0epQztQMYe6ObMB1oCEi1DT4Osh_7Znon1H_w', 8.32, 5, 'TSY MADE', 4, 'III'),
(51, 'Z-NWvX1fIUw6knDZm-FQW4_FAH0PlGu1HLRkV5fLWNopAyM', 'fo5_uwqf-JyYN3MDcD3zG8-XrbSGfZmcC-xvIR8Np_182oI', 4.55, 6, 'FelKar27', 4, 'II'),
(52, 'eRSEjROYLjoRGoqpJLal4642ehE1hMmS8LLbnYU-ExH-Xg', 'rHChxt9hPokMk6Imqx-AGmuaMSbbz2K7MsAaf15z2jdoK90', 2.21, 6, 'Gl4ss Gol3m', 3, 'I'),
(53, 'sy1YIhbMqVRzVIaPw4FO0yGhGKPyrnBluLiBOEmOewwuzg', 'M1TZh2QP8VwBEFJrcy8ViXVNbfz_RwUI6YHH0UrWG0rpYcM', 3.57, 6, 'Synphul', 6, 'IV'),
(54, 'xErn6pkhgbyEUrCx4ywLUCN_NO7Gjt8D0C-LWK8M94KQ1f4', 'm3jdupHu_YPzxbc7TqCQCdS-xFQ2XwBKsoWpBK5gxZQXZFo', 1.52, 6, 'FIyingWhale', 4, 'IV'),
(55, 'e4pZ3nRgpv-KlRW8mRFH_vOwS-iHJwuB9n44AVETbkjC-Ec', 'DkXwnNYi87sx9haqtGsNpi0wU74O8jWk13rzyu9ziZQzsTI', 4.78, 6, 'LoganOracio', 4, 'IV'),
(56, 'OUqu7ZGtmDneqvOInd3hKgUjZ7aSZh5wBufAx6yKYchGLQ', 'Vo45XOVOd8VpooKeDLWWG5gu-hCFUxLlvNBJsn9kb0zJNec', 5.24, 6, 'Corporal D', 5, 'III'),
(57, '_4ysft34NM_5g-V2LHQm3tWs1CxtFvuwu2D0DTVeqGjYBw', 'VYTR6XR_ylf8sUGPoyOgNLkXDvSGWGofaXsF3yYonQhB9P4', 4.49, 6, 'Leutnant Z', 5, 'III'),
(58, '_jSBBS-C42YFfR6tnKqQ8BtBUTr9KsdM0yq208bIgBEQmf8', 'w7imCo-oSLeeQ5xQXp98DyzOe5kCmsT8VFUV4hU-AxFUDSE', 0.98, 6, 'Alkabir', 4, 'I'),
(59, '-7lMPmEwvvxSqrBj31So9FJ5UV-PmahhpLYY_Dbcf5dkh5cLkWE4v7nU', '4eFJb775O2tnZgWrTT3a8G4J8Fzgo0Hw1YGJ5vp4Kh9vGIG4', 1.68, 6, 'ReinidraJ', 3, 'I'),
(60, 'iTHYdh6D4xulbWndviOrdlqPBEcFJk9UvTop6MSOd-I', 'BHmPruWtUdqG-DiopXT61vE3X4aMVkrNWNFg_OyLOxDi', 2.37, 6, 'Jaggernaut', 3, 'III'),
(61, 'qj4kTeBIHRXO_ypsdRmQVuBs5xIxbdtJ_bFpk3y85qA', 'qCTlwuO7uMIU_JaZErFoy7I5JlAEAMuqurPEfmlJVe2x', 4.14, 6, 'Tibbiz', 4, 'IV'),
(62, 'zgQmbQx4bw32m5kKGHF-jPoWF6J6vNTyO5iUs0abb62p6A', 'VTuNC4nQFPpCvZDa-e0fDII4xtRLInvj47gtNvmqgZBKHZM', 4.79, 6, 'kantai twintails', 3, 'I'),
(63, 'pUqJPEsqfSpZXEdzPLiu8WhMjp0kif7ywjL8t34GUsijjaU', 's8CyeS-mKghFRJXSUzOutUeMPTBoZEJiwzlMCP8jFFntC0c', 18.4, 5, 'The Nyx Goddess', 5, 'III'),
(64, 'qGkgQYQV1RyLS7KiWqks4JcnHYTAjgQT81ONPPzIELISSA', 'yTNK-3ffeU5a-IROn26la4dC6d79e8YODSKB2olIowBzznM', 4.21, 6, 'Kjersem', 5, 'III'),
(65, '3vjBTFaSoRqYQ9zNk92Cj5LaCvIbRPPkxGN1qBH0hqBeSg', 'lJaTob6Uc2p-GMUI1DCr4jUrWmh9RFAtgoXO71H6QgvBsEU', 3.86, 6, 'TC Tobikop', 4, 'II'),
(66, 'DpjGphQvpiBl05N6e0Kh35K0EvE57xeSL87aZBlHtWvPXw', 'FcopRACee_kGu3ZBXzkJCYAfEKm35sqDQQuEtA1uarrCfYs', 4.53, 6, 'Kos37', 6, 'I'),
(67, 'UsuyEsrWtORf8lMXR0CXQsoPB-wxPgWkVHMST4psYpsp8g0', '8Q53PNRK6JXaj05EKJlM3VdaDU9SBQZIFCXXh3Q_Ptwo7nA', 6.15, 6, 'AI R0t0t3x', 5, 'II'),
(68, 'pVq5ucEmYJCrDCqoVbR2jUFOLQCuwE7Nctb4pc1kLcRZTWs', 'kLceQ5NZxyyX-oWPqiov0fZW6dRF_wL2SZsHlxPRyrIwW_Q', 3.96, 6, 'hadüdü jigakbaak', 5, 'IV'),
(69, '6V6wiCz8kwO6-1nrjWb22OWhQa1819OiiihR-t46DnMhKg', 'PkBxs8AO0WNpI0tOpkSGObN3c-N128Gct6ia_QkjfZeZ2lQ', 1.76, 6, 'Darkalexor', 5, 'IV'),
(70, 'EPNNzvsWQDWZkhC6s86O8JTNURnzmaQXj9vI84IaW4aFToM', 'BEspywAHEqqv7GMskHdkRDJJtelakftynVy0lzAgH8oT_jc', 1.93, 6, 'Silsha', 5, 'IV'),
(71, '-P-rbUGxg529LNKg8EbAPwzY5KazwSqdtkO6me9wHw6t3g', 'E0p-jWjyCV4yqFfcp3KjdFyp767qSukW2jgAWehhHvAEeZc', 2.47, 5, 'XiguDJ', 5, 'IV'),
(72, 'Z-DIsNU-D1WHL13QkHs3a-ZNd-7O1dCexvfPNxBAj0BETA', 'qI0oqXeIeKq0hkaZeMkLggmQndhS8L7VYWB8i9eX2AWe9KA', 2.78, 6, 'SpermDonator', 5, 'IV'),
(73, 'grIL3vUtZlQxHqXyuTGMaxlwFH-Mh65c8IhEPVksiDaRkDM', 'QxEEV6H4-YJw9F2YQIXEa9jwQMNR_I30LOHNT41tfBim_Gc', 4.49, 5, 'Towkol', 6, 'IV'),
(74, 'P_Flc7TEZkL3KRzQ5wOc9d-E01zvkXR_DmC-3HbHoEEVhA', 'p2-vNMvbU5oBISzXhwK6jJj6MMCJRYR-AqzQII8PG7_XSTI', 3.2, 6, 'Fernando Keil', 3, 'III'),
(75, 'lBLImkFPa_AU2MtYXltKShNbANuj2rNN8S6dBd9wZnbEMDE', 'Nl68PwkIHh2D5Ay8oBqBiO6T4LZJZpFLqgmTOXe_tbLL-es', 1.97, 6, 'Gingii', 5, 'II'),
(76, 'dLzfhR0UoTpVzx1lLmZ7cwJiRjsZGm4k3jftkh3kkD9pk_o', 'IwyPJx_nS4nQIFgX_WZmCWB6WZ1a5_8c0ig4ri3TXo5s8oE', 2.12, 6, 'Rhapsody In Red', 4, 'III'),
(77, 'MJn5sY5wB7oIUI8D8-eVLFxsw4VXHZs0NpRlkorvI6H9Ur4', 'w8OpcSW_RY6wV79EEGHyKLCSlaLzOlKuDpMmdB_9KF_RHvU', 2.15, 6, 'Jaggernaut24', 5, 'IV'),
(78, '5ahKuv0HX3YujD2aV-TWiH8CETvT2KvbpI1MHwfiXd5HZRA', '_BRkY0jk3HBm545gbdRmIvTyByTVFFT4xOmttl-f1Ik8B0Y', 1.07, 6, 'Yasuo of Olympus', 6, 'IV'),
(79, 'R1EONu2q8Wweoyma7Br-Y3Q5AYMBqO9KWa7OmP2fcu0n5B4', 'ZkNpbYPIPax-N8T5R6HjCOC8ONx79WNqBFdg3kYyjZIjFxI', 2.27, 6, 'ZYZZ Galaxy IV', 5, 'III'),
(80, '8pfF8sftknVBeb7Woiv5-hZpD9yydMndk8tw_aGcMrVLS7Y', 'mTjMVMPFVWXEky13tWvAk-vLoFpz2gN8SRndvJz-0hKx0N0', 1.31, 6, 'Troollax', 6, 'IV'),
(81, 'X79Wd-_q9nQZtCH9jKgdcmaS-q5KtXJyBikySOkcnan6nA', 'DqAs21jmrjKGySQC6nlS-sTA7wtGqxNQdqwFqfXcul-m2mI', 5.17, 6, 'DlSORDER', 5, 'IV'),
(82, 'pY7S8wY97PRBRiznVKztgRMJZrBl8bBKz8BKJsw4sGBOrQ', 'DUAFJfgVsGZM60WpCi-Rz1Bgl34OT17W3hPju5OmzyFrQNQ', 5.06, 6, 'DC French Keutar', 5, 'III'),
(83, 'ap9TP7nlZYsrASQQtUVvvdrHcdTjnkDYrbUy7sMzyH8bjVs', '1zqJO9-IKsJeHHWimFMnik0obSg10mMgVMovGDT3Z5V8woE', 1.86, 6, 'DC French Tocard', 6, 'IV'),
(84, 'phztNFPGKdqlp_4HYPmPkgsaxK0ini4wRF2o_p72D8WLluM', 'FtjMr8UtSffcV4rSO3dLWjjaaeudz-9u3x2gkM5Rqw27y_E', 2.39, 6, 'ANNIE QLF', 5, 'II'),
(85, 'lFD24P1hEVwzvn75ebS_06HRxCeHRGxivUTxryZl349Zk645CcWStdJJ', '1nFucY2bLe91Lra1UpddGYw0ALu741hQYcohWa9c4IxljvNJ', 2.55, 6, 'Teachertony', 3, 'III'),
(86, 'YWU3tI-CXI1j5rlKm4VmJxC2vsDLMh-HfCxmQAQzwOgR504', '0cC6TtEvbTEquH0wS327uPny_p8yu7Z4HkT37kwqSxZhP9k', 4.91, 6, 'Krasipol', 6, 'IV'),
(87, 'Gy58n3M9sxrBA8G3C9td6OSQKgcdFa_LFlZac4vXNdniutM', 'hmYCvg3gQiOn5wM2tglZvd1r8_6QQQJuiagOdutszXyCrsQ', 7.55, 5, 'SôyBoy', 5, 'I'),
(88, '2QXkFHKb14dNbegGuv8oqa3_JDLYiKosTE0FSubQ5UMhBKc', 'cIoAAvGOkY8KOox9M77-lauDjy0jL8PG7P4MA4P74bIq37I', 2.77, 5, 'LemonStorm', 6, 'IV'),
(89, 'c31NiZV9kdPmm9jwInuJrgClnqhwEmD-Y2FY3sUl6DaxcDg', '0Hu0ggQQUURMZwuYTd3hetbUxcYtZhrfAxGId0R_TfOTIhw', 1.8, 6, 'PumpkinKingx', 4, 'II'),
(90, 'Boe_Y58SIfRuecOnv4ac0B0jIXit8LABo14VQ7XToZzzbQ', '0Vbn4i4KUgXjtY0A8ZQqVLQfTlNR0abDposjzGiCjpi-nHI', 4.74, 6, 'loquisimo', 3, 'III'),
(91, 'yGvNhxJsJEsz3FnBAMNEqJgJJ31YlkacTIsDVtxsCjkEKg', 'FNagr9kk-OzWtocv5lKvyalANfBjoqHUhSz8YUp663sN9nA', 1.82, 5, '1BadMonkey', 4, 'IV'),
(92, 'Jg7qI0x7KN8g6i5_o2zXy7iOSK0aWJgvQoo-1lXISKlEQA', 'UT1QhEBXA0MyfuQqmAxeI_cRIOFKsQz8B8ZDi608E2Lft9Y', 3.75, 6, 'Bas Ghost', 4, 'II'),
(93, '5rxMsE_uLleQq6UKW5jsOVhqF83hP8ViRE2X9w-poy72Dg', 'CnQPwXmezO5mL_6fsQ5O1YQnjoVQB7qF4noB0BYJUS127-E', 3.59, 5, 'Sprühstuhl', 4, 'III'),
(94, 'fkKL-98I3dhTVmSJIzxNnOcXK8WIt3QOAXJpZO1f5G9pJ-g', '-WWSKmGLVEz4j8Ltq0xeTR1ThY8O7kLEclMXgLEG0aYEwxI', 1.89, 6, 'davidqx', 6, 'III'),
(95, 'vydb6z8-lAxayH7k6sWm2-VwleqUMJH6WRthXqBAgm2Q7o8', 'g1rgwuwSv8IVp6AwZ5NbvbbbDzYx61AgsKRtbWNU-w3Bet0', 4.86, 6, 'Mr Del Fuego', 5, 'IV'),
(96, 'hnmRnB0MHuX4i_s_mhPRCC3muiXvqBn35jHhcxw7PIGp_iY', 'ik_Lxo4FWYoTuPQ3LZsZmxdN2SErf50A_o2ZvK82tLrZvcY', 1.55, 6, 'CastilloNegro', 5, 'II'),
(97, 'JeorQJ-Bu_eww8m09MijKlqMGD3m6-equQgF3DU-K_OZGw', 'A9d6_5AI2zVEZbOT6IetxFL30Sn1HmSIkrLETWrSg7GumsA', 1.94, 6, 'EMEN8CH', 3, 'I'),
(98, 'f4XQxyAHOJyTxtNJ42TlIYgvbMjAStQpxmPpr01VDep23qM', 'HJoPWECBTqf5zt_kOOHxnQTbVwPKaSG0W0iRSRcc13UfmhY', 2.24, 6, 'GodSAMme', 6, 'IV'),
(99, 'WXvcWI5gvZDrU4ODDos7e28SA1t-M6Nq-k-S_LjdyY2REw', 'FZ1GFn04ADz8YE6cgZERWhfftEqHEqvvf7B2P87v8_4nF4Q', 4.41, 6, 'NlCOLAY', 4, 'II'),
(100, 'glvuVkadbGXWLMC0wTDTQE9nCea58ldNxL59qA66wwGoUA', '5Xg9u33KpvrMQjwIMtvr9jmpERKFlvsnBnHWHv35Ueg4NX4', 2.02, 6, 'L366O', 5, 'IV'),
(101, 'ZruC_wRxDyi2p4V2MUlmaOd5TTzF1jUwoZYSkd2HR33tRA', 'l7YclcJlHl_oAPNq9QTNVWFv-uyO63g47OId2Bj3wmqDiSA', 8.57, 6, 'xpekeskinke', 5, 'II'),
(102, 'TcBHAYOFiH4ttrBLCrSqo8lts02I22GBuJI_oWKMOD6TmQ', 'Q5sh8YSGKDdKvKSwmopRF2UStyQMNfFGnwg_sRbZE45mXek', 1.74, 6, 'deathroro', 5, 'I'),
(103, '_me7mQMcAgXYVNAfRLmHBUH2M0ag-Kq6SPc1rOegrFFHJ_M', 'xj2l4hnPwLCFChkSaHoSiWNz10gEVf1yzn9FkxPbAdeMVCU', 1.97, 5, 'WKF Korean', 4, 'IV'),
(104, 'R7KreXhuX8yj8n-iBwdpLCZkcyvsOZg6v2dixEhnzZ1zdg', 'mnGwk6b6Obcrz5CFjyz0_E_Oh4yryAbC-7L-ftiYQZ96C44', 3.34, 6, 'Tekwyz', 4, 'III'),
(105, 'JOJ1qBENKonUqmDU9EXR0Bllf4gqcCk-93yrLSrh7kGQdUE', 'sp-XJst5Ztj5f7A67UJlkU9xhA-hC-X_bwJP399P-_BfBdE', 2.94, 5, 'Sch1mmelFlecK', 3, 'I'),
(106, 'vpfGD_EdhHJoNybFApI_4En7d4_ISD1pJzjQrbQq-d1T_Qc', '72WPlXIqbrr6SlW3QUHmIBgokZ3y64He-hELf10nCgxaiqc', 2.37, 6, 'Axelyss', 5, 'IV'),
(107, 'Uzwhvae2zKsSFxaCsvDuMZcsPS2J8u2A1p20CU83oepO0vg0YotRSk8h', 'k8W6I-7heFhFUEpTDg-iI2D-gRhHMVCS2S7tDxlpqobrCy2c', 1.63, 6, 'Kradair2', 4, 'IV'),
(108, '26fL_yQGe1AGzdrp7ImSVXOcBvyW6aWmovCmfk68uUEl54vG8agX3Sdc', 'OqxX-uhEre5TU9UzJHqTTr3xnszz2d8-VA8cul4XTIYnVfu9', 6.65, 6, 'LordQlimax', 6, 'IV'),
(109, 'K_jB_8ReZho8Sj0bJNOjLtth7vJwuViPyyDwexmfKhxfHw', 'RTkOB04K5cwlBU8VDvpPdDlUoywdE1cseAuaMCcQz58i5Bs', 2.63, 6, 'UnicornLover1337', 4, 'I'),
(110, 'ICmPlxaeTAqE7UaUwAN3dDqCuCpQvrlk-W8x8hnjC8X58Q', 'Edj8nUO7nqV2hinN810dx7DV2Kigr1s0iYQJLnXVGpjp9Fc', 5.56, 6, 'Fr0stFienD', 4, 'III'),
(111, 'AklKr4IaqKLpXKTLrhvmxHkteDcVRUkaKq2NEATBl4WXVg', 'ZgE0kxmEuJa8Bz0Dj6wCmK5u-Tv4uH_ca9MvD90_FT1Dh5c', 5.32, 6, 'DavidPhreakT', 4, 'II'),
(112, 'ludimR8lItyquOEdZBgGXvYmrNiSTJ3nBBox9kOxw3QbQw', 'l3UsaY03xxsTHBXCwRith_rRG5aYG5sO_DVDwXjwGYdhmjw', 0.97, 5, '9GAG NFK', 4, 'IV'),
(113, 'yrqsFt8ZP_3b_epOD0QskNgCHBUJOwrmQyRiXoRgU5ukIA', 'v_0MulUy_oKLsWG29D3WrBZLNi-VMHfU13k6W3VaYgu4jUw', 2.66, 6, 'WEEDELONG', 5, 'IV'),
(114, '2uAjwZD0BjgXayatqWSTC6MJYVMoA_uqjqzHXo3kXWjTgQ', 'XefZpPbLjY5WsqOW3HcyQH8QDbf8Ole7mAEXpsdygfHzZ8I', 1.9, 6, 'HurricaneOfHell', 5, 'III'),
(115, 'U_OUaJgprpT4QbiAb0ULXXp7qK2_pqtHGsO-NeCq86pE0w', '-sRzMoj6S4t9dd8tqTAjwDhSfPRvqdgtSSSWqWYgqWuD4_c', 3.06, 6, 'sturop', 4, 'II'),
(116, 'hpk6pphPiRs_9p6XhemcTPac5vx58zzNdlPuKx59K99eDtY', 'Ca4fyUtci-1iPSsFlC6v1z466rAlMaFb_K_gOe8R0mlErOY', 3.99, 5, 'Balenciaga S A', 5, 'IV'),
(117, 'EYYt8zvjH4V4x3xEj9fHYWLZid1E1mzJt-CVX8_zfLq2eoo', 'UUrXjRKCr_KV9tjX3HLBqQ65Zql-wB7Q7GZXb4f7aPeVxhI', 2.77, 5, 'Fâppy', 5, 'IV'),
(118, 'd7dvlWCLWx3r3TvBDlMNBmEWXlEt6_uhv2R_lSQT0RuHOg', 'TjRqYQ8xS_wOsx_ku42RL2ins8cMl_S84i06rn_WojVH7Jo', 2.6, 6, 'PressR CykaBlyat', 5, 'IV'),
(119, '3RBBrhMiNV_Qcv91ABOG73X8Ld8kR8iq-JzxpqrOgdYzPw', 'ITkwOM4XtfLuqxTpchV8sHwg0tMEQwiDBHadBC4f3F7gf3s', 1.7, 5, 'Kíngs', 5, 'IV'),
(120, 'U6lZqqvPI13JKT7DrcK3C8pjkU-E6dGmt1a2MJq8X2iJwA', 'g3FFIcQ9ujeDksumOzCYOYgMIS24M5RUWhsusylHQuSB9kU', 3.21, 5, 'Wauwerino', 4, 'III'),
(121, 'A5AcDkuocL72nKpESSmRNZLXZ-rpY-bbKxPj-IeW6ZUFQUU', 'P2EbqWs6gRU2bfFRtjjxn_voL2S9kYg3cxlrOlLutlQGpUo', 1.65, 6, 'grand daddy og', 5, 'III'),
(122, 'EkuEkDaActH8C8LFggJ8kCIQWdRjnvXwa-37I24iiiSaoSg', 'IXMaSOXma3YxJsWSf8FDSTXVsR6wHp-OoUEfmlmd3hLwEcg', 2.15, 5, 'Pfeffer', 4, 'II'),
(123, 'usxPzq0zXO6-AhIv9ciWB_Yi5ilbPMnUPwcm1v2TEYC7hQ', '4c9TkKnO0M-Mqv1l26O1Oom_nyX950v5NXrR_olD5KhdBSs', 3.72, 6, 'doberpitbull', 4, 'IV'),
(124, 'nui2yRNY8ixAXKWosDa6gC8c8be8DsBJx8RdiqhYiU9YOiY', 'LtLUMg77X97HM4ZMzbJ0p8IChyD0p4h7PUEe4we_TsRuijU', 2.22, 6, 'AxeToHell', 6, 'IV'),
(125, 'AdbMDXZ_QG4u2l1GZLO8gMhESqn9n6s1pJqtAMyS7mRz61Y', 'egkwJYKboxyyCTlgcRY3OOeQCPIKaHWfL0EeQ99Bjt3ySxQ', 2.19, 7, 'Monkey D Peri', 5, 'IV'),
(126, 'JCe6zSLqEyA_aFa_oaPO8mvMKGYu5n6_MezQoyfENf9afRg', 'Sy8J7ZydVKSk9qQtLhG7LVoKfibozEpy2GQh-z5t0m5NpaY', 6.98, 6, 'ImAPentaKite', 4, 'III'),
(127, 'tCD4hp4YdkAo134lVpcWIr0NHUPlbiTUO5z3qvnjtOAdgw', 'xEYL2ZiQhlnce892jBl9W0rTVcUxz6Uuwapi_5KcKh8fVAY', 2.97, 6, 'SaskeczGG', 5, 'II'),
(128, '2xAkGj4DXKjgd-qi65x5bzIRV7wv85TAc7s7V_qEL5v0pPY', 'ZiaUDdHgCbKmuLKNR7ySFprGIz92hfZSQbrFCjZPmyhyRzhd', 4.43, 6, 'Dõdge', 6, 'II'),
(129, 'Q8H4mWHyjXgjKAHGtRV69gSItsOtKeTKfJyCpjEIZVc51gg', 'GdChQyBQkNDl0Qpfq-5G_K8wkoyOEw-HyDbeZaX6uyn26gQ', 1.25, 5, 'PeioCesc', 4, 'III'),
(130, 'kdMnUZ0yTojjRlZHnMeYHKioU4uTR6inhNikkrz_V8lExg', 'ksyiR1o7rZIhs8qFf1fbKhAkQDVvJ9NYjgycutw52H3quZ4', 7.45, 5, 'GUZUZenTox', 5, 'III'),
(131, '-CEhERUMmHtZwnvnzHiWKwuqtPlgtK5lTqZRX7lQOB3v-Q', '-4vdYtfkUkdxTthIA4ldrGH4iKjt2KzEAoQFfhnSzlwArTg', 3.48, 6, 'GUZUN1Tr0MiLZ', 7, 'IV'),
(132, 'babLX4xCjrId-Gw-8VOvS5-oIzylw2ohznXtB1sROzRZpw', 'JFEhYHTniR38xCUHWBF8dPKk8U92UxG6qqEmh6DVMXMLpyw', 7.49, 6, 'YungKiffi', 4, 'II'),
(133, 'AAsxLVjfPjdHR_mmYye11hpgzgToHH2XEkiEjA4K7EtKcQ', '5QBXamgUornvenKC9SIrDNwQ5NWCp4Rxj7WXBfINERKCgIM', 3.49, 6, 'manu261', 6, 'IV'),
(134, 'xESjbv9hweKE6Tss0QPLFsQ9Fa-bUCDfRq0fvx71rHUak9Y', 'tqgRvX0RiWc8GbBXa_CRwCTp93jCwRndr1TaJLUN8uI89JM', 3.57, 6, 'Dabronee', 5, 'I'),
(135, '2jMkGK_2MbAec3SGcQy2fD86bmhKnCLwIn2BMfQrXtPp-g', 'rgLd5EKoS6emEo9yBTbt6Q0nByVzwTDN2L2I3msv_XwIFNk', 3.53, 5, 'Unézik', 5, 'IV'),
(136, '2f3o5iIm63SU-OJnoRH-NkdU6lIEYHJSmA_nHN9ja4cg7Xw', 'VzTv_uf171VavSkxU3mY8o5rGbkMb7k4Mf4xBlqlsAED0ho', 2.39, 6, 'Töuta', 6, 'IV'),
(137, 'uPpF3SmDSRX8g05mjuTvFplGbygLnMpNA8cXPkgG4DcRXv4', '4iAHBleC4BTWR1_Qv-_7f2gf0GiDAsQyDcOAKxT4j7YdjTI', 3.06, 6, 'GreenDaddy993', 4, 'I'),
(138, 'LgWnYX7msARKSKUynIDRyqSYOuO7ZIYYyppYzdbF6bk', 'yjwbsSJq_v-hr0GRrKYOiHF3PuhPhEkKL4PD3oHFr8px', 4.27, 6, 'Kippokastkniv', 5, 'IV'),
(139, 'oiyn2jOF4qLgSLXaOdZP1f_2HqmaKNmEpFHCV9aIuEvf6g', '1IAMj69sQQVVI2sA6fJGO1ugc6JkanyGQt0Fz2zWwGVDrrQ', 1.79, 6, 'Kungklaas', 5, 'III'),
(140, 'jro7hF92x-Te3lXuYjFg6eKglLAjAHP9KKD74qcTcIrgmQ', 'BHos9OnMJQ-L9fxqjIwDmnZMWELA79MX_LG_Nlwh7DRmu_Q', 6.2, 6, 'Clorky', 4, 'II'),
(141, 'LO2Shma5HZBmxHwlk7B00bqViV3WTXezfMCiHyijURSJTg', 'w7GTDJJXLqmPCrZL_lN_HhdQIYAN7y37o4ESlXmt1d2AKA8', 2.07, 6, ' Anárion', 5, 'III'),
(142, 'pjP1F-T1FJhYeS1rHflkO5Ja-kUv0br0FXrGTbcJ7LiVvw', 'vdP03MaSTuKG53Xk8Ync0niykp0mXoJe4gfb-zqASnGFv2E', 2.9, 6, 'Lamora34', 5, 'I'),
(143, 's-dcVYunU8BMaxN6oDYA_ZO4VKxVHx9TgajF9KPX_YCW0l0', 'vk7U_MOvdgY3Y0_07Rn_SJ-HeKdf15gIWeTSjLwF0owlkVE', 3.02, 6, 'm4sharu REFORMED', 4, 'I'),
(144, '17OzUZZddwN5spx1awIGbbeMCSBJqIW5vu6D213jcahAkU0', 'CBaLbUwmrtYyMmoC6ZIL8bTyM0jsxf9KuCCGS-dz1oi4ung', 2.98, 6, 'pls nerf uber', 5, 'III'),
(145, 'Y4G9bj5cPrzRJTy55kSNg-0Qdo_-XUP-_2bKDWbdoQ3QViI', 'giO3ukNK1hN95935IFxeykCvfZ7chTKd4FVFUE5gRJW1LN8', 4.71, 99, 'NashiraK', 3, 'I'),
(146, 'IBOhen6tF6en3XEsAa1GGHKuh91QcOB-a1zrDNpDlsyxWw', 'drpo4Fffhb6GRT1ZtVBulYPjyfY6U6-yrTE2kB1M8RV--jM', 2.05, 6, 'Temzelder', 5, 'IV'),
(147, 'MHFH5-BKRyemLvJhPMGyMU5EWuKTiQGQ7b3d9xeaOED355c', '7hZpdyozABX9aeGR-CbOjoOMjZz0jomyN2NTm3TcKJEcTfo', 6.11, 6, 'sergiciru', 4, 'II'),
(148, 'WrEAr4NscOgl66K-2VNcbApywJwtUoLg-Js23oc-N7oHVg', '7bAxmjItTGgsdaGthIVIMtEAnHTJRJ5-rIUxpJyJlOwfgVE', 2.21, 6, 'Kurohigee', 5, 'IV'),
(149, '4yYDpUxjli4Oug3ER4eP8_yRoEsGJgnZgi4Vu08Pf2O8Xqw', 'NnPiHWI_2rI34Qvl5iDgjBrWd0Mw_HRMUaPkT_w3061QxPw', 2.75, 6, 'Mµgetsµ', 5, 'III'),
(150, 'Pf8JGMqgNm15evAvqr81AComotX291Vjc-KMdi_6-yD2fg', 'w6kU-OJyoWj_ecUW_Jkt8q2x1n8iQB5_NXQGm_I7R-KLhtI', 3.21, 6, 'AkumaNoKo', 3, 'IV'),
(151, 'AZuIxCS92Q8cXMeZko-yK_y2sCKTl5ZNA0yMeuANQUwWNA', 'lrllLf9RGH94qDTfx_ifvXcu1-aDK2QhS7h1jmM2uj_VSmk', 3.32, 100, 'Amazing Onichan', 5, 'III'),
(152, 'sample', 'sample', 3, 1, 'Top Sample', 1, 'I'),
(153, 'sample', 'sample', 3, 1, 'Jungle Sample', 1, 'I'),
(154, 'sample', 'sample', 3, 1, 'Mid Sample', 1, 'I'),
(155, 'sample', 'sample', 3, 1, 'Adc Sample', 1, 'I'),
(156, 'sample', 'sample', 3, 1, 'Support Sample', 1, 'I'),
(157, 'lQ2ac0Xg4v50p31qYydxnzZEBf5qlYVsS7H01h0BuIRXsKQ', 'Wb3_es4EkXQlrz-WxtBQb7P9p0tm2fmLz25eC5mw-TRf6dI', 3.78, 99, 'victorcr', 3, 'I'),
(158, '5qXfJQLA8zPD81RXs2r2a9AVTWQZeB4fTvli2_3BesJkKr4', '7i8_pKmxq-5p1fXY1AAH5meSCWhWchUadBdVZIVVxwGKuCQ', 3.07, 24, 'D3VILJHO', 5, 'I');

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
-- Indices de la tabla `matchhistory`
--
ALTER TABLE `matchhistory`
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
  MODIFY `idCard` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=38;
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
  MODIFY `idManager` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;
--
-- AUTO_INCREMENT de la tabla `matchhistory`
--
ALTER TABLE `matchhistory`
  MODIFY `idGame` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;
--
-- AUTO_INCREMENT de la tabla `player`
--
ALTER TABLE `player`
  MODIFY `idPlayer` mediumint(9) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=159;
--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `equipamiento`
--
ALTER TABLE `equipamiento`
  ADD CONSTRAINT `equipamiento_ibfk_1` FOREIGN KEY (`idManager`) REFERENCES `manager` (`idManager`);

--
-- Filtros para la tabla `matchhistory`
--
ALTER TABLE `matchhistory`
  ADD CONSTRAINT `matchhistory_ibfk_1` FOREIGN KEY (`idManager1`) REFERENCES `manager` (`idManager`),
  ADD CONSTRAINT `matchhistory_ibfk_2` FOREIGN KEY (`idManager2`) REFERENCES `manager` (`idManager`);

--
-- Filtros para la tabla `player`
--
ALTER TABLE `player`
  ADD CONSTRAINT `player_ibfk_1` FOREIGN KEY (`leagueId`) REFERENCES `league` (`leagueid`);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

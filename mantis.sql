-- phpMyAdmin SQL Dump
-- version 4.5.1
-- http://www.phpmyadmin.net
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 24-06-2017 a las 21:27:25
-- Versión del servidor: 10.1.19-MariaDB
-- Versión de PHP: 7.0.13

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `mantis`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `jugadores`
--

CREATE TABLE `jugadores` (
  `nombre` varchar(25) COLLATE utf8mb4_spanish2_ci NOT NULL,
  `contrasena` varchar(25) COLLATE utf8mb4_spanish2_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_spanish2_ci;

--
-- Volcado de datos para la tabla `jugadores`
--

INSERT INTO `jugadores` (`nombre`, `contrasena`) VALUES
('ras', '$2y$10$o0oUgPsC8kYn/4f0fJ');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `participan`
--

CREATE TABLE `participan` (
  `nombre` varchar(25) COLLATE utf8mb4_spanish2_ci NOT NULL,
  `idtorneo` smallint(6) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_spanish2_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tienenmazo`
--

CREATE TABLE `tienenmazo` (
  `nombre` varchar(25) COLLATE utf8mb4_spanish2_ci NOT NULL,
  `mazo` varchar(25) COLLATE utf8mb4_spanish2_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_spanish2_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `torneos`
--

CREATE TABLE `torneos` (
  `idtorneo` smallint(6) NOT NULL,
  `fecha` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `ganatorneo` varchar(25) COLLATE utf8mb4_spanish2_ci DEFAULT NULL,
  `mazoganador` varchar(25) COLLATE utf8mb4_spanish2_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_spanish2_ci;

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `jugadores`
--
ALTER TABLE `jugadores`
  ADD PRIMARY KEY (`nombre`);

--
-- Indices de la tabla `participan`
--
ALTER TABLE `participan`
  ADD PRIMARY KEY (`nombre`,`idtorneo`),
  ADD KEY `FK_PART` (`idtorneo`);

--
-- Indices de la tabla `tienenmazo`
--
ALTER TABLE `tienenmazo`
  ADD PRIMARY KEY (`nombre`,`mazo`);

--
-- Indices de la tabla `torneos`
--
ALTER TABLE `torneos`
  ADD PRIMARY KEY (`idtorneo`);

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `participan`
--
ALTER TABLE `participan`
  ADD CONSTRAINT `FK_PAR` FOREIGN KEY (`nombre`) REFERENCES `jugadores` (`nombre`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `FK_PART` FOREIGN KEY (`idtorneo`) REFERENCES `torneos` (`idtorneo`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `tienenmazo`
--
ALTER TABLE `tienenmazo`
  ADD CONSTRAINT `FK_TMAZO` FOREIGN KEY (`nombre`) REFERENCES `jugadores` (`nombre`) ON DELETE CASCADE ON UPDATE CASCADE;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

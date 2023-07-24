-- phpMyAdmin SQL Dump
-- version 5.0.3
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 23-07-2023 a las 15:29:56
-- Versión del servidor: 10.4.14-MariaDB
-- Versión de PHP: 7.4.11

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `pilar`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `escuelaprofesional`
--

CREATE TABLE `escuelaprofesional` (
  `id` int(11) NOT NULL,
  `Nombres` varchar(15) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `escuelaprofesional`
--

INSERT INTO `escuelaprofesional` (`id`, `Nombres`) VALUES
(1, 'Ingeniería de S'),
(2, 'Ingeniería Civi');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `especialidad`
--

CREATE TABLE `especialidad` (
  `id` int(11) NOT NULL,
  `Nombres` varchar(45) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `especialidad`
--

INSERT INTO `especialidad` (`id`, `Nombres`) VALUES
(1, 'TEORÍA DE SISTEMAS Y ADMINISTRACIÓN DE SISTEM'),
(2, 'SISTEMAS DISTRIBUIDOS, REDES Y TELEMATICA');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `jurados`
--

CREATE TABLE `jurados` (
  `id` int(11) NOT NULL,
  `Nombres` varchar(15) NOT NULL,
  `ApellidoPaterno` varchar(25) NOT NULL,
  `Apellidomaterno` varchar(25) NOT NULL,
  `Celular` char(9) NOT NULL,
  `Dni` char(8) NOT NULL,
  `Email` varchar(25) NOT NULL,
  `Contraseña` varchar(25) NOT NULL,
  `Realizado` tinyint(4) NOT NULL,
  `EscuelaProfesional_Id` int(11) NOT NULL,
  `Especialidad_Id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `jurados`
--

INSERT INTO `jurados` (`id`, `Nombres`, `ApellidoPaterno`, `Apellidomaterno`, `Celular`, `Dni`, `Email`, `Contraseña`, `Realizado`, `EscuelaProfesional_Id`, `Especialidad_Id`) VALUES
(1, 'Julio Cesar ', 'Hallasi', 'Ambrocio', '915255446', '02345673', 'julitohallasi@gmail.com', 'julio1234', 0, 1, 1),
(2, 'Dany', 'Salcca', 'Lagar', '991496233', '02016897', 'dsalccal@est.unap.edu.pe', 'dany1234', 0, 1, 1),
(3, 'Percy', 'Condori ', 'Yucra', '910533726', '02345673', 'pcondoriyu@est.unap.edu.p', 'percy1234', 0, 1, 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `notificacionjurado`
--

CREATE TABLE `notificacionjurado` (
  `id` int(11) NOT NULL,
  `Descripcion` varchar(45) NOT NULL,
  `contenido` text NOT NULL,
  `Fecha` date NOT NULL,
  `hora` time NOT NULL,
  `Tipo` varchar(25) NOT NULL,
  `Jurado_Id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `notificaciontesista`
--

CREATE TABLE `notificaciontesista` (
  `id` int(11) NOT NULL,
  `Descripcion` varchar(45) NOT NULL,
  `contenido` text NOT NULL,
  `Fecha` date NOT NULL,
  `hora` time NOT NULL,
  `Tipo` varchar(25) NOT NULL,
  `Tesista_Id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `proyectotesis`
--

CREATE TABLE `proyectotesis` (
  `id` int(11) NOT NULL,
  `Titulo` varchar(45) NOT NULL,
  `Documento` varchar(50) NOT NULL,
  `Codigo` varchar(25) NOT NULL,
  `Estado` tinyint(4) NOT NULL,
  `Tesista_Id` int(11) NOT NULL,
  `Especialidad_Id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `recordatoriojurado`
--

CREATE TABLE `recordatoriojurado` (
  `id` int(11) NOT NULL,
  `Fecha` date NOT NULL,
  `Hora` time NOT NULL,
  `Descripcion` varchar(50) NOT NULL,
  `Tipo` varchar(25) NOT NULL,
  `Jurado_Id` int(11) NOT NULL,
  `contenido` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `recordatoriotesista`
--

CREATE TABLE `recordatoriotesista` (
  `id` int(11) NOT NULL,
  `Fecha` date NOT NULL,
  `Hora` time NOT NULL,
  `Descripcion` varchar(50) NOT NULL,
  `Tipo` varchar(25) NOT NULL,
  `Tesista_Id` int(11) NOT NULL,
  `contenido` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tesista`
--

CREATE TABLE `tesista` (
  `id` int(11) NOT NULL,
  `Nombres` varchar(15) NOT NULL,
  `ApellidoPaterno` varchar(25) NOT NULL,
  `Apellidomaterno` varchar(25) NOT NULL,
  `Celular` char(9) CHARACTER SET utf8 NOT NULL,
  `Codigo` char(6) NOT NULL,
  `Dni` char(8) NOT NULL,
  `Email` varchar(25) NOT NULL,
  `Contraseña` varchar(25) NOT NULL,
  `EscuelaProfesional_Id` int(11) NOT NULL,
  `Jurado_1` int(11) NOT NULL,
  `Jurado_2` int(11) NOT NULL,
  `Jurado_3` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `tesista`
--

INSERT INTO `tesista` (`id`, `Nombres`, `ApellidoPaterno`, `Apellidomaterno`, `Celular`, `Codigo`, `Dni`, `Email`, `Contraseña`, `EscuelaProfesional_Id`, `Jurado_1`, `Jurado_2`, `Jurado_3`) VALUES
(1, 'Kevin Arnold', 'Jallurani', 'Ruelas', '930913768', '191874', '02345673', 'kjalluranir@est.unap.edu.', 'kevin1234', 1, 1, 2, 3);

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `escuelaprofesional`
--
ALTER TABLE `escuelaprofesional`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `especialidad`
--
ALTER TABLE `especialidad`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `jurados`
--
ALTER TABLE `jurados`
  ADD PRIMARY KEY (`id`),
  ADD KEY `EscuelaProfesional_Id` (`EscuelaProfesional_Id`),
  ADD KEY `Especialidad_Id` (`Especialidad_Id`);

--
-- Indices de la tabla `notificacionjurado`
--
ALTER TABLE `notificacionjurado`
  ADD PRIMARY KEY (`id`),
  ADD KEY `Jurado_Id` (`Jurado_Id`);

--
-- Indices de la tabla `notificaciontesista`
--
ALTER TABLE `notificaciontesista`
  ADD PRIMARY KEY (`id`),
  ADD KEY `Tesista_Id` (`Tesista_Id`);

--
-- Indices de la tabla `proyectotesis`
--
ALTER TABLE `proyectotesis`
  ADD PRIMARY KEY (`id`),
  ADD KEY `Tesista_Id` (`Tesista_Id`),
  ADD KEY `Especialidad_Id` (`Especialidad_Id`);

--
-- Indices de la tabla `recordatoriojurado`
--
ALTER TABLE `recordatoriojurado`
  ADD PRIMARY KEY (`id`),
  ADD KEY `Jurado_Id` (`Jurado_Id`);

--
-- Indices de la tabla `recordatoriotesista`
--
ALTER TABLE `recordatoriotesista`
  ADD PRIMARY KEY (`id`),
  ADD KEY `Tesista_Id` (`Tesista_Id`);

--
-- Indices de la tabla `tesista`
--
ALTER TABLE `tesista`
  ADD PRIMARY KEY (`id`),
  ADD KEY `EscuelaProfesional_Id` (`EscuelaProfesional_Id`),
  ADD KEY `Jurado_1` (`Jurado_1`),
  ADD KEY `Jurado_2` (`Jurado_2`),
  ADD KEY `Jurado_3` (`Jurado_3`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `escuelaprofesional`
--
ALTER TABLE `escuelaprofesional`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT de la tabla `especialidad`
--
ALTER TABLE `especialidad`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT de la tabla `jurados`
--
ALTER TABLE `jurados`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT de la tabla `notificacionjurado`
--
ALTER TABLE `notificacionjurado`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `notificaciontesista`
--
ALTER TABLE `notificaciontesista`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `proyectotesis`
--
ALTER TABLE `proyectotesis`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `recordatoriojurado`
--
ALTER TABLE `recordatoriojurado`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `recordatoriotesista`
--
ALTER TABLE `recordatoriotesista`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `tesista`
--
ALTER TABLE `tesista`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `jurados`
--
ALTER TABLE `jurados`
  ADD CONSTRAINT `jurados_ibfk_1` FOREIGN KEY (`EscuelaProfesional_Id`) REFERENCES `escuelaprofesional` (`id`),
  ADD CONSTRAINT `jurados_ibfk_2` FOREIGN KEY (`Especialidad_Id`) REFERENCES `especialidad` (`id`);

--
-- Filtros para la tabla `notificacionjurado`
--
ALTER TABLE `notificacionjurado`
  ADD CONSTRAINT `notificacionjurado_ibfk_1` FOREIGN KEY (`Jurado_Id`) REFERENCES `jurados` (`id`);

--
-- Filtros para la tabla `notificaciontesista`
--
ALTER TABLE `notificaciontesista`
  ADD CONSTRAINT `notificaciontesista_ibfk_1` FOREIGN KEY (`Tesista_Id`) REFERENCES `tesista` (`id`);

--
-- Filtros para la tabla `proyectotesis`
--
ALTER TABLE `proyectotesis`
  ADD CONSTRAINT `proyectotesis_ibfk_1` FOREIGN KEY (`Tesista_Id`) REFERENCES `tesista` (`id`),
  ADD CONSTRAINT `proyectotesis_ibfk_2` FOREIGN KEY (`Especialidad_Id`) REFERENCES `especialidad` (`id`);

--
-- Filtros para la tabla `recordatoriojurado`
--
ALTER TABLE `recordatoriojurado`
  ADD CONSTRAINT `recordatoriojurado_ibfk_1` FOREIGN KEY (`Jurado_Id`) REFERENCES `jurados` (`id`);

--
-- Filtros para la tabla `recordatoriotesista`
--
ALTER TABLE `recordatoriotesista`
  ADD CONSTRAINT `recordatoriotesista_ibfk_1` FOREIGN KEY (`Tesista_Id`) REFERENCES `tesista` (`id`);

--
-- Filtros para la tabla `tesista`
--
ALTER TABLE `tesista`
  ADD CONSTRAINT `tesista_ibfk_1` FOREIGN KEY (`EscuelaProfesional_Id`) REFERENCES `escuelaprofesional` (`id`),
  ADD CONSTRAINT `tesista_ibfk_2` FOREIGN KEY (`Jurado_1`) REFERENCES `jurados` (`id`),
  ADD CONSTRAINT `tesista_ibfk_3` FOREIGN KEY (`Jurado_2`) REFERENCES `jurados` (`id`),
  ADD CONSTRAINT `tesista_ibfk_4` FOREIGN KEY (`Jurado_3`) REFERENCES `jurados` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

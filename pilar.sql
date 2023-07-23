-- phpMyAdmin SQL Dump
-- version 5.0.3
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 24-07-2023 a las 01:07:30
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
(2, 'INGENIERÍA COMPUTACIONAL Y SISTEMAS');

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
  `Email` varchar(45) NOT NULL,
  `Contraseña` varchar(25) NOT NULL,
  `Realizado` tinyint(4) NOT NULL,
  `EscuelaProfesional_Id` int(11) NOT NULL,
  `Especialidad_Id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `jurados`
--

INSERT INTO `jurados` (`id`, `Nombres`, `ApellidoPaterno`, `Apellidomaterno`, `Celular`, `Dni`, `Email`, `Contraseña`, `Realizado`, `EscuelaProfesional_Id`, `Especialidad_Id`) VALUES
(1, 'Julio Cesar ', 'Hallasi', 'Ambrocio', '915255446', '02345673', 'julitohallasi@gmail.com', 'julio1234', 1, 1, 1),
(2, 'Dany', 'Salcca', 'Lagar', '991496233', '02016897', 'dsalccal@est.unap.edu.pe', 'dany1234', 0, 1, 1),
(3, 'Percy', 'Condori ', 'Yucra', '910533726', '02345673', 'pecondoriyu@est.unap.edu.pe', 'percy1234', 0, 1, 1);

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
  `leido` tinyint(4) NOT NULL,
  `Jurado_Id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `notificacionjurado`
--

INSERT INTO `notificacionjurado` (`id`, `Descripcion`, `contenido`, `Fecha`, `hora`, `Tipo`, `leido`, `Jurado_Id`) VALUES
(1, 'Notificacion de correccion del Proyecto de Te', '\r\nEstimado Jurado,\r\nEspero que esté teniendo un buen día. Quería informarle que se ha subido una nueva versión corregida del proyecto de tesis. \r\nEl archivo actualizado está disponible para su revisión y evaluación.\r\nAgradezco mucho su tiempo y esfuerzo dedicados a la revisión del proyecto.', '2023-07-23', '13:52:48', 'Email', 0, 3),
(2, 'Asunto: Corrección del Proyecto de Tesis', '\r\nEstimado Jurado,\r\nLe informo que se ha realizado las correcciones en el proyecto de tesis y ya está disponible para su revisión en la plataforma Pilar. \r\nAgradezco su tiempo y quedo atento/a a cualquier consulta.\r\nGracias y saludos cordiales', '2023-07-23', '14:19:46', 'SMS', 0, 1),
(3, 'Asunto: Subida del Proyecto de Tesis', '', '2023-07-23', '14:22:45', 'SMS', 0, 1),
(4, 'Asunto: Subida del Proyecto de Tesis', '', '2023-07-23', '14:22:46', 'SMS', 0, 2),
(5, 'Asunto: Subida del Proyecto de Tesis', '', '2023-07-23', '14:22:48', 'SMS', 0, 3),
(6, 'Notificacion de Subida del Proyecto de Tesis', '\r\nEstimado Jurado,\r\nEspero que esté teniendo un buen día. Quería informarle que se ha subido una nuevo proyecto de tesis. \r\nEl archivo actualizado está disponible para su revisión y evaluación.\r\nAgradezco mucho su tiempo y esfuerzo dedicados a la revisión del proyecto.', '2023-07-23', '14:22:52', 'Email', 0, 1),
(7, 'Notificacion de Subida del Proyecto de Tesis', '\r\nEstimado Jurado,\r\nEspero que esté teniendo un buen día. Quería informarle que se ha subido una nuevo proyecto de tesis. \r\nEl archivo actualizado está disponible para su revisión y evaluación.\r\nAgradezco mucho su tiempo y esfuerzo dedicados a la revisión del proyecto.', '2023-07-23', '14:22:55', 'Email', 0, 2),
(8, 'Notificacion de Subida del Proyecto de Tesis', '\r\nEstimado Jurado,\r\nEspero que esté teniendo un buen día. Quería informarle que se ha subido una nuevo proyecto de tesis. \r\nEl archivo actualizado está disponible para su revisión y evaluación.\r\nAgradezco mucho su tiempo y esfuerzo dedicados a la revisión del proyecto.', '2023-07-23', '14:22:58', 'Email', 0, 3),
(9, 'Notificacion de Subida del Proyecto de Tesis', '\r\nEstimado Jurado,\r\nEspero que esté teniendo un buen día. Quería informarle que se ha subido una nuevo proyecto de tesis. \r\nEl archivo actualizado está disponible para su revisión y evaluación.\r\nAgradezco mucho su tiempo y esfuerzo dedicados a la revisión del proyecto.', '2023-07-23', '14:29:28', 'Email', 0, 1),
(10, 'Notificacion de Subida del Proyecto de Tesis', '\r\nEstimado Jurado,\r\nEspero que esté teniendo un buen día. Quería informarle que se ha subido una nuevo proyecto de tesis. \r\nEl archivo actualizado está disponible para su revisión y evaluación.\r\nAgradezco mucho su tiempo y esfuerzo dedicados a la revisión del proyecto.', '2023-07-23', '14:29:31', 'Email', 0, 2),
(11, 'Notificacion de Subida del Proyecto de Tesis', '\r\nEstimado Jurado,\r\nEspero que esté teniendo un buen día. Quería informarle que se ha subido una nuevo proyecto de tesis. \r\nEl archivo actualizado está disponible para su revisión y evaluación.\r\nAgradezco mucho su tiempo y esfuerzo dedicados a la revisión del proyecto.', '2023-07-23', '14:29:34', 'Email', 0, 3),
(12, 'Asunto: Corrección del Proyecto de Tesis', '\r\nEstimado Jurado,\r\nLe informo que se ha realizado las correcciones en el proyecto de tesis y ya está disponible para su revisión en la plataforma Pilar. \r\nAgradezco su tiempo y quedo atento/a a cualquier consulta.\r\nGracias y saludos cordiales', '2023-07-23', '16:26:57', 'SMS', 0, 1),
(13, 'Asunto: Corrección del Proyecto de Tesis', '\r\nEstimado Jurado,\r\nLe informo que se ha realizado las correcciones en el proyecto de tesis y ya está disponible para su revisión en la plataforma Pilar. \r\nAgradezco su tiempo y quedo atento/a a cualquier consulta.\r\nGracias y saludos cordiales', '2023-07-23', '16:26:59', 'SMS', 0, 2),
(14, 'Asunto: Corrección del Proyecto de Tesis', '\r\nEstimado Jurado,\r\nLe informo que se ha realizado las correcciones en el proyecto de tesis y ya está disponible para su revisión en la plataforma Pilar. \r\nAgradezco su tiempo y quedo atento/a a cualquier consulta.\r\nGracias y saludos cordiales', '2023-07-23', '16:27:00', 'SMS', 0, 3),
(15, 'Notificacion de correccion del Proyecto de Te', '\r\nEstimado Jurado,\r\nEspero que esté teniendo un buen día. Quería informarle que se ha subido una nueva versión corregida del proyecto de tesis. \r\nEl archivo actualizado está disponible para su revisión y evaluación.\r\nAgradezco mucho su tiempo y esfuerzo dedicados a la revisión del proyecto.', '2023-07-23', '16:27:04', 'Email', 0, 1),
(16, 'Notificacion de correccion del Proyecto de Te', '\r\nEstimado Jurado,\r\nEspero que esté teniendo un buen día. Quería informarle que se ha subido una nueva versión corregida del proyecto de tesis. \r\nEl archivo actualizado está disponible para su revisión y evaluación.\r\nAgradezco mucho su tiempo y esfuerzo dedicados a la revisión del proyecto.', '2023-07-23', '16:27:07', 'Email', 0, 2),
(17, 'Notificacion de correccion del Proyecto de Te', '\r\nEstimado Jurado,\r\nEspero que esté teniendo un buen día. Quería informarle que se ha subido una nueva versión corregida del proyecto de tesis. \r\nEl archivo actualizado está disponible para su revisión y evaluación.\r\nAgradezco mucho su tiempo y esfuerzo dedicados a la revisión del proyecto.', '2023-07-23', '16:27:10', 'Email', 0, 3),
(18, 'Notificacion de Subida del Proyecto de Tesis', '\r\nEstimado Jurado,\r\nEspero que esté teniendo un buen día. Quería informarle que se ha subido una nuevo proyecto de tesis. \r\nEl archivo actualizado está disponible para su revisión y evaluación.\r\nAgradezco mucho su tiempo y esfuerzo dedicados a la revisión del proyecto.', '2023-07-23', '16:28:41', 'Email', 0, 1),
(19, 'Notificacion de Subida del Proyecto de Tesis', '\r\nEstimado Jurado,\r\nEspero que esté teniendo un buen día. Quería informarle que se ha subido una nuevo proyecto de tesis. \r\nEl archivo actualizado está disponible para su revisión y evaluación.\r\nAgradezco mucho su tiempo y esfuerzo dedicados a la revisión del proyecto.', '2023-07-23', '16:28:44', 'Email', 0, 2),
(20, 'Notificacion de Subida del Proyecto de Tesis', '\r\nEstimado Jurado,\r\nEspero que esté teniendo un buen día. Quería informarle que se ha subido una nuevo proyecto de tesis. \r\nEl archivo actualizado está disponible para su revisión y evaluación.\r\nAgradezco mucho su tiempo y esfuerzo dedicados a la revisión del proyecto.', '2023-07-23', '16:28:47', 'Email', 0, 3),
(21, 'Asunto: Subida del Proyecto de Tesis', '\r\nEstimado Jurado,\r\nLe informo que se ha realizado la subida de un proyecto de tesis y ya está disponible para su revisión en la plataforma Pilar. \r\nAgradezco su tiempo y quedo atento/a a cualquier consulta.\r\nGracias y saludos cordiales', '2023-07-23', '16:30:12', 'SMS', 0, 1),
(22, 'Asunto: Subida del Proyecto de Tesis', '\r\nEstimado Jurado,\r\nLe informo que se ha realizado la subida de un proyecto de tesis y ya está disponible para su revisión en la plataforma Pilar. \r\nAgradezco su tiempo y quedo atento/a a cualquier consulta.\r\nGracias y saludos cordiales', '2023-07-23', '16:30:13', 'SMS', 0, 2),
(23, 'Asunto: Subida del Proyecto de Tesis', '\r\nEstimado Jurado,\r\nLe informo que se ha realizado la subida de un proyecto de tesis y ya está disponible para su revisión en la plataforma Pilar. \r\nAgradezco su tiempo y quedo atento/a a cualquier consulta.\r\nGracias y saludos cordiales', '2023-07-23', '16:30:14', 'SMS', 0, 3),
(24, 'Notificacion de Subida del Proyecto de Tesis', '\r\nEstimado Jurado,\r\nEspero que esté teniendo un buen día. Quería informarle que se ha subido una nuevo proyecto de tesis. \r\nEl archivo actualizado está disponible para su revisión y evaluación.\r\nAgradezco mucho su tiempo y esfuerzo dedicados a la revisión del proyecto.', '2023-07-23', '16:30:18', 'Email', 0, 1),
(25, 'Notificacion de Subida del Proyecto de Tesis', '\r\nEstimado Jurado,\r\nEspero que esté teniendo un buen día. Quería informarle que se ha subido una nuevo proyecto de tesis. \r\nEl archivo actualizado está disponible para su revisión y evaluación.\r\nAgradezco mucho su tiempo y esfuerzo dedicados a la revisión del proyecto.', '2023-07-23', '16:30:21', 'Email', 0, 2),
(26, 'Notificacion de Subida del Proyecto de Tesis', '\r\nEstimado Jurado,\r\nEspero que esté teniendo un buen día. Quería informarle que se ha subido una nuevo proyecto de tesis. \r\nEl archivo actualizado está disponible para su revisión y evaluación.\r\nAgradezco mucho su tiempo y esfuerzo dedicados a la revisión del proyecto.', '2023-07-23', '16:30:24', 'Email', 0, 3),
(27, 'Asunto: Subida del Proyecto de Tesis', '\r\nEstimado Jurado,\r\nLe informo que se ha realizado la subida de un proyecto de tesis y ya está disponible para su revisión en la plataforma Pilar. \r\nAgradezco su tiempo y quedo atento/a a cualquier consulta.\r\nGracias y saludos cordiales', '2023-07-23', '16:37:35', 'SMS', 0, 1),
(28, 'Asunto: Subida del Proyecto de Tesis', '\r\nEstimado Jurado,\r\nLe informo que se ha realizado la subida de un proyecto de tesis y ya está disponible para su revisión en la plataforma Pilar. \r\nAgradezco su tiempo y quedo atento/a a cualquier consulta.\r\nGracias y saludos cordiales', '2023-07-23', '16:37:36', 'SMS', 0, 2),
(29, 'Asunto: Subida del Proyecto de Tesis', '\r\nEstimado Jurado,\r\nLe informo que se ha realizado la subida de un proyecto de tesis y ya está disponible para su revisión en la plataforma Pilar. \r\nAgradezco su tiempo y quedo atento/a a cualquier consulta.\r\nGracias y saludos cordiales', '2023-07-23', '16:37:38', 'SMS', 0, 3),
(30, 'Asunto: Subida del Proyecto de Tesis', '\r\nEstimado Jurado,\r\nLe informo que se ha realizado la subida de un proyecto de tesis y ya está disponible para su revisión en la plataforma Pilar. \r\nAgradezco su tiempo y quedo atento/a a cualquier consulta.\r\nGracias y saludos cordiales', '2023-07-23', '16:37:39', 'SMS', 0, 1),
(31, 'Asunto: Subida del Proyecto de Tesis', '\r\nEstimado Jurado,\r\nLe informo que se ha realizado la subida de un proyecto de tesis y ya está disponible para su revisión en la plataforma Pilar. \r\nAgradezco su tiempo y quedo atento/a a cualquier consulta.\r\nGracias y saludos cordiales', '2023-07-23', '16:37:39', 'SMS', 0, 2),
(32, 'Asunto: Subida del Proyecto de Tesis', '\r\nEstimado Jurado,\r\nLe informo que se ha realizado la subida de un proyecto de tesis y ya está disponible para su revisión en la plataforma Pilar. \r\nAgradezco su tiempo y quedo atento/a a cualquier consulta.\r\nGracias y saludos cordiales', '2023-07-23', '16:37:40', 'SMS', 0, 3),
(33, 'Notificacion de Subida del Proyecto de Tesis', '\r\nEstimado Jurado,\r\nEspero que esté teniendo un buen día. Quería informarle que se ha subido una nuevo proyecto de tesis. \r\nEl archivo actualizado está disponible para su revisión y evaluación.\r\nAgradezco mucho su tiempo y esfuerzo dedicados a la revisión del proyecto.', '2023-07-23', '16:37:44', 'Email', 0, 1),
(34, 'Notificacion de Subida del Proyecto de Tesis', '\r\nEstimado Jurado,\r\nEspero que esté teniendo un buen día. Quería informarle que se ha subido una nuevo proyecto de tesis. \r\nEl archivo actualizado está disponible para su revisión y evaluación.\r\nAgradezco mucho su tiempo y esfuerzo dedicados a la revisión del proyecto.', '2023-07-23', '16:37:48', 'Email', 0, 2),
(35, 'Notificacion de Subida del Proyecto de Tesis', '\r\nEstimado Jurado,\r\nEspero que esté teniendo un buen día. Quería informarle que se ha subido una nuevo proyecto de tesis. \r\nEl archivo actualizado está disponible para su revisión y evaluación.\r\nAgradezco mucho su tiempo y esfuerzo dedicados a la revisión del proyecto.', '2023-07-23', '16:37:51', 'Email', 0, 3),
(36, 'Notificacion de Subida del Proyecto de Tesis', '\r\nEstimado Jurado,\r\nEspero que esté teniendo un buen día. Quería informarle que se ha subido una nuevo proyecto de tesis. \r\nEl archivo actualizado está disponible para su revisión y evaluación.\r\nAgradezco mucho su tiempo y esfuerzo dedicados a la revisión del proyecto.', '2023-07-23', '16:37:54', 'Email', 0, 1),
(37, 'Notificacion de Subida del Proyecto de Tesis', '\r\nEstimado Jurado,\r\nEspero que esté teniendo un buen día. Quería informarle que se ha subido una nuevo proyecto de tesis. \r\nEl archivo actualizado está disponible para su revisión y evaluación.\r\nAgradezco mucho su tiempo y esfuerzo dedicados a la revisión del proyecto.', '2023-07-23', '16:37:57', 'Email', 0, 2),
(38, 'Notificacion de Subida del Proyecto de Tesis', '\r\nEstimado Jurado,\r\nEspero que esté teniendo un buen día. Quería informarle que se ha subido una nuevo proyecto de tesis. \r\nEl archivo actualizado está disponible para su revisión y evaluación.\r\nAgradezco mucho su tiempo y esfuerzo dedicados a la revisión del proyecto.', '2023-07-23', '16:38:00', 'Email', 0, 3),
(39, 'Asunto: Corrección del Proyecto de Tesis', '\r\nEstimado Jurado,\r\nLe informo que se ha realizado las correcciones en el proyecto de tesis y ya está disponible para su revisión en la plataforma Pilar. \r\nAgradezco su tiempo y quedo atento/a a cualquier consulta.\r\nGracias y saludos cordiales', '2023-07-23', '16:40:54', 'SMS', 0, 1),
(40, 'Asunto: Corrección del Proyecto de Tesis', '\r\nEstimado Jurado,\r\nLe informo que se ha realizado las correcciones en el proyecto de tesis y ya está disponible para su revisión en la plataforma Pilar. \r\nAgradezco su tiempo y quedo atento/a a cualquier consulta.\r\nGracias y saludos cordiales', '2023-07-23', '16:40:56', 'SMS', 0, 2),
(41, 'Asunto: Corrección del Proyecto de Tesis', '\r\nEstimado Jurado,\r\nLe informo que se ha realizado las correcciones en el proyecto de tesis y ya está disponible para su revisión en la plataforma Pilar. \r\nAgradezco su tiempo y quedo atento/a a cualquier consulta.\r\nGracias y saludos cordiales', '2023-07-23', '16:40:57', 'SMS', 0, 3),
(42, 'Asunto: Corrección del Proyecto de Tesis', '\r\nEstimado Jurado,\r\nLe informo que se ha realizado las correcciones en el proyecto de tesis y ya está disponible para su revisión en la plataforma Pilar. \r\nAgradezco su tiempo y quedo atento/a a cualquier consulta.\r\nGracias y saludos cordiales', '2023-07-23', '16:40:58', 'SMS', 0, 1),
(43, 'Asunto: Corrección del Proyecto de Tesis', '\r\nEstimado Jurado,\r\nLe informo que se ha realizado las correcciones en el proyecto de tesis y ya está disponible para su revisión en la plataforma Pilar. \r\nAgradezco su tiempo y quedo atento/a a cualquier consulta.\r\nGracias y saludos cordiales', '2023-07-23', '16:40:59', 'SMS', 0, 2),
(44, 'Asunto: Corrección del Proyecto de Tesis', '\r\nEstimado Jurado,\r\nLe informo que se ha realizado las correcciones en el proyecto de tesis y ya está disponible para su revisión en la plataforma Pilar. \r\nAgradezco su tiempo y quedo atento/a a cualquier consulta.\r\nGracias y saludos cordiales', '2023-07-23', '16:41:00', 'SMS', 0, 3),
(45, 'Notificacion de correccion del Proyecto de Te', '\r\nEstimado Jurado,\r\nEspero que esté teniendo un buen día. Quería informarle que se ha subido una nueva versión corregida del proyecto de tesis. \r\nEl archivo actualizado está disponible para su revisión y evaluación.\r\nAgradezco mucho su tiempo y esfuerzo dedicados a la revisión del proyecto.', '2023-07-23', '16:41:04', 'Email', 0, 1),
(46, 'Notificacion de correccion del Proyecto de Te', '\r\nEstimado Jurado,\r\nEspero que esté teniendo un buen día. Quería informarle que se ha subido una nueva versión corregida del proyecto de tesis. \r\nEl archivo actualizado está disponible para su revisión y evaluación.\r\nAgradezco mucho su tiempo y esfuerzo dedicados a la revisión del proyecto.', '2023-07-23', '16:41:07', 'Email', 0, 2),
(47, 'Notificacion de correccion del Proyecto de Te', '\r\nEstimado Jurado,\r\nEspero que esté teniendo un buen día. Quería informarle que se ha subido una nueva versión corregida del proyecto de tesis. \r\nEl archivo actualizado está disponible para su revisión y evaluación.\r\nAgradezco mucho su tiempo y esfuerzo dedicados a la revisión del proyecto.', '2023-07-23', '16:41:11', 'Email', 0, 3),
(48, 'Notificacion de correccion del Proyecto de Te', '\r\nEstimado Jurado,\r\nEspero que esté teniendo un buen día. Quería informarle que se ha subido una nueva versión corregida del proyecto de tesis. \r\nEl archivo actualizado está disponible para su revisión y evaluación.\r\nAgradezco mucho su tiempo y esfuerzo dedicados a la revisión del proyecto.', '2023-07-23', '16:41:14', 'Email', 0, 1),
(49, 'Notificacion de correccion del Proyecto de Te', '\r\nEstimado Jurado,\r\nEspero que esté teniendo un buen día. Quería informarle que se ha subido una nueva versión corregida del proyecto de tesis. \r\nEl archivo actualizado está disponible para su revisión y evaluación.\r\nAgradezco mucho su tiempo y esfuerzo dedicados a la revisión del proyecto.', '2023-07-23', '16:41:17', 'Email', 0, 2),
(50, 'Notificacion de correccion del Proyecto de Te', '\r\nEstimado Jurado,\r\nEspero que esté teniendo un buen día. Quería informarle que se ha subido una nueva versión corregida del proyecto de tesis. \r\nEl archivo actualizado está disponible para su revisión y evaluación.\r\nAgradezco mucho su tiempo y esfuerzo dedicados a la revisión del proyecto.', '2023-07-23', '16:41:21', 'Email', 0, 3),
(51, 'Asunto: Subida del Proyecto de Tesis', '\r\nEstimado Jurado,\r\nLe informo que se ha realizado la subida de un proyecto de tesis y ya está disponible para su revisión en la plataforma Pilar. \r\nAgradezco su tiempo y quedo atento/a a cualquier consulta.\r\nGracias y saludos cordiales', '2023-07-23', '16:52:38', 'SMS', 0, 1),
(52, 'Asunto: Subida del Proyecto de Tesis', '\r\nEstimado Jurado,\r\nLe informo que se ha realizado la subida de un proyecto de tesis y ya está disponible para su revisión en la plataforma Pilar. \r\nAgradezco su tiempo y quedo atento/a a cualquier consulta.\r\nGracias y saludos cordiales', '2023-07-23', '16:52:40', 'SMS', 0, 2),
(53, 'Asunto: Subida del Proyecto de Tesis', '\r\nEstimado Jurado,\r\nLe informo que se ha realizado la subida de un proyecto de tesis y ya está disponible para su revisión en la plataforma Pilar. \r\nAgradezco su tiempo y quedo atento/a a cualquier consulta.\r\nGracias y saludos cordiales', '2023-07-23', '16:52:41', 'SMS', 0, 3),
(54, 'Notificacion de Subida del Proyecto de Tesis', '\r\nEstimado Jurado,\r\nEspero que esté teniendo un buen día. Quería informarle que se ha subido una nuevo proyecto de tesis. \r\nEl archivo actualizado está disponible para su revisión y evaluación.\r\nAgradezco mucho su tiempo y esfuerzo dedicados a la revisión del proyecto.', '2023-07-23', '16:52:45', 'Email', 0, 1),
(55, 'Notificacion de Subida del Proyecto de Tesis', '\r\nEstimado Jurado,\r\nEspero que esté teniendo un buen día. Quería informarle que se ha subido una nuevo proyecto de tesis. \r\nEl archivo actualizado está disponible para su revisión y evaluación.\r\nAgradezco mucho su tiempo y esfuerzo dedicados a la revisión del proyecto.', '2023-07-23', '16:52:48', 'Email', 0, 2),
(56, 'Notificacion de Subida del Proyecto de Tesis', '\r\nEstimado Jurado,\r\nEspero que esté teniendo un buen día. Quería informarle que se ha subido una nuevo proyecto de tesis. \r\nEl archivo actualizado está disponible para su revisión y evaluación.\r\nAgradezco mucho su tiempo y esfuerzo dedicados a la revisión del proyecto.', '2023-07-23', '16:52:51', 'Email', 0, 3),
(57, 'Asunto: Corrección del Proyecto de Tesis', '\r\nEstimado Jurado,\r\nLe informo que se ha realizado las correcciones en el proyecto de tesis y ya está disponible para su revisión en la plataforma Pilar. \r\nAgradezco su tiempo y quedo atento/a a cualquier consulta.\r\nGracias y saludos cordiales', '2023-07-23', '17:06:01', 'SMS', 0, 1),
(58, 'Asunto: Corrección del Proyecto de Tesis', '\r\nEstimado Jurado,\r\nLe informo que se ha realizado las correcciones en el proyecto de tesis y ya está disponible para su revisión en la plataforma Pilar. \r\nAgradezco su tiempo y quedo atento/a a cualquier consulta.\r\nGracias y saludos cordiales', '2023-07-23', '17:06:02', 'SMS', 0, 2),
(59, 'Asunto: Corrección del Proyecto de Tesis', '\r\nEstimado Jurado,\r\nLe informo que se ha realizado las correcciones en el proyecto de tesis y ya está disponible para su revisión en la plataforma Pilar. \r\nAgradezco su tiempo y quedo atento/a a cualquier consulta.\r\nGracias y saludos cordiales', '2023-07-23', '17:06:03', 'SMS', 0, 3),
(60, 'Notificacion de correccion del Proyecto de Te', '\r\nEstimado Jurado,\r\nEspero que esté teniendo un buen día. Quería informarle que se ha subido una nueva versión corregida del proyecto de tesis. \r\nEl archivo actualizado está disponible para su revisión y evaluación.\r\nAgradezco mucho su tiempo y esfuerzo dedicados a la revisión del proyecto.', '2023-07-23', '17:06:08', 'Email', 0, 1),
(61, 'Notificacion de correccion del Proyecto de Te', '\r\nEstimado Jurado,\r\nEspero que esté teniendo un buen día. Quería informarle que se ha subido una nueva versión corregida del proyecto de tesis. \r\nEl archivo actualizado está disponible para su revisión y evaluación.\r\nAgradezco mucho su tiempo y esfuerzo dedicados a la revisión del proyecto.', '2023-07-23', '17:06:11', 'Email', 0, 2),
(62, 'Notificacion de correccion del Proyecto de Te', '\r\nEstimado Jurado,\r\nEspero que esté teniendo un buen día. Quería informarle que se ha subido una nueva versión corregida del proyecto de tesis. \r\nEl archivo actualizado está disponible para su revisión y evaluación.\r\nAgradezco mucho su tiempo y esfuerzo dedicados a la revisión del proyecto.', '2023-07-23', '17:06:14', 'Email', 0, 3),
(63, 'Asunto: Subida del Proyecto de Tesis', '\r\nEstimado Jurado,\r\nLe informo que se ha realizado la subida de un proyecto de tesis y ya está disponible para su revisión en la plataforma Pilar. \r\nAgradezco su tiempo y quedo atento/a a cualquier consulta.\r\nGracias y saludos cordiales', '2023-07-23', '17:19:22', 'SMS', 0, 1),
(64, 'Asunto: Subida del Proyecto de Tesis', '\r\nEstimado Jurado,\r\nLe informo que se ha realizado la subida de un proyecto de tesis y ya está disponible para su revisión en la plataforma Pilar. \r\nAgradezco su tiempo y quedo atento/a a cualquier consulta.\r\nGracias y saludos cordiales', '2023-07-23', '17:19:23', 'SMS', 0, 2),
(65, 'Asunto: Subida del Proyecto de Tesis', '\r\nEstimado Jurado,\r\nLe informo que se ha realizado la subida de un proyecto de tesis y ya está disponible para su revisión en la plataforma Pilar. \r\nAgradezco su tiempo y quedo atento/a a cualquier consulta.\r\nGracias y saludos cordiales', '2023-07-23', '17:19:24', 'SMS', 0, 3),
(66, 'Asunto: Subida del Proyecto de Tesis', '\r\nEstimado Jurado,\r\nLe informo que se ha realizado la subida de un proyecto de tesis y ya está disponible para su revisión en la plataforma Pilar. \r\nAgradezco su tiempo y quedo atento/a a cualquier consulta.\r\nGracias y saludos cordiales', '2023-07-23', '17:19:25', 'SMS', 0, 1),
(67, 'Asunto: Subida del Proyecto de Tesis', '\r\nEstimado Jurado,\r\nLe informo que se ha realizado la subida de un proyecto de tesis y ya está disponible para su revisión en la plataforma Pilar. \r\nAgradezco su tiempo y quedo atento/a a cualquier consulta.\r\nGracias y saludos cordiales', '2023-07-23', '17:19:26', 'SMS', 0, 2),
(68, 'Asunto: Subida del Proyecto de Tesis', '\r\nEstimado Jurado,\r\nLe informo que se ha realizado la subida de un proyecto de tesis y ya está disponible para su revisión en la plataforma Pilar. \r\nAgradezco su tiempo y quedo atento/a a cualquier consulta.\r\nGracias y saludos cordiales', '2023-07-23', '17:19:27', 'SMS', 0, 3),
(69, 'Notificacion de Subida del Proyecto de Tesis', '\r\nEstimado Jurado,\r\nEspero que esté teniendo un buen día. Quería informarle que se ha subido una nuevo proyecto de tesis. \r\nEl archivo actualizado está disponible para su revisión y evaluación.\r\nAgradezco mucho su tiempo y esfuerzo dedicados a la revisión del proyecto.', '2023-07-23', '17:19:31', 'Email', 0, 1),
(70, 'Notificacion de Subida del Proyecto de Tesis', '\r\nEstimado Jurado,\r\nEspero que esté teniendo un buen día. Quería informarle que se ha subido una nuevo proyecto de tesis. \r\nEl archivo actualizado está disponible para su revisión y evaluación.\r\nAgradezco mucho su tiempo y esfuerzo dedicados a la revisión del proyecto.', '2023-07-23', '17:19:35', 'Email', 0, 2),
(71, 'Notificacion de Subida del Proyecto de Tesis', '\r\nEstimado Jurado,\r\nEspero que esté teniendo un buen día. Quería informarle que se ha subido una nuevo proyecto de tesis. \r\nEl archivo actualizado está disponible para su revisión y evaluación.\r\nAgradezco mucho su tiempo y esfuerzo dedicados a la revisión del proyecto.', '2023-07-23', '17:19:39', 'Email', 0, 3),
(72, 'Notificacion de Subida del Proyecto de Tesis', '\r\nEstimado Jurado,\r\nEspero que esté teniendo un buen día. Quería informarle que se ha subido una nuevo proyecto de tesis. \r\nEl archivo actualizado está disponible para su revisión y evaluación.\r\nAgradezco mucho su tiempo y esfuerzo dedicados a la revisión del proyecto.', '2023-07-23', '17:19:42', 'Email', 0, 1),
(73, 'Notificacion de Subida del Proyecto de Tesis', '\r\nEstimado Jurado,\r\nEspero que esté teniendo un buen día. Quería informarle que se ha subido una nuevo proyecto de tesis. \r\nEl archivo actualizado está disponible para su revisión y evaluación.\r\nAgradezco mucho su tiempo y esfuerzo dedicados a la revisión del proyecto.', '2023-07-23', '17:19:45', 'Email', 0, 2),
(74, 'Notificacion de Subida del Proyecto de Tesis', '\r\nEstimado Jurado,\r\nEspero que esté teniendo un buen día. Quería informarle que se ha subido una nuevo proyecto de tesis. \r\nEl archivo actualizado está disponible para su revisión y evaluación.\r\nAgradezco mucho su tiempo y esfuerzo dedicados a la revisión del proyecto.', '2023-07-23', '17:19:49', 'Email', 0, 3);

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
  `leido` tinyint(4) NOT NULL,
  `Tipo` varchar(25) NOT NULL,
  `Tesista_Id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `notificaciontesista`
--

INSERT INTO `notificaciontesista` (`id`, `Descripcion`, `contenido`, `Fecha`, `hora`, `leido`, `Tipo`, `Tesista_Id`) VALUES
(2, 'Asunto: Dictamen del Proyecto de Tesis', '\r\nEstimado Tesista,\r\nEspero que esté teniendo un buen día. Quería informarle que ya puede ver el dictamen del proyecto de tesis. \r\nIngrese a la plataforma Pilar para ver a detalle.\r\nAgradezco mucho su tiempo.', '2023-07-23', '12:52:57', 0, 'SMS', 1),
(3, 'Asunto: Dictamen del Proyecto de Tesis', '\r\nEstimado Tesista,\r\nEspero que esté teniendo un buen día. Quería informarle que ya puede ver el dictamen del proyecto de tesis. \r\nIngrese a la plataforma Pilar para ver a detalle.\r\nAgradezco mucho su tiempo.', '2023-07-23', '12:56:13', 0, 'SMS', 1),
(4, 'Asunto: Revision del Proyecto de Tesis', '\r\nEstimado Tesista,\r\nLe informo que se ha realizado la revision del proyecto de tesis y ya está disponible para realizar las correcciones en la plataforma Pilar. \r\nAgradezco su tiempo.\r\nGracias y saludos cordiales', '2023-07-23', '13:01:29', 0, 'SMS', 1),
(5, 'Notificacion de Revision del Proyecto de Tesi', '\r\nEstimado Tesista,\r\nEspero que esté teniendo un buen día. Quería informarle que se ha realizado la revision del proyecto de tesis. \r\nYa vestá disponible para realizar las correcciones correspondientes.\r\nAgradezco mucho su tiempo.', '2023-07-23', '13:01:34', 0, 'Email', 1),
(6, 'Asunto: Dictamen del Proyecto de Tesis', '\r\nEstimado Tesista,\r\nEspero que esté teniendo un buen día. Quería informarle que ya puede ver el dictamen del proyecto de tesis. \r\nIngrese a la plataforma Pilar para ver a detalle.\r\nAgradezco mucho su tiempo.', '2023-07-23', '13:04:57', 0, 'SMS', 1),
(7, 'Notificacion de Dictamen del Proyecto de Tesi', '\r\nEstimado Tesista,\r\nEspero que esté teniendo un buen día. Quería informarle que ya puede ver el dictamen del proyecto de tesis. \r\nIngrese a la plataforma Pilar para ver a detalle.\r\nAgradezco mucho su tiempo.', '2023-07-23', '13:05:01', 0, 'Email', 1),
(8, 'Asunto: Revision del Proyecto de Tesis', '\r\nEstimado Tesista,\r\nLe informo que se ha realizado la revision del proyecto de tesis y ya está disponible para realizar las correcciones en la plataforma Pilar. \r\nAgradezco su tiempo.\r\nGracias y saludos cordiales', '2023-07-23', '14:37:19', 0, 'SMS', 1),
(9, 'Notificacion de Revision del Proyecto de Tesi', '\r\nEstimado Tesista,\r\nEspero que esté teniendo un buen día. Quería informarle que se ha realizado la revision del proyecto de tesis. \r\nYa vestá disponible para realizar las correcciones correspondientes.\r\nAgradezco mucho su tiempo.', '2023-07-23', '14:37:24', 0, 'Email', 1),
(10, 'Asunto: Revision del Proyecto de Tesis', '\r\nEstimado Tesista,\r\nLe informo que se ha realizado la revision del proyecto de tesis y ya está disponible para realizar las correcciones en la plataforma Pilar. \r\nAgradezco su tiempo.\r\nGracias y saludos cordiales', '2023-07-23', '14:41:24', 0, 'SMS', 1),
(11, 'Notificacion de Revision del Proyecto de Tesi', '\r\nEstimado Tesista,\r\nEspero que esté teniendo un buen día. Quería informarle que se ha realizado la revision del proyecto de tesis. \r\nYa vestá disponible para realizar las correcciones correspondientes.\r\nAgradezco mucho su tiempo.', '2023-07-23', '14:41:29', 0, 'Email', 1),
(12, 'Asunto: Revision del Proyecto de Tesis', '\r\nEstimado Tesista,\r\nLe informo que se ha realizado la revision del proyecto de tesis y ya está disponible para realizar las correcciones en la plataforma Pilar. \r\nAgradezco su tiempo.\r\nGracias y saludos cordiales', '2023-07-23', '14:44:52', 0, 'SMS', 1),
(13, 'Notificacion de Revision del Proyecto de Tesi', '\r\nEstimado Tesista,\r\nEspero que esté teniendo un buen día. Quería informarle que se ha realizado la revision del proyecto de tesis. \r\nYa vestá disponible para realizar las correcciones correspondientes.\r\nAgradezco mucho su tiempo.', '2023-07-23', '14:44:57', 0, 'Email', 1),
(14, 'Asunto: Revision del Proyecto de Tesis', '\r\nEstimado Tesista,\r\nLe informo que se ha realizado la revision del proyecto de tesis y ya está disponible para realizar las correcciones en la plataforma Pilar. \r\nAgradezco su tiempo.\r\nGracias y saludos cordiales', '2023-07-23', '14:46:25', 0, 'SMS', 1),
(15, 'Notificacion de Revision del Proyecto de Tesi', '\r\nEstimado Tesista,\r\nEspero que esté teniendo un buen día. Quería informarle que se ha realizado la revision del proyecto de tesis. \r\nYa vestá disponible para realizar las correcciones correspondientes.\r\nAgradezco mucho su tiempo.', '2023-07-23', '14:46:31', 0, 'Email', 1),
(16, 'Asunto: Revision del Proyecto de Tesis', '\r\nEstimado Tesista,\r\nLe informo que se ha realizado la revision del proyecto de tesis y ya está disponible para realizar las correcciones en la plataforma Pilar. \r\nAgradezco su tiempo.\r\nGracias y saludos cordiales', '2023-07-23', '14:47:31', 0, 'SMS', 1),
(17, 'Notificacion de Revision del Proyecto de Tesi', '\r\nEstimado Tesista,\r\nEspero que esté teniendo un buen día. Quería informarle que se ha realizado la revision del proyecto de tesis. \r\nYa vestá disponible para realizar las correcciones correspondientes.\r\nAgradezco mucho su tiempo.', '2023-07-23', '14:47:36', 0, 'Email', 1),
(18, 'Asunto: Revision del Proyecto de Tesis', '\r\nEstimado Tesista,\r\nLe informo que se ha realizado la revision del proyecto de tesis y ya está disponible para realizar las correcciones en la plataforma Pilar. \r\nAgradezco su tiempo.\r\nGracias y saludos cordiales', '2023-07-23', '14:50:42', 0, 'SMS', 1),
(19, 'Notificacion de Revision del Proyecto de Tesi', '\r\nEstimado Tesista,\r\nEspero que esté teniendo un buen día. Quería informarle que se ha realizado la revision del proyecto de tesis. \r\nYa vestá disponible para realizar las correcciones correspondientes.\r\nAgradezco mucho su tiempo.', '2023-07-23', '14:50:47', 0, 'Email', 1),
(20, 'Asunto: Revision del Proyecto de Tesis', '\r\nEstimado Tesista,\r\nLe informo que se ha realizado la revision del proyecto de tesis y ya está disponible para realizar las correcciones en la plataforma Pilar. \r\nAgradezco su tiempo.\r\nGracias y saludos cordiales', '2023-07-23', '14:52:36', 0, 'SMS', 1),
(21, 'Notificacion de Revision del Proyecto de Tesi', '\r\nEstimado Tesista,\r\nEspero que esté teniendo un buen día. Quería informarle que se ha realizado la revision del proyecto de tesis. \r\nYa vestá disponible para realizar las correcciones correspondientes.\r\nAgradezco mucho su tiempo.', '2023-07-23', '14:52:40', 0, 'Email', 1),
(22, 'Asunto: Revision del Proyecto de Tesis', '\r\nEstimado Tesista,\r\nLe informo que se ha realizado la revision del proyecto de tesis y ya está disponible para realizar las correcciones en la plataforma Pilar. \r\nAgradezco su tiempo.\r\nGracias y saludos cordiales', '2023-07-23', '14:53:18', 0, 'SMS', 1),
(23, 'Notificacion de Revision del Proyecto de Tesi', '\r\nEstimado Tesista,\r\nEspero que esté teniendo un buen día. Quería informarle que se ha realizado la revision del proyecto de tesis. \r\nYa vestá disponible para realizar las correcciones correspondientes.\r\nAgradezco mucho su tiempo.', '2023-07-23', '14:53:23', 0, 'Email', 1),
(24, 'Asunto: Dictamen del Proyecto de Tesis', '\r\nEstimado Tesista,\r\nEspero que esté teniendo un buen día. Quería informarle que ya puede ver el dictamen del proyecto de tesis. \r\nIngrese a la plataforma Pilar para ver a detalle.\r\nAgradezco mucho su tiempo.', '2023-07-23', '15:07:02', 0, 'SMS', 1),
(25, 'Notificacion de Dictamen del Proyecto de Tesi', '\r\nEstimado Tesista,\r\nEspero que esté teniendo un buen día. Quería informarle que ya puede ver el dictamen del proyecto de tesis. \r\nIngrese a la plataforma Pilar para ver a detalle.\r\nAgradezco mucho su tiempo.', '2023-07-23', '15:07:07', 0, 'Email', 1),
(26, 'Asunto: Dictamen del Proyecto de Tesis', '\r\nEstimado Tesista,\r\nEspero que esté teniendo un buen día. Quería informarle que ya puede ver el dictamen del proyecto de tesis. \r\nIngrese a la plataforma Pilar para ver a detalle.\r\nAgradezco mucho su tiempo.', '2023-07-23', '15:09:05', 0, 'SMS', 1),
(27, 'Notificacion de Dictamen del Proyecto de Tesi', '\r\nEstimado Tesista,\r\nEspero que esté teniendo un buen día. Quería informarle que ya puede ver el dictamen del proyecto de tesis. \r\nIngrese a la plataforma Pilar para ver a detalle.\r\nAgradezco mucho su tiempo.', '2023-07-23', '15:09:09', 0, 'Email', 1),
(28, 'Asunto: Revision del Proyecto de Tesis', '\r\nEstimado Tesista,\r\nLe informo que se ha realizado la revision del proyecto de tesis y ya está disponible para realizar las correcciones en la plataforma Pilar. \r\nAgradezco su tiempo.\r\nGracias y saludos cordiales', '2023-07-23', '15:10:49', 0, 'SMS', 1),
(29, 'Notificacion de Revision del Proyecto de Tesi', '\r\nEstimado Tesista,\r\nEspero que esté teniendo un buen día. Quería informarle que se ha realizado la revision del proyecto de tesis. \r\nYa vestá disponible para realizar las correcciones correspondientes.\r\nAgradezco mucho su tiempo.', '2023-07-23', '15:10:54', 0, 'Email', 1),
(30, 'Asunto: Revision del Proyecto de Tesis', '\r\nEstimado Tesista,\r\nLe informo que se ha realizado la revision del proyecto de tesis y ya está disponible para realizar las correcciones en la plataforma Pilar. \r\nAgradezco su tiempo.\r\nGracias y saludos cordiales', '2023-07-23', '15:11:18', 0, 'SMS', 1),
(31, 'Notificacion de Revision del Proyecto de Tesi', '\r\nEstimado Tesista,\r\nEspero que esté teniendo un buen día. Quería informarle que se ha realizado la revision del proyecto de tesis. \r\nYa vestá disponible para realizar las correcciones correspondientes.\r\nAgradezco mucho su tiempo.', '2023-07-23', '15:11:23', 0, 'Email', 1),
(32, 'Asunto: Revision del Proyecto de Tesis', '\r\nEstimado Tesista,\r\nLe informo que se ha realizado la revision del proyecto de tesis y ya está disponible para realizar las correcciones en la plataforma Pilar. \r\nAgradezco su tiempo.\r\nGracias y saludos cordiales', '2023-07-23', '15:17:29', 0, 'SMS', 1),
(33, 'Notificacion de Revision del Proyecto de Tesi', '\r\nEstimado Tesista,\r\nEspero que esté teniendo un buen día. Quería informarle que se ha realizado la revision del proyecto de tesis. \r\nYa vestá disponible para realizar las correcciones correspondientes.\r\nAgradezco mucho su tiempo.', '2023-07-23', '15:17:34', 0, 'Email', 1),
(34, 'Asunto: Revision del Proyecto de Tesis', '\r\nEstimado Tesista,\r\nLe informo que se ha realizado la revision del proyecto de tesis y ya está disponible para realizar las correcciones en la plataforma Pilar. \r\nAgradezco su tiempo.\r\nGracias y saludos cordiales', '2023-07-23', '15:20:14', 0, 'SMS', 1),
(35, 'Notificacion de Revision del Proyecto de Tesi', '\r\nEstimado Tesista,\r\nEspero que esté teniendo un buen día. Quería informarle que se ha realizado la revision del proyecto de tesis. \r\nYa vestá disponible para realizar las correcciones correspondientes.\r\nAgradezco mucho su tiempo.', '2023-07-23', '15:20:18', 0, 'Email', 1),
(36, 'Asunto: Revision del Proyecto de Tesis', '\r\nEstimado Tesista,\r\nLe informo que se ha realizado la revision del proyecto de tesis y ya está disponible para realizar las correcciones en la plataforma Pilar. \r\nAgradezco su tiempo.\r\nGracias y saludos cordiales', '2023-07-23', '15:24:18', 0, 'SMS', 1),
(37, 'Notificacion de Revision del Proyecto de Tesi', '\r\nEstimado Tesista,\r\nEspero que esté teniendo un buen día. Quería informarle que se ha realizado la revision del proyecto de tesis. \r\nYa vestá disponible para realizar las correcciones correspondientes.\r\nAgradezco mucho su tiempo.', '2023-07-23', '15:24:22', 0, 'Email', 1),
(38, 'Asunto: Revision del Proyecto de Tesis', '\r\nEstimado Tesista,\r\nLe informo que se ha realizado la revision del proyecto de tesis y ya está disponible para realizar las correcciones en la plataforma Pilar. \r\nAgradezco su tiempo.\r\nGracias y saludos cordiales', '2023-07-23', '15:25:13', 0, 'SMS', 1),
(39, 'Notificacion de Revision del Proyecto de Tesi', '\r\nEstimado Tesista,\r\nEspero que esté teniendo un buen día. Quería informarle que se ha realizado la revision del proyecto de tesis. \r\nYa vestá disponible para realizar las correcciones correspondientes.\r\nAgradezco mucho su tiempo.', '2023-07-23', '15:25:17', 0, 'Email', 1),
(40, 'Asunto: Revision del Proyecto de Tesis', '\r\nEstimado Tesista,\r\nLe informo que se ha realizado la revision del proyecto de tesis y ya está disponible para realizar las correcciones en la plataforma Pilar. \r\nAgradezco su tiempo.\r\nGracias y saludos cordiales', '2023-07-23', '15:26:17', 0, 'SMS', 1),
(41, 'Notificacion de Revision del Proyecto de Tesi', '\r\nEstimado Tesista,\r\nEspero que esté teniendo un buen día. Quería informarle que se ha realizado la revision del proyecto de tesis. \r\nYa vestá disponible para realizar las correcciones correspondientes.\r\nAgradezco mucho su tiempo.', '2023-07-23', '15:26:22', 0, 'Email', 1),
(42, 'Asunto: Revision del Proyecto de Tesis', '\r\nEstimado Tesista,\r\nLe informo que se ha realizado la revision del proyecto de tesis y ya está disponible para realizar las correcciones en la plataforma Pilar. \r\nAgradezco su tiempo.\r\nGracias y saludos cordiales', '2023-07-23', '15:27:02', 0, 'SMS', 1),
(43, 'Notificacion de Revision del Proyecto de Tesi', '\r\nEstimado Tesista,\r\nEspero que esté teniendo un buen día. Quería informarle que se ha realizado la revision del proyecto de tesis. \r\nYa vestá disponible para realizar las correcciones correspondientes.\r\nAgradezco mucho su tiempo.', '2023-07-23', '15:27:06', 0, 'Email', 1),
(44, 'Asunto: Revision del Proyecto de Tesis', '\r\nEstimado Tesista,\r\nLe informo que se ha realizado la revision del proyecto de tesis y ya está disponible para realizar las correcciones en la plataforma Pilar. \r\nAgradezco su tiempo.\r\nGracias y saludos cordiales', '2023-07-23', '15:29:16', 0, 'SMS', 1),
(45, 'Notificacion de Revision del Proyecto de Tesi', '\r\nEstimado Tesista,\r\nEspero que esté teniendo un buen día. Quería informarle que se ha realizado la revision del proyecto de tesis. \r\nYa vestá disponible para realizar las correcciones correspondientes.\r\nAgradezco mucho su tiempo.', '2023-07-23', '15:29:21', 0, 'Email', 1),
(46, 'Asunto: Revision del Proyecto de Tesis', '\r\nEstimado Tesista,\r\nLe informo que se ha realizado la revision del proyecto de tesis y ya está disponible para realizar las correcciones en la plataforma Pilar. \r\nAgradezco su tiempo.\r\nGracias y saludos cordiales', '2023-07-23', '15:30:52', 0, 'SMS', 1),
(47, 'Notificacion de Revision del Proyecto de Tesi', '\r\nEstimado Tesista,\r\nEspero que esté teniendo un buen día. Quería informarle que se ha realizado la revision del proyecto de tesis. \r\nYa vestá disponible para realizar las correcciones correspondientes.\r\nAgradezco mucho su tiempo.', '2023-07-23', '15:30:57', 0, 'Email', 1),
(48, 'Asunto: Revision del Proyecto de Tesis', '\r\nEstimado Tesista,\r\nLe informo que se ha realizado la revision del proyecto de tesis y ya está disponible para realizar las correcciones en la plataforma Pilar. \r\nAgradezco su tiempo.\r\nGracias y saludos cordiales', '2023-07-23', '15:31:04', 0, 'SMS', 1),
(49, 'Notificacion de Revision del Proyecto de Tesi', '\r\nEstimado Tesista,\r\nEspero que esté teniendo un buen día. Quería informarle que se ha realizado la revision del proyecto de tesis. \r\nYa vestá disponible para realizar las correcciones correspondientes.\r\nAgradezco mucho su tiempo.', '2023-07-23', '15:31:09', 0, 'Email', 1),
(50, 'Asunto: Revision del Proyecto de Tesis', '\r\nEstimado Tesista,\r\nLe informo que se ha realizado la revision del proyecto de tesis y ya está disponible para realizar las correcciones en la plataforma Pilar. \r\nAgradezco su tiempo.\r\nGracias y saludos cordiales', '2023-07-23', '15:32:42', 0, 'SMS', 1),
(51, 'Notificacion de Revision del Proyecto de Tesi', '\r\nEstimado Tesista,\r\nEspero que esté teniendo un buen día. Quería informarle que se ha realizado la revision del proyecto de tesis. \r\nYa vestá disponible para realizar las correcciones correspondientes.\r\nAgradezco mucho su tiempo.', '2023-07-23', '15:32:47', 0, 'Email', 1),
(52, 'Asunto: Revision del Proyecto de Tesis', '\r\nEstimado Tesista,\r\nLe informo que se ha realizado la revision del proyecto de tesis y ya está disponible para realizar las correcciones en la plataforma Pilar. \r\nAgradezco su tiempo.\r\nGracias y saludos cordiales', '2023-07-23', '15:32:54', 0, 'SMS', 1),
(53, 'Notificacion de Revision del Proyecto de Tesi', '\r\nEstimado Tesista,\r\nEspero que esté teniendo un buen día. Quería informarle que se ha realizado la revision del proyecto de tesis. \r\nYa vestá disponible para realizar las correcciones correspondientes.\r\nAgradezco mucho su tiempo.', '2023-07-23', '15:32:57', 0, 'Email', 1),
(54, 'Asunto: Revision del Proyecto de Tesis', '\r\nEstimado Tesista,\r\nLe informo que se ha realizado la revision del proyecto de tesis y ya está disponible para realizar las correcciones en la plataforma Pilar. \r\nAgradezco su tiempo.\r\nGracias y saludos cordiales', '2023-07-23', '15:33:22', 0, 'SMS', 1),
(55, 'Notificacion de Revision del Proyecto de Tesi', '\r\nEstimado Tesista,\r\nEspero que esté teniendo un buen día. Quería informarle que se ha realizado la revision del proyecto de tesis. \r\nYa vestá disponible para realizar las correcciones correspondientes.\r\nAgradezco mucho su tiempo.', '2023-07-23', '15:33:26', 0, 'Email', 1),
(56, 'Asunto: Revision del Proyecto de Tesis', '\r\nEstimado Tesista,\r\nLe informo que se ha realizado la revision del proyecto de tesis y ya está disponible para realizar las correcciones en la plataforma Pilar. \r\nAgradezco su tiempo.\r\nGracias y saludos cordiales', '2023-07-23', '15:33:39', 0, 'SMS', 1),
(57, 'Notificacion de Revision del Proyecto de Tesi', '\r\nEstimado Tesista,\r\nEspero que esté teniendo un buen día. Quería informarle que se ha realizado la revision del proyecto de tesis. \r\nYa vestá disponible para realizar las correcciones correspondientes.\r\nAgradezco mucho su tiempo.', '2023-07-23', '15:33:43', 0, 'Email', 1),
(58, 'Asunto: Revision del Proyecto de Tesis', '\r\nEstimado Tesista,\r\nLe informo que se ha realizado la revision del proyecto de tesis y ya está disponible para realizar las correcciones en la plataforma Pilar. \r\nAgradezco su tiempo.\r\nGracias y saludos cordiales', '2023-07-23', '15:34:25', 0, 'SMS', 1),
(59, 'Notificacion de Revision del Proyecto de Tesi', '\r\nEstimado Tesista,\r\nEspero que esté teniendo un buen día. Quería informarle que se ha realizado la revision del proyecto de tesis. \r\nYa vestá disponible para realizar las correcciones correspondientes.\r\nAgradezco mucho su tiempo.', '2023-07-23', '15:34:29', 0, 'Email', 1),
(60, 'Asunto: Revision del Proyecto de Tesis', '\r\nEstimado Tesista,\r\nLe informo que se ha realizado la revision del proyecto de tesis y ya está disponible para realizar las correcciones en la plataforma Pilar. \r\nAgradezco su tiempo.\r\nGracias y saludos cordiales', '2023-07-23', '15:35:33', 0, 'SMS', 1),
(61, 'Notificacion de Revision del Proyecto de Tesi', '\r\nEstimado Tesista,\r\nEspero que esté teniendo un buen día. Quería informarle que se ha realizado la revision del proyecto de tesis. \r\nYa vestá disponible para realizar las correcciones correspondientes.\r\nAgradezco mucho su tiempo.', '2023-07-23', '15:35:39', 0, 'Email', 1),
(62, 'Asunto: Revision del Proyecto de Tesis', '\r\nEstimado Tesista,\r\nLe informo que se ha realizado la revision del proyecto de tesis y ya está disponible para realizar las correcciones en la plataforma Pilar. \r\nAgradezco su tiempo.\r\nGracias y saludos cordiales', '2023-07-23', '15:40:20', 0, 'SMS', 1),
(63, 'Notificacion de Revision del Proyecto de Tesi', '\r\nEstimado Tesista,\r\nEspero que esté teniendo un buen día. Quería informarle que se ha realizado la revision del proyecto de tesis. \r\nYa vestá disponible para realizar las correcciones correspondientes.\r\nAgradezco mucho su tiempo.', '2023-07-23', '15:40:24', 0, 'Email', 1),
(64, 'Asunto: Revision del Proyecto de Tesis', '\r\nEstimado Tesista,\r\nLe informo que se ha realizado la revision del proyecto de tesis y ya está disponible para realizar las correcciones en la plataforma Pilar. \r\nAgradezco su tiempo.\r\nGracias y saludos cordiales', '2023-07-23', '15:43:15', 0, 'SMS', 1),
(65, 'Notificacion de Revision del Proyecto de Tesi', '\r\nEstimado Tesista,\r\nEspero que esté teniendo un buen día. Quería informarle que se ha realizado la revision del proyecto de tesis. \r\nYa vestá disponible para realizar las correcciones correspondientes.\r\nAgradezco mucho su tiempo.', '2023-07-23', '15:43:20', 0, 'Email', 1),
(66, 'Asunto: Revision del Proyecto de Tesis', '\r\nEstimado Tesista,\r\nLe informo que se ha realizado la revision del proyecto de tesis y ya está disponible para realizar las correcciones en la plataforma Pilar. \r\nAgradezco su tiempo.\r\nGracias y saludos cordiales', '2023-07-23', '15:44:53', 0, 'SMS', 1),
(67, 'Notificacion de Revision del Proyecto de Tesi', '\r\nEstimado Tesista,\r\nEspero que esté teniendo un buen día. Quería informarle que se ha realizado la revision del proyecto de tesis. \r\nYa vestá disponible para realizar las correcciones correspondientes.\r\nAgradezco mucho su tiempo.', '2023-07-23', '15:44:58', 0, 'Email', 1),
(68, 'Asunto: Revision del Proyecto de Tesis', '\r\nEstimado Tesista,\r\nLe informo que se ha realizado la revision del proyecto de tesis y ya está disponible para realizar las correcciones en la plataforma Pilar. \r\nAgradezco su tiempo.\r\nGracias y saludos cordiales', '2023-07-23', '15:47:26', 0, 'SMS', 1),
(69, 'Notificacion de Revision del Proyecto de Tesi', '\r\nEstimado Tesista,\r\nEspero que esté teniendo un buen día. Quería informarle que se ha realizado la revision del proyecto de tesis. \r\nYa vestá disponible para realizar las correcciones correspondientes.\r\nAgradezco mucho su tiempo.', '2023-07-23', '15:47:31', 0, 'Email', 1),
(70, 'Asunto: Revision del Proyecto de Tesis', '\r\nEstimado Tesista,\r\nLe informo que se ha realizado la revision del proyecto de tesis y ya está disponible para realizar las correcciones en la plataforma Pilar. \r\nAgradezco su tiempo.\r\nGracias y saludos cordiales', '2023-07-23', '15:48:18', 0, 'SMS', 1),
(71, 'Notificacion de Revision del Proyecto de Tesi', '\r\nEstimado Tesista,\r\nEspero que esté teniendo un buen día. Quería informarle que se ha realizado la revision del proyecto de tesis. \r\nYa vestá disponible para realizar las correcciones correspondientes.\r\nAgradezco mucho su tiempo.', '2023-07-23', '15:48:23', 0, 'Email', 1),
(72, 'Asunto: Revision del Proyecto de Tesis', '\r\nEstimado Tesista,\r\nLe informo que se ha realizado la revision del proyecto de tesis y ya está disponible para realizar las correcciones en la plataforma Pilar. \r\nAgradezco su tiempo.\r\nGracias y saludos cordiales', '2023-07-23', '15:49:03', 0, 'SMS', 1),
(73, 'Notificacion de Revision del Proyecto de Tesi', '\r\nEstimado Tesista,\r\nEspero que esté teniendo un buen día. Quería informarle que se ha realizado la revision del proyecto de tesis. \r\nYa vestá disponible para realizar las correcciones correspondientes.\r\nAgradezco mucho su tiempo.', '2023-07-23', '15:49:08', 0, 'Email', 1),
(74, 'Asunto: Revision del Proyecto de Tesis', '\r\nEstimado Tesista,\r\nLe informo que se ha realizado la revision del proyecto de tesis y ya está disponible para realizar las correcciones en la plataforma Pilar. \r\nAgradezco su tiempo.\r\nGracias y saludos cordiales', '2023-07-23', '15:51:45', 0, 'SMS', 1),
(75, 'Notificacion de Revision del Proyecto de Tesi', '\r\nEstimado Tesista,\r\nEspero que esté teniendo un buen día. Quería informarle que se ha realizado la revision del proyecto de tesis. \r\nYa vestá disponible para realizar las correcciones correspondientes.\r\nAgradezco mucho su tiempo.', '2023-07-23', '15:51:50', 0, 'Email', 1),
(76, 'Asunto: Dictamen del Proyecto de Tesis', '\r\nEstimado Tesista,\r\nEspero que esté teniendo un buen día. Quería informarle que ya puede ver el dictamen del proyecto de tesis. \r\nIngrese a la plataforma Pilar para ver a detalle.\r\nAgradezco mucho su tiempo.', '2023-07-23', '15:54:49', 0, 'SMS', 1),
(77, 'Notificacion de Dictamen del Proyecto de Tesi', '\r\nEstimado Tesista,\r\nEspero que esté teniendo un buen día. Quería informarle que ya puede ver el dictamen del proyecto de tesis. \r\nIngrese a la plataforma Pilar para ver a detalle.\r\nAgradezco mucho su tiempo.', '2023-07-23', '15:54:54', 0, 'Email', 1);

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
  `Especialidad_Id` int(11) NOT NULL,
  `Jurado_1` int(11) NOT NULL,
  `Jurado_2` int(11) NOT NULL,
  `Jurado_3` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `proyectotesis`
--

INSERT INTO `proyectotesis` (`id`, `Titulo`, `Documento`, `Codigo`, `Estado`, `Tesista_Id`, `Especialidad_Id`, `Jurado_1`, `Jurado_2`, `Jurado_3`) VALUES
(4, 'Deteccion de MOnos', 'Presentación Tecnología 5G Azul Elementos 3D.pdf', '191874', 0, 1, 1, 1, 2, 3),
(5, 'Deteccion de MOnos', 'Presentación Tecnología 5G Azul Elementos 3D.pdf', '191874', 0, 1, 1, 2, 3, 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `recordatoriojurado`
--

CREATE TABLE `recordatoriojurado` (
  `id` int(11) NOT NULL,
  `Fecha` date NOT NULL,
  `Hora` time NOT NULL,
  `Descripcion` varchar(50) NOT NULL,
  `contenido` text NOT NULL,
  `Tipo` varchar(25) NOT NULL,
  `Jurado_Id` int(11) NOT NULL
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
  `contenido` text NOT NULL,
  `Tipo` varchar(25) NOT NULL,
  `Tesista_Id` int(11) NOT NULL
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
  `Realizado` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `tesista`
--

INSERT INTO `tesista` (`id`, `Nombres`, `ApellidoPaterno`, `Apellidomaterno`, `Celular`, `Codigo`, `Dni`, `Email`, `Contraseña`, `EscuelaProfesional_Id`, `Realizado`) VALUES
(1, 'Kevin Arnold', 'Jallurani', 'Ruelas', '930913768', '191874', '02345673', 'kevin.u.97495@gmail.com', 'kevin1234', 1, 0);

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
  ADD KEY `Especialidad_Id` (`Especialidad_Id`),
  ADD KEY `Jurado_1` (`Jurado_1`),
  ADD KEY `Jurado_2` (`Jurado_2`),
  ADD KEY `Jurado_3` (`Jurado_3`);

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
  ADD KEY `EscuelaProfesional_Id` (`EscuelaProfesional_Id`);

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
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=75;

--
-- AUTO_INCREMENT de la tabla `notificaciontesista`
--
ALTER TABLE `notificaciontesista`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=78;

--
-- AUTO_INCREMENT de la tabla `proyectotesis`
--
ALTER TABLE `proyectotesis`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

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
  ADD CONSTRAINT `proyectotesis_ibfk_2` FOREIGN KEY (`Especialidad_Id`) REFERENCES `especialidad` (`id`),
  ADD CONSTRAINT `proyectotesis_ibfk_3` FOREIGN KEY (`Jurado_1`) REFERENCES `jurados` (`id`),
  ADD CONSTRAINT `proyectotesis_ibfk_4` FOREIGN KEY (`Jurado_2`) REFERENCES `jurados` (`id`),
  ADD CONSTRAINT `proyectotesis_ibfk_5` FOREIGN KEY (`Jurado_3`) REFERENCES `jurados` (`id`);

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
  ADD CONSTRAINT `tesista_ibfk_1` FOREIGN KEY (`EscuelaProfesional_Id`) REFERENCES `escuelaprofesional` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

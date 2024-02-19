-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 19-02-2024 a las 02:12:00
-- Versión del servidor: 10.4.32-MariaDB
-- Versión de PHP: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `poli-informa`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `horarios`
--

CREATE TABLE `horarios` (
  `id` int(11) NOT NULL,
  `nombre_laboratorio` varchar(100) NOT NULL,
  `maestro` varchar(50) NOT NULL,
  `hora_inicio` varchar(10) NOT NULL,
  `hora_fin` varchar(10) NOT NULL,
  `dias` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `horarios`
--

INSERT INTO `horarios` (`id`, `nombre_laboratorio`, `maestro`, `hora_inicio`, `hora_fin`, `dias`) VALUES
(8, 'Taller1', 'Diego', '9:00', '1:00', 'Miercoles'),
(9, 'Taller1', 'Diego', '9:00', '1:00', 'Jueves'),
(10, 'Taller1', 'Diego', '9:00', '1:00', 'Jueves'),
(11, 'Taller1', 'Diego', '9:00', '1:00', 'Miercoles'),
(12, 'Taller1', 'Diego', '9:00', '1:00', 'Miercoles'),
(13, 'Taller1', 'Diego', '9:00', '1:00', 'Miercoles'),
(14, 'Taller1', 'Diego', '9:00', '1:00', 'Miercoles'),
(15, 'Taller1', 'Diego', '9:00', '1:00', 'Miercoles'),
(16, 'Taller1', 'Diego', '9:00', '1:00', 'Miercoles'),
(17, 'Taller1', 'Diego', '9:00', '1:00', 'Miercoles'),
(18, 'Taller1', 'Diego', '9:00', '1:00', 'Miercoles'),
(19, 'Taller1', 'Diego', '9:00', '1:00', 'Miercoles'),
(20, 'Taller1', 'Diego', '9:00', '1:00', 'Miercoles');

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `horarios`
--
ALTER TABLE `horarios`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `horarios`
--
ALTER TABLE `horarios`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

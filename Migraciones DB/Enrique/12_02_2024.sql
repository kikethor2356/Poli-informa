-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 12-02-2024 a las 22:51:21
-- Versión del servidor: 10.4.28-MariaDB
-- Versión de PHP: 8.2.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `poli_informa`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `horarios_maestros`
--

CREATE TABLE `horarios_maestros` (
  `id` int(11) NOT NULL,
  `maestro_id` int(11) NOT NULL,
  `hora_inicio` time NOT NULL,
  `hora_fin` time NOT NULL,
  `dia_semana` varchar(20) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `horarios_maestros`
--

INSERT INTO `horarios_maestros` (`id`, `maestro_id`, `hora_inicio`, `hora_fin`, `dia_semana`, `created_at`, `updated_at`) VALUES
(1, 2, '10:00:00', '02:00:00', 'Jueves', '2024-02-12 19:09:56', '2024-02-12 19:09:56'),
(2, 2, '10:00:00', '02:00:00', 'Jueves', '2024-02-12 20:27:28', '2024-02-12 20:27:28'),
(3, 2, '10:00:00', '02:00:00', 'Jueves', '2024-02-12 20:28:06', '2024-02-12 20:28:06'),
(4, 2, '10:00:00', '02:00:00', 'Jueves', '2024-02-12 20:28:09', '2024-02-12 20:28:09'),
(5, 2, '10:00:00', '02:00:00', 'Jueves', '2024-02-12 20:29:36', '2024-02-12 20:29:36'),
(6, 17, '11:00:00', '12:00:00', 'Jueves', '2024-02-12 20:33:33', '2024-02-12 20:33:33');

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `horarios_maestros`
--
ALTER TABLE `horarios_maestros`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `horarios_maestros`
--
ALTER TABLE `horarios_maestros`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

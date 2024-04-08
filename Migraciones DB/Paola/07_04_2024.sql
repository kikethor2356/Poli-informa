-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 08-04-2024 a las 04:15:57
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
-- Base de datos: `poli_informa`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `registro`
--

CREATE TABLE `registro` (
  `id` int(11) NOT NULL,
  `AdCode` int(20) NOT NULL,
  `AdNombre` varchar(50) NOT NULL,
  `AdApellidoP` varchar(50) NOT NULL,
  `AdApellidoM` varchar(50) NOT NULL,
  `AdCarrera` varchar(200) NOT NULL,
  `AdCorreo` varchar(100) NOT NULL,
  `AdImagen` varchar(100) NOT NULL,
  `AdPassword` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `registro`
--

INSERT INTO `registro` (`id`, `AdCode`, `AdNombre`, `AdApellidoP`, `AdApellidoM`, `AdCarrera`, `AdCorreo`, `AdImagen`, `AdPassword`) VALUES
(2, 444444, 'bryan', 'Frias', 'Cipriano', ' TPSI', ' FONSECA@123.COM', '65f4d8e099e82-Agenda_1.png', 'bryan123'),
(3, 333333333, 'luis', 'martinez', 'sanchez', 'tpsi', 'paola@gmail.com', '66133edd04d48-inico.1.png', '123pao'),
(4, 22222, 'pao', 'martinez', 'sanchez', 'tpsi', 'paola@gmail.com', '65f11662e6f9d-', '123pao'),
(7, 555555, 'Diego', 'Ocampo', 'Padilla', 'TPSI', 'diego@gmail.com', '65f5a16bc8e4e-', '123321d'),
(8, 220813377, 'Uriel', 'Ramos', 'Lopez', ' TPPQ ', 'Uriel@gmail.com', '65f5e0dd11709-Agenda_Fondo.png', 'patoeningles'),
(11, 220813555, 'Pao', 'Martinez', 'Sanchez', 'TPSI', 'paola@gmail.com', '65fa5ff7a6694-Inicio.png', '123paoLa'),
(12, 222222222, 'Uriel', 'Ramos', 'Lopez', ' TPPQ', 'Uriel@gmail.com', '65fa5a3e77d5c-', 'Uriel123'),
(13, 22222, 'pao', 'martinez', 'sanchez', ' TPPQ', 'guerra@gmail.com', '65fa63135ca7d-inico.1.png', 'Pao012'),
(17, 111111111, 'Paola', 'Sanchez', 'Martinez', 'TQQP', 'TengoM@gmail.com', '6600acb9d4bad-', 'Pao123'),
(18, 33333, 'Javier', 'Francisco', 'Lopez', 'TPPQ', 'lopez@gmail.com', '6600e5027841b-', 'Lopez12'),
(21, 555555, 'Diego', 'Ocampo', 'Padilla', 'TPSI', 'diego@gmail.com', '6607180d4f350-', '123Pablo'),
(24, 220813333, 'Pao', 'Martinez', 'Sanchez', 'Tpsi', 'pao@gmail.com', '660cccaeab3a8-', 'pao123');

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `registro`
--
ALTER TABLE `registro`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `registro`
--
ALTER TABLE `registro`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=25;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1:3306
-- Tiempo de generación: 30-03-2024 a las 00:29:35
-- Versión del servidor: 8.0.31
-- Versión de PHP: 8.0.26

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
-- Estructura de tabla para la tabla `avisos`
--

DROP TABLE IF EXISTS `avisos`;
CREATE TABLE IF NOT EXISTS `avisos` (
  `id_categoria` int NOT NULL AUTO_INCREMENT,
  `categoria` varchar(100) NOT NULL,
  `foto` varchar(1000) NOT NULL,
  PRIMARY KEY (`id_categoria`)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Volcado de datos para la tabla `avisos`
--

INSERT INTO `avisos` (`id_categoria`, `categoria`, `foto`) VALUES
(7, 'dscsd', 'cafe.jpg');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `cafeteriacanchas`
--

DROP TABLE IF EXISTS `cafeteriacanchas`;
CREATE TABLE IF NOT EXISTS `cafeteriacanchas` (
  `cafeteriacanchas_id` int NOT NULL AUTO_INCREMENT,
  `nombre_producto` varchar(150) NOT NULL,
  `descripcion` varchar(350) NOT NULL,
  `precio` int NOT NULL,
  `imagen` varchar(1000) NOT NULL,
  `prodcategoria_id` int NOT NULL,
  PRIMARY KEY (`cafeteriacanchas_id`),
  KEY `prodcategoria_id` (`prodcategoria_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `cafeteriamodulo_a`
--

DROP TABLE IF EXISTS `cafeteriamodulo_a`;
CREATE TABLE IF NOT EXISTS `cafeteriamodulo_a` (
  `cafeteriama_id` int NOT NULL AUTO_INCREMENT,
  `nombre_producto` varchar(150) NOT NULL,
  `descripcion` varchar(350) NOT NULL,
  `precio` int NOT NULL,
  `imagen` varchar(10000) NOT NULL,
  `prodcategoria_id` int NOT NULL,
  PRIMARY KEY (`cafeteriama_id`),
  KEY `prodcategoria_id` (`prodcategoria_id`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Volcado de datos para la tabla `cafeteriamodulo_a`
--

INSERT INTO `cafeteriamodulo_a` (`cafeteriama_id`, `nombre_producto`, `descripcion`, `precio`, `imagen`, `prodcategoria_id`) VALUES
(1, 'Paleta de la rosa', 'Paleta de la rosa que tien sabor a sandia y un chicle en medio', 3, 'paleta.jpg', 1),
(2, 'Cafe', 'Cafe caliente', 25, 'cafe.jpg', 3),
(3, 'dssf', 'dsfsf', 34, 'cafe.jpg', 7),
(4, 'erfer', 'erfer', 54, 'paleta.jpg', 9),
(5, 'sdcsdc', 'sdcsd', 1, 'cafe.jpg', 8);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `categorias_cafeteria`
--

DROP TABLE IF EXISTS `categorias_cafeteria`;
CREATE TABLE IF NOT EXISTS `categorias_cafeteria` (
  `categoria_id` int NOT NULL AUTO_INCREMENT,
  `categoria_nombre` varchar(50) NOT NULL,
  PRIMARY KEY (`categoria_id`)
) ENGINE=InnoDB AUTO_INCREMENT=12 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Volcado de datos para la tabla `categorias_cafeteria`
--

INSERT INTO `categorias_cafeteria` (`categoria_id`, `categoria_nombre`) VALUES
(1, 'Dulce'),
(2, 'Salado'),
(3, 'Bebida Calientes'),
(4, 'Bebidas Frias'),
(5, 'Pan'),
(6, 'Pasteles y Postres'),
(7, 'Desayuno'),
(8, 'Gaseoso'),
(9, 'Snack'),
(10, 'Fritura'),
(11, 'Frutas');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `productos`
--

DROP TABLE IF EXISTS `productos`;
CREATE TABLE IF NOT EXISTS `productos` (
  `ID` int NOT NULL AUTO_INCREMENT,
  `nombre` varchar(200) DEFAULT NULL,
  `codigoVendedor` int NOT NULL,
  `precio` decimal(10,2) DEFAULT NULL,
  `descripcion` varchar(300) DEFAULT NULL,
  `nombreImagen` varchar(150) DEFAULT NULL,
  `categoria` varchar(30) DEFAULT NULL,
  PRIMARY KEY (`ID`,`codigoVendedor`),
  KEY `codigoVendedor` (`codigoVendedor`)
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Volcado de datos para la tabla `productos`
--

INSERT INTO `productos` (`ID`, `nombre`, `codigoVendedor`, `precio`, `descripcion`, `nombreImagen`, `categoria`) VALUES
(4, 'jd', 0, '0.00', '', 'Captura de pantalla 2023-08-30 154049.png', 'Dulce'),
(6, 'papas', 0, '33.00', '', '', 'Salado');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `vendedores`
--

DROP TABLE IF EXISTS `vendedores`;
CREATE TABLE IF NOT EXISTS `vendedores` (
  `id` int NOT NULL AUTO_INCREMENT,
  `codigoVendedor` varchar(50) NOT NULL,
  `nombre` varchar(50) DEFAULT NULL,
  `descripcion` varchar(400) DEFAULT NULL,
  `correo` varchar(70) DEFAULT NULL,
  `telefono` varchar(13) DEFAULT NULL,
  `horaInicio` varchar(10) DEFAULT NULL,
  `horaFin` varchar(10) DEFAULT NULL,
  `foto` varchar(150) DEFAULT NULL,
  PRIMARY KEY (`id`,`codigoVendedor`)
) ENGINE=InnoDB AUTO_INCREMENT=21 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Volcado de datos para la tabla `vendedores`
--

INSERT INTO `vendedores` (`id`, `codigoVendedor`, `nombre`, `descripcion`, `correo`, `telefono`, `horaInicio`, `horaFin`, `foto`) VALUES
(12, '2203032', 'Usuario1', 'sirve', 'ag8758191@gmail.com', '3315290529', '9:00 am', '11:00 am', 'WhatsApp Image 2023-12-03 at 00.02.40.jpeg'),
(13, '22088888', 'Usuario2', 'prueba', 'ag8758191@gmail.com', '3315290529', '11:00 am', '16:00 pm', 'imagen.png'),
(14, '33333', 'Usuario3', 'sirve', 'ag8758191@gmail.com', '132', '18:00 pm', '21:00 pm', ''),
(15, '2222', 'Usuario4', 'prueba', 'ag8758191@gmail.com', '331529', '13:00 pm', '19:00 pm', 'Anexo4.pdf'),
(20, '32', 'FKNWEB', '32erwvdfvdfvf', 'VNIEJRBV@g', '3232', '16:00 pm', '20:00 pm', 'WhatsApp Image 2023-12-03 at 00.02.40.jpeg');

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `cafeteriacanchas`
--
ALTER TABLE `cafeteriacanchas`
  ADD CONSTRAINT `cafeteriacanchas_ibfk_1` FOREIGN KEY (`prodcategoria_id`) REFERENCES `categorias_cafeteria` (`categoria_id`) ON DELETE RESTRICT ON UPDATE CASCADE;

--
-- Filtros para la tabla `cafeteriamodulo_a`
--
ALTER TABLE `cafeteriamodulo_a`
  ADD CONSTRAINT `cafeteriamodulo_a_ibfk_1` FOREIGN KEY (`prodcategoria_id`) REFERENCES `categorias_cafeteria` (`categoria_id`) ON DELETE RESTRICT ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

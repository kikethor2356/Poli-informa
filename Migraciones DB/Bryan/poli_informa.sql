-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1:3306
-- Tiempo de generación: 30-04-2024 a las 09:11:54
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
) ENGINE=InnoDB AUTO_INCREMENT=28 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Volcado de datos para la tabla `cafeteriamodulo_a`
--

INSERT INTO `cafeteriamodulo_a` (`cafeteriama_id`, `nombre_producto`, `descripcion`, `precio`, `imagen`, `prodcategoria_id`) VALUES
(1, 'Paleta de la rosa', 'Paleta chica de sabor fresa con un chique en medio del caramelo', 3, 'paleta.jpg', 1),
(2, 'Cafe', 'Cafe negro, caliente con dos cucharas y media de azucar', 25, 'cafe.jpg', 2),
(3, 'Bolsa', 'Bolsa de plastico', 32, 'images (1).jpeg', 3),
(4, 'Ropa', 'Ropa de talla media', 3, 'images.jpeg', 4),
(5, 'Cosmetico', 'Faltas con estilo\r\n', 99, 'descarga (4).jpeg', 5),
(6, 'vjekrkb', 'jbdfhn kjdfn bhfbdnvl', 9, 'descarga (3).jpeg', 6),
(7, 'fuhrtybdfhf', 'vnbjbnhjnj', 21, 'descarga (2).jpeg', 7),
(8, 't436gfwefgv', 'vfsgvewdabvhasv', 12, 'descarga (1).jpeg', 8),
(9, 'HYvhjdsbvhjb', 'nhdfbvhdsbvj', 912, 'descarga.jpeg', 9),
(10, 'Hola99', 'jdbsvhbs', 32, 'ver-removebg-preview.png', 10),
(11, 'Hicsdbvjb', 'bdfsihbvdfnhhdfbvjsdb', 32, 'Tablero en blanco (1).jpeg', 11),
(12, 'bb', 'jdbkjvb', 12, 'Diagrama de comunicación.jpeg', 5),
(13, 'ewbf', 'bdfjkb', 23, 'Diagrama sin título.jpg', 10),
(14, 'cdsjb', 'bfjb', 43, 'ArbolDesicionAdministrador.jpeg', 10),
(15, 'wedjew', 'bvfb', 32, 'DiagramaActividades.jpeg', 1),
(16, 'wvj', 'kjbvfkjb', 32, 'cafe.jpg', 1),
(17, 'Dulce', 'njsddhcvs', 11, 'paleta.jpg', 1),
(18, 'fknrbh', 'nehjbgjh', 27, 'Captura de pantalla 2023-08-30 154049.png', 1),
(19, 'hru43grdsj', 'bvsdfhb vjs', 12, 'Captura de pantalla 2023-08-30 154049.png', 1),
(20, 'fbehjvbe', 'bsdjhv sjb ', 15, 'Captura de pantalla 2023-08-30 194258.png', 2),
(21, 'kmf v hjdf', ' vjkf vjkwdn', 30, 'Captura de pantalla 2023-08-31 172626.png', 2),
(22, 'ewfkjbwk', 'bvhjbv', 23, 'Captura de pantalla 2023-08-31 190210.png', 3),
(23, 'vbfshvjbwj', 'dwhvbshbvajn', 24, 'Captura de pantalla 2023-08-31 214145.png', 4),
(24, 'askjbk', 'bdsjkv skj', 8, 'Captura de pantalla 2023-09-14 120827.png', 6),
(25, 'ervjeb', 'jbhjbjefnkd', 10, 'Captura de pantalla 2023-09-25 190457.png', 7),
(26, 'fvjnej', 'jfekjbvjken', 13, 'Captura de pantalla 2023-11-14 232749.png', 8),
(27, 'fwnbj', 'ndkjvbkjdsfbkj', 28, 'Captura de pantalla 2023-11-17 181151.png', 9);

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
-- Estructura de tabla para la tabla `horarios`
--

DROP TABLE IF EXISTS `horarios`;
CREATE TABLE IF NOT EXISTS `horarios` (
  `id` int NOT NULL AUTO_INCREMENT,
  `nombre_laboratorio` varchar(100) COLLATE utf8mb4_general_ci NOT NULL,
  `maestro` varchar(50) COLLATE utf8mb4_general_ci NOT NULL,
  `hora_inicio` varchar(10) COLLATE utf8mb4_general_ci NOT NULL,
  `hora_fin` varchar(10) COLLATE utf8mb4_general_ci NOT NULL,
  `dias` varchar(20) COLLATE utf8mb4_general_ci NOT NULL,
  `turno` varchar(10) COLLATE utf8mb4_general_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=186 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `horarios`
--

INSERT INTO `horarios` (`id`, `nombre_laboratorio`, `maestro`, `hora_inicio`, `hora_fin`, `dias`, `turno`) VALUES
(154, 'Laboratorio de especialidades', 'Enrique Alejandro', '7:00 am', '8:00 am', 'Jueves', 'Matutino'),
(156, 'Laboratorio de especialidades', 'Enrique Alejandro', '9:00 am', '7:00 am', 'Lunes', 'Matutino'),
(158, 'Laboratorio de especialidades', 'Enrique Alejandro', '7:00 am', '7:00 am', 'Lunes', 'Matutino'),
(160, 'Laboratorio de especialidades', 'Enrique Alejandro', '7:00 am', '8:00 am', 'Sabado', 'Matutino'),
(163, 'Laboratorio de especialidades', 'Enrique Alejandro', '7:00 am', '11:00 am', 'Lunes', 'Matutino'),
(165, 'Laboratorio de redes', 'Luis Andres', '7:00 am', '8:00 am', 'Martes', 'Matutino'),
(166, 'Laboratorio de especialidades', 'Luis Andres', '7:00 am', '8:00 am', 'Miercoles', 'Matutino'),
(169, 'Laboratorio de especialidades', 'Luis Andres', '11:00 am', '7:00 am', 'Miercoles', 'Matutino'),
(171, 'Laboratorio de especialidades', 'Enrique Alejandro', '7:00 am', '8:00 am', 'Viernes', 'Matutino'),
(177, 'Laboratorio de especialidades', 'Enrique Alejandro', '11:00 am', '7:00 am', 'Lunes', 'Matutino'),
(178, 'Laboratorio de redes', 'Enrique Alejandro', '7:00 am', '8:00 am', 'Miercoles', 'Matutino'),
(180, 'Laboratorio de metalurgia', 'Enrique Alejandro', '10:00 am', '12:00 pm', 'Jueves', 'Matutino'),
(181, 'Laboratorio de metalurgia', 'Luis Andres', '7:00 am', '10:00 am', 'Lunes', 'Matutino'),
(182, 'Redes', 'Pimienta', '', '', 'Lunes', 'Matutino'),
(183, 'Taller1', 'Pimienta', '7:00 am', '8:00 am', 'Lunes', 'Matutino'),
(184, 'Redes', 'Pimienta', '', '', 'Martes', 'Matutino'),
(185, 'Laboraorio de especialidades', 'Pimienta', '8:00 am', '10:00 am', 'Lunes', 'Matutino');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `laboratorios`
--

DROP TABLE IF EXISTS `laboratorios`;
CREATE TABLE IF NOT EXISTS `laboratorios` (
  `id` int NOT NULL AUTO_INCREMENT,
  `Nombre` varchar(100) COLLATE utf8mb4_general_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=46 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `laboratorios`
--

INSERT INTO `laboratorios` (`id`, `Nombre`) VALUES
(41, 'Taller1'),
(42, 'Laboraorio de especialidades'),
(43, 'Redes'),
(44, 'Taller3'),
(45, 'Laboratorio de informatica');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `maestros`
--

DROP TABLE IF EXISTS `maestros`;
CREATE TABLE IF NOT EXISTS `maestros` (
  `id` int NOT NULL AUTO_INCREMENT,
  `Nombre` varchar(100) COLLATE utf8mb4_general_ci NOT NULL,
  `Apellidos` varchar(100) COLLATE utf8mb4_general_ci NOT NULL,
  `Correo` varchar(200) COLLATE utf8mb4_general_ci NOT NULL,
  `Codigo` varchar(9) COLLATE utf8mb4_general_ci NOT NULL,
  `Imagen` varchar(255) COLLATE utf8mb4_general_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=31 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `maestros`
--

INSERT INTO `maestros` (`id`, `Nombre`, `Apellidos`, `Correo`, `Codigo`, `Imagen`) VALUES
(26, 'Efren', 'Cisneros', 'efren@gmail.com', '2222132', 'Pastel Pink Light Blue Clean UI Web Developer CV (1).png'),
(28, 'Efren', 'Pimienta', 'efren.islael2356@gmail.com', '2222132', 'Pastel Pink Light Blue Clean UI Web Developer CV (1).png'),
(30, 'AlejandrO', 'Gutierrez', 'enrique.alejandro2356@gmail.com', '220814195', 'top-lenguajes-de-programación-2015.jpg');

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
(4, 'jd1', 0, '0.00', 'asnfwk', '', 'Dulce');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `registro`
--

DROP TABLE IF EXISTS `registro`;
CREATE TABLE IF NOT EXISTS `registro` (
  `id` int NOT NULL AUTO_INCREMENT,
  `AdCode` int NOT NULL,
  `AdNombre` varchar(50) COLLATE utf8mb4_general_ci NOT NULL,
  `AdApellidoP` varchar(50) COLLATE utf8mb4_general_ci NOT NULL,
  `AdApellidoM` varchar(50) COLLATE utf8mb4_general_ci NOT NULL,
  `AdCarrera` varchar(200) COLLATE utf8mb4_general_ci NOT NULL,
  `AdCorreo` varchar(100) COLLATE utf8mb4_general_ci NOT NULL,
  `AdImagen` varchar(100) COLLATE utf8mb4_general_ci NOT NULL,
  `AdPassword` varchar(20) COLLATE utf8mb4_general_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=25 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

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

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `registroalu`
--

DROP TABLE IF EXISTS `registroalu`;
CREATE TABLE IF NOT EXISTS `registroalu` (
  `id` int NOT NULL AUTO_INCREMENT,
  `CodeAlu` int NOT NULL,
  `AluNom` varchar(50) COLLATE utf8mb4_general_ci NOT NULL,
  `AluApellidoP` varchar(50) COLLATE utf8mb4_general_ci NOT NULL,
  `AluApellidoM` varchar(50) COLLATE utf8mb4_general_ci NOT NULL,
  `AluCarrera` varchar(200) COLLATE utf8mb4_general_ci NOT NULL,
  `AluCorreo` varchar(100) COLLATE utf8mb4_general_ci NOT NULL,
  `AluImage` varchar(100) COLLATE utf8mb4_general_ci NOT NULL,
  `AluPassword` varchar(100) COLLATE utf8mb4_general_ci NOT NULL,
  `recovery_token` varchar(255) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `token_expiration` datetime DEFAULT NULL,
  `esVendedor` tinyint NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=20 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `registroalu`
--

INSERT INTO `registroalu` (`id`, `CodeAlu`, `AluNom`, `AluApellidoP`, `AluApellidoM`, `AluCarrera`, `AluCorreo`, `AluImage`, `AluPassword`, `recovery_token`, `token_expiration`, `esVendedor`) VALUES
(7, 333333333, 'hola', 'pancho', 'MARCELO', 'TPPQ', 'pan@gmail.com', '66144007b5fcf-inico.1.png', 'cc832b6aa736c3e09c03c48a8e9ca9ca', NULL, NULL, 0),
(18, 220813628, 'B', 'F', 'C', 'T', 'bryan.frias1362@alumnos.udg.mx', 'Captura de pantalla 2023-08-31 214145.png', 'Hola1', NULL, NULL, 0);

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
) ENGINE=InnoDB AUTO_INCREMENT=59 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Volcado de datos para la tabla `vendedores`
--

INSERT INTO `vendedores` (`id`, `codigoVendedor`, `nombre`, `descripcion`, `correo`, `telefono`, `horaInicio`, `horaFin`, `foto`) VALUES
(13, '22088888', 'Usuario2', 'prueba', 'ag8758191@gmail.com', '3315290529', '11:00 am', '16:00 pm', 'imagen.png');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `vendedores_pendientes`
--

DROP TABLE IF EXISTS `vendedores_pendientes`;
CREATE TABLE IF NOT EXISTS `vendedores_pendientes` (
  `id` int NOT NULL AUTO_INCREMENT,
  `codigoVendedor` int NOT NULL,
  `nombre` varchar(1000) NOT NULL,
  `descripcion` varchar(1000) NOT NULL,
  `correo` varchar(1000) NOT NULL,
  `telefono` varchar(1000) NOT NULL,
  `horaInicio` varchar(1000) NOT NULL,
  `horaFin` varchar(1000) NOT NULL,
  `foto` varchar(1000) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=44 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `venqys`
--

DROP TABLE IF EXISTS `venqys`;
CREATE TABLE IF NOT EXISTS `venqys` (
  `id` int NOT NULL AUTO_INCREMENT,
  `UsNombre` varchar(200) COLLATE utf8mb4_general_ci NOT NULL,
  `UsCorreo` varchar(400) COLLATE utf8mb4_general_ci NOT NULL,
  `UsComentario` varchar(1000) COLLATE utf8mb4_general_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `venqys`
--

INSERT INTO `venqys` (`id`, `UsNombre`, `UsCorreo`, `UsComentario`) VALUES
(1, '', '', ''),
(2, '', '', ''),
(3, 'Alex', 'alex@gmail.com', ''),
(4, 'laura', 'laura@gmail.com', ''),
(5, 'Paola', 'paola@gmail.com', ''),
(6, '', '', ''),
(7, 'Vanesa', 'vanesa@gmail.com', 'le falta diseño'),
(8, 'liz', 'liz_sanchezjb@hotmail.com', 'Me gusta la página'),
(9, 'Bryan', '123@gmail.com', 'no me gusta el dieño');

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

-- phpMyAdmin SQL Dump
-- version 4.5.2
-- http://www.phpmyadmin.net
--
-- Servidor: localhost
-- Tiempo de generación: 18-06-2017 a las 19:45:01
-- Versión del servidor: 10.1.13-MariaDB
-- Versión de PHP: 5.5.34

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `cardtrade`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `cartas`
--

CREATE TABLE `cartas` (
  `idCarta` varchar(13) COLLATE utf8_unicode_ci NOT NULL,
  `Codigo` varchar(45) COLLATE utf8_unicode_ci NOT NULL,
  `Nombre` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `Atributo` varchar(45) COLLATE utf8_unicode_ci DEFAULT NULL,
  `Coste` varchar(10) COLLATE utf8_unicode_ci DEFAULT NULL,
  `CMC` int(11) DEFAULT NULL,
  `Tipo` varchar(45) COLLATE utf8_unicode_ci DEFAULT NULL,
  `ATK` int(11) DEFAULT NULL,
  `DEF` int(11) DEFAULT NULL,
  `Caracteristicas` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
  `Clase` varchar(45) COLLATE utf8_unicode_ci DEFAULT NULL,
  `Rareza` varchar(45) COLLATE utf8_unicode_ci DEFAULT NULL,
  `Edicion` varchar(45) COLLATE utf8_unicode_ci DEFAULT NULL,
  `Imagen` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Volcado de datos para la tabla `cartas`
--

INSERT INTO `cartas` (`idCarta`, `Codigo`, `Nombre`, `Atributo`, `Coste`, `CMC`, `Tipo`, `ATK`, `DEF`, `Caracteristicas`, `Clase`, `Rareza`, `Edicion`, `Imagen`) VALUES
('1', 'TAT-095R', 'Magic Stone of Dark Depth', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'TAT', 'TAT-095R.jpg'),
('2', 'RL 1604-2', 'Water Magic Stone', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'RL', 'RL 1604-2.jpg'),
('3', 'PR2015-031', 'Kaguya, the Tale of the Bamboo Cutter', NULL, NULL, NULL, NULL, 300, 300, NULL, NULL, NULL, 'PR', 'PR2015-031.jpg'),
('4', 'RL1602-1', 'Alice, the Guardian of Dimensions', NULL, NULL, NULL, NULL, 700, 700, NULL, NULL, NULL, 'RL', 'RL1602-1.jpg');

-- --------------------------------------------------------

--
-- Estructura Stand-in para la vista `emisores`
--
CREATE TABLE `emisores` (
`id` varchar(13)
);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `fasciculos`
--

CREATE TABLE `fasciculos` (
  `idFasciculo` varchar(13) COLLATE utf8_unicode_ci NOT NULL,
  `idCarta` varchar(13) COLLATE utf8_unicode_ci NOT NULL,
  `idUsuario` varchar(13) COLLATE utf8_unicode_ci NOT NULL,
  `Precio` float NOT NULL,
  `Estilo` varchar(45) COLLATE utf8_unicode_ci NOT NULL,
  `Calidad` varchar(45) COLLATE utf8_unicode_ci NOT NULL,
  `Vendido` tinyint(4) DEFAULT '0',
  `Cantidad` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Volcado de datos para la tabla `fasciculos`
--

INSERT INTO `fasciculos` (`idFasciculo`, `idCarta`, `idUsuario`, `Precio`, `Estilo`, `Calidad`, `Vendido`, `Cantidad`) VALUES
('593856cadfab6', '2', '5936f60eeb0b4', 2, 'Foil', 'Semi nueva', 0, 3),
('59385c14d2798', '4', '5936f6bb63249', 3.6, 'Full art', 'Nueva', 0, 3),
('59413efb0581b', '3', '5936f6bb63249', 3.5, 'Normal', 'Nueva', 1, 0);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `mensajes`
--

CREATE TABLE `mensajes` (
  `idMensaje` varchar(13) COLLATE utf8_unicode_ci DEFAULT NULL,
  `idEmisor` varchar(13) COLLATE utf8_unicode_ci NOT NULL,
  `idReceptor` varchar(13) COLLATE utf8_unicode_ci NOT NULL,
  `FecEnvio` datetime NOT NULL,
  `Texto` text COLLATE utf8_unicode_ci NOT NULL,
  `Visto` tinyint(1) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Volcado de datos para la tabla `mensajes`
--

INSERT INTO `mensajes` (`idMensaje`, `idEmisor`, `idReceptor`, `FecEnvio`, `Texto`, `Visto`) VALUES
('5936fc2d020ac', '5936f60eeb0b4', '5936f6bb63249', '2017-05-06 21:02:04', 'Hola, ¿me llegará antes de una semana?', 0),
('5936fc7463a0a', '5936f6bb63249', '5936f60eeb0b4', '2017-05-06 21:03:16', 'Claro, en principio no habría problema.', 0),
('5939135647c19', '5936f60eeb0b4', '5936f6bb63249', '2017-05-08 11:05:26', 'He recibido la cara si problemas!', 0),
('59413dce1dbd8', '5936f6bb63249', '5936f60eeb0b4', '2017-05-14 15:44:46', 'Me alegro', 0),
('59415f5171a54', '5936f60eeb0b4', '5936f6bb63249', '2017-05-14 18:07:45', 'Si yo tambien', 0);

-- --------------------------------------------------------

--
-- Estructura Stand-in para la vista `receptores`
--
CREATE TABLE `receptores` (
`id` varchar(13)
);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `transacciones`
--

CREATE TABLE `transacciones` (
  `idVenta` varchar(13) COLLATE utf8_unicode_ci NOT NULL,
  `idFasciculo` varchar(13) COLLATE utf8_unicode_ci NOT NULL,
  `idVendedor` varchar(13) COLLATE utf8_unicode_ci NOT NULL,
  `idComprador` varchar(13) COLLATE utf8_unicode_ci NOT NULL,
  `gastoEnvio` float NOT NULL,
  `Cantidad` int(11) NOT NULL,
  `FecVenta` datetime NOT NULL,
  `Enviado` tinyint(1) NOT NULL DEFAULT '0',
  `Recibido` tinyint(1) NOT NULL DEFAULT '0',
  `NumSeguimiento` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `webRepartidor` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `Precio` float NOT NULL,
  `PrecioTOTAL` float NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Volcado de datos para la tabla `transacciones`
--

INSERT INTO `transacciones` (`idVenta`, `idFasciculo`, `idVendedor`, `idComprador`, `gastoEnvio`, `Cantidad`, `FecVenta`, `Enviado`, `Recibido`, `NumSeguimiento`, `webRepartidor`, `Precio`, `PrecioTOTAL`) VALUES
('5936fcbbe7e26', '5936fbc41d46f', '5936f6bb63249', '5936f60eeb0b4', 1.5, 2, '2017-05-06 21:04:27', 1, 1, '', '', 2.56, 6.62),
('59385ce807cbe', '593856cadfab6', '5936f60eeb0b4', '5936f6bb63249', 1.5, 1, '2017-05-07 22:07:01', 1, 1, '', '', 2, 3.5),
('593912a360401', '59385c14d2798', '5936f6bb63249', '5936f60eeb0b4', 1.5, 2, '2017-05-08 11:02:27', 1, 0, '', '', 3.6, 8.7),
('59413f4ca7339', '59413efb0581b', '5936f6bb63249', '5936f60eeb0b4', 1.5, 1, '2017-05-14 15:51:08', 0, 0, '', '', 3.5, 5);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuarios`
--

CREATE TABLE `usuarios` (
  `idUsuario` varchar(13) COLLATE utf8_unicode_ci NOT NULL,
  `Nick` varchar(45) COLLATE utf8_unicode_ci NOT NULL,
  `Pass` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `Email` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `Nombre` varchar(45) COLLATE utf8_unicode_ci NOT NULL,
  `Apellidos` varchar(45) COLLATE utf8_unicode_ci NOT NULL,
  `Direccion` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
  `Ciudad` varchar(45) COLLATE utf8_unicode_ci DEFAULT NULL,
  `Pais` varchar(45) COLLATE utf8_unicode_ci DEFAULT NULL,
  `DNI` varchar(45) COLLATE utf8_unicode_ci NOT NULL,
  `fechaNac` date NOT NULL,
  `Saldo` float DEFAULT '0',
  `Valoracion` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Volcado de datos para la tabla `usuarios`
--

INSERT INTO `usuarios` (`idUsuario`, `Nick`, `Pass`, `Email`, `Nombre`, `Apellidos`, `Direccion`, `Ciudad`, `Pais`, `DNI`, `fechaNac`, `Saldo`, `Valoracion`) VALUES
('593418dc89481', 'admin', 'admin', 'cardTradeMail@gmail.com', 'Admin', 'Card Trade', 'No Reply', 'Zaragoza', 'España', '0', '1997-01-08', 13.875, 7),
('5936f517affa9', 'aperez', 'aperez', 'antonioperez@gmail.com', 'Antonio', 'Pérez', 'Calle Escarrilas 1', 'Zaragoza', 'España', '1628950Q', '1990-07-14', 0, NULL),
('5936f58dd6ac0', 'lmartin', 'lmartin', 'lauramartin@gmail.com', 'Laura', 'Martín', 'Calle Zuera 3', 'Teruel', 'España', '8155317N', '1987-12-30', 0, NULL),
('5936f60eeb0b4', 'jflores', 'jflores', 'jorgeflores@hotmail.com', 'Jorge', 'Flores', 'Calle Albacete 21', 'Teruel', 'España', '61235416H', '1960-05-08', 10.625, 9),
('5936f6bb63249', 'agalicia', 'agalicia', 'anagalicia@outlook.com', 'Ana', 'Galicia', 'Avenida Madrid 12', 'Huesca', 'España', '12455689G', '2000-06-07', 26.5, 7),
('5937252d0d63c', 'plopez', 'plopez', 'pedrolopez@gmail.com', 'Pedro', 'Lopez', 'Calle Maria Zambrano, 1, 4ºD', 'Zaragoza', 'España', '29561432D', '1998-12-24', 0, NULL),
('59372776eb192', 'pmenta', 'pmenta', 'paulamenta@gmail.com', 'Paula', 'Menta', 'Plaza La Justíca 5', 'Sevilla', 'España', '45645622T', '1994-03-01', 0, NULL);

-- --------------------------------------------------------

--
-- Estructura para la vista `emisores`
--
DROP TABLE IF EXISTS `emisores`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `emisores`  AS  select distinct `m`.`idEmisor` AS `id` from `mensajes` `m` where (`m`.`idReceptor` = '592d9ee00a539') ;

-- --------------------------------------------------------

--
-- Estructura para la vista `receptores`
--
DROP TABLE IF EXISTS `receptores`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `receptores`  AS  select distinct `m`.`idReceptor` AS `id` from `mensajes` `m` where (`m`.`idEmisor` = '592d9ee00a539') ;

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `cartas`
--
ALTER TABLE `cartas`
  ADD UNIQUE KEY `idCarta_UNIQUE` (`idCarta`),
  ADD UNIQUE KEY `Codigo_UNIQUE` (`Codigo`),
  ADD UNIQUE KEY `Imagen_UNIQUE` (`Imagen`);

--
-- Indices de la tabla `fasciculos`
--
ALTER TABLE `fasciculos`
  ADD UNIQUE KEY `idFasciculo_UNIQUE` (`idFasciculo`);

--
-- Indices de la tabla `mensajes`
--
ALTER TABLE `mensajes`
  ADD UNIQUE KEY `idMensaje` (`idMensaje`);

--
-- Indices de la tabla `usuarios`
--
ALTER TABLE `usuarios`
  ADD UNIQUE KEY `idUsuario_UNIQUE` (`idUsuario`),
  ADD UNIQUE KEY `Nick_UNIQUE` (`Nick`),
  ADD UNIQUE KEY `DNI_UNIQUE` (`DNI`),
  ADD UNIQUE KEY `Email_UNIQUE` (`Email`);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

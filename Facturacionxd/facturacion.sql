-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1:3307
-- Tiempo de generación: 30-06-2024 a las 19:52:05
-- Versión del servidor: 10.4.13-MariaDB
-- Versión de PHP: 7.3.21

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `facturacion`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `categorias`
--

DROP TABLE IF EXISTS `categorias`;
CREATE TABLE IF NOT EXISTS `categorias` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nombre` varchar(255) NOT NULL,
  `producto_id` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `FK_producto_id` (`producto_id`)
) ENGINE=MyISAM AUTO_INCREMENT=5 DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `categorias`
--

INSERT INTO `categorias` (`id`, `nombre`, `producto_id`) VALUES
(1, 'muebles de cocina y comedor', 1),
(2, 'muebles de sala', 1),
(3, 'muebles de cuarto', 1),
(4, 'muebles de oficina', 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `cliente`
--

DROP TABLE IF EXISTS `cliente`;
CREATE TABLE IF NOT EXISTS `cliente` (
  `id_cliente` int(11) NOT NULL AUTO_INCREMENT,
  `id_usuario` int(11) NOT NULL,
  `nombre` varchar(50) NOT NULL,
  `apellido` varchar(50) NOT NULL,
  `cuil` varchar(20) NOT NULL,
  `domicilio` varchar(255) NOT NULL,
  `celular` varchar(20) DEFAULT NULL,
  `tipoCliente` varchar(50) DEFAULT NULL,
  PRIMARY KEY (`id_cliente`),
  KEY `id_usuario` (`id_usuario`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `cliente`
--

INSERT INTO `cliente` (`id_cliente`, `id_usuario`, `nombre`, `apellido`, `cuil`, `domicilio`, `celular`, `tipoCliente`) VALUES
(2, 2, 'Juan', 'Perez', '20-12345678-9', 'ya tu sabes xd', '123456789', 'monotributista');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `detalle_factura`
--

DROP TABLE IF EXISTS `detalle_factura`;
CREATE TABLE IF NOT EXISTS `detalle_factura` (
  `id_detalle_factura` int(11) NOT NULL AUTO_INCREMENT,
  `id_factura` int(11) NOT NULL,
  `id_producto` int(11) NOT NULL,
  `cantidad_producto` decimal(10,2) NOT NULL,
  `precio_producto` decimal(10,2) NOT NULL,
  `total_producto` decimal(10,2) NOT NULL,
  `forma_pago` varchar(50) DEFAULT NULL,
  PRIMARY KEY (`id_detalle_factura`),
  KEY `id_factura` (`id_factura`),
  KEY `id_producto` (`id_producto`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `detalle_factura`
--

INSERT INTO `detalle_factura` (`id_detalle_factura`, `id_factura`, `id_producto`, `cantidad_producto`, `precio_producto`, `total_producto`, `forma_pago`) VALUES
(2, 1, 1, '2.00', '100.00', '200.00', 'Tarjeta de crédito');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `factura`
--

DROP TABLE IF EXISTS `factura`;
CREATE TABLE IF NOT EXISTS `factura` (
  `id_factura` int(11) NOT NULL AUTO_INCREMENT,
  `id_usuario` int(11) NOT NULL,
  `fecha` date NOT NULL,
  `total_ante_impuesto` decimal(10,2) NOT NULL,
  `total_impuesto` decimal(10,2) NOT NULL,
  `porcentaje_impuesto` decimal(5,2) NOT NULL,
  `total_despues_impuesto` decimal(10,2) NOT NULL,
  `monto_pagado` decimal(10,2) NOT NULL,
  `total_a_devolver` decimal(10,2) NOT NULL,
  `nota` text NOT NULL,
  PRIMARY KEY (`id_factura`),
  KEY `id_usuario` (`id_usuario`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `factura`
--

INSERT INTO `factura` (`id_factura`, `id_usuario`, `fecha`, `total_ante_impuesto`, `total_impuesto`, `porcentaje_impuesto`, `total_despues_impuesto`, `monto_pagado`, `total_a_devolver`, `nota`) VALUES
(1, 2, '2024-09-25', '250.00', '40.00', '3.00', '298.70', '298.70', '0.00', 'Pago completo');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `producto`
--

DROP TABLE IF EXISTS `producto`;
CREATE TABLE IF NOT EXISTS `producto` (
  `id_producto` int(11) NOT NULL AUTO_INCREMENT,
  `codigo_producto` varchar(250) NOT NULL,
  `descripcion_producto` varchar(250) NOT NULL,
  `precio_producto` decimal(10,2) NOT NULL,
  `categorias_id` int(11) DEFAULT NULL,
  PRIMARY KEY (`id_producto`)
) ENGINE=InnoDB AUTO_INCREMENT=22 DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `producto`
--

INSERT INTO `producto` (`id_producto`, `codigo_producto`, `descripcion_producto`, `precio_producto`, `categorias_id`) VALUES
(1, '0001', 'Alacena blanca de 3 puertas 120x60cm  de Melamina', '67000.00', 1),
(2, '0002', 'Alacena Marron de 4 puertas 140x60cm  de Melamina', '61000.00', 1),
(3, '0003', 'Mesada c/Bacha de acero inoxidable de 120x60 cm', '135000.00', 1),
(4, '0004', 'Mesada c/Bacha de acero inoxidable de 140x60 cm', '145000.00', 1),
(5, '0005', 'Desayunador de Melamina 120x50', '165000.00', 1),
(6, '0006', 'Mesa c/6 sillas Madera de Roble de 175x60cm', '750000.00', 1),
(7, '0007', 'Mesa c/6 sillas  Madera de Alamo de 175x60cm', '450000.00', 1),
(8, '0008', 'Mesa Melamina c/6 sillas de hiero tapizadas cuerina Madera de Alamo de 175x60cm', '320000.00', 1),
(9, '1001', 'Juego de Living de 3 cuerpos de en tela color gris', '790000.00', 2),
(10, '1002', 'Juego de Living de 3 cuerpos de en cuerina color beige', '670000.00', 2),
(11, '1003', 'Futon estructura de Madera de Pino de 120x80', '520000.00', 2),
(12, '1004', 'Futon estructura de Hierro de 120x80', '490000.00', 2),
(13, '1005', 'Mesa de Living de vidrio redonda de 80cm de diametro', '150000.00', 2),
(14, '2001', 'Sommier 180x200cm', '95000.00', 3),
(15, '2002', 'Sommier 120x180cm', '75000.00', 3),
(16, '2003', 'Colchon SuaveStar de 180x200cm', '584000.00', 3),
(17, '2003', 'Colchon SuaveStar de 120x180cm', '43000.00', 3),
(18, '3001', 'Silla giratoria c/5 ruedas', '118000.00', 4),
(19, '3002', 'Silla giratoria ergonomica c/5 ruedas', '130000.00', 4),
(20, '3003', 'Escritorio p/PC c/3 cajones de 180x50', '124000.00', 4),
(21, '3004', 'Escritorio p/PC s/cajones de 160x00', '115000.00', 4);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuario`
--

DROP TABLE IF EXISTS `usuario`;
CREATE TABLE IF NOT EXISTS `usuario` (
  `id_usuario` int(11) NOT NULL AUTO_INCREMENT,
  `nomUsuario` varchar(50) NOT NULL,
  `password` varchar(8) NOT NULL,
  `email` varchar(60) NOT NULL,
  `rol` int(11) NOT NULL,
  PRIMARY KEY (`id_usuario`),
  UNIQUE KEY `nomUsuario` (`nomUsuario`),
  UNIQUE KEY `email` (`email`)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `usuario`
--

INSERT INTO `usuario` (`id_usuario`, `nomUsuario`, `password`, `email`, `rol`) VALUES
(1, 'admin', 'admin123', 'admin@gmail.com', 1),
(2, 'user', 'user1234', 'user@gmail.com', 0),
(6, 'Carla', 'carlu123', 'carlu@gmail.com', 0),
(7, 'lilixd', '$2y$10$l', 'lili@gmail.com', 0);

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `cliente`
--
ALTER TABLE `cliente`
  ADD CONSTRAINT `cliente_ibfk_1` FOREIGN KEY (`id_usuario`) REFERENCES `usuario` (`id_usuario`);

--
-- Filtros para la tabla `detalle_factura`
--
ALTER TABLE `detalle_factura`
  ADD CONSTRAINT `detalle_factura_ibfk_1` FOREIGN KEY (`id_factura`) REFERENCES `factura` (`id_factura`),
  ADD CONSTRAINT `detalle_factura_ibfk_2` FOREIGN KEY (`id_producto`) REFERENCES `producto` (`id_producto`);

--
-- Filtros para la tabla `factura`
--
ALTER TABLE `factura`
  ADD CONSTRAINT `factura_ibfk_1` FOREIGN KEY (`id_usuario`) REFERENCES `usuario` (`id_usuario`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

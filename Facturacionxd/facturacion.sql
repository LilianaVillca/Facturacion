-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Servidor: localhost:3309
-- Tiempo de generación: 24-11-2024 a las 17:00:37
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
-- Base de datos: `facturacion`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `categorias`
--

CREATE TABLE `categorias` (
  `id` int(11) NOT NULL,
  `nombre` varchar(255) NOT NULL,
  `producto_id` int(11) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

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

CREATE TABLE `cliente` (
  `id_cliente` int(11) NOT NULL,
  `nombre` varchar(50) NOT NULL,
  `apellido` varchar(50) NOT NULL,
  `dni` char(8) NOT NULL,
  `domicilio` varchar(255) DEFAULT NULL,
  `celular` varchar(20) DEFAULT NULL,
  `tipo_cliente` enum('responsable inscripto','consumidor final') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `cliente`
--

INSERT INTO `cliente` (`id_cliente`, `nombre`, `apellido`, `dni`, `domicilio`, `celular`, `tipo_cliente`) VALUES
(1, 'Rosa', 'Ferrari', '23654321', 'villa tulumaya', '261456987', 'responsable inscripto');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `detalle_factura`
--

CREATE TABLE `detalle_factura` (
  `id_detalle_factura` int(11) NOT NULL,
  `id_factura` int(11) NOT NULL,
  `id_producto` int(11) NOT NULL,
  `cantidad_producto` int(11) NOT NULL,
  `precio_producto` decimal(10,2) NOT NULL,
  `total_producto` decimal(10,2) NOT NULL,
  `forma_pago` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `detalle_nota_credito`
--

CREATE TABLE `detalle_nota_credito` (
  `id_detalle_nota_credito` int(11) NOT NULL,
  `id_nota_credito` int(11) NOT NULL,
  `id_producto` int(11) NOT NULL,
  `descripcion` varchar(255) NOT NULL,
  `cantidad` int(11) NOT NULL,
  `precio` decimal(10,2) NOT NULL,
  `total` decimal(10,2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `factura`
--

CREATE TABLE `factura` (
  `id_factura` int(11) NOT NULL,
  `id_cliente` int(11) NOT NULL,
  `fecha` date NOT NULL,
  `hora` time NOT NULL,
  `tipoFactura` varchar(50) NOT NULL,
  `subtotal` decimal(10,2) NOT NULL,
  `porcentajeImpuesto` decimal(5,2) NOT NULL,
  `montoImpuesto` decimal(10,2) NOT NULL,
  `total` decimal(10,2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `nota_credito`
--

CREATE TABLE `nota_credito` (
  `id_nota_credito` int(11) NOT NULL,
  `id_cliente` int(11) NOT NULL,
  `id_factura` int(11) DEFAULT NULL,
  `fecha` date NOT NULL,
  `hora` time NOT NULL,
  `motivo` varchar(255) NOT NULL,
  `subtotal` decimal(10,2) NOT NULL,
  `porcentaje_impuesto` decimal(5,2) NOT NULL,
  `monto_impuesto` decimal(10,2) NOT NULL,
  `total` decimal(10,2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `producto`
--

CREATE TABLE `producto` (
  `id_producto` int(11) NOT NULL,
  `codigo_producto` varchar(250) NOT NULL,
  `descripcion_producto` varchar(250) NOT NULL,
  `precio_producto` decimal(10,2) NOT NULL,
  `categorias_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `producto`
--

INSERT INTO `producto` (`id_producto`, `codigo_producto`, `descripcion_producto`, `precio_producto`, `categorias_id`) VALUES
(1, '0001', 'Alacena blanca de 3 puertas 120x60cm  de Melamina', 67000.00, 1),
(2, '0002', 'Alacena Marron de 4 puertas 140x60cm  de Melamina', 61000.00, 1),
(3, '0003', 'Mesada c/Bacha de acero inoxidable de 120x60 cm', 135000.00, 1),
(4, '0004', 'Mesada c/Bacha de acero inoxidable de 140x60 cm', 145000.00, 1),
(5, '0005', 'Desayunador de Melamina 120x50', 165000.00, 1),
(6, '0006', 'Mesa c/6 sillas Madera de Roble de 175x60cm', 750000.00, 1),
(7, '0007', 'Mesa c/6 sillas  Madera de Alamo de 175x60cm', 450000.00, 1),
(8, '0008', 'Mesa Melamina c/6 sillas de hiero tapizadas cuerina Madera de Alamo de 175x60cm', 320000.00, 1),
(9, '1001', 'Juego de Living de 3 cuerpos de en tela color gris', 790000.00, 2),
(10, '1002', 'Juego de Living de 3 cuerpos de en cuerina color beige', 670000.00, 2),
(11, '1003', 'Futon estructura de Madera de Pino de 120x80', 520000.00, 2),
(12, '1004', 'Futon estructura de Hierro de 120x80', 490000.00, 2),
(13, '1005', 'Mesa de Living de vidrio redonda de 80cm de diametro', 150000.00, 2),
(14, '2001', 'Sommier 180x200cm', 95000.00, 3),
(15, '2002', 'Sommier 120x180cm', 75000.00, 3),
(16, '2003', 'Colchon SuaveStar de 180x200cm', 584000.00, 3),
(17, '2003', 'Colchon SuaveStar de 120x180cm', 43000.00, 3),
(18, '3001', 'Silla giratoria c/5 ruedas', 118000.00, 4),
(19, '3002', 'Silla giratoria ergonomica c/5 ruedas', 130000.00, 4),
(20, '3003', 'Escritorio p/PC c/3 cajones de 180x50', 124000.00, 4),
(21, '3004', 'Escritorio p/PC s/cajones de 160x00', 115000.00, 4);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuario`
--

CREATE TABLE `usuario` (
  `id_usuario` int(11) NOT NULL,
  `nomUsuario` varchar(50) NOT NULL,
  `password` varchar(8) NOT NULL,
  `email` varchar(60) NOT NULL,
  `rol` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `usuario`
--

INSERT INTO `usuario` (`id_usuario`, `nomUsuario`, `password`, `email`, `rol`) VALUES
(1, 'admin', 'admin123', 'admin@gmail.com', 1),
(2, 'user', 'user1234', 'user@gmail.com', 0),
(6, 'Carla', 'carlu123', 'carlu@gmail.com', 0),
(7, 'lilixd', '$2y$10$l', 'lili@gmail.com', 0);

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `categorias`
--
ALTER TABLE `categorias`
  ADD PRIMARY KEY (`id`),
  ADD KEY `FK_producto_id` (`producto_id`);

--
-- Indices de la tabla `cliente`
--
ALTER TABLE `cliente`
  ADD PRIMARY KEY (`id_cliente`),
  ADD UNIQUE KEY `dni` (`dni`);

--
-- Indices de la tabla `detalle_factura`
--
ALTER TABLE `detalle_factura`
  ADD PRIMARY KEY (`id_detalle_factura`),
  ADD KEY `id_factura` (`id_factura`),
  ADD KEY `id_producto` (`id_producto`);

--
-- Indices de la tabla `detalle_nota_credito`
--
ALTER TABLE `detalle_nota_credito`
  ADD PRIMARY KEY (`id_detalle_nota_credito`),
  ADD KEY `id_nota_credito` (`id_nota_credito`),
  ADD KEY `id_producto` (`id_producto`);

--
-- Indices de la tabla `factura`
--
ALTER TABLE `factura`
  ADD PRIMARY KEY (`id_factura`),
  ADD KEY `id_cliente` (`id_cliente`);

--
-- Indices de la tabla `nota_credito`
--
ALTER TABLE `nota_credito`
  ADD PRIMARY KEY (`id_nota_credito`),
  ADD KEY `id_factura` (`id_factura`),
  ADD KEY `id_cliente` (`id_cliente`);

--
-- Indices de la tabla `producto`
--
ALTER TABLE `producto`
  ADD PRIMARY KEY (`id_producto`);

--
-- Indices de la tabla `usuario`
--
ALTER TABLE `usuario`
  ADD PRIMARY KEY (`id_usuario`),
  ADD UNIQUE KEY `nomUsuario` (`nomUsuario`),
  ADD UNIQUE KEY `email` (`email`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `categorias`
--
ALTER TABLE `categorias`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT de la tabla `cliente`
--
ALTER TABLE `cliente`
  MODIFY `id_cliente` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT de la tabla `detalle_factura`
--
ALTER TABLE `detalle_factura`
  MODIFY `id_detalle_factura` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `detalle_nota_credito`
--
ALTER TABLE `detalle_nota_credito`
  MODIFY `id_detalle_nota_credito` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `factura`
--
ALTER TABLE `factura`
  MODIFY `id_factura` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `nota_credito`
--
ALTER TABLE `nota_credito`
  MODIFY `id_nota_credito` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `producto`
--
ALTER TABLE `producto`
  MODIFY `id_producto` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;

--
-- AUTO_INCREMENT de la tabla `usuario`
--
ALTER TABLE `usuario`
  MODIFY `id_usuario` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `detalle_factura`
--
ALTER TABLE `detalle_factura`
  ADD CONSTRAINT `detalle_factura_ibfk_1` FOREIGN KEY (`id_factura`) REFERENCES `factura` (`id_factura`) ON DELETE CASCADE,
  ADD CONSTRAINT `detalle_factura_ibfk_2` FOREIGN KEY (`id_producto`) REFERENCES `producto` (`id_producto`) ON DELETE CASCADE;

--
-- Filtros para la tabla `detalle_nota_credito`
--
ALTER TABLE `detalle_nota_credito`
  ADD CONSTRAINT `detalle_nota_credito_ibfk_1` FOREIGN KEY (`id_nota_credito`) REFERENCES `nota_credito` (`id_nota_credito`),
  ADD CONSTRAINT `detalle_nota_credito_ibfk_2` FOREIGN KEY (`id_producto`) REFERENCES `producto` (`id_producto`);

--
-- Filtros para la tabla `factura`
--
ALTER TABLE `factura`
  ADD CONSTRAINT `factura_ibfk_1` FOREIGN KEY (`id_cliente`) REFERENCES `cliente` (`id_cliente`);

--
-- Filtros para la tabla `nota_credito`
--
ALTER TABLE `nota_credito`
  ADD CONSTRAINT `nota_credito_ibfk_1` FOREIGN KEY (`id_factura`) REFERENCES `factura` (`id_factura`),
  ADD CONSTRAINT `nota_credito_ibfk_2` FOREIGN KEY (`id_cliente`) REFERENCES `cliente` (`id_cliente`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

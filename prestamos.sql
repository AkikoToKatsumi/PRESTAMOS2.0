-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 07-07-2024 a las 02:12:53
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
-- Base de datos: `prestamos`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `cliente`
--

CREATE TABLE `cliente` (
  `cliente_id` int(10) NOT NULL,
  `cliente_dni` varchar(30) NOT NULL,
  `cliente_nombre` varchar(50) NOT NULL,
  `cliente_apellido` varchar(50) NOT NULL,
  `cliente_telefono` varchar(20) NOT NULL,
  `cliente_direccion` varchar(200) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish2_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `detalle`
--

CREATE TABLE `detalle` (
  `detalle_id` int(100) NOT NULL,
  `detalle_cantidad` int(10) NOT NULL,
  `detalle_formato` varchar(20) NOT NULL,
  `detalle_tiempo` int(7) NOT NULL,
  `detalle_costo_tiempo` decimal(30,2) NOT NULL,
  `detalle_descripcion` varchar(150) NOT NULL,
  `prestamo_codigo` varchar(200) NOT NULL,
  `item_id` int(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish2_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `empresa`
--

CREATE TABLE `empresa` (
  `empresa_id` int(2) NOT NULL,
  `empresa_nombre` varchar(90) NOT NULL,
  `empresa_email` varchar(70) NOT NULL,
  `empresa_telefono` varchar(20) NOT NULL,
  `empresa_direccion` varchar(200) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish2_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `item`
--

CREATE TABLE `item` (
  `item_id` int(10) NOT NULL,
  `item_codigo` varchar(50) NOT NULL,
  `item_nombre` varchar(150) NOT NULL,
  `item_stock` int(10) NOT NULL,
  `item_estado` varchar(20) NOT NULL,
  `item_detalle` varchar(200) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish2_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `pago`
--

CREATE TABLE `pago` (
  `pago_id` int(20) NOT NULL,
  `pago_total` decimal(30,2) NOT NULL,
  `pago_fecha` date NOT NULL,
  `prestamo_codigo` varchar(200) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish2_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `prestamo`
--

CREATE TABLE `prestamo` (
  `prestamo_id` int(50) NOT NULL,
  `prestamo_codigo` varchar(200) NOT NULL,
  `prestamo_fecha_inicio` date NOT NULL,
  `prestamo_hora_inicio` varchar(15) NOT NULL,
  `prestamo_fecha_final` date NOT NULL,
  `prestamo_hora_final` varchar(15) NOT NULL,
  `prestamo_cantidad` int(10) NOT NULL,
  `prestamo_total` decimal(30,2) NOT NULL,
  `prestamo_pagado` decimal(30,2) NOT NULL,
  `prestamo_estado` varchar(20) NOT NULL,
  `prestamo_observacion` varchar(535) NOT NULL,
  `usuario_id` int(10) NOT NULL,
  `cliente_id` int(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish2_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuario`
--

CREATE TABLE `usuario` (
  `usuario_id` int(10) NOT NULL,
  `usuario_dni` varchar(20) NOT NULL,
  `usuario_nombre` varchar(50) NOT NULL,
  `usuario_apellido` varchar(50) NOT NULL,
  `usuario_telefono` varchar(20) NOT NULL,
  `usuario_direccion` varchar(200) NOT NULL,
  `usuario_email` varchar(150) NOT NULL,
  `usuario_usuario` varchar(50) NOT NULL,
  `usuario_clave` varchar(535) NOT NULL,
  `usuario_estado` varchar(17) NOT NULL,
  `genero` varchar(15) NOT NULL,
  `usuario_privilegio` int(2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish2_ci;

--
-- Volcado de datos para la tabla `usuario`
--

INSERT INTO `usuario` (`usuario_id`, `usuario_dni`, `usuario_nombre`, `usuario_apellido`, `usuario_telefono`, `usuario_direccion`, `usuario_email`, `usuario_usuario`, `usuario_clave`, `usuario_estado`, `genero`, `usuario_privilegio`) VALUES
(1, '0000000000', 'AKIKOADMIN', 'PRINCIPAL', '8493949653', 'RD', 'cj@gmail.com', 'AKIKOADMIN', 'alovczBJUk5qdVlZbzFEL3VaMGZJdz09', 'Activa', 'Femenino', 1),
(3, '0450004802', 'Carlos', 'Gomez', '8099664550', 'Bonao', 'carlosjose@hotmail.es', 'wayne1896', 'ZDJ5cDZndTNrQzByWVk3RDBVN3FCUT09', 'Activa', 'Masculino', 2),
(9, '0000000241', 'GABY', 'Garcia', '899966000', '', 'gaby01@hotmail.com', 'gaby01', 'ZDJ5cDZndTNrQzByWVk3RDBVN3FCUT09', 'Activa', 'Femenino', 1);

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `cliente`
--
ALTER TABLE `cliente`
  ADD PRIMARY KEY (`cliente_id`);

--
-- Indices de la tabla `detalle`
--
ALTER TABLE `detalle`
  ADD PRIMARY KEY (`detalle_id`),
  ADD KEY `item_id` (`item_id`),
  ADD KEY `prestamo_codigo` (`prestamo_codigo`);

--
-- Indices de la tabla `empresa`
--
ALTER TABLE `empresa`
  ADD PRIMARY KEY (`empresa_id`);

--
-- Indices de la tabla `item`
--
ALTER TABLE `item`
  ADD PRIMARY KEY (`item_id`);

--
-- Indices de la tabla `pago`
--
ALTER TABLE `pago`
  ADD PRIMARY KEY (`pago_id`),
  ADD KEY `prestamo_codigo` (`prestamo_codigo`);

--
-- Indices de la tabla `prestamo`
--
ALTER TABLE `prestamo`
  ADD PRIMARY KEY (`prestamo_id`),
  ADD UNIQUE KEY `prestamo_codigo` (`prestamo_codigo`),
  ADD KEY `usuario_id` (`usuario_id`),
  ADD KEY `cliente_id` (`cliente_id`);

--
-- Indices de la tabla `usuario`
--
ALTER TABLE `usuario`
  ADD PRIMARY KEY (`usuario_id`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `cliente`
--
ALTER TABLE `cliente`
  MODIFY `cliente_id` int(10) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `detalle`
--
ALTER TABLE `detalle`
  MODIFY `detalle_id` int(100) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `empresa`
--
ALTER TABLE `empresa`
  MODIFY `empresa_id` int(2) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `item`
--
ALTER TABLE `item`
  MODIFY `item_id` int(10) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `pago`
--
ALTER TABLE `pago`
  MODIFY `pago_id` int(20) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `prestamo`
--
ALTER TABLE `prestamo`
  MODIFY `prestamo_id` int(50) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `usuario`
--
ALTER TABLE `usuario`
  MODIFY `usuario_id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `detalle`
--
ALTER TABLE `detalle`
  ADD CONSTRAINT `detalle_ibfk_1` FOREIGN KEY (`item_id`) REFERENCES `item` (`item_id`),
  ADD CONSTRAINT `detalle_ibfk_2` FOREIGN KEY (`prestamo_codigo`) REFERENCES `prestamo` (`prestamo_codigo`);

--
-- Filtros para la tabla `pago`
--
ALTER TABLE `pago`
  ADD CONSTRAINT `pago_ibfk_1` FOREIGN KEY (`prestamo_codigo`) REFERENCES `prestamo` (`prestamo_codigo`);

--
-- Filtros para la tabla `prestamo`
--
ALTER TABLE `prestamo`
  ADD CONSTRAINT `prestamo_ibfk_1` FOREIGN KEY (`cliente_id`) REFERENCES `cliente` (`cliente_id`),
  ADD CONSTRAINT `prestamo_ibfk_2` FOREIGN KEY (`usuario_id`) REFERENCES `usuario` (`usuario_id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

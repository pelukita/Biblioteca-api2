-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 21-11-2025 a las 20:16:58
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
-- Base de datos: `biblioteca_db`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `ficha`
--

CREATE TABLE `ficha` (
  `id` int(11) NOT NULL,
  `usuario_id` int(11) DEFAULT NULL,
  `libro_id` int(11) DEFAULT NULL,
  `fecha_prestamo` date DEFAULT curdate(),
  `fecha_devolucion` date DEFAULT NULL,
  `estado` enum('Prestado','Devuelto') DEFAULT 'Prestado'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `ficha`
--

INSERT INTO `ficha` (`id`, `usuario_id`, `libro_id`, `fecha_prestamo`, `fecha_devolucion`, `estado`) VALUES
(7, NULL, 14, '2023-12-30', '2026-01-01', 'Prestado'),
(9, NULL, NULL, NULL, NULL, NULL),
(10, 0, 2, NULL, '0000-00-00', ''),
(11, 0, 2, '0000-00-00', '0000-00-00', ''),
(12, 23, 2, '1999-11-23', '1999-11-28', 'Prestado'),
(13, 23, 2, '1999-11-23', '1999-11-28', 'Prestado'),
(14, 23, 2, '1999-11-23', '1999-11-28', 'Prestado'),
(15, 23, 2, '1999-11-23', '1999-11-28', 'Prestado'),
(16, 23, 2, '1999-11-23', '1999-11-28', 'Prestado'),
(17, 23, 2, '1999-11-23', '1999-11-28', 'Prestado');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `libro`
--

CREATE TABLE `libro` (
  `id` int(11) NOT NULL,
  `titulo` varchar(200) NOT NULL,
  `autor` varchar(100) NOT NULL,
  `fecha_publicacion` int(11) DEFAULT NULL,
  `genero` varchar(50) DEFAULT NULL,
  `stock` int(11) DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `libro`
--

INSERT INTO `libro` (`id`, `titulo`, `autor`, `fecha_publicacion`, `genero`, `stock`) VALUES
(2, 'Los ojos del perro siberiano', 'Antonio Santa Ana', 1998, 'Literatura Juvenil', 2),
(3, 'La tregua', 'Mario Benedetti', 1960, 'Novela', 3),
(4, 'La isla desierta', 'Roberto Arlt', 1937, 'Teatro', 1),
(5, 'Enchiridion editado', 'Pendleton Ward', 2013, 'Series/TV', 4),
(14, 'test', 'testes', NULL, 'teste', 3),
(15, 'PQ no funciona?', 'Raul', 1999, 'Queso', 12);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuario`
--

CREATE TABLE `usuario` (
  `id` int(11) NOT NULL,
  `nombre` varchar(100) NOT NULL,
  `email` varchar(150) NOT NULL,
  `contrasenia` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `usuario`
--

INSERT INTO `usuario` (`id`, `nombre`, `email`, `contrasenia`) VALUES
(1, 'webadmin', 'admin@email.com',
'$2y$10$/7Ti/oqme2TZTbXkdtWoS.WRg91JkHI7PLdzBMdloVgVe91tp7vTq');
--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `ficha`
--
ALTER TABLE `ficha`
  ADD PRIMARY KEY (`id`),
  ADD KEY `usuario_id` (`usuario_id`),
  ADD KEY `libro_id` (`libro_id`);

--
-- Indices de la tabla `libro`
--
ALTER TABLE `libro`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `usuario`
--
ALTER TABLE `usuario`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `email` (`email`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `ficha`
--
ALTER TABLE `ficha`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- AUTO_INCREMENT de la tabla `libro`
--
ALTER TABLE `libro`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT de la tabla `usuario`
--
ALTER TABLE `usuario`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `ficha`
--
ALTER TABLE `ficha`
  ADD CONSTRAINT `ficha_ibfk_2` FOREIGN KEY (`libro_id`) REFERENCES `libro` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

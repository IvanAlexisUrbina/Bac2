-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 31-08-2023 a las 23:24:24
-- Versión del servidor: 10.4.27-MariaDB
-- Versión de PHP: 8.1.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `bac2`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `users`
--

CREATE TABLE `users` (
  `u_id` int(11) NOT NULL,
  `u_name` varchar(30) DEFAULT NULL,
  `u_lastname` varchar(30) DEFAULT NULL,
  `u_phone` int(100) DEFAULT NULL,
  `u_email` varchar(60) DEFAULT NULL,
  `u_document` int(30) DEFAULT NULL,
  `u_type_document` varchar(30) DEFAULT NULL,
  `u_country` varchar(60) DEFAULT NULL,
  `u_city` varchar(30) DEFAULT NULL,
  `u_pass` varchar(200) DEFAULT NULL,
  `u_code` varchar(30) DEFAULT NULL,
  `rol_id` int(11) NOT NULL,
  `c_id` int(11) NOT NULL,
  `status_id` int(11) NOT NULL,
  `u_codeSeller` varchar(60) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `users`
--

INSERT INTO `users` (`u_id`, `u_name`, `u_lastname`, `u_phone`, `u_email`, `u_document`, `u_type_document`, `u_country`, `u_city`, `u_pass`, `u_code`, `rol_id`, `c_id`, `status_id`, `u_codeSeller`) VALUES
(9, 'Ivan Alexis', 'Urbina Melo', 2147483647, 'iurbina@businessandconnection.coma', 12341234, 'Cedula de ciudadanía', 'Colombia', 'Cali', '$2y$10$iAE/0burGF3ZckIwtOj6vu./aDf7QyhLmDjiWrzNhM8No96l6dxmu', 'daa211ccacbeb884', 1, 1, 1, NULL),
(86, 'Edwin valencia', 'prueba', 2147483647, 'evaniche@hotmail.com', 1144108604, 'Cedula de ciudadanía', 'Colombia', 'RIOSUCIO', '$2y$10$iAE/0burGF3ZckIwtOj6vu./aDf7QyhLmDjiWrzNhM8No96l6dxmu', 'c1e7e75f62936243', 2, 54, 1, NULL),
(87, 'Andres Muete', 'Muete', 1144108604, 'iurbina@businessandconnection.com', 1144108606, 'Cedula de ciudadanía', 'Colombia', 'PUERTO RONDÓN', '$2y$10$iAE/0burGF3ZckIwtOj6vu./aDf7QyhLmDjiWrzNhM8No96l6dxmu', '21439534b062262c', 3, 54, 1, 'CodePrueba'),
(98, 'IVAN ALEXIS', 'URBINA MELO', 2147483647, 'iaurbina04@misena.edu.co', 2147483647, 'Cedula de ciudadanía', 'Colombia', 'PROVIDENCIA Y SANTA CATALINA', NULL, NULL, 4, 67, 1, NULL);

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`u_id`),
  ADD KEY `rol_id` (`rol_id`),
  ADD KEY `c_id` (`c_id`),
  ADD KEY `c_id_2` (`c_id`),
  ADD KEY `status_id` (`status_id`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `users`
--
ALTER TABLE `users`
  MODIFY `u_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=99;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `users`
--
ALTER TABLE `users`
  ADD CONSTRAINT `users_ibfk_1` FOREIGN KEY (`rol_id`) REFERENCES `roles` (`rol_id`),
  ADD CONSTRAINT `users_ibfk_2` FOREIGN KEY (`c_id`) REFERENCES `company` (`c_id`),
  ADD CONSTRAINT `users_ibfk_3` FOREIGN KEY (`status_id`) REFERENCES `status` (`status_id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

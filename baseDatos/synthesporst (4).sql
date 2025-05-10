-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 11-04-2025 a las 18:37:27
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
-- Base de datos: `synthesporst`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `canchas`
--

CREATE TABLE `canchas` (
  `idcanchas` int(11) NOT NULL,
  `nombre` varchar(200) NOT NULL,
  `tipo` varchar(100) NOT NULL,
  `capacidad` int(11) NOT NULL,
  `valor` bigint(20) NOT NULL,
  `status` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Volcado de datos para la tabla `canchas`
--

INSERT INTO `canchas` (`idcanchas`, `nombre`, `tipo`, `capacidad`, `valor`, `status`) VALUES
(12, 'Cancha 1', 'Futbol', 5, 60000, 1),
(13, 'Cancha 2', 'Futbol', 7, 80000, 1),
(14, 'Cancha A', 'Volley', 5, 50000, 1),
(15, 'Cancha B', 'Volley', 5, 50000, 1),
(16, 'Cancha T1', 'Tenis', 2, 50000, 1),
(17, 'Cancha T2', 'Tenis', 5, 50000, 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `convenios`
--

CREATE TABLE `convenios` (
  `idconvenios` int(11) NOT NULL,
  `nombre` varchar(45) DEFAULT NULL,
  `descripcion` varchar(700) DEFAULT NULL,
  `fechaInicio` date DEFAULT NULL,
  `fechaFin` date DEFAULT NULL,
  `descuento` decimal(11,0) DEFAULT NULL,
  `status` int(11) DEFAULT NULL,
  `canchas_idcanchas` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Volcado de datos para la tabla `convenios`
--

INSERT INTO `convenios` (`idconvenios`, `nombre`, `descripcion`, `fechaInicio`, `fechaFin`, `descuento`, `status`, `canchas_idcanchas`) VALUES
(12, 'FestYou', 'Torneo relampago', '2025-04-11', '2025-04-18', 10, 1, 12),
(13, 'Torneo tenis', 'torneo de tenis ', '2025-04-12', '2025-04-15', 20, 1, 16),
(14, 'Torneo Volley', 'Torneo de voleiball ', '2025-04-12', '2025-04-23', 10, 1, 14);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `reservas`
--

CREATE TABLE `reservas` (
  `idreservas` int(11) NOT NULL,
  `nombre` varchar(45) DEFAULT NULL,
  `status` int(11) DEFAULT NULL,
  `convenios_idconvenios` int(11) NOT NULL,
  `users_idusers` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Volcado de datos para la tabla `reservas`
--

INSERT INTO `reservas` (`idreservas`, `nombre`, `status`, `convenios_idconvenios`, `users_idusers`) VALUES
(54, 'Daniel Salazar', 1, 13, 6),
(55, 'uuu', 1, 13, 7),
(56, 'uuuu', 1, 12, 6),
(57, 'Juanes', 1, 12, 7);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `reservas_has_canchas`
--

CREATE TABLE `reservas_has_canchas` (
  `idreservas_idreservas` int(11) NOT NULL,
  `reservas_idreservas` int(11) NOT NULL,
  `canchas_idcanchas` int(11) NOT NULL,
  `fecha` datetime NOT NULL,
  `horaReserva` time NOT NULL,
  `horasReservadas` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `reservas_has_canchas`
--

INSERT INTO `reservas_has_canchas` (`idreservas_idreservas`, `reservas_idreservas`, `canchas_idcanchas`, `fecha`, `horaReserva`, `horasReservadas`) VALUES
(1, 54, 16, '2025-04-12 00:00:00', '08:30:00', 2),
(2, 54, 17, '2025-04-12 00:00:00', '09:28:00', 1),
(3, 55, 15, '2025-04-12 00:00:00', '10:34:00', 1),
(4, 56, 16, '2025-04-12 00:00:00', '11:35:00', 1),
(5, 56, 16, '2025-04-18 00:00:00', '13:35:00', 1),
(6, 57, 14, '2025-04-17 00:00:00', '12:30:00', 3);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `users`
--

CREATE TABLE `users` (
  `idusers` int(11) NOT NULL,
  `username` varchar(250) NOT NULL,
  `password` varchar(250) NOT NULL,
  `correo` varchar(250) DEFAULT NULL,
  `rol` int(11) DEFAULT NULL,
  `status` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Volcado de datos para la tabla `users`
--

INSERT INTO `users` (`idusers`, `username`, `password`, `correo`, `rol`, `status`) VALUES
(6, 'Randy', '12345', 'juandaniels@gmail.com', 1, 1),
(7, 'Gurko', '12345', 'gurko770@gmail.com', 1, 1);

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `canchas`
--
ALTER TABLE `canchas`
  ADD PRIMARY KEY (`idcanchas`);

--
-- Indices de la tabla `convenios`
--
ALTER TABLE `convenios`
  ADD PRIMARY KEY (`idconvenios`),
  ADD KEY `fk_convenios_canchas1_idx` (`canchas_idcanchas`);

--
-- Indices de la tabla `reservas`
--
ALTER TABLE `reservas`
  ADD PRIMARY KEY (`idreservas`),
  ADD KEY `fk_reservas_convenios1_idx` (`convenios_idconvenios`),
  ADD KEY `fk_reservas_users1_idx` (`users_idusers`);

--
-- Indices de la tabla `reservas_has_canchas`
--
ALTER TABLE `reservas_has_canchas`
  ADD PRIMARY KEY (`idreservas_idreservas`);

--
-- Indices de la tabla `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`idusers`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `canchas`
--
ALTER TABLE `canchas`
  MODIFY `idcanchas` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- AUTO_INCREMENT de la tabla `convenios`
--
ALTER TABLE `convenios`
  MODIFY `idconvenios` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT de la tabla `reservas`
--
ALTER TABLE `reservas`
  MODIFY `idreservas` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=58;

--
-- AUTO_INCREMENT de la tabla `reservas_has_canchas`
--
ALTER TABLE `reservas_has_canchas`
  MODIFY `idreservas_idreservas` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT de la tabla `users`
--
ALTER TABLE `users`
  MODIFY `idusers` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `convenios`
--
ALTER TABLE `convenios`
  ADD CONSTRAINT `fk_convenios_canchas1` FOREIGN KEY (`canchas_idcanchas`) REFERENCES `canchas` (`idcanchas`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Filtros para la tabla `reservas`
--
ALTER TABLE `reservas`
  ADD CONSTRAINT `fk_reservas_convenios1` FOREIGN KEY (`convenios_idconvenios`) REFERENCES `convenios` (`idconvenios`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_reservas_users1` FOREIGN KEY (`users_idusers`) REFERENCES `users` (`idusers`) ON DELETE NO ACTION ON UPDATE NO ACTION;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

-- phpMyAdmin SQL Dump
-- version 4.8.5
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 08-06-2019 a las 15:31:18
-- Versión del servidor: 10.1.38-MariaDB
-- Versión de PHP: 7.3.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `mantenimiento`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `itemot`
--

CREATE TABLE `itemot` (
  `idItem` int(11) NOT NULL,
  `idTarea` int(11) NOT NULL,
  `idPedido` int(11) NOT NULL,
  `idOT` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `ordendetrabajo`
--

CREATE TABLE `ordendetrabajo` (
  `idOT` int(11) NOT NULL,
  `fechaInicio` text NOT NULL,
  `fechaFin` text,
  `estado` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `ordendetrabajo`
--

INSERT INTO `ordendetrabajo` (`idOT`, `fechaInicio`, `fechaFin`, `estado`) VALUES
(1, '2019-06-08', NULL, 'Iniciado');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `pedido`
--

CREATE TABLE `pedido` (
  `id` int(11) NOT NULL,
  `descripcion` text NOT NULL,
  `estado` text NOT NULL,
  `fechaInicio` text NOT NULL,
  `fechaFin` text,
  `prioridad` text NOT NULL,
  `sector` text NOT NULL,
  `nombreUsuario` varchar(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `pedido`
--

INSERT INTO `pedido` (`id`, `descripcion`, `estado`, `fechaInicio`, `fechaFin`, `prioridad`, `sector`, `nombreUsuario`) VALUES
(1, 'asdasd', 'Iniciado', '2019-06-08', NULL, 'Media', 'DAC', 'admin'),
(2, 'djoaspd', 'Iniciado', '2019-06-08', NULL, 'Media', 'GUARDIA_MEDICA', 'admin'),
(3, 'jaisdas', 'Iniciado', '2019-06-08', NULL, 'Alta', 'PABELLON_1', 'admin');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `rol`
--

CREATE TABLE `rol` (
  `idRol` int(11) NOT NULL,
  `nombreRol` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tarea`
--

CREATE TABLE `tarea` (
  `idTarea` int(11) NOT NULL,
  `idPedido` int(11) NOT NULL,
  `estado` text NOT NULL,
  `descripcion` text NOT NULL,
  `prioridad` text NOT NULL,
  `especializacion` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `tarea`
--

INSERT INTO `tarea` (`idTarea`, `idPedido`, `estado`, `descripcion`, `prioridad`, `especializacion`) VALUES
(1, 1, 'Iniciado', 'jqaeodpsa', 'Media', 'ELECTRICISTA'),
(1, 2, 'Iniciado', 'jasdpa', 'Alta', 'PINTOR'),
(2, 2, 'Iniciado', 'asjdÃ±pas', 'Baja', 'ELECTRICISTA');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuarios`
--

CREATE TABLE `usuarios` (
  `nombre` varchar(11) NOT NULL,
  `password` varchar(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `usuarios`
--

INSERT INTO `usuarios` (`nombre`, `password`) VALUES
('admin', 'patotero');

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `itemot`
--
ALTER TABLE `itemot`
  ADD PRIMARY KEY (`idItem`,`idTarea`,`idPedido`,`idOT`),
  ADD KEY `idTarea` (`idTarea`),
  ADD KEY `idPedido` (`idPedido`),
  ADD KEY `idOT` (`idOT`);

--
-- Indices de la tabla `ordendetrabajo`
--
ALTER TABLE `ordendetrabajo`
  ADD PRIMARY KEY (`idOT`);

--
-- Indices de la tabla `pedido`
--
ALTER TABLE `pedido`
  ADD PRIMARY KEY (`id`),
  ADD KEY `nombreUsuario` (`nombreUsuario`);

--
-- Indices de la tabla `rol`
--
ALTER TABLE `rol`
  ADD PRIMARY KEY (`idRol`);

--
-- Indices de la tabla `tarea`
--
ALTER TABLE `tarea`
  ADD PRIMARY KEY (`idTarea`,`idPedido`),
  ADD KEY `idPedido` (`idPedido`);

--
-- Indices de la tabla `usuarios`
--
ALTER TABLE `usuarios`
  ADD PRIMARY KEY (`nombre`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `itemot`
--
ALTER TABLE `itemot`
  MODIFY `idItem` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `ordendetrabajo`
--
ALTER TABLE `ordendetrabajo`
  MODIFY `idOT` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT de la tabla `pedido`
--
ALTER TABLE `pedido`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT de la tabla `rol`
--
ALTER TABLE `rol`
  MODIFY `idRol` int(11) NOT NULL AUTO_INCREMENT;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `itemot`
--
ALTER TABLE `itemot`
  ADD CONSTRAINT `itemot_ibfk_1` FOREIGN KEY (`idTarea`) REFERENCES `tarea` (`idTarea`),
  ADD CONSTRAINT `itemot_ibfk_2` FOREIGN KEY (`idPedido`) REFERENCES `pedido` (`id`),
  ADD CONSTRAINT `itemot_ibfk_3` FOREIGN KEY (`idOT`) REFERENCES `ordendetrabajo` (`idOT`);

--
-- Filtros para la tabla `pedido`
--
ALTER TABLE `pedido`
  ADD CONSTRAINT `pedido_ibfk_1` FOREIGN KEY (`nombreUsuario`) REFERENCES `usuarios` (`nombre`);

--
-- Filtros para la tabla `tarea`
--
ALTER TABLE `tarea`
  ADD CONSTRAINT `tarea_ibfk_1` FOREIGN KEY (`idPedido`) REFERENCES `pedido` (`id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

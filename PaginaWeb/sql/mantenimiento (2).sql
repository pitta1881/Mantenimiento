-- phpMyAdmin SQL Dump
-- version 4.8.5
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 13-08-2021 a las 22:59:12
-- Versión del servidor: 10.1.39-MariaDB
-- Versión de PHP: 7.3.5

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
-- Estructura de tabla para la tabla `agentes`
--

CREATE TABLE `agentes` (
  `id` int(11) NOT NULL,
  `idPersona` int(11) NOT NULL,
  `tareasActuales` int(11) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `agentes`
--

INSERT INTO `agentes` (`id`, `idPersona`, `tareasActuales`) VALUES
(1, 26585543, 0),
(2, 39447859, 0),
(3, 17145072, 1),
(4, 16131891, 0),
(5, 22456368, 1),
(6, 19917833, 1),
(7, 24205172, 0),
(8, 26547123, 0),
(9, 29651289, 0),
(10, 13569841, 0),
(11, 25174962, 0);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `agentes_x_tareas`
--

CREATE TABLE `agentes_x_tareas` (
  `idTarea` int(11) NOT NULL,
  `idPedido` int(11) NOT NULL,
  `idAgente` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `especializaciones`
--

CREATE TABLE `especializaciones` (
  `id` int(11) NOT NULL,
  `nombre` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `especializaciones`
--

INSERT INTO `especializaciones` (`id`, `nombre`) VALUES
(2, 'Albanileria'),
(8, 'Carpinteria'),
(11, 'Cerrajeria '),
(4, 'Electricidad'),
(9, 'General'),
(6, 'Herreria'),
(10, 'Jardineria'),
(5, 'Mecanico'),
(3, 'Pintureria'),
(1, 'Plomeria'),
(7, 'Restauracion');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `especializaciones_x_agentes`
--

CREATE TABLE `especializaciones_x_agentes` (
  `idEspecializacion` int(11) NOT NULL,
  `idAgente` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `especializaciones_x_agentes`
--

INSERT INTO `especializaciones_x_agentes` (`idEspecializacion`, `idAgente`) VALUES
(1, 1),
(1, 7),
(1, 9),
(2, 4),
(2, 5),
(2, 6),
(2, 7),
(2, 9),
(3, 1),
(3, 2),
(3, 3),
(3, 4),
(3, 10),
(4, 1),
(4, 6),
(4, 9),
(5, 2),
(5, 3),
(6, 4),
(6, 6),
(6, 11),
(7, 2),
(7, 3),
(7, 5),
(7, 8),
(7, 10),
(7, 11),
(8, 4),
(8, 5),
(8, 6),
(8, 10),
(9, 1),
(9, 3),
(9, 7),
(9, 8),
(9, 9),
(9, 10),
(9, 11),
(10, 8),
(10, 11),
(11, 1),
(11, 2);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `estados`
--

CREATE TABLE `estados` (
  `id` int(11) NOT NULL,
  `nombre` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `estados`
--

INSERT INTO `estados` (`id`, `nombre`) VALUES
(4, 'Cancelado'),
(6, 'Cumplido'),
(2, 'En Curso'),
(5, 'Finalizado'),
(1, 'Iniciado'),
(3, 'Pendiente');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `estadosordenesdecompra`
--

CREATE TABLE `estadosordenesdecompra` (
  `id` int(11) NOT NULL,
  `nombre` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `estadosordenesdecompra`
--

INSERT INTO `estadosordenesdecompra` (`id`, `nombre`) VALUES
(4, 'Cancelado'),
(3, 'Completo'),
(1, 'Iniciado'),
(2, 'Parcial'),
(5, 'Parcial Completo');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `estadospersona`
--

CREATE TABLE `estadospersona` (
  `id` int(11) NOT NULL,
  `nombre` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `estadospersona`
--

INSERT INTO `estadospersona` (`id`, `nombre`) VALUES
(1, 'Activo'),
(2, 'Baja'),
(3, 'Licencia');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `eventos`
--

CREATE TABLE `eventos` (
  `id` int(11) NOT NULL,
  `idEstado` int(11) NOT NULL,
  `nombre` varchar(30) NOT NULL,
  `descripcion` text NOT NULL,
  `fechaInicio` date NOT NULL,
  `fechaFin` date NOT NULL,
  `periodicidad` int(11) DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `eventos`
--

INSERT INTO `eventos` (`id`, `idEstado`, `nombre`, `descripcion`, `fechaInicio`, `fechaFin`, `periodicidad`) VALUES
(1, 3, 'Revisar Lamparitas', 'Revisar lamparitas de los pabellones', '2021-01-01', '2022-01-01', 30),
(2, 3, 'Rellenar dispenser de alcohol ', 'Rellenar dispenser de alcohol en gel', '2021-01-01', '2022-01-01', 10),
(3, 3, 'Empieza el verano', 'Cada primero de diciembre se realiza la verificacion de los ventiladores, aires acondicionados y sistemas de ventilacion. ', '2021-12-01', '2022-12-01', 365),
(4, 3, 'Cambio de Matafuegos', 'Realizar el cambio de todos los matafuegos del hospital\r\n', '2021-01-01', '2022-01-01', 365),
(5, 3, 'Rellenar bidones de agua', 'Rellenar bidones de agua de los pabellones', '2021-01-04', '2022-01-01', 14);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `historialinsumo`
--

CREATE TABLE `historialinsumo` (
  `id` int(11) NOT NULL,
  `idInsumo` int(11) NOT NULL,
  `fecha` datetime NOT NULL,
  `idUsuario` int(11) NOT NULL,
  `oldStock` float NOT NULL,
  `newStock` float NOT NULL,
  `inOrOut` tinyint(1) NOT NULL,
  `idOC` int(11) DEFAULT NULL,
  `idTarea` int(11) DEFAULT NULL,
  `idPedido` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `historialpedido`
--

CREATE TABLE `historialpedido` (
  `id` int(11) NOT NULL,
  `idPedido` int(11) NOT NULL,
  `fecha` datetime NOT NULL,
  `idUsuario` int(11) NOT NULL,
  `idEstado` int(11) NOT NULL,
  `idSector` int(11) DEFAULT NULL,
  `idPrioridad` int(11) DEFAULT NULL,
  `descripcion` text,
  `observacion` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `historialpedido`
--

INSERT INTO `historialpedido` (`id`, `idPedido`, `fecha`, `idUsuario`, `idEstado`, `idSector`, `idPrioridad`, `descripcion`, `observacion`) VALUES
(1, 1, '2021-07-05 18:15:35', 3, 1, 1, 2, 'test 1 pedidos', 'Pedido Creado'),
(1, 2, '2021-07-05 18:19:00', 3, 1, 1, 3, 'as das dsak', 'Pedido Creado'),
(1, 3, '2021-07-11 20:39:57', 3, 1, 26, 2, 'Acondicionar casa particular para nuevos pacientes', 'Pedido Creado'),
(1, 4, '2021-07-11 20:46:04', 3, 1, 29, 3, 'Acondicionar sala de diagnostico\r\n', 'Pedido Creado'),
(1, 5, '2021-07-12 20:50:49', 3, 1, 24, 2, 'Problemas con el techo en la oficina, se llueve en varios puntos\r\n', 'Pedido Creado'),
(1, 6, '2021-07-12 20:51:51', 3, 1, 25, 2, 'busncar en la enfermera\r\nd', 'Pedido Creado'),
(1, 7, '2021-07-13 21:07:29', 3, 1, 27, 2, 'Se necesita instalar un sistema de ventilacion para el invierno/verano', 'Pedido Creado'),
(1, 8, '2021-07-13 21:12:11', 3, 1, 21, 2, 'Verificar estado de las camilla utilizadas por los pacientes', 'Pedido Creado'),
(1, 9, '2021-07-14 12:15:53', 3, 1, 25, 2, 'Se necesita arreglar los gabinetes de enfermeria, las puertas no cierran. Verificar lugar de guardado', 'Pedido Creado'),
(1, 10, '2021-07-14 12:30:20', 3, 1, 24, 2, 'Remodelar sala de espera de la guardia. Sillas en mal estado', 'Pedido Creado'),
(1, 11, '2021-07-15 16:48:06', 1, 1, 29, 2, 'Reacondicionar gazebos 3 y 4.\r\n', 'Pedido Creado'),
(1, 12, '2021-07-16 16:51:01', 1, 1, 30, 2, 'Reacondicionar canteros de la entrada\r\n', 'Pedido Creado'),
(1, 13, '2021-07-17 16:56:52', 1, 1, 11, 3, 'Verificar  estado de las piletas y canillas\r\n', 'Pedido Creado'),
(1, 14, '2021-07-18 17:02:22', 1, 1, 12, 2, 'Reacondicionar teatro\r\n', 'Pedido Creado'),
(1, 15, '2021-07-19 17:06:43', 1, 1, 15, 1, 'Cambiar instalacion electrica de las salas 3,4,5 y6', 'Pedido Creado'),
(1, 16, '2021-07-20 17:25:00', 1, 1, 22, 1, 'Reacondiconar fachada del edificio', 'Pedido Creado'),
(1, 17, '2021-07-21 17:35:18', 1, 1, 16, 2, 'Arreglar accesos al edificio', 'Pedido Creado'),
(1, 18, '2021-07-22 17:48:29', 1, 1, 30, 4, 'No funciona el timbre de la porteria', 'Pedido Creado'),
(1, 19, '2021-07-23 17:53:10', 1, 1, 24, 2, 'Restaurar salon de actos de sector', 'Pedido Creado'),
(1, 20, '2021-07-24 17:56:16', 1, 1, 6, 4, 'Se necesita de forma urgente cambiar un inodoro, esta inundando todo el baño', 'Pedido Creado'),

(2, 1, '2021-07-05 18:15:52', 3, 1, 11, 2, 'test 1 pedidos', 'Tarea Creada > test tarea 1'),
(2, 2, '2021-07-05 18:20:34', 3, 1, 11, 3, 'as das dsak', 'Tarea Creada > asd sad wa'),
(2, 3, '2021-07-11 20:41:05', 3, 1, 26, 2, 'Acondicionar casa particular para nuevos pacientes', 'Tarea Creada > Revisar estado general del techo'),
(2, 4, '2021-07-11 20:48:20', 3, 1, 29, 3, 'Acondicionar sala de diagnostico\r\n', 'Tarea Creada > Cambiar ceramicas rotas del piso '),
(2, 5, '2021-07-12 20:55:28', 3, 1, 24, 2, 'Problemas con el techo en la oficina, se llueve en varios puntos\r\n', 'Tarea Creada > Quitar parte de la chapa del techo y revestimiento interior'),
(2, 6, '2021-07-12 20:52:32', 3, 4, NULL, NULL, NULL, 'Pedido Cancelado > Pedido no autorizado. No esta bien descripta la necesidad\r\n'),
(2, 7, '2021-07-13 21:08:50', 3, 1, 27, 2, 'Se necesita instalar un sistema de ventilacion para el invierno/verano', 'Tarea Creada > Crear espacio en la pared para instalar un aire acondicionado frio/calor'),
(2, 9, '2021-07-14 12:21:00', 3, 1, 25, 2, 'Se necesita arreglar los gabinetes de enfermeria, las puertas no cierran. Verificar lugar de guardado', 'Tarea Creada > Fabricar y colocar 2 puertas de los gabinetes '),
(2, 10, '2021-07-14 12:31:01', 3, 1, 24, 2, 'Remodelar sala de espera de la guardia. Sillas en mal estado', 'Tarea Creada > Quitar del suelo las silla de la sala de espera'),
(2, 11, '2021-07-15 16:48:56', 1, 1, 29, 2, 'Reacondicionar gazebos 3 y 4.\r\n', 'Tarea Creada > Desarmar gazebos y verificar si necesitan mantenimiento'),
(2, 12, '2021-07-16 16:51:43', 1, 1, 30, 2, 'Reacondicionar canteros de la entrada\r\n', 'Tarea Creada > Retirar malezas y restos de plantas de los canteros'),
(2, 13, '2021-07-17 16:58:31', 1, 1, 11, 3, 'Verificar  estado de las piletas y canillas\r\n', 'Tarea Creada > Verificar estado de las cañerias y destapar las que se encuentren en mal estado'),
(2, 14, '2021-07-18 17:02:55', 1, 1, 12, 2, 'Reacondicionar teatro\r\n', 'Tarea Creada > Quitar cortinas del escenario y quitar las butacas'),
(2, 15, '2021-07-19 17:07:11', 1, 1, 15, 1, 'Cambiar instalacion electrica de las salas 3,4,5 y6', 'Tarea Creada > Verificar estado de los enchufes y si funcionan'),
(2, 16, '2021-07-20 17:25:34', 1, 1, 22, 1, 'Reacondiconar fachada del edificio', 'Tarea Creada > Quitar todo el reboque y las partes con humedad\r\n'),
(2, 17, '2021-07-21 17:35:57', 1, 1, 16, 2, 'Arreglar accesos al edificio', 'Tarea Creada > Quitar baldosas del acceso'),
(2, 18, '2021-07-22 17:48:58', 1, 1, 30, 4, 'No funciona el timbre de la porteria', 'Tarea Creada > Revisar la conexion electrica del timbre'),
(2, 19, '2021-07-23 17:53:57', 1, 1, 24, 2, 'Restaurar salon de actos de sector', 'Tarea Creada > Realizar tareas de restauracion de las ventanas'),
(2, 20, '2021-07-24 17:56:38', 1, 1, 6, 4, 'Se necesita de forma urgente cambiar un inodoro, esta inundando todo el baño', 'Tarea Creada > Cortar el suministro del agua'),

(3, 1, '2021-07-05 18:16:01', 3, 1, 11, 2, 'test 1 pedidos', 'Tarea Creada > test tarea 2'),
(3, 3, '2021-07-11 20:41:50', 3, 1, 26, 2, 'Acondicionar casa particular para nuevos pacientes', 'Tarea Creada > Revisar estado del revoque y humedad de la pared'),
(3, 4, '2021-07-11 20:49:17', 3, 1, 29, 3, 'Acondicionar sala de diagnostico\r\n', 'Tarea Creada > Repintar pared de la sala de rayos'),
(3, 5, '2021-07-12 20:56:19', 3, 1, 24, 2, 'Problemas con el techo en la oficina, se llueve en varios puntos\r\n', 'Tarea Creada > Cambiar y construir tirantes'),
(3, 7, '2021-07-13 21:09:46', 3, 1, 27, 2, 'Se necesita instalar un sistema de ventilacion para el invierno/verano', 'Tarea Creada > Instalar enchufe en la pared para conectar el a/c'),
(3, 9, '2021-07-14 12:21:39', 3, 1, 25, 2, 'Se necesita arreglar los gabinetes de enfermeria, las puertas no cierran. Verificar lugar de guardado', 'Tarea Creada > Cambiar cerradura de los gabinetes, se perdieron algunas llaves'),
(3, 10, '2021-07-14 12:31:31', 3, 1, 24, 2, 'Remodelar sala de espera de la guardia. Sillas en mal estado', 'Tarea Creada > Colocar silla nuevas '),
(3, 11, '2021-07-15 16:49:38', 1, 1, 29, 2, 'Reacondicionar gazebos 3 y 4.\r\n', 'Tarea Creada > Fabricar partes metalicas de los gazebos que esten en mal estado'),
(3, 12, '2021-07-16 16:54:06', 1, 1, 30, 2, 'Reacondicionar canteros de la entrada\r\n', 'Tarea Creada > Reacondicionar la tierra de los canteros, mejorar estado'),
(3, 13, '2021-07-17 16:59:16', 1, 1, 11, 3, 'Verificar  estado de las piletas y canillas\r\n', 'Tarea Creada > Cambiar cañerias que esten rotas o no puedan ser reparadas'),
(3, 14, '2021-07-18 17:03:25', 1, 1, 12, 2, 'Reacondicionar teatro\r\n', 'Tarea Creada > Cambiar tablas rotas del escenario'),
(3, 15, '2021-07-19 17:07:46', 1, 1, 15, 1, 'Cambiar instalacion electrica de las salas 3,4,5 y6', 'Tarea Creada > Agregar dos enchufes a cada sala'),
(3, 16, '2021-07-20 17:30:35', 1, 1, 22, 1, 'Reacondiconar fachada del edificio', 'Tarea Creada > Rebocar las paredes de la fachada'),
(3, 17, '2021-07-21 17:36:19', 1, 1, 16, 2, 'Arreglar accesos al edificio', 'Tarea Creada > Colocar las baldosas'),
(3, 18, '2021-07-22 17:49:27', 1, 1, 30, 4, 'No funciona el timbre de la porteria', 'Tarea Creada > Cambiar timbre por uno nuevo'),
(3, 19, '2021-07-23 17:54:18', 1, 1, 24, 2, 'Restaurar salon de actos de sector', 'Tarea Creada > Realizar tareas de restauracion del piso'),
(3, 20, '2021-07-24 17:57:06', 1, 1, 6, 4, 'Se necesita de forma urgente cambiar un inodoro, esta inundando todo el baño', 'Tarea Creada > Quitar y colocar un nuevo inodoro'),

(4, 2, '2021-07-05 18:30:24', 3, 2, 7, 3, 'as das dsak', 'Pedido Modificado'),
(4, 3, '2021-07-11 20:42:39', 3, 1, 26, 2, 'Acondicionar casa particular para nuevos pacientes', 'Tarea Creada > Arreglar ventada de la cocina'),
(4, 4, '2021-07-11 20:49:51', 3, 1, 29, 3, 'Acondicionar sala de diagnostico\r\n', 'Tarea Creada > Reparar tomografo'),
(4, 5, '2021-07-12 20:57:39', 3, 1, 24, 2, 'Problemas con el techo en la oficina, se llueve en varios puntos\r\n', 'Tarea Creada > Colocar chapas y recubrir el interior'),
(4, 7, '2021-07-13 21:10:26', 3, 1, 27, 2, 'Se necesita instalar un sistema de ventilacion para el invierno/verano', 'Tarea Creada > Realizar la instalacion del aire acondicionado\r\n'),
(4, 10, '2021-07-14 12:33:04', 3, 1, 24, 2, 'Remodelar sala de espera de la guardia. Sillas en mal estado', 'Tarea Creada > Cambiar ceramicos que se rompieron cuando se cambiaron las sillas'),
(4, 11, '2021-07-15 16:50:24', 1, 1, 29, 2, 'Reacondicionar gazebos 3 y 4.\r\n', 'Tarea Creada > Rearmar gazebos '),
(4, 12, '2021-07-16 16:54:58', 1, 1, 30, 2, 'Reacondicionar canteros de la entrada\r\n', 'Tarea Creada > Poner plantines de la temporada actual, de colores anaranjados.'),
(4, 13, '2021-07-17 17:01:41', 1, 1, 11, 3, 'Verificar  estado de las piletas y canillas\r\n', 'Tarea Creada > Revisar canillas y arreglar las que goteen o no funcionen'),
(4, 14, '2021-07-18 17:03:50', 1, 1, 12, 2, 'Reacondicionar teatro\r\n', 'Tarea Creada > Realizar limpieza de las cortinas'),
(4, 15, '2021-07-19 17:32:04', 1, 1, 15, 1, 'Cambiar instalacion electrica de las salas 3,4,5 y 6', 'Pedido Modificado'),
(4, 16, '2021-07-20 17:31:15', 1, 1, 22, 1, 'Reacondiconar fachada del edificio', 'Tarea Creada > Pintar todas las paredes'),
(4, 17, '2021-07-21 17:36:40', 1, 1, 16, 2, 'Arreglar accesos al edificio', 'Tarea Nº1 Modificada'),
(4, 19, '2021-07-23 17:54:57', 1, 1, 24, 2, 'Restaurar salon de actos de sector', 'Tarea Creada > Realizar limpieza de las cortinas'),
(5, 3, '2021-07-11 20:43:48', 3, 1, 26, 2, 'Acondicionar casa particular para nuevos pacientes', 'Tarea Creada > Cambiar instalación electrica del baño.'),
(5, 7, '2021-07-13 21:11:04', 3, 1, 27, 2, 'Se necesita instalar un sistema de ventilacion para el invierno/verano', 'Tarea Creada > Realizar pruebas de funcionamiento del aire acondicionado'),
(5, 14, '2021-07-18 17:05:35', 1, 1, 12, 2, 'Reacondicionar teatro\r\n', 'Tarea Creada > CAmbiar tapizado de las butacas'),
(5, 15, '2021-07-19 17:32:04', 1, 1, 15, 1, 'Cambiar instalacion electrica de las salas 3,4,5 y 6', 'Pedido Modificado'),
(5, 17, '2021-07-21 17:36:40', 1, 1, 16, 2, 'Arreglar accesos al edificio', 'Tarea Nº1 Modificada'),
(6, 14, '2021-07-18 17:05:54', 1, 1, 12, 2, 'Reacondicionar teatro\r\n', 'Tarea Creada > Rearmar el teatro');







-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `historialtarea`
--

CREATE TABLE `historialtarea` (
  `id` int(11) NOT NULL,
  `idTarea` int(11) NOT NULL,
  `idPedido` int(11) NOT NULL,
  `fecha` datetime NOT NULL,
  `idUsuario` int(11) NOT NULL,
  `idEstado` int(11) NOT NULL,
  `idPrioridad` int(11) DEFAULT NULL,
  `idEspecializacion` int(11) DEFAULT NULL,
  `descripcion` text,
  `observacion` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `historialtarea`
--

INSERT INTO `historialtarea` (`id`, `idTarea`, `idPedido`, `fecha`, `idUsuario`, `idEstado`, `idPrioridad`, `idEspecializacion`, `descripcion`, `observacion`) VALUES
(1, 1, 1, '2021-07-05 18:15:52', 3, 1, 2, 3, 'test tarea 1', 'Tarea Creada'),
(1, 2, 1, '2021-07-05 18:16:01', 3, 1, 3, 7, 'test tarea 2', 'Tarea Creada'),
(1, 1, 2, '2021-07-05 18:20:34', 3, 1, 2, 4, 'asd sad wa', 'Tarea Creada'),
(1, 1, 3, '2021-07-11 20:41:05', 3, 1, 2, 9, 'Revisar estado general del techo', 'Tarea Creada'),
(1, 2, 3, '2021-07-11 20:41:50', 3, 1, 2, 2, 'Revisar estado del revoque y humedad de la pared', 'Tarea Creada'),
(1, 3, 3, '2021-07-11 20:42:39', 3, 1, 2, 8, 'Arreglar ventada de la cocina', 'Tarea Creada'),
(1, 4, 3, '2021-07-11 20:43:48', 3, 1, 3, 4, 'Cambiar instalación electrica del baño.', 'Tarea Creada'),
(1, 1, 4, '2021-07-11 20:48:20', 3, 1, 1, 2, 'Cambiar ceramicas rotas del piso ', 'Tarea Creada'),
(1, 2, 4, '2021-07-11 20:49:17', 3, 1, 1, 3, 'Repintar pared de la sala de rayos', 'Tarea Creada'),
(1, 3, 4, '2021-07-11 20:49:51', 3, 1, 4, 5, 'Reparar tomografo', 'Tarea Creada'),
(1, 1, 5, '2021-07-12 20:55:28', 3, 1, 1, 2, 'Quitar parte de la chapa del techo y revestimiento interior', 'Tarea Creada'),
(1, 2, 5, '2021-07-12 20:56:19', 3, 1, 2, 8, 'Cambiar y construir tirantes', 'Tarea Creada'),
(1, 3, 5, '2021-07-12 20:57:39', 3, 1, 2, 2, 'Colocar chapas y recubrir el interior', 'Tarea Creada'),
(1, 1, 7, '2021-07-13 21:08:50', 3, 1, 2, 2, 'Crear espacio en la pared para instalar un aire acondicionado frio/calor', 'Tarea Creada'),
(1, 2, 7, '2021-07-13 21:09:46', 3, 1, 2, 4, 'Instalar enchufe en la pared para conectar el a/c', 'Tarea Creada'),
(1, 3, 7, '2021-07-13 21:10:26', 3, 1, 2, 1, 'Realizar la instalacion del aire acondicionado\r\n', 'Tarea Creada'),
(1, 4, 7, '2021-07-13 21:11:04', 3, 1, 2, 9, 'Realizar pruebas de funcionamiento del aire acondicionado', 'Tarea Creada'),
(1, 1, 9, '2021-07-14 12:21:00', 3, 1, 2, 8, 'Fabricar y colocar 2 puertas de los gabinetes ', 'Tarea Creada'),
(1, 2, 9, '2021-07-14 12:21:39', 3, 1, 2, 11, 'Cambiar cerradura de los gabinetes, se perdieron algunas llaves', 'Tarea Creada'),
(1, 1, 10, '2021-07-14 12:31:01', 3, 1, 2, 9, 'Quitar del suelo las silla de la sala de espera', 'Tarea Creada'),
(1, 2, 10, '2021-07-14 12:31:31', 3, 1, 2, 2, 'Colocar silla nuevas ', 'Tarea Creada'),
(1, 3, 10, '2021-07-14 12:33:04', 3, 1, 2, 2, 'Cambiar ceramicos que se rompieron cuando se cambiaron las sillas', 'Tarea Creada'),
(1, 1, 11, '2021-07-15 16:48:56', 1, 1, 2, 9, 'Desarmar gazebos y verificar si necesitan mantenimiento', 'Tarea Creada'),
(1, 2, 11, '2021-07-15 16:49:38', 1, 1, 2, 6, 'Fabricar partes metalicas de los gazebos que esten en mal estado', 'Tarea Creada'),
(1, 3, 11, '2021-07-15 16:50:24', 1, 1, 2, 9, 'Rearmar gazebos ', 'Tarea Creada'),
(1, 1, 12, '2021-07-16 16:51:43', 1, 1, 1, 10, 'Retirar malezas y restos de plantas de los canteros', 'Tarea Creada'),
(1, 2, 12, '2021-07-16 16:54:06', 1, 1, 1, 10, 'Reacondicionar la tierra de los canteros, mejorar estado', 'Tarea Creada'),
(1, 3, 12, '2021-07-16 16:54:58', 1, 1, 1, 10, 'Poner plantines de la temporada actual, de colores anaranjados.', 'Tarea Creada'),
(1, 1, 13, '2021-07-17 16:58:31', 1, 1, 2, 1, 'Verificar estado de las cañerias y destapar las que se encuentren en mal estado', 'Tarea Creada'),
(1, 2, 13, '2021-07-17 16:59:16', 1, 1, 2, 1, 'Cambiar cañerias que esten rotas o no puedan ser reparadas', 'Tarea Creada'),
(1, 3, 13, '2021-07-17 17:01:41', 1, 1, 2, 1, 'Revisar canillas y arreglar las que goteen o no funcionen', 'Tarea Creada'),
(1, 1, 14, '2021-07-18 17:02:55', 1, 1, 2, 9, 'Quitar cortinas del escenario y quitar las butacas', 'Tarea Creada'),
(1, 2, 14, '2021-07-18 17:03:25', 1, 1, 2, 8, 'Cambiar tablas rotas del escenario', 'Tarea Creada'),
(1, 3, 14, '2021-07-18 17:03:50', 1, 1, 2, 7, 'Realizar limpieza de las cortinas', 'Tarea Creada'),
(1, 4, 14, '2021-07-18 17:05:35', 1, 1, 2, 7, 'CAmbiar tapizado de las butacas', 'Tarea Creada'),
(1, 5, 14, '2021-07-18 17:05:54', 1, 1, 2, 9, 'Rearmar el teatro', 'Tarea Creada'),
(1, 1, 15, '2021-07-19 17:07:11', 1, 1, 2, 4, 'Verificar estado de los enchufes y si funcionan', 'Tarea Creada'),
(1, 2, 15, '2021-07-19 17:07:46', 1, 1, 2, 4, 'Agregar dos enchufes a cada sala', 'Tarea Creada'),
(1, 1, 16, '2021-07-20 17:25:34', 1, 1, 1, 2, 'Quitar todo el reboque y las partes con humedad\r\n', 'Tarea Creada'),
(1, 2, 16, '2021-07-20 17:30:35', 1, 1, 1, 2, 'Rebocar las paredes de la fachada', 'Tarea Creada'),
(1, 3, 16, '2021-07-20 17:31:15', 1, 1, 1, 3, 'Pintar todas las paredes', 'Tarea Creada'),
(1, 1, 17, '2021-07-21 17:35:57', 1, 1, 1, 2, 'Quitar baldosas del acceso', 'Tarea Creada'),
(1, 2, 17, '2021-07-21 17:36:19', 1, 1, 1, 2, 'Colocar las baldosas', 'Tarea Creada'),
(1, 1, 18, '2021-07-22 17:48:58', 1, 1, 3, 4, 'Revisar la conexion electrica del timbre', 'Tarea Creada'),
(1, 2, 18, '2021-07-22 17:49:27', 1, 1, 3, 4, 'Cambiar timbre por uno nuevo', 'Tarea Creada'),
(1, 1, 19, '2021-07-23 17:53:57', 1, 1, 2, 7, 'Realizar tareas de restauracion de las ventanas', 'Tarea Creada'),
(1, 2, 19, '2021-07-23 17:54:18', 1, 1, 2, 7, 'Realizar tareas de restauracion del piso', 'Tarea Creada'),
(1, 3, 19, '2021-07-23 17:54:57', 1, 1, 2, 9, 'Realizar limpieza de las cortinas', 'Tarea Creada'),
(1, 1, 20, '2021-07-24 17:56:38', 1, 1, 4, 1, 'Cortar el suministro del agua', 'Tarea Creada'),
(1, 2, 20, '2021-07-24 17:57:06', 1, 1, 3, 1, 'Quitar y colocar un nuevo inodoro', 'Tarea Creada'),
(2, 1, 17, '2021-07-21 17:36:40', 1, 1, 1, 2, 'Quitar baldosas del acceso que esten en mal estado', 'Tarea Modificada'),
(3, 1, 17, '2021-07-21 17:36:40', 1, 1, 1, 2, 'Quitar baldosas del acceso que esten en mal estado', 'Tarea Modificada');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `insumos`
--

CREATE TABLE `insumos` (
  `id` int(11) NOT NULL,
  `nombre` varchar(30) NOT NULL,
  `descripcion` varchar(50) NOT NULL,
  `stockReal` int(11) NOT NULL DEFAULT '0',
  `stockComprometido` int(11) NOT NULL DEFAULT '0',
  `stockFuturo` int(11) NOT NULL DEFAULT '0',
  `stockMinimo` int(11) NOT NULL,
  `idMedida` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `insumos`
--

INSERT INTO `insumos` (`id`, `nombre`, `descripcion`, `stockReal`, `stockComprometido`, `stockFuturo`, `stockMinimo`, `idMedida`) VALUES
(1, 'tornillo', 'cruz chico', 10, 0, 3, 80, 1),
(2, 'tornillo', 'cruz mediano', 200, 0, 3, 80, 1),
(3, 'tornillo', 'cruz largo', 15, 0, 2, 80, 1),
(4, 'tornillo', 'liso chico', 200, 0, 0, 80, 1),
(5, 'tornillo', 'liso mediano', 340, 0, 0, 80, 1),
(6, 'tornillo', 'liso largo', 45, 0, 0, 80, 1),
(7, 'clavo', 'madero corto', 450, 0, 4, 100, 1),
(8, 'clavo', 'madero mediano', 55, 1, 5, 100, 1),
(9, 'clavo', 'madero largo', 50, 0, 5, 100, 1),
(10, 'clavo', 'chapa corto', 150, 9, 0, 100, 1),
(11, 'clavo', 'chapa mediano', 25, 0, 2, 100, 1),
(12, 'clavo', 'chapa largo', 25, 0, 0, 100, 1),
(13, 'tuerca', 'chica', 150, 0, 0, 200, 1),
(14, 'tuerca', 'mediana', 250, 0, 0, 200, 1),
(15, 'tuerca', 'grande', 0, 0, 0, 200, 1),
(16, 'fisher', 'chico', 0, 0, 0, 50, 1),
(17, 'fisher', 'mediano', 12, 0, 0, 50, 1),
(18, 'fisher', 'grande', 321, 0, 0, 50, 1),
(19, 'codo', '24cm', 50, 0, 0, 20, 1),
(20, 'codo', 'en T 12cm', 20, 0, 0, 20, 1),
(21, 'codo', 'en L 5cm', 44, 0, 0, 20, 1),
(22, 'Lampara Led', '40w caliente', 5, 0, 0, 5, 1),
(23, 'Lampara Led', '40w fria', 10, 0, 0, 5, 1),
(24, 'Lampara Led', '5w caliente', 2, 0, 0, 5, 1),
(25, 'Lampara Led', '5w fria', 8, 0, 2, 5, 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `insumos_x_oc`
--

CREATE TABLE `insumos_x_oc` (
  `idInsumo` int(11) NOT NULL,
  `idOC` int(11) NOT NULL,
  `cantidadPedida` int(11) NOT NULL,
  `cantidadRecibida` int(11) DEFAULT '0',
  `idEstado` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `insumos_x_oc`
--

INSERT INTO `insumos_x_oc` (`idInsumo`, `idOC`, `cantidadPedida`, `cantidadRecibida`, `idEstado`) VALUES
(1, 2, 3, 0, 1),
(2, 1, 3, 0, 1),
(3, 1, 2, 0, 1),
(7, 2, 4, 0, 1),
(8, 1, 5, 0, 1),
(9, 2, 5, 0, 1),
(11, 1, 2, 0, 1),
(25, 2, 2, 0, 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `insumos_x_tareas`
--

CREATE TABLE `insumos_x_tareas` (
  `idInsumo` int(11) NOT NULL,
  `idPedido` int(11) NOT NULL,
  `idTarea` int(11) NOT NULL,
  `fecha` datetime NOT NULL,
  `cantidad` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;



-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `medidas`
--

CREATE TABLE `medidas` (
  `id` int(11) NOT NULL,
  `nombre` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `medidas`
--

INSERT INTO `medidas` (`id`, `nombre`) VALUES
(9, 'cm3'),
(2, 'gr'),
(3, 'kg'),
(7, 'lt'),
(5, 'm'),
(10, 'm3'),
(6, 'ml'),
(4, 'mm'),
(8, 'mm3'),
(1, 'Unid.');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `ordenesdecompra`
--

CREATE TABLE `ordenesdecompra` (
  `id` int(11) NOT NULL,
  `costoEstimado` float NOT NULL DEFAULT '0',
  `costoFinal` float DEFAULT NULL,
  `fechaInicio` datetime NOT NULL,
  `fechaFin` datetime DEFAULT NULL,
  `idEstadoOC` int(11) NOT NULL,
  `idUsuario` int(11) NOT NULL,
  `idTipoOrdenDeCompra` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `ordenesdecompra`
--

INSERT INTO `ordenesdecompra` (`id`, `costoEstimado`, `costoFinal`, `fechaInicio`, `fechaFin`, `idEstadoOC`, `idUsuario`, `idTipoOrdenDeCompra`) VALUES
(1, 123123, NULL, '2021-07-05 18:15:12', NULL, 1, 1, 2),
(2, 19000, NULL, '2021-07-09 08:45:50', NULL, 1, 1, 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `ordenesdetrabajo`
--

CREATE TABLE `ordenesdetrabajo` (
  `id` int(11) NOT NULL,
  `fechaInicio` datetime NOT NULL,
  `fechaFin` datetime DEFAULT NULL,
  `idEstado` int(11) NOT NULL,
  `idUsuario` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;



--
-- Estructura de tabla para la tabla `pedidos`
--

CREATE TABLE `pedidos` (
  `id` int(11) NOT NULL,
  `descripcion` text NOT NULL,
  `fechaInicio` datetime NOT NULL,
  `fechaFin` datetime DEFAULT NULL,
  `idUsuario` int(11) NOT NULL,
  `idEstado` int(11) NOT NULL,
  `idSector` int(11) NOT NULL,
  `idPrioridad` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `pedidos`
--

INSERT INTO `pedidos` (`id`, `descripcion`, `fechaInicio`, `fechaFin`, `idUsuario`, `idEstado`, `idSector`, `idPrioridad`) VALUES

(1, 'test 1 pedidos', '2021-07-05 18:15:35', NULL, 3, 2, 11, 2),
(2, 'as das dsak', '2021-03-05 18:19:00', NULL, 3, 2, 7, 3),
(3, 'Acondicionar hogar para nuevos pacientes', '2021-07-11 20:39:57', NULL, 3, 1, 4, 2),
(4, 'Acondicionar sala de diagnostico\r\n', '2021-07-11 20:46:04', NULL, 3, 1, 6, 3),
(5, 'Problemas con el techo en la oficina, se llueve en varios puntos\r\n', '2021-07-12 20:50:49', NULL, 3, 1, 27, 2),
(6, 'busncar en la enfeda\r\nd', '2021-07-11 20:51:51', '2021-07-12 20:52:32', 3, 4, 25, 2),
(7, 'Se necesita instalar un sistema de ventilacion para el invierno/verano', '2021-07-13 21:07:29', NULL, 3, 1, 12, 2),
(8, 'Verificar estado de las camilla utilizadas por los pacientes', '2021-07-13 21:12:13', NULL, 3, 1, 21, 2),
(9, 'Se necesita arreglar los gabinetes de los consultorios, las puertas no cierran. Verificar lugar de guardado', '2021-07-14 12:15:53', NULL, 3, 1, 20, 2),
(10, 'Remodelar sala de espera del vacunatorio. Sillas en mal estado', '2021-07-14 12:30:20', NULL, 3, 1, 29, 2),
(11, 'Reacondicionar gazebos 3 y 4.\r\n', '2021-07-14 16:48:06', NULL, 3, 1, 29, 2),
(12, 'Reacondicionar canteros de la entrada\r\n', '2021-07-15 16:51:01', NULL, 3, 1, 30, 2),
(13, 'Verificar  estado de las piletas y canillas\r\n', '2021-07-16 16:56:52', NULL, 3, 1, 11, 3),
(14, 'Reacondicionar teatro\r\n', '2021-07-17 17:02:22', NULL, 3, 1, 12, 2),
(15, 'Cambiar instalacion electrica de las salas 3,4,5 y 6', '2021-07-18 17:06:43', NULL, 3, 1, 15, 1),
(16, 'Reacondiconar fachada del edificio', '2021-07-19 17:25:00', NULL, 3, 1, 22, 1),
(17, 'Arreglar accesos al edificio', '2021-07-21 17:35:18', NULL, 3, 1, 16, 2),
(18, 'No funciona el timbre de la porteria', '2021-07-22 17:48:29', NULL, 3, 1, 30, 4),
(19, 'Restaurar salon de actos de sector', '2021-07-23 17:53:10', NULL, 3, 1, 24, 2),
(20, 'Se necesita de forma urgente cambiar un inodoro, esta inundando todo el baño', '2021-07-24 17:56:16', NULL, 3, 1, 6, 4),
(21, 'Descripcion', '2021-03-1 21:03:49', NULL, 3, 1, 22, 2),
(22, 'Descripcion', '2021-03-2 21:03:49', NULL, 3, 1, 24, 2),
(23, 'Descripcion', '2021-03-3 21:03:49', NULL, 3, 1, 17, 2),
(24, 'Descripcion', '2021-03-4 21:03:49', NULL, 3, 1, 18, 2),
(25, 'Descripcion', '2021-03-5 21:03:49', NULL, 3, 1, 17, 2),
(26, 'Descripcion', '2021-03-6 21:03:49', NULL, 3, 1, 25, 2),
(27, 'Descripcion', '2021-03-8 21:03:49', NULL, 3, 1, 10, 2),
(28, 'Descripcion', '2021-03-9 21:03:49', NULL, 3, 1, 12, 2),
(29, 'Descripcion', '2021-03-10 21:03:49', NULL, 3, 1, 15, 2),
(30, 'Descripcion', '2021-03-11 21:03:49', NULL, 3, 1, 1, 2),
(31, 'Descripcion', '2021-03-12 21:03:49', NULL, 3, 1, 3, 2),
(32, 'Descripcion', '2021-03-13 21:03:49', NULL, 3, 1, 5, 2),
(33, 'Descripcion', '2021-03-15 21:03:49', NULL, 3, 1, 27, 2),
(34, 'Descripcion', '2021-03-16 21:03:49', NULL, 3, 1, 27, 2),
(35, 'Descripcion', '2021-03-17 21:03:49', NULL, 3, 1, 27, 2),
(36, 'Descripcion', '2021-03-18 21:03:49', NULL, 3, 1, 27, 2),
(37, 'Descripcion', '2021-03-19 21:03:49', NULL, 3, 1, 27, 2),
(38, 'Descripcion', '2021-03-20 21:03:49', NULL, 3, 1, 27, 2),
(39, 'Descripcion', '2021-03-22 21:03:49', NULL, 3, 1, 27, 2),
(40, 'Descripcion', '2021-03-23 21:03:49', NULL, 3, 1, 27, 2),
(41, 'Descripcion', '2021-03-24 21:03:49', NULL, 3, 1, 27, 2),
(42, 'Descripcion', '2021-03-25 21:03:49', NULL, 3, 1, 27, 2),
(43, 'Descripcion', '2021-03-26 21:03:49', NULL, 3, 1, 27, 2),
(44, 'Descripcion', '2021-03-27 21:03:49', NULL, 3, 1, 27, 2),
(45, 'Descripcion', '2021-03-29 21:03:49', NULL, 3, 1, 27, 2),
(46, 'Descripcion', '2021-03-30 21:03:49', NULL, 3, 1, 27, 2),


(47, 'Descripcion', '2021-04-1 21:03:49', NULL, 3, 1, 27, 2),
(48, 'Descripcion', '2021-04-2 21:03:49', NULL, 3, 1, 27, 2),
(49, 'Descripcion', '2021-04-3 21:03:49', NULL, 3, 1, 27, 2),
(50, 'Descripcion', '2021-04-7 21:03:49', NULL, 3, 1, 27, 2),
(51, 'Descripcion', '2021-04-5 21:03:49', NULL, 3, 1, 27, 2),
(52, 'Descripcion', '2021-04-6 21:03:49', NULL, 3, 1, 27, 2),
(53, 'Descripcion', '2021-04-8 21:03:49', NULL, 3, 1, 27, 2),
(54, 'Descripcion', '2021-04-9 21:03:49', NULL, 3, 1, 27, 2),
(55, 'Descripcion', '2021-04-10 21:03:49', NULL, 3, 1, 27, 2),
(56, 'Descripcion', '2021-04-12 21:03:49', NULL, 3, 1, 27, 2),
(57, 'Descripcion', '2021-04-13 21:03:49', NULL, 3, 1, 27, 2),
(58, 'Descripcion', '2021-04-14 21:03:49', NULL, 3, 1, 27, 2),
(59, 'Descripcion', '2021-04-15 21:03:49', NULL, 3, 1, 27, 2),
(60, 'Descripcion', '2021-04-16 21:03:49', NULL, 3, 1, 27, 2),
(61, 'Descripcion', '2021-04-17 21:03:49', NULL, 3, 1, 27, 2),
(62, 'Descripcion', '2021-04-19 21:03:49', NULL, 3, 1, 27, 2),
(63, 'Descripcion', '2021-04-20 21:03:49', NULL, 3, 1, 27, 2),
(64, 'Descripcion', '2021-04-21 21:03:49', NULL, 3, 1, 27, 2),
(65, 'Descripcion', '2021-04-22 21:03:49', NULL, 3, 1, 27, 2),
(66, 'Descripcion', '2021-04-23 21:03:49', NULL, 3, 1, 27, 2),
(67, 'Descripcion', '2021-04-24 21:03:49', NULL, 3, 1, 27, 2),
(68, 'Descripcion', '2021-04-26 21:03:49', NULL, 3, 1, 27, 2),
(69, 'Descripcion', '2021-04-27 21:03:49', NULL, 3, 1, 27, 2),
(70, 'Descripcion', '2021-04-28 21:03:49', NULL, 3, 1, 27, 2),
(71, 'Descripcion', '2021-04-29 21:03:49', NULL, 3, 1, 27, 2),
(72, 'Descripcion', '2021-04-30 21:03:49', NULL, 3, 1, 27, 2),


(73, 'Descripcion', '2021-05-1 21:03:49', NULL, 3, 1, 27, 2),
(74, 'Descripcion', '2021-05-3 21:03:49', NULL, 3, 1, 27, 2),
(75, 'Descripcion', '2021-05-4 21:03:49', NULL, 3, 1, 27, 2),
(76, 'Descripcion', '2021-05-5 21:03:49', NULL, 3, 1, 27, 2),
(77, 'Descripcion', '2021-05-6 21:03:49', NULL, 3, 1, 27, 2),
(78, 'Descripcion', '2021-05-7 21:03:49', NULL, 3, 1, 27, 2),
(79, 'Descripcion', '2021-05-8 21:03:49', NULL, 3, 1, 27, 2),
(80, 'Descripcion', '2021-05-10 21:03:49', NULL, 3, 1, 27, 2),
(81, 'Descripcion', '2021-05-11 21:03:49', NULL, 3, 1, 27, 2),
(82, 'Descripcion', '2021-05-12 21:03:49', NULL, 3, 1, 27, 2),
(83, 'Descripcion', '2021-05-13 21:03:49', NULL, 3, 1, 27, 2),
(84, 'Descripcion', '2021-05-14 21:03:49', NULL, 3, 1, 27, 2),
(85, 'Descripcion', '2021-05-15 21:03:49', NULL, 3, 1, 27, 2),
(86, 'Descripcion', '2021-05-17 21:03:49', NULL, 3, 1, 27, 2),
(87, 'Descripcion', '2021-05-18 21:03:49', NULL, 3, 1, 27, 2),
(88, 'Descripcion', '2021-05-19 21:03:49', NULL, 3, 1, 27, 2),
(89, 'Descripcion', '2021-05-20 21:03:49', NULL, 3, 1, 27, 2),
(90, 'Descripcion', '2021-05-21 21:03:49', NULL, 3, 1, 27, 2),
(91, 'Descripcion', '2021-05-22 21:03:49', NULL, 3, 1, 27, 2),
(92, 'Descripcion', '2021-05-24 21:03:49', NULL, 3, 1, 27, 2),
(93, 'Descripcion', '2021-05-25 21:03:49', NULL, 3, 1, 27, 2),
(94, 'Descripcion', '2021-05-26 21:03:49', NULL, 3, 1, 27, 2),
(95, 'Descripcion', '2021-05-27 21:03:49', NULL, 3, 1, 27, 2),
(96, 'Descripcion', '2021-05-28 21:03:49', NULL, 3, 1, 27, 2),
(97, 'Descripcion', '2021-05-29 21:03:49', NULL, 3, 1, 27, 2),



(98, 'Descripcion', '2021-06-1 21:03:49', NULL, 3, 1, 27, 2),
(99, 'Descripcion', '2021-06-2 21:03:49', NULL, 3, 1, 27, 2),
(100, 'Descripcion', '2021-06-3 21:03:49', NULL, 3, 1, 27, 2),
(101, 'Descripcion', '2021-06-4 21:03:49', NULL, 3, 1, 27, 2),
(102, 'Descripcion', '2021-06-5 21:03:49', NULL, 3, 1, 27, 2),
(103, 'Descripcion', '2021-06-7 21:03:49', NULL, 3, 1, 27, 2),
(104, 'Descripcion', '2021-06-8 21:03:49', NULL, 3, 1, 27, 2),
(105, 'Descripcion', '2021-06-9 21:03:49', NULL, 3, 1, 27, 2),
(106, 'Descripcion', '2021-06-10 21:03:49', NULL, 3, 1, 27, 2),
(107, 'Descripcion', '2021-06-11 21:03:49', NULL, 3, 1, 27, 2),
(108, 'Descripcion', '2021-06-12 21:03:49', NULL, 3, 1, 27, 2),
(109, 'Descripcion', '2021-06-14 21:03:49', NULL, 3, 1, 27, 2),
(110, 'Descripcion', '2021-06-15 21:03:49', NULL, 3, 1, 27, 2),
(111, 'Descripcion', '2021-06-16 21:03:49', NULL, 3, 1, 27, 2),
(112, 'Descripcion', '2021-06-17 21:03:49', NULL, 3, 1, 27, 2),
(113, 'Descripcion', '2021-06-18 21:03:49', NULL, 3, 1, 27, 2),
(114, 'Descripcion', '2021-06-19 21:03:49', NULL, 3, 1, 27, 2),
(115, 'Descripcion', '2021-06-21 21:03:49', NULL, 3, 1, 27, 2),
(116, 'Descripcion', '2021-06-22 21:03:49', NULL, 3, 1, 27, 2),
(117, 'Descripcion', '2021-06-23 21:03:49', NULL, 3, 1, 27, 2),
(118, 'Descripcion', '2021-06-24 21:03:49', NULL, 3, 1, 27, 2),
(119, 'Descripcion', '2021-06-25 21:03:49', NULL, 3, 1, 27, 2),
(120, 'Descripcion', '2021-06-26 21:03:49', NULL, 3, 1, 27, 2),
(121, 'Descripcion', '2021-06-28 21:03:49', NULL, 3, 1, 27, 2),
(122, 'Descripcion', '2021-06-29 21:03:49', NULL, 3, 1, 27, 2),
(123, 'Descripcion', '2021-06-30 21:03:49', NULL, 3, 1, 27, 2);


-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `permisos`
--

CREATE TABLE `permisos` (
  `id` int(11) NOT NULL,
  `nombre` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `permisos`
--

INSERT INTO `permisos` (`id`, `nombre`) VALUES
(29, 'Alta Agentes'),
(33, 'Alta Especialidades'),
(37, 'Alta Eventos'),
(41, 'Alta Insumos'),
(49, 'Alta OC'),
(21, 'Alta OT'),
(13, 'Alta Pedidos'),
(5, 'Alta Permisos'),
(45, 'Alta Persona'),
(9, 'Alta Roles'),
(25, 'Alta Sectores'),
(17, 'Alta Tareas'),
(1, 'Alta Usuario'),
(30, 'Baja Agentes'),
(22, 'Baja CT'),
(34, 'Baja Especialidades'),
(38, 'Baja Eventos'),
(42, 'Baja Insumos'),
(50, 'Baja OC'),
(14, 'Baja Pedidos'),
(6, 'Baja Permisos'),
(46, 'Baja Persona'),
(26, 'Baja Sectores'),
(18, 'Baja Tareas'),
(10, 'Baja Toles'),
(2, 'Baja Usuario'),
(31, 'Modificar Agentes'),
(35, 'Modificar Especialid'),
(39, 'Modificar Eventos'),
(43, 'Modificar Insumos'),
(51, 'Modificar OC'),
(23, 'Modificar OT'),
(15, 'Modificar Pedidos'),
(7, 'Modificar Permisos'),
(47, 'Modificar Persona'),
(11, 'Modificar Roles'),
(27, 'Modificar Sectores'),
(19, 'Modificar Tareas'),
(3, 'Modificar Usuario'),
(32, 'Visualizar Agentes'),
(36, 'Visualizar Especiali'),
(40, 'Visualizar Eventos'),
(44, 'Visualizar Insumos'),
(52, 'Visualizar OC'),
(24, 'Visualizar OT'),
(16, 'Visualizar Pedidos'),
(8, 'Visualizar Permisos'),
(48, 'Visualizar Persona'),
(12, 'Visualizar Roles'),
(28, 'Visualizar Sectores'),
(20, 'Visualizar Tareas'),
(4, 'Visualizar Usuario');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `provincias`
--

CREATE TABLE `provincias` (
    `id` INTEGER PRIMARY KEY,
    `nombre` VARCHAR(60) NOT NULL,
    UNIQUE(`nombre`)
);

INSERT INTO `provincias` (`id`, `nombre`) VALUES
(6, 'Buenos Aires'),
(10, 'Catamarca'),
(22, 'Chaco'),
(26, 'Chubut'),
(2, 'Ciudad Autónoma de Buenos Aires'),
(14, 'Córdoba'),
(18, 'Corrientes'),
(30, 'Entre Ríos'),
(34, 'Formosa'),
(38, 'Jujuy'),
(42, 'La Pampa'),
(46, 'La Rioja'),
(50, 'Mendoza'),
(54, 'Misiones'),
(58, 'Neuquén'),
(62, 'Río Negro'),
(66, 'Salta'),
(70, 'San Juan'),
(74, 'San Luis'),
(78, 'Santa Cruz'),
(82, 'Santa Fe'),
(86, 'Santiago del Estero'),
(94, 'Tierra del Fuego, Antártida e Islas del Atlántico Sur'),
(90, 'Tucumán');


-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `Ciudades`
--

CREATE TABLE `ciudades` (
    `id` INTEGER PRIMARY KEY,
    `nombre` VARCHAR(60) NOT NULL,
    `idProvincia` INTEGER NOT NULL,
    FOREIGN KEY (`idProvincia`) REFERENCES `provincias`(`id`)
);

INSERT INTO `ciudades` (`id`, `nombre`, `idProvincia`) VALUES
(2007, 'Comuna 1', 2),
(2014, 'Comuna 2', 2),
(2021, 'Comuna 3', 2),
(2028, 'Comuna 4', 2),
(2035, 'Comuna 5', 2),
(2042, 'Comuna 6', 2),
(2049, 'Comuna 7', 2),
(2056, 'Comuna 8', 2),
(2063, 'Comuna 9', 2),
(2070, 'Comuna 10', 2),
(2077, 'Comuna 11', 2),
(2084, 'Comuna 12', 2),
(2091, 'Comuna 13', 2),
(2098, 'Comuna 14', 2),
(2105, 'Comuna 15', 2),
(6007, 'Adolfo Alsina', 6),
(6014, 'Adolfo Gonzales Chaves', 6),
(6021, 'Alberti', 6),
(6028, 'Almirante Brown', 6),
(6035, 'Avellaneda', 6),
(6042, 'Ayacucho', 6),
(6049, 'Azul', 6),
(6056, 'Bahía Blanca', 6),
(6063, 'Balcarce', 6),
(6070, 'Baradero', 6),
(6077, 'Arrecifes', 6),
(6084, 'Benito Juárez', 6),
(6091, 'Berazategui', 6),
(6098, 'Berisso', 6),
(6105, 'Bolívar', 6),
(6112, 'Bragado', 6),
(6119, 'Brandsen', 6),
(6126, 'Campana', 6),
(6134, 'Cañuelas', 6),
(6140, 'Capitán Sarmiento', 6),
(6147, 'Carlos Casares', 6),
(6154, 'Carlos Tejedor', 6),
(6161, 'Carmen de Areco', 6),
(6168, 'Castelli', 6),
(6175, 'Colón', 6),
(6182, 'Coronel de Marina Leonardo Rosales', 6),
(6189, 'Coronel Dorrego', 6),
(6196, 'Coronel Pringles', 6),
(6203, 'Coronel Suárez', 6),
(6210, 'Chacabuco', 6),
(6217, 'Chascomús', 6),
(6224, 'Chivilcoy', 6),
(6231, 'Daireaux', 6),
(6238, 'Dolores', 6),
(6245, 'Ensenada', 6),
(6252, 'Escobar', 6),
(6260, 'Esteban Echeverría', 6),
(6266, 'Exaltación de la Cruz', 6),
(6270, 'José M. Ezeiza', 6),
(6274, 'Florencio Varela', 6),
(6277, 'Florentino Ameghino', 6),
(6280, 'General Alvarado', 6),
(6287, 'General Alvear', 6),
(6294, 'General Arenales', 6),
(6301, 'General Belgrano', 6),
(6308, 'General Guido', 6),
(6315, 'General Juan Madariaga', 6),
(6322, 'General La Madrid', 6),
(6329, 'General Las Heras', 6),
(6336, 'General Lavalle', 6),
(6343, 'General Paz', 6),
(6351, 'General Pinto', 6),
(6357, 'General Pueyrredón', 6),
(6364, 'General Rodríguez', 6),
(6371, 'Ciudad Libertador San Martín', 6),
(6385, 'General Viamonte', 6),
(6392, 'General Villegas', 6),
(6399, 'Guaminí', 6),
(6406, 'Hipólito Yrigoyen', 6),
(6408, 'Hurlingham', 6),
(6410, 'Ituzaingó', 6),
(6412, 'José C. Paz', 6),
(6413, 'Junín', 6),
(6420, 'La Costa', 6),
(6427, 'La Matanza', 6),
(6434, 'Lanús', 6),
(6441, 'La Plata', 6),
(6448, 'Laprida', 6),
(6455, 'Las Flores', 6),
(6462, 'Leandro N. Alem', 6),
(6466, 'Lezama', 6),
(6469, 'Lincoln', 6),
(6476, 'Lobería', 6),
(6483, 'Lobos', 6),
(6490, 'Lomas de Zamora', 6),
(6497, 'Luján', 6),
(6505, 'Magdalena', 6),
(6511, 'Maipú', 6),
(6515, 'Malvinas Argentinas', 6),
(6518, 'Mar Chiquita', 6),
(6525, 'Marcos Paz', 6),
(6532, 'Mercedes', 6),
(6539, 'Merlo', 6),
(6547, 'Monte', 6),
(6553, 'Monte Hermoso', 6),
(6560, 'Moreno', 6),
(6568, 'Morón', 6),
(6574, 'Navarro', 6),
(6581, 'Necochea', 6),
(6588, '9 de Julio', 6),
(6595, 'Olavarría', 6),
(6602, 'Patagones', 6),
(6609, 'Pehuajó', 6),
(6616, 'Pellegrini', 6),
(6623, 'Pergamino', 6),
(6630, 'Pila', 6),
(6638, 'Pilar', 6),
(6644, 'Pinamar', 6),
(6648, 'Presidente Perón', 6),
(6651, 'Puán', 6),
(6655, 'Punta Indio', 6),
(6658, 'Quilmes', 6),
(6665, 'Ramallo', 6),
(6672, 'Rauch', 6),
(6679, 'Rivadavia', 6),
(6686, 'Rojas', 6),
(6693, 'Roque Pérez', 6),
(6700, 'Saavedra', 6),
(6707, 'Saladillo', 6),
(6714, 'Salto', 6),
(6721, 'Salliqueló', 6),
(6728, 'San Andrés de Giles', 6),
(6735, 'San Antonio de Areco', 6),
(6742, 'San Cayetano', 6),
(6749, 'San Fernando', 6),
(6756, 'San Isidro', 6),
(6760, 'San Miguel', 6),
(6763, 'San Nicolás', 6),
(6770, 'San Pedro', 6),
(6778, 'San Vicente', 6),
(6784, 'Suipacha', 6),
(6791, 'Tandil', 6),
(6798, 'Tapalqué', 6),
(6805, 'Tigre', 6),
(6812, 'Tordillo', 6),
(6819, 'Tornquist', 6),
(6826, 'Trenque Lauquen', 6),
(6833, 'Tres Arroyos', 6),
(6840, 'Tres de Febrero', 6),
(6847, 'Tres Lomas', 6),
(6854, '25 de Mayo', 6),
(6861, 'Vicente López', 6),
(6868, 'Villa Gesell', 6),
(6875, 'Villarino', 6),
(6882, 'Zárate', 6),
(10007, 'Ambato', 10),
(10014, 'Ancasti', 10),
(10021, 'Andalgalá', 10),
(10028, 'Antofagasta de la Sierra', 10),
(10035, 'Belén', 10),
(10042, 'Capayán', 10),
(10049, 'Capital', 10),
(10056, 'El Alto', 10),
(10063, 'Fray Mamerto Esquiú', 10),
(10070, 'La Paz', 10),
(10077, 'Paclín', 10),
(10084, 'Pomán', 10),
(10091, 'Santa María', 10),
(10098, 'Santa Rosa', 10),
(10105, 'Tinogasta', 10),
(10112, 'Valle Viejo', 10),
(14007, 'Calamuchita', 14),
(14014, 'Capital', 14),
(14021, 'Colón', 14),
(14028, 'Cruz del Eje', 14),
(14035, 'General Roca', 14),
(14042, 'General San Martín', 14),
(14049, 'Ischilín', 14),
(14056, 'Juárez Celman', 14),
(14063, 'Marcos Juárez', 14),
(14070, 'Minas', 14),
(14077, 'Pocho', 14),
(14084, 'Presidente Roque Sáenz Peña', 14),
(14091, 'Punilla', 14),
(14098, 'Río Cuarto', 14),
(14105, 'Río Primero', 14),
(14112, 'Río Seco', 14),
(14119, 'Río Segundo', 14),
(14126, 'San Alberto', 14),
(14133, 'San Javier', 14),
(14140, 'San Justo', 14),
(14147, 'Santa María', 14),
(14154, 'Sobremonte', 14),
(14161, 'Tercero Arriba', 14),
(14168, 'Totoral', 14),
(14175, 'Tulumba', 14),
(14182, 'Unión', 14),
(18007, 'Bella Vista', 18),
(18014, 'Berón de Astrada', 18),
(18021, 'Capital', 18),
(18028, 'Concepción', 18),
(18035, 'Curuzu Cuatia', 18),
(18042, 'Empedrado', 18),
(18049, 'Esquina', 18),
(18056, 'General Alvear', 18),
(18063, 'General Paz', 18),
(18070, 'Goya', 18),
(18077, 'Itatí', 18),
(18084, 'Ituzaingó', 18),
(18091, 'Lavalle', 18),
(18098, 'Mburucuyá', 18),
(18105, 'Mercedes', 18),
(18112, 'Monte Caseros', 18),
(18119, 'Paso de los Libres', 18),
(18126, 'Saladas', 18),
(18133, 'San Cosme', 18),
(18140, 'San Luis del Palmar', 18),
(18147, 'San Martín', 18),
(18154, 'San Miguel', 18),
(18161, 'San Roque', 18),
(18168, 'Santo Tomé', 18),
(18175, 'Sauce', 18),
(22007, 'Almirante Brown', 22),
(22014, 'Bermejo', 22),
(22021, 'Comandante Fernández', 22),
(22028, 'Chacabuco', 22),
(22036, '12 de Octubre', 22),
(22039, '2 de Abril', 22),
(22043, 'Fray Justo Santa María de Oro', 22),
(22049, 'General Belgrano', 22),
(22056, 'General Donovan', 22),
(22063, 'General Güemes', 22),
(22070, 'Independencia', 22),
(22077, 'Libertad', 22),
(22084, 'Libertador General San Martín', 22),
(22091, 'Maipú', 22),
(22098, 'Mayor Luis J. Fontana', 22),
(22105, '9 de Julio', 22),
(22112, 'O\ Higgins', 22),
(22119, 'Presidencia de la Plaza', 22),
(22126, '1° de Mayo', 22),
(22133, 'Quitilipi', 22),
(22140, 'San Fernando', 22),
(22147, 'San Lorenzo', 22),
(22154, 'Sargento Cabral', 22),
(22161, 'Tapenagá', 22),
(22168, '25 de Mayo', 22),
(26007, 'Biedma', 26),
(26014, 'Cushamen', 26),
(26021, 'Escalante', 26),
(26028, 'Florentino Ameghino', 26),
(26035, 'Futaleufú', 26),
(26042, 'Gaiman', 26),
(26049, 'Gastre', 26),
(26056, 'Languiñeo', 26),
(26063, 'Mártires', 26),
(26070, 'Paso de Indios', 26),
(26077, 'Rawson', 26),
(26084, 'Río Senguer', 26),
(26091, 'Sarmiento', 26),
(26098, 'Tehuelches', 26),
(26105, 'Telsen', 26),
(30008, 'Colón', 30),
(30015, 'Concordia', 30),
(30021, 'Diamante', 30),
(30028, 'Federación', 30),
(30035, 'Federal', 30),
(30042, 'Feliciano', 30),
(30049, 'Gualeguay', 30),
(30056, 'Gualeguaychú', 30),
(30063, 'Islas del Ibicuy', 30),
(30070, 'La Paz', 30),
(30077, 'Nogoyá', 30),
(30084, 'Paraná', 30),
(30088, 'San Salvador', 30),
(30091, 'Tala', 30),
(30098, 'Uruguay', 30),
(30105, 'Victoria', 30),
(30113, 'Villaguay', 30),
(34007, 'Bermejo', 34),
(34014, 'Formosa', 34),
(34021, 'Laishí', 34),
(34028, 'Matacos', 34),
(34035, 'Patiño', 34),
(34042, 'Pilagás', 34),
(34049, 'Pilcomayo', 34),
(34056, 'Pirané', 34),
(34063, 'Ramón Lista', 34),
(38007, 'Cochinoca', 38),
(38014, 'El Carmen', 38),
(38021, 'Dr. Manuel Belgrano', 38),
(38028, 'Humahuaca', 38),
(38035, 'Ledesma', 38),
(38042, 'Palpalá', 38),
(38049, 'Rinconada', 38),
(38056, 'San Antonio', 38),
(38063, 'San Pedro', 38),
(38070, 'Santa Bárbara', 38),
(38077, 'Santa Catalina', 38),
(38084, 'Susques', 38),
(38094, 'Tilcara', 38),
(38098, 'Tumbaya', 38),
(38105, 'Valle Grande', 38),
(38112, 'Yaví', 38),
(42007, 'Atreucó', 42),
(42014, 'Caleu Caleu', 42),
(42021, 'Capital', 42),
(42028, 'Catriló', 42),
(42035, 'Conhelo', 42),
(42042, 'Curacó', 42),
(42049, 'Chalileo', 42),
(42056, 'Chapaleufú', 42),
(42063, 'Chical Co', 42),
(42070, 'Guatraché', 42),
(42077, 'Hucal', 42),
(42084, 'Lihuel Calel', 42),
(42091, 'Limay Mahuida', 42),
(42098, 'Loventué', 42),
(42105, 'Maracó', 42),
(42112, 'Puelén', 42),
(42119, 'Quemú Quemú', 42),
(42126, 'Rancul', 42),
(42133, 'Realicó', 42),
(42140, 'Toay', 42),
(42147, 'Trenel', 42),
(42154, 'Utracán', 42),
(46007, 'Arauco', 46),
(46014, 'Capital', 46),
(46021, 'Castro Barros', 46),
(46028, 'Coronel Felipe Varela', 46),
(46035, 'Chamical', 46),
(46042, 'Chilecito', 46),
(46049, 'Famatina', 46),
(46056, 'General Ángel V. Peñaloza', 46),
(46063, 'General Belgrano', 46),
(46070, 'General Juan F. Quiroga', 46),
(46077, 'General Lamadrid', 46),
(46084, 'General Ocampo', 46),
(46091, 'General San Martín', 46),
(46098, 'Vinchina', 46),
(46105, 'Independencia', 46),
(46112, 'Rosario Vera Peñaloza', 46),
(46119, 'San Blas de Los Sauces', 46),
(46126, 'Sanagasta', 46),
(50007, 'Capital', 50),
(50014, 'General Alvear', 50),
(50021, 'Godoy Cruz', 50),
(50028, 'Guaymallén', 50),
(50035, 'Junín', 50),
(50042, 'La Paz', 50),
(50049, 'Las Heras', 50),
(50056, 'Lavalle', 50),
(50063, 'Luján de Cuyo', 50),
(50070, 'Maipú', 50),
(50077, 'Malargüe', 50),
(50084, 'Rivadavia', 50),
(50091, 'San Carlos', 50),
(50098, 'San Martín', 50),
(50105, 'San Rafael', 50),
(50112, 'Santa Rosa', 50),
(50119, 'Tunuyán', 50),
(50126, 'Tupungato', 50),
(54007, 'Apóstoles', 54),
(54014, 'Cainguás', 54),
(54021, 'Candelaria', 54),
(54028, 'Capital', 54),
(54035, 'Concepción', 54),
(54042, 'Eldorado', 54),
(54049, 'General Manuel Belgrano', 54),
(54056, 'Guaraní', 54),
(54063, 'Iguazú', 54),
(54070, 'Leandro N. Alem', 54),
(54077, 'Libertador General San Martín', 54),
(54084, 'Montecarlo', 54),
(54091, 'Oberá', 54),
(54098, 'San Ignacio', 54),
(54105, 'San Javier', 54),
(54112, 'San Pedro', 54),
(54119, '25 de Mayo', 54),
(58007, 'Aluminé', 58),
(58014, 'Añelo', 58),
(58021, 'Catán Lil', 58),
(58028, 'Collón Curá', 58),
(58035, 'Confluencia', 58),
(58042, 'Chos Malal', 58),
(58049, 'Huiliches', 58),
(58056, 'Lácar', 58),
(58063, 'Loncopué', 58),
(58070, 'Los Lagos', 58),
(58077, 'Minas', 58),
(58084, 'Ñorquín', 58),
(58091, 'Pehuenches', 58),
(58098, 'Picún Leufú', 58),
(58105, 'Picunches', 58),
(58112, 'Zapala', 58),
(62007, 'Adolfo Alsina', 62),
(62014, 'Avellaneda', 62),
(62021, 'Bariloche', 62),
(62028, 'Conesa', 62),
(62035, 'El Cuy', 62),
(62042, 'General Roca', 62),
(62049, '9 de julio', 62),
(62056, 'Ñorquinco', 62),
(62063, 'Pichi Mahuida', 62),
(62070, 'Pilcaniyeu', 62),
(62077, 'San Antonio', 62),
(62084, 'Valcheta', 62),
(62091, '25 de Mayo', 62),
(66007, 'Anta', 66),
(66014, 'Cachi', 66),
(66021, 'Cafayate', 66),
(66028, 'Capital', 66),
(66035, 'Cerrillos', 66),
(66042, 'Chicoana', 66),
(66049, 'General Güemes', 66),
(66056, 'General José de San Martín', 66),
(66063, 'Guachipas', 66),
(66070, 'Iruya', 66),
(66077, 'La Caldera', 66),
(66084, 'La Candelaria', 66),
(66091, 'La Poma', 66),
(66098, 'La Viña', 66),
(66105, 'Los Andes', 66),
(66112, 'Metán', 66),
(66119, 'Molinos', 66),
(66126, 'Orán', 66),
(66133, 'Rivadavia', 66),
(66140, 'Rosario de la Frontera', 66),
(66147, 'Rosario de Lerma', 66),
(66154, 'San Carlos', 66),
(66161, 'Santa Victoria', 66),
(70007, 'Albardón', 70),
(70014, 'Angaco', 70),
(70021, 'Calingasta', 70),
(70028, 'Capital', 70),
(70035, 'Caucete', 70),
(70042, 'Chimbas', 70),
(70049, 'Iglesia', 70),
(70056, 'Jáchal', 70),
(70063, '9 de Julio', 70),
(70070, 'Pocito', 70),
(70077, 'Rawson', 70),
(70084, 'Rivadavia', 70),
(70091, 'San Martín', 70),
(70098, 'Santa Lucía', 70),
(70105, 'Sarmiento', 70),
(70112, 'Ullum', 70),
(70119, 'Valle Fértil', 70),
(70126, '25 de Mayo', 70),
(70133, 'Zonda', 70),
(74007, 'Ayacucho', 74),
(74014, 'Belgrano', 74),
(74021, 'Coronel Pringles', 74),
(74028, 'Chacabuco', 74),
(74035, 'General Pedernera', 74),
(74042, 'Gobernador Dupuy', 74),
(74049, 'Junín', 74),
(74056, 'Juan Martín de Pueyrredón', 74),
(74063, 'Libertador General San Martín', 74),
(78007, 'Corpen Aike', 78),
(78014, 'Deseado', 78),
(78021, 'Güer Aike', 78),
(78028, 'Lago Argentino', 78),
(78035, 'Lago Buenos Aires', 78),
(78042, 'Magallanes', 78),
(78049, 'Río Chico', 78),
(82007, 'Belgrano', 82),
(82014, 'Caseros', 82),
(82021, 'Castellanos', 82),
(82028, 'Villa Constitución', 82),
(82035, 'Garay', 82),
(82042, 'General López', 82),
(82049, 'General Obligado', 82),
(82056, 'Iriondo', 82),
(82063, 'La Capital', 82),
(82070, 'Las Colonias', 82),
(82077, '9 de Julio', 82),
(82084, 'Rosario', 82),
(82091, 'San Cristóbal', 82),
(82098, 'San Javier', 82),
(82105, 'San Jerónimo', 82),
(82112, 'San Justo', 82),
(82119, 'San Lorenzo', 82),
(82126, 'San Martín', 82),
(82133, 'Vera', 82),
(86007, 'Aguirre', 86),
(86014, 'Alberdi', 86),
(86021, 'Atamisqui', 86),
(86028, 'Avellaneda', 86),
(86035, 'Banda', 86),
(86042, 'Belgrano', 86),
(86049, 'Capital', 86),
(86056, 'Copo', 86),
(86063, 'Choya', 86),
(86070, 'Figueroa', 86),
(86077, 'General Taboada', 86),
(86084, 'Guasayán', 86),
(86091, 'Jiménez', 86),
(86098, 'Juan F. Ibarra', 86),
(86105, 'Loreto', 86),
(86112, 'Mitre', 86),
(86119, 'Moreno', 86),
(86126, 'Ojo de Agua', 86),
(86133, 'Pellegrini', 86),
(86140, 'Quebrachos', 86),
(86147, 'Río Hondo', 86),
(86154, 'Rivadavia', 86),
(86161, 'Robles', 86),
(86168, 'Salavina', 86),
(86175, 'San Martín', 86),
(86182, 'Sarmiento', 86),
(86189, 'Silípica', 86),
(90007, 'Burruyacú', 90),
(90014, 'Cruz Alta', 90),
(90021, 'Chicligasta', 90),
(90028, 'Famaillá', 90),
(90035, 'Graneros', 90),
(90042, 'Juan Bautista Alberdi', 90),
(90049, 'La Cocha', 90),
(90056, 'Leales', 90),
(90063, 'Lules', 90),
(90070, 'Monteros', 90),
(90077, 'Río Chico', 90),
(90084, 'Capital', 90),
(90091, 'Simoca', 90),
(90098, 'Tafí del Valle', 90),
(90105, 'Tafí Viejo', 90),
(90112, 'Trancas', 90),
(90119, 'Yerba Buena', 90),
(94008, 'Río Grande', 94),
(94011, 'Tolhuin', 94),
(94015, 'Ushuaia', 94),
(94021, 'Islas del Atlántico Sur', 94),
(94028, 'Antártida Argentina', 94);


-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `Direccion`
--

CREATE TABLE `direccion` (
    `id` INTEGER PRIMARY KEY AUTO_INCREMENT,
    `idCiudad` INTEGER NOT NULL,
    `calle` VARCHAR(50) NOT NULL,
    `numero` VARCHAR(50) NOT NULL,
    FOREIGN KEY (`idCiudad`) REFERENCES `ciudades`(`id`)
);


INSERT INTO `direccion` (`idCiudad`,`calle`,`numero`)VALUES 
    (94028,'Pinguino',111),
    (6049,'Lavalle',752),
    (82056,'Constanza',125),
    (86147,'Av. San Martin',1052),
    (6882,'Castelli',98),
    (6497,'Francia',128),
    (6497,'La Rioja',512),
    (6560,'Paysandú',96),
    (6560,'Independencia',456),
    (6364,'Liniers',789),
    (6364,'Rivadavia',963),
    (6364,'Rivadavia',963),
    (6364,'Rivadavia',963),
    (6364,'Rivadavia',963),
    (6364,'Rivadavia',963),
    (6364,'Rivadavia',963),
    (6364,'Rivadavia',963),
    (6364,'Rivadavia',963);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `personas`
--

CREATE TABLE `personas` (
    `id` INTEGER NOT NULL,
    `nombre` VARCHAR(30) NOT NULL,
    `apellido` VARCHAR(30) NOT NULL,
    `idDireccion` INTEGER NOT NULL,
    `fechaNacimiento` DATE NOT NULL,
    `email` VARCHAR(30) NOT NULL,
    `idEstadoPersona` INTEGER NOT NULL
)ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `personas`
--

INSERT INTO `personas` (`id`, `nombre`, `apellido`, `idDireccion`, `fechaNacimiento`, `email`, `idEstadoPersona`) VALUES
(00000000,'superAdmin','superAdmin',1,'2000-01-01','pitta1881@gmail.com',1),
(10548951, 'Roque', 'Feller', 2, '1973-05-07', 'roquefeller@mail.com', 1),
(11188169, 'Adrian', 'Diaz', 3, '1971-02-10', 'adiaz@test.com', 1),
(13569841, 'Gabriel', 'Medina', 4, '1980-02-12', 'gabym@mail.com', 1),
(15896236, 'Pablo', 'Lampone', 5, '1986-06-10', 'plampone@mail.com', 1),
(16131891, 'Omar Lozano', 'Hernandez', 6, '1954-07-09', 'pontipak@me.com', 1),
(17145072, 'Blanca', 'Garcia', 7, '1995-11-17', 'brcia@test.com', 1),
(19917833, 'Francisco', 'Guerrero', 8, '1984-02-22', 'frrero@test.com', 1),
(22456368, 'Marcelo', 'Lombardo', 9, '1975-05-02', 'epopasu_1210@yopmail.com', 1),
(23658120, 'Mario', 'Santos', 10, '1982-11-10', 'marios@mail.com', 1),
(24205172, 'Diana', 'Moya', 11, '1999-11-30', 'wonderkid@gmail.com', 1),
(25174962, 'Susana', 'Gonsales', 12, '1991-01-15', 'sgonsales@mail.com', 1),
(26009360, 'Naia', 'Bosch', 13, '1990-07-12', 'pkilab@verizon.net', 1),
(26547123, 'Sandra', 'Perez', 14, '1977-11-23', 'sp@gmail.com', 1),
(26585543, 'Omar', 'Ramirez', 15, '1975-05-02', 'crowemojo@hotmail.com', 3),
(29651289, 'Emilio', 'Ravenna', 16, '1990-08-28', 'ravenae@mail.com', 1),
(32454949, 'Jose Manuel', 'Pascual', 17, '1975-01-03', 'heine@outlook.com', 1),
(39447859, 'Irene', 'Guerrero', 18, '1986-03-14', 'igrero@test.com', 1);
;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `prioridades`
--

CREATE TABLE `prioridades` (
  `id` int(11) NOT NULL,
  `nombre` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `prioridades`
--

INSERT INTO `prioridades` (`id`, `nombre`) VALUES
(3, 'Alta'),
(1, 'Baja'),
(2, 'Media'),
(4, 'Urgente');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `roles`
--

CREATE TABLE `roles` (
  `id` int(11) NOT NULL,
  `nombre` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `roles`
--

INSERT INTO `roles` (`id`, `nombre`) VALUES
(2, 'Operador'),
(1, 'superAdmin');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `roles_x_permisos`
--

CREATE TABLE `roles_x_permisos` (
  `idRol` int(11) NOT NULL,
  `idPermiso` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `roles_x_permisos`
--

INSERT INTO `roles_x_permisos` (`idRol`, `idPermiso`) VALUES
(1, 1),
(1, 2),
(1, 3),
(1, 4),
(1, 5),
(1, 6),
(1, 7),
(1, 8),
(1, 9),
(1, 10),
(1, 11),
(1, 12),
(1, 13),
(1, 14),
(1, 15),
(1, 16),
(1, 17),
(1, 18),
(1, 19),
(1, 20),
(1, 21),
(1, 22),
(1, 23),
(1, 24),
(1, 25),
(1, 26),
(1, 27),
(1, 28),
(1, 29),
(1, 30),
(1, 31),
(1, 32),
(1, 33),
(1, 34),
(1, 35),
(1, 36),
(1, 37),
(1, 38),
(1, 39),
(1, 40),
(1, 41),
(1, 42),
(1, 43),
(1, 44),
(1, 45),
(1, 46),
(1, 47),
(1, 48),
(1, 49),
(1, 50),
(1, 51),
(1, 52),
(2, 13),
(2, 14),
(2, 15),
(2, 16),
(2, 17),
(2, 18),
(2, 19),
(2, 20),
(2, 21),
(2, 22),
(2, 23),
(2, 24),
(2, 37),
(2, 38),
(2, 39),
(2, 40),
(2, 41),
(2, 42),
(2, 43),
(2, 44),
(2, 49),
(2, 50),
(2, 51),
(2, 52);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `roles_x_usuarios`
--

CREATE TABLE `roles_x_usuarios` (
  `idRol` int(11) NOT NULL,
  `idUsuario` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `roles_x_usuarios`
--

INSERT INTO `roles_x_usuarios` (`idRol`, `idUsuario`) VALUES
(1, 1),
(2, 2),
(2, 3);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `sectores`
--

CREATE TABLE `sectores` (
  `id` int(11) NOT NULL,
  `nombre` varchar(30) NOT NULL,
  `responsable` varchar(30) NOT NULL,
  `telefono` varchar(30) DEFAULT NULL,
  `email` varchar(30) DEFAULT NULL,
  `idTipoSector` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `sectores`
--

INSERT INTO `sectores` (`id`, `nombre`, `responsable`, `telefono`, `email`, `idTipoSector`) VALUES
(1, 'Pabellon 1', 'Sra. Tatiana IZRASTZOFF', '101', 'pab1@sommer.com.ar', 1),
(2, 'Pabellon 2', 'Sra. Stella Maris PEREZ', '102', 'pab2@sommer.com.ar', 1),
(3, 'Pabellon 3', 'Sra. Tatiana IZRASTZOFF', '103', 'pab3@sommer.com.ar', 1),
(4, 'Pabellon 4', 'Sra. Silvina Marisa TOUTAIN', '104', 'pab4@sommer.com.ar', 1),
(5, 'Pabellon 5', 'Sra. Tatiana IZRASTZOFF', '105', 'pab5@sommer.com.ar', 1),
(6, 'Pabellon 6', 'Sra. Victoria Inés AMBROSIO', '106', 'pab6@sommer.com.ar', 1),
(7, 'Pabellon 7', 'Sra. Tatiana IZRASTZOFF', '107', 'pab7@sommer.com.ar', 1),
(8, 'Pabellon 8', 'Sr. Luis Elias RIVERA', '108', 'pab8@sommer.com.ar', 1),
(9, 'Pabellon 9', 'Sra. Tatiana IZRASTZOFF', '109', 'pab9@sommer.com.ar', 1),
(10, 'Pabellon 10', 'Sra. Tatiana IZRASTZOFF', '110', 'pab10@sommer.com.ar', 1),
(11, 'Equipamiento Medico', 'Dra. Lidia Elina AUTIERO', '200', 'equipamientom@sommer.com.ar', 1),
(12, 'Centro de Jubilados', 'Lic. Sergio Hernán GLASSMAN', '201', 'cjub@sommer.com.ar', 1),
(13, 'Servicio Social', 'Lic. Mónica PESTAÑA', '202', 'servsocial@sommer.com.ar', 1),
(14, 'Guardia Medica', ' Sra. Tatiana IZRASTZOFF', '203', 'guardiam@sommer.com.ar', 1),
(15, 'Hemoterapia', 'Sr. Javier Damián QUIROGA', '204', 'hemoterapia@sommer.com.ar', 1),
(16, 'Area Tercera Edad y Recreacion', 'Lic. Sergio Hernán GLASSMAN', '205', 'arecreacion@sommer.com.ar', 1),
(17, 'Compras y Contrataciones', 'Lic. Sergio Hernán GLASSMAN', '206', 'comprascontrataciones@sommer.c', 1),
(18, 'Direccion de Atencion Medica', 'Dra. Marisol RODRÍGUEZ GOÑI', '207', 'amedica@sommer.com.ar', 1),
(19, 'Direccion de Servicios Tecnico', 'Lic. María de los Ángeles SCAG', '208', 'servtecnicos@sommer.com.ar', 1),
(20, 'Consultorios', 'Sra. Tatiana IZRASTZOFF', '209', 'consultoriosext@sommer.com.ar', 1),
(21, 'Rehabilitacion', 'Sra. Silvina Marisa TOUTAIN', '210', 'rehab@sommer.com.ar', 1),
(22, 'Recursos Humanos', 'Dra. Paula del Carmen SANTANA', '300', 'rrhh@sommer.com.ar', 1),
(23, 'Farmacia', 'Sra. Florencia BALDUNCIEL', '301', 'farmaciasommer@sommer.com.ar', 1),
(24, 'Docencia e Investigacion', 'Sr. Cristian VIAGGIO', '302', 'investigacion@sommer.com.ar', 1),
(25, 'Gestión Territorial', 'Sr. Sergio Oscar MASSETI', '303', 'gterritorial@sommer.com.ar', 1),
(26, 'Dirección', 'Dr. Gustavo Antonio MARRONE', '304', 'direccion@sommer.com.ar', 1),
(27, 'Administracion', 'Sra. Sandra Marcela CAMIO', '305', 'administracion@sommer.com.ar', 1),
(28, 'Comision de Recepcion', 'Sr. Sergio Oscar MASSETI', '401', 'recepcion@sommer.com.ar', 1),
(29, 'Vacunatorio', 'Dra. Soledad Celeste VELÁZQUEZ', '402', 'vacsommer@sommer.com.ar', 1),
(30, 'Porteria', 'Sr. Sergio Oscar MASSETI', '403', 'porteriasommer@sommer.com.ar', 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tareas`
--

CREATE TABLE `tareas` (
  `id` int(11) NOT NULL,
  `fechaInicio` datetime NOT NULL,
  `fechaFin` datetime DEFAULT NULL,
  `descripcion` text NOT NULL,
  `idPedido` int(11) NOT NULL,
  `idOrdenDeTrabajo` int(11) DEFAULT NULL,
  `idUsuario` int(11) NOT NULL,
  `idEspecializacion` int(11) NOT NULL,
  `idEstado` int(11) NOT NULL,
  `idPrioridad` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `tareas`
--

INSERT INTO `tareas` (`id`, `fechaInicio`, `fechaFin`, `descripcion`, `idPedido`, `idOrdenDeTrabajo`, `idUsuario`, `idEspecializacion`, `idEstado`, `idPrioridad`) VALUES
(1, '2021-07-05 18:15:52', NULL, 'test tarea 1', 1, NULL, 3, 3, 1, 2),
(1, '2021-07-05 18:20:34', NULL, 'asd sad wa', 2, NULL, 3, 4, 1, 2),
(1, '2021-07-11 20:41:05', NULL, 'Revisar estado general del techo', 3, NULL, 3, 9, 1, 2),
(1, '2021-07-11 20:48:20', NULL, 'Cambiar ceramicas rotas del piso ', 4, NULL, 3, 2, 1, 1),
(1, '2021-07-11 20:55:28', NULL, 'Quitar parte de la chapa del techo y revestimiento interior', 5, NULL, 3, 2, 1, 1),
(1, '2021-07-11 21:08:50', NULL, 'Crear espacio en la pared para instalar un aire acondicionado frio/calor', 7, NULL, 3, 2, 1, 2),
(1, '2021-07-12 12:21:00', NULL, 'Fabricar y colocar 2 puertas de los gabinetes ', 9, NULL, 3, 8, 1, 2),
(1, '2021-07-12 12:31:01', NULL, 'Quitar del suelo las silla de la sala de espera', 10, NULL, 3, 9, 1, 2),
(1, '2021-07-15 16:48:56', NULL, 'Desarmar gazebos y verificar si necesitan mantenimiento', 11, NULL, 3, 9, 1, 2),
(1, '2021-07-16 16:51:43', NULL, 'Retirar malezas y restos de plantas de los canteros', 12, NULL, 3, 10, 1, 1),
(1, '2021-07-17 16:58:31', NULL, 'Verificar estado de las cañerias y destapar las que se encuentren en mal estado', 13, NULL, 3, 1, 1, 2),
(1, '2021-07-18 17:02:55', NULL, 'Quitar cortinas del escenario y quitar las butacas', 14, NULL, 3, 9, 1, 2),
(1, '2021-07-19 17:07:11', NULL, 'Verificar estado de los enchufes y si funcionan', 15, NULL, 3, 4, 1, 2),
(1, '2021-07-20 17:25:34', NULL, 'Quitar todo el reboque y las partes con humedad\r\n', 16, NULL, 3, 2, 1, 1),
(1, '2021-07-21 17:35:57', NULL, 'Quitar baldosas del acceso que esten en mal estado', 17, NULL, 3, 2, 1, 1),
(1, '2021-07-22 17:48:58', NULL, 'Revisar la conexion electrica del timbre', 18, NULL, 3, 4, 1, 3),
(1, '2021-07-23 17:53:57', NULL, 'Realizar tareas de restauracion de las ventanas', 19, NULL, 3, 7, 1, 2),
(1, '2021-07-24 17:56:38', NULL, 'Cortar el suministro del agua', 20, NULL, 3, 1, 1, 4),
(2, '2021-07-05 18:16:01', NULL, 'test tarea 2', 1, NULL, 3, 7, 2, 3),
(2, '2021-07-11 20:41:50', NULL, 'Revisar estado del revoque y humedad de la pared', 3, NULL, 3, 2, 1, 2),
(2, '2021-07-11 20:49:17', NULL, 'Repintar pared de la sala de rayos', 4, NULL, 3, 3, 1, 1),
(2, '2021-07-11 20:56:19', NULL, 'Cambiar y construir tirantes', 5, NULL, 3, 8, 1, 2),
(2, '2021-07-11 21:09:46', NULL, 'Instalar enchufe en la pared para conectar el a/c', 7, NULL, 3, 4, 1, 2),
(2, '2021-07-12 12:21:39', NULL, 'Cambiar cerradura de los gabinetes, se perdieron algunas llaves', 9, NULL, 3, 11, 1, 2),
(2, '2021-07-12 12:31:31', NULL, 'Colocar silla nuevas ', 10, NULL, 3, 2, 1, 2),
(2, '2021-07-15 16:49:38', NULL, 'Fabricar partes metalicas de los gazebos que esten en mal estado', 11, NULL, 3, 6, 1, 2),
(2, '2021-07-16 16:54:06', NULL, 'Reacondicionar la tierra de los canteros, mejorar estado', 12, NULL, 3, 10, 1, 1),
(2, '2021-07-17 16:59:16', NULL, 'Cambiar cañerias que esten rotas o no puedan ser reparadas', 13, NULL, 3, 1, 1, 2),
(2, '2021-07-18 17:03:25', NULL, 'Cambiar tablas rotas del escenario', 14, NULL, 3, 8, 1, 2),
(2, '2021-07-19 17:07:46', NULL, 'Agregar dos enchufes a cada sala', 15, NULL, 3, 4, 1, 2),
(2, '2021-07-20 17:30:35', NULL, 'Rebocar las paredes de la fachada', 16, NULL, 3, 2, 1, 1),
(2, '2021-07-21 17:36:19', NULL, 'Colocar las baldosas', 17, NULL, 3, 2, 1, 1),
(2, '2021-07-22 17:49:27', NULL, 'Cambiar timbre por uno nuevo', 18, NULL, 3, 4, 1, 3),
(2, '2021-07-23 17:54:18', NULL, 'Realizar tareas de restauracion del piso', 19, NULL, 3, 7, 1, 2),
(2, '2021-07-24 17:57:06', NULL, 'Quitar y colocar un nuevo inodoro', 20, NULL, 3, 1, 1, 3),
(3, '2021-07-11 20:42:39', NULL, 'Arreglar ventada de la cocina', 3, NULL, 3, 8, 1, 2),
(3, '2021-07-11 20:49:51', NULL, 'Reparar tomografo', 4, NULL, 3, 5, 1, 4),
(3, '2021-07-11 20:57:39', NULL, 'Colocar chapas y recubrir el interior', 5, NULL, 3, 2, 1, 2),
(3, '2021-07-11 21:10:26', NULL, 'Realizar la instalacion del aire acondicionado\r\n', 7, NULL, 3, 1, 1, 2),
(3, '2021-07-12 12:33:04', NULL, 'Cambiar ceramicos que se rompieron cuando se cambiaron las sillas', 10, NULL, 3, 2, 1, 2),
(3, '2021-07-15 16:50:24', NULL, 'Rearmar gazebos ', 11, NULL, 3, 9, 1, 2),
(3, '2021-07-16 16:54:58', NULL, 'Poner plantines de la temporada actual, de colores anaranjados.', 12, NULL, 3, 10, 1, 1),
(3, '2021-07-17 17:01:41', NULL, 'Revisar canillas y arreglar las que goteen o no funcionen', 13, NULL, 1, 1, 1, 2),
(3, '2021-07-18 17:03:50', NULL, 'Realizar limpieza de las cortinas', 14, NULL, 3, 7, 1, 2),
(3, '2021-07-19 17:31:15', NULL, 'Pintar todas las paredes', 16, NULL, 3, 3, 1, 1),
(3, '2021-07-20 17:54:57', NULL, 'Realizar limpieza de las cortinas', 19, NULL, 3, 9, 1, 2),
(4, '2021-07-11 20:43:48', NULL, 'Cambiar instalación electrica del baño.', 3, NULL, 3, 4, 1, 3),
(4, '2021-07-11 21:11:04', NULL, 'Realizar pruebas de funcionamiento del aire acondicionado', 7, NULL, 3, 9, 1, 2),
(4, '2021-07-18 17:05:35', NULL, 'CAmbiar tapizado de las butacas', 14, NULL, 3, 7, 1, 2),
(5, '2021-07-18 17:05:54', NULL, 'Rearmar el teatro', 14, NULL, 3, 9, 1, 2);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tiposordenesdecompra`
--

CREATE TABLE `tiposordenesdecompra` (
  `id` int(11) NOT NULL,
  `nombre` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `tiposordenesdecompra`
--

INSERT INTO `tiposordenesdecompra` (`id`, `nombre`) VALUES
(3, 'Aprobacion de Presupuesto'),
(2, 'Fondo Rotatorio'),
(1, 'Orden De Compra');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tipossector`
--

CREATE TABLE `tipossector` (
  `id` int(11) NOT NULL,
  `nombre` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `tipossector`
--

INSERT INTO `tipossector` (`id`, `nombre`) VALUES
(2, 'CASA COMUNITARIA'),
(3, 'CASA PARTICULAR'),
(1, 'HOSPITAL');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuarios`
--

CREATE TABLE `usuarios` (
  `id` int(11) NOT NULL,
  `nick` varchar(30) NOT NULL,
  `password` TEXT NOT NULL,
  `idPersona` int(11)  NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `usuarios`
--


INSERT INTO `usuarios` (`id`, `nick`, `password`, `idPersona`) VALUES
(1, 'admin', '$2y$10$xrWskYLI9rcMeVv6r5L42.bZJvhDdH1ENQE3ur6G9BtXVov6Ixyjm', 0),
(2, 'pitta1881', '$2y$10$owUf9dorMI6CFq2SoBQ.neR9OSf33IuJgH0xk7tAEskFJtHuZY1Yy', 11188169),
(3, 'mantenimiento', '$2y$10$HOvbqoVG0zfqCFplbTZpDusUE8DeCA8tLlgrQTKPU.H8iIDDrOZJW', 10548951);

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `agentes`
--
ALTER TABLE `agentes`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `idPersona` (`idPersona`);

--
-- Indices de la tabla `agentes_x_tareas`
--
ALTER TABLE `agentes_x_tareas`
  ADD PRIMARY KEY (`idTarea`,`idPedido`,`idAgente`),
  ADD KEY `idAgente` (`idAgente`);

--
-- Indices de la tabla `especializaciones`
--
ALTER TABLE `especializaciones`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `nombre` (`nombre`);

--
-- Indices de la tabla `especializaciones_x_agentes`
--
ALTER TABLE `especializaciones_x_agentes`
  ADD PRIMARY KEY (`idEspecializacion`,`idAgente`),
  ADD KEY `idAgente` (`idAgente`);

--
-- Indices de la tabla `estados`
--
ALTER TABLE `estados`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `nombre` (`nombre`);

--
-- Indices de la tabla `estadosordenesdecompra`
--
ALTER TABLE `estadosordenesdecompra`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `nombre` (`nombre`);

--
-- Indices de la tabla `estadospersona`
--
ALTER TABLE `estadospersona`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `nombre` (`nombre`);

--
-- Indices de la tabla `eventos`
--
ALTER TABLE `eventos`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `nombre` (`nombre`),
  ADD KEY `idEstado` (`idEstado`);

--
-- Indices de la tabla `historialinsumo`
--
ALTER TABLE `historialinsumo`
  ADD PRIMARY KEY (`id`,`idInsumo`),
  ADD KEY `idInsumo` (`idInsumo`),
  ADD KEY `idUsuario` (`idUsuario`),
  ADD KEY `idOC` (`idOC`),
  ADD KEY `idTarea` (`idTarea`,`idPedido`);

--
-- Indices de la tabla `historialpedido`
--
ALTER TABLE `historialpedido`
  ADD PRIMARY KEY (`id`,`idPedido`),
  ADD KEY `idPedido` (`idPedido`),
  ADD KEY `idUsuario` (`idUsuario`),
  ADD KEY `idEstado` (`idEstado`),
  ADD KEY `idSector` (`idSector`),
  ADD KEY `idPrioridad` (`idPrioridad`);

--
-- Indices de la tabla `historialtarea`
--
ALTER TABLE `historialtarea`
  ADD PRIMARY KEY (`id`,`idPedido`,`idTarea`),
  ADD KEY `idPedido` (`idPedido`,`idTarea`),
  ADD KEY `idUsuario` (`idUsuario`),
  ADD KEY `idEspecializacion` (`idEspecializacion`),
  ADD KEY `idEstado` (`idEstado`),
  ADD KEY `idPrioridad` (`idPrioridad`);

--
-- Indices de la tabla `insumos`
--
ALTER TABLE `insumos`
  ADD PRIMARY KEY (`id`),
  ADD KEY `idMedida` (`idMedida`);

--
-- Indices de la tabla `insumos_x_oc`
--
ALTER TABLE `insumos_x_oc`
  ADD PRIMARY KEY (`idInsumo`,`idOC`),
  ADD KEY `idOC` (`idOC`),
  ADD KEY `idEstado` (`idEstado`);

--
-- Indices de la tabla `insumos_x_tareas`
--
ALTER TABLE `insumos_x_tareas`
  ADD PRIMARY KEY (`idInsumo`,`idPedido`,`idTarea`),
  ADD KEY `idPedido` (`idPedido`,`idTarea`);

--
-- Indices de la tabla `medidas`
--
ALTER TABLE `medidas`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `nombre` (`nombre`);

--
-- Indices de la tabla `ordenesdecompra`
--
ALTER TABLE `ordenesdecompra`
  ADD PRIMARY KEY (`id`),
  ADD KEY `idEstadoOC` (`idEstadoOC`),
  ADD KEY `idUsuario` (`idUsuario`),
  ADD KEY `idTipoOrdenDeCompra` (`idTipoOrdenDeCompra`);

--
-- Indices de la tabla `ordenesdetrabajo`
--
ALTER TABLE `ordenesdetrabajo`
  ADD PRIMARY KEY (`id`),
  ADD KEY `idEstado` (`idEstado`),
  ADD KEY `idUsuario` (`idUsuario`);

--
-- Indices de la tabla `pedidos`
--
ALTER TABLE `pedidos`
  ADD PRIMARY KEY (`id`),
  ADD KEY `idUsuario` (`idUsuario`),
  ADD KEY `idEstado` (`idEstado`),
  ADD KEY `idSector` (`idSector`),
  ADD KEY `idPrioridad` (`idPrioridad`);

--
-- Indices de la tabla `permisos`
--
ALTER TABLE `permisos`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `nombre` (`nombre`);

--
-- Indices de la tabla `personas`
--
ALTER TABLE `personas`
 ADD PRIMARY KEY (`id`),
  ADD KEY `idEstadoPersona` (`idEstadoPersona`);

--
-- Indices de la tabla `prioridades`
--
ALTER TABLE `prioridades`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `nombre` (`nombre`);

--
-- Indices de la tabla `roles`
--
ALTER TABLE `roles`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `nombre` (`nombre`);

--
-- Indices de la tabla `roles_x_permisos`
--
ALTER TABLE `roles_x_permisos`
  ADD PRIMARY KEY (`idRol`,`idPermiso`),
  ADD KEY `idPermiso` (`idPermiso`);

--
-- Indices de la tabla `roles_x_usuarios`
--
ALTER TABLE `roles_x_usuarios`
  ADD PRIMARY KEY (`idRol`,`idUsuario`),
  ADD KEY `idUsuario` (`idUsuario`);

--
-- Indices de la tabla `sectores`
--
ALTER TABLE `sectores`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `nombre` (`nombre`),
  ADD KEY `idTipoSector` (`idTipoSector`);

--
-- Indices de la tabla `tareas`
--
ALTER TABLE `tareas`
  ADD PRIMARY KEY (`id`,`idPedido`),
  ADD KEY `idPedido` (`idPedido`),
  ADD KEY `idOrdenDeTrabajo` (`idOrdenDeTrabajo`),
  ADD KEY `idUsuario` (`idUsuario`),
  ADD KEY `idEspecializacion` (`idEspecializacion`),
  ADD KEY `idEstado` (`idEstado`),
  ADD KEY `idPrioridad` (`idPrioridad`);

--
-- Indices de la tabla `tiposordenesdecompra`
--
ALTER TABLE `tiposordenesdecompra`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `nombre` (`nombre`);

--
-- Indices de la tabla `tipossector`
--
ALTER TABLE `tipossector`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `nombre` (`nombre`);

--
-- Indices de la tabla `usuarios`
--
ALTER TABLE `usuarios`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `nick` (`nick`),
  ADD UNIQUE KEY `idPersona` (`idPersona`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `agentes`
--
ALTER TABLE `agentes`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT de la tabla `especializaciones`
--
ALTER TABLE `especializaciones`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT de la tabla `estados`
--
ALTER TABLE `estados`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT de la tabla `estadosordenesdecompra`
--
ALTER TABLE `estadosordenesdecompra`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT de la tabla `estadospersona`
--
ALTER TABLE `estadospersona`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT de la tabla `eventos`
--
ALTER TABLE `eventos`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT de la tabla `insumos`
--
ALTER TABLE `insumos`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=26;

--
-- AUTO_INCREMENT de la tabla `medidas`
--
ALTER TABLE `medidas`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT de la tabla `ordenesdecompra`
--
ALTER TABLE `ordenesdecompra`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT de la tabla `ordenesdetrabajo`
--
ALTER TABLE `ordenesdetrabajo`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT de la tabla `pedidos`
--
ALTER TABLE `pedidos`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- AUTO_INCREMENT de la tabla `permisos`
--
ALTER TABLE `permisos`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=54;

--
-- AUTO_INCREMENT de la tabla `prioridades`
--
ALTER TABLE `prioridades`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT de la tabla `roles`
--
ALTER TABLE `roles`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT de la tabla `sectores`
--
ALTER TABLE `sectores`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=46;

--
-- AUTO_INCREMENT de la tabla `tiposordenesdecompra`
--
ALTER TABLE `tiposordenesdecompra`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT de la tabla `tipossector`
--
ALTER TABLE `tipossector`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT de la tabla `usuarios`
--
ALTER TABLE `usuarios`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `agentes`
--
ALTER TABLE `agentes`
  ADD CONSTRAINT `agentes_ibfk_1` FOREIGN KEY (`idPersona`) REFERENCES `personas` (`id`);

--
-- Filtros para la tabla `agentes_x_tareas`
--
ALTER TABLE `agentes_x_tareas`
  ADD CONSTRAINT `agentes_x_tareas_ibfk_1` FOREIGN KEY (`idTarea`,`idPedido`) REFERENCES `tareas` (`id`, `idPedido`),
  ADD CONSTRAINT `agentes_x_tareas_ibfk_2` FOREIGN KEY (`idAgente`) REFERENCES `agentes` (`id`);

--
-- Filtros para la tabla `especializaciones_x_agentes`
--
ALTER TABLE `especializaciones_x_agentes`
  ADD CONSTRAINT `especializaciones_x_agentes_ibfk_1` FOREIGN KEY (`idEspecializacion`) REFERENCES `especializaciones` (`id`),
  ADD CONSTRAINT `especializaciones_x_agentes_ibfk_2` FOREIGN KEY (`idAgente`) REFERENCES `agentes` (`id`);

--
-- Filtros para la tabla `eventos`
--
ALTER TABLE `eventos`
  ADD CONSTRAINT `eventos_ibfk_1` FOREIGN KEY (`idEstado`) REFERENCES `estados` (`id`);

--
-- Filtros para la tabla `historialinsumo`
--
ALTER TABLE `historialinsumo`
  ADD CONSTRAINT `historialinsumo_ibfk_1` FOREIGN KEY (`idInsumo`) REFERENCES `insumos` (`id`),
  ADD CONSTRAINT `historialinsumo_ibfk_2` FOREIGN KEY (`idUsuario`) REFERENCES `usuarios` (`id`),
  ADD CONSTRAINT `historialinsumo_ibfk_3` FOREIGN KEY (`idOC`) REFERENCES `ordenesdecompra` (`id`),
  ADD CONSTRAINT `historialinsumo_ibfk_4` FOREIGN KEY (`idTarea`,`idPedido`) REFERENCES `tareas` (`id`, `idPedido`);

--
-- Filtros para la tabla `historialpedido`
--
ALTER TABLE `historialpedido`
  ADD CONSTRAINT `historialpedido_ibfk_1` FOREIGN KEY (`idPedido`) REFERENCES `pedidos` (`id`),
  ADD CONSTRAINT `historialpedido_ibfk_2` FOREIGN KEY (`idUsuario`) REFERENCES `usuarios` (`id`),
  ADD CONSTRAINT `historialpedido_ibfk_3` FOREIGN KEY (`idEstado`) REFERENCES `estados` (`id`),
  ADD CONSTRAINT `historialpedido_ibfk_4` FOREIGN KEY (`idSector`) REFERENCES `sectores` (`id`),
  ADD CONSTRAINT `historialpedido_ibfk_5` FOREIGN KEY (`idPrioridad`) REFERENCES `prioridades` (`id`);

--
-- Filtros para la tabla `historialtarea`
--
ALTER TABLE `historialtarea`
  ADD CONSTRAINT `historialtarea_ibfk_1` FOREIGN KEY (`idPedido`,`idTarea`) REFERENCES `tareas` (`idPedido`, `id`),
  ADD CONSTRAINT `historialtarea_ibfk_2` FOREIGN KEY (`idUsuario`) REFERENCES `usuarios` (`id`),
  ADD CONSTRAINT `historialtarea_ibfk_3` FOREIGN KEY (`idEspecializacion`) REFERENCES `especializaciones` (`id`),
  ADD CONSTRAINT `historialtarea_ibfk_4` FOREIGN KEY (`idEstado`) REFERENCES `estados` (`id`),
  ADD CONSTRAINT `historialtarea_ibfk_5` FOREIGN KEY (`idPrioridad`) REFERENCES `prioridades` (`id`);

--
-- Filtros para la tabla `insumos`
--
ALTER TABLE `insumos`
  ADD CONSTRAINT `insumos_ibfk_1` FOREIGN KEY (`idMedida`) REFERENCES `medidas` (`id`);

--
-- Filtros para la tabla `insumos_x_oc`
--
ALTER TABLE `insumos_x_oc`
  ADD CONSTRAINT `insumos_x_oc_ibfk_1` FOREIGN KEY (`idInsumo`) REFERENCES `insumos` (`id`),
  ADD CONSTRAINT `insumos_x_oc_ibfk_2` FOREIGN KEY (`idOC`) REFERENCES `ordenesdecompra` (`id`),
  ADD CONSTRAINT `insumos_x_oc_ibfk_3` FOREIGN KEY (`idEstado`) REFERENCES `estadosordenesdecompra` (`id`);

--
-- Filtros para la tabla `insumos_x_tareas`
--
ALTER TABLE `insumos_x_tareas`
  ADD CONSTRAINT `insumos_x_tareas_ibfk_1` FOREIGN KEY (`idInsumo`) REFERENCES `insumos` (`id`),
  ADD CONSTRAINT `insumos_x_tareas_ibfk_2` FOREIGN KEY (`idPedido`,`idTarea`) REFERENCES `tareas` (`idPedido`, `id`);

--
-- Filtros para la tabla `ordenesdecompra`
--
ALTER TABLE `ordenesdecompra`
  ADD CONSTRAINT `ordenesdecompra_ibfk_1` FOREIGN KEY (`idEstadoOC`) REFERENCES `estadosordenesdecompra` (`id`),
  ADD CONSTRAINT `ordenesdecompra_ibfk_2` FOREIGN KEY (`idUsuario`) REFERENCES `usuarios` (`id`),
  ADD CONSTRAINT `ordenesdecompra_ibfk_3` FOREIGN KEY (`idTipoOrdenDeCompra`) REFERENCES `tiposordenesdecompra` (`id`);

--
-- Filtros para la tabla `ordenesdetrabajo`
--
ALTER TABLE `ordenesdetrabajo`
  ADD CONSTRAINT `ordenesdetrabajo_ibfk_1` FOREIGN KEY (`idEstado`) REFERENCES `estados` (`id`),
  ADD CONSTRAINT `ordenesdetrabajo_ibfk_2` FOREIGN KEY (`idUsuario`) REFERENCES `usuarios` (`id`);

--
-- Filtros para la tabla `pedidos`
--
ALTER TABLE `pedidos`
  ADD CONSTRAINT `pedidos_ibfk_1` FOREIGN KEY (`idUsuario`) REFERENCES `usuarios` (`id`),
  ADD CONSTRAINT `pedidos_ibfk_2` FOREIGN KEY (`idEstado`) REFERENCES `estados` (`id`),
  ADD CONSTRAINT `pedidos_ibfk_3` FOREIGN KEY (`idSector`) REFERENCES `sectores` (`id`),
  ADD CONSTRAINT `pedidos_ibfk_4` FOREIGN KEY (`idPrioridad`) REFERENCES `prioridades` (`id`);

--
-- Filtros para la tabla `personas`
--
ALTER TABLE `personas`
  ADD CONSTRAINT `personas_ibfk_1` FOREIGN KEY (`idEstadoPersona`) REFERENCES `estadospersona` (`id`),
    ADD CONSTRAINT `personas_ibfk_2` FOREIGN KEY (`idDireccion`) REFERENCES `direccion` (`id`);
--
-- Filtros para la tabla `roles_x_permisos`
--
ALTER TABLE `roles_x_permisos`
  ADD CONSTRAINT `roles_x_permisos_ibfk_1` FOREIGN KEY (`idRol`) REFERENCES `roles` (`id`),
  ADD CONSTRAINT `roles_x_permisos_ibfk_2` FOREIGN KEY (`idPermiso`) REFERENCES `permisos` (`id`);

--
-- Filtros para la tabla `roles_x_usuarios`
--
ALTER TABLE `roles_x_usuarios`
  ADD CONSTRAINT `roles_x_usuarios_ibfk_1` FOREIGN KEY (`idRol`) REFERENCES `roles` (`id`),
  ADD CONSTRAINT `roles_x_usuarios_ibfk_2` FOREIGN KEY (`idUsuario`) REFERENCES `usuarios` (`id`);

--
-- Filtros para la tabla `sectores`
--
ALTER TABLE `sectores`
  ADD CONSTRAINT `sectores_ibfk_1` FOREIGN KEY (`idTipoSector`) REFERENCES `tipossector` (`id`);

--
-- Filtros para la tabla `tareas`
--
ALTER TABLE `tareas`
  ADD CONSTRAINT `tareas_ibfk_1` FOREIGN KEY (`idPedido`) REFERENCES `pedidos` (`id`),
  ADD CONSTRAINT `tareas_ibfk_2` FOREIGN KEY (`idOrdenDeTrabajo`) REFERENCES `ordenesdetrabajo` (`id`),
  ADD CONSTRAINT `tareas_ibfk_3` FOREIGN KEY (`idUsuario`) REFERENCES `usuarios` (`id`),
  ADD CONSTRAINT `tareas_ibfk_4` FOREIGN KEY (`idEspecializacion`) REFERENCES `especializaciones` (`id`),
  ADD CONSTRAINT `tareas_ibfk_5` FOREIGN KEY (`idEstado`) REFERENCES `estados` (`id`),
  ADD CONSTRAINT `tareas_ibfk_6` FOREIGN KEY (`idPrioridad`) REFERENCES `prioridades` (`id`);

--
-- Filtros para la tabla `usuarios`
--
ALTER TABLE `usuarios`
  ADD CONSTRAINT `usuarios_ibfk_1` FOREIGN KEY (`idPersona`) REFERENCES `personas` (`id`);

DELIMITER $$
--
-- Eventos
--
CREATE DEFINER=`root`@`localhost` EVENT `modificaPeriodicos` ON SCHEDULE EVERY 1 DAY STARTS '2021-03-31 23:59:00' ON COMPLETION NOT PRESERVE ENABLE DO UPDATE mantenimiento.eventos set eventos.idEstado = 3, eventos.fechaFin = (select DATE_ADD(eventos.fechaFin, 
INTERVAL eventos.periodicidad DAY)),eventos.fechaInicio = (select DATE_ADD(eventos.fechaInicio, INTERVAL eventos.periodicidad DAY)) 
where eventos.fechaFin =(SELECT curdate())$$

DELIMITER ;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

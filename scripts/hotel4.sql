-- phpMyAdmin SQL Dump
-- version 5.0.3
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 04-01-2021 a las 04:45:13
-- Versión del servidor: 10.4.14-MariaDB
-- Versión de PHP: 7.2.34

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `hotel3`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `agregado`
--

CREATE TABLE `agregado` (
  `id` int(11) NOT NULL,
  `descripcion` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
  `costo` double DEFAULT NULL,
  `id_tipo_moneda` int(11) DEFAULT NULL,
  `estado` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Volcado de datos para la tabla `agregado`
--

INSERT INTO `agregado` (`id`, `descripcion`, `costo`, `id_tipo_moneda`, `estado`) VALUES
(1, 'Camarote', 20, 13, 1),
(2, 'Cama', 20, 13, 1),
(3, 'Camarote', 23.2, 11, 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `categoria`
--

CREATE TABLE `categoria` (
  `id` int(11) NOT NULL,
  `nombre_categoria` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
  `estado_categoria` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Volcado de datos para la tabla `categoria`
--

INSERT INTO `categoria` (`id`, `nombre_categoria`, `estado_categoria`) VALUES
(7, '24 horas', 1),
(8, 'Fin de Semana', 1),
(9, 'Feriados', 1),
(10, 'Cat 90', 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `cliente`
--

CREATE TABLE `cliente` (
  `id` int(11) NOT NULL,
  `nombre` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `apellido_paterno` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `apellido_materno` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `id_tipo_documento` int(11) NOT NULL,
  `numero_documento` varchar(20) COLLATE utf8_unicode_ci NOT NULL,
  `celular_cliente` varchar(20) COLLATE utf8_unicode_ci NOT NULL,
  `correo_cliente` varchar(200) COLLATE utf8_unicode_ci NOT NULL,
  `estado_cliente` int(11) NOT NULL,
  `id_referido` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Volcado de datos para la tabla `cliente`
--

INSERT INTO `cliente` (`id`, `nombre`, `apellido_paterno`, `apellido_materno`, `id_tipo_documento`, `numero_documento`, `celular_cliente`, `correo_cliente`, `estado_cliente`, `id_referido`) VALUES
(1, 'Alexander', 'Valerio Cruz', 'as', 7, 'xxxx', '921816234', 'hola@ralexandervc.com', 1, 1),
(2, 'Carlos', 'Quispe', 'Evangelista', 7, '40235534', '980585775', 'carlos.quispe@gmail.com', 1, 1),
(3, 'Elizabeth', 'Morales', 'Cordova', 7, '16022166', '997188506', 'eli@gmail.com', 1, 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `estado_pago`
--

CREATE TABLE `estado_pago` (
  `id` int(11) NOT NULL,
  `descripcion` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
  `combo_opcion` int(11) DEFAULT NULL,
  `estado` int(11) DEFAULT NULL,
  `color` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Volcado de datos para la tabla `estado_pago`
--

INSERT INTO `estado_pago` (`id`, `descripcion`, `combo_opcion`, `estado`, `color`) VALUES
(1, 'Pendiente pago', 1, 1, NULL),
(2, 'Deposito - Falta aprobar', 0, 1, NULL),
(3, 'Deposito - Aprobado', 0, 1, NULL),
(4, 'Deposito', 1, 1, NULL),
(5, 'Pago Tarjeta', 1, 1, NULL),
(6, 'Saldo restante', 0, 1, NULL),
(7, 'Pago completado', 1, 1, NULL);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `feriado`
--

CREATE TABLE `feriado` (
  `id` int(11) NOT NULL,
  `nombre` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `fecha_inicio` date NOT NULL,
  `fecha_termino` date NOT NULL,
  `estado_feriado` int(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Volcado de datos para la tabla `feriado`
--

INSERT INTO `feriado` (`id`, `nombre`, `fecha_inicio`, `fecha_termino`, `estado_feriado`) VALUES
(1, 'Combate de Angamos', '2020-10-08', '2020-12-17', 1),
(2, 'Navidad', '2020-12-25', '2020-12-25', 1),
(3, 'Inmaculada Concepcion', '2020-12-08', '2020-12-08', 1),
(4, 'Dia de los Santos', '2020-11-01', '2020-11-01', 1),
(5, 'Año nuevo', '2019-12-31', '2020-01-01', 1),
(6, 'Navidad', '2020-12-30', '2020-12-31', 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `habitacion`
--

CREATE TABLE `habitacion` (
  `id` int(11) NOT NULL,
  `nombre_habitacion` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
  `detalles` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
  `id_categoria` int(11) DEFAULT NULL,
  `url_imagen` varchar(200) COLLATE utf8_unicode_ci DEFAULT NULL,
  `estado_habitacion` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Volcado de datos para la tabla `habitacion`
--

INSERT INTO `habitacion` (`id`, `nombre_habitacion`, `detalles`, `id_categoria`, `url_imagen`, `estado_habitacion`) VALUES
(3, 'Habitacion 101', 'Con agua caliente', 7, '200x200_x.png', 1),
(4, 'Habitacion 102', '#', 7, '188x135.png', 1),
(5, 'Habitacion 201', '201', 8, '280x280.png', 1),
(6, 'Habitacion 202', '202', 8, '540x700.png', 1),
(7, 'Habitacion 301', '301', 9, '500x500.png', 1),
(8, 'Habitacion 302', '302', 9, '476x476.png', 1),
(9, 'Hab 901', '-', 9, '280x200.png', 1),
(10, 'Hab Test 1', 'detalles', 10, '263x221.png', 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `modulo_usuario`
--

CREATE TABLE `modulo_usuario` (
  `id` int(11) NOT NULL,
  `nombre_modulo` varchar(200) COLLATE utf8_unicode_ci NOT NULL,
  `url_modulo` varchar(200) COLLATE utf8_unicode_ci NOT NULL,
  `icono_modulo` varchar(200) COLLATE utf8_unicode_ci NOT NULL,
  `modulo_padre` int(1) NOT NULL,
  `id_modulo_padre` int(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Volcado de datos para la tabla `modulo_usuario`
--

INSERT INTO `modulo_usuario` (`id`, `nombre_modulo`, `url_modulo`, `icono_modulo`, `modulo_padre`, `id_modulo_padre`) VALUES
(1, 'Reservas', '#', 'fas fa-calendar', 1, 0),
(5, 'Clientes', '?view=clientes', 'fas fa-user-friends', 1, 0),
(6, 'Feriados', '?view=feriados', 'fas fa-globe', 1, 0),
(7, 'Tipo de Documentos', '?view=documentos', 'icon ni ni-file-docs', 1, 0),
(8, 'Roles', '?view=roles', 'icon ni ni-ripple-old', 1, 0),
(9, 'Modulos', '?view=modulos', 'icon ni ni-megento', 1, 0),
(10, 'Usuarios', '?view=usuarios', 'icon ni ni-tile-thumb', 1, 0),
(11, 'Calendario', '?view=calendario', 'fas fa-calendar', 1, 0),
(12, 'Configuracion', '#', 'icon ni ni-setting', 1, 0),
(13, 'Tarifas', '?view=tarifas', 'icon ni ni-table-view', 0, 12),
(14, 'Categorias', '?view=categorias', 'icon ni ni-layer', 0, 12),
(15, 'Habitaciones', '?view=habitaciones', 'icon ni ni-view-grid', 0, 12),
(16, 'Nueva', '?view=reservas', 'icon ni ni-view-grid-fill', 0, 1),
(17, 'Reporte', '?view=reporte-reserva', 'icon ni ni-reports', 0, 1),
(18, 'Notificaciones', '?view=notificaciones', 'icon ni ni-notify', 0, 12),
(19, 'Tipo Moneda', '?view=tipo-moneda', 'icon ni ni-coins', 0, 12),
(20, 'Agregados', '?view=agregados', 'icon ni ni-grid-add-c', 0, 12),
(21, 'Promociones', '?view=promociones', 'icon ni ni-offer-fill', 0, 12),
(22, 'Seguridad', '?view=seguridad', 'icon ni ni-security', 1, 0);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `notificacion`
--

CREATE TABLE `notificacion` (
  `id` int(11) NOT NULL,
  `id_usuario` int(11) NOT NULL,
  `id_modulo` int(11) NOT NULL,
  `resumen` varchar(250) COLLATE utf8_unicode_ci NOT NULL,
  `fecha` datetime NOT NULL,
  `estado_notificacion` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Volcado de datos para la tabla `notificacion`
--

INSERT INTO `notificacion` (`id`, `id_usuario`, `id_modulo`, `resumen`, `fecha`, `estado_notificacion`) VALUES
(1, 1, 5, 'Cliente Actualizo informacion', '2020-12-27 23:55:40', 0),
(2, 1, 5, 'Cliente de dio de Alta', '2020-12-28 00:03:54', 0),
(3, 1, 8, 'Rol Actualizo informacion', '2020-12-28 01:40:30', 0),
(4, 1, 9, 'Modulo Actualizo informacion', '2020-12-28 01:40:45', 0),
(5, 1, 5, 'Cliente Actualizo informacion', '2020-12-28 01:42:30', 0),
(6, 2, 5, 'Cliente Actualizo informacion', '2020-12-28 01:42:30', 0),
(7, 1, 16, 'Reserva se dio de Alta', '2020-12-28 02:27:48', 0),
(8, 3, 6, 'Feriado se dio de Alta', '2020-12-28 02:29:21', 0),
(9, 1, 5, 'Cliente se dio de Alta', '2020-12-29 01:57:20', 0),
(10, 2, 5, 'Cliente se dio de Alta', '2020-12-29 01:57:20', 0),
(11, 3, 5, 'Cliente se dio de Alta', '2020-12-29 01:57:20', 0),
(12, 1, 5, 'Cliente se dio de Alta', '2020-12-29 01:57:33', 0),
(13, 2, 5, 'Cliente se dio de Alta', '2020-12-29 01:57:34', 0),
(14, 3, 5, 'Cliente se dio de Alta', '2020-12-29 01:57:34', 0),
(15, 1, 5, 'Cliente se dio de Alta', '2020-12-29 01:59:16', 0),
(16, 2, 5, 'Cliente se dio de Alta', '2020-12-29 01:59:16', 0),
(17, 3, 5, 'Cliente se dio de Alta', '2020-12-29 01:59:16', 0),
(18, 1, 5, 'Cliente se dio de Alta', '2020-12-29 01:59:33', 0),
(19, 2, 5, 'Cliente se dio de Alta', '2020-12-29 01:59:33', 0),
(20, 3, 5, 'Cliente se dio de Alta', '2020-12-29 01:59:33', 0),
(21, 1, 5, 'Cliente Actualizo informacion', '2020-12-29 02:01:00', 0),
(22, 2, 5, 'Cliente Actualizo informacion', '2020-12-29 02:01:00', 0),
(23, 3, 5, 'Cliente Actualizo informacion', '2020-12-29 02:01:00', 0),
(24, 1, 5, 'Cliente Actualizo informacion', '2020-12-29 02:01:12', 0),
(25, 2, 5, 'Cliente Actualizo informacion', '2020-12-29 02:01:12', 0),
(26, 3, 5, 'Cliente Actualizo informacion', '2020-12-29 02:01:12', 0),
(27, 1, 5, 'Cliente Actualizo informacion', '2020-12-29 02:01:18', 0),
(28, 2, 5, 'Cliente Actualizo informacion', '2020-12-29 02:01:18', 0),
(29, 3, 5, 'Cliente Actualizo informacion', '2020-12-29 02:01:18', 0),
(30, 1, 15, 'Habitacion Actualo Informacion', '2020-12-29 03:13:20', 0),
(31, 1, 15, 'Habitacion Actualizo Informacion', '2020-12-29 03:18:10', 0),
(32, 1, 15, 'Habitacion Actualizo Informacion', '2020-12-29 03:18:17', 0),
(33, 1, 15, 'Habitacion Actualizo Informacion', '2020-12-29 03:19:30', 0),
(34, 1, 15, 'Habitacion Actualizo Informacion', '2020-12-29 03:19:53', 0),
(35, 1, 15, 'Habitacion Actualizo Informacion', '2020-12-29 03:21:08', 0),
(36, 1, 15, 'Habitacion Actualizo Informacion', '2020-12-29 03:21:19', 0),
(37, 1, 15, 'Habitacion Actualizo Informacion', '2020-12-29 03:22:06', 0),
(38, 1, 9, 'Modulo se dio de Alta', '2020-12-29 23:06:00', 0),
(39, 1, 9, 'Modulo Actualizo informacion', '2020-12-29 23:06:26', 0),
(40, 1, 9, 'Modulo Actualizo informacion', '2020-12-29 23:10:07', 0),
(41, 1, 9, 'Modulo Actualizo informacion', '2021-01-03 18:31:54', 0),
(42, 1, 9, 'Modulo Actualizo informacion', '2021-01-03 22:10:33', 0),
(43, 1, 9, 'Modulo Actualizo informacion', '2021-01-03 22:10:45', 0);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `promociones`
--

CREATE TABLE `promociones` (
  `id` int(11) NOT NULL,
  `descripcion` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
  `costo` double DEFAULT NULL,
  `id_tipo_moneda` int(11) DEFAULT NULL,
  `dias_minimo` int(11) DEFAULT NULL,
  `estado` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Volcado de datos para la tabla `promociones`
--

INSERT INTO `promociones` (`id`, `descripcion`, `costo`, `id_tipo_moneda`, `dias_minimo`, `estado`) VALUES
(1, 'Promoción Verano', 450, 13, 5, 1),
(2, 'Familia', 4000, 13, 10, 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `referido`
--

CREATE TABLE `referido` (
  `id` int(11) NOT NULL,
  `nombre` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Volcado de datos para la tabla `referido`
--

INSERT INTO `referido` (`id`, `nombre`) VALUES
(1, 'Ninguno'),
(2, 'Facebook');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `reserva`
--

CREATE TABLE `reserva` (
  `id` int(11) NOT NULL,
  `id_cliente` int(11) DEFAULT NULL,
  `observacion` varchar(120) COLLATE utf8_unicode_ci DEFAULT NULL,
  `id_referido` int(11) DEFAULT NULL,
  `fecha_ingreso` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
  `fecha_salida` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
  `hora_ingreso` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
  `hora_salida` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
  `id_usuario` int(11) DEFAULT NULL,
  `id_habitacion` int(11) DEFAULT NULL,
  `id_estado_pago` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Volcado de datos para la tabla `reserva`
--

INSERT INTO `reserva` (`id`, `id_cliente`, `observacion`, `id_referido`, `fecha_ingreso`, `fecha_salida`, `hora_ingreso`, `hora_salida`, `id_usuario`, `id_habitacion`, `id_estado_pago`) VALUES
(1, 1, 'Son 5 personas', 1, '01/12/2020', '05/12/2020', '11:00 AM', '11:30 AM', 1, 3, 1),
(2, 2, 'Esta solo', 1, '05/12/2020', '07/12/2020', '12:00 PM', '12:00 PM', 1, 4, 1),
(3, 3, 'de pasada', 1, '01/12/2020', '03/12/2020', '01:30 AM', '01:30 AM', 1, 5, 1),
(4, 2, '', 1, '28/12/2020', '30/12/2020', '12:00 AM', '12:30 AM', 3, 3, 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `rol`
--

CREATE TABLE `rol` (
  `id` int(11) NOT NULL,
  `nombre_rol` varchar(200) COLLATE utf8_unicode_ci NOT NULL,
  `estado_rol` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Volcado de datos para la tabla `rol`
--

INSERT INTO `rol` (`id`, `nombre_rol`, `estado_rol`) VALUES
(1, 'Administrador', 1),
(2, 'Vendedor', 1),
(3, 'Contabilidad', 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `rol_modulo`
--

CREATE TABLE `rol_modulo` (
  `id_rol` int(11) NOT NULL,
  `id_modulo_usuario` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Volcado de datos para la tabla `rol_modulo`
--

INSERT INTO `rol_modulo` (`id_rol`, `id_modulo_usuario`) VALUES
(0, 1),
(0, 6),
(0, 8),
(0, 10),
(0, 6),
(0, 8),
(0, 6),
(0, 8),
(0, 5),
(0, 7),
(0, 5),
(0, 7),
(0, 5),
(0, 7),
(1, 1),
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
(2, 1),
(2, 5),
(2, 13),
(2, 16),
(2, 22),
(3, 12),
(3, 19),
(3, 22);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tarifa`
--

CREATE TABLE `tarifa` (
  `id` int(11) NOT NULL,
  `nombre_tarifa` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
  `precio_minimo` double DEFAULT NULL,
  `precio_base` double DEFAULT NULL,
  `estado_tarifa` int(11) DEFAULT NULL,
  `recargo_feriado` double DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Volcado de datos para la tabla `tarifa`
--

INSERT INTO `tarifa` (`id`, `nombre_tarifa`, `precio_minimo`, `precio_base`, `estado_tarifa`, `recargo_feriado`) VALUES
(6, 'Reserva 24 horas', 25.2, 10, 1, 10);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tipo_documento`
--

CREATE TABLE `tipo_documento` (
  `id` int(11) NOT NULL,
  `nombre_documento` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `estado_documento` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Volcado de datos para la tabla `tipo_documento`
--

INSERT INTO `tipo_documento` (`id`, `nombre_documento`, `estado_documento`) VALUES
(2, 'Pasaporte', 1),
(3, 'Carnet de Extranjeria', 1),
(7, 'DNI', 1),
(8, 'xxx', 0);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tipo_moneda`
--

CREATE TABLE `tipo_moneda` (
  `id` int(11) NOT NULL,
  `simbolo` varchar(20) COLLATE utf8_unicode_ci DEFAULT NULL,
  `cambio` double DEFAULT NULL,
  `estado` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Volcado de datos para la tabla `tipo_moneda`
--

INSERT INTO `tipo_moneda` (`id`, `simbolo`, `cambio`, `estado`) VALUES
(11, '$', 4, 1),
(13, 'S/ ', 1, 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuario`
--

CREATE TABLE `usuario` (
  `id` int(11) NOT NULL,
  `nombre` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `apellido_paterno` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `apellido_materno` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `id_tipo_documento` int(11) NOT NULL,
  `numero_documento` varchar(20) COLLATE utf8_unicode_ci NOT NULL,
  `correo_usuario` varchar(200) COLLATE utf8_unicode_ci NOT NULL,
  `estado_usuario` int(11) NOT NULL,
  `eliminar_usuario` int(11) NOT NULL,
  `usuario` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `password` varchar(250) COLLATE utf8_unicode_ci NOT NULL,
  `id_rol` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Volcado de datos para la tabla `usuario`
--

INSERT INTO `usuario` (`id`, `nombre`, `apellido_paterno`, `apellido_materno`, `id_tipo_documento`, `numero_documento`, `correo_usuario`, `estado_usuario`, `eliminar_usuario`, `usuario`, `password`, `id_rol`) VALUES
(1, 'Administrador', 'Sistema', 'Hotelero', 7, '00000000', 'hoteles@creamos-marca.com', 1, 0, 'admin', '90b9aa7e25f80cf4f64e990b78a9fc5ebd6cecad', 1),
(2, 'Admin', 'Clientes', 'Hotel', 7, '00000000', 'admin.clientes@gmail.com', 1, 0, 'admin.clientes', '10470c3b4b1fed12c3baac014be15fac67c6e815', 2),
(3, 'Alexander', 'Valerio', 'Cruz', 7, '76143032', 'ralexandervc@gmail.com', 1, 0, 'alexander', '5139fcb743565a93ba49568086a3376794cbc101', 2),
(4, 'Admin', 'Contabilidad', '-', 7, '111111', 'admin.contabilidad@creamos-marca.com', 1, 0, 'admin.contabilidad', '10470c3b4b1fed12c3baac014be15fac67c6e815', 3);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuario_modulo`
--

CREATE TABLE `usuario_modulo` (
  `id_usuario` int(11) NOT NULL,
  `id_modulo_usuario` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Volcado de datos para la tabla `usuario_modulo`
--

INSERT INTO `usuario_modulo` (`id_usuario`, `id_modulo_usuario`) VALUES
(2, 5),
(2, 12),
(2, 18),
(0, 18),
(3, 1),
(3, 5),
(3, 6),
(3, 11),
(3, 12),
(3, 13),
(3, 14),
(3, 16),
(3, 17),
(3, 18),
(1, 1),
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
(1, 21);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuario_notificacion`
--

CREATE TABLE `usuario_notificacion` (
  `id_usuario` int(11) NOT NULL,
  `id_modulo_usuario` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Volcado de datos para la tabla `usuario_notificacion`
--

INSERT INTO `usuario_notificacion` (`id_usuario`, `id_modulo_usuario`) VALUES
(2, 5),
(2, 18),
(3, 16),
(3, 17),
(3, 5),
(3, 6),
(3, 11),
(3, 13),
(3, 14),
(3, 18),
(1, 16),
(1, 5),
(1, 7),
(1, 8),
(1, 9),
(1, 13),
(1, 15),
(1, 18);

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `agregado`
--
ALTER TABLE `agregado`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_tipo_moneda` (`id_tipo_moneda`);

--
-- Indices de la tabla `categoria`
--
ALTER TABLE `categoria`
  ADD PRIMARY KEY (`id`),
  ADD KEY `estado_categoria` (`estado_categoria`);

--
-- Indices de la tabla `cliente`
--
ALTER TABLE `cliente`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_tipo_documento` (`id_tipo_documento`),
  ADD KEY `estado_cliente` (`estado_cliente`),
  ADD KEY `id_referido` (`id_referido`);

--
-- Indices de la tabla `estado_pago`
--
ALTER TABLE `estado_pago`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `feriado`
--
ALTER TABLE `feriado`
  ADD PRIMARY KEY (`id`),
  ADD KEY `estado_feriado` (`estado_feriado`);

--
-- Indices de la tabla `habitacion`
--
ALTER TABLE `habitacion`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_categoria` (`id_categoria`),
  ADD KEY `estado_habitacion` (`estado_habitacion`);

--
-- Indices de la tabla `modulo_usuario`
--
ALTER TABLE `modulo_usuario`
  ADD PRIMARY KEY (`id`),
  ADD KEY `modulo_padre` (`modulo_padre`),
  ADD KEY `id_modulo_padre` (`id_modulo_padre`);

--
-- Indices de la tabla `notificacion`
--
ALTER TABLE `notificacion`
  ADD UNIQUE KEY `id` (`id`),
  ADD KEY `id_modulo` (`id_modulo`),
  ADD KEY `id_usuario` (`id_usuario`),
  ADD KEY `estado_notificacion` (`estado_notificacion`);

--
-- Indices de la tabla `promociones`
--
ALTER TABLE `promociones`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_tipo_moneda` (`id_tipo_moneda`);

--
-- Indices de la tabla `referido`
--
ALTER TABLE `referido`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `reserva`
--
ALTER TABLE `reserva`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_cliente` (`id_cliente`),
  ADD KEY `id_usuario` (`id_usuario`),
  ADD KEY `id_habitacion` (`id_habitacion`),
  ADD KEY `id_estado_pago` (`id_estado_pago`);

--
-- Indices de la tabla `rol`
--
ALTER TABLE `rol`
  ADD PRIMARY KEY (`id`),
  ADD KEY `estado_rol` (`estado_rol`);

--
-- Indices de la tabla `tarifa`
--
ALTER TABLE `tarifa`
  ADD PRIMARY KEY (`id`),
  ADD KEY `estado_tarifa` (`estado_tarifa`);

--
-- Indices de la tabla `tipo_documento`
--
ALTER TABLE `tipo_documento`
  ADD PRIMARY KEY (`id`),
  ADD KEY `estado_documento` (`estado_documento`);

--
-- Indices de la tabla `tipo_moneda`
--
ALTER TABLE `tipo_moneda`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `usuario`
--
ALTER TABLE `usuario`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_tipo_documento` (`id_tipo_documento`),
  ADD KEY `estado_usuario` (`estado_usuario`),
  ADD KEY `id_rol` (`id_rol`);

--
-- Indices de la tabla `usuario_modulo`
--
ALTER TABLE `usuario_modulo`
  ADD KEY `id_usuario` (`id_usuario`),
  ADD KEY `id_modulo_usuario` (`id_modulo_usuario`);

--
-- Indices de la tabla `usuario_notificacion`
--
ALTER TABLE `usuario_notificacion`
  ADD KEY `id_usuario` (`id_usuario`),
  ADD KEY `id_modulo_usuario` (`id_modulo_usuario`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `agregado`
--
ALTER TABLE `agregado`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT de la tabla `categoria`
--
ALTER TABLE `categoria`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT de la tabla `cliente`
--
ALTER TABLE `cliente`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=37;

--
-- AUTO_INCREMENT de la tabla `estado_pago`
--
ALTER TABLE `estado_pago`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT de la tabla `feriado`
--
ALTER TABLE `feriado`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT de la tabla `habitacion`
--
ALTER TABLE `habitacion`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT de la tabla `modulo_usuario`
--
ALTER TABLE `modulo_usuario`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=23;

--
-- AUTO_INCREMENT de la tabla `notificacion`
--
ALTER TABLE `notificacion`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=44;

--
-- AUTO_INCREMENT de la tabla `promociones`
--
ALTER TABLE `promociones`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT de la tabla `referido`
--
ALTER TABLE `referido`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT de la tabla `reserva`
--
ALTER TABLE `reserva`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT de la tabla `rol`
--
ALTER TABLE `rol`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT de la tabla `tarifa`
--
ALTER TABLE `tarifa`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT de la tabla `tipo_documento`
--
ALTER TABLE `tipo_documento`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT de la tabla `tipo_moneda`
--
ALTER TABLE `tipo_moneda`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT de la tabla `usuario`
--
ALTER TABLE `usuario`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `agregado`
--
ALTER TABLE `agregado`
  ADD CONSTRAINT `agregado_ibfk_1` FOREIGN KEY (`id_tipo_moneda`) REFERENCES `tipo_moneda` (`id`);

--
-- Filtros para la tabla `habitacion`
--
ALTER TABLE `habitacion`
  ADD CONSTRAINT `habitacion_ibfk_1` FOREIGN KEY (`id_categoria`) REFERENCES `categoria` (`id`);

--
-- Filtros para la tabla `promociones`
--
ALTER TABLE `promociones`
  ADD CONSTRAINT `promociones_ibfk_1` FOREIGN KEY (`id_tipo_moneda`) REFERENCES `tipo_moneda` (`id`);

--
-- Filtros para la tabla `reserva`
--
ALTER TABLE `reserva`
  ADD CONSTRAINT `reserva_ibfk_1` FOREIGN KEY (`id_cliente`) REFERENCES `cliente` (`id`),
  ADD CONSTRAINT `reserva_ibfk_2` FOREIGN KEY (`id_usuario`) REFERENCES `usuario` (`id`),
  ADD CONSTRAINT `reserva_ibfk_3` FOREIGN KEY (`id_habitacion`) REFERENCES `habitacion` (`id`),
  ADD CONSTRAINT `reserva_ibfk_4` FOREIGN KEY (`id_estado_pago`) REFERENCES `estado_pago` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

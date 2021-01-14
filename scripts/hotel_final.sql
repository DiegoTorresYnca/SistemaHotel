-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3306
-- Generation Time: Jan 12, 2021 at 03:53 AM
-- Server version: 5.7.31
-- PHP Version: 7.2.33

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `hotel_s5`
--

DELIMITER $$
--
-- Procedures
--
DROP PROCEDURE IF EXISTS `insertReserva`$$
CREATE PROCEDURE `insertReserva` (IN `id_cliente` INT, IN `observacion` VARCHAR(120), IN `id_referido` INT, `fecha_ingreso` VARCHAR(100), IN `fecha_salida` VARCHAR(100), `hora_ingreso` VARCHAR(100), IN `hora_salida` VARCHAR(100), IN `id_usuario` INT, IN `id_habitacion` INT, IN `id_estado_pago` INT)  BEGIN
	insert into reserva(id_cliente, observacion, id_referido, fecha_ingreso, fecha_salida, hora_ingreso, hora_salida, id_usuario, id_habitacion, id_estado_pago) values (id_cliente, observacion, id_referido, fecha_ingreso, fecha_salida, hora_ingreso, hora_salida, id_usuario, id_habitacion, id_estado_pago);
	update habitacion set estado_reserva=1 where id=id_habitacion;
END$$

DELIMITER ;

-- --------------------------------------------------------

--
-- Table structure for table `agregado`
--

DROP TABLE IF EXISTS `agregado`;
CREATE TABLE IF NOT EXISTS `agregado` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `descripcion` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
  `costo` double DEFAULT NULL,
  `id_tipo_moneda` int(11) DEFAULT NULL,
  `estado` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `id_tipo_moneda` (`id_tipo_moneda`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `agregado`
--

INSERT INTO `agregado` (`id`, `descripcion`, `costo`, `id_tipo_moneda`, `estado`) VALUES
(1, 'Camarote', 20, 13, 1),
(2, 'Cama', 20, 13, 1),
(3, 'Camarote', 23.2, 11, 1);

-- --------------------------------------------------------

--
-- Table structure for table `caja`
--

DROP TABLE IF EXISTS `caja`;
CREATE TABLE IF NOT EXISTS `caja` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `fecha_apertura` datetime DEFAULT NULL,
  `fecha_cierre` datetime DEFAULT NULL,
  `monto_apertura` double DEFAULT NULL,
  `monto_cierre` double DEFAULT NULL,
  `id_usuario` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `id_usuario` (`id_usuario`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `categoria`
--

DROP TABLE IF EXISTS `categoria`;
CREATE TABLE IF NOT EXISTS `categoria` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nombre_categoria` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
  `estado_categoria` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `estado_categoria` (`estado_categoria`)
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `categoria`
--

INSERT INTO `categoria` (`id`, `nombre_categoria`, `estado_categoria`) VALUES
(7, '24 horas', 1),
(8, 'Fin de Semana', 1),
(9, 'Feriados', 1),
(10, 'Cat 90', 1);

-- --------------------------------------------------------

--
-- Table structure for table `cliente`
--

DROP TABLE IF EXISTS `cliente`;
CREATE TABLE IF NOT EXISTS `cliente` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nombre` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `apellido_paterno` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `apellido_materno` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `id_tipo_documento` int(11) NOT NULL,
  `numero_documento` varchar(20) COLLATE utf8_unicode_ci NOT NULL,
  `celular_cliente` varchar(20) COLLATE utf8_unicode_ci NOT NULL,
  `correo_cliente` varchar(200) COLLATE utf8_unicode_ci NOT NULL,
  `estado_cliente` int(11) NOT NULL,
  `id_referido` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `id_tipo_documento` (`id_tipo_documento`),
  KEY `estado_cliente` (`estado_cliente`),
  KEY `id_referido` (`id_referido`)
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `cliente`
--

INSERT INTO `cliente` (`id`, `nombre`, `apellido_paterno`, `apellido_materno`, `id_tipo_documento`, `numero_documento`, `celular_cliente`, `correo_cliente`, `estado_cliente`, `id_referido`) VALUES
(1, 'Alexander', 'Valerio Cruz', 'as', 7, 'xxxx', '921816234', 'hola@ralexandervc.com', 1, 1),
(2, 'Carlos', 'Quispe', 'Evangelista', 7, '40235534', '980585775', 'carlos.quispe@gmail.com', 1, 1),
(3, 'MARIA', 'ARNAO', 'SANCHEZ', 7, '15957848', '78459657', 'eli@gmail.com', 1, 1),
(4, 'MAGALY BLANCA', 'BARJA', 'MARTINEZ', 7, '43002040', '00000000', 'magaly@gmail.com', 1, 0),
(5, 'JOEL ADRIAN', 'ZAVALA', 'RAMIREZ', 7, '47256984', '55', '5555@aaa.aaa', 1, 0),
(6, 'ESTRELLA XIOMARA', 'DIAZ', 'PALACIOS', 7, '78945624', 'xxx', 'xxxx@xxx.xx', 1, 0),
(7, 'QUISPE EVANGELISTA CARLOS ENRIQUE', 'x', 's', 8, '10402355340', 'sss', 'sss@sss.sss', 1, 0),
(8, 'ADA ELIZABETH', 'MORALES', 'CORDOVA', 7, '16022166', '2', 'aa@aaaa.ddd', 1, 1);

-- --------------------------------------------------------

--
-- Table structure for table `estado_pago`
--

DROP TABLE IF EXISTS `estado_pago`;
CREATE TABLE IF NOT EXISTS `estado_pago` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `descripcion` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
  `combo_opcion` int(11) DEFAULT NULL,
  `estado` int(11) DEFAULT NULL,
  `color` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `estado_pago`
--

INSERT INTO `estado_pago` (`id`, `descripcion`, `combo_opcion`, `estado`, `color`) VALUES
(1, 'Pendiente pago', 1, 1, '#e70808'),
(2, 'Deposito - Falta aprobar', 0, 1, '#cb5fd3'),
(3, 'Deposito - Aprobado', 0, 1, '#1fc165'),
(4, 'Deposito', 1, 1, '#dd7c31'),
(5, 'Pago Tarjeta', 1, 1, '#141be6'),
(6, 'Saldo restante', 0, 1, '#3cddb4'),
(7, 'Pago completado', 1, 1, '#2bd115'),
(8, 'Pago efectivo', 1, 1, '#b07b07');

-- --------------------------------------------------------

--
-- Table structure for table `feriado`
--

DROP TABLE IF EXISTS `feriado`;
CREATE TABLE IF NOT EXISTS `feriado` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nombre` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `fecha_inicio` date NOT NULL,
  `fecha_termino` date NOT NULL,
  `estado_feriado` int(1) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `estado_feriado` (`estado_feriado`)
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `feriado`
--

INSERT INTO `feriado` (`id`, `nombre`, `fecha_inicio`, `fecha_termino`, `estado_feriado`) VALUES
(7, 'Combate de Angamos', '2021-10-08', '2021-10-08', 1),
(8, 'Melchorita', '2021-01-06', '2021-01-06', 1);

-- --------------------------------------------------------

--
-- Table structure for table `habitacion`
--

DROP TABLE IF EXISTS `habitacion`;
CREATE TABLE IF NOT EXISTS `habitacion` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nombre_habitacion` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
  `detalles` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
  `id_categoria` int(11) DEFAULT NULL,
  `url_imagen` varchar(200) COLLATE utf8_unicode_ci DEFAULT NULL,
  `estado_habitacion` int(11) DEFAULT NULL,
  `estado_reserva` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `id_categoria` (`id_categoria`),
  KEY `estado_habitacion` (`estado_habitacion`)
) ENGINE=InnoDB AUTO_INCREMENT=30 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `habitacion`
--

INSERT INTO `habitacion` (`id`, `nombre_habitacion`, `detalles`, `id_categoria`, `url_imagen`, `estado_habitacion`, `estado_reserva`) VALUES
(1, '101', 'Con baÃ±o', 7, '', 1, 0),
(2, '102', 'detalles', 10, '263x221.png', 1, 1),
(3, '201', 'Con agua caliente', 7, 'nube.gif', 1, 0),
(4, '202', '#', 7, '188x135.png', 1, 0),
(5, '203', '201', 8, '280x280.png', 1, 0),
(6, '204', '202', 8, '540x700.png', 1, 0),
(7, '205', '301', 9, '500x500.png', 1, 0),
(8, '206', '302', 9, '476x476.png', 1, 0),
(9, '207', '-', 9, '280x200.png', 1, 0),
(10, '208', 'Prueba', 7, '', 1, 1),
(11, '301', 'Prueba', 7, '', 1, 0),
(12, '302', '-', 7, '', 1, 0),
(13, '303', '-', 7, '', 1, 0),
(14, '304', '-', 7, '', 1, 0),
(15, '305', '-', 7, '', 1, 0),
(16, '306', '-', 7, '', 1, 1),
(17, '307', '-', 7, '', 1, 0),
(18, '308', '-', 7, '', 1, 1),
(19, '401', '-', 7, '', 1, 0),
(20, '402', '-', 7, '', 1, 0),
(21, '403', '-', 7, '', 1, 0),
(22, '404', '-', 7, '', 1, 0),
(23, '405', '-', 7, '', 1, 0),
(24, '406', '-', 7, '', 1, 0),
(25, '407', '-', 7, '', 1, 0),
(26, '408', '-', 7, '', 1, 0),
(27, '501', '-', 7, '', 1, 0),
(28, '502', '-', 7, '', 1, 0),
(29, '503', '-', 7, '', 1, 0);

-- --------------------------------------------------------

--
-- Table structure for table `modulo_usuario`
--

DROP TABLE IF EXISTS `modulo_usuario`;
CREATE TABLE IF NOT EXISTS `modulo_usuario` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nombre_modulo` varchar(200) COLLATE utf8_unicode_ci NOT NULL,
  `url_modulo` varchar(200) COLLATE utf8_unicode_ci NOT NULL,
  `icono_modulo` varchar(200) COLLATE utf8_unicode_ci NOT NULL,
  `modulo_padre` int(1) NOT NULL,
  `id_modulo_padre` int(1) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `modulo_padre` (`modulo_padre`),
  KEY `id_modulo_padre` (`id_modulo_padre`)
) ENGINE=InnoDB AUTO_INCREMENT=32 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `modulo_usuario`
--

INSERT INTO `modulo_usuario` (`id`, `nombre_modulo`, `url_modulo`, `icono_modulo`, `modulo_padre`, `id_modulo_padre`) VALUES
(1, 'Dashboard', '?view=dashboard', 'icon ni ni-dashlite', 1, 0),
(2, 'Reservas', '?view=reservas', 'fas fa-calendar', 1, 0),
(3, 'Recepcion', '?view=recepcion', 'icon ni ni-building-fill', 1, 0),
(5, 'Clientes', '?view=clientes', 'fas fa-user-friends', 1, 0),
(6, 'Feriados', '?view=feriados', 'fas fa-globe', 0, 12),
(7, 'Tipo de Documentos', '?view=documentos', 'icon ni ni-file-docs', 0, 12),
(8, 'Roles', '?view=roles', 'icon ni ni-ripple-old', 0, 12),
(9, 'Modulos', '?view=modulos', 'icon ni ni-megento', 0, 12),
(10, 'Usuarios', '?view=usuarios', 'icon ni ni-tile-thumb', 0, 12),
(11, 'Calendario', '?view=calendario', 'fas fa-calendar', 1, 0),
(12, 'Configuracion', '#', 'icon ni ni-setting', 1, 0),
(13, 'Tarifas', '?view=tarifas', 'icon ni ni-table-view', 0, 12),
(14, 'Categorias', '?view=categorias', 'icon ni ni-layer', 0, 12),
(15, 'Habitaciones', '?view=habitaciones', 'icon ni ni-view-grid', 0, 12),
(17, 'Mis reservas', '?view=reporte-reserva', 'icon ni ni-reports', 0, 27),
(18, 'Notificaciones', '?view=notificaciones', 'icon ni ni-notify', 0, 12),
(19, 'Tipo Moneda', '?view=tipo-moneda', 'icon ni ni-coins', 0, 12),
(20, 'Agregados', '?view=agregados', 'icon ni ni-grid-add-c', 0, 12),
(21, 'Promociones', '?view=promociones', 'icon ni ni-offer-fill', 0, 12),
(22, 'Seguridad', '?view=seguridad', 'icon ni ni-security', 0, 12),
(24, 'Mi Caja', '?view=caja', 'icon ni ni-coins', 1, 0),
(27, 'Reportes', '#', 'icon ni ni-reports', 1, 0),
(28, 'Reservas Detallado', '?view=reporte-reserva-detallado', 'icon ni ni-report-profit', 0, 27),
(29, 'Promociones del Mes', '?view=promocion-mes', 'icon ni ni-percent', 1, 0),
(30, 'Estado de Pago', '?view=estado-pago', 'icon ni ni-money', 0, 12),
(31, 'Referidos', '?view=referidos', '#', 0, 12);

-- --------------------------------------------------------

--
-- Table structure for table `notificacion`
--

DROP TABLE IF EXISTS `notificacion`;
CREATE TABLE IF NOT EXISTS `notificacion` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `id_usuario` int(11) NOT NULL,
  `id_modulo` int(11) NOT NULL,
  `resumen` varchar(250) COLLATE utf8_unicode_ci NOT NULL,
  `fecha` datetime NOT NULL,
  `estado_notificacion` int(11) NOT NULL,
  UNIQUE KEY `id` (`id`),
  KEY `id_modulo` (`id_modulo`),
  KEY `id_usuario` (`id_usuario`),
  KEY `estado_notificacion` (`estado_notificacion`)
) ENGINE=InnoDB AUTO_INCREMENT=137 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `notificacion`
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
(43, 1, 9, 'Modulo Actualizo informacion', '2021-01-03 22:10:45', 0),
(44, 1, 9, 'Modulo se dio de Alta', '2021-01-03 22:56:59', 0),
(45, 1, 9, 'Modulo Actualizo informacion', '2021-01-03 23:00:02', 0),
(46, 1, 9, 'Modulo Actualizo informacion', '2021-01-03 23:00:08', 0),
(47, 1, 9, 'Modulo Actualizo informacion', '2021-01-03 23:18:41', 0),
(48, 1, 9, 'Modulo Actualizo informacion', '2021-01-03 23:18:54', 0),
(49, 1, 9, 'Modulo Actualizo informacion', '2021-01-03 23:19:15', 0),
(50, 1, 9, 'Modulo Actualizo informacion', '2021-01-03 23:19:27', 0),
(51, 1, 9, 'Modulo Actualizo informacion', '2021-01-03 23:19:40', 0),
(52, 1, 9, 'Modulo Actualizo informacion', '2021-01-03 23:20:28', 0),
(53, 1, 9, 'Modulo se dio de Alta', '2021-01-03 23:25:38', 0),
(54, 1, 9, 'Modulo se dio de Alta', '2021-01-03 23:26:25', 0),
(55, 1, 9, 'Modulo Actualizo informacion', '2021-01-03 23:27:47', 0),
(56, 1, 9, 'Modulo Actualizo informacion', '2021-01-03 23:28:28', 0),
(57, 1, 9, 'Modulo Actualizo informacion', '2021-01-03 23:29:18', 0),
(58, 1, 9, 'Modulo se dio de Alta', '2021-01-03 23:30:45', 0),
(59, 1, 9, 'Modulo Actualizo informacion', '2021-01-03 23:31:53', 0),
(60, 1, 9, 'Modulo Actualizo informacion', '2021-01-03 23:33:18', 0),
(61, 1, 9, 'Modulo Actualizo informacion', '2021-01-03 23:35:05', 0),
(62, 1, 9, 'Modulo se dio de Alta', '2021-01-03 23:35:55', 0),
(63, 1, 9, 'Modulo Actualizo informacion', '2021-01-03 23:36:20', 0),
(64, 1, 9, 'Modulo Actualizo informacion', '2021-01-03 23:36:48', 0),
(65, 1, 9, 'Modulo Actualizo informacion', '2021-01-03 23:40:23', 0),
(66, 1, 9, 'Modulo se dio de Alta', '2021-01-03 23:41:31', 0),
(67, 1, 9, 'Modulo se dio de Alta', '2021-01-03 23:45:01', 0),
(68, 1, 9, 'Modulo Actualizo informacion', '2021-01-03 23:46:43', 0),
(69, 1, 9, 'Modulo se dio de Alta', '2021-01-03 23:48:18', 0),
(70, 1, 15, 'Habitacion Actualizo Informacion', '2021-01-04 01:20:22', 0),
(71, 1, 15, 'Habitacion Actualizo Informacion', '2021-01-05 21:07:20', 0),
(72, 1, 15, 'Habitacion Actualizo Informacion', '2021-01-05 21:07:28', 0),
(73, 1, 15, 'Habitacion Actualizo Informacion', '2021-01-05 21:07:36', 0),
(74, 1, 15, 'Habitacion Actualizo Informacion', '2021-01-05 21:07:43', 0),
(75, 1, 15, 'Habitacion Actualizo Informacion', '2021-01-05 21:07:53', 0),
(76, 1, 15, 'Habitacion Actualizo Informacion', '2021-01-05 21:08:02', 0),
(77, 1, 15, 'Habitacion Actualizo Informacion', '2021-01-05 21:08:10', 0),
(78, 1, 15, 'Habitacion Actualizo Informacion', '2021-01-05 21:08:17', 0),
(79, 1, 15, 'Habitacion se dio de Alta', '2021-01-05 21:08:32', 0),
(80, 1, 15, 'Habitacion se dio de Alta', '2021-01-05 21:08:46', 0),
(81, 1, 15, 'Habitacion Actualizo Informacion', '2021-01-05 21:10:11', 0),
(82, 1, 15, 'Habitacion Actualizo Informacion', '2021-01-05 21:10:18', 0),
(83, 1, 15, 'Habitacion Actualizo Informacion', '2021-01-05 21:10:30', 0),
(84, 1, 15, 'Habitacion Actualizo Informacion', '2021-01-05 21:10:36', 0),
(85, 1, 15, 'Habitacion Actualizo Informacion', '2021-01-05 21:10:43', 0),
(86, 1, 15, 'Habitacion Actualizo Informacion', '2021-01-05 21:10:50', 0),
(87, 1, 15, 'Habitacion Actualizo Informacion', '2021-01-05 21:10:56', 0),
(88, 1, 15, 'Habitacion Actualizo Informacion', '2021-01-05 21:11:05', 0),
(89, 1, 15, 'Habitacion Actualizo Informacion', '2021-01-05 21:11:14', 0),
(90, 1, 15, 'Habitacion Actualizo Informacion', '2021-01-05 21:11:17', 0),
(91, 1, 15, 'Habitacion se dio de Alta', '2021-01-05 21:11:58', 0),
(92, 1, 15, 'Habitacion se dio de Alta', '2021-01-05 21:12:08', 0),
(93, 1, 15, 'Habitacion se dio de Alta', '2021-01-05 21:12:20', 0),
(94, 1, 15, 'Habitacion se dio de Alta', '2021-01-05 21:12:26', 0),
(95, 1, 15, 'Habitacion se dio de Alta', '2021-01-05 21:12:37', 0),
(96, 1, 15, 'Habitacion se dio de Alta', '2021-01-05 21:12:47', 0),
(97, 1, 15, 'Habitacion se dio de Alta', '2021-01-05 21:12:53', 0),
(98, 1, 15, 'Habitacion se dio de Alta', '2021-01-05 21:13:02', 0),
(99, 1, 15, 'Habitacion se dio de Alta', '2021-01-05 21:13:24', 0),
(100, 1, 15, 'Habitacion se dio de Alta', '2021-01-05 21:13:28', 0),
(101, 1, 15, 'Habitacion se dio de Alta', '2021-01-05 21:13:42', 0),
(102, 1, 15, 'Habitacion se dio de Alta', '2021-01-05 21:13:48', 0),
(103, 1, 15, 'Habitacion se dio de Alta', '2021-01-05 21:13:53', 0),
(104, 1, 15, 'Habitacion se dio de Alta', '2021-01-05 21:13:58', 0),
(105, 1, 15, 'Habitacion se dio de Alta', '2021-01-05 21:14:07', 0),
(106, 1, 15, 'Habitacion se dio de Alta', '2021-01-05 21:14:12', 0),
(107, 1, 15, 'Habitacion se dio de Alta', '2021-01-05 21:14:34', 0),
(108, 1, 15, 'Habitacion se dio de Alta', '2021-01-05 21:14:44', 0),
(109, 1, 15, 'Habitacion se dio de Alta', '2021-01-05 21:14:50', 0),
(110, 1, 9, 'Modulo se dio de Alta', '2021-01-05 22:02:31', 0),
(111, 1, 9, 'Modulo Actualizo informacion', '2021-01-05 22:06:15', 0),
(112, 3, 6, 'Feriado se dio de Alta', '2021-01-06 02:14:00', 0),
(113, 3, 6, 'Feriado se dio de Alta', '2021-01-06 02:18:50', 0),
(114, 2, 5, 'Cliente se dio de Alta', '2021-01-08 19:44:10', 0),
(115, 3, 5, 'Cliente se dio de Alta', '2021-01-08 19:44:10', 0),
(116, 1, 5, 'Cliente se dio de Alta', '2021-01-08 19:44:10', 0),
(117, 2, 5, 'Cliente Actualizo informacion', '2021-01-08 19:44:45', 0),
(118, 3, 5, 'Cliente Actualizo informacion', '2021-01-08 19:44:45', 0),
(119, 1, 5, 'Cliente Actualizo informacion', '2021-01-08 19:44:45', 0),
(120, 1, 7, 'Tipo de Ducumento Actualizo informacion', '2021-01-08 19:45:45', 0),
(121, 2, 5, 'Cliente se dio de Alta', '2021-01-08 20:24:54', 0),
(122, 3, 5, 'Cliente se dio de Alta', '2021-01-08 20:24:54', 0),
(123, 1, 5, 'Cliente se dio de Alta', '2021-01-08 20:24:54', 0),
(124, 2, 5, 'Cliente se dio de Alta', '2021-01-08 20:32:59', 0),
(125, 3, 5, 'Cliente se dio de Alta', '2021-01-08 20:32:59', 0),
(126, 1, 5, 'Cliente se dio de Alta', '2021-01-08 20:32:59', 0),
(127, 2, 5, 'Cliente Actualizo informacion', '2021-01-08 20:33:56', 0),
(128, 3, 5, 'Cliente Actualizo informacion', '2021-01-08 20:33:56', 0),
(129, 1, 5, 'Cliente Actualizo informacion', '2021-01-08 20:33:56', 0),
(130, 2, 5, 'Cliente se dio de Alta', '2021-01-08 23:51:11', 0),
(131, 3, 5, 'Cliente se dio de Alta', '2021-01-08 23:51:11', 0),
(132, 1, 5, 'Cliente se dio de Alta', '2021-01-08 23:51:11', 0),
(133, 2, 5, 'Cliente Actualizo informacion', '2021-01-08 23:51:51', 0),
(134, 3, 5, 'Cliente Actualizo informacion', '2021-01-08 23:51:51', 0),
(135, 1, 5, 'Cliente Actualizo informacion', '2021-01-08 23:51:51', 0),
(136, 1, 9, 'Modulo se dio de Alta', '2021-01-11 22:49:54', 0);

-- --------------------------------------------------------

--
-- Table structure for table `promociones`
--

DROP TABLE IF EXISTS `promociones`;
CREATE TABLE IF NOT EXISTS `promociones` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `descripcion` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
  `costo` double DEFAULT NULL,
  `id_tipo_moneda` int(11) DEFAULT NULL,
  `dias_minimo` int(11) DEFAULT NULL,
  `estado` int(11) DEFAULT NULL,
  `id_categoria` int(11) DEFAULT NULL,
  `fecha_vencimiento` datetime DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `id_tipo_moneda` (`id_tipo_moneda`),
  KEY `id_categoria` (`id_categoria`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `promociones`
--

INSERT INTO `promociones` (`id`, `descripcion`, `costo`, `id_tipo_moneda`, `dias_minimo`, `estado`, `id_categoria`, `fecha_vencimiento`) VALUES
(1, 'Promoción Verano', 450, 13, 5, 1, NULL, '2021-01-31 00:00:00'),
(2, 'Familia', 4000, 13, 10, 1, NULL, '2021-01-31 00:00:00'),
(4, 'asda', 20, 13, 5, 1, 7, '2021-01-31 00:00:00');

-- --------------------------------------------------------

--
-- Table structure for table `referido`
--

DROP TABLE IF EXISTS `referido`;
CREATE TABLE IF NOT EXISTS `referido` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nombre` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `referido`
--

INSERT INTO `referido` (`id`, `nombre`) VALUES
(1, 'Ninguno'),
(2, 'Facebook');

-- --------------------------------------------------------

--
-- Table structure for table `reserva`
--

DROP TABLE IF EXISTS `reserva`;
CREATE TABLE IF NOT EXISTS `reserva` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `id_cliente` int(11) DEFAULT NULL,
  `observacion` varchar(120) COLLATE utf8_unicode_ci DEFAULT NULL,
  `id_referido` int(11) DEFAULT NULL,
  `fecha_ingreso` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
  `fecha_salida` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
  `hora_ingreso` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
  `hora_salida` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
  `id_usuario` int(11) DEFAULT NULL,
  `id_habitacion` int(11) DEFAULT NULL,
  `id_estado_pago` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `id_cliente` (`id_cliente`),
  KEY `id_usuario` (`id_usuario`),
  KEY `id_habitacion` (`id_habitacion`),
  KEY `id_estado_pago` (`id_estado_pago`)
) ENGINE=InnoDB AUTO_INCREMENT=13 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `reserva`
--

INSERT INTO `reserva` (`id`, `id_cliente`, `observacion`, `id_referido`, `fecha_ingreso`, `fecha_salida`, `hora_ingreso`, `hora_salida`, `id_usuario`, `id_habitacion`, `id_estado_pago`) VALUES
(1, 1, 'Prueba', 1, '2021-01-07', '2021-01-18', '08:00', '23:00', 1, 1, 1),
(2, 3, 'Prueba', 1, '2021-01-09', '2021-01-25', '00:30', '16:00', 1, 19, 1),
(3, 2, 'Prueba', 1, '2021-01-09', '2021-01-18', '01:30', '17:30', 1, 13, 1),
(4, 2, 'Prueba', 0, '2021-01-06', '2021-01-06', '02:00', '17:00', 1, 10, 1),
(5, 1, 'Prueba', 1, '2021-01-06', '2021-01-06', '13:30', '21:00', 1, 11, 1),
(6, 8, 'ddd', 1, '2021-01-17', '2021-01-23', '00:00', '00:00', 1, 11, 1),
(7, 5, 'sss', 0, '2021-01-16', '2021-01-22', '00:00', '00:00', 1, 15, 1),
(8, 6, 'xx', 0, '2021-01-11', '2021-01-11', '02:00', '14:00', 1, 11, 1),
(9, 6, 'xx', 0, '2021-01-13', '2021-01-26', '00:00', '00:00', 1, 18, 1),
(10, 4, 'x', 0, '2021-01-13', '2021-01-23', '00:00', '00:00', 1, 16, 1),
(11, 6, 'xxxx', 0, '2021-01-17', '2021-01-24', '00:00', '00:00', 1, 2, 1),
(12, 1, 'xxxx', 0, '2021-01-12', '2021-01-19', '00:00', '00:00', 1, 10, 1);

-- --------------------------------------------------------

--
-- Table structure for table `rol`
--

DROP TABLE IF EXISTS `rol`;
CREATE TABLE IF NOT EXISTS `rol` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nombre_rol` varchar(200) COLLATE utf8_unicode_ci NOT NULL,
  `estado_rol` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `estado_rol` (`estado_rol`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `rol`
--

INSERT INTO `rol` (`id`, `nombre_rol`, `estado_rol`) VALUES
(1, 'Administrador', 1),
(2, 'Vendedor', 1),
(3, 'Contabilidad', 1);

-- --------------------------------------------------------

--
-- Table structure for table `rol_modulo`
--

DROP TABLE IF EXISTS `rol_modulo`;
CREATE TABLE IF NOT EXISTS `rol_modulo` (
  `id_rol` int(11) NOT NULL,
  `id_modulo_usuario` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `rol_modulo`
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
(2, 1),
(2, 5),
(2, 13),
(2, 16),
(2, 22),
(3, 12),
(3, 19),
(3, 22),
(1, 1),
(1, 2),
(1, 3),
(1, 5),
(1, 11),
(1, 12),
(1, 6),
(1, 7),
(1, 8),
(1, 9),
(1, 10),
(1, 13),
(1, 14),
(1, 15),
(1, 18),
(1, 19),
(1, 20),
(1, 21),
(1, 22),
(1, 30),
(1, 31),
(1, 24),
(1, 27),
(1, 17),
(1, 28),
(1, 29);

-- --------------------------------------------------------

--
-- Table structure for table `tarifa`
--

DROP TABLE IF EXISTS `tarifa`;
CREATE TABLE IF NOT EXISTS `tarifa` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nombre_tarifa` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
  `precio_minimo` double DEFAULT NULL,
  `precio_base` double DEFAULT NULL,
  `estado_tarifa` int(11) DEFAULT NULL,
  `recargo_feriado` double DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `estado_tarifa` (`estado_tarifa`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `tarifa`
--

INSERT INTO `tarifa` (`id`, `nombre_tarifa`, `precio_minimo`, `precio_base`, `estado_tarifa`, `recargo_feriado`) VALUES
(6, 'Reserva 24 horas', 25.2, 10, 1, 10);

-- --------------------------------------------------------

--
-- Table structure for table `tipo_documento`
--

DROP TABLE IF EXISTS `tipo_documento`;
CREATE TABLE IF NOT EXISTS `tipo_documento` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nombre_documento` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `estado_documento` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `estado_documento` (`estado_documento`)
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `tipo_documento`
--

INSERT INTO `tipo_documento` (`id`, `nombre_documento`, `estado_documento`) VALUES
(2, 'Pasaporte', 1),
(3, 'Carnet de Extranjeria', 1),
(7, 'DNI', 1),
(8, 'RUC', 1);

-- --------------------------------------------------------

--
-- Table structure for table `tipo_moneda`
--

DROP TABLE IF EXISTS `tipo_moneda`;
CREATE TABLE IF NOT EXISTS `tipo_moneda` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `simbolo` varchar(20) COLLATE utf8_unicode_ci DEFAULT NULL,
  `cambio` double DEFAULT NULL,
  `estado` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=14 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `tipo_moneda`
--

INSERT INTO `tipo_moneda` (`id`, `simbolo`, `cambio`, `estado`) VALUES
(11, '$', 4, 1),
(13, 'S/ ', 1, 1);

-- --------------------------------------------------------

--
-- Table structure for table `usuario`
--

DROP TABLE IF EXISTS `usuario`;
CREATE TABLE IF NOT EXISTS `usuario` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
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
  `id_rol` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `id_tipo_documento` (`id_tipo_documento`),
  KEY `estado_usuario` (`estado_usuario`),
  KEY `id_rol` (`id_rol`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `usuario`
--

INSERT INTO `usuario` (`id`, `nombre`, `apellido_paterno`, `apellido_materno`, `id_tipo_documento`, `numero_documento`, `correo_usuario`, `estado_usuario`, `eliminar_usuario`, `usuario`, `password`, `id_rol`) VALUES
(1, 'Administrador', 'Sistema', 'Hotelero', 7, '00000000', 'hoteles@creamos-marca.com', 1, 0, 'admin', '90b9aa7e25f80cf4f64e990b78a9fc5ebd6cecad', 1),
(2, 'Admin', 'Clientes', 'Hotel', 7, '00000000', 'admin.clientes@gmail.com', 1, 0, 'admin.clientes', '10470c3b4b1fed12c3baac014be15fac67c6e815', 2),
(3, 'Alexander', 'Valerio', 'Cruz', 7, '76143032', 'ralexandervc@gmail.com', 1, 0, 'alexander', '5139fcb743565a93ba49568086a3376794cbc101', 2),
(4, 'Admin', 'Contabilidad', '-', 7, '111111', 'admin.contabilidad@creamos-marca.com', 1, 0, 'admin.contabilidad', '10470c3b4b1fed12c3baac014be15fac67c6e815', 3);

-- --------------------------------------------------------

--
-- Table structure for table `usuario_modulo`
--

DROP TABLE IF EXISTS `usuario_modulo`;
CREATE TABLE IF NOT EXISTS `usuario_modulo` (
  `id_usuario` int(11) NOT NULL,
  `id_modulo_usuario` int(11) NOT NULL,
  KEY `id_usuario` (`id_usuario`),
  KEY `id_modulo_usuario` (`id_modulo_usuario`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `usuario_modulo`
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
-- Table structure for table `usuario_notificacion`
--

DROP TABLE IF EXISTS `usuario_notificacion`;
CREATE TABLE IF NOT EXISTS `usuario_notificacion` (
  `id_usuario` int(11) NOT NULL,
  `id_modulo_usuario` int(11) NOT NULL,
  KEY `id_usuario` (`id_usuario`),
  KEY `id_modulo_usuario` (`id_modulo_usuario`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `usuario_notificacion`
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
-- Constraints for dumped tables
--

--
-- Constraints for table `agregado`
--
ALTER TABLE `agregado`
  ADD CONSTRAINT `agregado_ibfk_1` FOREIGN KEY (`id_tipo_moneda`) REFERENCES `tipo_moneda` (`id`);

--
-- Constraints for table `caja`
--
ALTER TABLE `caja`
  ADD CONSTRAINT `caja_ibfk_1` FOREIGN KEY (`id_usuario`) REFERENCES `usuario` (`id`);

--
-- Constraints for table `habitacion`
--
ALTER TABLE `habitacion`
  ADD CONSTRAINT `habitacion_ibfk_1` FOREIGN KEY (`id_categoria`) REFERENCES `categoria` (`id`);

--
-- Constraints for table `promociones`
--
ALTER TABLE `promociones`
  ADD CONSTRAINT `promociones_ibfk_1` FOREIGN KEY (`id_tipo_moneda`) REFERENCES `tipo_moneda` (`id`),
  ADD CONSTRAINT `promociones_ibfk_2` FOREIGN KEY (`id_categoria`) REFERENCES `categoria` (`id`);

--
-- Constraints for table `reserva`
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

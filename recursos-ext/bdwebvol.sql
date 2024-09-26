-- --------------------------------------------------------
-- Host:                         127.0.0.1
-- Versión del servidor:         10.4.32-MariaDB - mariadb.org binary distribution
-- SO del servidor:              Win64
-- HeidiSQL Versión:             12.6.0.6765
-- --------------------------------------------------------

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET NAMES utf8 */;
/*!50503 SET NAMES utf8mb4 */;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;


-- Volcando estructura de base de datos para bdwebvol
CREATE DATABASE IF NOT EXISTS `bdwebvol` /*!40100 DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci */;
USE `bdwebvol`;

-- Volcando estructura para tabla bdwebvol.actividades
CREATE TABLE IF NOT EXISTS `actividades` (
  `act_codigo` bigint(20) NOT NULL AUTO_INCREMENT,
  `nombre` varchar(100) NOT NULL DEFAULT '',
  `descripcion` text NOT NULL,
  `act_img` varchar(100) NOT NULL DEFAULT '../imagen/act_imgs/default.png',
  `creador_id` varchar(50) NOT NULL DEFAULT '',
  `inicia_en` datetime NOT NULL,
  `termina_en` datetime NOT NULL,
  `ubicacion` varchar(50) NOT NULL DEFAULT '',
  `act_etiquetas` varchar(100) NOT NULL,
  `act_rol` varchar(50) NOT NULL,
  `ac_activo` tinyint(4) NOT NULL DEFAULT 1,
  PRIMARY KEY (`act_codigo`),
  KEY `FK_creador_usuario` (`creador_id`),
  CONSTRAINT `FK_creador_usuario` FOREIGN KEY (`creador_id`) REFERENCES `usuarios` (`username`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- Volcando datos para la tabla bdwebvol.actividades: ~4 rows (aproximadamente)
INSERT INTO `actividades` (`act_codigo`, `nombre`, `descripcion`, `act_img`, `creador_id`, `inicia_en`, `termina_en`, `ubicacion`, `act_etiquetas`, `act_rol`, `ac_activo`) VALUES
	(1, 'Donacion de Sangre', 'Venir sin haber ingerido alcohol en 2 dias y en ayunas.', '../imagen/act_imgs/default.png', 'Voluntario123', '2024-09-27 00:00:00', '2024-10-30 00:00:00', 'Hospital San José', '', 'voluntario', 1),
	(2, 'Plantacion', 'Plantar flores en el parque', '../imagen/act_imgs/default.png', 'Voluntario123', '2024-09-25 10:00:00', '2024-09-25 17:00:00', 'Parque Akino', '', '', 1),
	(3, 'Excavacion', 'Hacer espacio para los postes nuevos.', '../imagen/act_imgs/default.png', 'Voluntario123', '2024-09-25 10:00:00', '2024-09-25 17:00:00', 'Parque Akino', '', '', 1),
	(4, 'Repartir volantes', 'Ruta: El Albergue > La Julia', '../imagen/act_imgs/default.png', 'Voluntario123', '2024-09-26 12:00:00', '2024-09-26 18:30:00', 'Carrera 17 #18-21', '', 'voluntario', 1),
	(5, 'Pegar anuncios', 'Traer agua, el resto de materiales se les brindarán en el lugar de encuentro.', '../imagen/act_imgs/default.png', 'Voluntario123', '2024-09-30 07:00:00', '2024-10-11 11:00:00', 'Colegio Académico', '', 'voluntario', 1);

-- Volcando estructura para tabla bdwebvol.perfiles
CREATE TABLE IF NOT EXISTS `perfiles` (
  `perfil_id` int(11) NOT NULL AUTO_INCREMENT,
  `user_perfil` varchar(50) NOT NULL,
  `p_avatar` varchar(50) NOT NULL DEFAULT '../imagen/avatars/default.png',
  `p_nombre` varchar(100) NOT NULL,
  `p_apellido` varchar(100) NOT NULL,
  `p_apodo` varchar(50) NOT NULL,
  `p_telefono` bigint(10) NOT NULL DEFAULT 0,
  `p_compañia` varchar(50) NOT NULL,
  `p_edad` int(3) NOT NULL DEFAULT 0,
  `etiquetas` varchar(100) NOT NULL DEFAULT '',
  `p_activo` tinyint(4) NOT NULL DEFAULT 1,
  PRIMARY KEY (`perfil_id`),
  KEY `fk_user_id` (`user_perfil`),
  CONSTRAINT `fk_user_id` FOREIGN KEY (`user_perfil`) REFERENCES `usuarios` (`username`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- Volcando datos para la tabla bdwebvol.perfiles: ~1 rows (aproximadamente)
INSERT INTO `perfiles` (`perfil_id`, `user_perfil`, `p_avatar`, `p_nombre`, `p_apellido`, `p_apodo`, `p_telefono`, `p_compañia`, `p_edad`, `etiquetas`, `p_activo`) VALUES
	(1, 'Voluntario123', '../imagen/avatars/default.png', 'Mario', 'Fernandez', 'Mar', 3183048561, 'VoluntaYa', 34, 'Niños, Manualidades, Enseñanza', 1),
	(3, 'Voluntario456', '../imagen/avatars/default.png', 'Julio', 'Melendez', 'Juli', 0, '', 21, 'Enseñanza, Tecnología, Jardinería, Traducción', 1);

-- Volcando estructura para tabla bdwebvol.registros
CREATE TABLE IF NOT EXISTS `registros` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  `usuario_id` varchar(50) NOT NULL DEFAULT '',
  `codigo_actividad` varchar(50) NOT NULL DEFAULT '',
  `fecha_registro` datetime NOT NULL DEFAULT '2000-01-01 00:00:00',
  `reg_activo` tinyint(4) NOT NULL DEFAULT 1,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- Volcando datos para la tabla bdwebvol.registros: ~1 rows (aproximadamente)
INSERT INTO `registros` (`id`, `usuario_id`, `codigo_actividad`, `fecha_registro`, `reg_activo`) VALUES
	(1, 'Voluntario123', '202495624', '2024-09-26 18:41:36', 0);

-- Volcando estructura para tabla bdwebvol.usuarios
CREATE TABLE IF NOT EXISTS `usuarios` (
  `username` varchar(50) NOT NULL DEFAULT '',
  `password` varchar(30) NOT NULL DEFAULT '',
  `email` varchar(70) NOT NULL DEFAULT '',
  `rol` varchar(25) NOT NULL DEFAULT '',
  `valoracion` float NOT NULL DEFAULT 0,
  `num_valor` int(10) NOT NULL DEFAULT 0,
  `us_activo` tinyint(4) NOT NULL DEFAULT 1,
  PRIMARY KEY (`username`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- Volcando datos para la tabla bdwebvol.usuarios: ~1 rows (aproximadamente)
INSERT INTO `usuarios` (`username`, `password`, `email`, `rol`, `valoracion`, `num_valor`, `us_activo`) VALUES
	('Voluntario123', 'conTRAs3ña', 'marfer@mail.com', 'voluntario', 3.5, 2, 1),
	('Voluntario456', 'VOLuntar#2', 'jul@mail.com', 'manager', 0, 0, 1);

/*!40103 SET TIME_ZONE=IFNULL(@OLD_TIME_ZONE, 'system') */;
/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS=IFNULL(@OLD_FOREIGN_KEY_CHECKS, 1) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40111 SET SQL_NOTES=IFNULL(@OLD_SQL_NOTES, 1) */;

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
  `act_codigo` varchar(50) NOT NULL DEFAULT '',
  `nombre` varchar(100) NOT NULL DEFAULT '',
  `descripcion` varchar(50) NOT NULL DEFAULT '',
  `creador_id` varchar(50) NOT NULL DEFAULT '',
  `inicia_en` datetime NOT NULL,
  `termina_en` datetime NOT NULL,
  `ubicacion` varchar(50) NOT NULL DEFAULT '',
  PRIMARY KEY (`act_codigo`),
  KEY `FK_creador_usuario` (`creador_id`),
  CONSTRAINT `FK_creador_usuario` FOREIGN KEY (`creador_id`) REFERENCES `usuarios` (`username`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- Volcando datos para la tabla bdwebvol.actividades: ~0 rows (aproximadamente)

-- Volcando estructura para tabla bdwebvol.registros
CREATE TABLE IF NOT EXISTS `registros` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  `usuario_id` varchar(50) NOT NULL DEFAULT '',
  `codigo_actividad` varchar(50) NOT NULL DEFAULT '',
  `fecha_registro` datetime NOT NULL DEFAULT '2000-01-01 00:00:00',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- Volcando datos para la tabla bdwebvol.registros: ~0 rows (aproximadamente)

-- Volcando estructura para tabla bdwebvol.usuarios
CREATE TABLE IF NOT EXISTS `usuarios` (
  `username` varchar(50) NOT NULL DEFAULT '',
  `password` varchar(30) NOT NULL DEFAULT '',
  `nombre` varchar(70) NOT NULL DEFAULT '',
  `apellido` varchar(70) NOT NULL DEFAULT '',
  `email` varchar(70) NOT NULL DEFAULT '',
  `compañia` varchar(50) NOT NULL DEFAULT ' ',
  `rol` varchar(25) NOT NULL DEFAULT '',
  PRIMARY KEY (`username`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- Volcando datos para la tabla bdwebvol.usuarios: ~0 rows (aproximadamente)

/*!40103 SET TIME_ZONE=IFNULL(@OLD_TIME_ZONE, 'system') */;
/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS=IFNULL(@OLD_FOREIGN_KEY_CHECKS, 1) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40111 SET SQL_NOTES=IFNULL(@OLD_SQL_NOTES, 1) */;

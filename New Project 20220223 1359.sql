-- MySQL Administrator dump 1.4
--
-- ------------------------------------------------------
-- Server version	5.7.36


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;


--
-- Create schema asistencia
--

CREATE DATABASE IF NOT EXISTS asistencia;
USE asistencia;

--
-- Definition of table `cursos`
--

DROP TABLE IF EXISTS `cursos`;
CREATE TABLE `cursos` (
  `idCurso` int(11) NOT NULL AUTO_INCREMENT,
  `idTipoCurso` int(11) NOT NULL,
  `nombreCurso` varchar(200) NOT NULL,
  `idProveedor` int(11) NOT NULL,
  `fechaInicial` datetime NOT NULL,
  `fechaFinal` datetime NOT NULL,
  `descripcionCurso` varchar(500) NOT NULL,
  `activo` tinyint(1) NOT NULL DEFAULT '1',
  PRIMARY KEY (`idCurso`)
) ENGINE=InnoDB AUTO_INCREMENT=14 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `cursos`
--

/*!40000 ALTER TABLE `cursos` DISABLE KEYS */;
INSERT INTO `cursos` (`idCurso`,`idTipoCurso`,`nombreCurso`,`idProveedor`,`fechaInicial`,`fechaFinal`,`descripcionCurso`,`activo`) VALUES 
 (1,2,'Demo WorkDay',1,'2022-02-16 10:00:00','2022-02-16 13:00:00','asd  dsafasdf asdfa fasdf sdf',1),
 (2,1,'Demo Oracle Back Office',2,'2022-02-17 10:00:00','2022-02-17 13:00:00','',1),
 (3,3,'Demo Oracle BI',2,'2022-02-17 13:00:00','2022-02-17 14:00:00','',1),
 (4,2,'Hospisoft (His)',3,'2022-02-22 09:00:00','2022-02-22 12:00:00','',1),
 (5,1,'Hospisoft (Back)',3,'2022-02-22 14:00:00','2022-02-22 17:00:00','',1),
 (6,3,'Hospisoft (BI)',3,'2022-02-22 17:00:00','2022-02-22 18:00:00','',1),
 (7,2,'SAP / CERNER (HIS)',4,'2022-03-01 09:00:00','2022-03-01 00:59:00','',1),
 (8,1,'SAP / CERNER (BACK OFFICE)',4,'2022-03-01 14:00:00','2022-03-01 17:00:00','',1),
 (9,3,'SAP / CERNER (BI)',4,'2022-03-01 17:00:00','2022-03-01 18:00:00','',1),
 (10,2,'Tasy (HIS)',5,'2022-03-03 09:00:00','2022-03-03 12:00:00','',1),
 (11,1,'Tasy (BACKOFFICE)',5,'2022-03-03 14:00:00','2022-03-03 17:00:00','',1),
 (12,3,'Tasy (BI)',5,'2022-03-03 17:00:00','2022-03-03 18:00:00','',1),
 (13,2,'Commons (HIS)',6,'2022-02-24 09:00:00','2022-02-24 12:00:00','',1);
/*!40000 ALTER TABLE `cursos` ENABLE KEYS */;


--
-- Definition of table `employee_attendance`
--

DROP TABLE IF EXISTS `employee_attendance`;
CREATE TABLE `employee_attendance` (
  `employee_id` bigint(20) unsigned NOT NULL,
  `date` varchar(10) NOT NULL,
  `status` enum('presence','absence') DEFAULT NULL,
  KEY `employee_id` (`employee_id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `employee_attendance`
--

/*!40000 ALTER TABLE `employee_attendance` DISABLE KEYS */;
/*!40000 ALTER TABLE `employee_attendance` ENABLE KEYS */;


--
-- Definition of table `employees`
--

DROP TABLE IF EXISTS `employees`;
CREATE TABLE `employees` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `activo` tinyint(1) NOT NULL DEFAULT '1',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=56 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `employees`
--

/*!40000 ALTER TABLE `employees` DISABLE KEYS */;
INSERT INTO `employees` (`id`,`name`,`activo`) VALUES 
 (1,'Susana Luciano',1),
 (2,'Cristina Diaz',1),
 (3,'Efren Ayala',1),
 (4,'Gabriela Ponce',1),
 (5,'Carlos Joel Gomez Barajas',1),
 (6,'Jose Servin',1),
 (7,'Octavio Castro',1),
 (8,'Sara Delgadillo',1),
 (9,'Jorge Elizalde',1),
 (10,'Rocio Ruiz',1),
 (11,'Magdalena Lopez',1),
 (12,'Jorge Vega',1),
 (13,'Martha Orozco',1),
 (14,'Luz Vargas',1),
 (15,'Angel Calderon',1),
 (16,'Luis Gonzalez',1),
 (17,'Carlos Jimenez',1),
 (18,'Jennifer Cabral',1),
 (19,'Esmeralda Acosta',1),
 (52,'Elida Gallegos',1),
 (21,'Edgar Benitez',1),
 (22,'Alejandro Gil',1),
 (23,'Rolando Sosa',1),
 (24,'Martin Lopez',1),
 (25,'Maria Barron',1),
 (26,'Gaston Rodriguez',1),
 (27,'Alfonso Garcia',1),
 (28,'Fernando Hernandez',1),
 (29,'Erendida Munoz',1),
 (30,'Oscar Lomeli',1),
 (31,'Alvaro Aragon',1),
 (32,'Ana Lucia Alvarado',1),
 (33,'Gloria Gonzalez',1),
 (34,'Dulce Vazquez',1),
 (35,'Gladys Castorena',1),
 (36,'Guadalupe Herrada',1),
 (37,'Juan Dominguez',1),
 (38,'Juan Vargas',1),
 (39,'Karina Garcia',1),
 (40,'Marisol Martinez',1),
 (41,'Maria de Jesus Padilla Mendez',1),
 (42,'Zaira Castillo',1),
 (43,'Sergio Jimenez',1),
 (44,'Angeles Godoy',1),
 (45,'Arturo Guardado',1),
 (46,'Briseyda Diaz',1),
 (47,'Federico Aguila',1),
 (48,'Hugo Valdivia',1),
 (49,'Jocelyn Plascencia',1),
 (50,'Jorge Barron',1),
 (51,'Monica Barajas',1),
 (53,'Oscar Delgadillo',1),
 (54,'Lucia Calderon',1),
 (55,'Diana Maria Ibarra Benitez',1);
/*!40000 ALTER TABLE `employees` ENABLE KEYS */;


--
-- Definition of table `proveedores`
--

DROP TABLE IF EXISTS `proveedores`;
CREATE TABLE `proveedores` (
  `idProveedor` int(11) NOT NULL AUTO_INCREMENT,
  `nombreProveedor` varchar(250) NOT NULL,
  `activo` tinyint(1) NOT NULL DEFAULT '1',
  PRIMARY KEY (`idProveedor`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `proveedores`
--

/*!40000 ALTER TABLE `proveedores` DISABLE KEYS */;
INSERT INTO `proveedores` (`idProveedor`,`nombreProveedor`,`activo`) VALUES 
 (1,'WorkDay',1),
 (2,'Oracle',1),
 (3,'Hospisoft',1),
 (4,'Cernet',1),
 (5,'Tasy',1),
 (6,'Commons',1);
/*!40000 ALTER TABLE `proveedores` ENABLE KEYS */;


--
-- Definition of table `relacioncursoempleado`
--

DROP TABLE IF EXISTS `relacioncursoempleado`;
CREATE TABLE `relacioncursoempleado` (
  `idRelacion` int(11) NOT NULL AUTO_INCREMENT,
  `idCurso` int(11) NOT NULL,
  `idEmpleado` int(11) NOT NULL,
  `asistencia` tinyint(1) NOT NULL DEFAULT '0',
  `activo` tinyint(1) NOT NULL DEFAULT '1',
  PRIMARY KEY (`idRelacion`),
  KEY `FK_relacioncursoempleado_1` (`idCurso`),
  CONSTRAINT `FK_relacioncursoempleado_1` FOREIGN KEY (`idCurso`) REFERENCES `cursos` (`idCurso`)
) ENGINE=InnoDB AUTO_INCREMENT=735 DEFAULT CHARSET=latin1 ROW_FORMAT=DYNAMIC;

--
-- Dumping data for table `relacioncursoempleado`
--

/*!40000 ALTER TABLE `relacioncursoempleado` DISABLE KEYS */;
INSERT INTO `relacioncursoempleado` (`idRelacion`,`idCurso`,`idEmpleado`,`asistencia`,`activo`) VALUES 
 (16,1,1,1,1),
 (17,1,2,0,1),
 (18,1,3,0,1),
 (19,1,4,0,1),
 (20,1,9,0,1),
 (21,1,14,0,1),
 (119,2,1,1,1),
 (120,2,2,1,1),
 (121,2,3,1,1),
 (122,2,4,0,1),
 (123,2,5,1,1),
 (124,2,6,1,1),
 (125,2,7,1,1),
 (126,2,8,0,1),
 (127,2,9,1,1),
 (128,2,10,1,1),
 (129,2,11,0,1),
 (130,2,12,1,1),
 (131,2,14,0,1),
 (132,2,15,1,1),
 (133,2,16,1,1),
 (134,2,17,1,1),
 (135,2,18,1,1),
 (136,2,19,1,1),
 (137,2,13,0,1),
 (138,2,21,1,1),
 (139,2,28,1,1),
 (140,2,29,1,1),
 (141,2,30,1,1),
 (142,2,31,1,1),
 (168,3,22,0,1),
 (169,3,27,1,1),
 (170,3,15,1,1),
 (171,3,17,1,1),
 (172,3,5,1,1),
 (173,3,2,1,1),
 (174,3,26,1,1),
 (175,3,9,0,1),
 (176,3,12,1,1),
 (177,3,16,1,1),
 (178,3,25,1,1),
 (179,3,24,1,1),
 (180,3,23,0,1),
 (181,3,1,1,1),
 (248,7,32,0,1),
 (249,7,15,0,1),
 (250,7,44,0,1),
 (251,7,45,0,1),
 (252,7,46,0,1),
 (253,7,17,0,1),
 (254,7,2,0,1),
 (255,7,34,0,1),
 (256,7,21,0,1),
 (257,7,52,0,1),
 (258,7,47,0,1),
 (259,7,35,0,1),
 (260,7,33,0,1),
 (261,7,36,0,1),
 (262,7,48,0,1),
 (263,7,18,0,1),
 (264,7,49,0,1),
 (265,7,50,0,1),
 (266,7,12,0,1),
 (267,7,37,0,1),
 (268,7,38,0,1),
 (269,7,39,0,1),
 (270,7,11,0,1),
 (271,7,25,0,1),
 (272,7,41,0,1),
 (273,7,40,0,1),
 (274,7,24,0,1),
 (275,7,51,0,1),
 (276,7,53,0,1),
 (277,7,10,0,1),
 (278,7,23,0,1),
 (279,7,43,0,1),
 (280,7,1,0,1),
 (281,8,15,0,1),
 (282,8,17,0,1),
 (283,8,5,0,1),
 (284,8,2,0,1),
 (285,8,21,0,1),
 (286,8,3,0,1),
 (287,8,19,0,1),
 (288,8,4,0,1),
 (289,8,18,0,1),
 (290,8,9,0,1),
 (291,8,12,0,1),
 (292,8,6,0,1),
 (293,8,14,0,1),
 (294,8,11,0,1),
 (295,8,13,0,1),
 (296,8,7,0,1),
 (297,8,53,0,1),
 (298,8,10,0,1),
 (299,8,8,0,1),
 (300,8,1,0,1),
 (301,9,22,0,1),
 (302,9,27,0,1),
 (303,9,15,0,1),
 (304,9,17,0,1),
 (305,9,26,0,1),
 (306,9,9,0,1),
 (307,9,12,0,1),
 (308,9,25,0,1),
 (309,9,24,0,1),
 (310,9,53,0,1),
 (311,9,23,0,1),
 (312,9,1,0,1),
 (313,10,32,0,1),
 (314,10,15,0,1),
 (315,10,44,0,1),
 (316,10,45,0,1),
 (317,10,46,0,1),
 (318,10,17,0,1),
 (319,10,2,0,1),
 (320,10,34,0,1),
 (321,10,21,0,1),
 (322,10,52,0,1),
 (323,10,47,0,1),
 (324,10,35,0,1),
 (325,10,33,0,1),
 (326,10,36,0,1),
 (327,10,48,0,1),
 (328,10,18,0,1),
 (329,10,49,0,1),
 (330,10,50,0,1),
 (331,10,12,0,1),
 (332,10,37,0,1),
 (333,10,38,0,1),
 (334,10,39,0,1),
 (335,10,11,0,1),
 (336,10,25,0,1),
 (337,10,41,0,1),
 (338,10,40,0,1),
 (339,10,24,0,1),
 (340,10,51,0,1),
 (341,10,10,0,1),
 (342,10,23,0,1),
 (343,10,43,0,1),
 (344,10,1,0,1),
 (345,11,15,0,1),
 (346,11,17,0,1),
 (347,11,5,0,1),
 (348,11,2,0,1),
 (349,11,21,0,1),
 (350,11,3,0,1),
 (351,11,19,0,1),
 (352,11,4,0,1),
 (353,11,18,0,1),
 (354,11,9,0,1),
 (355,11,12,0,1),
 (356,11,6,0,1),
 (357,11,14,0,1),
 (358,11,11,0,1),
 (359,11,13,0,1),
 (360,11,7,0,1),
 (361,11,10,0,1),
 (362,11,23,0,1),
 (363,11,8,0,1),
 (364,11,1,0,1),
 (365,12,22,0,1),
 (366,12,27,0,1),
 (367,12,15,0,1),
 (368,12,17,0,1),
 (369,12,26,0,1),
 (370,12,9,0,1),
 (371,12,12,0,1),
 (372,12,25,0,1),
 (373,12,24,0,1),
 (374,12,23,0,1),
 (375,12,1,0,1),
 (528,4,31,1,1),
 (529,4,32,0,1),
 (530,4,15,1,1),
 (531,4,44,1,1),
 (532,4,45,0,1),
 (533,4,46,0,1),
 (534,4,17,1,1),
 (535,4,2,1,1),
 (536,4,34,0,1),
 (537,4,21,0,1),
 (538,4,52,1,1),
 (539,4,47,1,1),
 (540,4,35,1,1),
 (541,4,33,1,1),
 (542,4,36,1,1),
 (543,4,48,1,1),
 (544,4,18,1,1),
 (545,4,49,1,1),
 (546,4,50,1,1),
 (547,4,12,1,1),
 (548,4,37,1,1),
 (549,4,38,0,1),
 (550,4,39,1,1),
 (551,4,54,1,1),
 (552,4,16,1,1),
 (553,4,25,1,1),
 (554,4,41,0,1),
 (555,4,40,1,1),
 (556,4,24,1,1),
 (557,4,51,1,1),
 (558,4,10,1,1),
 (559,4,23,0,1),
 (560,4,43,0,1),
 (664,5,31,1,1),
 (665,5,15,1,1),
 (666,5,17,1,1),
 (667,5,5,1,1),
 (668,5,2,1,1),
 (669,5,55,1,1),
 (670,5,21,1,1),
 (671,5,3,1,1),
 (672,5,19,1,1),
 (673,5,4,0,1),
 (674,5,36,1,1),
 (675,5,18,1,1),
 (676,5,9,0,1),
 (677,5,12,0,1),
 (678,5,6,1,1),
 (679,5,16,1,1),
 (680,5,14,0,1),
 (681,5,13,1,1),
 (682,5,7,1,1),
 (683,5,10,1,1),
 (684,5,8,0,1),
 (723,6,27,1,1),
 (724,6,31,1,1),
 (725,6,15,1,1),
 (726,6,17,1,1),
 (727,6,5,1,1),
 (728,6,2,1,1),
 (729,6,26,1,1),
 (730,6,9,0,1),
 (731,6,12,1,1),
 (732,6,37,1,1),
 (733,6,25,0,1),
 (734,6,24,1,1);
/*!40000 ALTER TABLE `relacioncursoempleado` ENABLE KEYS */;


--
-- Definition of table `tipocurso`
--

DROP TABLE IF EXISTS `tipocurso`;
CREATE TABLE `tipocurso` (
  `idTipoCurso` int(11) NOT NULL AUTO_INCREMENT,
  `nombreCurso` varchar(200) NOT NULL,
  `activo` tinyint(1) NOT NULL DEFAULT '1',
  PRIMARY KEY (`idTipoCurso`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tipocurso`
--

/*!40000 ALTER TABLE `tipocurso` DISABLE KEYS */;
INSERT INTO `tipocurso` (`idTipoCurso`,`nombreCurso`,`activo`) VALUES 
 (1,'BACKOFFICE',1),
 (2,'HIS',1),
 (3,'BI',1);
/*!40000 ALTER TABLE `tipocurso` ENABLE KEYS */;




/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;

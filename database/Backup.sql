/*
SQLyog Community v12.5.1 (64 bit)
MySQL - 10.4.24-MariaDB : Database - sistema_hotelero
*********************************************************************
*/

/*!40101 SET NAMES utf8 */;

/*!40101 SET SQL_MODE=''*/;

/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;
CREATE DATABASE /*!32312 IF NOT EXISTS*/`sistema_hotelero` /*!40100 DEFAULT CHARACTER SET utf8mb4 */;

USE `sistema_hotelero`;

/*Table structure for table `cargos` */

DROP TABLE IF EXISTS `cargos`;

CREATE TABLE `cargos` (
  `idcargo` int(11) NOT NULL AUTO_INCREMENT,
  `tipo` varchar(40) NOT NULL,
  `pago` decimal(7,2) NOT NULL,
  PRIMARY KEY (`idcargo`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4;

/*Data for the table `cargos` */

insert  into `cargos`(`idcargo`,`tipo`,`pago`) values 
(1,'Recepcionista',1600.00),
(2,'Gobernanta',1200.00);

/*Table structure for table `controlpagos` */

DROP TABLE IF EXISTS `controlpagos`;

CREATE TABLE `controlpagos` (
  `idcontrolpago` int(11) NOT NULL AUTO_INCREMENT,
  `idreservacion` int(11) NOT NULL,
  `fechapago` datetime NOT NULL DEFAULT current_timestamp(),
  `mediopago` varchar(20) NOT NULL,
  PRIMARY KEY (`idcontrolpago`),
  KEY `fk_con_idr` (`idreservacion`),
  CONSTRAINT `fk_con_idr` FOREIGN KEY (`idreservacion`) REFERENCES `reservaciones` (`idreservacion`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

/*Data for the table `controlpagos` */

/*Table structure for table `empleados` */

DROP TABLE IF EXISTS `empleados`;

CREATE TABLE `empleados` (
  `idempleado` int(11) NOT NULL AUTO_INCREMENT,
  `idpersona` int(11) NOT NULL,
  `idcargo` int(11) NOT NULL,
  `turno` char(1) NOT NULL,
  `direccion` varchar(40) DEFAULT NULL,
  PRIMARY KEY (`idempleado`),
  KEY `fk_emp_idp` (`idpersona`),
  KEY `fk_emp_idc` (`idcargo`),
  CONSTRAINT `fk_emp_idc` FOREIGN KEY (`idcargo`) REFERENCES `cargos` (`idcargo`),
  CONSTRAINT `fk_emp_idp` FOREIGN KEY (`idpersona`) REFERENCES `personas` (`idpersona`),
  CONSTRAINT `ck_emp_tur` CHECK (`turno` in ('M','T','N'))
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4;

/*Data for the table `empleados` */

insert  into `empleados`(`idempleado`,`idpersona`,`idcargo`,`turno`,`direccion`) values 
(1,2,1,'M',NULL),
(2,2,1,'T',NULL),
(3,3,1,'N',NULL),
(4,4,2,'M',NULL);

/*Table structure for table `habitaciones` */

DROP TABLE IF EXISTS `habitaciones`;

CREATE TABLE `habitaciones` (
  `idhabitacion` int(11) NOT NULL AUTO_INCREMENT,
  `idtipohabitacion` int(11) NOT NULL,
  `numcamas` tinyint(4) NOT NULL,
  `numhabitacion` smallint(6) NOT NULL,
  `piso` tinyint(4) NOT NULL,
  `capacidad` varchar(10) NOT NULL,
  `precio` decimal(5,2) NOT NULL,
  `estado` char(1) NOT NULL DEFAULT '1',
  PRIMARY KEY (`idhabitacion`),
  KEY `fk_hab_idt` (`idtipohabitacion`),
  CONSTRAINT `fk_hab_idt` FOREIGN KEY (`idtipohabitacion`) REFERENCES `tipohabitaciones` (`idtipohabitacion`),
  CONSTRAINT `ck_hab_pre` CHECK (`precio` > 0)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8mb4;

/*Data for the table `habitaciones` */

insert  into `habitaciones`(`idhabitacion`,`idtipohabitacion`,`numcamas`,`numhabitacion`,`piso`,`capacidad`,`precio`,`estado`) values 
(1,1,1,110,1,'2',40.00,'1'),
(2,2,2,111,1,'4',80.00,'1'),
(3,3,3,120,2,'6',120.00,'1'),
(4,4,4,128,2,'8',180.00,'1'),
(5,5,1,156,4,'2',200.00,'1'),
(6,6,1,145,3,'3',160.00,'1');

/*Table structure for table `personas` */

DROP TABLE IF EXISTS `personas`;

CREATE TABLE `personas` (
  `idpersona` int(11) NOT NULL AUTO_INCREMENT,
  `nombres` varchar(30) NOT NULL,
  `apellidos` varchar(30) NOT NULL,
  `dni` char(8) NOT NULL,
  `telefono` char(9) DEFAULT NULL,
  `fechaNac` datetime NOT NULL,
  PRIMARY KEY (`idpersona`),
  UNIQUE KEY `uk_per_tel` (`dni`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4;

/*Data for the table `personas` */

insert  into `personas`(`idpersona`,`nombres`,`apellidos`,`dni`,`telefono`,`fechaNac`) values 
(1,'Luis David','Cusi Gonzales','73196921','934651825','2003-09-06 00:00:00'),
(2,'Maria Cristina','Mata Salazar','78123265','965434245','2000-12-02 00:00:00'),
(3,'Daniel Roberto','Garcia Sosa','78111265','954874327','1999-01-05 00:00:00'),
(4,'Victor Jésus','Camacho Carrasco','72543987','986744652','2004-11-02 00:00:00');

/*Table structure for table `reservaciones` */

DROP TABLE IF EXISTS `reservaciones`;

CREATE TABLE `reservaciones` (
  `idreservacion` int(11) NOT NULL AUTO_INCREMENT,
  `idempleado` int(11) NOT NULL,
  `idusuario` int(11) NOT NULL,
  `idhabitacion` int(11) NOT NULL,
  `numcuarto` tinyint(4) NOT NULL,
  `fecharegistro` datetime NOT NULL DEFAULT current_timestamp(),
  `fechaentrada` date NOT NULL,
  `fechasalida` date NOT NULL,
  `tipocomprobante` char(1) NOT NULL,
  `fechacomprobante` datetime NOT NULL DEFAULT current_timestamp(),
  PRIMARY KEY (`idreservacion`),
  KEY `fk_res_ide` (`idempleado`),
  KEY `fk_res_idu` (`idusuario`),
  KEY `fk_idh` (`idhabitacion`),
  CONSTRAINT `fk_idh` FOREIGN KEY (`idhabitacion`) REFERENCES `habitaciones` (`idhabitacion`),
  CONSTRAINT `fk_res_ide` FOREIGN KEY (`idempleado`) REFERENCES `empleados` (`idempleado`),
  CONSTRAINT `fk_res_idu` FOREIGN KEY (`idusuario`) REFERENCES `usuarios` (`idusuario`),
  CONSTRAINT `ck_res_tco` CHECK (`tipocomprobante` in ('F','B'))
) ENGINE=InnoDB AUTO_INCREMENT=19 DEFAULT CHARSET=utf8mb4;

/*Data for the table `reservaciones` */

insert  into `reservaciones`(`idreservacion`,`idempleado`,`idusuario`,`idhabitacion`,`numcuarto`,`fecharegistro`,`fechaentrada`,`fechasalida`,`tipocomprobante`,`fechacomprobante`) values 
(1,1,1,4,1,'2023-05-27 19:34:41','2023-05-25','2023-05-30','B','2023-05-27 19:34:41'),
(2,1,1,2,3,'2023-05-27 19:34:41','2023-06-25','2023-06-30','B','2023-05-27 19:34:41'),
(3,3,1,1,1,'2023-05-27 19:34:41','2023-05-25','2023-05-27','B','2023-05-27 19:34:41'),
(4,1,1,1,3,'2023-05-27 19:34:41','2023-05-25','2023-06-01','B','2023-05-27 19:34:41'),
(5,3,1,3,2,'2023-05-27 19:34:41','2023-05-27','2023-06-07','B','2023-05-27 19:34:41'),
(6,3,1,2,1,'2023-05-27 19:35:21','2023-06-01','2023-06-10','B','2023-05-27 19:35:21'),
(17,2,1,1,1,'2023-05-28 18:47:59','2023-06-03','2023-06-07','B','2023-05-28 18:47:59'),
(18,2,1,1,1,'2023-05-28 18:57:00','2023-05-29','2023-06-02','B','2023-05-28 18:57:00');

/*Table structure for table `tipohabitaciones` */

DROP TABLE IF EXISTS `tipohabitaciones`;

CREATE TABLE `tipohabitaciones` (
  `idtipohabitacion` int(11) NOT NULL AUTO_INCREMENT,
  `tipo` varchar(30) NOT NULL,
  `descripcion` varchar(80) DEFAULT NULL,
  PRIMARY KEY (`idtipohabitacion`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8mb4;

/*Data for the table `tipohabitaciones` */

insert  into `tipohabitaciones`(`idtipohabitacion`,`tipo`,`descripcion`) values 
(1,'Individual','Habitación asignada a una persona'),
(2,'Doble','Habitación asignada a dos personas'),
(3,'Triple','Habitación asignada a tres personas'),
(4,'Quad','Habitación asignada a cuatro personas'),
(5,'Queen','Habitación con cama matrimonial'),
(6,'King','Habitación con una cama king-size');

/*Table structure for table `usuarios` */

DROP TABLE IF EXISTS `usuarios`;

CREATE TABLE `usuarios` (
  `idusuario` int(11) NOT NULL AUTO_INCREMENT,
  `idpersona` int(11) NOT NULL,
  `email` varchar(50) NOT NULL,
  `nombreusuario` varchar(50) NOT NULL,
  `claveacceso` varchar(100) NOT NULL,
  `fecharegistro` datetime NOT NULL DEFAULT current_timestamp(),
  `estado` char(1) NOT NULL DEFAULT '1',
  PRIMARY KEY (`idusuario`),
  UNIQUE KEY `uk_usu_ema` (`email`),
  KEY `fk_usu_idp` (`idpersona`),
  CONSTRAINT `fk_usu_idp` FOREIGN KEY (`idpersona`) REFERENCES `personas` (`idpersona`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4;

/*Data for the table `usuarios` */

insert  into `usuarios`(`idusuario`,`idpersona`,`email`,`nombreusuario`,`claveacceso`,`fecharegistro`,`estado`) values 
(1,1,'cusiluis@gmail.com','Luy06','$2y$10$5r8ckx/oVIYMD.NiwlI2huzXQoI2eUhXfnszinHGpJB03MXBTLulO','2023-05-27 19:33:49','1');

/* Procedure structure for procedure `spu_habitaciones_data` */

/*!50003 DROP PROCEDURE IF EXISTS  `spu_habitaciones_data` */;

DELIMITER $$

/*!50003 CREATE DEFINER=`root`@`localhost` PROCEDURE `spu_habitaciones_data`()
begin
	select 	HA.numhabitacion,
		TH.tipo
	from habitaciones HA
	inner join tipohabitaciones TH on TH.idtipohabitacion = HA.idtipohabitacion;
end */$$
DELIMITER ;

/* Procedure structure for procedure `spu_recuperar_empleados` */

/*!50003 DROP PROCEDURE IF EXISTS  `spu_recuperar_empleados` */;

DELIMITER $$

/*!50003 CREATE DEFINER=`root`@`localhost` PROCEDURE `spu_recuperar_empleados`()
begin 
	select 	EM.idempleado,
		PER.nombres
	from empleados EM
	inner join personas PER on PER.idpersona = EM.idpersona;
	
end */$$
DELIMITER ;

/* Procedure structure for procedure `spu_recuperar_habitaciones` */

/*!50003 DROP PROCEDURE IF EXISTS  `spu_recuperar_habitaciones` */;

DELIMITER $$

/*!50003 CREATE DEFINER=`root`@`localhost` PROCEDURE `spu_recuperar_habitaciones`()
BEGIN 
	select 	HA.idhabitacion, 
		TH.tipo
	from habitaciones HA
	inner join tipohabitaciones TH on TH.idtipohabitacion = HA.idtipohabitacion;
	
END */$$
DELIMITER ;

/* Procedure structure for procedure `spu_recuperar_usuarios` */

/*!50003 DROP PROCEDURE IF EXISTS  `spu_recuperar_usuarios` */;

DELIMITER $$

/*!50003 CREATE DEFINER=`root`@`localhost` PROCEDURE `spu_recuperar_usuarios`()
BEGIN 
	select idusuario, nombreusuario
	from usuarios;
	
END */$$
DELIMITER ;

/* Procedure structure for procedure `spu_reservaciones_get` */

/*!50003 DROP PROCEDURE IF EXISTS  `spu_reservaciones_get` */;

DELIMITER $$

/*!50003 CREATE DEFINER=`root`@`localhost` PROCEDURE `spu_reservaciones_get`()
BEGIN 
	SELECT 	RE.idreservacion,
		RE.numcuarto, RE.fechaentrada, RE.fechasalida,
		HA.numhabitacion, HA.piso, HA.capacidad, HA.precio

	FROM reservaciones RE
	INNER JOIN empleados EM ON EM.idempleado = RE.idempleado 
	INNER JOIN usuarios US ON US.idusuario = RE.idusuario
	INNER JOIN habitaciones HA ON HA.idhabitacion = RE.idhabitacion;
END */$$
DELIMITER ;

/* Procedure structure for procedure `spu_reservaciones_registrar` */

/*!50003 DROP PROCEDURE IF EXISTS  `spu_reservaciones_registrar` */;

DELIMITER $$

/*!50003 CREATE DEFINER=`root`@`localhost` PROCEDURE `spu_reservaciones_registrar`(
IN _idempleado		INT,
IN _idusuario 		INT,
IN _idhabitacion  	INT,
IN _numcuarto		TINYINT,
IN _fechaentrada	DATE,
IN _fechasalida		DATE,
IN _tipocomprobante	CHAR(1)
)
BEGIN
INSERT INTO reservaciones (idempleado, idusuario, idhabitacion, numcuarto, fechaentrada, 
				fechasalida, tipocomprobante) VALUES
		(_idempleado, _idusuario, _idhabitacion, _numcuarto, _fechaentrada, _fechasalida, _tipocomprobante);
		
END */$$
DELIMITER ;

/* Procedure structure for procedure `spu_usuarios_iniciarS` */

/*!50003 DROP PROCEDURE IF EXISTS  `spu_usuarios_iniciarS` */;

DELIMITER $$

/*!50003 CREATE DEFINER=`root`@`localhost` PROCEDURE `spu_usuarios_iniciarS`(IN _email VARCHAR(50))
BEGIN 

	SELECT usuarios.`idusuario`,
		personas.`apellidos`, personas.`nombres`,
		usuarios.email, usuarios.`claveacceso`
	FROM usuarios
	INNER JOIN personas ON personas.`idpersona` = usuarios.`idpersona`
	WHERE email = _email AND estado = '1';  

END */$$
DELIMITER ;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

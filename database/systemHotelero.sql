DROP DATABASE IF EXISTS sistema_hotelero;
CREATE DATABASE sistema_hotelero;
USE sistema_hotelero;


CREATE TABLE personas
(
	idpersona		INT AUTO_INCREMENT PRIMARY KEY,
	nombres 		VARCHAR(30)	NOT NULL,
	apellidos 		VARCHAR(30)	NOT NULL,
	docIdentidad	VARCHAR(50)	NOT NULL,
	telefono		CHAR(9)		NULL,
	fechaNac		DATETIME	NOT NULL
)
ENGINE = INNODB;


CREATE TABLE usuarios
(
	idusuario 		INT AUTO_INCREMENT PRIMARY KEY,
	idpersona		INT 			NOT NULL,
	nombreusuario	VARCHAR(30)		NOT NULL,
	claveacceso		VARCHAR(100)	NOT NULL

)
ENGINE = INNODB;


CREATE TABLE tipohabitaciones
(
	idtipohabitacion	INT AUTO_INCREMENT PRIMARY KEY,
	tipo				VARCHAR(30)	NOT NULL,
	descripcion			VARCHAR(80)	NOT NULL

)
ENGINE = INNODB;

CREATE TABLE habitaciones
(
	idhabitacion		INT AUTO_INCREMENT PRIMARY KEY,
	idtipohabitacion	INT 			NOT NULL,
	numcamas			TINYINT 		NOT NULL,
	numhabitacion		SMALLINT 		NOT NULL,
	piso				TINYINT			NOT NULL,
	capacidad			VARCHAR(10)		NOT NULL,
	precio				DECIMAL(5,2)	NOT NULL,
	estado				CHAR(1)			NOT NULL DEFAULT '1'
)
ENGINE = INNODB;



















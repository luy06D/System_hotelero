DROP DATABASE IF EXISTS sistema_hotelero;


CREATE DATABASE sistema_hotelero;
USE sistema_hotelero;


CREATE TABLE personas
(
	idpersona		INT AUTO_INCREMENT PRIMARY KEY,
	nombres 		VARCHAR(30)	NOT NULL,
	apellidos 		VARCHAR(30)	NOT NULL,
	dni				CHAR(8)		NOT NULL,
	telefono		CHAR(9)		NULL,
	fechaNac		DATETIME	NOT NULL,
	CONSTRAINT uk_per_tel UNIQUE(dni)
)
ENGINE = INNODB;

INSERT INTO personas (nombres, apellidos, dni, telefono, fechaNac) VALUES
			('Luis David','Cusi Gonzales','73196921','934651825','2003-09-06'),
			('Maria Cristina','Mata Salazar','78123265','965434245','2000-12-02'),
			('Daniel Roberto','Garcia Sosa','78111265','954874327','1999-01-05'),
			('Victor Jésus','Camacho Carrasco','72543987','986744652','2004-11-02');


CREATE TABLE usuarios
(
	idusuario 		INT AUTO_INCREMENT PRIMARY KEY,
	idpersona		INT 		NOT NULL,
	email			VARCHAR(50)	NOT NULL,
	nombreusuario	VARCHAR(50)	NOT NULL,
	claveacceso		VARCHAR(100)	NOT NULL,
	fecharegistro 	DATETIME 	NOT NULL DEFAULT NOW(),
	estado 			CHAR(1)		NOT NULL DEFAULT '1',
	CONSTRAINT fk_usu_idp FOREIGN KEY (idpersona) REFERENCES personas (idpersona),
	CONSTRAINT uk_usu_ema UNIQUE(email)
)
ENGINE = INNODB;

INSERT INTO usuarios (idpersona, email, nombreusuario, claveacceso) VALUES
			(1,'cusiluis@gmail.com','Luy06','12345');
			
UPDATE usuarios SET claveacceso = '$2y$10$5r8ckx/oVIYMD.NiwlI2huzXQoI2eUhXfnszinHGpJB03MXBTLulO'
WHERE idusuario = 1;



CREATE TABLE cargos
(
	idcargo		INT AUTO_INCREMENT PRIMARY KEY,
	tipo		VARCHAR(40)		NOT NULL,
	pago		DECIMAL(7,2)	NOT NULL
)
ENGINE = INNODB;

INSERT INTO cargos (tipo, pago) VALUES 
		('Recepcionista', 1600),
		('Gobernanta', 1200);
		

CREATE TABLE empleados
(
	idempleado 	INT AUTO_INCREMENT PRIMARY KEY,
	idpersona	INT 		NOT NULL,
	turno		CHAR(1)		NOT NULL, -- M(mañana) T(tarde) , N(noche)
	direccion	VARCHAR(40)	NULL,
	CONSTRAINT fk_emp_idp FOREIGN KEY (idpersona) REFERENCES personas (idpersona),
	CONSTRAINT 	ck_emp_tur CHECK (turno IN('M','T','N'))
)
ENGINE = INNODB;

INSERT INTO empleados (idpersona,turno) VALUES 
				(2,'M'),
				(2,'T'),
				(3,'N'),
				(4,'M');
				
CREATE TABLE contratos 
(
	idcontrato 	INT AUTO_INCREMENT PRIMARY KEY,
	idempleado 	INT 	NOT NULL,
	idcargo		INT 	NOT NULL,
	fechaInicio	DATE 	NOT NULL,
	fechaFin 	DATE 	NOT NULL,
	CONSTRAINT fk_con_ide FOREIGN KEY (idempleado) REFERENCES empleados (idempleado),
	CONSTRAINT fk_con_idc FOREIGN KEY (idcargo) REFERENCES cargos (idcargo)
)
ENGINE = INNODB;

INSERT INTO contratos (idempleado, idcargo, fechaInicio, fechaFin) VALUES
			(1, 1, '2023-05-30', '2024-05-30'),
			(2, 1, '2023-05-30','2024-05-30'),
			(3, 2, '2023-05-30', '2024-05-30'),
			(4, 1, '2023-05-30', '2024-05-30');
							
				
CREATE TABLE tipohabitaciones
(
	idtipohabitacion	INT AUTO_INCREMENT PRIMARY KEY,
	tipo				VARCHAR(30)	NOT NULL,
	descripcion			VARCHAR(80)	NULL
)
ENGINE = INNODB;

INSERT INTO tipohabitaciones (tipo, descripcion) VALUES
		('Individual','Habitación asignada a una persona'),
		('Doble','Habitación asignada a dos personas'),
		('Triple','Habitación asignada a tres personas'),
		('Quad','Habitación asignada a cuatro personas'),
		('Queen','Habitación con cama matrimonial'),
		('King','Habitación con una cama king-size');
		
SELECT * FROM tipohabitaciones

CREATE TABLE habitaciones
(
	idhabitacion		INT AUTO_INCREMENT PRIMARY KEY,
	idtipohabitacion	INT 		NOT NULL,
	numcamas		TINYINT 	NOT NULL,
	numhabitacion		SMALLINT 	NOT NULL,
	piso			TINYINT		NOT NULL,
	capacidad		VARCHAR(10)	NOT NULL,
	precio			DECIMAL(5,2)	NOT NULL,
	estado			VARCHAR(20)		NOT NULL DEFAULT 'Disponible', -- Disponible , Ocupado, Mantenimiento
	CONSTRAINT fk_hab_idt FOREIGN KEY (idtipohabitacion) REFERENCES tipohabitaciones (idtipohabitacion),
	CONSTRAINT ck_hab_pre CHECK (precio > 0),
	CONSTRAINT ck_hab_es CHECK (estado IN ('Disponible','Ocupado','Mantenimiento'))
)
ENGINE = INNODB;

INSERT INTO habitaciones (idtipohabitacion, numcamas, numhabitacion, piso, capacidad, precio) VALUES
			(1, 1, 110, 1, 2, 40),
			(2, 2, 111, 1, 4, 80),
			(3, 3, 120, 2, 6, 120),
			(4, 4, 128, 2, 8, 180),
			(5, 1, 156, 4, 2, 200),
			(6, 1, 145, 3, 3, 160);

SELECT * FROM contratos;			



CREATE TABLE reservaciones
(
	idreservacion		INT AUTO_INCREMENT PRIMARY KEY,
	idusuario			INT 		NOT NULL,
	idhabitacion		INT 		NOT NULL,
	idcliente			INT 		NOT NULL,
	idempleado			INT 		NOT NULL,
	fecharegistro		DATETIME 	NOT NULL DEFAULT NOW(),
	fechaentrada		DATE	 	NOT NULL,
	fechasalida			DATE 		NOT NULL,
	tipocomprobante		CHAR(1)		NOT NULL,  -- F(factura) , B(boleta)   
	fechacomprobante	DATETIME 	NOT NULL DEFAULT NOW(),
	CONSTRAINT fk_res_idu FOREIGN KEY (idusuario) REFERENCES usuarios (idusuario),
	CONSTRAINT fk_res_idh FOREIGN KEY (idhabitacion) REFERENCES habitaciones (idhabitacion),
	CONSTRAINT fk_res_idc FOREIGN KEY (idcliente) REFERENCES personas (idpersona), -- foreanea clientes de la entidad personas
	CONSTRAINT fk_res_ide FOREIGN KEY (idempleado) REFERENCES empleados (idempleado),
	CONSTRAINT ck_res_tco CHECK (tipocomprobante IN ('F','B'))
)
ENGINE = INNODB;

INSERT INTO reservaciones(idusuario, idhabitacion, idcliente, idempleado, fechaentrada, fechasalida, tipocomprobante) VALUES
	(1,1,4,1,'2023-05-25','2023-05-30', 'B'),
	(1,2,2,4,'2023-06-25','2023-06-30', 'B'),
	(1,3,1,1,'2023-05-25','2023-05-27', 'B'),
	(1,4,1,4,'2023-05-25','2023-06-01', 'B'),
	(1,5,3,2,'2023-05-27','2023-06-07', 'B');

SELECT * FROM reservaciones;
	
CREATE TABLE pagos
(
	idpago				INT AUTO_INCREMENT PRIMARY KEY,
	idreservacion		INT 		NOT NULL,
	fechapago			DATETIME 	NOT NULL DEFAULT NOW(),
	mediopago			VARCHAR(20)	NOT NULL, -- Efectivo, Tarjeta bancaria, Yape , Paypal
	CONSTRAINT fk_con_idr FOREIGN KEY (idreservacion) REFERENCES reservaciones(idreservacion)
)
ENGINE = INNODB;

INSERT INTO pagos (idreservacion, mediopago) VALUES
	(1, 'Tarjeta bancaria'),
	(2, 'Efectivo'),
	(3, 'Tarjeta bancaria'),
	(4, 'Efectivo'),
	(5, 'Efectivo');



-- PROCEDIMIENTOS ALMACENADOS

-- INICIO DE SESIÓN

DELIMITER $$
CREATE PROCEDURE spu_usuarios_iniciarS (IN _email VARCHAR(50))
BEGIN 

	SELECT usuarios.`idusuario`,
		personas.`apellidos`, personas.`nombres`,
		usuarios.email, usuarios.`claveacceso`
	FROM usuarios
	INNER JOIN personas ON personas.`idpersona` = usuarios.`idpersona`
	WHERE email = _email AND estado = '1';  

END$$

CALL spu_usuarios_iniciarS('cusiluis@gmail.com');


-- MOSTRAR LAS RESERVACIONES

DELIMITER $$
CREATE PROCEDURE spu_reservaciones_get()
BEGIN 
	SELECT 	RE.idreservacion,
			CONCAT (CLI.nombres, ' ' , CLI.apellidos) AS cliente,
			RE.fechaentrada, RE.fechasalida,
			HA.numhabitacion, HA.piso, HA.capacidad, HA.precio

	FROM reservaciones RE
	INNER JOIN empleados EM ON EM.idempleado = RE.idempleado 
	INNER JOIN personas CLI ON CLI.idpersona = RE.idcliente
	INNER JOIN habitaciones HA ON HA.idhabitacion = RE.idhabitacion
	ORDER BY RE.idreservacion;
END $$

CALL spu_reservaciones_get();


-- MOSTRAR PAGOS 
DELIMITER $$ 
CREATE PROCEDURE spu_pagos_get()
BEGIN 
	SELECT 	CONCAT (CLI.nombres, ' ', CLI.apellidos) AS cliente,
			PA.fechapago, PA.mediopago,
			HA.precio AS montoPagado
			
			
	FROM pagos PA
	INNER JOIN reservaciones RE ON RE.idreservacion = PA.idreservacion
	INNER JOIN personas CLI ON CLI.idpersona = RE.idcliente
	INNER JOIN habitaciones HA ON HA.idhabitacion = RE.idhabitacion;
END $$

CALL spu_pagos_get();


-- RECUPERAR EMPLEADOS
DELIMITER $$
CREATE PROCEDURE spu_recuperar_empleados()
BEGIN 
	SELECT 	EM.idempleado,
		PER.nombres
	FROM empleados EM
	INNER JOIN personas PER ON PER.idpersona = EM.idpersona;
	
END $$

CALL spu_recuperar_empleados();

-- RECUPERAR CLIENTES
DELIMITER $$
CREATE PROCEDURE spu_recuperar_clientes(IN _dni	CHAR(8))
BEGIN
	SELECT idpersona,
	CONCAT(nombres , ' ' , apellidos) AS clientes
	FROM personas
	WHERE dni = _dni;
	
END $$

CALL spu_recuperar_clientes('73196921');
SELECT * FROM personas

-- RECUPERAR USUARIOS

DELIMITER $$
CREATE PROCEDURE spu_recuperar_usuarios()
BEGIN 
	SELECT idusuario, nombreusuario
	FROM usuarios;
	
END $$

CALL spu_recuperar_usuarios();

-- RECUPERAR HABITACIONES

DELIMITER $$
CREATE PROCEDURE spu_recuperar_habitaciones()
BEGIN 
	SELECT 	HA.idhabitacion, 
		TH.tipo
	FROM habitaciones HA
	INNER JOIN tipohabitaciones TH ON TH.idtipohabitacion = HA.idtipohabitacion;
	
END $$

CALL spu_recuperar_habitaciones();

-- REGISTRAR RESERVACIONES

DELIMITER $$
CREATE PROCEDURE spu_reservaciones_registrar
(
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
		
END $$

CALL spu_reservaciones_registrar(3,1,2,1,'2023-06-01','2023-06-10','B');

-- MOSTRAR DATOS DE HABITACION

DELIMITER $$
CREATE PROCEDURE spu_habitaciones_data()
BEGIN
	SELECT 	HA.numhabitacion,
		TH.tipo, HA.estado
	FROM habitaciones HA
	INNER JOIN tipohabitaciones TH ON TH.idtipohabitacion = HA.idtipohabitacion;
END $$

CALL spu_habitaciones_data();

--  LISTAR USUARIO

DELIMITER $$ 
CREATE PROCEDURE spu_listar_usuarios()
BEGIN
	SELECT 	US.idusuario,
			PE.nombres, PE.apellidos,
			US.email, US.nombreusuario
			
	FROM usuarios US
	INNER JOIN personas PE ON PE.idpersona = US.idpersona;
END $$

CALL spu_listar_usuarios();

-- GRAFICO 

DELIMITER $$ 
CREATE PROCEDURE spu_mostrar_grafico()
BEGIN 

	SELECT 	PA.fechapago, 
			HA.precio AS montoPagado
			
	FROM pagos PA
	INNER JOIN reservaciones RE ON RE.idreservacion = PA.idreservacion
	INNER JOIN personas CLI ON CLI.idpersona = RE.idcliente
	INNER JOIN habitaciones HA ON HA.idhabitacion = RE.idhabitacion;
		
	
END $$























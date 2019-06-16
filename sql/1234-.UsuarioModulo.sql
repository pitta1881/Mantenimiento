

USE Mantenimiento;

CREATE TABLE roles (
    idRol INTEGER PRIMARY KEY AUTO_INCREMENT,
    nombreRol VARCHAR(20) NOT NULL

);

USE Mantenimiento;

CREATE TABLE permisos (
    idPermiso INTEGER PRIMARY KEY AUTO_INCREMENT,
    nombrePermiso VARCHAR(20) NOT NULL
);





USE Mantenimiento;
CREATE TABLE usuarios(
 nombre VARCHAR(11) PRIMARY KEY , 
 password VARCHAR(11) NOT NULL,
 idRol Integer(8),
 idPersona	Integer(8),
 
 FOREIGN KEY (idRol) REFERENCES roles(idRol),
 FOREIGN KEY (idPersona) REFERENCES personas(dni)
 );
 
 
 USE Mantenimiento;

CREATE TABLE personas (
    dni INTEGER(8) PRIMARY KEY,
    apellido VARCHAR(20) NOT NULL,
    nombre VARCHAR(20) NOT NULL,
    direccion TEXT NOT NULL,
    fecha_nacimiento DATE NOT NULL,
    email TEXT NOT NULL,
	idUsuario VARCHAR(11),
	
	FOREIGN KEY (idUsuario) REFERENCES usuarios(nombre)
);

USE Mantenimiento;
CREATE TABLE rolesxpermisos (

    idRol INTEGER,
    idPermiso INTEGER,
    PRIMARY KEY (idRol,idPermiso),
    FOREIGN KEY (idRol) REFERENCES roles(idRol),
    FOREIGN KEY (idPermiso) REFERENCES permisos(idPermiso)
);

USE Mantenimiento;

CREATE TABLE rolesxusuarios (

   nombre VARCHAR(11),
    idRol INTEGER,
    PRIMARY KEY (idRol,nombre),
    FOREIGN KEY (idRol) REFERENCES roles(idRol),
    FOREIGN KEY (nombre) REFERENCES usuarios(nombre)
);

INSERT INTO `permisos` (`idPermiso`, `nombrePermiso`) VALUES
(1, 'alta usuario'),
(2, 'baja usuario'),
(3, 'modificar usuario'),
(4, 'visualizar usuario'),
(5, 'alta permisos'),
(6, 'baja permisos'),
(7, 'modificar permisos'),
(8, 'visualizar permisos'),
(9, 'alta roles'),
(10, 'baja roles'),
(11, 'modificar roles'),
(12, 'visualizar roles'),
(13, 'alta pedidos'),
(14, 'baja pedidos'),
(15, 'modificar pedidos'),
(16, 'visualizar pedidos'),
(17, 'alta tareas'),
(18, 'baja tareas'),
(19, 'modificar tareas'),
(20, 'visualizar tareas'),
(21, 'alta ot'),
(22, 'baja ot'),
(23, 'modificar ot'),
(24, 'visualizar ot'),
(25, 'alta sectores'),
(26, 'baja sectores'),
(27, 'modificar sectores'),
(28, 'visualizar sectores'),
(29, 'alta agentes'),
(30, 'baja agentes'),
(31, 'modificar agentes'),
(32, 'visualizar agentes'),
(33, 'alta especialidades'),
(34, 'baja especialidades'),
(35, 'modificar especialid'),
(36, 'visualizar especiali'),
(37, 'alta eventos'),
(38, 'baja eventos'),
(39, 'modificar eventos'),
(40, 'visualizar eventos'),
(41, 'alta insumos'),
(42, 'baja insumos'),
(43, 'modificar insumos'),
(44, 'visualizar insumos');


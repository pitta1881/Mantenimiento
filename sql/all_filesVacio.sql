CREATE SCHEMA Mantenimiento;USE mantenimiento;
CREATE TABLE usuarios 
 ( nombre VARCHAR(11) PRIMARY KEY , 
 password VARCHAR(11) NOT NULL ) ;USE mantenimiento;

CREATE TABLE sectores (
    idSector INTEGER AUTO_INCREMENT,
    nombreSector TEXT NOT NULL,
    tipo TEXT NOT NULL,
    responsable TEXT NOT NULL,
    telefono integer ,
    email varchar(20),
    PRIMARY KEY (idSector)
);USE Mantenimiento;

CREATE TABLE pedido
(
    id INTEGER AUTO_INCREMENT,
    idSector INTEGER NOT NULL,
    descripcion TEXT NOT NULL,
    estado TEXT NOT NULL,
    fechaInicio DATE NOT NULL,
    fechaFin DATE,
    prioridad TEXT NOT NULL,
    nombreUsuario varchar (11) NOT NULL,
    PRIMARY KEY (id),
    FOREIGN KEY (idSector) REFERENCES sectores(idSector),
    FOREIGN KEY (nombreUsuario) REFERENCES usuarios (nombre)
);
USE Mantenimiento;

CREATE TABLE especializacion (
    idEspecializacion INTEGER PRIMARY KEY AUTO_INCREMENT,
    nombre varchar not null
(20)
    );USE mantenimiento;
CREATE TABLE tarea
(
    idTarea integer NOT NULL,
    idPedido integer NOT NULL,
    idEspecializacion integer NOT NULL,
    estado TEXT NOT NULL,
    descripcion TEXT NOT NULL,
    prioridad TEXT NOT NULL,
    PRIMARY KEY (idTarea,idPedido),
    FOREIGN KEY (idPedido) REFERENCES pedido(id) ON DELETE CASCADE,
    FOREIGN KEY (idEspecializacion) REFERENCES especializacion(idEspecializacion) ON DELETE CASCADE
) ;USE mantenimiento;
CREATE TABLE rol
(
   idRol INTEGER PRIMARY KEY auto_increment,
   nombreRol TEXT NOT NULL
 ) ;USE Mantenimiento;

CREATE TABLE OrdenDeTrabajo
(
    idOT INTEGER
    AUTO_INCREMENT,
    fechaInicio DATE NOT NULL,
    fechaFin DATE,
    estado TEXT NOT NULL,
    PRIMARY KEY
    (idOT)
);
USE mantenimiento;
CREATE TABLE itemOT
(
    idTarea integer,
    idPedido integer,
    idOT integer,
    PRIMARY KEY (idTarea,idPedido,idOT),
    FOREIGN KEY (idTarea,idPedido) REFERENCES tarea(idTarea,idPedido),
    FOREIGN KEY (idOT) REFERENCES OrdenDeTrabajo(idOT)
) ;USE mantenimiento;

CREATE TABLE insumos (
    idInsumo INTEGER AUTO_INCREMENT,
    nombreInsumo VARCHAR(11) NOT NULL,
    descripcion TEXT NOT NULL,
    PRIMARY KEY (idInsumo)
);USE Mantenimiento;

CREATE TABLE agentes(
    idAgente INTEGER AUTO_INCREMENT,
    nombre VARCHAR (20) NOT NULL,
    apellido VARCHAR (20) NOT NULL,
    idEspecializacion INTEGER,
    disponible BOOLEAN NOT NULL DEFAULT TRUE,
    PRIMARY KEY (idAgente), 
    FOREIGN KEY (idEspecializacion) REFERENCES especializacion (idEspecializacion)
);USE mantenimiento;
CREATE TABLE itemAgente
(
    idTarea integer,
    idPedido integer,
    idAgente integer,
    PRIMARY KEY (idTarea,idPedido,idAgente),
    FOREIGN KEY (idTarea,idPedido) REFERENCES tarea(idTarea,idPedido),
    FOREIGN KEY (idAgente) REFERENCES agentes(idAgente)
) ;USE mantenimiento;

CREATE TABLE eventos (
    idEvento INTEGER AUTO_INCREMENT,
    nombreEvento varchar(20) NOT NULL,
    descripcion TEXT NOT NULL,
    fechaInicio DATE NOT NULL,
    fechaFin DATE NOT NULL,
    PRIMARY KEY (idEvento,nombreEvento)
);
CREATE SCHEMA Mantenimiento;
USE mantenimiento;
CREATE TABLE usuarios 
 ( nombre VARCHAR(11) PRIMARY KEY , 
 password VARCHAR(11) NOT NULL ) ;
 USE mantenimiento;
 CREATE TABLE rol
(
   idRol INTEGER PRIMARY KEY auto_increment,
   nombreRol TEXT NOT NULL
 ) ;
 USE mantenimiento;
 CREATE TABLE pedido
(
    id INTEGER
    AUTO_INCREMENT,
    descripcion TEXT NOT NULL,
    estado TEXT NOT NULL,
    fechaInicio TEXT NOT NULL,
    fechaFin TEXT,
    prioridad TEXT NOT NULL,
    sector TEXT NOT NULL,
    nombreUsuario varchar
    (11) NOT NULL,
    PRIMARY KEY
    (id),
    FOREIGN KEY
    (nombreUsuario) REFERENCES usuarios
    (nombre)
);
USE mantenimiento;
CREATE TABLE tarea
(
    idTarea integer,
    idPedido integer,
    estado TEXT NOT NULL,
    descripcion TEXT NOT NULL,
    prioridad TEXT NOT NULL,
    especializacion TEXT NOT NULL,
    PRIMARY KEY (idTarea,idPedido),
    FOREIGN KEY (idPedido) REFERENCES pedido(id) ON DELETE CASCADE
) ;
USE mantenimiento;
CREATE TABLE OrdenDeTrabajo
(
    idOT INTEGER
    AUTO_INCREMENT,
    fechaInicio TEXT NOT NULL,
    fechaFin TEXT,
    estado TEXT NOT NULL,
    PRIMARY KEY (idOT)
);
USE mantenimiento;
CREATE TABLE itemOT
(
    idItem integer auto_increment,
    idTarea integer,
    idPedido integer,
    idOT integer,
    PRIMARY KEY (idItem,idTarea,idPedido,idOT),
    FOREIGN KEY (idTarea) REFERENCES tarea(idTarea),
    FOREIGN KEY (idPedido) REFERENCES pedido(id),
    FOREIGN KEY (idOT) REFERENCES OrdenDeTrabajo(idOT)
) ;

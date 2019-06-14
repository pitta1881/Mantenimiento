USE Mantenimiento;

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

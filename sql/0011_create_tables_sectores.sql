USE mantenimiento;

CREATE TABLE sectores (
    idSector INTEGER AUTO_INCREMENT,
    nombreSector VARCHAR(11) NOT NULL,
    tipo TEXT NOT NULL,
    responsable TEXT NOT NULL,
    telefono integer ,
    email varchar(20),
    PRIMARY KEY (idSector)
);
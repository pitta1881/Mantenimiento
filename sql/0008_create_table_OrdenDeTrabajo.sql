USE Mantenimiento;

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

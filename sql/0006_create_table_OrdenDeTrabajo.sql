USE Mantenimiento;

CREATE TABLE OrdenDeTrabajo
(
    idOT INTEGER
    AUTO_INCREMENT,
    fechaInicio TEXT NOT NULL,
    fechaFin TEXT,
    estado TEXT NOT NULL,
    PRIMARY KEY (idOT)
);

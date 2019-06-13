USE mantenimiento;

CREATE TABLE eventos (
    idEvento INTEGER AUTO_INCREMENT,
    nombreEvento TEXT NOT NULL,
    descripcion TEXT NOT NULL,
    fechaInicio DATE NOT NULL,
    fechaFin DATE NOT NULL,
    PRIMARY KEY (idEvento,nombreEvento)
);
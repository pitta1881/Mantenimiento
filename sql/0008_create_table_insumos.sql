USE mantenimiento;

CREATE TABLE insumos (
    idInsumo INTEGER AUTO_INCREMENT,
    nombreInsumo VARCHAR(11) NOT NULL,
    descripcion TEXT NOT NULL,
    PRIMARY KEY (idInsumo)
);
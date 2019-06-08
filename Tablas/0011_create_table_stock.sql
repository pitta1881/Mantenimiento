USE mantenimiento;

CREATE TABLE stock (
    idInsumo INTEGER;
    cantidad INTEGER NOT NULL;
    fecha date NOT NULL;
    PRIMARY KEY (idInsumo);
    FOREIGN KEY (idInsumo) REFERENCES insumos(idInsumos);
);
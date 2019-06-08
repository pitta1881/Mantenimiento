USE mantenimiento;

CREATE TABLE movimiento (
    idMovimiento INTEGER;
    idInsumo INTEGER;
    fecha: date NOT NULL;
    tipoMovimiento VARCHAR(10) NOT NULL;
    oldCantidad integer NOT NULL;
    newCantidad integer NOT NULL;
    PRIMARY KEY (idMovimiento,idInsumo);
    FOREIGN KEY (idInsumo) REFERENCES insumos(idInsumos);
);
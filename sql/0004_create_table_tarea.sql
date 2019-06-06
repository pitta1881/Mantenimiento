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
    /*idOrdenDeTrabajo integer PRIMARY KEY,*/
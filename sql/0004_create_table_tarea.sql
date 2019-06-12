USE mantenimiento;
CREATE TABLE tarea
(
    idTarea integer NOT NULL,
    idPedido integer NOT NULL,
    idEspecializacion integer NOT NULL,
    estado TEXT NOT NULL,
    descripcion TEXT NOT NULL,
    prioridad TEXT NOT NULL,
    PRIMARY KEY (idTarea,idPedido),
    FOREIGN KEY (idPedido) REFERENCES pedido(id) ON DELETE CASCADE,
    FOREIGN KEY (idEspecializacion) REFERENCES especializacion(idEspecializacion) ON DELETE CASCADE
) ;
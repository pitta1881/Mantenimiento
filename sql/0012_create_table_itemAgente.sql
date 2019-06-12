USE mantenimiento;
CREATE TABLE itemAgente
(
    idTarea integer,
    idPedido integer,
    idAgente integer,
    PRIMARY KEY (idTarea,idPedido,idAgente),
    FOREIGN KEY (idTarea) REFERENCES tarea(idTarea),
    FOREIGN KEY (idPedido) REFERENCES pedido(id),
    FOREIGN KEY (idAgente) REFERENCES agentes(idAgente)
) ;
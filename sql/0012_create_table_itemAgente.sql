USE mantenimiento;
CREATE TABLE itemAgente
(
    idTarea integer,
    idPedido integer,
    idAgente integer,
    PRIMARY KEY (idTarea,idPedido,idAgente),
    FOREIGN KEY (idTarea,idPedido) REFERENCES tarea(idTarea,idPedido),
    FOREIGN KEY (idAgente) REFERENCES agentes(idAgente)
) ;
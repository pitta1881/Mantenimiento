USE mantenimiento;
CREATE TABLE itemOT
(
    idTarea integer,
    idPedido integer,
    idOT integer,
    PRIMARY KEY (idTarea,idPedido,idOT),
    FOREIGN KEY (idTarea) REFERENCES tarea(idTarea),
    FOREIGN KEY (idPedido) REFERENCES pedido(id),
    FOREIGN KEY (idOT) REFERENCES OrdenDeTrabajo(idOT)
) ;
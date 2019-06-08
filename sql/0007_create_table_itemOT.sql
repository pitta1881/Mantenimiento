USE mantenimiento;
CREATE TABLE itemOT
(
    idItem integer auto_increment,
    idTarea integer,
    idPedido integer,
    idOT integer,
    PRIMARY KEY (idItem,idTarea,idPedido,idOT),
    FOREIGN KEY (idTarea) REFERENCES tarea(idTarea),
    FOREIGN KEY (idPedido) REFERENCES pedido(id),
    FOREIGN KEY (idOT) REFERENCES OrdenDeTrabajo(idOT)
) ;
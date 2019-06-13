USE mantenimiento;
CREATE TABLE itemOT
(
    idTarea integer,
    idPedido integer,
    idOT integer,
    PRIMARY KEY (idTarea,idPedido,idOT),
    FOREIGN KEY (idTarea,idPedido) REFERENCES tarea(idTarea,idPedido),
    FOREIGN KEY (idOT) REFERENCES OrdenDeTrabajo(idOT)
) ;
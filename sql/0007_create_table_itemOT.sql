USE mantenimiento;
CREATE TABLE itemOT
(
    idItem integer,
    idTarea integer,
    idOT integer,
    PRIMARY KEY (idItem,idTarea,idOT),
    FOREIGN KEY (idTarea) REFERENCES tarea(idTarea),
    FOREIGN KEY (idOT) REFERENCES OrdenDeTrabajo(idOT)    
) ;
USE Mantenimiento;

CREATE TABLE agentes(
    idAgente INTEGER AUTO_INCREMENT,
    nombre VARCHAR (20) NOT NULL,
    apellido VARCHAR (20) NOT NULL,
    idEspecializacion INTEGER,
    disponible BOOLEAN NOT NULL DEFAULT TRUE,
    PRIMARY KEY (idAgente), 
    FOREIGN KEY (idEspecializacion) REFERENCES especializacion (idEspecializacion)
);
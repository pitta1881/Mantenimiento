USE Mantenimiento;

CREATE TABLE agentes (
    idAgente INTEGER AUTO INCREMENTAL;
    nombre VARCHAR(20) NOT NULL;
    apellido VARCHAR(20) NOT NULL;
    idEspecializacion INTEGER;
    PRIMARY KEY (idAgente);
    FOREIGN KEY (idEspecializacion) REFERENCES especializaciones(idEspecializacion)
);
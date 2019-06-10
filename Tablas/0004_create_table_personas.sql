USE mantenimiento;

CREATE TABLE personas (
    dni INTEGER(8) PRIMARY KEY,
    apellido VARCHAR(20) NOT NULL,
    nombre VARCHAR(20) NOT NULL,
    direccion TEXT NOT NULL,
    fecha_nacimiento DATE NOT NULL,
    email TEXT NOT NULL
);
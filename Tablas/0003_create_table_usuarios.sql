USE mantenimiento;
CREATE TABLE usuarios (
    idUsuario INTEGER;
    nombreUser VARCHAR(11) NOT NULL;
    password VARCHAR(11) NOT NULL;
    fechaAlta date;
    idRol INTEGER;
    dni INTEGER;
    PRIMARY KEY (idUsuario);
    FOREIGN KEY (idRol) REFERENCES roles(idRol);
    FOREIGN KEY (dni) REFERENCES personas(dni)
);
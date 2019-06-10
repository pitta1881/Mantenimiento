USE Mantenimiento;

CREATE TABLE rolesxpermisos (
    idRol INTEGER;
    idPermiso INTEGER;
    PRIMARY KEY (idRol,idPermiso),
    FOREIGN KEY (idRol) REFERENCES roles(idRol),
    FOREIGN KEY (idPermiso) REFERENCES permisos(idPermiso)
);
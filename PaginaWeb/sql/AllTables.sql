USE Mantenimiento;
CREATE TABLE roles (
    idRol INTEGER PRIMARY KEY AUTO_INCREMENT,
    nombreRol VARCHAR(20) NOT NULL
);
INSERT INTO `roles` (`nombreRol`)
VALUES ('superAdmin'),
    ('Operador');
USE Mantenimiento;
CREATE TABLE permisos (
    idPermiso INTEGER PRIMARY KEY AUTO_INCREMENT,
    nombrePermiso VARCHAR(20) NOT NULL
);
USE Mantenimiento;
CREATE TABLE personas (
    dni INTEGER(8) PRIMARY KEY,
    apellido VARCHAR(20) NOT NULL,
    nombre VARCHAR(20) NOT NULL,
    direccion TEXT,
    fecha_nacimiento DATE,
    email TEXT,
    estado TEXT
);
INSERT INTO `personas`
VALUES (
        00000000,
        'superAdmin',
        'superAdmin',
        NULL,
        NULL,
        NULL,
        'Activo'
    );
USE Mantenimiento;
CREATE TABLE usuarios(
    nombre VARCHAR(11) PRIMARY KEY,
    password VARCHAR(11) NOT NULL,
    idRol Integer(8),
    idPersona Integer(8),
    FOREIGN KEY (idRol) REFERENCES roles(idRol),
    FOREIGN KEY (idPersona) REFERENCES personas(dni)
);
INSERT INTO `usuarios`
VALUES ('admin', 'admin', 1, 00000000);
USE Mantenimiento;
CREATE TABLE rolesxpermisos (
    idRol INTEGER,
    idPermiso INTEGER,
    PRIMARY KEY (idRol, idPermiso),
    FOREIGN KEY (idRol) REFERENCES roles(idRol),
    FOREIGN KEY (idPermiso) REFERENCES permisos(idPermiso)
);
INSERT INTO `permisos` (`nombrePermiso`)
VALUES ('alta usuario'),
    ('baja usuario'),
    ('modificar usuario'),
    ('visualizar usuario'),
    ('alta permisos'),
    ('baja permisos'),
    ('modificar permisos'),
    ('visualizar permisos'),
    ('alta roles'),
    ('baja roles'),
    ('modificar roles'),
    ('visualizar roles'),
    ('alta pedidos'),
    ('baja pedidos'),
    ('modificar pedidos'),
    ('visualizar pedidos'),
    ('alta tareas'),
    ('baja tareas'),
    ('modificar tareas'),
    ('visualizar tareas'),
    ('alta ot'),
    ('baja ot'),
    ('modificar ot'),
    ('visualizar ot'),
    ('alta sectores'),
    ('baja sectores'),
    ('modificar sectores'),
    ('visualizar sectores'),
    ('alta agentes'),
    ('baja agentes'),
    ('modificar agentes'),
    ('visualizar agentes'),
    ('alta especialidades'),
    ('baja especialidades'),
    ('modificar especialid'),
    ('visualizar especiali'),
    ('alta eventos'),
    ('baja eventos'),
    ('modificar eventos'),
    ('visualizar eventos'),
    ('alta insumos'),
    ('baja insumos'),
    ('modificar insumos'),
    ('visualizar insumos'),
    ('alta persona'),
    ('baja persona'),
    ('modificar persona'),
    ('visualizar persona'),
    ('alta oc'),
    ('baja oc'),
    ('modificar oc'),
    ('visualizar oc');
USE mantenimiento;
CREATE TABLE sectores (
    idSector INTEGER AUTO_INCREMENT,
    nombreSector TEXT NOT NULL,
    tipo TEXT NOT NULL,
    responsable TEXT NOT NULL,
    telefono integer,
    email varchar(20),
    PRIMARY KEY (idSector)
);
USE Mantenimiento;
CREATE TABLE pedido (
    id INTEGER AUTO_INCREMENT,
    idSector INTEGER NOT NULL,
    descripcion TEXT NOT NULL,
    estado TEXT NOT NULL,
    fechaInicio DATE NOT NULL,
    fechaFin DATE,
    prioridad TEXT NOT NULL,
    nombreUsuario varchar (11) NOT NULL,
    PRIMARY KEY (id),
    FOREIGN KEY (idSector) REFERENCES sectores(idSector),
    FOREIGN KEY (nombreUsuario) REFERENCES usuarios (nombre)
);
USE Mantenimiento;
CREATE TABLE especializacion (
    idEspecializacion INTEGER PRIMARY KEY AUTO_INCREMENT,
    nombre varchar(20)
);
USE mantenimiento;
CREATE TABLE tarea (
    idTarea integer NOT NULL,
    idPedido integer NOT NULL,
    idEspecializacion integer NOT NULL,
    estado TEXT NOT NULL,
    descripcion TEXT NOT NULL,
    prioridad TEXT NOT NULL,
    PRIMARY KEY (idTarea, idPedido),
    FOREIGN KEY (idPedido) REFERENCES pedido(id) ON DELETE CASCADE,
    FOREIGN KEY (idEspecializacion) REFERENCES especializacion(idEspecializacion) ON DELETE CASCADE
);
USE Mantenimiento;
CREATE TABLE OrdenDeTrabajo (
    idOT INTEGER AUTO_INCREMENT,
    fechaInicio DATE NOT NULL,
    fechaFin DATE,
    estado TEXT NOT NULL,
    PRIMARY KEY (idOT)
);
USE mantenimiento;
CREATE TABLE itemOT (
    idTarea integer,
    idPedido integer,
    idOT integer,
    PRIMARY KEY (idTarea, idPedido, idOT),
    FOREIGN KEY (idTarea, idPedido) REFERENCES tarea(idTarea, idPedido),
    FOREIGN KEY (idOT) REFERENCES OrdenDeTrabajo(idOT)
);
USE mantenimiento;
CREATE TABLE insumo (
    idInsumo INTEGER AUTO_INCREMENT,
    nombreInsumo TEXT NOT NULL,
    descripcion TEXT NOT NULL,
    stock INTEGER NOT NULL default 0,
    stockMinimo Integer NOT NULL default 0,
    PRIMARY KEY (idInsumo)
);
USE Mantenimiento;
CREATE TABLE agentes(
    idAgente INTEGER,
    idEspecializacion INTEGER,
    disponible BOOLEAN NOT NULL DEFAULT TRUE,
    PRIMARY KEY (idAgente),
    FOREIGN KEY (idEspecializacion) REFERENCES especializacion (idEspecializacion),
    FOREIGN KEY (idAgente) REFERENCES personas(dni)
);
USE mantenimiento;
CREATE TABLE itemAgente (
    idTarea integer,
    idPedido integer,
    idAgente integer,
    PRIMARY KEY (idTarea, idPedido, idAgente),
    FOREIGN KEY (idTarea, idPedido) REFERENCES tarea(idTarea, idPedido),
    FOREIGN KEY (idAgente) REFERENCES agentes(idAgente)
);
USE mantenimiento;
CREATE TABLE eventos (
    idEvento INTEGER AUTO_INCREMENT,
    nombreEvento varchar(20) NOT NULL,
    descripcion TEXT NOT NULL,
    fechaInicio DATE NOT NULL,
    fechaFin DATE NOT NULL,
    PRIMARY KEY (idEvento, nombreEvento)
);
USE mantenimiento;
CREATE TABLE itemInsumo (
    idTarea integer,
    idPedido integer,
    idInsumo integer,
    cantidad integer not null default 0,
    PRIMARY KEY (idTarea, idPedido, idInsumo),
    FOREIGN KEY (idTarea, idPedido) REFERENCES tarea(idTarea, idPedido),
    FOREIGN KEY (idInsumo) REFERENCES insumo(idInsumo)
);
USE mantenimiento;
CREATE TABLE movimiento (
    idMovimiento INTEGER AUTO_INCREMENT,
    idInsumo INTEGER,
    idPedido Integer,
    idTarea Integer,
    fechaMovimiento date NOT NULL,
    tipoMovimiento BOOLEAN NOT NULL,
    oldStock integer NOT NULL,
    newStock integer NOT NULL,
    nombreUsuario varchar (11) NOT NULL,
    descripcion TEXT,
    PRIMARY KEY (idMovimiento, idInsumo),
    FOREIGN KEY (idInsumo) REFERENCES insumo(idInsumo),
    FOREIGN KEY (nombreUsuario) REFERENCES usuarios (nombre)
);
USE mantenimiento;
CREATE TABLE historialEstado (
    idHistorial INTEGER,
    idTarea INTEGER,
    idPedido INTEGER,
    fecha DATETIME NOT NULL,
    estado TEXT NOT NULL,
    descripcion TEXT,
    PRIMARY KEY (idPedido, idTarea, idHistorial),
    FOREIGN KEY (idPedido, idTarea) REFERENCES tarea(idPedido, idTarea)
);
USE Mantenimiento;
CREATE TABLE OrdenDeCompra (
    idOC INTEGER AUTO_INCREMENT,
    fecha DATE NOT NULL,
    costoEstimado Integer NOT NULL default 0,
    estado TEXT NOT NULL,
    PRIMARY KEY (idOC)
);
USE mantenimiento;
CREATE TABLE itemOC (
    idInsumo integer,
    idOC integer,
    cantidad integer not null default 0,
    cantidadIngresada integer not null default 0,
    PRIMARY KEY (idInsumo, idOC),
    FOREIGN KEY (idInsumo) REFERENCES insumo(idInsumo),
    FOREIGN KEY (idOC) REFERENCES OrdenDeCompra(idOC)
);
INSERT INTO `rolesxpermisos` (`idRol`, `idPermiso`)
VALUES (1, 1),
    (1, 2),
    (1, 3),
    (1, 4),
    (1, 5),
    (1, 6),
    (1, 7),
    (1, 8),
    (1, 9),
    (1, 10),
    (1, 11),
    (1, 12),
    (1, 13),
    (1, 14),
    (1, 15),
    (1, 16),
    (1, 17),
    (1, 18),
    (1, 19),
    (1, 20),
    (1, 21),
    (1, 22),
    (1, 23),
    (1, 24),
    (1, 25),
    (1, 26),
    (1, 27),
    (1, 28),
    (1, 29),
    (1, 30),
    (1, 31),
    (1, 32),
    (1, 33),
    (1, 34),
    (1, 35),
    (1, 36),
    (1, 37),
    (1, 38),
    (1, 39),
    (1, 40),
    (1, 41),
    (1, 42),
    (1, 43),
    (1, 44),
    (1, 45),
    (1, 46),
    (1, 47),
    (1, 48),
    (1, 49),
    (1, 50),
    (1, 51),
    (1, 52);
INSERT INTO `rolesxpermisos` (`idRol`, `idPermiso`)
VALUES (2, 13),
    (2, 14),
    (2, 15),
    (2, 16),
    (2, 17),
    (2, 18),
    (2, 19),
    (2, 20),
    (2, 21),
    (2, 22),
    (2, 23),
    (2, 24),
    (2, 25),
    (2, 26),
    (2, 27),
    (2, 28),
    (2, 29),
    (2, 30),
    (2, 31),
    (2, 32),
    (2, 33),
    (2, 34),
    (2, 35),
    (2, 36),
    (2, 37),
    (2, 38),
    (2, 39),
    (2, 40),
    (2, 41),
    (2, 42),
    (2, 43),
    (2, 44),
    (2, 49),
    (2, 50),
    (2, 51),
    (2, 52);
INSERT INTO `especializacion` (`nombre`)
VALUES ('Plomeria'),
    ('Albanileria'),
    ('Pintureria'),
    ('Electricidad'),
    ('Mecanico'),
    ('Herreria'),
    ('Restauracion'),
    ('Carpinteria'),
    ('General');
INSERT INTO `insumo` (
        `nombreInsumo`,
        `descripcion`,
        `stock`,
        `stockMinimo`
    )
VALUES ('tornillo', 'cruz chico', 100, 100),
    ('tornillo', 'cruz mediano', 200, 100),
    ('tornillo', 'cruz largo', 150, 100),
    ('tornillo', 'liso chico', 200, 100),
    ('tornillo', 'liso mediano', 340, 100),
    ('tornillo', 'liso largo', 450, 100),
    ('clavo', 'madero corto', 450, 100),
    ('clavo', 'madero mediano', 550, 100),
    ('clavo', 'madero largo', 50, 100),
    ('clavo', 'chapa corto', 150, 100),
    ('clavo', 'chapa mediano', 250, 100),
    ('clavo', 'chapa largo', 25, 100),
    ('tuerca', 'chica', 150, 50),
    ('tuerca', 'mediana', 250, 50),
    ('tuerca', 'grande', 0, 50),
    ('fisher', 'chico', 0, 100),
    ('fisher', 'mediano', 12, 100),
    ('fisher', 'grande', 321, 100),
    ('codo', '24cm', 50, 25),
    ('codo', 'en T 12cm', 20, 25),
    ('codo', 'en L 5cm', 44, 25),
    ('Lampara Led', '40w caliente', 5, 5),
    ('Lampara Led', '40w fria', 10, 5),
    ('Lampara Led', '5w caliente', 2, 5),
    ('Lampara Led', '5w fria', 8, 5);
INSERT INTO `personas` (
        `dni`,
        `apellido`,
        `nombre`,
        `direccion`,
        `fecha_nacimiento`,
        `email`,
        `estado`
    )
VALUES (
        22456368,
        'Lombardo',
        'Marcelo',
        'Cerrito 236 Piso 2',
        '1975-05-02',
        'epopasu-1210@yopmail.com',
        'Activo'
    ),
    (
        16131891,
        'Hernandez',
        'Omar Lozano',
        '',
        '1954-07-09',
        'pontipak@me.com',
        'Activo'
    ),
    (
        32454949,
        'Pascual',
        'Jose Manuel',
        '',
        '1975-01-03',
        'heine@outlook.com',
        'Activo'
    ),
    (11188169, 'Diaz', 'Adrian', '', '', '', 'Activo'),
    (
        39447859,
        'Guerrero',
        'Irene',
        'Av Lib San Martin 569',
        '1986-03-14',
        '',
        'Activo'
    ),
    (
        26009360,
        'Bosch',
        'Naia',
        '',
        '1990-07-12',
        'pkilab@verizon.net',
        'Activo'
    ),
    (
        24205172,
        'Moya',
        'Diana',
        '',
        '1999-11-30',
        'wonderkid@gmail.com',
        'Activo'
    ),
    (
        17145072,
        'Garcia',
        'Blanca',
        'Dr R Balbin 966',
        '1995-11-17',
        '',
        'Activo'
    ),
    (
        19917833,
        'Guerrero',
        'Francisco',
        '',
        '1984-02-22',
        '',
        'Activo'
    ),
    (
        26585543,
        'Ramirez',
        'Omar',
        'Bv N Orono 3094',
        '1975-05-02',
        'crowemojo@hotmail.com',
        'Activo'
    );
INSERT INTO `agentes` (`idAgente`, `idEspecializacion`, `disponible`)
VALUES (26585543, 1, 1),
    (39447859, 3, 1),
    (17145072, 4, 1),
    (16131891, 6, 1),
    (22456368, 8, 1);
INSERT INTO `sectores` (
        `idSector`,
        `nombreSector`,
        `tipo`,
        `responsable`,
        `telefono`,
        `email`
    )
VALUES (
        1,
        'Contabilidad',
        'Hospital',
        'Marcela',
        206,
        'contabilidad@mail.com'
    ),
    (
        2,
        'Direccion',
        'Hospital',
        'Gustavo',
        220,
        'direccion@mail.com'
    ),
    (
        3,
        'Rehabilitacion',
        'Hospital',
        'Andrea',
        NULL,
        'rehab@mail.com'
    ),
    (
        4,
        'Guardia Medica',
        'Hospital',
        'Fernando',
        256,
        NULL
    ),
    (5, 'Porteria', 'Hospital', 'Pedro', 333, NULL),
    (
        6,
        'Vacunatorio',
        'Hospital',
        'Roberto',
        456,
        'vacunatorio@mail.com'
    ),
    (
        7,
        'Infraestructura',
        'Hospital',
        'Pablo',
        196,
        'infraestructura@mail.com'
    ),
    (
        8,
        'Pabellon 1',
        'Hospital',
        'Leadnro',
        111,
        'pab1@mail.com'
    ),
    (
        9,
        'Pabellon 2',
        'Hospital',
        'Ezequiel',
        222,
        'pab2@mail.com'
    ),
    (
        10,
        'Pabellon 3',
        'Hospital',
        'Mauro',
        543,
        'pab3@mail.com'
    ),
    (
        11,
        'Equipamiento Medico',
        'Hospital',
        'Marcela',
        200,
        NULL
    ),
    (
        12,
        'Casa N.3',
        'Casa Comunitaria',
        NULL,
        963,
        'zonab@mail.com'
    ),
    (
        13,
        'Casa N.10',
        'Casa Comunitaria',
        NULL,
        963,
        'zonab@mail.com'
    );
USE Mantenimiento;
CREATE TABLE roles (
    idRol INTEGER PRIMARY KEY,
    nombreRol VARCHAR(20) NOT NULL
);
INSERT INTO `roles`
VALUES (0, 'superAdmin');
INSERT INTO `roles`
VALUES (1, 'Operador');
USE Mantenimiento;
CREATE TABLE permisos (
    idPermiso INTEGER PRIMARY KEY,
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
VALUES ('admin', 'admin', 0, 00000000);
USE Mantenimiento;
CREATE TABLE rolesxpermisos (
    idRol INTEGER,
    idPermiso INTEGER,
    PRIMARY KEY (idRol, idPermiso),
    FOREIGN KEY (idRol) REFERENCES roles(idRol),
    FOREIGN KEY (idPermiso) REFERENCES permisos(idPermiso)
);
INSERT INTO `permisos` (`idPermiso`, `nombrePermiso`)
VALUES (1, 'alta usuario'),
    (2, 'baja usuario'),
    (3, 'modificar usuario'),
    (4, 'visualizar usuario'),
    (5, 'alta permisos'),
    (6, 'baja permisos'),
    (7, 'modificar permisos'),
    (8, 'visualizar permisos'),
    (9, 'alta roles'),
    (10, 'baja roles'),
    (11, 'modificar roles'),
    (12, 'visualizar roles'),
    (13, 'alta pedidos'),
    (14, 'baja pedidos'),
    (15, 'modificar pedidos'),
    (16, 'visualizar pedidos'),
    (17, 'alta tareas'),
    (18, 'baja tareas'),
    (19, 'modificar tareas'),
    (20, 'visualizar tareas'),
    (21, 'alta ot'),
    (22, 'baja ot'),
    (23, 'modificar ot'),
    (24, 'visualizar ot'),
    (25, 'alta sectores'),
    (26, 'baja sectores'),
    (27, 'modificar sectores'),
    (28, 'visualizar sectores'),
    (29, 'alta agentes'),
    (30, 'baja agentes'),
    (31, 'modificar agentes'),
    (32, 'visualizar agentes'),
    (33, 'alta especialidades'),
    (34, 'baja especialidades'),
    (35, 'modificar especialid'),
    (36, 'visualizar especiali'),
    (37, 'alta eventos'),
    (38, 'baja eventos'),
    (39, 'modificar eventos'),
    (40, 'visualizar eventos'),
    (41, 'alta insumos'),
    (42, 'baja insumos'),
    (43, 'modificar insumos'),
    (44, 'visualizar insumos'),
    (45, 'alta persona'),
    (46, 'baja persona'),
    (47, 'modificar persona'),
    (48, 'visualizar persona'),
    (49, 'alta oc'),
    (50, 'baja oc'),
    (51, 'modificar oc'),
    (52, 'visualizar oc');
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
VALUES (0, 1),
    (0, 2),
    (0, 3),
    (0, 4),
    (0, 5),
    (0, 6),
    (0, 7),
    (0, 8),
    (0, 9),
    (0, 10),
    (0, 11),
    (0, 12),
    (0, 13),
    (0, 14),
    (0, 15),
    (0, 16),
    (0, 17),
    (0, 18),
    (0, 19),
    (0, 20),
    (0, 21),
    (0, 22),
    (0, 23),
    (0, 24),
    (0, 25),
    (0, 26),
    (0, 27),
    (0, 28),
    (0, 29),
    (0, 30),
    (0, 31),
    (0, 32),
    (0, 33),
    (0, 34),
    (0, 35),
    (0, 36),
    (0, 37),
    (0, 38),
    (0, 39),
    (0, 40),
    (0, 41),
    (0, 42),
    (0, 43),
    (0, 44),
    (0, 45),
    (0, 46),
    (0, 47),
    (0, 48),
    (0, 49),
    (0, 50),
    (0, 51),
    (0, 52);
INSERT INTO `rolesxpermisos` (`idRol`, `idPermiso`)
VALUES (1, 13),
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
    (1, 49),
    (1, 50),
    (1, 51),
    (1, 52);
INSERT INTO `especializacion` (`idEspecializacion`, `nombre`)
VALUES (1, 'Plomeria'),
    (2, 'Albanileria'),
    (3, 'Pintureria'),
    (4, 'Electricidad'),
    (5, 'Mecanico'),
    (6, 'Herreria'),
    (7, 'Restauracion'),
    (8, 'Carpinteria'),
    (9, 'General');
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
        '',
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
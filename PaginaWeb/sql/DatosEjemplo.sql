INSERT INTO `Roles` (`nombre`)
VALUES ('superAdmin'),
    ('Operador')
;

INSERT INTO `Permisos` (`nombre`)
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
    ('visualizar oc')
;

INSERT INTO `Roles_x_Permisos` (`idRol`, `idPermiso`)
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
    (1, 52),
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
    (2, 52)
;

INSERT INTO `EstadosPersona` (`nombre`)
VALUES ("Activo"),
    ('Baja'),
    ('Licencia')
;

INSERT INTO `Personas`
VALUES (
        00000000,
        'superAdmin',
        'superAdmin',
        NULL,
        '2000-01-01',
        NULL,
        1
);

INSERT INTO `Usuarios` (`nick`, `password`, `idPersona`)
VALUES ('admin', 'admin', 00000000)
;

INSERT INTO `Roles_x_Usuarios` (`idRol`, `idUsuario`)
VALUES (1, 1)
;

INSERT INTO `TiposSector` (`nombre`)
VALUES ('HOSPITAL'),
    ('CASA COMUNITARIA'),
    ('CASA PARTICULAR')
;

INSERT INTO `Especializaciones` (`nombre`)
VALUES ('Plomeria'),
    ('Albanileria'),
    ('Pintureria'),
    ('Electricidad'),
    ('Mecanico'),
    ('Herreria'),
    ('Restauracion'),
    ('Carpinteria'),
    ('General')
;

INSERT INTO `Estados` (`nombre`)
VALUES ('Iniciado'),
    ('En Curso'),
    ('Pendiente'),
    ('Cancelado'),
    ('Finalizado')
;

INSERT INTO `Prioridades` (`nombre`)
VALUES ('Baja'),
    ('Media'),
    ('Alta'),
    ('Urgente')
;

INSERT INTO `EstadosOrdenesDeCompra` (`nombre`)
VALUES ('Iniciado'),
    ('Parcial'),
    ('Completo'),
    ('Cancelado')
;

INSERT INTO `TiposOrdenesDeCompra` (`nombre`)
VALUES ('Orden De Compra'),
    ('Fondo Rotatorio'),
    ('Aprobacion de Presupuesto')
;

INSERT INTO `Medidas` (`nombre`)
VALUES ('Unid.'),
    ('gr'),
    ('kg'),
    ('mm'),
    ('m'),
    ('ml'),
    ('lt'),
    ('mm3'),
    ('cm3'),
    ('m3')
;

INSERT INTO `Insumos` (
        `nombre`,
        `descripcion`,
        `stockReal`,
        `stockComprometido`,
        `stockFuturo`,
        `stockMinimo`,
        `idMedida`
    )
VALUES ('tornillo', 'cruz chico', 100, 0, 0, 100, 1),
    ('tornillo', 'cruz mediano', 200, 0, 0, 100, 1),
    ('tornillo', 'cruz largo', 150, 0, 0, 100, 1),
    ('tornillo', 'liso chico', 200, 0, 0, 100, 1),
    ('tornillo', 'liso mediano', 340, 0, 0, 100, 1),
    ('tornillo', 'liso largo', 450, 0, 0, 100, 1),
    ('clavo', 'madero corto', 450, 0, 0, 100, 1),
    ('clavo', 'madero mediano', 550, 0, 0, 100, 1),
    ('clavo', 'madero largo', 50, 100, 0, 0, 1),
    ('clavo', 'chapa corto', 150, 100, 0, 0, 1),
    ('clavo', 'chapa mediano', 250, 100, 0, 0, 1),
    ('clavo', 'chapa largo', 25, 100, 0, 0, 1),
    ('tuerca', 'chica', 150, 50, 0, 0, 1),
    ('tuerca', 'mediana', 250, 50, 0, 0, 1),
    ('tuerca', 'grande', 0, 50, 0, 0, 1),
    ('fisher', 'chico', 0, 100, 0, 0, 1),
    ('fisher', 'mediano', 12, 100, 0, 0, 1),
    ('fisher', 'grande', 321, 100, 0, 0, 1),
    ('codo', '24cm', 50, 25, 0, 0, 1),
    ('codo', 'en T 12cm', 20, 25, 0, 0, 1),
    ('codo', 'en L 5cm', 44, 25, 0, 0, 1),
    ('Lampara Led', '40w caliente', 5, 5, 0, 0, 1),
    ('Lampara Led', '40w fria', 10, 5, 0, 0, 1),
    ('Lampara Led', '5w caliente', 2, 5, 0, 0, 1),
    ('Lampara Led', '5w fria', 8, 5, 0, 0, 1)
;

INSERT INTO `Personas` (
        `id`,
        `nombre`,
        `apellido`,
        `direccion`,
        `fechaNacimiento`,
        `email`,
        `idEstadoPersona`
    )
VALUES (
        22456368,
        'Marcelo',
        'Lombardo',
        'Cerrito 236 Piso 2',
        '1975-05-02',
        'epopasu_1210@yopmail.com',
        1
    ),
    (
        16131891,
        'Omar Lozano',
        'Hernandez',
        '',
        '1954-07-09',
        'pontipak@me.com',
        1
    ),
    (
        32454949,
        'Jose Manuel',
        'Pascual',
        '',
        '1975-01-03',
        'heine@outlook.com',
        1
    ),
    (
        11188169,
        'Adrian',
        'Diaz',
        '',
        '1971-02-10',
        '',
        1
    ),
    (
        39447859,
        'Irene',
        'Guerrero',
        'Av Lib San Martin 569',
        '1986-03-14',
        '',
        1
    ),
    (
        26009360,
        'Naia',
        'Bosch',
        '',
        '1990-07-12',
        'pkilab@verizon.net',
        1
    ),
    (
        24205172,
        'Diana',
        'Moya',
        '',
        '1999-11-30',
        'wonderkid@gmail.com',
        1
    ),
    (
        17145072,
        'Blanca',
        'Garcia',
        'Dr R Balbin 966',
        '1995-11-17',
        '',
        1
    ),
    (
        19917833,
        'Francisco',
        'Guerrero',
        '',
        '1984-02-22',
        '',
        1
    ),
    (
        26585543,
        'Omar',
        'Ramirez',
        'Bv N Orono 3094',
        '1975-05-02',
        'crowemojo@hotmail.com',
        1
    )
;

INSERT INTO `Agentes` (`idPersona`, `isDisponible`)
VALUES (26585543, 1),
    (39447859, 1),
    (17145072, 1),
    (16131891, 1),
    (22456368, 1)
;

INSERT INTO `Especializaciones_x_Agentes` (`idEspecializacion`, `idAgente`)
VALUES (1, 1),
(3, 1),
(5, 2),
(7, 2),
(5, 3),
(2, 4),
(8, 4),
(8, 5)
;

INSERT INTO `Sectores` (
        `nombre`,
        `responsable`,
        `telefono`,
        `email`,
        `idTipoSector`
    )
VALUES (
        'Contabilidad',
        'Marcela',
        206,
        'contabilidad@mail.com',
        '1'
    ),
    (
        'Direccion',
        'Gustavo',
        220,
        'direccion@mail.com',
        '1'
    ),
    (
        'Rehabilitacion',
        'Andrea',
        NULL,
        'rehab@mail.com',
        '1'
    ),
    (
        'Guardia Medica',
        'Fernando',
        256,
        NULL,
        '1'
    ),
    (
        'Porteria', 
        'Pedro', 
        333, 
        NULL,
        '1'
    ),
    (
        'Vacunatorio',
        'Roberto',
        456,
        'vacunatorio@mail.com',
        '1'
    ),
    (
        'Infraestructura',
        'Pablo',
        196,
        'infraestructura@mail.com',
        '1'
    ),
    (
        'Pabellon 1',
        'Leandro',
        111,
        'pab1@mail.com',
        '1'
    ),
    (
        'Pabellon 2',
        'Ezequiel',
        222,
        'pab2@mail.com',
        '1'
    ),
    (
        'Pabellon 3',
        'Mauro',
        543,
        'pab3@mail.com',
        '1'
    ),
    (
        'Equipamiento Medico',
        'Marcela',
        200,
        NULL,
        '1'
    ),
    (
        'Casa 3',
        'Alfonso',
        963,
        'zonab@mail.com',
        '2'
    ),
    (
        'Casa 10',
        'Adriana',
        963,
        'zonab@mail.com',
        '2'
    );


INSERT INTO `Roles` (`id`,`nombre`)
VALUES (1,'superAdmin'),
    (2,'Operador')
;

INSERT INTO `Permisos` (`id`,`nombre`)
VALUES (1,'alta usuario'),
    (2,'baja usuario'),
    (3,'modificar usuario'),
    (4,'visualizar usuario'),
    (5,'alta permisos'),
    (6,'baja permisos'),
    (7,'modificar permisos'),
    (8,'visualizar permisos'),
    (9,'alta roles'),
    (10,'baja roles'),
    (11,'modificar roles'),
    (12,'visualizar roles'),
    (13,'alta pedidos'),
    (14,'baja pedidos'),
    (15,'modificar pedidos'),
    (16,'visualizar pedidos'),
    (17,'alta tareas'),
    (18,'baja tareas'),
    (19,'modificar tareas'),
    (20,'visualizar tareas'),
    (21,'alta ot'),
    (22,'baja ot'),
    (23,'modificar ot'),
    (24,'visualizar ot'),
    (25,'alta sectores'),
    (26,'baja sectores'),
    (27,'modificar sectores'),
    (28,'visualizar sectores'),
    (29,'alta agentes'),
    (30,'baja agentes'),
    (31,'modificar agentes'),
    (32,'visualizar agentes'),
    (33,'alta especialidades'),
    (34,'baja especialidades'),
    (35,'modificar especialid'),
    (36,'visualizar especiali'),
    (37,'alta eventos'),
    (38,'baja eventos'),
    (39,'modificar eventos'),
    (40,'visualizar eventos'),
    (41,'alta insumos'),
    (42,'baja insumos'),
    (43,'modificar insumos'),
    (44,'visualizar insumos'),
    (45,'alta persona'),
    (46,'baja persona'),
    (47,'modificar persona'),
    (48,'visualizar persona'),
    (49,'alta oc'),
    (50,'baja oc'),
    (51,'modificar oc'),
    (52,'visualizar oc')
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

INSERT INTO `EstadosPersona` (`id`,`nombre`)
VALUES (1,"Activo"),
    (2,'Baja'),
    (3,'Licencia')
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

INSERT INTO `Usuarios` (`id`,`nick`, `password`, `idPersona`)
VALUES (1,'admin', 'admin', 00000000)
;

INSERT INTO `Roles_x_Usuarios` (`idRol`, `idUsuario`)
VALUES (1, 1)
;

INSERT INTO `TiposSector` (`id`,`nombre`)
VALUES (1,'HOSPITAL'),
    (2,'CASA COMUNITARIA'),
    (3,'CASA PARTICULAR')
;

INSERT INTO `Especializaciones` (`id`,`nombre`)
VALUES (1,'Plomeria'),
    (2,'Albanileria'),
    (3,'Pintureria'),
    (4,'Electricidad'),
    (5,'Mecanico'),
    (6,'Herreria'),
    (7,'Restauracion'),
    (8,'Carpinteria'),
    (9,'General')
;

INSERT INTO `Estados` (`id`,`nombre`)
VALUES (1,'Iniciado'),
    (2,'En Curso'),
    (3,'Pendiente'),
    (4,'Cancelado'),
    (5,'Finalizado'),
    (6,'Cumplido')
;

INSERT INTO `Prioridades` (`id`,`nombre`)
VALUES (1,'Baja'),
    (2,'Media'),
    (3,'Alta'),
    (4,'Urgente')
;

INSERT INTO `EstadosOrdenesDeCompra` (`id`,`nombre`)
VALUES (1,'Iniciado'),
    (2,'Parcial'),
    (3,'Completo'),
    (4,'Cancelado'),
    (5,'Parcial Completo')
;

INSERT INTO `TiposOrdenesDeCompra` (`id`,`nombre`)
VALUES (1,'Orden De Compra'),
    (2,'Fondo Rotatorio'),
    (3,'Aprobacion de Presupuesto')
;

INSERT INTO `Medidas` (`id`,`nombre`)
VALUES (1,'Unid.'),
    (2,'gr'),
    (3,'kg'),
    (4,'mm'),
    (5,'m'),
    (6,'ml'),
    (7,'lt'),
    (8,'mm3'),
    (9,'cm3'),
    (10,'m3')
;

INSERT INTO `Insumos` (`id`,
        `nombre`,
        `descripcion`,
        `stockReal`,
        `stockComprometido`,
        `stockFuturo`,
        `stockMinimo`,
        `idMedida`
    )
VALUES (1,'tornillo', 'cruz chico', 10, 0, 0, 80, 1),
    (2,'tornillo', 'cruz mediano', 200, 0, 0, 80, 1),
    (3,'tornillo', 'cruz largo', 15, 0, 0, 80, 1),
    (4,'tornillo', 'liso chico', 200, 0, 0, 80, 1),
    (5,'tornillo', 'liso mediano', 340, 0, 0, 80, 1),
    (6,'tornillo', 'liso largo', 45, 0, 0, 80, 1),
    (7,'clavo', 'madero corto', 450, 0, 0, 100, 1),
    (8,'clavo', 'madero mediano', 55, 0, 0, 100, 1),
    (9,'clavo', 'madero largo', 50, 0, 0, 100, 1),
    (10,'clavo', 'chapa corto', 150, 0, 0, 100, 1),
    (11,'clavo', 'chapa mediano', 25, 0, 0, 100, 1),
    (12,'clavo', 'chapa largo', 25, 0, 0, 100, 1),
    (13,'tuerca', 'chica', 150, 0, 0, 200, 1),
    (14,'tuerca', 'mediana', 250, 0, 0, 200, 1),
    (15,'tuerca', 'grande', 0, 0, 0, 200, 1),
    (16,'fisher', 'chico', 0, 0, 0, 50, 1),
    (17,'fisher', 'mediano', 12, 0, 0, 50, 1),
    (18,'fisher', 'grande', 321, 0, 0, 50, 1),
    (19,'codo', '24cm', 50, 0, 0, 20, 1),
    (20,'codo', 'en T 12cm', 20, 0, 0, 20, 1),
    (21,'codo', 'en L 5cm', 44, 0, 0, 20, 1),
    (22,'Lampara Led', '40w caliente', 5, 0, 0, 5, 1),
    (23,'Lampara Led', '40w fria', 10, 0, 0, 5, 1),
    (24,'Lampara Led', '5w caliente', 2, 0, 0, 5, 1),
    (25,'Lampara Led', '5w fria', 8, 0, 0, 5, 1)
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
        3
    )
;

INSERT INTO `Agentes` (`id`,`idPersona`)
VALUES (1,26585543),
    (2,39447859),
    (3,17145072),
    (4,16131891),
    (5,22456368),
    (6,19917833),
    (7,24205172)
;

INSERT INTO `Especializaciones_x_Agentes` (`idEspecializacion`, `idAgente`)
VALUES (1, 1),
(1, 7),
(2, 4),
(2, 5),
(2, 6),
(2, 7),
(3, 1),
(3, 2),
(3, 3),
(3, 4),
(4, 1),
(4, 6),
(5, 2),
(5, 3),
(6, 6),
(6, 4),
(7, 2),
(7, 3),
(7, 5),
(8, 4),
(8, 6),
(8, 5),
(9, 1),
(9, 3),
(9, 7)
;

INSERT INTO `Sectores` (`id`,
        `nombre`,
        `responsable`,
        `telefono`,
        `email`,
        `idTipoSector`
    )
VALUES (1,
        'Contabilidad',
        'Marcela',
        206,
        'contabilidad@mail.com',
        '1'
    ),
    (2,
        'Direccion',
        'Gustavo',
        220,
        'direccion@mail.com',
        '1'
    ),
    (3,
        'Rehabilitacion',
        'Andrea',
        NULL,
        'rehab@mail.com',
        '1'
    ),
    (4,
        'Guardia Medica',
        'Fernando',
        256,
        NULL,
        '1'
    ),
    (5,
        'Porteria', 
        'Pedro', 
        333, 
        NULL,
        '1'
    ),
    (6,
        'Vacunatorio',
        'Roberto',
        456,
        'vacunatorio@mail.com',
        '1'
    ),
    (7,
        'Infraestructura',
        'Pablo',
        196,
        'infraestructura@mail.com',
        '1'
    ),
    (8,
        'Pabellon 1',
        'Leandro',
        111,
        'pab1@mail.com',
        '1'
    ),
    (9,
        'Pabellon 2',
        'Ezequiel',
        222,
        'pab2@mail.com',
        '1'
    ),
    (10,
        'Pabellon 3',
        'Mauro',
        543,
        'pab3@mail.com',
        '1'
    ),
    (11,
        'Equipamiento Medico',
        'Marcela',
        200,
        NULL,
        '1'
    ),
    (12,
        'Casa 3',
        'Alfonso',
        963,
        'zonab@mail.com',
        '2'
    ),
    (13,
        'Casa 10',
        'Adriana',
        963,
        'zonab@mail.com',
        '2'
    );

INSERT INTO `especializacion` (`idEspecializacion`, `nombre`) VALUES
(1, 'plomeria'),
(2, 'albanileria'),
(3, 'pintureria'),
(4, 'electricidad'),
(5, 'mecanico'),
(6, 'herreria'),
(7, 'restauracion');

INSERT INTO `insumo` (`nombreInsumo`, `descripcion`, `stock`) VALUES
('tornillo', '10 pulgadas',100),
('tornillo', '5 pulgadas',200),
('tuerca', 'chica',150),
('tuerca', 'mediana',250),
('tuerca', 'grande',0),
('fisher', 'chico',0),
('fisher', 'mediano',12),
('fisher', 'grande',321),
('codo', '24cm',50),
('codo', 'en T 12cm',20),
('codo', 'en L 5cm',44),
('destornillador', 'cruz',5),
('destornillador', 'liso',5);

INSERT INTO `permisos` (`idPermiso`, `nombrePermiso`) VALUES
(1, 'alta usuario'),(2, 'baja usuario'),(3, 'modificar usuario'),(4, 'visualizar usuario'),(5, 'alta permisos'),(6, 'baja permisos'),
(7, 'modificar permisos'),(8, 'visualizar permisos'),(9, 'alta roles'),(10, 'baja roles'),(11, 'modificar roles'),(12, 'visualizar roles'),
(13, 'alta pedidos'),(14, 'baja pedidos'),(15, 'modificar pedidos'),(16, 'visualizar pedidos'),(17, 'alta tareas'),(18, 'baja tareas'),
(19, 'modificar tareas'),(20, 'visualizar tareas'),(21, 'alta ot'),(22, 'baja ot'),(23, 'modificar ot'),(24, 'visualizar ot'),
(25, 'alta sectores'),(26, 'baja sectores'),(27, 'modificar sectores'),(28, 'visualizar sectores'),(29, 'alta agentes'),(30, 'baja agentes'),
(31, 'modificar agentes'),(32, 'visualizar agentes'),(33, 'alta especialidades'),(34, 'baja especialidades'),(35, 'modificar especialides'),
(36, 'visualizar especiali'),(37, 'alta eventos'),(38, 'baja eventos'),(39, 'modificar eventos'),(40, 'visualizar eventos'),(41, 'alta insumos'),
(42, 'baja insumos'),(43, 'modificar insumos'),(44, 'visualizar insumos');

INSERT INTO `personas` (`dni`, `apellido`, `nombre`, `direccion`, `fecha_nacimiento`, `email`) VALUES
(0, 'superAdmin', 'superAdmin', NULL, NULL, NULL),
(39161547, 'Costa', 'Ivan', 'Calle falsa 123', '1995-10-21', 'costaivan34@gmail.com');

INSERT INTO `roles` (`idRol`, `nombreRol`) VALUES
(1, 'superAdmin'),
(2, 'Operador');

INSERT INTO `rolesxpermisos` (`idRol`, `idPermiso`) VALUES
(1, 1),(1, 2),(1, 3),(1, 4),(1, 5),(1, 6),(1, 7),(1, 8),(1, 9),(1, 10),(1, 11),(1, 12),(1, 13),(1, 14),(1, 15),(1, 16),(1, 17),(1, 18),(1, 19),
(1, 20),(1, 21),(1, 22),(1, 23),(1, 24),(1, 25),(1, 26),(1, 27),(1, 28),(1, 29),(1, 30),(1, 31),(1, 32),(1, 33),(1, 34),(1, 35),(1, 36),
(1, 37),(1, 38),(1, 39),(1, 40),(1, 41),(1, 42),(1, 43),(1, 44);

INSERT INTO `usuarios` (`nombre`, `password`, `idRol`, `idPersona`) VALUES
('admin', 'admin', 1, 0),
('operador', 'operador', 2, 0);
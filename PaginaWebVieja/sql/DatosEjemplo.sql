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
(0, 1),(0, 2),(0, 3),(0, 4),(0, 5),(0, 6),(0, 7),(0, 8),(0, 9),(0, 10),(0, 11),(0, 12),(0, 13),(0, 14),(0, 15),(0, 16),(0, 17),(0, 18),
(0, 19),(0, 20),(0, 21),(0, 22),(0, 23),(0, 24),(0, 25),(0, 26),(0, 27),(0, 28),(0, 29),(0, 30),(0, 31),(0, 32),(0, 33),(0, 34),(0, 35),(0, 36),
(0, 37),(0, 38),(0, 39),(0, 40),(0, 41),(0, 42),(0, 43),(0, 44);

INSERT INTO `usuarios` (`nombre`, `password`, `idRol`, `idPersona`) VALUES
('admin', 'admin', 0, 0),
('operador', 'operador', 2, 0);
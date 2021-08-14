USE Mantenimiento;
SET NAMES 'utf8' COLLATE 'utf8_general_ci';
CREATE TABLE Roles (
    id INTEGER PRIMARY KEY AUTO_INCREMENT,
    nombre VARCHAR(30) NOT NULL,
    UNIQUE(nombre)
);

CREATE TABLE Permisos (
    id INTEGER PRIMARY KEY AUTO_INCREMENT,
    nombre VARCHAR(30) NOT NULL,
    UNIQUE(nombre)
);

CREATE TABLE Roles_x_Permisos (
    idRol INTEGER,
    idPermiso INTEGER,
    PRIMARY KEY (idRol, idPermiso),
    FOREIGN KEY (idRol) REFERENCES Roles (id),
    FOREIGN KEY (idPermiso) REFERENCES Permisos (id)
);

CREATE TABLE EstadosPersona (
    id INTEGER PRIMARY KEY AUTO_INCREMENT,
    nombre VARCHAR(30) NOT NULL,
    UNIQUE(nombre)
);

CREATE TABLE Provincias (
    id INTEGER PRIMARY KEY,
    nombre VARCHAR(60) NOT NULL,
    UNIQUE(nombre)
);

CREATE TABLE Ciudades (
    id INTEGER PRIMARY KEY,
    nombre VARCHAR(60) NOT NULL,
    idProvincia INTEGER NOT NULL,
    FOREIGN KEY (idProvincia) REFERENCES Provincias(id)
);

CREATE TABLE Direccion (
    id INTEGER PRIMARY KEY AUTO_INCREMENT,
    idCiudad INTEGER NOT NULL,
    calle VARCHAR(50) NOT NULL,
    numero VARCHAR(50) NOT NULL,
    FOREIGN KEY (idCiudad) REFERENCES Ciudades(id)
);

CREATE TABLE Personas (
    id INTEGER PRIMARY KEY,
    nombre VARCHAR(30) NOT NULL,
    apellido VARCHAR(30) NOT NULL,
    idDireccion INTEGER NOT NULL,
    fechaNacimiento DATE NOT NULL,
    email VARCHAR(30) NOT NULL,
    idEstadoPersona INTEGER NOT NULL,
    FOREIGN KEY (idEstadoPersona) REFERENCES EstadosPersona(id),
    FOREIGN KEY (idDireccion) REFERENCES Direccion(id)
);

CREATE TABLE Usuarios (
    id INTEGER PRIMARY KEY AUTO_INCREMENT,
    nick VARCHAR(30) NOT NULL,
    password TEXT NOT NULL,
    idPersona INTEGER,
    UNIQUE (nick),
    UNIQUE (idPersona),
    FOREIGN KEY (idPersona) REFERENCES Personas (id)
);

CREATE TABLE Roles_x_Usuarios (
    idRol INTEGER,
    idUsuario INTEGER,
    PRIMARY KEY (idRol, idUsuario),
    FOREIGN KEY (idRol) REFERENCES Roles (id),
    FOREIGN KEY (idUsuario) REFERENCES Usuarios (id)
);

CREATE TABLE TiposSector(
    id INTEGER PRIMARY KEY AUTO_INCREMENT,
    nombre VARCHAR(30) NOT NULL,
    UNIQUE(nombre)
);

CREATE TABLE Sectores (
    id INTEGER PRIMARY KEY AUTO_INCREMENT,
    nombre VARCHAR(30) NOT NULL,
    responsable VARCHAR(30) NOT NULL,
    telefono VARCHAR(30),
    email VARCHAR(30),
    idTipoSector INTEGER NOT NULL,
    UNIQUE(nombre),
    FOREIGN KEY (idTipoSector) REFERENCES TiposSector(id)
);

CREATE TABLE Especializaciones (
    id INTEGER PRIMARY KEY AUTO_INCREMENT,
    nombre VARCHAR(30) NOT NULL,
    UNIQUE(nombre)
);

CREATE TABLE Agentes (
    id INTEGER PRIMARY KEY AUTO_INCREMENT,
    idPersona INTEGER NOT NULL,
    tareasActuales INTEGER NOT NULL DEFAULT 0,
    UNIQUE (idPersona),
    FOREIGN KEY (idPersona) REFERENCES Personas (id)
);

CREATE TABLE Especializaciones_x_Agentes (
    idEspecializacion INTEGER,
    idAgente INTEGER,
    PRIMARY KEY (idEspecializacion, idAgente),
    FOREIGN KEY (idEspecializacion) REFERENCES Especializaciones (id),
    FOREIGN KEY (idAgente) REFERENCES Agentes (id)
);

CREATE TABLE Estados(
    id INTEGER PRIMARY KEY AUTO_INCREMENT,
    nombre VARCHAR(30) NOT NULL,
    UNIQUE(nombre)
);

CREATE TABLE Prioridades(
    id INTEGER PRIMARY KEY AUTO_INCREMENT,
    nombre VARCHAR(30) NOT NULL,
    UNIQUE(nombre)
);

CREATE TABLE Eventos (
    id INTEGER PRIMARY KEY AUTO_INCREMENT,
    idEstado INTEGER NOT NULL,
    nombre varchar(30) NOT NULL,
    descripcion TEXT NOT NULL,
    fechaInicio DATE NOT NULL,
    fechaFin DATE NOT NULL,
    periodicidad INTEGER default 0,
    FOREIGN KEY (idEstado) REFERENCES Estados (id),
    UNIQUE(nombre)
);

CREATE TABLE Pedidos (
    id INTEGER PRIMARY KEY AUTO_INCREMENT,
    descripcion TEXT NOT NULL,
    fechaInicio DATETIME NOT NULL,
    fechaFin DATETIME,
    idUsuario INTEGER NOT NULL,
    idEstado INTEGER NOT NULL,
    idSector INTEGER NOT NULL,
    idPrioridad INTEGER NOT NULL,
    FOREIGN KEY (idUsuario) REFERENCES Usuarios (id),
    FOREIGN KEY (idEstado) REFERENCES Estados (id),
    FOREIGN KEY (idSector) REFERENCES Sectores (id),
    FOREIGN KEY (idPrioridad) REFERENCES Prioridades (id)
);

CREATE TABLE OrdenesDeTrabajo (
    id INTEGER PRIMARY KEY AUTO_INCREMENT,
    fechaInicio DATETIME NOT NULL,
    fechaFin DATETIME,
    idEstado INTEGER NOT NULL,
    idUsuario INTEGER NOT NULL,
    FOREIGN KEY (idEstado) REFERENCES Estados (id),
    FOREIGN KEY (idUsuario) REFERENCES Usuarios (id)
);

CREATE TABLE Tareas (
    id INTEGER NOT NULL,
    fechaInicio DATETIME NOT NULL,
    fechaFin DATETIME,
    descripcion TEXT NOT NULL,
    idPedido INTEGER NOT NULL,
    idOrdenDeTrabajo INTEGER,
    idUsuario INTEGER NOT NULL,
    idEspecializacion INTEGER NOT NULL,
    idEstado INTEGER NOT NULL,
    idPrioridad INTEGER NOT NULL,
    PRIMARY KEY (id, idPedido),
    FOREIGN KEY (idPedido) REFERENCES Pedidos (id),
    FOREIGN KEY (idOrdenDeTrabajo) REFERENCES OrdenesDeTrabajo (id),
    FOREIGN KEY (idUsuario) REFERENCES Usuarios (id),
    FOREIGN KEY (idEspecializacion) REFERENCES Especializaciones (id),
    FOREIGN KEY (idEstado) REFERENCES Estados (id),
    FOREIGN KEY (idPrioridad) REFERENCES Prioridades (id)
);

CREATE TABLE Agentes_x_Tareas (
    idTarea INTEGER,
    idPedido INTEGER,
    idAgente INTEGER,
    PRIMARY KEY (idTarea, idPedido, idAgente),
    FOREIGN KEY (idTarea, idPedido) REFERENCES Tareas (id, idPedido),
    FOREIGN KEY (idAgente) REFERENCES Agentes (id)
);

CREATE TABLE Medidas (
    id INTEGER PRIMARY KEY AUTO_INCREMENT,
    nombre VARCHAR(30) NOT NULL,
    UNIQUE(nombre)
);

CREATE TABLE Insumos (
    id INTEGER PRIMARY KEY AUTO_INCREMENT,
    nombre VARCHAR(30) NOT NULL,
    descripcion VARCHAR(50) NOT NULL,
    stockReal INTEGER NOT NULL DEFAULT 0,
    stockComprometido INTEGER NOT NULL DEFAULT 0,
    stockFuturo INTEGER NOT NULL DEFAULT 0,
    stockMinimo INTEGER NOT NULL,
    idMedida INTEGER NOT NULL,
    FOREIGN KEY (idMedida) REFERENCES Medidas (id)
);

CREATE TABLE Insumos_x_Tareas (
    idInsumo INTEGER NOT NULL,
    idPedido INTEGER NOT NULL,
    idTarea INTEGER NOT NULL,
    fecha DATETIME NOT NULL,
    cantidad INTEGER NOT NULL,
    PRIMARY KEY (idInsumo, idPedido, idTarea),
    FOREIGN KEY (idInsumo) REFERENCES Insumos (id),
    FOREIGN KEY (idPedido, idTarea) REFERENCES Tareas (idPedido, id)
);

CREATE TABLE EstadosOrdenesDeCompra (
    id INTEGER PRIMARY KEY AUTO_INCREMENT,
    nombre VARCHAR(30) NOT NULL,
    UNIQUE(nombre)
);

CREATE TABLE TiposOrdenesDeCompra (
    id INTEGER PRIMARY KEY AUTO_INCREMENT,
    nombre VARCHAR(30) NOT NULL,
    UNIQUE(nombre)
);

CREATE TABLE OrdenesDeCompra (
    id INTEGER PRIMARY KEY AUTO_INCREMENT,
    costoEstimado FLOAT NOT NULL default 0.00,
    costoFinal FLOAT,
    fechaInicio DATETIME NOT NULL,
    fechaFin DATETIME,
    idEstadoOC INTEGER NOT NULL,
    idUsuario INTEGER NOT NULL,
    idTipoOrdenDeCompra INTEGER NOT NULL,
    FOREIGN KEY (idEstadoOC) REFERENCES EstadosOrdenesDeCompra (id),
    FOREIGN KEY (idUsuario) REFERENCES Usuarios (id),
    FOREIGN KEY (idTipoOrdenDeCompra) REFERENCES TiposOrdenesDeCompra (id)
);

CREATE TABLE Insumos_x_OC (
    idInsumo INTEGER NOT NULL,
    idOC INTEGER NOT NULL,
    cantidadPedida INTEGER NOT NULL,
    cantidadRecibida INTEGER default 0,
    idEstado INTEGER NOT NULL,
    PRIMARY KEY (idInsumo, idOC),
    FOREIGN KEY (idInsumo) REFERENCES Insumos (id),
    FOREIGN KEY (idOC) REFERENCES OrdenesDeCompra (id),
    FOREIGN KEY (idEstado) REFERENCES EstadosOrdenesDeCompra (id)
);

CREATE TABLE HistorialInsumo (
    id INTEGER NOT NULL,
    idInsumo INTEGER NOT NULL,
    fecha DATETIME NOT NULL,
    idUsuario INTEGER NOT NULL,
    oldStock FLOAT NOT NULL,
    newStock FLOAT NOT NULL,
    inOrOut BOOLEAN NOT NULL,
    idOC INTEGER DEFAULT NULL,
    idTarea INTEGER DEFAULT NULL,
    idPedido INTEGER DEFAULT NULL,
    PRIMARY KEY (id, idInsumo),
    FOREIGN KEY (idInsumo) REFERENCES Insumos (id),
    FOREIGN KEY (idUsuario) REFERENCES Usuarios (id),
    FOREIGN KEY (idOC) REFERENCES OrdenesDeCompra (id),
    FOREIGN KEY (idTarea, idPedido) REFERENCES Tareas (id, idPedido)
);

CREATE TABLE HistorialPedido (
    id INTEGER NOT NULL,
    idPedido INTEGER NOT NULL,
    fecha DATETIME NOT NULL,
    idUsuario INTEGER NOT NULL,
    idEstado INTEGER NOT NULL,
    idSector INTEGER,
    idPrioridad INTEGER,
    descripcion TEXT,
    observacion TEXT NOT NULL,
    PRIMARY KEY (id, idPedido),
    FOREIGN KEY (idPedido) REFERENCES Pedidos (id),
    FOREIGN KEY (idUsuario) REFERENCES Usuarios (id),
    FOREIGN KEY (idEstado) REFERENCES Estados (id),
    FOREIGN KEY (idSector) REFERENCES Sectores (id),
    FOREIGN KEY (idPrioridad) REFERENCES Prioridades (id)
);

CREATE TABLE HistorialTarea (
    id INTEGER NOT NULL,
    idTarea INTEGER NOT NULL,
    idPedido INTEGER NOT NULL,
    fecha DATETIME NOT NULL,
    idUsuario INTEGER NOT NULL,
    idEstado INTEGER NOT NULL,
    idPrioridad INTEGER,
    idEspecializacion INTEGER,
    descripcion TEXT,
    observacion TEXT NOT NULL,
    PRIMARY KEY (id, idPedido, idTarea),
    FOREIGN KEY (idPedido, idTarea) REFERENCES Tareas (idPedido, id),
    FOREIGN KEY (idUsuario) REFERENCES Usuarios (id),
    FOREIGN KEY (idEspecializacion) REFERENCES Especializaciones (id),
    FOREIGN KEY (idEstado) REFERENCES Estados (id),
    FOREIGN KEY (idPrioridad) REFERENCES Prioridades (id)
);

CREATE  EVENT modificaPeriodicos ON SCHEDULE EVERY 1 DAY STARTS '2021-03-31 23:59:00' ON COMPLETION NOT PRESERVE ENABLE 
DO UPDATE mantenimiento.eventos set eventos.idEstado = 3, eventos.fechaFin = (select DATE_ADD(eventos.fechaFin, 
INTERVAL eventos.periodicidad DAY)),eventos.fechaInicio = (select DATE_ADD(eventos.fechaInicio, INTERVAL eventos.periodicidad DAY)) 
where eventos.fechaFin =(SELECT curdate());
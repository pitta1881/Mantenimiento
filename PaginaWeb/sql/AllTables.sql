USE Mantenimiento;
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

CREATE TABLE Personas (
    id INTEGER PRIMARY KEY,
    nombre VARCHAR(30) NOT NULL,
    apellido VARCHAR(30) NOT NULL,
    direccion VARCHAR(50),
    fechaNacimiento DATE NOT NULL,
    email VARCHAR(30),
    idEstadoPersona INTEGER NOT NULL,
    FOREIGN KEY (idEstadoPersona) REFERENCES EstadosPersona(id)
);

CREATE TABLE Usuarios (
    id INTEGER PRIMARY KEY AUTO_INCREMENT,
    nick VARCHAR(30) NOT NULL,
    password VARCHAR(30) NOT NULL,
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
    isDisponible BOOLEAN NOT NULL DEFAULT TRUE,
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
    FOREIGN KEY (idEstado) REFERENCES Estados (id)
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

CREATE TABLE Insumos_x_Tarea (
    id INTEGER NOT NULL,
    idInsumo INTEGER NOT NULL,
    idPedido INTEGER NOT NULL,
    idTarea INTEGER NOT NULL,
    fecha DATETIME NOT NULL,
    PRIMARY KEY (id, idInsumo, idPedido, idTarea),
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
    costoEstimado INTEGER NOT NULL default 0,
    fecha DATETIME NOT NULL,
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
    PRIMARY KEY (idInsumo, idOC),
    FOREIGN KEY (idInsumo) REFERENCES Insumos (id),
    FOREIGN KEY (idOC) REFERENCES OrdenesDeCompra (id)
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
    idPrioridad INTEGER NOT NULL,
    idEstado INTEGER NOT NULL,
    idEspecializacion INTEGER NOT NULL,
    descripcion TEXT,
    observacion TEXT NOT NULL,
    PRIMARY KEY (id, idPedido, idTarea),
    FOREIGN KEY (idPedido, idTarea) REFERENCES Tareas (idPedido, id),
    FOREIGN KEY (idUsuario) REFERENCES Usuarios (id),
    FOREIGN KEY (idEspecializacion) REFERENCES Especializaciones (id),
    FOREIGN KEY (idEstado) REFERENCES Estados (id),
    FOREIGN KEY (idPrioridad) REFERENCES Prioridades (id)
);

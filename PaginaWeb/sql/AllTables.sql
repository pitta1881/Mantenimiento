USE Mantenimiento;
CREATE TABLE Roles (
    id INTEGER PRIMARY KEY AUTO_INCREMENT,
    nombre VARCHAR(30) NOT NULL
);

CREATE TABLE Permisos (
    id INTEGER PRIMARY KEY AUTO_INCREMENT,
    nombre VARCHAR(30) NOT NULL
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
    nombre VARCHAR(30) NOT NULL
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
    nombre VARCHAR(30) NOT NULL
);

CREATE TABLE Sectores (
    id INTEGER PRIMARY KEY AUTO_INCREMENT,
    nombre VARCHAR(30) NOT NULL,
    responsable VARCHAR(30) NOT NULL,
    telefono VARCHAR(30),
    email VARCHAR(30),
    idTipoSector INTEGER NOT NULL,
    FOREIGN KEY (idTipoSector) REFERENCES TiposSector(id)
);

CREATE TABLE Especializaciones (
    id INTEGER PRIMARY KEY AUTO_INCREMENT,
    nombre VARCHAR(30) NOT NULL
);


CREATE TABLE Agentes (
    id INTEGER PRIMARY KEY AUTO_INCREMENT,
    idPersona INTEGER NOT NULL,
    isDisponible BOOLEAN NOT NULL DEFAULT TRUE,
    idEspecializacion INTEGER NOT NULL,
    FOREIGN KEY (idEspecializacion) REFERENCES Especializaciones (id),
    FOREIGN KEY (idPersona) REFERENCES Personas (id)
);

CREATE TABLE Estados(
    id INTEGER PRIMARY KEY AUTO_INCREMENT,
    nombre VARCHAR(30) NOT NULL
);

CREATE TABLE Prioridades(
    id INTEGER PRIMARY KEY AUTO_INCREMENT,
    nombre VARCHAR(30) NOT NULL
);

CREATE TABLE Pedidos (
    id INTEGER PRIMARY KEY AUTO_INCREMENT,
    descripcion TEXT NOT NULL,
    fechaInicio DATE NOT NULL,
    fechaFin DATE,
    idUsuario INTEGER NOT NULL,
    idSector INTEGER NOT NULL,
    idEstado INTEGER NOT NULL,
    idPrioridad INTEGER NOT NULL,
    FOREIGN KEY (idUsuario) REFERENCES Usuarios (id),
    FOREIGN KEY (idSector) REFERENCES Sectores (id),
    FOREIGN KEY (idEstado) REFERENCES Estados (id),
    FOREIGN KEY (idPrioridad) REFERENCES Prioridades (id)
);

CREATE TABLE OrdenesDeTrabajo (
    id INTEGER PRIMARY KEY AUTO_INCREMENT,
    fechaInicio DATE NOT NULL,
    fechaFin DATE,
    idEstado INTEGER NOT NULL,
    FOREIGN KEY (idEstado) REFERENCES Estados (id)
);

CREATE TABLE Tareas (
    id INTEGER NOT NULL,
    fecha DATE NOT NULL,
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

CREATE TABLE Tareas_x_Agentes (
    idTarea INTEGER,
    idPedido INTEGER,
    idAgente INTEGER,
    PRIMARY KEY (idTarea, idPedido, idAgente),
    FOREIGN KEY (idTarea, idPedido) REFERENCES Tareas (id, idPedido),
    FOREIGN KEY (idAgente) REFERENCES Agentes (id)
);

CREATE TABLE Medidas (
    id INTEGER PRIMARY KEY AUTO_INCREMENT,
    nombre VARCHAR(30) NOT NULL
);

CREATE TABLE Insumos (
    id INTEGER PRIMARY KEY AUTO_INCREMENT,
    nombre VARCHAR(30) NOT NULL,
    descripcion VARCHAR(50) NOT NULL,
    stockReal INTEGER NOT NULL DEFAULT 0,
    stockComprometido INTEGER NOT NULL DEFAULT 0,
    stockFuturo INTEGER NOT NULL DEFAULT 0,
    stockMinimo INTEGER NOT NULL,
    idMedidas INTEGER NOT NULL,
    FOREIGN KEY (idMedidas) REFERENCES Medidas (id)
);

CREATE TABLE EstadosOrdenesDeCompra (
    id INTEGER PRIMARY KEY AUTO_INCREMENT,
    nombre VARCHAR(30) NOT NULL
);

CREATE TABLE TiposOrdenesDeCompra (
    id INTEGER PRIMARY KEY AUTO_INCREMENT,
    nombre VARCHAR(30) NOT NULL
);

CREATE TABLE OrdenesDeCompra (
    id INTEGER PRIMARY KEY AUTO_INCREMENT,
    costoEstimado INTEGER NOT NULL default 0,
    fecha DATE NOT NULL,
    idEstado INTEGER NOT NULL,
    idUsuario INTEGER NOT NULL,
    idTipoOrdenDeCompra INTEGER NOT NULL,
    FOREIGN KEY (idEstado) REFERENCES EstadosOrdenesDeCompra (id),
    FOREIGN KEY (idUsuario) REFERENCES Usuarios (id),
    FOREIGN KEY (idTipoOrdenDeCompra) REFERENCES TiposOrdenesDeCompra (id)
);

CREATE TABLE Movimientos (
    id INTEGER AUTO_INCREMENT,
    idInsumo INTEGER NOT NULL,
    descripcion VARCHAR(50),
    fecha DATE NOT NULL,
    entradaSalida BOOLEAN NOT NULL,
    isCompletado BOOLEAN NOT NULL,
    oldStock INTEGER NOT NULL,
    newStock INTEGER NOT NULL,
    idUsuario INTEGER NOT NULL,
    idPedido INTEGER NOT NULL,
    idTarea INTEGER NOT NULL,
    idOrdenDeCompra INTEGER NOT NULL,
    PRIMARY KEY (id, idInsumo),
    FOREIGN KEY (idPedido, idTarea) REFERENCES Tareas (idPedido, id),
    FOREIGN KEY (idInsumo) REFERENCES Insumos (id),
    FOREIGN KEY (idOrdenDeCompra) REFERENCES OrdenesDeCompra (id),
    FOREIGN KEY (idUsuario) REFERENCES Usuarios (id)
);

CREATE TABLE HistorialEstado (
    idHistorial INTEGER,
    idTarea INTEGER,
    idPedido INTEGER,
    fecha DATE NOT NULL,
    descripcion VARCHAR(50),
    idEstado INTEGER NOT NULL,
    PRIMARY KEY (idPedido, idTarea, idHistorial),
    FOREIGN KEY (idPedido, idTarea) REFERENCES Tareas (idPedido, id),
    FOREIGN KEY (idEstado) REFERENCES Estados (id)
);

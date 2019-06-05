USE Mantenimiento;

CREATE TABLE pedido (
    id INTEGER PRIMARY KEY AUTO_INCREMENT,
    descripcion TEXT NOT NULL,
    estado TEXT NOT NULL,
    fechaInicio TEXT NOT NULL,
    fechaFin TEXT,
    prioridad TEXT NOT NULL,
    sector TEXT NOT NULL);
/*
    usuario Usuario TEXT NOT NULL);
*/
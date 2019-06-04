USE tp4bdd;

CREATE TABLE turnos (
    numeroTurno INTEGER PRIMARY KEY AUTO_INCREMENT,
    name TEXT NOT NULL,
    email TEXT NOT NULL,
    phone TEXT NOT NULL,
    age INTEGER,
    calzado INTEGER,
    height INTEGER,
    birth TEXT NOT NULL,
    haircolor TEXT,
    adate TEXT NOT NULL,
    atime TEXT NOT NULL);

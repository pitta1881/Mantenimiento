@echo off
C:\xampp\xampp_start
C:\xampp\mysql\bin\mysql -u root -e "DROP DATABASE IF EXISTS Mantenimiento";
C:\xampp\mysql\bin\mysql -u root -e "CREATE DATABASE IF NOT EXISTS Mantenimiento";
C:\xampp\mysql\bin\mysql -u root Mantenimiento < .\PaginaWeb\sql\AllTables.sql
C:\xampp\mysql\bin\mysql -u root --default-character-set=utf8 Mantenimiento < .\PaginaWeb\sql\DatosEjemplo.sql
cd PaginaWeb
START http://localhost:8888
php -S localhost:8888

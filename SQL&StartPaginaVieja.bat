@echo off
C:\xampp\xampp_start
C:\xampp\mysql\bin\mysql -u root -e "CREATE DATABASE IF NOT EXISTS Mantenimiento";
C:\xampp\mysql\bin\mysql -u root Mantenimiento < .\PaginaWebVieja\sql\AllTables.sql
cd PaginaWebVieja
START http://localhost:8889
php -S localhost:8889

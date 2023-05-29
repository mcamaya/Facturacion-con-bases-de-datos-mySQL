CREATE DATABASE facturacion;
CREATE TABLE categorias(
    id INT PRIMARY KEY AUTO_INCREMENT,
    nombre VARCHAR(100) NOT NULL,
    descripcion VARCHAR(255),
    imagen VARCHAR(255)
);

CREATE TABLE clientes(
    id INT PRIMARY KEY AUTO_INCREMENT,
    nombre VARCHAR(255) NOT NULL,
    celular INT NOT NULL,
    correo VARCHAR(225)
);

CREATE TABLE empleados(
    id INT PRIMARY KEY AUTO_INCREMENT,
    nombre VARCHAR(255) NOT NULL,
    celular VARCHAR(255) NOT NULL,
    direccion VARCHAR(255),
    imagen VARCHAR(255)
);

CREATE TABLE proveedores(
    id INT PRIMARY KEY AUTO_INCREMENT,
    nombre VARCHAR(255) NOT NULL,
    telefono INT NOT NULL,
    ciudad VARCHAR(255)
);
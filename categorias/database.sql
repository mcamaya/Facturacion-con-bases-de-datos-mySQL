CREATE DATABASE facturacion;
CREATE TABLE categorias(
    id INT PRIMARY KEY AUTO_INCREMENT,
    nombre VARCHAR(100) NOT NULL,
    descripcion VARCHAR(255),
    imagen VARCHAR(255)
);
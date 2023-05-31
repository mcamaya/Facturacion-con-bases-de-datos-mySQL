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

--Foreign Key

CREATE TABLE facturas (
    id INT NOT NULL PRIMARY KEY AUTO_INCREMENT,
    empleado_id INT NOT NULL,
    cliente_id INT NOT NULL,
    fecha DATE NOT NULL,

    FOREIGN KEY (empleado_id) REFERENCES empleados(id),
    FOREIGN KEY (cliente_id) REFERENCES clientes(id)

);

CREATE TABLE users(
    id INT PRIMARY KEY AUTO_INCREMENT,
    id_empleado INT NOT NULL,
    email VARCHAR(80) NOT NULL,
    username VARCHAR(80) NOT NULL,
    password VARCHAR (60) NOT NULL,
    
    FOREIGN KEY (id_empleado) REFERENCES empleados(id)
);

--Datos por defecto
INSERT INTO categorias (id, nombre, descripcion, imagen) 
VALUES (1, "Ropa Bebé", "Compra online Ropa para bebé de tus marcas favoritas, encuentra Ropa para bebé de diferentes modelos a precios increíbles.", "https://img.remediosdigitales.com/467890/portada/450_1000.jpg"),
(2, "Electrodomésticos", "Encuentra neveras, nevecones, lavadoras, congeladores, aire acondicionado y más de las marcas Challenger, Haceb, Mabe, Whirpool, Abba y muchas más...", "https://www.semana.com/resizer/OS-i-9QcsuU_4bwAj2J23Le98sg=/1280x720/smart/filters:format(jpg):quality(80)/cloudfront-us-east-1.images.arcpublishing.com/semana/TGVVZATTDJGO7D3AW2P3RQDY5E.jpg"),
(3, "Mascotas", "Aquí, encontrarás camas, juguetes, placas, collares y muchos más artículos para perros y gatos, con los cuales les brindarás un ambiente acogedor.", "https://fotos.perfil.com/2022/05/27/mercado-para-mascotas-1362928.jpg")
;


INSERT INTO clientes (id, nombre, celular, correo) 
VALUES (1, "Lucia Pedraza", 31926156, "luci@mail.com"), 
(2, "Esteban Quito", 31154518, "esteban@mail.com"), 
(3, "Arturo Hernandez", 31257460, "arturito@mail.com")
;

INSERT INTO empleados (id, nombre, celular, direccion, imagen) 
VALUES (1, "Alan Brito", 31186435, "Calle 40 #21", "https://concepto.de/wp-content/uploads/2018/08/persona-e1533759204552.jpg"),
(2, "Juanita Sepúlveda", 31249672, "Calle 14 #31", "https://aishlatino.com/wp-content/uploads/2021/11/que-tipo-de-persona-te-gustaria-ser-730x411-SP.jpg"),
(3, "Jose Bejarano", 31947685, "Carrera 46 #11", "https://cdn0.psicologia-online.com/es/posts/2/4/2/que_piensa_una_persona_cuando_dejas_de_buscarla_5242_orig.jpg")
;

INSERT INTO proveedores (id, nombre, telefono, ciudad)
VALUES (1, "Repuestos La 21", 60753564, "Girón"),
(2, "Mercao' Pelao'", 60456843, "Tunja"),
(3, "Electro-Calidad", 60856417, "San Gil")
;

--Este código fue hecho desde phpMyAdmin
INSERT INTO `facturas` (`id`, `empleado_id`, `cliente_id`, `fecha`) VALUES ('1', '1', '3', '2023-05-28'), ('2', '3', '1', '2023-05-29');

--Código por Cristian
SELECT * FROM facturas INNER JOIN empleados ON facturas.empleado_id = empleados.id INNER JOIN clientes ON facturas.cliente_id = clientes.id;
--modificado
SELECT facturas.id, clientes.nombre, empleados.nombre, facturas.fecha FROM facturas 
INNER JOIN empleados ON facturas.empleado_id = empleados.id 
INNER JOIN clientes ON facturas.cliente_id = clientes.id;
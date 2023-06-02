CREATE DATABASE facturacion;
CREATE TABLE categorias(
    ctg_id INT PRIMARY KEY AUTO_INCREMENT,
    ctg_nombre VARCHAR(100) NOT NULL,
    ctg_descripcion VARCHAR(255),
    ctg_imagen VARCHAR(255)
);

CREATE TABLE clientes(
    clt_id INT PRIMARY KEY AUTO_INCREMENT,
    clt_nombre VARCHAR(255) NOT NULL,
    clt_celular INT NOT NULL,
    clt_correo VARCHAR(225)
);

CREATE TABLE empleados(
    emp_id INT PRIMARY KEY AUTO_INCREMENT,
    emp_nombre VARCHAR(255) NOT NULL,
    emp_celular VARCHAR(255) NOT NULL,
    emp_direccion VARCHAR(255),
    emp_imagen VARCHAR(255)
);

CREATE TABLE proveedores(
    prv_id INT PRIMARY KEY AUTO_INCREMENT,
    prv_nombre VARCHAR(255) NOT NULL,
    prv_telefono INT NOT NULL,
    prv_ciudad VARCHAR(255)
);

--Foreign Key

CREATE TABLE facturas (
    fct_id INT NOT NULL PRIMARY KEY AUTO_INCREMENT,
    fct_empleado_id INT NOT NULL,
    fct_cliente_id INT NOT NULL,
    fct_fecha DATE NOT NULL,

    FOREIGN KEY (fct_empleado_id) REFERENCES empleados(emp_id),
    FOREIGN KEY (fct_cliente_id) REFERENCES clientes(clt_id)

);

CREATE TABLE users(
    usr_id INT PRIMARY KEY AUTO_INCREMENT,
    usr_id_empleado INT NOT NULL,
    usr_email VARCHAR(80) NOT NULL,
    usr_username VARCHAR(80) NOT NULL,
    usr_password VARCHAR (60) NOT NULL,
    
    FOREIGN KEY (usr_id_empleado) REFERENCES empleados(emp_id)
);

CREATE TABLE productos(
    prd_id INT PRIMARY KEY AUTO_INCREMENT,
    prd_nombre VARCHAR(100) NOT NULL,
    prd_id_categoria INT NOT NULL,
    prd_precio INT NOT NULL,
    prd_stock INT NOT NULL,
    prd_id_proveedor INT NOT NULL,
    prd_unidades_pedidas INT,
    prd_descontinuado VARCHAR(10),

    FOREIGN KEY (prd_id_categoria) REFERENCES categorias(ctg_id),
    FOREIGN KEY (prd_id_proveedor) REFERENCES proveedores(prv_id)

);

CREATE TABLE factura_detalle(
    dtl_id_factura INT NOT NULL,
    dtl_id_producto INT NOT NULL,
    dtl_cantidad INT NOT NULL,
    dtl_descuento INT,

    FOREIGN KEY (dtl_id_factura) REFERENCES facturas(fct_id),
    FOREIGN KEY (dtl_id_producto) REFERENCES productos(prd_id)
);

--Datos por defecto
INSERT INTO categorias (ctg_id, ctg_nombre, ctg_descripcion, ctg_imagen) 
VALUES (1, "Ropa Bebé", "Compra online Ropa para bebé de tus marcas favoritas, encuentra Ropa para bebé de diferentes modelos a precios increíbles.", "https://img.remediosdigitales.com/467890/portada/450_1000.jpg"),
(2, "Electrodomésticos", "Encuentra neveras, nevecones, lavadoras, congeladores, aire acondicionado y más de las marcas Challenger, Haceb, Mabe, Whirpool, Abba y muchas más...", "https://www.semana.com/resizer/OS-i-9QcsuU_4bwAj2J23Le98sg=/1280x720/smart/filters:format(jpg):quality(80)/cloudfront-us-east-1.images.arcpublishing.com/semana/TGVVZATTDJGO7D3AW2P3RQDY5E.jpg"),
(3, "Mascotas", "Aquí, encontrarás camas, juguetes, placas, collares y muchos más artículos para perros y gatos, con los cuales les brindarás un ambiente acogedor.", "https://fotos.perfil.com/2022/05/27/mercado-para-mascotas-1362928.jpg")
;


INSERT INTO clientes (clt_id, clt_nombre, clt_celular, clt_correo) 
VALUES (1, "Lucia Pedraza", 31926156, "luci@mail.com"), 
(2, "Esteban Quito", 31154518, "esteban@mail.com"), 
(3, "Arturo Hernandez", 31257460, "arturito@mail.com")
;

INSERT INTO empleados (emp_id, emp_nombre, emp_celular, emp_direccion, emp_imagen) 
VALUES (1, "Alan Brito", 31186435, "Calle 40 #21", "https://concepto.de/wp-content/uploads/2018/08/persona-e1533759204552.jpg"),
(2, "Juanita Sepúlveda", 31249672, "Calle 14 #31", "https://aishlatino.com/wp-content/uploads/2021/11/que-tipo-de-persona-te-gustaria-ser-730x411-SP.jpg"),
(3, "Jose Bejarano", 31947685, "Carrera 46 #11", "https://cdn0.psicologia-online.com/es/posts/2/4/2/que_piensa_una_persona_cuando_dejas_de_buscarla_5242_orig.jpg")
;

INSERT INTO proveedores (prv_id, prv_nombre, prv_telefono, prv_ciudad)
VALUES (1, "Repuestos La 21", 60753564, "Girón"),
(2, "Mercao' Pelao'", 60456843, "Tunja"),
(3, "Electro-Calidad", 60856417, "San Gil")
;

--Este código fue hecho desde phpMyAdmin
INSERT INTO `facturas` (`fct_id`, `fct_empleado_id`, `fct_cliente_id`, `fct_fecha`) VALUES ('1', '1', '3', '2023-05-28'), ('2', '3', '1', '2023-05-29');

--Código por Cristian
SELECT * FROM facturas INNER JOIN empleados ON facturas.empleado_id = empleados.id INNER JOIN clientes ON facturas.cliente_id = clientes.id;
--modificado
SELECT facturas.fct_id, clientes.clt_nombre, empleados.emp_nombre, facturas.fct_fecha FROM facturas 
INNER JOIN empleados ON facturas.fct_empleado_id = empleados.emp_id 
INNER JOIN clientes ON facturas.fct_cliente_id = clientes.clt_id;

SELECT productos.prd_id, productos.prd_nombre, categorias.ctg_nombre, productos.prd_precio, productos.prd_stock, proveedores.prv_nombre, productos.prd_unidades_pedidas, productos.prd_descontinuado FROM productos
INNER JOIN categorias ON productos.prd_id_categoria = categorias.ctg_id
INNER JOIN proveedores ON productos.prd_id_proveedor = proveedores.prv_id;

SELECT facturas.fct_id, productos.prd_nombre, productos.prd_precio, factura_detalle.dtl_cantidad, factura_detalle.dtl_descuento FROM factura_detalle
INNER JOIN facturas ON factura_detalle.dtl_id_factura = facturas.fct_id
INNER JOIN productos ON factura_detalle.dtl_id_producto = productos.prd_id
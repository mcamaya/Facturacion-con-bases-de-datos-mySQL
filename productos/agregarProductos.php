<?php
require_once("conectProductos.php");
if (isset($_POST['guardar'])){
    $data = new Producto();
    $data->setNombre($_POST['nombre']);
    $data->setIdCategoria($_POST['categoria']);
    $data->setPrecio($_POST['precio']);
    $data->setStock($_POST['stock']);
    $data->setIdProveedor($_POST['proveedor']);
    $data->setUniPedidas($_POST['uni_pedidas']);
    $data->setDescontinuado($_POST['descontinuado']);

    $data->insertData();
    echo "<script>alert('Datos guardados con éxito');document.location='productos.php'</script>";

}
<?php
ini_set("display_errors", 1);
ini_set("display_startup_errors", 1);
error_reporting(E_ALL);


if(isset($_POST['guardarDatos'])){
    require_once("conectCategorias.php");

    $newCategory = new Categoria();
    
    $newCategory->setNombre($_POST['nombre']);
    $newCategory->setDescripcion($_POST['descripcion']);
    $newCategory->setImagen($_POST['imagen']);

    $newCategory->insertData();
    echo "<script>alert('Los datos fueron guardados exitosamente');document.location='categorias.php';</script>";
};
<?php
ini_set("display_errors", 1);
ini_set("display_startup_errors", 1);
error_reporting(E_ALL);

require_once("conectProductos.php");

if(isset($_GET['id']) && isset($_GET['req'])){
    if($_GET['req'] == 'delete'){
        $data = new Producto();

        $data->setId($_GET['id']);
        $data->delete();

        echo "<script>alert('Dato borrado con éxito');document.location='productos.php';</script>";
    }
}
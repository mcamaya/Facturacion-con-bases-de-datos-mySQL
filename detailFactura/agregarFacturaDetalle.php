<?php
ini_set("display_errors", 1);
ini_set("display_startup_errors", 1);
error_reporting(E_ALL);
require_once("conectDetailFactura.php");

if(isset($_POST['guardar'])){
    $data = new FacturaDetalle();
    

    $data->setIdFactura($_POST['id_factura']);
    $data->setIdProducto($_POST['producto']);
    $data->setCantidad($_POST['cantidad']);
    $data->setDcto($_POST['descuento']);

    print_r($data);
    $data->insertData();
    echo "<script>alert('Datos guardados con éxito');document.location='detailFactura.php';</script>";
}
/*  */
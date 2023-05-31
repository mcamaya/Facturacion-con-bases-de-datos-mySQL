<?php
ini_set("display_errors", 1);
ini_set("display_startup_errors", 1);
error_reporting(E_ALL);
require_once("conectFacturas.php");

if(isset($_POST['guardar'])){
    $data = new Factura();
    $data->setIdEmpleado($_POST['empleado']);
    $data->setIdCliente($_POST['cliente']);
    $data->setFecha($_POST['fecha']);

    print_r($data);
    $data->insertData();
    echo "<script>alert('Datos guardados con éxito');document.location='facturas.php'</script>";
}
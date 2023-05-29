<?php
ini_set("display_errors", 1);
ini_set("display_startup_errors", 1);
error_reporting(E_ALL);


if (isset($_POST['guardar'])){
    require_once("conectClientes.php");

    $newCustomer = new Cliente();

    $newCustomer->setNombre($_POST['nombre']);
    $newCustomer->setCelular($_POST['celular']);
    $newCustomer->setCorreo($_POST['correo']);

    $newCustomer->insertData();
    echo "<script>alert('Los datos fueron guardados exitosamente');document.location='clientes.php';</script>";
}
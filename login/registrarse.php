<?php
ini_set("display_errors", 1);
ini_set("display_startup_errors", 1);
error_reporting(E_ALL);

require_once("conectRegistro.php");
$registro = new Registro();

if(isset($_POST['registrarse'])){

    $registro->setIdEmpleado(3);
    $registro->setUsername($_POST['username']);
    $registro->setEmail($_POST['email']);
    $registro->setPassword($_POST['password']);

    $registro->insertData();
    echo "<script>alert('Dato guardado con éxito');document.location='loginRegistro.php';</script>";
}
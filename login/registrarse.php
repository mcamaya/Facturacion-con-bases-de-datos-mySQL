<?php
ini_set("display_errors", 1);
ini_set("display_startup_errors", 1);
error_reporting(E_ALL);


if(isset($_POST['registrarse'])){
    require_once("conectLogin.php");
    $registro = new Registro();

    $registro->setIdEmpleado(2);
    $registro->setUsername($_POST['username']);
    $registro->setEmail($_POST['email']);
    $registro->setPassword($_POST['password']);

    $registro->insertData();
    echo "<script>alert('Dato guardado con éxito); document.location='login.php';</script>";
}
<?php
ini_set("display_errors", 1);
ini_set("display_startup_errors", 1);
error_reporting(E_ALL);
session_start();

if(isset($_POST['loguearse'])){
    require_once ("conectLogin.php");

    $credenciales = new Login();

    $credenciales->setEmail($_POST['email']);
    $credenciales->setPassword($_POST['password']);


    $login = $credenciales->login();

    print_r($login);

    if($login) {
        header("Location: ../home/home.php");
    } else {
        echo "<script>alert('Usuario o contraseña incorrectos');";
    }

}
<?php

ini_set("display_errors", 1);
ini_set("display_startup_errors", 1);
error_reporting(E_ALL);


require_once("conectClientes.php");
$data = new Cliente();

// $_GET --> Recibe argumentos por url
if(isset($_GET['id']) && isset($_GET['req'])){
    if($_GET['req'] == 'delete') {
        
        $data->setId($_GET['id']);
        $data->delete();

        echo "<script>alert('La categoría fue eliminada exitosamente');document.location='clientes.php';</script>";
    }
}
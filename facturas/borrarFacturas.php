<?php
require_once("conectFacturas.php");

if(isset($_GET['id']) && isset($_GET['req'])){
    if($_GET['req'] == 'delete'){

        $data = new Factura();
        $id = $_GET['id'];
        
        $data->setId($id);
        $data->delete();

        echo "<script>alert('Dato borrado con éxito');document.location='facturas.php';</script>";
    }
}
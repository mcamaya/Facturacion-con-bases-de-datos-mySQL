<?php
require_once("conectEmpleados.php");

if(isset($_POST['guardar'])){
    $data = new Empleado();

    $data->setNombre($_POST['nombre']);
    $data->setCelular($_POST['celular']);
    $data->setDireccion($_POST['direccion']);
    $data->setImagen($_POST['imagen']);

    $data->insertData();
    echo "<script>alert('Datos añadidos con éxito');document.location='empleados.php'</script>";
}

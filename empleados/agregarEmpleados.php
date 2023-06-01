<?php
require_once("conectEmpleados.php");

if(isset($_POST['guardar'])){
    $data = new Empleado();

    $data->setNombre($_POST['nombre']);
    $data->setCelular($_POST['celular']);
    $data->setDireccion($_POST['direccion']);
    /* $data->setImagen($_POST['imagen']); */

    $imgBasename = $_FILES['imagen']['name'];
    $imgUrlTemp = $_FILES['imagen']['tmp_name'];


    $rutaASubir = "img_empleados/$imgBasename";

    var_dump(move_uploaded_file($imgUrlTemp, $rutaASubir));
    $data->setImagen($rutaASubir);

    $data->insertData();
    echo "<script>alert('Datos añadidos con éxito');document.location='empleados.php';</script>";
}
/* */
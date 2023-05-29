<?php
ini_set("display_errors", 1);
ini_set("display_startup_errors", 1);
error_reporting(E_ALL);

if(isset($_POST['guardar'])):
    require_once("conectProveedores.php");
    $newProveedor = new Proveedor();

    $newProveedor->setNombre($_POST['nombre']);
    $newProveedor->setTelefono($_POST['telefono']);
    $newProveedor->setCiudad($_POST['ciudad']);

    $newProveedor->insertData(); ?>

    <script>alert('Los datos fueron guardados exitosamente');document.location='proveedores.php';</script>;

<?php
endif;

<?php
require_once("../clientes/conectClientes.php");
require_once("../empleados/conectEmpleados.php");
require_once("conectFacturas.php");

$clientes = new Cliente();
$allClientes = $clientes->obtainAll();

$empleados = new Empleado();
$allEmpleados = $empleados->obtainAll();

$facturas = new Factura();
$allFacturas = $facturas->obtainAll_innerJoin();


?>

<!DOCTYPE html>
<html>

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Facturas</title>
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@200;400;600&display=swap" rel="stylesheet">
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet"
    integrity="sha384-KK94CHFLLe+nY2dmCWGMq91rCGa5gtU4mk92HdvYe+M/SXH301p5ILy+dN9+nJOZ" crossorigin="anonymous">


  <link rel="stylesheet" type="text/css" href="../css/pagina.css">

</head>

<body>
  <div class="contenedor">

    <div class="parte-izquierda">

      <div class="perfil">
        <h3 style="margin-bottom: 2rem;">Sistema de Facturación</h3>
        <img src="../css/avatar.png" alt="" class="imagenPerfil">
        <h3>Maicol Estrada</h3>
      </div>
      <div class="menus">

        <a href="../home/home.php" style="display: flex;gap:2px;">
          <i class="bi bi-house-door"> </i>
          <h3 style="margin: 0px;">Home</h3>
        </a>
        <a href="../categorias/categorias.php" style="display: flex;gap:1px;">
          <i class="bi bi-people"></i>
          <h3 style="margin: 0px;font-weight: 800;">Categorías</h3>
        </a>
        <a href="../clientes/clientes.php" style="display: flex;gap:1px;">
          <i class="bi bi-people"></i>
          <h3 style="margin: 0px;font-weight: 800;">Clientes</h3>
        </a>
        <a href="../empleados/empleados.php" style="display: flex;gap:1px;">
          <i class="bi bi-people"></i>
          <h3 style="margin: 0px;font-weight: 800;">Empleados</h3>
        </a>
        <a href="../proveedores/proveedores.php" style="display: flex;gap:1px;">
          <i class="bi bi-people"></i>
          <h3 style="margin: 0px;font-weight: 800;">Proveedores</h3>
        </a>
        <a href="../productos/productos.php" style="display: flex;gap:1px;">
          <i class="bi bi-people"></i>
          <h3 style="margin: 0px;font-weight: 800;">Productos</h3>
        </a>
        <a href="../facturas/facturas.php" style="display: flex;gap:1px;">
          <i class="bi bi-people"></i>
          <h3 style="margin: 0px;font-weight: 800;">Facturas</h3>
        </a>
        <a href="../detailFactura/detailFactura.php" style="display: flex;gap:1px;">
          <i class="bi bi-people"></i>
          <h3 style="margin: 0px;font-weight: 800;">Factura Detalle</h3>
        </a>

      </div>
    </div>

    <div class="parte-media">
      <div style="display: flex; justify-content: space-between;">
        <h2>Facturas</h2>
        <button class="btn-m" data-bs-toggle="modal" data-bs-target="#registrarEstudiantes"><i class="bi bi-person-add " style="color: rgb(255, 255, 255);" ></i></button>
      </div>
      <div class="menuTabla contenedor2">
        <table class="table table-custom ">
          <thead>
            <tr>
              <th scope="col">#</th>
              <th scope="col">EMPLEADO</th>
              <th scope="col">CLIENTE</th>
              <th scope="col">FECHA</th>
              <th scope="col">BORRAR</th>
            </tr>
          </thead>
          <tbody class="" id="tabla">

            <!-- ///////Llenado DInamico desde la Base de Datos -->
            <?php 
            foreach($allFacturas as $factura){
            ?>
            
            <tr>
              <td><?=$factura['fct_id'];?></td>
              <td><?=$factura['emp_nombre'];?></td>
              <td><?=$factura['clt_nombre'];?></td>
              <td><?=$factura['fct_fecha'];?></td>
              <td><a class="btn btn-danger" href="borrarFacturas.php?id=<?=$factura['fct_id']?>&req=delete">Borrar</a></td>
            </tr>

            <?php
            }
            ?>
       

          </tbody>
        
        </table>

      </div>


    </div>

    <div class="parte-derecho " id="detalles">
      <h3>Detalle</h3>
      <p>Cargando...</p>
       <!-- ///////Generando la grafica -->

    </div>





    <!-- /////////Modal de registro de nuevo estuiante //////////-->
    <div class="modal fade" id="registrarEstudiantes" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true" style="backdrop-filter: blur(5px)">
      <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable" >
        <div class="modal-content" >
          <div class="modal-header" >
            <h1 class="modal-title fs-5" id="exampleModalLabel">Nueva Factura</h1>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
          </div>
          <div class="modal-body" style="background-color: rgb(231, 253, 246);">

            <form class="col d-flex flex-wrap" action="agregarFacturas.php" method="post">
              <div class="mb-1 col-12">
                <label for="empleado" class="form-label">Empleado</label>

                <select class="form-control" name="empleado" id="empleado" required>
                <option value="select">Seleccione el empleado</option>
                  <?php
                  foreach($allEmpleados as $empleado){
                  ?>

                  <option name="empleado" value="<?=$empleado['emp_id'];?>"><?=$empleado['emp_nombre']?></option>

                  <?php
                  }
                  ?>
                </select>
                
              </div>

              <div class="mb-1 col-12">
                <label for="cliente" class="form-label">Cliente</label>
                <select class="form-control" name="cliente" id="cliente" required>
                <option value="select">Seleccione el cliente</option>
                  <?php
                  foreach($allClientes as $cliente){
                  ?>

                  <option name="cliente" value="<?=$cliente['clt_id'];?>"><?=$cliente['clt_nombre']?></option>

                  <?php
                  }
                  ?>
                </select>
              </div>

              <div class="mb-1 col-12">
                <label for="fecha" class="form-label">Fecha</label>
                <input 
                  type="date"
                  id="fecha"
                  name="fecha"
                  class="form-control"
                  required  
                 
                />
              </div>

              <div class=" col-12 m-2">
                <input type="submit" class="btn btn-primary" value="guardar" name="guardar"/>
              </div>
            </form>  
         </div>       
        </div>
      </div>
    </div>


    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js"
      integrity="sha384-ENjdO4Dr2bkBIFxQpeoTz1HIcje39Wm4jDKdf19U8gI4ddQ3GYNS7NTKfAdVQSZe"
      crossorigin="anonymous"></script>


</body>

</html>
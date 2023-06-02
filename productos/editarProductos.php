<?php
ini_set("display_errors", 1);
ini_set("display_startup_errors", 1);
error_reporting(E_ALL);
require_once("../categorias/conectCategorias.php");
require_once("../proveedores/conectProveedores.php");
require_once("conectProductos.php");

$categorias = new Categoria();
$allCategorias = $categorias->obtainAll();

$proveedores = new Proveedor();
$allProveedores = $proveedores->obtainAll();

$productos = new Producto();
$allProductos = $productos->obtainAll_innerJoin();

$id = $_GET['id'];
$data = new Producto();
$data->setId($id);

$record =  $data->obtainOne();
$val = $record[0];

print_r($val);

if (isset($_POST['guardar'])){
  $data->setNombre($_POST['nombre']);
    $data->setIdCategoria($_POST['categoria']);
    $data->setPrecio($_POST['precio']);
    $data->setStock($_POST['stock']);
    $data->setIdProveedor($_POST['proveedor']);
    $data->setUniPedidas($_POST['uni_pedidas']);
    $data->setDescontinuado($_POST['descontinuado']);

  $data->update();
  echo "<script>alert('Dato actualizado con éxito');document.location='productos.php';</script>";
}
?>
<!DOCTYPE html>
<html>

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Actualizar Producto</title>
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
        <h3 style="margin-bottom: 2rem;">Facturación</h3>
        <img src="../css/avatar.png" alt="" class="imagenPerfil">
        <h3 >Maicol Estrada</h3>
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
        <h2 class="m-2">Producto a Editar</h2>
      <div class="menuTabla contenedor2">
      <form class="col d-flex flex-wrap" action=""  method="post">
      <div class="mb-1 col-12">
                <label for="nombre" class="form-label">Nombre:</label>
                <input 
                  type="text"
                  id="nombre"
                  name="nombre"
                  class="form-control"
                  required
                  value="<?=$val['prd_nombre']?>"
                />
              </div>

              <div class="mb-1 col-12">
                <label for="categoria" class="form-label">Categoría</label>
                <select class="form-control" name="categoria" id="categoria" required>
                <option value="<?=$val['prd_id_categoria']?>">Select</option>

                  <?php foreach($allCategorias as $category):?>

                  <option name="categoria" value="<?=$category['ctg_id'];?>"><?=$category['ctg_nombre']?></option>

                  <?php endforeach; ?>
                </select>
              </div>

              <div class="mb-1 col-12">
                <label for="precio" class="form-label">Precio</label>
                <input 
                  type="number"
                  id="precio"
                  name="precio"
                  class="form-control"
                  required  
                  value="<?=$val['prd_precio']?>"
                />
              </div>

              <div class="mb-1 col-12">
                <label for="stock" class="form-label">stock</label>
                <input 
                  type="number"
                  id="stock"
                  name="stock"
                  class="form-control"
                  required  
                  value="<?=$val['prd_stock']?>"
                />
              </div>

              <div class="mb-1 col-12">
                <label for="proveedor" class="form-label">Proveedor</label>
                <select class="form-control" name="proveedor" id="proveedor" required>
                    <option value="<?=$val['prd_id_proveedor']?>"">Seleccione el proveedor</option>

                    <?php foreach($allProveedores as $proveedor):?>

                    <option name="proveedor" value="<?=$proveedor['prv_id'];?>"><?=$proveedor['prv_nombre']?></option>

                    <?php endforeach; ?>

                </select>
              </div>

              <div class="mb-1 col-12">
                <label for="uni_pedidas" class="form-label">Unidades Pedidas</label>
                <input 
                  type="number"
                  id="uni_pedidas"
                  name="uni_pedidas"
                  class="form-control"
                  required  
                  value="<?=$val['prd_unidades_pedidas']?>"
                />
              </div>

              <div class="mb-1 col-12">
                <label for="descontinuado" class="form-label">Descontinuado</label>
                <select class="form-control" name="descontinuado" id="descontinuado" required>
                    <option value="<?=$val['prd_descontinuado']?>">Seleccionar</option>
                    <option value="SI">SÍ</option>
                    <option value="NO">NO</option>
                </select>
              </div>

              <div class=" col-12 m-2">
                <input type="submit" class="btn btn-primary" value="Guardar" name="guardar"/>
              </div>
            </form>  
        <div id="charts1" class="charts"> </div>
      </div>
    </div>

    <div class="parte-derecho " id="detalles">
      <h3>Detalle</h3>
      <p>Cargando...</p>
       <!-- ///////Generando la grafica -->

    </div>

  </div>


  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js"
    integrity="sha384-ENjdO4Dr2bkBIFxQpeoTz1HIcje39Wm4jDKdf19U8gI4ddQ3GYNS7NTKfAdVQSZe"
    crossorigin="anonymous"></script>




</body>

</html>
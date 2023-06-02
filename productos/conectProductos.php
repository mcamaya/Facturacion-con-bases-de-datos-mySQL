<?php
ini_set("display_errors", 1);
ini_set("display_startup_errors", 1);
error_reporting(E_ALL);
require_once("../config/conexion.php");

class Producto extends Conectar{
    private $id;
    private $nombre;
    private $id_categoria;
    private $precio;
    private $stock;
    private $id_proveedor;
    private $uni_pedidas;
    private $descontinuado;

    public function __construct($id=0, $nombre="", $id_categoria=0, $precio=0, $stock=0, $id_proveedor=0, $uni_pedidas=0, $descontinuado="", $dbCnx=""){
        $this->id = $id;
        $this->nombre = $nombre;
        $this->id_categoria = $id_categoria;
        $this->precio = $precio;
        $this->stock = $stock;
        $this->id_proveedor = $id_proveedor;
        $this->uni_pedidas = $uni_pedidas;
        $this->descontinuado = $descontinuado;
        parent::__construct($dbCnx);
    }

    public function getId(){
        return $this->id;
    }
    public function setId($newId){
        $this->id = $newId;
    }
    public function getNombre(){
        return $this->nombre;
    }
    public function setNombre($newnNombre){
        $this->nombre = $newnNombre;
    }
    public function getIdCategoria(){
        return $this->id_categoria;
    }
    public function setIdCategoria($newIdCtg){
        $this->id_categoria = $newIdCtg;
    }
    public function getPrecio(){
        return $this->precio;
    }
    public function setPrecio($newPrecio){
        $this->precio = $newPrecio;
    }
    public function getStock(){
        return $this->stock;
    }
    public function setStock($newStock){
        $this->stock = $newStock;
    }
    public function getIdProveedor(){
        return $this->id_proveedor;
    }
    public function setIdProveedor($newIdPrv){
        $this->id_proveedor = $newIdPrv;
    }
    public function getUniPedidas(){
        return $this->uni_pedidas;
    }
    public function setUniPedidas($newUP){
        $this->uni_pedidas = $newUP;
    }
    public function getDescontinuado(){
        return $this->descontinuado;
    }
    public function setDescontinuado($newDes){
        $this->descontinuado = $newDes;
    }

    public function insertData(){
        try {
            $stm = $this->dbCnx->prepare("INSERT INTO productos (prd_nombre, prd_id_categoria, prd_precio, prd_stock, prd_id_proveedor, prd_unidades_pedidas, prd_descontinuado) values(?,?,?,?,?,?,?)");
            $stm->execute([$this->nombre, $this->id_categoria, $this->precio, $this->stock, $this->id_proveedor, $this->uni_pedidas, $this->descontinuado]);
        } catch (Exception $e) {
            return $e->getMessage();
        }
    }

    public function obtainAll_innerJoin(){
        try {
            $stm = $this->dbCnx->prepare("
            SELECT productos.prd_id, productos.prd_nombre, categorias.ctg_nombre, productos.prd_precio, productos.prd_stock, proveedores.prv_nombre, productos.prd_unidades_pedidas, productos.prd_descontinuado FROM productos
            INNER JOIN categorias ON productos.prd_id_categoria = categorias.ctg_id
            INNER JOIN proveedores ON productos.prd_id_proveedor = proveedores.prv_id;
            ");
            $stm->execute();
            return $stm->fetchAll();
        } catch (Exception $e) {
            return $e->getMessage();
        }
    }

    public function delete(){
        try {
            $stm = $this->dbCnx->prepare("DELETE FROM productos WHERE prd_id = ?");
            $stm->execute([$this->id]);
        } catch (Exception $e) {
            $e->getMessage();
        }
    }

    public function obtainOne(){
        try {
            $stm = $this->dbCnx->prepare("SELECT * FROM productos WHERE prd_id = ?");
            $stm->execute([$this->id]);
            return $stm->fetchAll();
        } catch (Exception $e) {
            $e->getMessage();
        }
    }

    public function update(){
        try {
            $stm = $this->dbCnx->prepare("UPDATE productos SET prd_nombre = ?, prd_id_categoria = ?, prd_precio = ?, prd_stock = ?, prd_id_proveedor = ?, prd_unidades_pedidas = ?, prd_descontinuado = ? WHERE prd_id = ?");
            $stm->execute([$this->nombre, $this->id_categoria, $this->precio, $this->stock, $this->id_proveedor, $this->uni_pedidas, $this->descontinuado, $this->id]);
            return $stm->fetchAll();
        } catch (Exception $e) {
            $e->getMessage();
        }
    }
}

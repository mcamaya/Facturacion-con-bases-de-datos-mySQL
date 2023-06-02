<?php
ini_set("display_errors", 1);
ini_set("display_startup_errors", 1);
error_reporting(E_ALL);
require_once("../config/conexion.php");

class FacturaDetalle extends Conectar{
    private $id_factura;
    private $id_producto;
    private $cantidad;
    private $descuento;

    public function __construct($id_factura=0, $id_producto=0, $cantidad=0, $descuento=0, $dbCnx=""){
        $this->id_factura = $id_factura;
        $this->id_producto = $id_producto;
        $this->cantidad = $cantidad;
        $this->descuento = $descuento;
        parent::__construct($dbCnx);
    }

    public function getIdFactura(){
        return $this->id_factura;
    }
    public function setIdFactura($newId){
        $this->id_factura = $newId;
    }
    public function getIdProducto(){
        return $this->id_producto;
    }
    public function setIdProducto($newId){
        $this->id_producto = $newId;
    }
    public function getCantidad(){
        return $this->cantidad;
    }
    public function setCantidad($newCant){
        $this->cantidad = $newCant;
    }
    public function getDcto(){
        return $this->descuento;
    }
    public function setDcto($newDcto){
        $this->descuento = $newDcto;
    }

    public function insertData(){
        try {
            $stm = $this->dbCnx->prepare("INSERT INTO factura_detalle (dtl_id_factura, dtl_id_producto, dtl_cantidad, dtl_descuento) values(?,?,?,?)");
            $stm->execute([$this->id_factura, $this->id_producto, $this->cantidad, $this->descuento]);
        } catch (Exception $e) {
            return $e->getMessage();
        }
    }

    public function obtainAll(){
        try {
            $stm = $this->dbCnx->prepare("SELECT * FROM factura_detalle");
            $stm->execute();
            return $stm->fetchAll();
        } catch (Exception $e) {
            return $e->getMessage();
        }
    }

    public function obtainAll_innerJoin(){
        try {
            $stm = $this->dbCnx->prepare("
            SELECT facturas.fct_id, productos.prd_nombre, productos.prd_precio, factura_detalle.dtl_cantidad, factura_detalle.dtl_descuento FROM factura_detalle
            INNER JOIN facturas ON factura_detalle.dtl_id_factura = facturas.fct_id
            INNER JOIN productos ON factura_detalle.dtl_id_producto = productos.prd_id
            ");
            $stm->execute();
            return $stm->fetchAll();
        } catch (Exception $e) {
            return $e->getMessage();
        }
    }

    /* public function delete(){
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
    } */
}

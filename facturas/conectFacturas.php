<?php
ini_set("display_errors", 1);
ini_set("display_startup_errors", 1);
error_reporting(E_ALL);
require_once("../config/conexion.php");

class Factura extends Conectar{
    private $id;
    private $id_empleado;
    private $id_cliente;
    private $fecha;

    public function __construct($id=0, $id_empleado=0, $id_cliente=0, $fecha="", $dbCnx=""){
        $this->id = $id;
        $this->id_empleado = $id_empleado;
        $this->id_cliente = $id_cliente;
        $this->fecha = $fecha;

        parent::__construct($dbCnx);
    }

    public function getId(){
        return $this->id;
    }
    public function setId($newId){
        $this->id = $newId;
    }
    public function getIdEmpleado(){
        return $this->id_empleado;
    }
    public function setIdEmpleado($newIdEmp){
        $this->id_empleado = $newIdEmp;
    }
    public function getIdCliente(){
        return $this->id_cliente;
    }
    public function setIdCliente($newIdCli){
        $this->id_cliente = $newIdCli;
    }
    public function getFecha(){
        return $this->fecha;
    }
    public function setFecha($newDate){
        $this->fecha = $newDate;
    }

    public function insertData(){
        try {
            $stm = $this->dbCnx->prepare("INSERT INTO facturas (fct_empleado_id, fct_cliente_id, fct_fecha) values(?,?,?)");
            $stm->execute([$this->id_empleado, $this->id_cliente, $this->fecha]);
        } catch (Exception $e) {
            return $e->getMessage();
        }
    }

    public function obtainAll_innerJoin(){
        try {
            $stm = $this->dbCnx->prepare("
            SELECT facturas.fct_id, empleados.emp_nombre, clientes.clt_nombre, facturas.fct_fecha FROM facturas
            INNER JOIN empleados ON facturas.fct_empleado_id = empleados.emp_id 
            INNER JOIN clientes ON facturas.fct_cliente_id = clientes.clt_id;
            ");
            $stm->execute();
            return $stm->fetchAll();
        } catch (Exception $e) {
            return $e->getMessage();
        }
    }

    public function delete(){
        try {
            $stm = $this->dbCnx->prepare("DELETE FROM facturas WHERE fct_id = ?");
            $stm->execute([$this->id]);
        } catch (Exception $e) {
            $e->getMessage();
        }
    }
}

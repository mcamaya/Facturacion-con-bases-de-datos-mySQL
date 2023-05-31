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
            $stm = $this->dbCnx->prepare("INSERT INTO facturas (empleado_id, cliente_id, fecha) values(?,?,?)");
            $stm->execute([$this->id_empleado, $this->id_cliente, $this->fecha]);
        } catch (Exception $e) {
            return $e->getMessage();
        }
    }

    public function obtainAll_innerJoin(){
        try {
            $stm = $this->dbCnx->prepare("
            SELECT facturas.id, empleados.nombre, clientes.nombre, facturas.fecha FROM facturas
            INNER JOIN empleados ON facturas.empleado_id = empleados.id 
            INNER JOIN clientes ON facturas.cliente_id = clientes.id;
            ");
            $stm->execute();
            return $stm->fetchAll();
        } catch (Exception $e) {
            return $e->getMessage();
        }
    }
}

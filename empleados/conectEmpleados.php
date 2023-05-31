<?php
require_once("../config/conexion.php");

class Empleado extends Conectar{
    private $id;
    private $nombre;
    private $celular;
    private $direccion;
    private $imagen;

    public function __construct($id=0, $nombre="", $celular=0, $direccion="", $imagen="", $dbCnx=""){
        $this->nombre = $nombre;
        $this->celular = $celular;
        $this->direccion = $direccion;
        $this->imagen = $imagen;

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
    public function setNombre($newNombre){
        $this->nombre = $newNombre;
    }

    public function getCelular(){
        return $this->celular;
    }
    public function setCelular($newCelular){
        $this->celular = $newCelular;
    }

    public function getDireccion(){
        return $this->direccion;
    }
    public function setDireccion($newDireccion){
        $this->direccion = $newDireccion;
    }

    public function getImagen(){
        return $this->imagen;
    }
    public function setImagen($newImagen){
        $this->imagen = $newImagen;
    }


    public function insertData(){
        try {
            $stm = $this->dbCnx->prepare("INSERT INTO empleados (emp_nombre, emp_celular, emp_direccion, emp_imagen) values(?,?,?,?)");
            $stm->execute([$this->nombre, $this->celular, $this->direccion, $this->imagen]);
        } catch (Exception $e) {
            $e->getMessage();
        }
    }

    public function obtainAll(){
        try {
            $stm = $this->dbCnx->prepare("SELECT * FROM empleados");
            $stm->execute();
            return $stm->fetchAll();
        } catch (Exception $e) {
            $e->getMessage();
        }
    }

    public function delete(){
        try {
            $stm = $this->dbCnx->prepare("DELETE FROM empleados WHERE emp_id = ?");
            $stm->execute([$this->id]);
        } catch (Exception $e) {
            $e->getMessage();
        }
    }

    public function obtainOne(){
        try {
            $stm = $this->dbCnx->prepare("SELECT * FROM empleados WHERE emp_id = ?");
            $stm->execute([$this->id]);
            return $stm->fetchAll();
        } catch (Exception $e) {
            $e->getMessage();
        }
    }

    public function update(){
        try {
            $stm = $this->dbCnx->prepare("UPDATE empleados SET emp_nombre = ?, emp_celular = ?, emp_direccion = ?, emp_imagen = ? WHERE emp_id = ?");
            $stm->execute([$this->nombre, $this->celular, $this->direccion, $this->imagen, $this->id]);
            return $stm->fetchAll();
        } catch (Exception $e) {
            $e->getMessage();
        }
    }
}
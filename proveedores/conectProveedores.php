<?php
require_once("../config/conexion.php");

class Proveedor extends Conectar{
    private $id;
    private $nombre;
    private $telefono;
    private $ciudad;

    public function __construct($id=0, $nombre="", $telefono=0, $ciudad="", $dbCnx=""){
        $this->id = $id;
        $this->nombre = $nombre;
        $this->telefono = $telefono;
        $this->ciudad = $ciudad;
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

    public function getTelefono(){
        return $this->telefono;
    }
    public function setTelefono($newTelefono){
        $this->telefono = $newTelefono;
    }

    public function getCiudad(){
        return $this->ciudad;
    }
    public function setCiudad($newCiudad){
        $this->ciudad = $newCiudad;
    }

    public function insertData(){
        try {
            $stm = $this->dbCnx->prepare("INSERT INTO proveedores (nombre, telefono, ciudad) values(?,?,?)");
            $stm->execute([$this->nombre, $this->telefono, $this->ciudad]);
        } catch (Exception $e) {
            return $e->getMessage();
        }
    }

    public function obtainAll(){
        try {
            $stm = $this->dbCnx->prepare("SELECT * FROM proveedores");
            $stm->execute();
            return $stm->fetchAll();
        } catch (Exception $e) {
            return $e->getMessage();
        }
    }

    public function delete(){
        try {
            $stm = $this->dbCnx->prepare("DELETE FROM proveedores WHERE id = ?");
            $stm -> execute([$this->id]);
            return $stm->fetchAll();
        } catch (Exception $e) {
            return $e->getMessage();
        }
    }

    public function obtainOne(){
        try {
            $stm = $this->dbCnx->prepare("SELECT * FROM proveedores WHERE id = ?");
            $stm->execute([$this->id]);
            return $stm -> fetchAll();
        } catch (Exception $e) {
            return $e->getMessage();
        }
    }

    public function update(){
        try {
            $stm = $this->dbCnx->prepare("UPDATE proveedores SET nombre = ?, telefono = ?, ciudad = ? WHERE id = ?");
            $stm -> execute([$this->nombre, $this->telefono, $this->ciudad, $this->id]);
        } catch (Exception $e) {
            return $e->getMessage();
        }
    }

}
<?php
require_once("../db.php");

class Config{
    private $id;
    private $nombre;
    private $celular;
    private $direccion;
    private $imagen;
    protected $dbCnx;

    public function __construct($id=0, $nombre="", $celular=0, $direccion="", $imagen=""){
        $this->nombre = $nombre;
        $this->celular = $celular;
        $this->direccion = $direccion;
        $this->imagen = $imagen;
        $this->dbCnx = new PDO(DB_TYPE.":host=".DB_HOST.";dbname=".DB_NAME, DB_USER, DB_PWD, [PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC]);
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
            $stm = $this->dbCnx->prepare("INSERT INTO empleados (nombre, celular, direccion, imagen) values(?,?,?,?)");
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
            $stm = $this->dbCnx->prepare("DELETE FROM empleados WHERE id = ?");
            $stm->execute([$this->id]);
        } catch (Exception $e) {
            $e->getMessage();
        }
    }

    public function obtainOne(){
        try {
            $stm = $this->dbCnx->prepare("SELECT * FROM empleados WHERE id = ?");
            $stm->execute([$this->id]);
            return $stm->fetchAll();
        } catch (Exception $e) {
            $e->getMessage();
        }
    }

    public function update(){
        try {
            $stm = $this->dbCnx->prepare("UPDATE empleados SET nombre = ?, celular = ?, direccion = ?, imagen = ? WHERE id = ?");
            $stm->execute([$this->nombre, $this->celular, $this->direccion, $this->imagen, $this->id]);
            return $stm->fetchAll();
        } catch (Exception $e) {
            $e->getMessage();
        }
    }
}
<?php
require_once("../db.php");

class Config{
    private $id;
    private $nombre;
    private $telefono;
    private $ciudad;
    protected $dbCnx;

    public function __construct($id=0, $nombre="", $telefono=0, $ciudad=""){
        $this->id = $id;
        $this->nombre = $nombre;
        $this->telefono = $telefono;
        $this->ciudad = $ciudad;

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
}
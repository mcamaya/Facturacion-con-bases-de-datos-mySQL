<?php
require_once("../db.php");

class Config{
    private $id;
    private $nombre;
    private $celular;
    private $correo;
    protected $dbCnx;

    public function __construct($id=0, $nombre="", $celular="", $correo=""){
        $this->id = $id;
        $this->nombre = $nombre;
        $this->celular = $celular;
        $this->correo = $correo;

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

    public function getCorreo(){
        return $this->correo;
    }
    public function setCorreo($newCorreo){
        $this->correo = $newCorreo;
    }

    public function insertData(){
        try {
            $stm = $this->dbCnx->prepare("INSERT INTO clientes (nombre, celular, correo) values(?,?,?)");
            $stm->execute([$this->nombre, $this->celular, $this->correo]);
        } catch (Exception $e) {
            return $e->getMessage();
        }
    }

    public function obtainAll(){
        try {
            $stm = $this->dbCnx->prepare("SELECT * FROM clientes");
            $stm->execute();
            return $stm->fetchAll();
        } catch (Exception $e) {
            return $e->getMessage();
        }
    }

    public function obtainOne(){
        try {
            $stm = $this->dbCnx->prepare("SELECT * FROM clientes WHERE id = ?");
            $stm->execute([$this->id]);
            return $stm->fetchAll();
        } catch (Exception $e) {
            return $e->getMessage();
        }
    }

    public function update(){
        try {
            $stm = $this->dbCnx->prepare("UPDATE clientes SET nombre = ?, celular = ?, correo = ? WHERE id = ?");
            $stm->execute([$this->nombre, $this->celular, $this->correo, $this->id]);
            return $stm->fetchAll();
        } catch (Exception $e) {
            return $e->getMessage();
        }
    }
}
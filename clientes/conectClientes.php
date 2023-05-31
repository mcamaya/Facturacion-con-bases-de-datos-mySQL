<?php
require_once("../config/conexion.php");

class Cliente extends Conectar{
    private $id;
    private $nombre;
    private $celular;
    private $correo;

    public function __construct($id=0, $nombre="", $celular="", $correo="", $dbCnx=""){
        $this->id = $id;
        $this->nombre = $nombre;
        $this->celular = $celular;
        $this->correo = $correo;

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

    public function getCorreo(){
        return $this->correo;
    }
    public function setCorreo($newCorreo){
        $this->correo = $newCorreo;
    }

    public function insertData(){
        try {
            $stm = $this->dbCnx->prepare("INSERT INTO clientes (clt_nombre, clt_celular, clt_correo) values(?,?,?)");
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
            $stm = $this->dbCnx->prepare("SELECT * FROM clientes WHERE clt_id = ?");
            $stm->execute([$this->id]);
            return $stm->fetchAll();
        } catch (Exception $e) {
            return $e->getMessage();
        }
    }

    public function update(){
        try {
            $stm = $this->dbCnx->prepare("UPDATE clientes SET clt_nombre = ?, clt_celular = ?, clt_correo = ? WHERE clt_id = ?");
            $stm->execute([$this->nombre, $this->celular, $this->correo, $this->id]);
            return $stm->fetchAll();
        } catch (Exception $e) {
            return $e->getMessage();
        }
    }

    public function delete(){
        try {
            $stm = $this->dbCnx->prepare("DELETE FROM clientes WHERE clt_id = ?");
            $stm -> execute([$this->id]);
            return $stm->fetchAll();
        } catch (Exception $e) {
            return $e->getMessage();
        }
    }
}
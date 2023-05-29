<?php
require_once("../config/conexion.php");

class Categoria extends Conectar {
    private $id;
    private $nombre;
    private $descripcion;
    private $imagen;

    public function __construct($id= 0, $nombre = "", $descripcion = "", $imagen = "", $dbCnx=""){
        $this->id = $id;
        $this->nombre = $nombre;
        $this->descripcion = $descripcion;
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

    public function getDescripcion(){
        return $this->descripcion;
    }
    public function setDescripcion($newDescripcion){
        $this->descripcion = $newDescripcion;
    }

    public function getImagen(){
        return $this->image;
    }
    public function setimagen($newImagen){
        $this->imagen = $newImagen;
    }


    public function insertData(){
        try {
            $stm = $this->dbCnx->prepare("INSERT INTO categorias (nombre, descripcion, imagen) values(?,?,?)");
            $stm -> execute([$this->nombre, $this->descripcion, $this->imagen]);
        } catch (Exception $e) {
            return $e->getMessage();
        }
    }


    public function obtainAll(){
        try {
            $stm = $this->dbCnx->prepare("SELECT * FROM categorias");
            $stm->execute();
            return $stm->fetchAll();
        } catch (Exception $e) {
            return $e->getMessage();
        }
    }

    public function delete(){
        try {
            $stm = $this->dbCnx->prepare("DELETE FROM categorias WHERE id = ?");
            $stm -> execute([$this->id]);
            return $stm->fetchAll();
        } catch (Exception $e) {
            return $e->getMessage();
        }
    }

    public function obtainOne(){
        try {
            $stm = $this->dbCnx->prepare("SELECT * FROM categorias WHERE id = ?");
            $stm->execute([$this->id]);
            return $stm -> fetchAll();
        } catch (Exception $e) {
            return $e->getMessage();
        }
    }

    public function update(){
        try {
            $stm = $this->dbCnx->prepare("UPDATE categorias SET nombre = ?, descripcion = ?, imagen = ? WHERE id = ?");
            $stm -> execute([$this->nombre, $this->descripcion, $this->imagen, $this->id]);
        } catch (Exception $e) {
            return $e->getMessage();
        }
    }

    
}
<?php

class Config {
    private $id;
    private $nombre;
    private $descripcion;
    private $imagen;

    protected $dbCnx; // conexión database

    public function __construct($id= 0, $nombre = "", $descripcion = "", $imagen = ""){
        $this->id = $id;
        $this->nombre = $nombre;
        $this->descripcion = $descripcion;
        $this->imagen = $imagen;
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

    public function getImage(){
        return $this->image;
    }
    public function setimage($newImage){
        $this->image = $newImage;
    }
}
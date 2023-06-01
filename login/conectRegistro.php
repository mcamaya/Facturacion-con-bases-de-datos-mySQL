<?php
ini_set("display_errors", 1);
ini_set("display_startup_errors", 1);
error_reporting(E_ALL);

require_once("../config/conexion.php");
require_once('../config/db.php');
require_once("../conectLogin.php");

class Registro extends Conectar {
    private $id;
    private $id_empleado;
    private $email;
    private $username;
    private $password;

    public function __construct($id=0, $id_empleado=0, $email="", $username="", $password="", $dbCnx=""){
        $this->id = $id;
        $this->id_empleado = $id_empleado;
        $this->email = $email;
        $this->username = $username;
        $this->password = $password;

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
    public function setIdEmpleado($newId){
        $this->id_empleado = $newId;
    } 
    public function getEmail(){
        return $this->email;
    }
    public function setEmail($newEmail){
        $this->email = $newEmail;
    }
    public function getUsername(){
        return $this->username;
    }
    public function setUsername($newUser){
        $this->username = $newUser;
    }
    public function getPassword(){
        return $this->password;
    }
    public function setPassword($newPass){
        $this->password = $newPass;
    }

    public function checkUser($email){
        try {
            $stm = $this->dbCnx->prepare("SELECT * FROM users WHERE usr_email = '$email'");
            $stm->execute();
            if($stm->fetchColumn()){
                return true;
            } else {
                return false;
            }
        } catch (Exception $e) {
            return $e->getMessage();
        }
    }
    
    public function insertData(){
        try {
            $stm = $this->dbCnx->prepare("INSERT INTO users (usr_id_empleado, usr_email, usr_username, usr_password) values(?,?,?,?)");
            $stm->execute([$this->id_empleado, $this->email, $this->username, MD5($this->password)]);
        
            
        } catch (Exception $e) {
            return $e->getMessage();
        }
    }

}


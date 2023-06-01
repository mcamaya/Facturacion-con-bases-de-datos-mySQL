<?php

ini_set("display_errors", 1);
ini_set("display_startup_errors", 1);
error_reporting(E_ALL);

require_once("../config/conexion.php");
require_once("../config/db"); ///cargue

class Login extends Conectar {
    private $id;
    private $email;
    private $password;

    public function __construct($id=0, $email="", $password="", $dbCnx=""){
        $this->id = $id;
        $this->email = $email;
        $this->password = $password;

        parent::__construct($dbCnx);
    }

    public function getId(){
        return $this->id;
    }
    public function setId($newId){
        $this->id = $newId;
    }
    public function getEmail(){
        return $this->email;
    }
    public function setEmail($newEmail){
        $this->email = $newEmail;
    }
    public function getPassword(){
        return $this->password;
    }
    public function setPassword($newPass){
        $this->password = $newPass;
    }
    
    public function obtainAll(){
        try {
            $stm = $this->dbCnx->prepare("SELECT * FROM users");
            $stm->execute();
            return $stm->fetchAll();
        } catch (Exception $e) {
            $e->getMessage();
        }
    }

    public function login(){
        try {
            $stm = $this->dbCnx->prepare("SELECT * FROM users WHERE usr_email = ?, usr_password = ?");
            $stm->execute([$this->email, MD5($this->password)]);
            $user = $stm->fetchAll();

            if(count($user) > 0){
                session_start();
                $_SESSION['id'] = $user[0]['id'];
                $_SESSION['email'] = $user[0]['email'];
                $_SESSION['password'] = $user[0]['password'];
                $_SESSION['username'] = $user[0]['username'];
                return true;
            } else {
                return false;
            }
        } catch (Exception $e) {
            $e->getMessage();
        }
    }
}


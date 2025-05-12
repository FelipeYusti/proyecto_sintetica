<?php

class LoginModel extends Mysql{

    private $intIdUsuario;
    private $strUsuario;
    private $strToken;

    public function __construct(){
        parent::__construct();
    }

    public function loginUser(string $usuario, string $password){
        $this->strUsuario = $usuario;
        $this->strPassword = $password;
        $sql = "SELECT idusers, status FROM users WHERE
        username = '{$this->strUsuario}' AND
        password = '{$this->strPassword}' AND
        status != 0";
        
        $request = $this->select($sql);
        return $request;        
    }

    public function sessionLogin(int $idUser){
        $this->intUsuario = $idUser;

        $sql = "SELECT u.idusers, 
        u.username,
        u.correo,
        u.rol,
        u.status
        FROM users u
        WHERE u.idusers = {$this->intUsuario}";

        $request = $this->select($sql);
        return $request;
    }

}
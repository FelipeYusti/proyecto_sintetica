<?php

class UsuariosModel extends Mysql
{

    private $table_name = "users";
    public function __construct()
    {
        parent::__construct();
    }

    public function getAll()
    {
        $sql = "SELECT idusers AS ID, username,correo,rol,status FROM " . $this->table_name . " WHERE status > 0";
        $request = $this->select_all($sql);
        return $request;
    }

    public function getById(int $idUsuario)
    {
        $this->idUsuario = $idUsuario;
        $sql = "SELECT idusers AS ID, username, password,correo,rol,status FROM " . $this->table_name . " WHERE status > 0 AND idusers = {$this->idUsuario}";
        $request = $this->select($sql);
        return $request;
    }

    public function add(string $username, string $password, string $email, string $rol)
    {
        $this->username = $username;
        $this->email = $email;
        $this->rol = $rol;
        $this->password = $password;
        $this->password = password_hash($this->password, PASSWORD_BCRYPT);
        $query_usuarios = "SELECT * FROM users WHERE username = '{$this->username}' AND status > 0";

        $request = $this->select_all($query_usuarios);

        if (!empty($request)) {
            $respuesta = 'exist';
        } else {
            $query_insert = "INSERT INTO users(username,password,correo,rol,status) VALUES(?,?,?,?,?)";
            $arrData = array(
                $this->username,
                $this->password,
                $this->email,
                $this->rol,
                1
            );
            $reques_insert = $this->insert($query_insert, $arrData);
            $respuesta = $reques_insert;
        }

        return $respuesta;
    }

    public function updat(string $username, string $password, string $email, string $rol, int $status, int $idUser)
    {
        $this->username = $username;
        $this->password = $password;
        $this->email = $email;
        $this->rol = $rol;
        $this->idUser = $idUser;
        $this->status = $status;

        if (!empty($this->password)) {
            $this->password = password_hash($this->password, PASSWORD_BCRYPT);
        }
        $sql = "SELECT * FROM users WHERE username = '{$this->username}' AND status > 0 AND rol = 'admin'";

        $request = $this->select_all($sql);

        if (!empty($request)) {
            $respuesta = 'exist';
        } else {
            $query_update = "UPDATE users 
            SET username = ?,password = ?,correo = ?, rol = ?, status = ? WHERE status > 0 AND idusers = {$this->idUser}";
            $arrData = array(
                $this->username,
                $this->password,
                $this->email,
                $this->rol,
                $this->status
            );
            $reques_update = $this->update($query_update, $arrData);
            $respuesta = $reques_update;
        }

        return $respuesta;
    }

    public function delet(int $idUser)
    {
        $this->idUser = $idUser;

        $sql = "UPDATE users SET status = ? WHERE idusers = {$this->idUser}";
        $arrData = array(0);
        $request = $this->update($sql, $arrData);
        return $request;
    }
}

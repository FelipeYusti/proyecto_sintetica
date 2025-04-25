<?php
class HomeModel extends Mysql
{

    private $table_name = "canchas";
    public function __construct()
    {
        parent::__construct();
    }


    public function getRevenueMonth()
    {
        $mes = date('m');
        $sql = "SELECT idcanchas AS ID, nombre, tipo,capacidad,valor,status FROM " . $this->table_name . " WHERE status > 0";
        $request = $this->select_all($sql);
        return $request;
    }
    public function getRevenueYear()
    {
        $año = date('Y');
        $sql = "SELECT idcanchas AS ID, nombre,tipo,capacidad,valor,status FROM "
            . $this->table_name . " WHERE status > 0 AND idcanchas = {$this->año}";
        $request = $this->select($sql);
        return $request;
    }

    public function getCountReser()
    {
        $mes = date('m');
        $sql = "SELECT idcanchas AS ID, nombre,tipo,capacidad,valor,status FROM "
            . $this->table_name . " WHERE status > 0 AND idcanchas = {$this->$mes}";
        $request = $this->select($sql);
        return $request;
    }
    public function getCountReserYear()
    {
        $this->idCancha = $idCancha;
        $sql = "SELECT idcanchas AS ID, nombre,tipo,capacidad,valor,status FROM "
            . $this->table_name . " WHERE status > 0 AND idcanchas = {$this->idCancha}";
        $request = $this->select($sql);
        return $request;
    }

    public function getCountAgreements()
    {


        $sql = "SELECT idcanchas AS ID, nombre,tipo,capacidad,valor,status FROM "
            . $this->table_name . " WHERE status > 0 AND idcanchas = {}";
        $request = $this->select($sql);
        return $request;
    }
}

<?php
class HomeModel extends Mysql
{

    private $table_name = "canchas";
    public function __construct()
    {
        parent::__construct();
    }


    public function getRevenueMonth($month, $year)
    {
        $this->month = $month;
        $this->year = $year;
        $sql = "SELECT reservas.nombre, fecha FROM reservas WHERE MONTH(fecha) = {$this->month} AND YEAR(fecha) = {$this->year} AND status= 1;";
        $request = $this->select_all($sql);
        return $request;
    }
    public function getRevenueYear($year)
    {
        $this->year = $year;
        $sql = "SELECT reservas.nombre, fecha FROM reservas WHERE year(fecha)= {$this->year} AND status= 1; ";
        $request = $this->select($sql);
        return $request;
    }

    public function getReserMonth($month, $year)
    {
        $this->month = $month;
        $this->year = $year;
        $sql = "SELECT reservas.nombre, fecha FROM reservas WHERE MONTH(fecha) = {$this->month} AND YEAR(fecha) = {$this->year} AND status= 1;";
        $request = $this->select_all($sql);
        return $request;
    }
    public function getCountReserYear($year)
    {
        $this->year = $year;
        $sql = "SELECT fecha,COUNT(reservas.idreservas) as cantidad FROM reservas WHERE year(fecha)= 2025 AND status= 1; ";
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

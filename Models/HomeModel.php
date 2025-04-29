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
    public function getRevenueYear()
    {

        $sql = "SELECT reservas.idreservas,reservas_has_canchas.idreservas_idreservas as idPivot,reservas.nombre as nombreReserva,reservas_has_canchas.fecha as fechaReserva,
        canchas.nombre as nombreCancha,canchas.tipo as tipoCancha,canchas.valor as valorCancha,reservas_has_canchas.horaReserva from reservas_has_canchas 
        JOIN reservas ON reservas.idreservas=reservas_has_canchas.reservas_idreservas 
        JOIN canchas ON canchas.idcanchas=reservas_has_canchas.canchas_idcanchas WHERE reservas.status>0 ";
        $request = $this->select($sql);
        return $request;
    }

    public function getReserMonth()
    {
        $sql = "SELECT DATE_FORMAT(fecha, '%Y-%m') AS mes, COUNT(*) AS cantidad FROM reservas GROUP BY DATE_FORMAT(fecha, '%Y-%m') ORDER BY mes;";
        $request = $this->select($sql);
        return $request;
    }
    public function getCountReserYear()
    {
        $sql = "SELECT MONTHNAME(fecha) AS mes, COUNT(*) AS cantidad 
        FROM reservas WHERE YEAR(fecha) = YEAR(CURDATE()) 
        GROUP BY MONTH(fecha), MONTHNAME(fecha) ORDER BY MONTH(fecha);";
        $request = $this->select_all($sql);
        return $request;
    }

    public function getCountAgreements()
    {
        $sql = "SELECT COUNT(convenios.idconvenios) as cantidad FROM convenios WHERE status >=0;";
        $request = $this->select($sql);
        return $request;
    }
}

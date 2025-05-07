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

        $sql = "SELECT SUM(canchas.valor) AS totalMes FROM reservas_has_canchas 
        JOIN reservas ON reservas.idreservas = reservas_has_canchas.reservas_idreservas
        JOIN canchas ON canchas.idcanchas = reservas_has_canchas.canchas_idcanchas
        WHERE reservas.status > 0 AND YEAR(reservas_has_canchas.fecha) = YEAR(CURDATE())
        AND MONTH(reservas_has_canchas.fecha) = MONTH(CURDATE());";
        $request = $this->select($sql);
        return $request;
    }
    public function getRevenueYear()
    {
        $sql = "SELECT SUM(canchas.valor) AS totalAno FROM reservas_has_canchas JOIN reservas ON reservas.idreservas = reservas_has_canchas.reservas_idreservas JOIN canchas ON canchas.idcanchas = reservas_has_canchas.canchas_idcanchas WHERE reservas.status > 0 AND YEAR(reservas_has_canchas.fecha) = YEAR(CURDATE());";
        $request = $this->select($sql);
        return $request;
    }
    public function getRevenueMonthYear()
    {

        $sql = "SELECT MONTH(reservas_has_canchas.fecha) AS numero, MONTHNAME(reservas_has_canchas.fecha) AS mes, SUM(canchas.valor) AS ganancias FROM reservas_has_canchas JOIN reservas ON reservas.idreservas = reservas_has_canchas.reservas_idreservas JOIN canchas ON canchas.idcanchas = reservas_has_canchas.canchas_idcanchas WHERE reservas.status > 0 AND YEAR(reservas_has_canchas.fecha) = YEAR(CURDATE()) GROUP BY numero, mes ORDER BY numero ";
        $request = $this->select_all($sql);
        return $request;
    }

    public function getReserYear()
    {
        $sql = "SELECT COUNT(*) AS cantidad  FROM reservas WHERE YEAR(fecha) = YEAR(CURDATE()) ;";
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
    public function getCountReserToday()
    {
        $sql = "SELECT COUNT(*) AS cantidadHoy FROM  reservas WHERE  DATE(fecha) = CURDATE();";
        $request = $this->select($sql);
        return $request;
    }

    public function getCountAgreements()
    {
        $sql = "SELECT COUNT(convenios.idconvenios) as cantidad FROM convenios WHERE status >=0;";
        $request = $this->select($sql);
        return $request;
    }
}

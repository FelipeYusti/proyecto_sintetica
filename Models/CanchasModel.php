<?php
class CanchasModel extends Mysql
{

    private $table_name = "canchas";
    public function __construct()
    {
        parent::__construct();
    }


    public function getAll()
    {
        $sql = "SELECT idcanchas AS ID, nombre, tipo,capacidad,valor,status FROM " . $this->table_name . " WHERE status > 0";
        $request = $this->select_all($sql);
        return $request;
    }

    public function getById(int $idCancha)
    {
        $this->idCancha = $idCancha;
        $sql = "SELECT idcanchas AS ID, nombre,tipo,capacidad,valor,status FROM "
            . $this->table_name . " WHERE status > 0 AND idcanchas = {$this->idCancha}";
        $request = $this->select($sql);
        return $request;
    }

    public function add(string $name, string $type, string $capacitance, int $price)
    {
        $this->name = $name;
        $this->type = $type;
        $this->capacitance = $capacitance;
        $this->price = $price;

        $query_cancha = "SELECT * FROM canchas WHERE nombre = '{$this->name}' AND status > 0";

        $request = $this->select_all($query_cancha);

        if (!empty($request)) {
            $respuesta = 'exist';
        } else {

            $query_insert = "INSERT INTO " . $this->table_name . "(nombre, tipo, capacidad,valor, status) VALUES(?,?,?,?,?)";
            $arrData = array($this->name, $this->type, $this->capacitance, $this->price, 1);

            $reques_insert = $this->insert($query_insert, $arrData);
            $respuesta = $reques_insert;
        }

        return $respuesta;
    }

    public function updat(string $name, string $type, string $capacitance, int $price, int $status, int $idCancha)
    {

        $this->idCancha = $idCancha;
        $this->name = $name;
        $this->type = $type;
        $this->price = $price;
        $this->capacitance = $capacitance;
        $this->status = $status;

        $query_cancha = "SELECT * FROM canchas WHERE nombre = {$this->name} AND status > 0";

        $request = $this->select_all($query_cancha);

        if (!empty($request)) {
            $respuesta = 'exist';
        } else {
            $query_update = "UPDATE usuario SET nombre = ?, tipo= ?, capacidad= ? , valor= ?, status= ? WHERE idcanchas = ? ";
            $arrData = array($this->name, $this->type, $this->capacitance, $this->price, $this->status, $this->$idCancha);
            $reques_update = $this->insert($query_update, $arrData);
            $respuesta = $reques_update;
        }

        return $respuesta;
    }
    public function delet(int $idCancha)
    {
        $this->idCancha = $idCancha;

        $sql = "UPDATE usuario SET status = ? WHERE idcanchas = {$this->idCancha}";
        $arrData = array(0);
        $request = $this->update($sql, $arrData);
        return $request;
    }
}

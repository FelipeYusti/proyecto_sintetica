<?php
class ConveniosModel extends Mysql
{

    public function __construct()
    {
        parent::__construct();
    }


    public function getAll()
    {
        $sql = "SELECT convenios.idconvenios,convenios.nombre,convenios.descripcion,convenios.fechaInicio,convenios.fechaFin,convenios.fechaFin,convenios.descuento from convenios WHERE convenios.status > 0";
        $request = $this->select_all($sql);
        return $request;
    }


    public function getCanchas()
    {
        $sql = "SELECT  canchas.idcanchas,canchas.nombre FROM canchas WHERE canchas.status > 0 ";
        $request = $this->select_all($sql);
        return $request;
    }

    public function getById(int $idConvenio)
    {
        $this->idConvenio = $idConvenio;
        $sql = "SELECT convenios.idconvenios,convenios.nombre,convenios.descripcion,convenios.fechaInicio,convenios.fechaFin,convenios.fechaFin,convenios.descuento 
        from convenios WHERE convenios.status > 0 and convenios.idconvenios=?";
        $arrData = array($this->idConvenio);
        return $this->insert($sql, $arrData);

    }

    public function addConvenios(string $nombreConvenio, string $descripcion, DateTime $fechaInicio, DateTime $fechaFinal, float $descuento, int $idCancha)
    {
        $this->nombreConvenio = $nombreConvenio;
        $this->descripcion = $descripcion;
        $this->fechaInicio = $fechaInicio->format('Y-m-d');
        $this->fechaFinal = $fechaFinal->format('Y-m-d');
        $this->descuento = $descuento;
        $this->idCancha = $idCancha;

        $sql = "INSERT INTO convenios (nombre, descripcion, fechaInicio, fechaFin, descuento, status, canchas_idcanchas) 
                VALUES (?, ?, ?, ?, ?, 1, ?);";

        $arrData = array($this->nombreConvenio, $this->descripcion, $this->fechaInicio, $this->fechaFinal, $this->descuento, $this->idCancha);

        return $this->insert($sql, $arrData);
    }


    public function updateConvenio(string $nombreConvenio, string $descripcion, DateTime $fechaInicio, DateTime $fechaFinal, float $descuento, int $idCancha, int $idConvenio)
    {
        $this->nombreConvenio = $nombreConvenio;
        $this->descripcion = $descripcion;
        $this->fechaInicio = $fechaInicio->format('Y-m-d');
        $this->fechaFinal = $fechaFinal->format('Y-m-d');
        $this->descuento = $descuento;
        $this->idCancha = $idCancha;
        $this->idConvenio = $idConvenio;


        $query_convenio = "SELECT * FROM convenios WHERE nombre = ? AND status > 0 AND idconvenios != ?";
        $request = $this->select_all($query_convenio, [$this->nombreConvenio, $this->idConvenio]);

        if (!empty($request)) {
            $respuesta = 'exist';
        } else {

            $query_update = "UPDATE convenios 
                             SET nombre = ?, descripcion = ?, fechaInicio = ?, fechaFin = ?, descuento = ?, canchas_idcanchas = ? 
                             WHERE status > 0 AND idconvenios = ?";

            $arrData = [$this->nombreConvenio, $this->descripcion, $this->fechaInicio, $this->fechaFinal, $this->descuento, $this->idCancha, $this->idConvenio];

            $request_update = $this->update($query_update, $arrData);
            $respuesta = $request_update;
        }

        return $respuesta;
    }

    public function deleteConvenio(int $idConvenio)
    {
        $this->idConvenio = $idConvenio;

        $sql = "UPDATE convenios SET status = ? WHERE idconvenios = {$this->idConvenio}";
        $arrData = array(0);
        $request = $this->update($sql, $arrData);
        return $request;
    }

}
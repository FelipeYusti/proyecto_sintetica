<?php
class ConveniosModel extends Mysql
{

    public function __construct()
    {
        parent::__construct();
    }


    public function getAll()
    {
        $sql = "SELECT convenios.idconvenios,convenios.nombre,convenios.descripcion,convenios.fechaInicio,convenios.fechaFin,canchas.nombre AS cancha_nombre,  convenios.descuento FROM convenios
         JOIN canchas ON convenios.canchas_idcanchas = canchas.idcanchas WHERE convenios.status > 0;
";
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

        $sql = "SELECT 
                    convenios.idconvenios,
                    convenios.nombre,
                    convenios.descripcion,
                    convenios.fechaInicio,
                    convenios.fechaFin,
                    convenios.descuento
                FROM convenios
                WHERE convenios.status > 0 AND convenios.idconvenios = '{$this->idConvenio}'";

        $request = $this->select_all($sql);
        return $request;
    }

    public function getAprendizPorId(int $idAprendiz)
    {
        $return = "";

        $this->id = $idAprendiz;

        $sql = "SELECT * FROM aprendices WHERE idaprendiz = '{$this->id}'";
        $request = $this->select_all($sql);
        return $request;
    }

    public function addConvenios(string $nombreConvenio, string $descripcion, string $fechaInicio, string $fechaFinal, float $descuento, int $idCancha)
    {
        $this->nombreConvenio = $nombreConvenio;
        $this->descripcion = $descripcion;
        $this->fechaInicio = $fechaInicio;
        $this->fechaFinal = $fechaFinal;
        $this->descuento = $descuento;
        $this->idCancha = $idCancha;

        $sql = "INSERT INTO convenios (nombre, descripcion, fechaInicio, fechaFin, descuento, status, canchas_idcanchas) 
                VALUES (?, ?, ?, ?, ?, 1, ?);";

        $arrData = array($this->nombreConvenio, $this->descripcion, $this->fechaInicio, $this->fechaFinal, $this->descuento, $this->idCancha);

        return $this->insert($sql, $arrData);
    }


    public function updateConvenio(string $nombreConvenio, string $descripcion, string $fechaInicio, string $fechaFinal, float $descuento, int $idCancha, int $idConvenio)
    {
        $this->nombreConvenio = $nombreConvenio;
        $this->descripcion = $descripcion;
        $this->fechaInicio = $fechaInicio;
        $this->fechaFinal = $fechaFinal;
        $this->descuento = $descuento;
        $this->idCancha = $idCancha;
        $this->idConvenio = $idConvenio;


        $query_update = "UPDATE convenios 
                             SET nombre = ?, descripcion = ?, fechaInicio = ?, fechaFin = ?, descuento = ?, canchas_idcanchas = ? 
                             WHERE status > 0 AND idconvenios = ?";

        $arrData = [$this->nombreConvenio, $this->descripcion, $this->fechaInicio, $this->fechaFinal, $this->descuento, $this->idCancha, $this->idConvenio];

        $request_update = $this->update($query_update, $arrData);
        $respuesta = $request_update;

        return $respuesta;
    }

    public function deleteConvenio(int $idConvenio)
    {
        $this->idConvenio = $idConvenio;
        $estado = 0;

        $sql = "UPDATE convenios SET status = ? WHERE idconvenios = ?";
        $arrData = array(0, $this->idConvenio);
        $request = $this->update($sql, $arrData);
        return $request;
    }

}
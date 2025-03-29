<?php
class ReservasModel extends Mysql
{

    public function __construct()
    {
        parent::__construct();
    }

    public function getAll()
    {
        $sql = "SELECT reservas.nombre,reservas_has_canchas.fecha,canchas.nombre,canchas.tipo,canchas.capacidad,canchas.valor from reservas_has_canchas 
        JOIN reservas ON reservas.idreservas=reservas_has_canchas.reservas_idreservas 
        JOIN canchas ON canchas.idcanchas=reservas_has_canchas.canchas_idcanchas";
        $request = $this->select_all($sql);
        return $request;
    }
    public function getConvenios()
    {
        $sql = "SELECT convenios.idconvenios,convenios.nombre 
        FROM convenios WHERE convenios.status>0";
        $request = $this->select_all($sql);
        return $request;
    }

    public function getUsuarios()
    {
        $sql = "SELECT users.idusers,users.username FROM users 
        WHERE users.status > 0  ";
        $request = $this->select_all($sql);
        return $request;
    }

    public function getById(int $idReserva)
    {
        $this->idReserva = $idReserva;

        $sql = "SELECT reservas.nombre,reservas_has_canchas.fecha,canchas.nombre,canchas.tipo,canchas.capacidad,canchas.valor 
        from reservas_has_canchas 
        JOIN reservas ON reservas.idreservas=reservas_has_canchas.reservas_idreservas 
        JOIN canchas ON canchas.idcanchas=reservas_has_canchas.canchas_idcanchas
        WHERE reservas.status > 0 AND reservas.idreservas = '{$this->idReserva}'";

        $request = $this->select_all($sql);
        return $request;
    }

    public function addReserva(string $nombreReserva, int $idConvenio, string $idUser)
    {
        $this->nombreReserva = $nombreReserva;
        $this->idConvenio = $idConvenio;
        $this->idUser = $idUser;


        $sql = "INSERT INTO reservas (reservas.nombre,reservas.status,reservas.convenios_idconvenios,reservas.users_idusers)
        VALUES (?,1,?,?);";

        $arrData = array($this->nombreReserva, $this->idConvenio, $this->idUser);

        return $this->insert($sql, $arrData);
    }

    public function updateReserva(int $idReserva, string $nombreReserva, int $idConvenio, string $idUser)
    {
        $this->idReserva = $idReserva;
        $this->nombreReserva = $nombreReserva;
        $this->idConvenio = $idConvenio;
        $this->idUser = $idUser;

        $query_update = "UPDATE reservas 
        SET nombre = ?,convenios_idconvenios = ?, users_idusers = ?
        WHERE reservas.status > 0 AND idreservas = ?";

        $arrData = [$this->nombreReserva, $this->idConvenio, $this->idUser, $this->idReserva];

        $request_update = $this->update($query_update, $arrData);
        $respuesta = $request_update;

        return $respuesta;
    }


    public function deleteReserva(int $idReserva)
    {
        $this->idReserva = $idReserva;

        $estado = 0;

        $sql = "UPDATE reservas SET status = ? WHERE idreservas = ?";
        $arrData = array(0, $this->idConvenio);
        $request = $this->update($sql, $arrData);
        return $request;
    }
}

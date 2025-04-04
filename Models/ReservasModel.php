<?php
class ReservasModel extends Mysql
{

    public function __construct()
    {
        parent::__construct();
    }

    public function getAll()
    {
        $sql = "SELECT reservas.idreservas,reservas.nombre 
        as nombreReserva,reservas_has_canchas.fecha as 
        fechaReserva,canchas.nombre as nombreCancha,canchas.tipo as 
        tipoCancha,canchas.capacidad as capacidadCancha,canchas.valor as 
        valorCancha,reservas.convenios_idconvenios,reservas.users_idusers,
        convenios.nombre as nombreConvenios, users.username
        from reservas_has_canchas 
        JOIN reservas ON reservas.idreservas=reservas_has_canchas.reservas_idreservas 
        JOIN canchas ON canchas.idcanchas=reservas_has_canchas.canchas_idcanchas
        JOIN convenios ON convenios.idconvenios=reservas.convenios_idconvenios
        JOIN users ON users.idusers=reservas.users_idusers 
        WHERE reservas.status>0";
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

        $sql = "SELECT reservas.idreservas,reservas.nombre 
        as nombreReserva,reservas_has_canchas.fecha as 
        fechaReserva,canchas.nombre as nombreCancha,canchas.tipo as 
        tipoCancha,canchas.capacidad as capacidadCancha,canchas.valor as 
        valorCancha,reservas.convenios_idconvenios,reservas.users_idusers,
        convenios.nombre as nombreConvenios, users.username
        from reservas_has_canchas 
        JOIN reservas ON reservas.idreservas=reservas_has_canchas.reservas_idreservas 
        JOIN canchas ON canchas.idcanchas=reservas_has_canchas.canchas_idcanchas
        JOIN convenios ON convenios.idconvenios=reservas.convenios_idconvenios
        JOIN users ON users.idusers=reservas.users_idusers
        WHERE reservas.status > 0 AND reservas.idreservas = '{$this->idReserva}'";

        $request = $this->select_all($sql);
        return $request;
    }

    public function addReserva(string $nombreReserva, int $idConvenio, int $idUser)
    {
        $this->nombreReserva = $nombreReserva;
        $this->idConvenio = $idConvenio;
        $this->idUser = $idUser;


        $sql = "INSERT INTO reservas (reservas.nombre,reservas.status,reservas.convenios_idconvenios,reservas.users_idusers)
        VALUES (?,1,?,?);";

        $arrData = array($this->nombreReserva, $this->idConvenio, $this->idUser);

        return $this->insert($sql, $arrData);
    }

    public function addReservaPivote(int $idReserva, int $idCancha, string $fecha, string $horaReserva, int $horasReservadas)
    {
        $this->idReserva = $idReserva;
        $this->idCancha = $idCancha;
        $this->fecha = $fecha;
        $this->horaReserva = $horaReserva;
        $this->horasReservadas = $horasReservadas;

        $sql = "INSERT INTO reservas_has_canchas (reservas_has_canchas.reservas_idreservas,reservas_has_canchas.canchas_idcanchas,reservas_has_canchas.fecha,reservas_has_canchas.horaReserva,reservas_has_canchas.horasReservadas)
         VALUES(?,?,?,?,?)";

        $arrData = array($this->idReserva, $this->idCancha, $this->fecha, $this->horaReserva, $this->horasReservadas);

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
        $arrData = array(0, $this->idReserva);
        $request = $this->update($sql, $arrData);
        return $request;
    }
}

<?php
class ReservasModel extends Mysql
{

    public function __construct()
    {
        parent::__construct();
    }

    public function getAll()
    {
        $sql = "SELECT reservas.idreservas,reservas_has_canchas.idreservas_idreservas as idPivot,reservas.nombre 
        as nombreReserva,reservas_has_canchas.fecha as 
        fechaReserva,canchas.nombre as nombreCancha,canchas.tipo as 
        tipoCancha,canchas.capacidad as capacidadCancha,canchas.valor as 
        valorCancha,reservas.convenios_idconvenios,reservas.users_idusers,reservas_has_canchas.horaReserva,
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

    public function getReserva($idReservaPivote)
    {
        $this->idReservaPivote = $idReservaPivote;

        $sql = "SELECT 
            reservas.nombre,
            reservas.convenios_idconvenios,
            reservas.idreservas,
            reservas.users_idusers,
            reservas_has_canchas.idreservas_idreservas as idPivote,
            reservas_has_canchas.reservas_idreservas,
            reservas_has_canchas.canchas_idcanchas,
            reservas_has_canchas.fecha,
            reservas_has_canchas.horaReserva,
            reservas_has_canchas.horasReservadas,
            convenios.nombre as nombreConvenio,
            convenios.idconvenios,
            users.username,
            canchas.nombre as nombreCancha
        FROM reservas_has_canchas 
        JOIN reservas ON reservas_has_canchas.reservas_idreservas = reservas.idreservas 
        JOIN convenios ON reservas.convenios_idconvenios=convenios.idconvenios
        JOIN users ON reservas.users_idusers=users.idusers
        JOIN canchas ON canchas.idcanchas=reservas_has_canchas.canchas_idcanchas
        WHERE reservas_has_canchas.idreservas_idreservas = '{$this->idReservaPivote}'";

        return $request = $this->select_all($sql);
    }


    public function getConvenios()
    {
        $sql = "SELECT convenios.idconvenios,convenios.nombre FROM convenios WHERE convenios.status>0";
        $request = $this->select_all($sql);
        return $request;
    }

    public function getIdMaximo()
    {
        $sql = "SELECT MAX(idreservas) AS idMaximo FROM reservas";
        $request = $this->select($sql);
        return $request['idMaximo'];
    }

    public function getCanchas()
    {
        $sql = "SELECT canchas.idcanchas,canchas.nombre FROM canchas WHERE canchas.status>0";
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

    public function addReserva1($nombre, $idConvenio, $idUsuario)
    {
        $query = "INSERT INTO reservas (reservas.nombre,reservas.status,reservas.convenios_idconvenios,reservas.users_idusers)
        VALUES (?,1,?,?);";
        $arrData = [$nombre, $idConvenio, $idUsuario];
        $requestInsert = $this->insert($query, $arrData);
        return $requestInsert;
    }

    public function addReservaPivote(int $idReservaPivote, int $idCancha, string $fecha, string $horaReserva, int $horasReservadas)
    {
        $this->idReservaPivote = $idReservaPivote;
        $this->idCancha = $idCancha;
        $this->fecha = $fecha;
        $this->horaReserva = $horaReserva;
        $this->horasReservadas = $horasReservadas;

        $sql = "INSERT INTO reservas_has_canchas (reservas_has_canchas.reservas_idreservas,reservas_has_canchas.canchas_idcanchas,reservas_has_canchas.fecha,reservas_has_canchas.horaReserva,reservas_has_canchas.horasReservadas)
         VALUES(?,?,?,?,?)";

        $arrData = array($this->idReservaPivote, $this->idCancha, $this->fecha, $this->horaReserva, $this->horasReservadas);

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

    public function updateReservaPivote(int $idPivote, string $diaReserva, int $idCancha, string $horaReserva, int $horasReservadas)
    {
        $this->idPivote = $idPivote;
        $this->diaReserva = $diaReserva;
        $this->idCancha = $idCancha;
        $this->horaReserva = $horaReserva;
        $this->horasReservadas = $horasReservadas;

        $query_update = "UPDATE reservas_has_canchas SET  reservas_has_canchas.canchas_idcanchas=?,
        reservas_has_canchas.fecha=?, reservas_has_canchas.horaReserva=?,
        reservas_has_canchas.horasReservadas=? WHERE reservas_has_canchas.idreservas_idreservas=?";

        $arrData = [$this->idCancha, $this->diaReserva, $this->horaReserva, $this->horasReservadas, $this->idPivote];

        $request_update = $this->update($query_update, $arrData);
        $respuesta = $request_update;

        return $respuesta;
    }



    public function updateHorario(int $idReservaPivote, string $fecha, string $horaReserva)
    {
        $this->idReservaPivote = $idReservaPivote;
        $this->fecha = $fecha;
        $this->horaReserva = $horaReserva;
        $sql = "UPDATE reservas_has_canchas SET fecha = ?, horaReserva = ? WHERE idreservas_idreservas = ? ";
        $arrData = array($this->fecha, $this->horaReserva, $this->idReservaPivote);

        return $this->update($sql, $arrData);
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

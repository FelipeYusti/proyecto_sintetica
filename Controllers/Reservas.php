<?php
class Reservas extends Controllers
{

    public function __construct()
    {
        parent::__construct();
        /* session_start();
        if (empty($_SESSION['login'])) {
            header('Location: ' . base_url() . '/login');
        } */
    }

    public function reservas()
    {

        $data['page_title'] = "Página de reservas";
        $data['page_name'] = "reservas";
        $data['script'] = "reservas";
        $this->views->getView($this, "reservas", $data);
    }

    public function showTabla()
    {
        $arrData = $this->model->getAll();

        echo json_encode($arrData, JSON_UNESCAPED_UNICODE);
        die();
    }

    public function getReserva($idReservaPivote)
    {
        $idReservaPivote = intval(strClean($idReservaPivote));

        if ($idReservaPivote > 0) {
            $arrData = $this->model->getReserva($idReservaPivote);

            if (empty($arrData)) {
                $arrResponse = array('status' => false, 'msg' => 'Datos no encontrados');
            } else {
                $arrResponse = array('status' => true, 'data' => $arrData);
            }
        } else {
            $arrResponse = array('status' => false, 'msg' => 'ID inválido');
        }

        echo json_encode($arrResponse, JSON_UNESCAPED_UNICODE);
        die();
    }

    public function getConvenios()
    {

        $arrData = $this->model->getConvenios();

        if (empty($arrData)) {
            $arrResponse = array('status' => false, 'msg' => 'Datos no encontrados');
        } else {
            $arrResponse = array('status' => true, 'data' => $arrData);
        }

        echo json_encode($arrResponse, JSON_UNESCAPED_UNICODE);
        die();
    }

    public function getUsuarios()
    {

        $arrData = $this->model->getUsuarios();

        if (empty($arrData)) {
            $arrResponse = array('status' => false, 'msg' => 'Datos no encontrados');
        } else {
            $arrResponse = array('status' => true, 'data' => $arrData);
        }

        echo json_encode($arrResponse, JSON_UNESCAPED_UNICODE);
        die();
    }

    public function getCanchas()
    {

        $arrData = $this->model->getCanchas();

        if (empty($arrData)) {
            $arrResponse = array('status' => false, 'msg' => 'Datos no encontrados');
        } else {
            $arrResponse = array('status' => true, 'data' => $arrData);
        }

        echo json_encode($arrResponse, JSON_UNESCAPED_UNICODE);
        die();
    }
    public function createReserva()
    {
        $idReserva = strClean($_POST['idReserva']);
        $nombre = strClean($_POST['nombreReserva']);
        $idConvenio = strClean($_POST['idConvenio']);
        $idUsuario = strClean($_POST['idUsuario']);

        $reservasPivote = [];

        // 5 es el maximo de inserciones 
        for ($i = 1; $i <= 5; $i++) {
            if (isset($_POST["diaReserva$i"], $_POST["horaReserva$i"], $_POST["horasReservadas$i"])) {
                $reservasPivote[] = [
                    'idReservaPivote' => strClean($_POST["idReservaPivote$i"]),
                    'diaReserva' => strClean($_POST["diaReserva$i"]),
                    'idCancha' => strClean($_POST["idCancha$i"]),
                    'horaReserva' => strClean($_POST["horaReserva$i"]),
                    'horasReservadas' => strClean($_POST["horasReservadas$i"])
                ];
            }
        }

        $arrPost = ['nombreReserva', 'idConvenio', 'idUsuario'];

        if (check_post($arrPost)) {
            $option = 0;

            if ($idReserva == 0 || $idReserva == "") {
                $requestModel = $this->model->addReserva($nombre, $idConvenio, $idUsuario);

                if ($requestModel > 0) {
                    // Obtener el ID máximo actualizado DESPUÉS de insertar la reserva principal
                    $idMaximo = $this->model->getIdMaximo();

                    // Inserción de reservas pivote
                    foreach ($reservasPivote as $reserva) {
                        $this->model->addReservaPivote(
                            $idMaximo,
                            $reserva['idCancha'],
                            $reserva['diaReserva'],
                            $reserva['horaReserva'],
                            $reserva['horasReservadas']
                        );
                    }
                    $option = 1;
                }
            } else {
                $requestModel = 'exists';
            }

            if ($requestModel > 0) {
                $arrRespuesta = array('status' => true, 'msg' => ($option === 1) ? 'Reserva agregada correctamente.' : 'Reserva actualizada correctamente.');
            } elseif ($requestModel === 'exists') {
                $arrRespuesta = array('status' => false, 'msg' => 'Esta reserva ya existe');
            } else {
                $arrRespuesta = array('status' => false, 'msg' => 'Error al procesar la reserva.');
            }
        } else {
            $arrRespuesta = array('status' => false, 'msg' => 'Debe ingresar todos los datos');
        }

        echo json_encode($arrRespuesta, JSON_UNESCAPED_UNICODE);
        die();
    }
    public function updateReserva()
    {
        $arrPost = ['idReserva', 'idReservaPivote', 'nombreReserva', 'idConvenio', 'idUsuario', 'diaReserva', 'idCancha1', 'horaReserva', 'horasReservas'];
        //$arrPost2 = [];

        if (check_post($arrPost)) {
            $idReserva = strClean($_POST['idReserva']);//Pivote
            $idReservaPivote = strClean($_POST['idReservaPivote']);
            $nombreReserva = strClean($_POST['nombreReserva']);
            $idConvenio = strClean($_POST['idConvenio']);
            $idUsuario = strClean($_POST['idUsuario']);
            $diaReserva = strClean($_POST['diaReserva']);
            $idCancha1 = strClean($_POST['idCancha1']);
            $horaReserva = strClean($_POST['horaReserva']);
            $horasReservas = strClean($_POST['horasReservas']);

            try {

                $insert = $this->model->updateReserva(
                    $idReserva,
                    $nombreReserva,
                    $idConvenio,
                    $idUsuario
                );

                $insert2 = $this->model->updateReservaPivote(
                    $idReservaPivote,
                    $diaReserva,
                    $idCancha1,
                    $horaReserva,
                    $horasReservas
                );

                if (intval($insert) > 0 and intval($insert2) > 0) {

                    $arrResponse = array('status' => true, 'msg' => 'Reserva actualizada correctamente');
                } else if ($insert == 'exist') {

                    $arrResponse = array('status' => false, 'msg' => 'Ya existe una convenio con el mismo nombre');
                } else {

                    $arrResponse = array('status' => false, 'msg' => 'Error al insertar');
                }
            } catch (\Throwable $th) {
                $arrResponse = array('status' => false, 'msg' => "Error desconocido: $th");
            }
        } else {
            $arrResponse = array('status' => false, 'msg' => 'Debe insertar todos los datos');
        }

        echo json_encode($arrResponse, JSON_UNESCAPED_UNICODE);
    }
    public function updateHorario()
    {
        $arrPost = ['idPivot', 'nuevaFecha', 'nuevaHora'];

        if (check_post($arrPost)) {
            $idPivot = strClean($_POST['idPivot']);
            $nuevaFecha = strClean($_POST['nuevaFecha']);
            $nuevaHora = strClean($_POST['nuevaHora']);
            try {
                $insert = $this->model->updateHorario(
                    $idPivot,
                    $nuevaFecha,
                    $nuevaHora,
                );
                if (intval($insert) > 0) {

                    $arrResponse = array('status' => true, 'msg' => 'Horaio actualizada correctamente');
                } else if ($insert == 'exist') {
                    $arrResponse = array('status' => false, 'msg' => 'Ya existe una convenio con el mismo nombre');
                } else {
                    $arrResponse = array('status' => false, 'msg' => 'Error al insertar');
                }
            } catch (\Throwable $th) {
                $arrResponse = array('status' => false, 'msg' => "Error desconocido: $th");
            }
        } else {
            $arrResponse = array('status' => false, 'msg' => 'Debe insertar todos los datos');
        }

        echo json_encode($arrResponse, JSON_UNESCAPED_UNICODE);
    }

    public function deleteReserva1()
    {
        if ($_POST) {
            $idConvenio = intval($_POST['idReserva']);

            $requestDelete = $this->model->deleteReserva($idConvenio);

            if ($requestDelete == 'empty') {
                $arrResponse = array('status' => true, 'msg' => 'Se ha eliminado la reserva.');
            }
            echo json_encode($arrResponse, JSON_UNESCAPED_UNICODE);
        } else {
            print_r($_POST);
        }
        die();
    }

    public function cancelarReserva()
    {
        if ($_POST) {
            $idReserva = intval($_POST['idReserva']);

            $requestDelete = $this->model->cancelarReserva($idReserva);

            if ($requestDelete) {
                $arrResponse = array('status' => true, 'msg' => 'Se ha eliminado la reserva.');
            } else {
                $arrResponse = array('status' => false, 'msg' => 'No se pudo eliminar la reserva.');
            }

            echo json_encode($arrResponse, JSON_UNESCAPED_UNICODE);
        } else {
            echo json_encode(['status' => false, 'msg' => 'No se recibió una solicitud válida.']);
        }

        die();
    }

    public function deleteReserva()
    {
        $json = file_get_contents("php://input");
        $data = json_decode($json, true);

        if (isset($data["idReserva"])) {
            $idReserva = intval($data["idReserva"]);

            $requestDelete = $this->model->deleteReserva($idReserva);

            if ($requestDelete == "empty") {
                $arrResponse = array("status" => true, "msg" => "Se ha eliminado la reserva.");
            } else {
                $arrResponse = array("status" => false, "msg" => "Error al eliminar.");
            }

            echo json_encode($arrResponse, JSON_UNESCAPED_UNICODE);
        } else {
            echo json_encode(["status" => false, "msg" => "ID no recibido"]);
        }

        die();
    }
}

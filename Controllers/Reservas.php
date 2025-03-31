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

    public function getReserva($idReserva)
    {

        $intIdConvenio = intval(strClean($idReserva));

        if ($intIdConvenio > 0) {

            $arrData = $this->model->getById($idReserva);

            if (empty($arrData)) {
                $arrResponse = array('status' => false, 'msg' => 'Datos no encontrados');
            } else {
                $arrResponse = array('status' => true, 'data' => $arrData);
            }
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

    public function createReserva()
    {
        $idReserva = strClean($_POST['idReserva']);
        $nombre = strClean($_POST['nombreReserva']);
        $idConvenio = strClean($_POST['idConvenio']);
        $idUsuario = strClean($_POST['idUsuario']);


        $arrPost = ['nombreReserva', 'idConvenio', 'idUsuario'];

        if (check_post($arrPost)) {
            if ($idReserva == 0 || $idReserva == "") {
                $requestModel = $this->model->addReserva($nombre, $idConvenio, $idUsuario);
                $option = 1;
            }
            if ($requestModel > 0) {
                if ($option === 1) {
                    $arrRespuesta = array('status' => true, 'msg' => 'Reserva agregado correctamente.');
                }
            } elseif ($requestModel === 'exists') {
                $arrRespuesta = array('status' => false, 'msg' => 'Esta reserva ya existe');
            } else {
                $arrRespuesta = array('status' => true, 'msg' => 'Reserva actualizado correctamente.');
            }
        } else {
            $arrRespuesta = array('status' => false, 'msg' => 'Debe ingresar todos los datos');
        }
        echo json_encode($arrRespuesta, JSON_UNESCAPED_UNICODE);
        die();
    }

    public function updateReserva()
    {
        $arrPost = ['idReserva', 'nombreReserva', 'idConvenio', 'idUsuario'];

        if (check_post($arrPost)) {
            $idReserva = strClean($_POST['idReserva']);
            $nombreReserva = strClean($_POST['nombreReserva']);
            $idConvenio = strClean($_POST['idConvenio']);
            $idUsuario = strClean($_POST['idUsuario']);
            try {

                $insert = $this->model->updateReserva(
                    $idReserva,
                    $nombreReserva,
                    $idConvenio,
                    $idUsuario
                );

                if (intval($insert) > 0) {

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

    public function deleteReserva()
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
}

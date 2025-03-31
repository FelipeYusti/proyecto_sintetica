<?php
class Convenios extends Controllers
{

    public function __construct()
    {
        parent::__construct();
        /* session_start();
        if (empty($_SESSION['login'])) {
            header('Location: ' . base_url() . '/login');
        } */
    }

    public function convenios()
    {

        $data['page_title'] = "Página de canchas";
        $data['page_name'] = "convenios";
        $data['script'] = "convenios";
        $this->views->getView($this, "convenios", $data);
    }
    public function showTabla()
    {
        $arrData = $this->model->getAll();

        echo json_encode($arrData, JSON_UNESCAPED_UNICODE);
        die();
    }

    public function getConvenio($idConvenio)
    {

        $intIdConvenio = intval(strClean($idConvenio));

        if ($intIdConvenio > 0) {

            $arrData = $this->model->getById($idConvenio);

            if (empty($arrData)) {
                $arrResponse = array('status' => false, 'msg' => 'Datos no encontrados');
            } else {
                $arrResponse = array('status' => true, 'data' => $arrData);
            }
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

    public function createConvenio()
    {
        $idconvenio = strClean($_POST['idConvenio']);
        $nombre = strClean($_POST['txtNombre']);
        $descripcion = strClean($_POST['txtDescripcion']);
        $fechaInicio = strClean($_POST['txtFechaInicio']);
        $fechaFin = strClean($_POST['txtFechaFin']);
        $descuento = strClean($_POST['txtDescuento']);
        $idCancha = strClean($_POST['txtCancha']);

        $arrPost = ['txtDescripcion', 'txtFechaInicio', 'txtFechaFin', 'txtDescuento', 'txtCancha'];

        if (check_post($arrPost)) {
            if ($idconvenio == 0 || $idconvenio == "") {
                $requestModel = $this->model->addConvenios($nombre, $descripcion, $fechaInicio, $fechaFin, $descuento, $idCancha);
                $option = 1;
            }
            if ($requestModel > 0) {
                if ($option === 1) {
                    $arrRespuesta = array('status' => true, 'msg' => 'Convenio agregado correctamente.');
                }
            } elseif ($requestModel === 'exists') {
                $arrRespuesta = array('status' => false, 'msg' => 'Este convenio ya existe');
            } else {
                $arrRespuesta = array('status' => true, 'msg' => 'Convenio actualizado correctamente.');
            }
        } else {
            $arrRespuesta = array('status' => false, 'msg' => 'Debe ingresar todos los datos');
        }
        echo json_encode($arrRespuesta, JSON_UNESCAPED_UNICODE);
        die();
    }

    public function updateConvenio()
    {
        $arrPost = ['idConvenio', 'txtDescripcion', 'txtFechaInicio', 'txtFechaFin', 'txtDescuento', 'txtCancha'];

        if (check_post($arrPost)) {
            $idconvenio = strClean($_POST['idConvenio']);
            $nombre = strClean($_POST['txtNombre']);
            $descripcion = strClean($_POST['txtDescripcion']);
            $fechaInicio = strClean($_POST['txtFechaInicio']);
            $fechaFin = strClean($_POST['txtFechaFin']);
            $descuento = strClean($_POST['txtDescuento']);
            $idCancha = strClean($_POST['txtCancha']);
            try {

                $insert = $this->model->updateConvenio(
                    $nombre,
                    $descripcion,
                    $fechaInicio,
                    $fechaFin,
                    $descuento,
                    $idCancha,
                    $idconvenio
                );

                if (intval($insert) > 0) {

                    $arrResponse = array('status' => true, 'msg' => 'Convenio actualizada correctamente');
                } else if ($insert == 'exist') {

                    $arrResponse = array('status' => false, 'msg' => 'Ya existe un convenio con el mismo nombre');
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

    public function deleteConvenio()
    {
        $json = file_get_contents("php://input");
        $data = json_decode($json, true);

        if (isset($data["idConvenio"])) {
            $idConvenio = intval($data["idConvenio"]);

            $requestDelete = $this->model->deleteConvenio($idConvenio);

            if ($requestDelete == "empty") {
                $arrResponse = array("status" => true, "msg" => "Se ha eliminado el convenio.");
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

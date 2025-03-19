<?php
class Canchas extends Controllers
{
    public function __construct()
    {
        parent::__construct();
        /* session_start();
        if (empty($_SESSION['login'])) {
            header('Location: ' . base_url() . '/login');
        } */
    }

    public function canchas()
    {

        $data['page_title'] = "Página de canchas";
        $data['page_name'] = "canchas";
        $data['script'] = "canchas";
        $this->views->getView($this, "canchas", $data);
    }

    public function show()
    {
        $arrData = $this->model->getAll();

        for ($i = 0; $i < count($arrData); $i++) {


            if ($arrData[$i]['tipo'] == 'Futbol') {

                if ($arrData[$i]['capacidad'] == 5) {
                    $arrData[$i]['rutaImagen'] = 'Assets/images/canchas/5vs5-player.jpg';
                }
                if ($arrData[$i]['capacidad'] == 6) {
                    $arrData[$i]['rutaImagen'] = 'Assets/images/canchas/6vs6-player.jpg';
                }
                if ($arrData[$i]['capacidad'] == 8) {
                    $arrData[$i]['rutaImagen'] = 'Assets/images/canchas/8vs8-player.jpg';
                }
            }
            if ($arrData[$i]['tipo'] == 'Volley') {
                $arrData[$i]['rutaImagen'] = 'Assets/images/valley/volley-players.jpg';
            }
        }
        echo json_encode($arrData);
    }
    public function getById($id)
    {
        $idCancha = intval(strClean($id));

        if ($idCancha > 0) {
            $arrData = $this->model->getById($idCancha);
        } else {
            $arrResponse = array('status' => false, 'msg' => 'tipo de dato no permitido');
        }

        if (!empty($arrData)) {
            $arrResponse = array('status' => true, 'data' => $arrData);
        } else {
            $arrResponse = array('status' => false, 'msg' => 'No se encontraron datos con este id');
        }
        echo json_encode($arrResponse, JSON_UNESCAPED_UNICODE);
        die();
    }
    public function create()
    {

        $arrPosts = [
            'txtName',
            'txtType',
            'txtCapacitance',
            'txtPrice',
        ];

        if (check_post($arrPosts)) {

            $name = strClean($_POST['txtName']);
            $type = strClean($_POST['txtType']);
            $capacitance = intval(strClean($_POST['txtCapacitance']));
            $price = intval(strClean($_POST['txtPrice']));
            try {

                $insert = $this->model->add(
                    $name,
                    $type,
                    $capacitance,
                    $price
                );

                if (intval($insert) > 0) {

                    $arrResponse = array('status' => true, 'msg' => 'Cancha registrada correctamente');
                } else if ($insert == 'exist') {

                    $arrResponse = array('status' => false, 'msg' => 'Ya existe una cancha con el mismo nombre');
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


    public function modify()
    {
        $arrPosts = [
            'txtIdCancha',
            'txtName',
            'txtType',
            'txtCapacitance',
            'txtPrice',
            'txtStatus'
        ];

        if (check_post($arrPosts)) {
            $name = strClean($_POST['txtName']);
            $type = strClean($_POST['txtType']);
            $capacitance = intval(strClean($_POST['txtCapacitance']));
            $price = intval(strClean($_POST['txtPrice']));
            $status = intval(strClean($_POST['txtStatus']));
            $idCancha = intval(strClean($_POST['txtIdCancha']));
            try {

                $updat = $this->model->updat(
                    $name,
                    $type,
                    $capacitance,
                    $price,
                    $status,
                    $idCancha
                );

                if (intval($updat) > 0) {

                    $arrResponse = array('status' => true, 'msg' => 'Cancha actualizada correctamente');
                } else if ($updat == 'exist') {

                    $arrResponse = array('status' => false, 'msg' => 'Ya existe una cancha con el mismo nombre');
                } else {
                    $arrResponse = array('status' => false, 'msg' => 'Error al Actualizar');
                }
            } catch (\Throwable $th) {
                $arrResponse = array('status' => false, 'msg' => "Error desconocido: $th");
            }
        } else {
            $arrResponse = array('status' => false, 'msg' => 'Debe insertar todos los datos');
        }

        echo json_encode($arrResponse, JSON_UNESCAPED_UNICODE);
    }

    public function delete()
    {
        if ($_POST) {
            $idCancha = intval($_POST['idCancha']);
            $requestDelete = $this->model->delet($idCancha);
            if ($requestDelete) {
                $arrResponse = array('status' => true, 'msg' => 'Se ha eliminado la cancha correctamente');
            } else {
                $arrResponse = array('status' => false, 'msg' => 'Error al eliminar la cancha');
            }

            echo json_encode($arrResponse, JSON_UNESCAPED_UNICODE);
        }
        die();
    }
}

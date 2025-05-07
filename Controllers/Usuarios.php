<?php

class Usuarios extends Controllers
{
    public function __construct()
    {
        parent::__construct();
        session_start();
        if (empty($_SESSION['login'])) {
            header('Location: ' . base_url() . '/login');
        }
    }
    public function usuarios()
    {

        $data['page_title'] = "Página de usuarios";
        $data['page_name'] = "usuarios";
        $data['script'] = "usuarios";
        $this->views->getView($this, "usuarios", $data);
    }

    public function show()
    {
        $arrData = $this->model->getAll();

        for ($i = 0; $i < count($arrData); $i++) {
            $arrData[$i]['accion'] = '
            <button type="button" data-action="delete" data-id="' . $arrData[$i]['ID'] . '" class="btn btn-outline-danger"><i class="bi bi-trash"></i></button>
            <button type="button" data-action="edit" data-id="' . $arrData[$i]['ID'] . '" class="btn btn-outline-success"><i class="bi bi-pencil-square"></i></button>
            ';

            if ($arrData[$i]['rol'] == "admin") {
                $arrData[$i]['rol'] = '<span class="badge bg-primary">Admin</span>';
            }

            if ($arrData[$i]['rol'] == "empleado") {
                $arrData[$i]['rol'] = '<span class="badge bg-warning">Empleado</span>';
            }

            if ($arrData[$i]['status'] == 1) {
                $arrData[$i]['status'] = '<span class="badge rounded-pill bg-success">Activo</span>';
            }
            if ($arrData[$i]['status'] == 2) {
                $arrData[$i]['status'] = '<span class="badge rounded-pill bg-danger">Inactivo</span>';
            }
        }

        echo json_encode($arrData, JSON_UNESCAPED_UNICODE);
    }

    public function getUsariosById($id)
    {

        $intId = intval(strClean($id));

        if ($intId > 0) {
            $arrData = $this->model->getByid($id);
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
            'txtUsername',
            'txtPassword',
            'txtCorreo',
            'txtRol',
        ];

        if (check_post($arrPosts)) {

            $username = strClean($_POST['txtUsername']);
            $password = hash("SHA256", $_POST['txtPassword']);
            $email = strClean($_POST['txtCorreo']);
            $rol = strClean($_POST['txtRol']);
            try {
                $insert = $this->model->add(
                    $username,
                    $password,
                    $email,
                    $rol
                );

                if (intval($insert) > 0) {

                    $arrResponse = array('status' => true, 'msg' => 'Usuario registrado correctamente');
                } else if ($insert == 'exist') {

                    $arrResponse = array('status' => false, 'msg' => 'Ya existe un usuario con el mismo nombre');
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
            'txtIdUsuario',
            'txtUsername',
            'txtPassword',
            'txtCorreo',
            'txtRol',
            'txtStatus'
        ];

        if (check_post($arrPosts)) {
            $username = strClean($_POST['txtUsername']);
            $password = strClean($_POST['txtPassword']);
            $email = strClean($_POST['txtCorreo']);
            $rol = strClean($_POST['txtRol']);
            $status = intval(strClean($_POST['txtStatus']));
            $idUser = intval(strClean($_POST['txtIdUsuario']));
            try {

                $insert = $this->model->updat(
                    $username,
                    $password,
                    $email,
                    $rol,
                    $status,
                    $idUser
                );

                if (intval($insert) > 0) {

                    $arrResponse = array('status' => true, 'msg' => 'Usuario actualizado correctamente');
                } else if ($insert == 'exist') {

                    $arrResponse = array('status' => false, 'msg' => 'Ya existe un usuario con el mismo nombre');
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

    function deleteUsuario()
    {
        if ($_POST) {
            $idUser = intval($_POST['idUser']);
            $requestDelete = $this->model->delet($idUser);

            if ($requestDelete) {
                $arrResponse = array('status' => true, 'msg' => 'Se ha eliminado el usuario');
            } else {
                $arrResponse = array('status' => false, 'msg' => 'Error al eliminar el usuario');
            }

            echo json_encode($arrResponse, JSON_UNESCAPED_UNICODE);
        }
        die();
    }
}

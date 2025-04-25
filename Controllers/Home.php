<?php

class Home extends Controllers
{
    public function __construct()
    {
        parent::__construct();
    }
    public function home()
    {

        $data['page_title'] = "Página principal";
        $data['page_name'] = "home";
        $data['script'] = "home";
        $this->views->getView($this, "home", $data);
    }

    public function getGananciaMes()
    {
        $arrData = $this->model->getRevenueMonth();
        echo json_encode($arrData);
    }
    public function getGananciaAño()
    {
        $arrData = $this->model->getRevenueYear();
        echo json_encode($arrData);
    }
    public function getCantidaReservas()
    {
        $arrData = $this->model->getCountReser();
        echo json_encode($arrData);
    }
    public function getReservasAnual()
    {
        $arrData = $this->model->getCountReserYear();
        echo json_encode($arrData);
    }
    public function getCantidaConvenios()
    {
        $arrData = $this->model->getCountAgreements();
        echo json_encode($arrData);
    }
}

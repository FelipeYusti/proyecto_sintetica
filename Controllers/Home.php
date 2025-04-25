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
        $year = date('Y');
        $month = date('m');
        $arrData = $this->model->getRevenueMonth($month, $year);
        echo json_encode($arrData);
    }
    public function getGananciaAño()
    {
        $year = date('Y');
        $arrData = $this->model->getRevenueYear($year);
        echo json_encode($arrData);
    }
    public function getCantidaReservas()
    {
        $year = date('Y');
        $month = date('m');
        $arrData = $this->model->getReserMonth($month, $year);
        echo json_encode($arrData, JSON_UNESCAPED_UNICODE);
    }
    public function getReservasAnual()
    {
        $year = date('Y');
        $arrData = $this->model->getCountReserYear($year);
        echo json_encode($arrData,JSON_UNESCAPED_UNICODE);
    }
    public function getCantidaConvenios()
    {
        $arrData = $this->model->getCountAgreements();
        echo json_encode($arrData);
    }
}

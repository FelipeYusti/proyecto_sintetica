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

    public function getGananciaMensual()
    {

        $arrData = $this->model->getRevenueMonth();
        echo json_encode($arrData, JSON_UNESCAPED_UNICODE);
    }
    public function getGananciaTotal()
    {

        $arrData = $this->model->getRevenueYear();
        echo json_encode($arrData, JSON_UNESCAPED_UNICODE);
    }
    public function getGananciaAnual()
    {

        $arrData = $this->model->getRevenueMonthYear();
        $resultado = [
            'fecha' => [],
            'monto' => []
        ];
        foreach ($arrData as $row) {
            $resultado['fecha'][] = $row['mes'];
            $resultado['monto'][] =  $row['ganancias'];
        }
        echo json_encode($resultado, JSON_UNESCAPED_UNICODE);
    }
    public function getReservasAno()
    {

        $arrData = $this->model->getReserYear();
        echo json_encode($arrData, JSON_UNESCAPED_UNICODE);
    }
    public function getReservasMes()
    {

        $arrData = $this->model->getReserMonth();
        echo json_encode($arrData, JSON_UNESCAPED_UNICODE);
    }
    public function getReservasHoy()
    {

        $arrData = $this->model->getCountReserToday();
        echo json_encode($arrData, JSON_UNESCAPED_UNICODE);
    }
    public function getReservasAnual()
    {
        $arrData = $this->model->getCountReserYear();
        $resultado = [
            'fecha' => [],
            'cantidad' => []
        ];
        foreach ($arrData as $row) {
            $resultado['fecha'][] = $row['mes'];
            $resultado['cantidad'][] =  $row['cantidad'];
        }
        echo json_encode($resultado, JSON_UNESCAPED_UNICODE);
    }
    public function getCantidaConvenios()
    {
        $arrData = $this->model->getCountAgreements();
        echo json_encode($arrData);
    }
}

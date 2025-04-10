<?php
class Calendario extends Controllers
{
    public function __construct()
    {
        parent::__construct();
        /* session_start();
        if (empty($_SESSION['login'])) {
            header('Location: ' . base_url() . '/login');
        } */
    }

    public function calendario()
    {

        $data['page_title'] = "Página de Calendario";
        $data['page_name'] = "calendario";
        $data['script'] = "calendario";
        $this->views->getView($this, "calendario", $data);
    }

   
}

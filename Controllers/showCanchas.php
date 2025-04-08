<?php
class ShowCanchas extends Controllers
{

    public function __construct()
    {
        parent::__construct();
        /* session_start();
        if (empty($_SESSION['login'])) {
            header('Location: ' . base_url() . '/login');
        } */
    }

    public function showCanchas()
    {

        $data['page_title'] = "Página de canchas";
        $data['page_name'] = "showCanchas";
        $data['script'] = "showCanchas";
        $this->views->getView($this, "showCanchas", $data);
    }
}

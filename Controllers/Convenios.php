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
        $data['page_name'] = "canchas";
        $data['script'] = "canchas";
        $this->views->getView($this, "canchas", $data);
    }
}

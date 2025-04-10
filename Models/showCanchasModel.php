<?php
class showCanchasModel extends Mysql
{

    public function __construct()
    {
        parent::__construct();
    }


    public function getCanchas()
    {
        $sql = "SELECT * FROM canchas WHERE canchas.status > 0 ";
        $request = $this->select_all($sql);
        return $request;
    }
}

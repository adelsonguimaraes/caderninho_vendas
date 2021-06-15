<?php

require_once __DIR__ . "/../invoke/invoke.php";

class produto_control {
    protected $obj;
    protected $obj_dao;

    public function __construct ($obj = null) {
        invoke::call('produto');
        $this->obj_dao = new produto_dao();
        $this->obj = $obj;
    }

    function listar () {

        $o = new produto();
        if (!empty($this->obj->idusuario)) $o->setIdusuario($this->obj->idusuario);
        
        $resp = $this->obj_dao->listar($o);
        
        return $resp;
    }
}
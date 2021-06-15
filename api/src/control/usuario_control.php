<?php

require_once __DIR__ . "/../invoke/invoke.php";

class usuario_control {
    protected $obj;
    protected $obj_dao;

    public function __construct ($obj = null) {
        invoke::call('usuario');
        $this->obj_dao = new usuario_dao();
        $this->obj = $obj;
    }

    function acessar () {
        $o = new usuario();
        if (!empty($this->obj->email)) $o->setEmail($this->obj->email);
        if (!empty($this->obj->senha)) $o->setSenha($this->obj->senha);
        
        $resp = $this->obj_dao->acessar($o);
        if (!$resp['success']) return $resp;
        $data = $resp['data'];

        

        $key = jwt::generate(array(
            "nome"=>$data->nome,
            "email"=>$data->email
        ));

        $resp['data']->jwt = $key;

        return $resp;
    }
}
<?php

class usuario_dao {
    protected $con;

    public function __construct () {
        $this->con = conexao::getinstance()->getConexao();
    }

    function acessar (usuario $obj) {

        $response = array(
            "success"=>false,
            "data"=>"",
            "msg"=>"Não permitido! Dados inválidos!"
        );

        $stmt = $this->con->prepare("SELECT nome, email, foto
        FROM usuario
        WHERE email = ? AND senha = ?");
        $stmt->bind_param('ss', $email, $senha);

        $email = $obj->getEmail();
        $senha = $obj->getSenha();

        $stmt->execute();

        $result = $stmt->get_result();
        $obj = $result->fetch_object();

        if (!$result || empty($obj)) return $response;
        
        $response['success'] = true;
        $response['data'] = $obj;
        $response['msg'] = '';

        return $response;
    }
}
<?php

class usuario_dao {
    protected $con;

    public function __construct () {
        $this->con = conexao_pdo::getinstance()->getConexao();
    }

    function acessar (usuario $obj) {
        $response = array(
            "success"=>false,
            "data"=>"",
            "msg"=>"Não permitido! Dados inválidos!"
        );

        try {

            $stmt = $this->con->prepare("SELECT MD5(id) as id, nome, email, foto
            FROM usuario
            WHERE email = :email AND senha = :senha");
            $stmt->bindParam(':email', $email);
            $stmt->bindParam(':senha', $senha);

            $email = $obj->getEmail();
            $senha = $obj->getSenha();

            $result = $stmt->execute();
            $obj = $stmt->fetchObject();

            if (!$result || empty($obj)) return $response;
            
            $response['success'] = true;
            $response['data'] = $obj;
            $response['msg'] = '';

        }catch(PDOException $e) {
            $response['success'] = false;
            $response['data'] = '';
            $response['msg'] = $e->getMessage();
        }

        return $response;
    }
}
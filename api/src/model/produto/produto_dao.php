<?php

class produto_dao {
    protected $con;

    public function __construct () {
        $this->con = conexao_pdo::getinstance()->getConexao();
    }

    function listar (produto $o) {
        $response = array(
            "success"=>false,
            "data"=> "",
            "msg"=> ""
        );

        try {

            $stmt = $this->con->prepare("SELECT * 
            FROM produto
            WHERE idusuario = :idusuario");
            $stmt->bindParam(':idusuario', $idusuario);

            $idusuario = $o->getIdusuario();
            
            $stmt->execute();
            $data = array();
            while($row = $stmt->fetchAll()) {
                array_push($data, $row);
            }

            $response['success'] = true;
            $response['data'] = $data;
            $response['msg'] = "";

        }catch(PDOException $e) {
            $response['success'] = false;
            $response['data'] = "";
            $response['msg'] = "Ocorreu um erro: " .$e->getMessage();
        }

        return $response;
    }
}
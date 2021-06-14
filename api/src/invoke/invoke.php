<?php

class invoke {
    public static function call($class=null, $verificar=null) {
        require_once __DIR__ . '/../../util/conexao.php';
        require_once __DIR__ . '/../../util/jwt.php';
        if (!empty($class)) require_once __DIR__ . "/../invoke/{$class}_invoke.php";

        if ($verificar) {
            $valid = jwt::validate();

            if (!$valid) {
                $response = array(
                    "success"=>false,
                    "msg"=>"Não autorizado!"
                );
                    
                die(json_encode($response));
            }
        }
    }
}
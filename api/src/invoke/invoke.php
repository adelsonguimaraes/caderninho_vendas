<?php

class invoke {
    public static function call($class=null, $verificar=null) {
        require_once __DIR__ . '/../../util/conexao_pdo.php';
        require_once __DIR__ . '/../../util/jwt.php';
        require_once __DIR__ . '/../../util/response.php';

        if (!empty($class)) require_once __DIR__ . "/../invoke/{$class}_invoke.php";

        if ($verificar) {
            $valid = jwt::validate();

            if (!$valid) {
                $response = new response();
                $response->setSuccess(false)
                    ->setMsg("Acesso não autorizado")
                    ->setAuthorized(false);

                die(json_encode($response));
            }
        }
    }
}
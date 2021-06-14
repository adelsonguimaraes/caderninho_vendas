<?php

class invoke {
    public static function call($class) {
        require_once __DIR__ . '/../../util/conexao.php';
        require_once __DIR__ . '/../../util/jwt.php';
        require_once __DIR__ . "/../invoke/{$class}_invoke.php";
    }
}
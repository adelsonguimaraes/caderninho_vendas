<?php

class conexao {
    protected $con;

    protected function __construct () {
        $this->con = mysqli_connect(
            "localhost", // host
            "root", // user
            "", // pass
            "caderninho_vendas" // db
        );

        if (mysqli_connect_error()) die ("Erro de conexão: " . mysql_connect_error());
    }

    public static function getInstance () {
        static $instance = null;
        if (null === $instance) $instance = new static();
        return $instance;
    }

    public function getConexao () {
		mysqli_query($this->con, "SET lc_time_names = 'pt_BR'");
		mysqli_query($this->con, "SET NAMES 'utf8'");
		mysqli_query($this->con, 'SET character_set_connection=utf8');
		mysqli_query($this->con, 'SET character_set_client=utf8');
		mysqli_query($this->con, 'SET character_set_result=utf8');
		return $this->con;
	}
}
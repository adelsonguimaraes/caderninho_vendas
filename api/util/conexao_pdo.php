<?php

class conexao_pdo {
    protected $con;
    protected $host = "localhost";
    protected $dbname = "caderninho_vendas";
    protected $user = "root";
    protected $pass = "";

    protected function __construct () {
        $this->con = new PDO(
            "mysql:
            host={$this->host};
            dbname={$this->dbname}",
            $this->user, // user
            $this->pass // pass
        );
    }

    public static function getInstance () {
        static $instance = null;
        if (null === $instance) $instance = new static();
        return $instance;
    }

    public function getConexao () {
        try {
            $this->con->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            return $this->con;
        }catch(PDOException $e) {
            die("Erro de conexão: " . $e->getMessage());
        }
	}
}
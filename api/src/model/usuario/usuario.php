<?php

class usuario implements JsonSerializable {
    private $id;
    private $nome;
    private $email;
    private $senha;
    private $data_cadastro;

    public function __construct (
        $id = "",
        $nome = "",
        $email = "",
        $senha = "",
        $data_cadastro = ""
    ) {
        $this->id = $id;
        $this->nome = $nome;
        $this->email = $email;
        $this->senha = $senha;
        $this->data_cadastro = $data_cadastro;
    }

    public function getId() {
        return $this->id;
    }
    public function getNome() {
        return $this->nome;
    }
    public function getEmail() {
        return $this->email;
    }
    public function getSenha() {
        return $this->senha;
    }
    public function getData_cadastro() {
        return $this->data_cadastro;
    }

    public function setId($id) {
        $this->id = $id;
        return $this;
    }
    public function setNome($nome) {
        $this->nome = $nome;
        return $this;
    }
    public function setEmail($email) {
        $this->email = $email;
        return $this;
    }
    public function setSenha($senha) {
        $this->senha = $senha;
        return $this;
    }
    public function setData_cadastro($data_cadastro) {
        $this->data_cadastro = $data_cadastro;
        return $this;
    }

    public function jsonSerialize () {
        return [
            "id" => $this->id,
            "nome" => $this->nome,
            "email" => $this->email,
            "senha" => $this->senha,
            "data_cadastro" => $this->data_cadastro
        ];
    }

}
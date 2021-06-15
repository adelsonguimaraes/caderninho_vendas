<?php

class produto implements JsonSerializable {
    private $id;
    private $idusuario;
    private $nome;
    private $preco;
    private $foto;
    private $data_cadastro;

    public function __construct (
        $id = null,
        $idusuario = null,
        $nome = null,
        $preco = null,
        $foto = null,
        $data_cadastro = null
    ) {
        $this->id = $id;
        $this->idusuario = $idusuario;
        $this->nome = $nome;
        $this->preco = $preco;
        $this->foto = $foto;
        $this->data_cadastro = $data_cadastro;
    }

    public function getId () {
        return $this->id;
    }
    public function getIdusuario () {
        return $this->idusuario;
    }
    public function getNome () {
        return $this->nome;
    }
    public function getPreco () {
        return $this->preco;
    }
    public function getFoto () {
        return $this->foto;
    }
    public function getData_cadastro () {
        return $this->data_cadastro;
    }

    public function setId($id) {
        $this->id = $id;
        return $this;
    }
    public function setIdusuario($idusuario) {
        $this->idusuario = $idusuario;
        return $this;
    }
    public function setNome($nome) {
        $this->nome = $nome;
        return $this;
    }
    public function setPreco($preco) {
        $this->preco = $preco;
        return $this;
    }
    public function setFoto($foto) {
        $this->foto = $foto;
        return $this;
    }
    public function setData_cadastro($data_cadastro) {
        $this->data_cadastro = $data_cadastro;
        return $this;
    }

    public function JsonSerialize() {
        return [
            "id" => $this->id,
            "idusuario" => $this->idusuario,
            "nome" => $this->nome,
            "preco" => $this->preco,
            "foto" => $this->foto,
            "data_cadastro" => $this->data_cadastro
        ];
    }

}
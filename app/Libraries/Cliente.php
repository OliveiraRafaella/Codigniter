<?php

class Cliente {
    public $nome_completo;

    public function __construct()
    {
        //public $nome;
        //criar nome completo
        $this->nome_completo = $this->nome . ' ' . $this->apelido;

        //video 47 calculo de idade
    }
}
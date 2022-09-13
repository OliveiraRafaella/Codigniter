<?php namespace App\Libraries\Loja;

class Vendas {
    public $produto;
    public $preco;

    public function info(){
        return "Produto: $this->produto | Preço: R$ $this->preco";
    }

    public function hash(){
        $chars = "abcdefghijklmnopqrABCDEFGHIJKLMNOPQRabcdefghijklmnopqrABCDEFGHIJKLMNOPQRabcdefghijklmnopqrABCDEFGHIJKLMNOPQRabcdefghijklmnopqrABCDEFGHIJKLMNOPQR";
        return substr(str_shuffle($chars),0,10);
    }
}
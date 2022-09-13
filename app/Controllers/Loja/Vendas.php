<?php

namespace App\Controllers\Loja;

use CodeIgniter\Controller;

class Vendas extends Controller
{
    protected $helpers = array('date','matematica');
    
    public function index()
    {
        
        echo now();
        echo '<br>';
        echo adicionar(10,30);
        echo '<br>';
        echo subtracao(10,50);
        echo '<br>';
        echo multiplicacao(10,8);
        echo '<br>';
        echo divisao(40,2);
    }
    
}

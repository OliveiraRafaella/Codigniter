<?php

namespace App\Controllers;

use CodeIgniter\HTTP\Request;
use CodeIgniter\Controller;
use App\Libraries\Loja\Vendas;
use JetBrains\PhpStorm\ArrayShape;

class Main extends Controller //BaseController
{
    public function index11(){
       echo 'inicio';

       $v = new Vendas();
       $v->produto = "Automovel";
       $v->preco= 10000.01;

       echo '<br>';
       echo $v->info();
       echo '<br>';
       echo $v->hash();

    }

    public function index12(){
        /*view dentro e fora da pasta*/
        echo view('Loja\pagina');
        echo view('p1');
        echo view('p2');
        echo view('p3');
        $variaveis = [
            'nome' => 'Joao',
            'apelido' => 'Ribeiro'
        ];
        
        echo view('pagina',$variaveis);
        //echo view ('pagina',['nome'=>'Joao']); outro modo de fazer array

        //dados na cache
        $dados = array(
            'nome' => 'Joao',
            'apelido' => 'Ribeiro'
        );

        echo view('pagina',$dados,['cache'=>60]);
     }

    public function index13(){
        $marcas = [
            'Audi',
            'Mercedes',
            'Ferrari',
            'Maclaren'
        ];

        echo view('pagina',['marcas' => $marcas ]);
        
    }

    public function index14(){
        $clientes = [
            [
                'nome' => 'Joao',
                'email' => 'joao@gmail.com'
            ],
            [
                'nome' => 'Ana',
                'email' => 'ana@gmail.com'
            ],
            [
                'nome' => 'Carlos',
                'email' => 'carlos@gmail.com'
            ],
            [
                'nome' => 'Helena',
                'email' => 'helena@gmail.com'
            ],
        ];

        echo view('pagina',['clientes' => $clientes ]);
    }

    public function index15(){
        //echo view('layouts/default');
        echo view('pagina1');
    }
    public function index(){
        //echo view('layouts/default');
        echo view('pagina3');
    }
/* 
    video 16 minuto 11:31 */
} 

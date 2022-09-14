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

        echo view('pagina13',['marcas' => $marcas ]);
        
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
        echo view('pagina15');
    }
    public function index16(){
        //echo view('layouts/default');
        echo view('pagina16');
    }
    public function index17(){
        //Usar o render torna a redenrização da pagina mais rapida, do que somente utilizar o view
        $dados = [
            'nome' => 'Ana',
            'apelido' => 'Beatriz'
        ];

        $var = \Config\Services::renderer();
        //definicção de variavel
        //$var->setVar('nome', 'Rafaella Cristina')->setVar('apelido','Oliveira');
        $var->setData($dados); //represntar dados como array
        echo $var->render('pagina16');
        //echo $var->setData($dados)->echo $var->render('pagina3'); //outra forma de mostrar os dados
    }

    public function index18(){
        //view parser
        $p = \Config\Services::parser();
        $p->setData([
            'frase' => 'Esta frase é do parser.',
            'titulo' => 'Frase'
        ]);

        echo $p->render('pagina18');
    }
    
    public function index19(){

        $p = \Config\Services::parser();
        $p->setData([
            'titulo' => 'Testes com view parser',
            'nomes'=> [
                ['nome' =>'Rafaella'],
                ['nome' =>'Ana'],
                ['nome' =>'Mateus'],
            ],
            'admin' => false
        ]);

        echo $p->render('pagina19');        
    }

    public function index20 (){
        
        $tabela = new \CodeIgniter\View\Table();

        $template = [
            'table_open' => '<table class = "table table-striped">',
        
            'thead_open'  => '<thead class="thead-dark">',
        ];
        
        $tabela->setTemplate($template);

        $data = [
            ['Name', 'Color', 'Size'],
            ['Fred', 'Blue',  'Small'],
            ['Mary', 'Red',   'Large'],
            ['John', 'Green', 'Medium'],
        ];

        echo view('pagina20',['tabela' => $tabela->generate($data)]);
    }
    
            public function index (){
                echo view('pagina21');
            }

/* 
    video 16 minuto 11:31 */
} 

<?php

namespace App\Controllers;

use CodeIgniter\HTTP\Request;
use CodeIgniter\Controller;
use App\Libraries\Loja\Vendas;
use JetBrains\PhpStorm\ArrayShape;

class Main extends Controller //BaseController
{
    /*Construtor da sessao
    private $ses = null;
    public function __construct()
    {
        $this->ses = \Config\Services::session();
    }*/
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
            'admin' => false,
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
    
    public function index22 (){
    
        echo view('pagina21');
    }

    public function index23 (){
        echo view('home');
    }

    public function index23_1(){
        
        $a = true;
        if($a){
            return redirect()->to(site_url("public/main/redirecionado"));
        }
        echo view('servicos');
    }

    public function redirecionado(){
        echo view('inc1');
    }

    public function index24(){
        
       // $ses = \Config\Services::session();
       //$this->ses->set('usuario','rafa');

       session()->set('email','rafa@gmail.com');

       echo '<pre>';
       print_r(session()->get());
    }

    public function teste()
    {
        //echo $this->ses->get('usuario');
        echo 'Usuario: ' . session()->get('usuario') . '<br>' . 'Email: ' . session()->get('email');
    }

    public function index25(){
        
        session()->set('usuario','ana'); //set adiciona dados

        $dados = [
            'nome' => 'Joao',
            'email' => 'j@gmail.com',
            'facebook'=> 'sdsdsdsds'
        ];

        //echo session()->get('usuario');
        session()->set($dados);
        
        echo session()->nome;

        
        session()->remove('usuario'); //remove o campo

        //pesquisa se o campo existe
        if (session()->has('usuario')){
            echo 'sim';
        }else{
            echo 'não';
        }

        $this->printSession();
    }

    public function mostrar(){
        //return view();
    }

    private function printSession(){
        echo '<pre>';
        print_r(session()->get());
    }

    public function index26(){
        
        echo 'index';
        $this->printSession();
    }

    public function login(){
        session()->set([
            'usuario'=> 'ana',
            'email'=> 'ana@gmail.com'
        ]);

        echo 'login';
        $this->printSession();
    }

    public function usuario()
    {
        if(session()->has('usuario')){
            echo 'Existe usuario logado';
        } else {
            echo 'Não existe usuario logado';
        }
    }

    public function logout(){

        //session()->destroy();//destroi os dados da sessao mas mantem o cookie
        session()->stop();//destroi a sessao e destroi os cookie e  cria um novo 
        return redirect()->to(site_url('public/main/index26'));
    }
} 

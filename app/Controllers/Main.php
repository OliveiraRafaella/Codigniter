<?php

namespace App\Controllers;

use CodeIgniter\HTTP\Request;
use CodeIgniter\Controller;
use App\Libraries\Loja\Vendas;

use CodeIgniter\View\ViewDecoratorInterface;
use JetBrains\PhpStorm\ArrayShape;
use PHPUnit\Framework\MockObject\Stub\ReturnReference;
use App\Libraries\Cliente;

class Main extends Controller //BaseController
{
    /*Construtor da sessao
    private $ses = null;
    public function __construct()
    {
        $this->ses = \Config\Services::session();
    }*/
    public function index11()
    {
        echo 'inicio';

        $v = new Vendas();
        $v->produto = "Automovel";
        $v->preco = 10000.01;

        echo '<br>';
        echo $v->info();
        echo '<br>';
        echo $v->hash();
    }

    public function index12()
    {
        /*view dentro e fora da pasta*/
        echo view('Loja\pagina');
        echo view('p1');
        echo view('p2');
        echo view('p3');
        $variaveis = [
            'nome' => 'Joao',
            'apelido' => 'Ribeiro'
        ];

        echo view('pagina', $variaveis);
        //echo view ('pagina',['nome'=>'Joao']); outro modo de fazer array

        //dados na cache
        $dados = array(
            'nome' => 'Joao',
            'apelido' => 'Ribeiro'
        );

        echo view('pagina', $dados, ['cache' => 60]);
    }

    public function index13()
    {
        $marcas = [
            'Audi',
            'Mercedes',
            'Ferrari',
            'Maclaren'
        ];

        echo view('pagina13', ['marcas' => $marcas]);
    }

    public function index14()
    {
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

        echo view('pagina', ['clientes' => $clientes]);
    }

    public function index15()
    {
        //echo view('layouts/default');
        echo view('pagina15');
    }
    public function index16()
    {
        //echo view('layouts/default');
        echo view('pagina16');
    }
    public function index17()
    {
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

    public function index18()
    {
        //view parser
        $p = \Config\Services::parser();
        $p->setData([
            'frase' => 'Esta frase é do parser.',
            'titulo' => 'Frase'
        ]);

        echo $p->render('pagina18');
    }

    public function index19()
    {

        $p = \Config\Services::parser();
        $p->setData([
            'titulo' => 'Testes com view parser',
            'nomes' => [
                ['nome' => 'Rafaella'],
                ['nome' => 'Ana'],
                ['nome' => 'Mateus'],
            ],
            'admin' => false,
        ]);

        echo $p->render('pagina19');
    }

    public function index20()
    {

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

        echo view('pagina20', ['tabela' => $tabela->generate($data)]);
    }

    public function index22()
    {

        echo view('pagina21');
    }

    public function index23()
    {
        echo view('home');
    }

    public function index23_1()
    {

        $a = true;
        if ($a) {
            return redirect()->to(site_url("public/main/redirecionado"));
        }
        echo view('servicos');
    }

    public function redirecionado()
    {
        echo view('inc1');
    }

    public function index24()
    {

        // $ses = \Config\Services::session();
        //$this->ses->set('usuario','rafa');

        session()->set('email', 'rafa@gmail.com');

        echo '<pre>';
        print_r(session()->get());
    }

    public function teste()
    {
        //echo $this->ses->get('usuario');
        echo 'Usuario: ' . session()->get('usuario') . '<br>' . 'Email: ' . session()->get('email');
    }

    public function index25()
    {

        session()->set('usuario', 'ana'); //set adiciona dados

        $dados = [
            'nome' => 'Joao',
            'email' => 'j@gmail.com',
            'facebook' => 'sdsdsdsds'
        ];

        //echo session()->get('usuario');
        session()->set($dados);

        echo session()->nome;


        session()->remove('usuario'); //remove o campo

        //pesquisa se o campo existe
        if (session()->has('usuario')) {
            echo 'sim';
        } else {
            echo 'não';
        }

        $this->printSession();
    }

    public function mostrar()
    {
        //return view();
    }

    private function printSession()
    {
        echo '<pre>';
        print_r(session()->get());
    }

    public function index26()
    {

        echo 'index';
        $this->printSession();
    }

    public function login()
    {
        session()->set([
            'usuario' => 'ana',
            'email' => 'ana@gmail.com'
        ]);

        echo 'login';
        $this->printSession();
    }

    public function usuario()
    {
        if (session()->has('usuario')) {
            echo 'Existe usuario logado';
        } else {
            echo 'Não existe usuario logado';
        }
    }

    public function logout()
    {

        //session()->destroy();//destroi os dados da sessao mas mantem o cookie
        session()->stop(); //destroi a sessao e destroi os cookie e  cria um novo 
        return redirect()->to(site_url('public/main/index26'));
    }

    public function index27()
    {

        $db = \Config\Database::connect();
        $resultados = $db->query("SELECT * FROM clientes"); //->getResultObject();
        $db->close();

        /*echo '<pre>';
        print_r($resultados);*/

        foreach ($resultados->getResult() as $row) { //forma de representar dados do banco
            echo '<p>' . $row->nome . '<p>';
        }
    }

    public function index29($id)
    {
        /* $params =[
            $id
        ];

        $db = db_connect();
        $dados = $db->query("SELECT * FROM clientes WHERE idclientes = ?",$params)->getResultObject();
        $db->close();

        echo '<pre>';
        print_r($dados);*/

        //Array associativo

        $params = [
            'idcliente' => $id
        ];

        $db = db_connect();
        $dados = $db->query("
            SELECT * 
            FROM clientes 
            WHERE idclientes = :idcliente:
            ", $params)->getResultObject();
        $db->close();

        echo '<pre>';
        print_r($dados);
    }

    public function index30()
    {

        return view('formulario');
    }

    public function novocliente()
    {

        $nome = $this->request->getPost('nome');
        $email = $this->request->getPost('email');

        $params = [
            'nome' => $nome,
            'email' => $email
        ];

        $db = db_connect();
        $db->query("
            INSERT INTO clientes
            VALUES(
                0,
                :nome:,
                :email:
            )
        ", $params);
        $db->close();

        echo 'terminado';
    }

    public function index42()
    {
        helper('form');
        return view('formulario42');
    }

    public function submeter()
    {
        //verificar se houve a submissão de formulario
        if ($this->request->getMethod() !== 'post') {
            return redirect()->to(site_url('public/main/index42'));
        }

        //validação
        $validacao = $this->validate([
            'usuario' => 'required',
            'senha' => 'required'
        ]);

        if (!$validacao) {
            echo 'erro';
        } else {
            echo 'sucesso';
        }
    }

    public function index43()
    {
        $data = [];
        if (session()->has('erro')) {
            $data['erro'] = session('erro');
        }
        return view('formulario43', $data);
    }

    public function submeter43()
    {
        #verificar se houve submissão
        if ($this->request->getMethod() !== 'post') {
            return redirect()->to(site_url('public/main/index43'));
        }

        $val = $this->validate([
            'nome' => 'required|alpha',
            'apelido' => 'required'
        ], [ //mensagem personalizada
            'nome' => [
                'required' => 'Nome é campo de preenchimento obrigatório',
                'alpha' => 'Só pode conter letras'
            ],
            'apelido' => [
                'required' => 'Apelido é campo de preenchimento obrigatório'
            ]
        ]);

        if (!$val) {
            //erro validação
            return redirect()->to(site_url('public/main/index43'))->withInput()->with('erro', $this->validator); //->back()->withInput();
        } else {
            echo 'Formulario ok';
        }
    }

    public function index45()
    {
        $db = db_connect();
        $resultados = $db->query("SELECT * FROM loja")->getResultObject();
        $db->close();

        echo 'Cliente: ' . count($resultados);
    }

    public function index46()
    {
        $db = db_connect();
        $dados = $db->query("SELECT * FROM loja");
        $db->close();

        $cliente = $dados->getRow(); //busca primeiro registro
        echo $cliente->nome;

        //transformar dados em objetos
        /*  foreach($dados->getResult() as $cliente){
            echo $cliente -> nome . "<br>";
            echo $cliente -> email . "<br>";
            echo '<hr>';
        }*/

        //array
        /*foreach($dados->getResultArray() as $cliente){
            echo $cliente['nome']. "<br>";
            echo $cliente['email'] . "<br>";
            echo '<hr>';
        }*/

        /* mostrar primeiro ultimo e seguinte dado
        $primeiro = $dados->getFirstRow();
        $seguinte = $dados->getNextRow();
        $ultimo = $dados->getLastRow();

        echo $primeiro-> nome ."<br>" ;
        echo $ultimo -> nome ."<br>";
        echo $seguinte -> nome; */
    }

    public function index47()
    {
        /*  $db = db_connect();
        $dados = $db->query("SELECT * FROM loja");
        $db -> close();

        //$cliente = $dados->getResultObject()[0]; //dados do primeiro cliente
        $cliente = $dados->getCustomResultObject('Cliente')[0];

        echo $cliente->nome;
        //echo $cliente->nome_completo; 
 */ 
        $db = db_connect();
        $tabela = $db->table('loja');
        $dados = $tabela->getCustomResultObject(2,'Cliente');

        var_dump($dados);
        exit();


        foreach ($dados as $lojas) {
            echo $lojas->nome  . '</br>';
        }

        $db->close();
        //echo $dados->nome;
    }

    public function index48()
    {
        $db = db_connect();
        $dados = $db->query("SELECT * FROM loja"); //->getResultObject();
        $db->close();

       /*  echo '<pre>';
        print_r($dados->getFieldNames());//mostra as colunas da tabela retorna array */

        echo $db->table('loja')->countAll(); //conta quantos registros possui na tabela
        /*outro modo de fazer*/
        //echo count($dados);
        
        /************ ERRO******************* */
        //$obj = new Cliente();
        //$obj -> nome_completo;

        //$cliente = $dados->getResultObject()[0]; //dados do primeiro cliente
        //$cliente = $dados->getCustomRowObject(2,'app\Libraaries\Cliente.php');

        //echo $cliente->nome;
        //echo $cliente->nome_completo;
    }
}

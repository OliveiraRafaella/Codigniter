<?php

namespace App\Controllers;

use CodeIgniter\HTTP\Request;
use CodeIgniter\Controller;
use App\Libraries\Loja\Vendas;

use CodeIgniter\View\ViewDecoratorInterface;
use JetBrains\PhpStorm\ArrayShape;
use PHPUnit\Framework\MockObject\Stub\ReturnReference;
use App\Libraries\Cliente;
use DateTime;
use App\Models\Clientes;

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
        //Usar o render torna a redenriza????o da pagina mais rapida, do que somente utilizar o view
        $dados = [
            'nome' => 'Ana',
            'apelido' => 'Beatriz'
        ];

        $var = \Config\Services::renderer();
        //definic????o de variavel
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
            'frase' => 'Esta frase ?? do parser.',
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
            echo 'n??o';
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
            echo 'N??o existe usuario logado';
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
        //verificar se houve a submiss??o de formulario
        if ($this->request->getMethod() !== 'post') {
            return redirect()->to(site_url('public/main/index42'));
        }

        //valida????o
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
        #verificar se houve submiss??o
        if ($this->request->getMethod() !== 'post') {
            return redirect()->to(site_url('public/main/index43'));
        }

        $val = $this->validate([
            'nome' => 'required|alpha',
            'apelido' => 'required'
        ], [ //mensagem personalizada
            'nome' => [
                'required' => 'Nome ?? campo de preenchimento obrigat??rio',
                'alpha' => 'S?? pode conter letras'
            ],
            'apelido' => [
                'required' => 'Apelido ?? campo de preenchimento obrigat??rio'
            ]
        ]);

        if (!$val) {
            //erro valida????o
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
        $dados = $tabela->getCustomResultObject(2, 'Cliente');

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

    public function index49()
    {
        $db = db_connect();

        $tb_loja = $db->table('loja');
        //$resultados = $tb_loja->get()->getCustomResultObject('Cliente'); //problema no Custom
        $resultados = $tb_loja->get()->getResultObject();

        $this->printArray($resultados);

        //SELECT * FROM loja

        $db->close();
    }

    private function printArray($d)
    {
        if (is_array($d)) {
            echo '<pre>';
            print_r($d);
        } else if (is_object($d)) {
            echo '<pre>';
            print_r($d);
        } else {
            echo $d;
        }
    }

    public function index50()
    {
        $db = db_connect();

        $tb_loja = $db->table('loja');
        $resultados = $tb_loja->getWhere(['idcliente' => 5])->getResultObject();

        /*foreach ($resultados->getResult() as $cliente) {
            echo $cliente->nome . '<br>';            
        }*/

        $this->printArray($resultados);

        $db->close();
    }

    public function index51()
    {
        $db = db_connect();
        $tb_loja = $db->table('loja');
        $tb_loja->selectAvg('data_nascimento');
        $resultados = $tb_loja->get()->getResultObject();

        /*foreach ($resultados->getResult() as $cliente) {
            echo $cliente->nome . '<br>';            
        }*/

        $this->printArray($resultados);

        $db->close();
    }

    public function index52()
    {
        $db = db_connect();
        $dados = [
            [
                'nome' => 'nome2',
                'apelido' => 'apelido2',
                'email' => 'email2@email.com',
                'data_nascimento' => DateTime::createFromFormat('Y-m-d', '1990-05-15')->format('Y-m-d')
            ],
            [
                'nome' => 'nome3',
                'apelido' => 'apelido3',
                'email' => 'email3@email.com',
                'data_nascimento' => DateTime::createFromFormat('Y-m-d', '1990-05-15')->format('Y-m-d')
            ],
            [
                'nome' => 'nome4',
                'apelido' => 'apelido4',
                'email' => 'email4@email.com',
                'data_nascimento' => DateTime::createFromFormat('Y-m-d', '1990-05-15')->format('Y-m-d')
            ]
        ];
        /*$db->table('loja')->insert($dados);*/ //insere apenas 1 registro

        $db->table('loja')->insertBatch($dados); //insere apenas + de 1 registro

        $db->close();
    }

    public function index54()
    {
        $db = db_connect();

        $dados = [
            'nome' => 'NOME2',
            'apelido' => 'APELIDO2',
            'email' => 'EMAIL2@EMAIL.COM',
            'data_nascimento' => DateTime::createFromFormat('Y-m-d', '1990-05-15')->format('Y-m-d')
        ];

        $db->table('loja')->where('idcliente', 8)->update($dados); //UPDATE
        $db->table('loja')->where('idcliente', 8)->delete(); //DELETE
        $db->close();
    }

    public function index55()
    {
        $db = db_connect();

        $db->transStart();

        $dados = [ //sem o transition dado insere
            'idcliente' => 100,
            'nome' => 'aaa',
            'apelido' => 'aaa',
            'email' => 'aaa',
            'data_nascimento' => '1990-01-01',
        ];
        $db->table('loja')->insert($dados);

        $dados = [ //erro pois PK esta repetida
            'idcliente' => 5,
            'nome' => 'aaa',
            'apelido' => 'aaa',
            'email' => 'aaa',
            'data_nascimento' => '1990-01-01',
        ];
        $db->table('loja')->insert($dados); //n??o deixa salvar dados np banco

        $db->transComplete();

        if ($db->transStatus() == FALSE) {
            echo 'Aconteceu um erro na query';
        }
        $db->close();
    }

    public function index56()
    {
        $db = db_connect();

        if ($db->tableExists('loja')) {
            echo 'Sim';
        } else {
            echo 'N??o';
        }

        $resultados = $db->query("SELECT nome,apelido FROM loja");
        $campos_tabela = $resultados->getFieldNames(); //busca campos da tabela (nome das colunas)
        $this->printArray($campos_tabela);

        //VIDEO 56 SOBRE METADADOS

        $db->close();
    }


    public function index58()
    {
        //INTRODU????O AOS MODELS

        $cliente = new Clientes();
        //$dados = $cliente->find(1); //mostrar dados de acordo com parametro
        $dados = $cliente->findAll(); //mostrar todos os dados da tabela
        $this->printArray($dados);
    }

    public function index59()
    {
        $clientes = new Clientes();
        /* $cliente = [
            'nome' => 'NOVO',
            'apelido' => 'NOVO APELIDO',
            'email' => 'novo@email.com',
        ];

        $clientes->insert($cliente);
        echo 'OK CADASTRADO';*/

        /*  $cliente = [
            'nome' => 'aaa',
            'apelido' => 'aaa',
            'email' => 'aaa@email.com',
        ];
        $clientes->update(10,$cliente);

        echo 'OK ATUALIZADO'; */

        //FUN????O FEITA POR MIM PARA INSERIR MODEL
        //$this->inserir('Mariana','Lage','mariana@email.com','2006-07-08');

        $clientes->delete(11);
        echo 'DELETADO';
    }

    public function inserir($nome, $apelido, $email, $dn)
    {
        $cliente = new Clientes();

        $params = [
            'nome' => $nome,
            'apelido' => $apelido,
            'email' => $email,
            'data_nascimento' => $dn,

        ];

        /*INSERIR VARIOS DADOS
        $dados = [
            [
                'nome' => ':nome:',
                'apelido' => ':apleido:',
                'email' => ':email:',
                'data_nascimento' => ':dn:',
            ],
            [
                'nome' => 'Ana',
                'apelido' => 'Oliveira',
                'email' => 'ana@email.com',
                'data_nascimento' => '2002-04-06',
            ],
            [
                'nome' => 'Mateus',
                'apelido' => 'Oliveira',
                'email' => 'mateus@email.com',
                'data_nascimento' => '2009-08-21',
            ],
            [
                'nome' => 'Andrea',
                'apelido' => 'Oliveira',
                'email' => 'andrea@email.com',
                'data_nascimento' => '1974-11-30',
            ],
            [
                'nome' => 'Andre',
                'apelido' => 'Vitorino',
                'email' => 'andre@email.com',
                'data_nascimento' => '1974-12-31',
            ],
            [
                'nome' => 'Pedro',
                'apelido' => 'Lage',
                'email' => 'pedro@email.com',
                'data_nascimento' => '2001-04-21',
            ] 
        ];
        
        $cliente->insertBash($dados)*/

        $cliente->insert($params);
        echo 'INSERIDO';
    }

    public function index63()
    {
        $this->reset();
    }

    private function reset()
    {
        //numero de rows
        $num_rows = 10;

        $all = [];

        for ($i = 1; $i <= $num_rows; $i++) {

            $dob = new DateTime();
            $dob->setDate(rand(1960, 1995), rand(1, 12), rand(1, 25));
            $dob->setTime(0, 0, 0);
            $new = [
                'nome' => "Nome$i",
                'apelido' => "Apelido$i",
                'email' => "email$i",
                'data_nascimento' => $dob->format('Y-m-d H:i:s')
            ];

            array_push($all, $new);
        }

        $this->printArray($all);
        /*
        criar o objeto no model
        truncate da tabela
        construir dados a inserir na bd
        inserir os dados
        */
        $clientes = new Clientes();

        //truncar a tabela
        $clientes->query("TRUNCATE clientes");

        //inserir todos os registros de all
        $clientes->insertBatch($all);

        echo 'inserido ' . "$num_rows registros";
    }

    public function index64()
    {
        $clientes = new Clientes();

        $dados = [
            'nome' => 'Joao',
            'email' => 'eu@gmail.com'
        ];

        if ($clientes->save($dados) == false) {
            echo 'Aconteceu um erro';
            
        }

        echo '<p>Terminado';
    }

    public function index65()
    {
        $clientes = new Clientes();
        $dados = [
            'nome' => 'novo Nome1',
            'email' => 'teste@test.com'
        ];
        $clientes->save($dados);

        $this->printArray($clientes->errors());
    }

    public function index68()
    {
        //FORGE

        $forge = \Config\Database::forge();

        //criar tabela na base de dados
        //definir os campos
        $campos = [
            'idvenda' =>[
                'type' => 'INT',
                'unsigned' => true,
                'auto_increment' => true
            ],
            'nome' =>[
                'type' => 'VARCHAR',
                'constraint' => 50
            ],
            'email' =>[
                'type' => 'VARCHAR',
                'constraint' => 100,
                'default' => 'aaa'
            ]
        ];

        //definir chave primaria
        $forge->addPrimaryKey('idvenda');

        //definir os campos ao forge
        $forge->addField($campos);

        //criar tabela
        $forge->createTable('vendas',true);
        echo 'OK - TABALE CRIADA';

        //drop tabela
        $forge->dropTable('vendas');
        echo 'OK - DROP REALIZADO';
        
    }

    public function index69()
    {
        //MIGRATIONS (MIGRA????ES) - alterar estruta da base
        
    }
}
    //VIDEOS DE 70 A 73 SERVIDOR E PROJETO
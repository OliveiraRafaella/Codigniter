<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class Clientes extends Migration
{
    public function up() //executar para fazer a migração
    {
        $this->forge->addField([
            'idcliente' => [
                'type'=> 'INT',
                'unique'=> true,
                'unsigned' => true,
                'auto_increment' => true
            ],
            'nome' => [
                'type' => 'VARCHAR',
                'contraint'=>50
            ],
            'apelido' => [
                'type' => 'VARCHAR',
                'contraint'=>50
            ],
            'email' => [
                'type' => 'VARCHAR',
                'contraint'=>50
            ],
            'data_nascimento' => [
                'type' => 'DATETIME',
                'default'=> NULL
            ],
            'deleted_at' => [
                'type' => 'DATETIME',
                'default'=> NULL
            ],
        ]);
        $this->forge->addPrimaryKey('idcliente',true);
        $this->forge->createTable('tbclientes',true);

    }

    public function down() //voltar atras no que realizou
    {
        //$this->forge->dropTable('tbclientes',true);
    }
}

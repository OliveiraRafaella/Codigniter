<?php

namespace App\Models;

use CodeIgniter\Model;

class Clientes extends Model
{
    protected $table      = 'loja';
    protected $primaryKey = 'idcliente';
    protected $returnType = 'object';
    protected $userSoftdeletes = true;
    protected $allowedFields = ['nome','email','data_nascimento','apelido'];//altera apenas algumas colunas
    protected $deletedField  = 'delete_at';

}
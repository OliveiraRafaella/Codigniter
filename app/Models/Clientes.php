<?php

namespace App\Models;

use CodeIgniter\Model;

class Clientes extends Model
{
    protected $table      = 'loja';
    protected $primaryKey = 'idcliente';
    protected $returnType = 'object';
    protected $userSoftdeletes = true;
    protected $allowedFields = ['nome','email'];//altera apenas algumas colunas
    protected $deletedField  = 'delete_at';

    protected $validationRules    = [
        'nome'=> 'required|min_length[3]',
        'email'=> 'required|valid_email|is_unique[loja.email]'
    ];
    protected $validationMessages = [
        'nome' => [
            'required' => 'Nome é obrigatorio',
            'min_length'=>'Nome tem que ter 3 caracteres'
        ],
        'email' =>[
            'required'=>'Email é pbrigatorio',
            'valid_email'=>'O email tem um formato invalido',
            'is_unique' => 'Desculpe, mas ja existe um registro com o mesmo email'
        ]
    ];
    protected $skipValidation     = false;
}
<?php namespace App\Libraries;

class Componentes{
     public function clientes($cliente){
        $data = [
            'nome' => $cliente['nome'],
            'email' => $cliente['email']
        ];
        return view('cliente', $data);
    } 
    
}
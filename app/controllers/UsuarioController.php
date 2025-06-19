<?php

namespace app\controllers;
use app\models\Usuario;

class UsuarioController
{

    public static function InserirDados(string $nome, string $username, string $email, $dataNascimento, string $senha)
    {
        
        $novoUsuario = new Usuario();

        $novoUsuario->insert($nome, $username,  $email,  $dataNascimento,  $senha);

    }

}
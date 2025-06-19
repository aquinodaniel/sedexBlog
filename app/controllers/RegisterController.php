<?php

namespace app\controllers;

use Exception;

class RegisterController
{

    public function index()
    {

        $loader = new \Twig\Loader\FilesystemLoader('../app/views');
        $twig = new \Twig\Environment($loader, [
            'cache' => false,
        ]);

        $template = $twig->load('register.html');

        $params = [];

        echo $template->render($params);
    }

    public function salvar()
    {
        try {
            $nome = $_POST['nome'];
            $username = $_POST['username'];
            $email = $_POST['email'];
            $dataNascimento = $_POST['data_nascimento'];
            $senha = $_POST['senha'];

            UsuarioController::InserirDados($nome, $username, $email, $dataNascimento, $senha);
        } catch (Exception $e) {
            echo $e->getMessage();
        }    
    }
}

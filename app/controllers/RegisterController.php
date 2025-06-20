<?php

namespace app\controllers;

use Exception;

class RegisterController
{

    private function carregarTemplate($nomeTemplate, $params = [])
    {
        $loader = new \Twig\Loader\FilesystemLoader('../app/views');
        $twig = new \Twig\Environment($loader, [
            'cache' => false,
        ]);

        $template = $twig->load($nomeTemplate);
        echo $template->render($params);
    }


    public function index()
    {
        $this->carregarTemplate('register.html');
    }

    public function salvar()
    {
        $params = [];

        try {
            $nome = $_POST['nome'];
            $username = $_POST['username'];
            $email = $_POST['email'];
            $dataNascimento = $_POST['data_nascimento'];
            $senha = $_POST['senha'];
            $confimarSenha = $_POST['confirma_senha'];

            $erros = \app\controllers\UsuarioController::inserirDados($nome, $username, $email, $dataNascimento, $senha, $confimarSenha);

            if (!empty($erros)) {
                $params['erros'] = $erros; // Envia os erros para a view
            } else {
                $params['sucesso'] = "Usuário cadastrado com sucesso!";
            }
        } catch (Exception $e) {
            $params['erro_geral'] = $e->getMessage(); // Se der um erro não tratado
        }

        $this->carregarTemplate('register.html', $params);

        header('Location: /login?sucesso=1');
        exit;

    }
}

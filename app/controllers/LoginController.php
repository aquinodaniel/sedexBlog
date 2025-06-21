<?php

namespace app\controllers;

use app\models\Usuario;

class LoginController
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

        session_start();
        $params = [];

        if (isset($_SESSION['sucesso'])) {
            $params['sucesso'] = $_SESSION['sucesso'];
            unset($_SESSION['sucesso']);
        }

        if (isset($_SESSION['erro'])) {
            $params['erro'] = $_SESSION['erro'];
            unset($_SESSION['erro']);
        }


        $this->carregarTemplate('login.html', $params);
    }

    public function autenticar()
    {

        session_start();

        $username = $_POST['username'];
        $email = $_POST['email'];
        $senha = $_POST['senha'];

        $usuario = new Usuario();
        $dadosValidos = $usuario->validarAcesso($username, $email);

        if (!$dadosValidos) {
            $_SESSION['erro'] = "Usuario não encontrado.";
            header('Location: /login');
            exit;
        }

        if (password_verify($senha, $dadosValidos['senha'])) {
            $_SESSION['id'] = $dadosValidos['id'];
            $_SESSION['username'] = $dadosValidos['username'];
            $_SESSION['email'] = $dadosValidos['email'];

            header('Location: /');
        } else {
            $_SESSION['erro'] = "Senha incorreta.";
            header('location: /login');
            exit;
        }
    }

    public function logout()
    {
        session_start();
        session_destroy();
        header('Location: /login');
        exit;
    }
}

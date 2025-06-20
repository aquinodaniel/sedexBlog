<?php

namespace app\controllers;

class LoginController
{

    public function index()
    {
        $loader = new \Twig\Loader\FilesystemLoader('../app/views');
        $twig = new \Twig\Environment($loader, [
            'cache' => false, // Desative no desenvolvimento
        ]);

        $template = $twig->load('login.html');

        $params = []; // Aqui você pode passar variáveis para o template

        if (isset($_GET['sucesso']) && $_GET['sucesso'] == '1') {
            $params['sucesso'] = "Seja bem-vindo! Cadastro realizado com sucesso. Faça seu login.";
        }

        echo $template->render($params);
    }
}

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

        echo $template->render($params);
    }
}

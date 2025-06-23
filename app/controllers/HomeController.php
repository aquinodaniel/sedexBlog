<?php

namespace app\controllers;

class HomeController
{

    public function index()
    {

        $loader = new \Twig\Loader\FilesystemLoader([
            '../app/views',
            '../app/templates'
        ]);
        $twig = new \Twig\Environment($loader, [
            'cache' => false, // Desative no desenvolvimento
        ]);

        $template = $twig->load('home.html');

        $params = []; // Aqui você pode passar variáveis para o template

        echo $template->render($params);

        session_start();

        if (!isset($_SESSION['id'])) {
            header('Location: /login');
            exit;
        }

    }
}

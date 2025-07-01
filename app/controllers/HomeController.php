<?php

namespace app\controllers;

use app\models\Postagem;

class HomeController
{

    public function index()
    {
        session_start();

        if (!isset($_SESSION['id'])) {
            header('Location: /login');
            exit;
        }

        $collection = Postagem::selectPosts();

        $loader = new \Twig\Loader\FilesystemLoader([
            '../app/views',
            '../app/templates'
        ]);
        $twig = new \Twig\Environment($loader, [
            'cache' => false,
        ]);

        $template = $twig->load('home.html');

        $params['posts'] = $collection;

        echo $template->render($params);


    }


}

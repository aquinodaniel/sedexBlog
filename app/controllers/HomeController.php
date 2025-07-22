<?php

namespace app\controllers;

use app\models\Postagem;

class HomeController
{

    private function validarCookie()
    {

        session_start();

        if (!isset($_COOKIE['usuario_logado']) && ($_GET['registro'] ?? '') !== '1') {
            header("Location: /login");
            exit;
        }
    }

    public function index()
    {

        self::validarCookie();


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

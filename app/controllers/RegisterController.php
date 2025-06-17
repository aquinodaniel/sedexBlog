<?php

namespace app\controllers;

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
}

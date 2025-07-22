<?php

namespace app\controllers;

class PerfilController
{

    private function carregarTemplate($nomeTemplate, $params = [])
    {
        $loader = new \Twig\Loader\FilesystemLoader([
            '../app/views',
            '../app/templates'
        ]);
        $twig = new \Twig\Environment($loader, [
            'cache' => false,
        ]);

        $template = $twig->load($nomeTemplate);
        echo $template->render($params);
    }

    public function index()
    {

        $params = [];

        $this->carregarTemplate('perfil.html', $params);
    }
}

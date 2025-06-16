<?php

class IntroController
{

    public function index()
    {
        $loader = new \Twig\Loader\FilesystemLoader('/path/to/templates');
        $twig = new \Twig\Environment($loader, [
            'cache' => '/path/to/compilation_cache',
        ]);
        $template = $twig->load('intro.html');

        $params = array();

        $content = $template->render($params);

        echo $content;
    }
}

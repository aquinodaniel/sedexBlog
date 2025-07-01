<?php

namespace app\controllers;

use app\controllers\ComentarioController;
use app\models\Comentarios;
use app\models\Postagem;

class PostController
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

        $postId = $_GET['postagemId']; 

        $post = Postagem::selectPostId($postId);
        $comentarios = Comentarios::exibirComents($postId);

        $params = [
            'post' => $post,
            'comentario' => $comentarios
        ];

        $this->carregarTemplate('postagem.html', $params);
    }

    public function insert()
    {
        session_start();
        $conteudo = $_POST['conteudo'] ?? '';
        $usuario_id = $_SESSION['id'] ?? null;

        if (!$usuario_id || empty(trim($conteudo))) {
            // Aqui você pode redirecionar ou lançar erro
            header('Location: /?erro=Post inválido');
            exit;
        }

        Postagem::insertPost($conteudo, (int)$usuario_id);

        header('Location: /');
        exit;
    }

    public function insertComent()
    {

        ComentarioController::insert();

        $postId = $_POST['postagemId'] ?? null;

        if ($postId) {
            header("Location: /post?postagemId=$postId");
            exit;
        }

    }

}

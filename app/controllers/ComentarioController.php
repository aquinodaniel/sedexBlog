<?php

namespace app\controllers;

use app\models\Comentarios;
use Exception;


class ComentarioController
{

    public static function insert()
    {
        session_start();

        $postagemId = $_GET['postagemId'] ?? null;
        $usuarioId = $_SESSION['id'] ?? null;
        $conteudo = $_POST['conteudo'] ?? null;

        if (!$postagemId || !$usuarioId || !$conteudo) {
            throw new Exception("Confira as informações e tente novamente");
        }

        try {
            Comentarios::insertComents($postagemId, $usuarioId, $conteudo);
        } catch (Exception $e) {
            $_SESSION['erro'] = "Erro ao inserir comentário: " . $e->getMessage();
        }

        header("Location: /post?postagemId={$postagemId}");
        exit;
    }
}

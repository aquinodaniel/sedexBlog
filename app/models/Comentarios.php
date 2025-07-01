<?php

namespace app\models;

use lib\database\Connection;


class Comentarios
{

    public static function exibirComents($postId)
    {
        $connect = Connection::getConn();

        $sql = "SELECT 
                comentarios.id, 
                comentarios.conteudo, 
                comentarios.data_criacao, 
                usuario.id AS usuario_id, 
                usuario.username, 
                usuario.nome, 
                usuario.foto_perfil
            FROM comentarios 
            INNER JOIN usuario ON comentarios.usuarioId = usuario.id 
            WHERE comentarios.postagemId = :id_post 
            ORDER BY comentarios.data_criacao ASC";

        $stmt = $connect->prepare($sql);
        $stmt->bindValue(":id_post", $postId);
        $stmt->execute();

        return $stmt->fetchAll(\PDO::FETCH_ASSOC);
    }

    public static function insertComents($postagemId, $usuarioId, $conteudo)
    {
        $connect = Connection::getConn();

        $sql = "INSERT INTO comentarios (conteudo, usuarioId, postagemId) 
            VALUES (:conteudo, :usuarioId, :postagemId)";

        $stmt = $connect->prepare($sql);
        $stmt->bindValue(":conteudo", $conteudo);
        $stmt->bindValue(":usuarioId", $usuarioId);
        $stmt->bindValue(":postagemId", $postagemId);

        $stmt->execute();
    }
}

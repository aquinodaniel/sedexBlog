<?php

namespace app\models;

use lib\database\Connection;
use Twig\Node\Expression\Binary\StartsWithBinary;

class Postagem
{

    public static function selectPosts()
    {

        $connect = Connection::getConn();

        $pagina = $_GET['pagina'] ?? 1;
        $limite = 20;
        $offset = ($pagina - 1) * $limite;

        $sql = "SELECT postagens.id, postagens.conteudo, postagens.data_criacao, usuario.username,
                usuario.nome, usuario.foto_perfil FROM postagens INNER JOIN usuario ON postagens.usuarioId = usuario.id
                ORDER BY postagens.id DESC LIMIT :limite OFFSET :offset;";
        $stmt = $connect->prepare($sql);
        $stmt->bindValue(':limite', $limite, \PDO::PARAM_INT);
        $stmt->bindValue(':offset', $offset, \PDO::PARAM_INT);
        $stmt->execute();

        $results = $stmt->fetchAll(\PDO::FETCH_ASSOC);


        return $results;
    }

    public static function selectPostId($postId)
    {
        $connect = Connection::getConn();

        $sql = "SELECT postagens.id, postagens.conteudo, usuario.username, usuario.nome, usuario.foto_perfil
                FROM postagens INNER JOIN usuario ON postagens.usuarioId = usuario.id WHERE postagens.id = :postId";
        $sql = $connect->prepare($sql);
        $sql->bindValue(":postId", $postId, \PDO::PARAM_INT);
        $sql->execute();

        $result = $sql->fetch(\PDO::FETCH_ASSOC);

        return $result;
    }

    public static function insertPost(string $conteudo, int $usuario_id)
    {
        $connect = Connection::getConn();

        $sql = "INSERT INTO postagens (conteudo, data_criacao, usuarioId) 
            VALUES (:conteudo, :data_criacao, :usuario_id)";
        $sql = $connect->prepare($sql);
        $sql->bindValue(":conteudo", $conteudo);
        $sql->bindValue(":data_criacao", date('Y-m-d H:i:s')); // adiciona data atual
        $sql->bindValue(":usuario_id", $usuario_id);
        $sql->execute();
    }
}

<?php

namespace app\models;

use lib\database\Connection;

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
}

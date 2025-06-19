<?php


namespace app\models;
use lib\database\Connection;


class Usuario
{

    public function insert(string $nome, string $username, string $email, $dataNascimento, string $senha)
    {
        $connect = Connection::getConn();

        try {
            $sql = "INSERT INTO usuario (nome, username, email, data_nascimento, senha)
            VALUES (:nome, :username, :email, :data_nascimento, :senha)";
            $sql = $connect->prepare($sql);
            $sql->bindValue(":nome", $nome);
            $sql->bindValue(":username", $username);
            $sql->bindValue(":email", $email);
            $sql->bindValue(":data_nascimento", $dataNascimento);
            $sql->bindValue(":senha", password_hash($senha, PASSWORD_DEFAULT));
            $sql->execute();

        } catch (\Exception $e) {
            echo $e->getMessage();
        }
    }
}

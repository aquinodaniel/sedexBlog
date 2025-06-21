<?php


namespace app\models;

use Exception;
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

    public function validarUsername($username): bool
    {
        $connect = Connection::getConn();

        $sql = "SELECT * FROM usuario WHERE username = :username";
        $stmt = $connect->prepare($sql);
        $stmt->bindValue(":username", $username);
        $stmt->execute();

        return $stmt->rowCount() > 0;
    }

    public function validarEmail($email): bool
    {
        $connect = Connection::getConn();

        $sql = "SELECT * FROM usuario WHERE email = :email";
        $stmt = $connect->prepare($sql);
        $stmt->bindValue(":email", $email);
        $stmt->execute();

        return $stmt->rowCount() > 0;
    }

    public static function validarAcesso($username, $email)
    {

        $connect = Connection::getConn();

        $sql = "SELECT * FROM usuario WHERE username = :username OR email = :email";
        $sql = $connect->prepare($sql);
        $sql->bindValue(':username', $username);
        $sql->bindValue(':email', $email);
        $sql->execute();

        return $sql->fetch(\PDO::FETCH_ASSOC);
    }

}

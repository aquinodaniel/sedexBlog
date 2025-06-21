<?php

namespace app\controllers;

use app\models\Usuario;
use app\helpers\passValidatte;
use Exception;

class UsuarioController
{

    public static function InserirDados(string $nome, string $username, string $email, $dataNascimento, string $senha, string $confirmarSenha)
    {
        $novoUsuario = new Usuario();
        $erros = [];

        if (!preg_match('/^[a-zA-Z0-9_]{5,15}$/', $username)) {
            $erros['username'] = "O username deve ter entre 5 e 15 caracteres, sem espaços e sem caracteres especiais.";
        }

        if ($novoUsuario->validarUsername($username)) {
            $erros['username'] = "Nome de usuário já está em uso.";
        }

        if ($novoUsuario->validarEmail($email)) {
            $erros['email'] = "Email já está em uso.";
        }

        if (!passValidatte::validarSenha($senha)) {
            $erros['senha'] = "Confira as condições da senha e tente novamente.";
        }

        if ($senha != $confirmarSenha) {
            $erros['confirmar_senha'] = "As senha não coincidem.";
        }

        if (!empty($erros)) {
            return $erros;
        }

        $novoUsuario->insert($nome, $username,  $email,  $dataNascimento,  $senha);
        return [];
    }
}

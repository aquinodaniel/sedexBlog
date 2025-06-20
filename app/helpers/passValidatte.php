<?php

namespace app\helpers;

class passValidatte
{

    public static function validarSenha(string $senha): bool
    {
        $padrao = "/^(?=.*[A-Z])(?=.*[\W_]).{8,}$/";
        return preg_match($padrao, $senha) === 1;
    }
    
}
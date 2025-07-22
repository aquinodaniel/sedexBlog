<?php

namespace app\controllers;

class CookieController
{

    public static function setCookie()
    {
        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }

        if (isset($_SESSION['id'])) {
            setcookie("usuario_logado", "sim", time() + (60 * 60 * 24 * 30), "/");
            $_COOKIE['usuario_logado'] = '1';
        }
    }
}

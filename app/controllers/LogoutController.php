<?php

namespace app\controllers;

class LogoutController
{

    public function logout()
    {
        session_start();
        session_destroy();
        header('Location: /login');
        exit;
    }
}


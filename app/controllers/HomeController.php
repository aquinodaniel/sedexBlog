<?php

namespace app\controllers;

class HomeController
{

    public function index()
    {

        session_start();

        if (!isset($_SESSION['id'])) {
            header('Location: /login');
            exit;
        }

        echo "Bem-vindo, " . $_SESSION['username'];

    }
}

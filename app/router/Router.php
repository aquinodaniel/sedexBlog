<?php

namespace app\router;
use app\helpers\Request;
use app\helpers\Uri;
use Exception;

class Router {

    public static function load(string $controller, string $action)
    {

        try{
            $controllerNameSpace = "app\\controllers\\$controller";

            if(!class_exists($controllerNameSpace)){
                throw new Exception("Erro: o controller não existe.");
            }

            $instanceController = new $controllerNameSpace();

            if(!method_exists($instanceController, $action)) {
                throw new Exception("Erro: o método não existe.");
            }

            $instanceController->$action();

        } catch (Exception $e)
        {
            echo $e->getMessage();
        }    

    }

    public static function routes()
    {
        return [
            "get" => [
                "/" => fn() => self::load("HomeController", "index"),
                "/intro" => fn() => self::load("IntroController", "index"),
                "/login" => fn() => self::load("LoginController", "index"),
                "/register" => fn() => self::load("RegisterController", "index"),
                "/logout" => fn() => self::load("LogoutController", "logout"),
                "/post" => fn() => self::load("PostController", "index"),
                "/perfil" => fn() => self::load("PerfilController", "index")
            ],
            "post" => [
                "/register" => fn() => self::load("RegisterController", "salvar"),
                "/login" => fn() => self::load("LoginController", "autenticar"),
                "/novo-post" => fn () => self::load("PostController", "insert"),
                "/insert-coment" => fn() => self::load("PostController", "insertComent")
            ]
        ];
    }

    public static function execute()
    {
        $route = self::routes();
        $uri = Uri::get('path');
        $request = Request::request();

        if(!isset($route[$request]))
        {
            throw new Exception("O método http {$request} não existe.");
        }

        if(!array_key_exists($uri, $route[$request])){
            throw new Exception("A URI {$uri} não existe.");
        }

        $controller = $route[$request][$uri]; //$route["post"]["/contact"] ===> fn() =>  self::load("ContactController", "index")
        $controller();                        // fn() =>  self::load("ContactController", "index")

    }

}
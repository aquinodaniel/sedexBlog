<?php

namespace app\router;
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
                "/" => self::load("HomeController", "index"),
                "intro" => self::load("IntroController", "index")
            ],
            "post" => [

            ]
        ];
    }

}
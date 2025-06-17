<?php

namespace app\helpers;

class Request
{

    public static function request()
    {
        return strtolower($_SERVER['REQUEST_METHOD']);
    }


}
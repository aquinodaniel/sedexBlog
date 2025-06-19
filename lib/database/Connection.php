<?php

namespace lib\database;

use \PDO;

abstract class Connection
{

    private static $conn;

    public static function getConn()
    {
        if (!self::$conn) {
            self::$conn = new PDO('mysql:host=localhost;dbname=sedexblog;', 'root', '', [
                PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION
            ]);
        }

        return self::$conn;
    }
}

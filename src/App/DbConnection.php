<?php
namespace App;


use PDO;

class DbConnection
{
    private static $connection = null;

    private function __construct()
    {
    }

    private static function createConnection()
    {
        $host = "pgsql_1";
        $dbname = "lotto";
        $username = getenv("POSTGRES_USER");
        $password = getenv("POSTGRES_PASSWORD");
        $dsn = "pgsql:host=$host;port=5432;dbname=$dbname;user=$username;password=$password";
        return new PDO($dsn);
    }

    public static function getConnection()
    {
        return (self::$connection === null) ? self::$connection = self::createConnection() : self::$connection;
    }


}


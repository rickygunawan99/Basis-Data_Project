<?php

namespace PHP\MVC\Config;

class Database
{
    private static ?\PDO $pdo = null;

    public static function beginTransaction()
    {
        self::$pdo->beginTransaction();
    }

    public static function commit()
    {
        self::$pdo->commit();
    }

    public static function rollback()
    {
        self::$pdo->rollBack();
    }

    public static function getConnection()
    {
        if(self::$pdo == null){
            require_once  __DIR__ . '/../../config/database.php';
            $config = getArrayDatabase();
            self::$pdo = new \PDO(
                $config['database']['prod']['url'],
                $config['database']['prod']['username'],
                $config['database']['prod']['password'],
            );
        }
        return self::$pdo;
    }

    public static function closeConnection()
    {
        self::$pdo = null;
    }
}
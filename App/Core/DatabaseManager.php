<?php
//db manager

//app config
declare(strict_types=1);

//
namespace App\Core;

//
class DatabaseManager {
    private static $pdo = null;

    public static function mysql() {
        //
        $dbConfig = array(
            "host" => 'localhost',
            "dbList" => 'test',
            "username" => 'root',
            "password" => ''
        );

        if (self::$pdo === null) {
            try {
                // Remove "App\Core\" from PDO
                self::$pdo = new \PDO(
                    "mysql:host=" . $dbConfig["host"] . ";dbname=" . $dbConfig["dbList"],
                    $dbConfig["username"],
                    $dbConfig["password"],
                    [\PDO::ATTR_ERRMODE => \PDO::ERRMODE_EXCEPTION]
                );
            } catch (\PDOException $e) {
                die("Connection failed: " . $e->getMessage());
            }
        }

        return self::$pdo;
    }

}

?>
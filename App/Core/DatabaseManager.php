<?php
// db manager

// app config
declare(strict_types=1);

// namespace
namespace App\Core;

// class
class DatabaseManager {
    private static $pdo = null;

    public static function mysql() {
        // Database config
        $dbConfig = array(
            "host"     => 'localhost',    
            "port"     => '3306',         
            "dbname"   => 'dreamers_v1',
            "username" => 'root',
            "password" => ''
        );

        // Connect only once (singleton)
        if (self::$pdo === null) {
            try {
                // Build DSN (Data Source Name)
                $dsn = "mysql:host={$dbConfig['host']};port={$dbConfig['port']};dbname={$dbConfig['dbname']};charset=utf8mb4";

                // Create PDO instance
                self::$pdo = new \PDO(
                    $dsn,
                    $dbConfig["username"],
                    $dbConfig["password"],
                    [
                        \PDO::ATTR_ERRMODE => \PDO::ERRMODE_EXCEPTION,
                        \PDO::ATTR_DEFAULT_FETCH_MODE => \PDO::FETCH_ASSOC,
                        \PDO::ATTR_EMULATE_PREPARES => false,
                    ]
                );
            } catch (\PDOException $e) {
                // Stop execution
                die("Database connection failed. Please try again later.");
            }
        }

        return self::$pdo;
    }
}

?>

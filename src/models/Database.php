<?php
class Database {
    private static ?PDO $instance = null;

    public static function connect(): PDO {
        if (self::$instance !== null) {
            return self::$instance;
        }
        $config = require __DIR__ . '/../config/database.php';
        $dsn = "mysql:host={$config['host']};dbname={$config['dbname']};charset=utf8mb4";
        try {
            self::$instance = new PDO($dsn, $config['user'], $config['password']);
            self::$instance->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        } catch (PDOException $e) {
            echo 'データベースにアクセスできません！' . $e->getMessage();
            exit;
        }
        return self::$instance;
    }
}

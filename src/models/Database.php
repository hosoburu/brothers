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
            self::$instance = new PDO($dsn, $config['user'], $config['password'], [
                PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES utf8mb4",
            ]);
            self::$instance->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        } catch (PDOException $e) {
            header('Content-Type: text/html; charset=utf-8');
            echo 'データベースにアクセスできません！' . $e->getMessage();
            exit;
        }
        return self::$instance;
    }
}

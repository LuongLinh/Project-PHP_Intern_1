<?php
session_start();
class Connection
{
    private static $instance = null, $conn = null;

    private function __construct($config)
    {
        try {
            $dsn = "mysql:host=" . $config["host"] . ";dbname=" . $config["dbname"];

            $options = [
                PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES utf8",
                PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION
            ];
            //cau lenh ket noi
            $pdo = new PDO($dsn, $config["user"], "", $options);
            self::$conn = $pdo;
        } catch (PDOException $exception) {
            $mess = $exception->getMessage();
            die($mess);
        }
    }

    public static function getInstance($config)
    {
        self::$instance = new Connection($config);
        self::$instance = self::$conn;
        return self::$instance;
    }
}

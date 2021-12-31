<?php
class Connection
{
    private static $instance = null, $conn = null;

    private function __construct()
    {
        try {
            $dsn = "mysql:host=" . $_ENV["HOST"] . ";dbname=" . $_ENV["DB_NAME"];

            $options = [
                PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES utf8",
                PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION
            ];
            //cau lenh ket noi
            $pdo = new PDO($dsn, $_ENV["USER"], "", $options);
            self::$conn = $pdo;
        } catch (PDOException $exception) {
            $mess = $exception->getMessage();
            die($mess);
        }
    }

    public static function getInstance()
    {
        self::$instance = new Connection();
        self::$instance = self::$conn;
        return self::$instance;
    }
}

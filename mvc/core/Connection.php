<?php
class Connection
{
    private static $instance = null, $conn = null;

    private function __construct()
    {
        try {
            $dsn = "mysql:host=" . config("database.host") . ";dbname=" . config("database.dbname");

            $options = [
                PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES utf8",
                PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION
            ];
            //cau lenh ket noi
            $pdo = new PDO($dsn, config("database.user"), "", $options);
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

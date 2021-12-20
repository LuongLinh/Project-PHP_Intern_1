<?php

class UserModel
{
    public $__conn;
    function __construct()
    {
        global $db_config;
        $this->__conn = Connection::getInstance($db_config);
    }

    public function addUser($userData)
    {
        $sql = "INSERT INTO `users` (`id`, `username`, `email`, `password`, `confirm-password`) VALUES (NULL, '" . $userData["username"] . "', '" . $userData["email"] . "', '" . $userData["password"] . "', '" . $userData["confirm-password"] . "');";
        $statement = $this->__conn->prepare($sql);
        $result = $statement->execute(["username" => $userData["username"], "email" => $userData["email"]]);
        return $result;
    }

    public function getListUser()
    {
        $sql = "SELECT `id`, `username`, `email` FROM `users`";
        $statement = $this->__conn->prepare($sql);
        $statement->setFetchMode(PDO::FETCH_ASSOC);

        $statement->execute();
        $result = $statement->fetchAll(PDO::FETCH_ASSOC);

        return $result;
    }

    function updateUser($updateData, $id)
    {
        $sql = "UPDATE `users` SET `username` = '". $updateData["username"] ."', `email` = '". $updateData["email"] ."' WHERE `users`.`id` = ". $id .";";
        $statement =  $this->__conn->prepare($sql);
        $result = $statement->execute();
        return $result;
    }

    function deleteUser($id)
    {
        $sql = "DELETE FROM `users` WHERE `users`.`id`=" . $id . ";";
        $statement = $this->__conn->prepare($sql);
        $result = $statement->execute();
        return $result;
    }

    public function getUserById($id)
    {
        $sql = "SELECT * FROM `users`WHERE id=" . $id . "";
        $statement = $this->__conn->prepare($sql);
        $statement->setFetchMode(PDO::FETCH_ASSOC);

        $statement->execute([$id]);

        $result = $statement->fetchAll(PDO::FETCH_ASSOC);
        return $result;
    }

    function getUserDetail() {
        
    }
}

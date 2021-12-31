<?php

class UserModel
{
    public $__conn;
    function __construct()
    {
        global $db_config;
        $this->__conn = Connection::getInstance($db_config);
    }

    function userLogin($userData)
    {
        $username = $userData["username"];
        $password = $userData["password"];
        $sql = "SELECT `id` FROM `users` WHERE `username` = '" . $username . "' AND `password` = '" . $password . "';";
        $statement = $this->__conn->prepare($sql);
        $statement->execute();

        $count = $statement->rowCount();
        $data = $statement->fetch(PDO::FETCH_OBJ);

        if ($count) {
            $_SESSION["id"] = $data->id;
            return true;
        }
        return false;
    }

    function isUserExist($userData)
    {
        $sql = "SELECT `id` FROM `users` WHERE `username` = '" . $userData["username"] . "' OR `email` = '" . $userData["email"] . "' ";
        $statement = $this->__conn->prepare($sql);
        $statement->execute();
        return $statement->rowCount() < 1;
    }

    function userRegistration($userData)
    {
        if ($this->isUserExist($userData)) {
            $sqlRegister = "INSERT INTO `users` (`id`, `username`, `email`, `password`) VALUES (NULL, '" . $userData["username"] . "', '" . $userData["email"] . "', '" . $userData["password"] . "');";
            $sttm = $this->__conn->prepare($sqlRegister);
            $sttm->execute(["username" => $userData["username"], "email" => $userData["email"]]);
            return true;
        }
        return false;
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
        $sql = "UPDATE `users` SET `username` = '" . $updateData["username"] . "', `email` = '" . $updateData["email"] . "' WHERE `users`.`id` = " . $id . ";";
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

    function isUser($id)
    {
        $sql = "SELECT `username` FROM `users` WHERE `id` = '" . $id . "';";
        $statement = $this->__conn->prepare($sql);
        $statement->execute();
        return $statement->rowCount() < 1;
    }

    public function getUserById($id)
    {
        $sql = "SELECT `id`, `username`, `email` FROM `users` WHERE `id`=" . $id . "";
        $statement = $this->__conn->prepare($sql);
        $statement->setFetchMode(PDO::FETCH_ASSOC);

        $statement->execute([$id]);

        $count = $statement->rowCount();

        $result = $statement->fetchAll(PDO::FETCH_ASSOC);
        return $result;
    }
}

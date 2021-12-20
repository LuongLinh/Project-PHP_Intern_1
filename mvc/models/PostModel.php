<?php

class PostModel
{
    public $__conn;
    function __construct()
    {
        global $db_config;
        $this->__conn = Connection::getInstance($db_config);
    }

    public function addPost($postData, $userId)
    {
        $sql = "INSERT INTO `posts` (`id`, `title`, `content`, `timestamp`, `user_author_id`) VALUES (NULL, '" . $postData["title"] . "', '" . $postData["content"] . "', NULL, '".$userId."');";
        $statement = $this->__conn->prepare($sql);
        $result = $statement->execute();
        return $result;
    }

    public function getListPost()
    {
        $sql = "SELECT * FROM `posts`";
        $statement = $this->__conn->prepare($sql);
        $statement->setFetchMode(PDO::FETCH_ASSOC);

        $statement->execute();
        $result = $statement->fetchAll(PDO::FETCH_ASSOC);
        return $result;
    }

    public function getPostById($id)
    {
        $sql = "SELECT `posts`.`id`, `title`, `content`, `message` FROM `posts` LEFT JOIN `comments` ON `posts`.`id` = `comments`.`post_id` WHERE `posts`.`id` = '".$id."';";
        $statement = $this->__conn->prepare($sql);
        $statement->setFetchMode(PDO::FETCH_ASSOC);
        $statement->execute([$id]);
        $result = $statement->fetchAll(PDO::FETCH_ASSOC);
        return $result;
    }

    function updatePost($dataUpdate, $id)
    {
        $dataUpdate["post-excerpt"] = substr($dataUpdate["content"], 0 , 30);
        $sql = "UPDATE `posts` SET `title`='" . $dataUpdate["title"] . "', `content`='" . $dataUpdate["content"] . "', `post-excerpt`='" . $dataUpdate["post-excerpt"] . "' WHERE `posts`.`id` = '". $id ."';";
        $statement =  $this->__conn->prepare($sql);

        $result = $statement->execute();
        return $result;
    }

    function deletePost($id)
    {
        $sql = "DELETE FROM `posts` WHERE `posts`.`id`=" . $id . ";";
        $statement = $this->__conn->prepare($sql);
        $result = $statement->execute();
        return $result;
    }

    function getPostofAuthor($authorId)
    {
        $sql = "SELECT `posts`.`id`, `username`, `email`, `title`, `content`, `timestamp` FROM `posts` LEFT JOIN  `users` ON `users`.`id` = `posts`.`user_author_id` 
        WHERE `posts`.`user_author_id` = " . $authorId . ";";
        $statement = $this->__conn->prepare($sql);
        $statement->execute();
        $result = $statement->fetchAll(PDO::FETCH_OBJ);

        return $result;
    }
}

<?php
class CommentModel
{

    function __construct()
    {
        global $db_config;
        $this->__conn = Connection::getInstance($db_config);
    }

    function addComment($commentData, $userId, $postId)
    {
        $sql = "INSERT INTO `comments` (`id`, `message`, `user_id`, `post_id`) VALUES (NULL, '" . $commentData["comment"] . "','" . $userId . "', '" . $postId . "');";
        $statement = $this->__conn->prepare($sql);
        $result = $statement->execute();
        return $result;
    }

    function getComment($postId)
    {
        $sql = "SELECT `username`, `message` FROM `comments` INNER JOIN `users` ON `comments`.`user_id`=`users`.`id`
        WHERE `comments`.`post_id` = '" . $postId . "';";
        $statement = $this->__conn->prepare($sql);
        $statement->setFetchMode(PDO::FETCH_ASSOC);
        $statement->execute([$postId]);
        $result = $statement->fetchAll(PDO::FETCH_ASSOC);
        return $result;
    }

    function getCommentById($id)
    {
    }

    function deleteComment($id)
    {
    }
}

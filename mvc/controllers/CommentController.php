<?php
class CommentController extends Controller
{
    function addComment($userId, $postId)
    {
        $request = new Request();
        $commentData = $request->getFields();

        $comments = $this->model("CommentModel");
        $comments->addComment($commentData, $userId, $postId);
        $this->render("success");
    }

    function getCommentUser() {
        $request = new Request();
        $commentData = $request->getFields();

        $comments = $this->model("CommentModel");
        $comments->getCommentUser();
        
    }
    function getComment($postId)
    {
        $comments = $this->model("CommentModel");
        $commentData = $comments->getComment($postId);
        return $this->render("postDetail", ["comment" => $commentData]);
    }

    function getListUser()
    {
        $users = $this->model("UserModel");
        $listUser = $users->getListUser();
        return $this->render("listUser", ["users" => $listUser]);
    }
}
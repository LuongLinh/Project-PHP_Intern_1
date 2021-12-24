<?php
class PostController extends Controller
{
    function addPost($userId)
    {
        if (isset($_SESSION["id"]) && !empty($_SESSION["id"])) {
            $user = $this->model("UserModel");
            $user->userLogin();

            $postData = $this->getFields();

            $posts = $this->model("PostModel");
            $posts->addPost($postData, $userId);

            return $this->getListPost();
        } else if (empty($_SESSION["id"])) {
            $this->data["msgLoginToPost"] = "You must log in before";
            return $this->render("login",$this->data);
        }
    }

    function getListPost()
    {
        $posts = $this->model("PostModel");
        $listPost = $posts->getListPost();
        return $this->render("listPost", ["listPost" => $listPost]);
    }

    function getPostById($id)
    {
        $posts = $this->model("PostModel");
        $postDetail =  $posts->getPostById($id);
        if (!empty($postDetail)) {
            return $this->render("postDetail", ["postDetail" => $postDetail]);
        } else {
           return $this->render("errors");
        }
    }

    function editPost($id)
    {
        $posts = $this->model("PostModel");
        $postDetail = $posts->getPostById($id);
        if (!empty($postDetail)) {
            return $this->render("updatePost", ["postDetail" => $postDetail]);
        } else {
            return $this->render("errors");
        }
    }

    function updatePost($id)
    {
        $updateData = $this->getFields();
        $posts = $this->model("PostModel");
        $postDetail = $posts->updatePost($updateData, $id);
        $this->getPostById($id);
    }

    function deletePost($id)
    {
        $posts = $this->model("PostModel");
        $posts->deletePost($id);
        $listPost = $posts->getListPost();
        return $this->render("listPost", ["listPost" => $listPost]);
    }
}

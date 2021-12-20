<?php
class PostController extends Controller
{
    function addPost($userId)
    {
        $request = new Request();
        $postData = $request->getFields();

        $posts = $this->model("PostModel");
        $posts->addPost($postData, $userId);

        return $this->getListPost();
    }

    function getListPost()
    {
        $posts = $this->model("PostModel");
        $listPost = $posts->getListPost();
        return $this->render("/listPost", ["listPost" => $listPost]);
    }

    function getPostById($id)
    {
        $posts = $this->model("PostModel");
        $postDetail =  $posts->getPostById($id);
        return $this->render("/postDetail", ["postDetail" => $postDetail]);
    }

    function editPost($id) {
        $posts = $this->model("PostModel");
        $postDetail =  $posts->getPostById($id);
        return $this->render("/updatePost", ["postDetail" => $postDetail]);
    }
    function updatePost($id)
    {
        $request = new Request();
        $updateData = $request->getFields();
        $posts = $this->model("PostModel");
        $postDetail = $posts->updatePost($updateData, $id);

        $this->getPostById($id);
    }


    function deletePost($id)
    {
        $posts = $this->model("PostModel");
        $posts->deletePost($id);
        $listPost = $posts->getListPost();
        return $this->render("/listPost", ["listPost" => $listPost]);
    }

    function getAuthor()
    {
        $posts = $this->model("PostModel");
        return $listPost = $posts->getAuthor();
    }

}

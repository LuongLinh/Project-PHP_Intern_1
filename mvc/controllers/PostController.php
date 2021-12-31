<?php
class PostController extends Controller
{
    function addPost($userId)
    {
        $postData = $this->getFields();

        if (isset($postData) && !empty($postData)) {
            $posts = $this->model("PostModel");
            $posts->addPost($postData, $userId);

            $this->apiSuccessResponse(["data" => $postData, "id" => $userId]);
        } else {
            $this->apiErrorResponse("Please fill in the title and content!", 422);
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
        $postDetail = $posts->getPostById($id);
        return $this->render("postDetail", ["postDetail" => $postDetail]);
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
        redirect("list-post");
    }
}

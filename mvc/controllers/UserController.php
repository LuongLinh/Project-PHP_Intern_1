<?php
class UserController extends Controller
{

    function getListUser()
    {
        $users = $this->model("UserModel");
        $listUser = $users->getListUser();
        return $this->render("listUser", ["users" => $listUser]);
    }

    function getUserById($userId)
    {
        $users = $this->model("UserModel");
        $userDetail = $users->getUserById($userId);

        $posts = $this->model("PostModel");
        $listPostOfAuthor = $posts->getPostofAuthor($userId);
        $arrayPostOfAuthor = json_decode(json_encode($listPostOfAuthor), true);


        return $this->render("userDetail", ["users" => $userDetail, "postOfAuthor" => $arrayPostOfAuthor]);
    }

    function deleteUser($id)
    {
        $users = $this->model("UserModel");
        $users->deleteUser($id);
        $listUser = $users->getListUser();
        return $this->render("listUser", ["users" => $listUser]);
    }

    function updateUser($id)
    {
        $request = new Request();
        $updateData = $request->getFields();
        $users = $this->model("UserModel");
        $users->updateUser($updateData, $id);

        $listUser = $users->getListUser();
        return $this->render("listUser", ["users" => $listUser]);
    }
}

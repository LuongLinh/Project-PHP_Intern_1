<?php
require_once "../mvc/core/Request.php";
class UserController extends Controller
{
    //login
    public function login()
    {
        $this->render("login");
    }

    public function postLogin()
    {
        $loginRequest = new LoginRequest();
        $validateLogin = $loginRequest->validateLogin();

        if (!$validateLogin) {
            $this->data["errors"] = $loginRequest->errors();
            $this->data["msg"] = "Login fail! Please check again!";
        }

        if (!empty($this->data["errors"])) {
            return $this->render("login", $this->data);
        } else {
            $users = $this->model("UserModel");
            if ($users->userLogin($loginRequest->getFields())) {
                $_SESSION["logined"] = true;
                $this->apiSuccessResponse($loginRequest->getFields());
            } else {
                $this->apiErrorResponse("Login fail! Please login again!", 422);
            }
        }
    }

    //register
    public function register()
    {
        $this->render("register");
    }

    public function postRegister()
    {
        $registerRequest = new RegisterRequest();
        $validateRegistration = $registerRequest->validateRegister();

        if (!$validateRegistration) {
            $this->data["errors"] = $registerRequest->errors();
            $this->data["msg"] = "Something wrong! Please check again!";
        }

        if (!empty($this->data["errors"])) {
            return $this->render("register", $this->data);
        } else {
            $users = $this->model("UserModel");
            $register = $users->userRegistration($registerRequest->getFields());
            if ($register) {
                $this->apiSuccessResponse($registerRequest->getFields());
            } else {
                $this->apiErrorResponse("Something wrong! Please check again!", 422);
            }
        }
    }

    function getListUser()
    {
        $users = $this->model("UserModel");
        $listUser = $users->getListUser();
        return $this->render("listUser", ["users" => $listUser]);
    }

    function getUserById($userId)
    {
        if (!empty($_SESSION["id"]) && $userId == $_SESSION["id"]) {
            $users = $this->model("UserModel");
            if (!$users->isUser($userId)) {
                $userDetail = $users->getUserById($userId);
                if (!empty($userDetail)) {
                    $posts = $this->model("PostModel");
                    $listPostOfAuthor = $posts->getPostofAuthor($userId);
                    $arrayPostOfAuthor = json_decode(json_encode($listPostOfAuthor), true);
                }

                return $this->render("userDetail", ["users" => $userDetail, "postOfAuthor" => $arrayPostOfAuthor]);

            } else return $this->render("errors");
        } else {
            return $this->render("errors");
        }
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
        $updateData = $this->getFields();
        $users = $this->model("UserModel");
        $users->updateUser($updateData, $id);

        $listUser = $users->getListUser();
        return $this->render("listUser", ["users" => $listUser]);
    }
}

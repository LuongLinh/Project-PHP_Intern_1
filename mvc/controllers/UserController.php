<?php
require_once "../mvc/core/Request.php";
class UserController extends Controller
{
    //login
    public function login()
    {
        $this->render("login");
    }

    public function varSS()
    {
        var_dump($_SESSION);
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
            $_SESSION["message"] = $this->data["errors"];
            redirect("login");
        } else {
            $users = $this->model("UserModel");
            $loginData = $loginRequest->getFields();
            if ($users->userLogin($loginData)) {
                $_SESSION["username"] = $loginData["username"];
                $_SESSION["isLoggedIn"] = true;
                $url = "user-detail/".$_SESSION["id"]."" ;
                redirect($url);
            } else {
                $loginFail = "Login fail! Please login again!";
                return $this->render("login", ["loginFail" => $loginFail]);
            }
        }
    }

    //logout
    public function logout()
    {
        session_destroy();
        redirect("login");
        die;
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
            $_SESSION["message"] = $this->data["errors"];
            redirect("register");
        } else {
            $users = $this->model("UserModel");
            $register = $users->userRegistration($registerRequest->getFields());
            if ($register) {
               redirect("login");
            } else {
                $fail = "Registration fail! Please try again!";
                return $this->render("register", ["fail" => $fail]);
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

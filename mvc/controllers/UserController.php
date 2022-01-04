<?php

use Symfony\Component\VarDumper\VarDumper;

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
            $_SESSION["message"] = $this->data["errors"];
            redirect("login");
        } else {
            $users = $this->model("UserModel");
            $loginData = $loginRequest->getFields();
            if ($users->userLogin($loginData)) {
                $_SESSION["username"] = $loginData["username"];
                $_SESSION["isLoggedIn"] = true;
                $url = "user-detail/" . $_SESSION["id"] . "";
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

    public function getUserId($userId)
    {
        $users = $this->model("UserModel");
        $getUser = $users->getUserById($userId);
        return $this->render("updateUser", ["users" => $getUser]);
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
        
        $target_dir = "../assets/images/";
        $target_file = $target_dir . basename($_FILES["fileToUpload"]["name"]);

        $users->updateUser($updateData, $id);
        $this->checkImage($id);
        return $this->apiSuccessResponse(["image_url" => $target_file, "user" => $users]);
    }

    public function checkImage($id)
    {
        $target_dir = "../assets/images/";
        $target_file = $target_dir . basename($_FILES["fileToUpload"]["name"]);
        $uploadOk = 1;
        $imageFileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));

        $check = getimagesize($_FILES["fileToUpload"]["tmp_name"]);
        if ($check !== false) {
            $uploadOk = 1;
        } else {
            $uploadOk = 0;
        }

        if (file_exists($target_file)) {
            $uploadOk = 0;
        }

        if ($_FILES["fileToUpload"]["size"] > 5000000) {
            $uploadOk = 0;
        }

        if (
            $imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg"
            && $imageFileType != "gif"
        ) {
            $uploadOk = 0;
        }

        if ($uploadOk == 0) {
            $msg = "Sorry, your file was not uploaded.";
            return $this->apiErrorResponse($msg);
        } else {
            if (move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], 'uploads/' . $target_file)) {
                $users = $this->model("UserModel");
                return $users->uploadImage($target_file, $id);
            } else {
                $msg = "Sorry, there was an error uploading your file.";
                return $this->apiErrorResponse($msg);
            }
        }
    }
}

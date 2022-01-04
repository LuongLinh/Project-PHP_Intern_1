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
        $checkImage = $this->checkImage($id);

        if ($checkImage["status"]) {
            $users = $this->model("UserModel");
            $users->updateUser($updateData, $id);
            $this->apiSuccessResponse(["image_url" => $checkImage["image_url"]]);
        } else {            
            $this->apiErrorResponse($checkImage["msg"]);
        }
    }

    public function checkImage($id)
    {
        $result = ["status" => true];
        
        $target_dir = "../assets/images/";
        if (!file_exists($target_dir)) {
            mkdir("../assets/images/", 0777, true);
        }

        $target_file = $target_dir . basename($_FILES["fileToUpload"]["name"]);
        $imageFileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));

        if (empty($_FILES["fileToUpload"]["tmp_name"])
            || getimagesize($_FILES["fileToUpload"]["tmp_name"]) == false
        ) {
            $result = [
                "status" => false,
                "msg" => "File is not an image"
            ];
        }

        if (!in_array($imageFileType, config("imageFileTypeAllow.imageTypeAllow"))) {
            $result = [
                "status" => false,
                "msg" => "Only JPG, JPEG, PNG & GIF files are allowed."
            ];
        }

        if ($_FILES["fileToUpload"]["size"] > 5000000) {
            $result = [
                "status" => false,
                "msg" => "Your file too large"
            ];
        }

        if ($result["status"]) {
            if (move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], $target_file)) {
                $users = $this->model("UserModel");
                $users->uploadImage($target_file, $id);
                $result = [
                    "status" => true,
                    "image_url" => $target_file
                ];
            } else {
                $result["msg"] = "your file can not upload";
            }
        }

        return $result;
    }
}

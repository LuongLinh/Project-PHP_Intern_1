<?php
class Login extends Controller
{

    public function login()
    {
        $request = new Request();
        $data = $request->getFields();
        $this->render("login");
    }

    public function post_login()
    {
        $request = new Request();
        $userData = $request->getFields();
        $request->rules([
            "username" => "required|min:3|max:30",
            "password" => "required|min:6",
        ]);

        $request->message([
            "username.required" => "Username can't be blank",
            "username.min" => "Username must be at least 3 characters long",
            "username.max" => "username must be less than 30 characters",

            "password.required" => "Password cant be blank",
            "password.min" => "Password must be at least than 6 characters",
        ]);
        $validate = $request->validate();

        if (!$validate) {
            $this->data['errors'] = $request->errors();
            $this->data["msg"] = "Login fail! Please check again!";
        }

        if (!empty($this->data["errors"])) {
            $this->render("login", $this->data);
        } else {
            echo "success";
            $users = $this->model("UserModel");
            $addUser = $users->addUser($userData);
        }
    }

    function getListUser()
    {
        $listUser = $this->model("UserModel");
        echo $listUser->getListUser();
    }

    function getUserById($id)
    {

        $user = $this->model("UserModel");
        return $user->getUserById($id);
    }
}

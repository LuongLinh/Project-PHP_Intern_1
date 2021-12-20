<?php
class Register extends Controller
{
    public function register()
    {
        $request = new Request();
        $data = $request->getFields();
        $this->render("register");
    }

    public function post_register()
    {
        $request = new Request();
        $userData = $request->getFields();
        $request->rules([
            "username" => "required|min:3|max:30",
            "email" => "required|email|min:5",
            "password" => "required|min:6",
            "confirm-password" => "required|min:6|match:password"
        ]);

        $request->message([
            "username.required" => "Username can't be blank",
            "username.min" => "Username must be at least 3 characters long",
            "username.max" => "username must be less than 30 characters",
            "email.required" => "Email can't be blank",
            "email.email" => "Invalid Email",
            "email.min" => "Email must be at least 5 characters long",
            "password.required" => "Password cant be blank",
            "password.min" => "Password must be at least than 6 characters",
            "confirm-password.required" => "Confirm password cant be blank",
            "confirm-password.min" => "Password must be at least than 5 characters",
            "confirm-password.match" => "Confirm Password should match with the Password"
        ]);
        $validate = $request->validate();

        if (!$validate) {
            $this->data['errors'] = $request->errors();
            $this->data["msg"] = "Something wrong! Please check again!";
        }

        if (!empty($this->data["errors"])) {
            return $this->render("register", $this->data);
        } else {
            // echo "success!";
            $users = $this->model("UserModel");
            return $users->addUser($userData);
        }
    }
}

<?php
class Home
{
    public $data;
    public function render($view, $data = [])
    {
        if(!empty($data)) {
            extract($data);
        }
        if (file_exists("../mvc/views/" . $view . ".php")) {
            require_once "../mvc/views/" . $view . ".php";
        }
    }
    public function login()
    {
        $request = new Request();
        $data = $request->getFields();
        $this->render("login");
    }

    public function register()
    {
        $request = new Request();
        $data = $request->getFields();
        $this->render("register");
    }
    
    public function post_register()
    {
        $request = new Request();

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
        }
        $this->render("register", $this->data);
    }

    public function post_login()
    {
        $request = new Request();

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
        }
        $this->render("login", $this->data);
    }
}

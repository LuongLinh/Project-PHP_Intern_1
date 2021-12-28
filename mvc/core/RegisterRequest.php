<?php
class RegisterRequest extends Request
{

    function validateRegister()
    {
        $this->rules([
            "username" => "required|min:3|max:30",
            "email" => "required|email|min:5",
            "password" => "required|min:6",
            "conPassword" => "required|min:6|match:password"
        ]);

        $this->message([
            "username.required" => "Username can't be blank",
            "username.min" => "Username must be at least 3 characters long",
            "username.max" => "username must be less than 30 characters",
            "email.required" => "Email can't be blank",
            "email.email" => "Invalid Email",
            "email.min" => "Email must be at least 5 characters long",
            "password.required" => "Password cant be blank",
            "password.min" => "Password must be at least than 6 characters",
            "conPassword.required" => "Confirm password cant be blank",
            "conPassword.min" => "Password must be at least than 5 characters",
            "conPassword.match" => "Confirm Password should match with the Password"
        ]);
        return $this->validate();
    }
}

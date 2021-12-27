<?php
class LoginRequest extends Request
{

    function validateLogin()
    {
        $this->rules([
            "username" => "required|min:3|max:30",
            "password" => "required|min:6"
        ]);
        $this->message([
            "username.required" => "Username can't be blank",
            "username.min" => "Username must be at least 3 characters long",
            "username.max" => "username must be less than 30 characters",

            "password.required" => "Password can't be blank",
            "password.min" => "Password must be at least than 6 characters",
        ]);

        return $this->validate();
    }
}

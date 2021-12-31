<?php

class CheckLogin extends Controller implements MiddlewareInterface
{
    public function handle()
    {
        if (!isset($_SESSION["isLoggedIn"])) {
            redirect("login");
            exit();
        }
    } 
}
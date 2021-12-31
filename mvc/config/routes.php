<?php
$routes["default_controller"] = "userController";
$routes["register"] = "usercontroller/register";
$routes["post-register"] = "usercontroller/postRegister";
$routes["login"] = "usercontroller/login";

$routes["post-login"] = "usercontroller/postLogin";

$routes["list-user"] = "usercontroller/getListUser";

$routes["delete-user/(.+)"] = "usercontroller/deleteUser/$1";
$routes["update-user/(.+)"] = "usercontroller/updateUser/$1";
$routes["logout"] = "usercontroller/logout";

$routes["user-detail/(.+)"] = [
    "action" => "usercontroller/getUserById/$1",
    "middlewares" => "checklogin"
];

//post
$routes["add-post/(.+)"] = [
    "action" => "postcontroller/addPost/$1",
    "middlewares" => [
        "checklogin",
        "checkUser"
    ]
];

$routes["post-detail/(.+)"] = "postcontroller/getPostById/$1";
$routes["edit-post/(.+)"] = [
    "action" => "postcontroller/editPost/$1",
    "middlewares" => "checklogin"
];
$routes["update-post/(.+)"] = [
    "action" => "postcontroller/editPost/$1",
    "middlewares" => "checklogin"
];

$routes["post-user/(.+)"] = [
    "action" => "postcontroller/getPostofAuthor/$1",
    "middlewares" => "checklogin"
];
$routes["list-post"] = "postcontroller/getListPost";
$routes["delete-post/(.+)"] = [
    "action" => "postcontroller/deletePost/$1",
    "middlewares" => "checklogin"
];
//comment
$routes["add-comment"] =  [
    "action" => "commentcontroller/addComment",
    "middlewares" => "checklogin"
];
$routes["get-comment/(.+)"] = "commentcontroller/getComment/$1";

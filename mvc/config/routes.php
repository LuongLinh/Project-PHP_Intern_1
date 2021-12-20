<?php
$routes["default_controller"] = "register";
$routes["register"] = "register/register";
$routes["post-register"] = "register/post_register";
$routes["login"] = "login/login";
$routes["post-login"] = "login/post_login";
//user
$routes["list-user"] = "usercontroller/getListUser";
$routes["delete-user/(.+)"] = "usercontroller/deleteUser/$1";
$routes["update-user/(.+)"] = "usercontroller/updateUser/$1";
//test route
$routes["news/.+?-(\d+).html"] = "news/testRoute/$1";
$routes["user-detail/(.+)"] = "usercontroller/getUserById/$1";

//post
$routes["add-post/(.+)"] = "postcontroller/addPost/$1";
$routes["post-detail/(.+)"] = "postcontroller/getPostById/$1";
$routes["edit-post/(.+)"] = "postcontroller/editPost/$1";
$routes["update-post/(.+)"] = "postcontroller/updatePost/$1";

$routes["post-user/(.+)"] = "postcontroller/getPostofAuthor/$1";
$routes["list-post"] = "postcontroller/getListPost";
$routes["delete-post/(.+)"] = "postcontroller/deletePost/$1";
//comment
$routes["add-comment"] = "commentcontroller/addComment";
$routes["get-comment/(.+)"] = "commentcontroller/getComment/$1";
 


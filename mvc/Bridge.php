<?php
session_set_cookie_params(3600,"/");
session_start();

if(!empty($_SERVER['HTTPS']) && $_SERVER['HTTPS'] == 'on') {
    $web_root = 'https://'.$_SERVER['HTTP_HOST'];
} else {
    $web_root = 'http://'.$_SERVER['HTTP_HOST'];
}
define('_WEB_ROOT', $web_root);

$config_dir = scandir("../mvc/config");

if (!empty($config_dir)) {
    foreach ($config_dir as $itemConfig) {
        if ($itemConfig != '.' && $itemConfig != '..' && file_exists("../mvc/config/" . $itemConfig)) {
            require_once "../mvc/config/" . $itemConfig;
        }
    }
}
require_once "../mvc/core/Route.php";
require_once "../mvc/middlewares/MiddlewareInterface.php";
require_once "../mvc/core/App.php";

require_once "../mvc/core/Connection.php";

require_once "../mvc/core/Request.php";
require_once "../mvc/core/LoginRequest.php";
require_once "../mvc/core/RegisterRequest.php";

require_once "../mvc/core/Controller.php";
require_once "../mvc/controllers/UserController.php";


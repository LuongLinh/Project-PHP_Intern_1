<?php

$config_dir = scandir("../mvc/config");

if (!empty($config_dir)) {
    foreach ($config_dir as $itemConfig) {
        if ($itemConfig != '.' && $itemConfig != '..' && file_exists("../mvc/config/" . $itemConfig)) {
            require_once "../mvc/config/" . $itemConfig;
        }
    }
}
require_once "../mvc/core/Route.php";
require_once "../mvc/core/App.php";

if (!empty($config["database"])) {
    $db_config = array_filter($config["database"]);

    if (!empty($db_config)) {
        require_once "../mvc/core/Connection.php";
    }
}
require_once "../mvc/core/Request.php";
require_once "../mvc/core/LoginRequest.php";
require_once "../mvc/core/RegisterRequest.php";

require_once "../mvc/core/Controller.php";

<?php
class App
{
    private $_controller;
    private $_action;
    private $_params;
    private $_routes;

    function __construct()
    {
        
        global $routes, $config;

        $this->_routes = new Route();

        if (!empty($routes["default_controller"])) {
            $this->_controller = $routes["default_controller"];
        }
        $this->_action = "register";
        $this->_params = [];

        $this->handleUrl();
    }

    function getUrl()
    {
        if (!empty($_SERVER["REQUEST_URI"])) {
            $url = $_SERVER["REQUEST_URI"];
        } else {
            $url = "/";
        }
        return $url;
    }

    public function handleUrl()
    {
        $url = $this->getUrl();
        //router
        $url = $this->_routes->handleRoute($url);
        $urlArr = array_filter(explode("/", $url));
        $urlArr = array_values($urlArr);

        $urlCheck = "";

        if (!empty($urlArr)) {
            foreach ($urlArr as $key => $value) {
                $urlCheck .= $value . "/";

                $fileCheck = rtrim($urlCheck, "/");

                $fileArr = explode("/", $fileCheck);
                $fileArr[count($fileArr) - 1] = ucfirst($fileArr[count($fileArr) - 1]);
                $fileCheck = implode("/", $fileArr);

                if (!empty($urlArr[$key - 1])) {
                    unset($urlArr[$key - 1]);
                }

                if (file_exists("../mvc/controllers/" . $fileCheck . ".php")) {
                    $urlCheck = $fileCheck;
                    break;
                }
            }
            $urlArr = array_values($urlArr);
        }

        //xử lý controller
        if (!empty($urlArr[0])) {
            $this->_controller = ucfirst($urlArr[0]);
        } else {
            $this->_controller = ucfirst($this->_controller);
        }
        //xử lý khi $urlCheck rỗng
        if(empty($urlCheck)) {
            $urlCheck = $this->_controller;
        }
        // echo $urlCheck;
        if (file_exists("../mvc/controllers/" . $urlCheck . ".php")) {
            require_once "../mvc/controllers/" . $urlCheck . ".php";

            if (class_exists($this->_controller)) {
                $this->_controller = new $this->_controller();
                unset($urlArr[0]);
            } else {
                $this->errorMessage();
            }
        } else {
            $this->errorMessage();
        }

        //xử lý action
        if (!empty($urlArr[1])) {
            $this->_action = $urlArr[1];
            unset($urlArr[1]);
        }

        //xử lý params
        $this->_params = array_values($urlArr);
        if (method_exists($this->_controller, $this->_action)) {
            call_user_func_array([$this->_controller, $this->_action], $this->_params);
        }
    }
    public function errorMessage()
    {
        echo "Page is not found";
    }
}

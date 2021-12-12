<?php
class App
{
    private $_controller;
    private $_action;
    private $_params;
    private $_routes;

    function __construct()
    {
        global $routes;
        if(!empty($routes['default_controller'])){
            $this->_controller = $routes['default_controller'];
        }

        $this->_action = "register";
        $this->_params = [];

        $this->handleUrl();
    }

    function getUrl()
    {
        if (!empty($_SERVER["PATH_INFO"])) {
            $url = $_SERVER['PATH_INFO'];
        } else {
            $url = '/';
        }
        return $url;
    }

    public function handleUrl()
    {
        $url = $this->getUrl();
        $urlArr = array_filter(explode('/', $url));
        $urlArr = array_values($urlArr);
        if (!empty($urlArr[0])) {
            $this->_controller = ucfirst($urlArr[0]);
        } else {
            $this->_controller = ucfirst($this->_controller);
        } 

        if (file_exists("../mvc/controllers/" . ($this->_controller) . ".php")) {
            require_once "../mvc/controllers/" . ($this->_controller) . ".php";
            
            if(class_exists($this->_controller)){
                $this->_controller = new $this->_controller();
                unset($urlArr[0]);
            } else {
                $this->errorMessage();
            }
        } else {
            $this->errorMessage();
        }

        if (!empty($urlArr[1])) {
            $this->_action = $urlArr[1];
        }

        $this->_params = array_values($urlArr);
        if(method_exists($this->_controller, $this->_action)) {
          call_user_func_array([$this->_controller, $this->_action], $this->_params);
        }
    }
    public function errorMessage() {
        echo "Page is not found";
    }
}

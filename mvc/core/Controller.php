<?php 
class Controller {
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
}
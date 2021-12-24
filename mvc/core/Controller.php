<?php
class Controller extends Request
{
    public $data;
    public function render($view, $data = [])
    {
        if (!empty($data)) {
            extract($data);
        }
        if (file_exists("../mvc/views/" . $view . ".php")) {
            require_once "../mvc/views/" . $view . ".php";
        }
    }

    public function model($model)
    {
        if (file_exists("../mvc/models/" . $model . ".php")) {
            require_once "../mvc/models/" . $model . ".php";
            if (class_exists($model)) {
                $model = new $model();
                return $model;
            }
        }
        return false;
    }

    // public function getFields()
    // {
    //     return $this->getFields();
    // }
    // public function getRule() {
    //     return $this->rules();
    // }
    // public function getMessage() {
    //     return $this->getMessage();
    // }
}

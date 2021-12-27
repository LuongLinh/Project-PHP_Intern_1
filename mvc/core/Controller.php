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

    public function apiSuccessResponse($data)
    {
        header('Content-Type: application/json; charset=utf-8', true, 200);
        
        if (isset($data)) {
            echo json_encode($data);
        } else {
            echo json_encode(["message" => "success"]);
        }

        die;
    } 

    public function apiErrorResponse($errorMessages = "Server error", $statusCode = 500)
    {
        header('Content-Type: application/json; charset=utf-8', true, $statusCode);

        echo json_encode([
            "errors" => $errorMessages
        ]);

        die;
    }
}

<?php
class Request
{
    private $_rules = [], $_message = [];
    public $_errors = [];

    public function getMethod()
    {
        return $_SERVER["REQUEST_METHOD"];
    }

    public function isPost()
    {
        if ($this->getMethod() == "POST") {
            return true;
        }
        return false;
    }

    public function isGet()
    {
        if ($this->getMethod() == "GET") {
            return true;
        }
        return false;
    }

    public function getFields()
    {
        $dataFeilds = [];
        if ($this->isGet()) {
            if (!empty($_GET)) {
                foreach ($_GET as $key => $value) {
                    if (is_array($value)) {
                        $dataFeilds[$key] = filter_input(INPUT_GET, $key, FILTER_SANITIZE_SPECIAL_CHARS, FILTER_REQUIRE_ARRAY);
                    } else {
                        $dataFeilds[$key] = filter_input(INPUT_GET, $key, FILTER_SANITIZE_SPECIAL_CHARS);
                    }
                }
            }
        }

        if ($this->isPost()) {
            if (!empty($_POST)) {
                foreach ($_POST as $key => $value) {
                    if (is_array($value)) {
                        $dataFeilds[$key] = filter_input(INPUT_POST, $key, FILTER_SANITIZE_SPECIAL_CHARS, FILTER_REQUIRE_ARRAY);
                    } else {
                        $dataFeilds[$key] = filter_input(INPUT_POST, $key, FILTER_SANITIZE_SPECIAL_CHARS);
                    }
                }
            }
        }

        return $dataFeilds;
    }
    public function rules($rules = [])
    {
        $this->_rules = $rules;
    }
    public function message($message)
    {
        $this->_message = $message;
    }

    public function validate()
    {
        $this->_rules = array_filter($this->_rules);
       
        $checkValidate = true;

        if (!empty($this->_rules)) {

            $dataFeilds = $this->getFields();

            foreach ($this->_rules as $feildName => $rulesItem) {
                $rulesItemArr = explode('|', $rulesItem);
                $rulesName = null;
                $rulesValue = null;
               
                foreach ($rulesItemArr as $rules) {
                    $rulesArr = explode(":", $rules);


                    $rulesName = reset($rulesArr);
                    if (count($rulesArr) > 1) {
                        $rulesValue = end($rulesArr);
                    }

                    if ($rulesName == 'required') {
                        if (empty($dataFeilds[$feildName])) {
                            $this->setErors($feildName, $rulesName);
                            $checkValidate = false;
                        }
                    }

                    if ($rulesName == 'min') {
                        if (strlen($dataFeilds[$feildName]) < $rulesValue) {
                            $this->setErors($feildName, $rulesName);
                            $checkValidate = false;
                        } 
                    }

                    if ($rulesName == 'max') {
                        if (strlen($dataFeilds[$feildName]) > $rulesValue) {
                            $this->setErors($feildName, $rulesName);
                            $checkValidate = false;
                        }
                    }

                    if ($rulesName == 'email') {
                        if (!filter_var($dataFeilds[$feildName], FILTER_VALIDATE_EMAIL)) {
                            $this->setErors($feildName, $rulesName);
                            $checkValidate = false;
                        }
                    }

                    if ($rulesName == 'match') {
                        if (trim($dataFeilds[$feildName]) != trim($dataFeilds[$rulesValue])) {
                            $this->setErors($feildName, $rulesName);
                            $checkValidate = false;
                        }
                    }
                }
            }
        }
        return $checkValidate;
    }

    
    public function errors($feildName = "")
    {
        if (!empty($this->_errors)) {
            if (empty($feildName)) {
                $errorsArr = [];
                foreach($this->_errors as $errorKey=>$errorValues) {
                    $errorsArr[$errorKey] = reset($errorValues);
                }
                return $errorsArr;
            }
            return reset($this->_errors[$feildName]);
        } 
        return false;
    }

    public function setErors($feildName, $rulesName)
    {
        $this->_errors[$feildName][$rulesName] = $this->_message[$feildName . "." . $rulesName];
    }
}

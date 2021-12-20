<?php

class Database
{

    public $__conn;
    function __construct()
    {
        global $db_config;
        $this->__conn = Connection::getInstance($db_config);
    }


    function insert($table, $data) {
        if(!empty($data)) {
            $fieldStr = "";
            $valueStr = "";
            foreach($data as $key=>$value) {
                $fieldStr.=$key.",";
                $valueStr.="'".$value."',";
            }

            $fieldStr = rtrim($fieldStr, ",");
            $valueStr = rtrim($valueStr, ",");

            $sql = "INSERT INTO $table($fieldStr) VALUES ($valueStr)";

            // var_dump($this->__conn);
            // $status = $this->query($sql);
            $statement = $this->__conn->prepare($sql);
            $statement->execute();
            if($statement) {
                return true;
            }
            return false;
        }
    }

    // function userQuery($sql) {
    //     $statement = $this->__conn->prepare($sql);
    //     $statement->execute();
    //     return $statement;
    // }

}

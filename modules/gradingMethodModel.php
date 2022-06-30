<?php

    require_once 'DB.php';
    class GradingMethod     //Can be implemented through Lookup table also -- both works
    {
        public $id;
        public $name;
        public $marks;
        public $mydb;

        public function __construct()
        {
            $this->mydb = DB::getInstance();
        }

        public function getFromDB($condition = '')
        {
            $gradingMethods = array();
            $query = "SELECT * FROM grading_method $condition";
            $queryResult = mysqli_query($this->mydb, $query);
            if($queryResult)
            {
                while($row = mysqli_fetch_assoc($queryResult))
                {
                    $gradingMethods[] = $row;
                }
                return $gradingMethods;
            }
            else 
                return false;
        }
    }
?>
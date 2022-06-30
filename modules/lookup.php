<?php
    require_once 'DB.php';
    class LookUp
    {
        public $id;
        public $name;
        public $mydb;
        public $resultArr = array();

        public function __construct()
        {
            $this->mydb = DB::getInstance();
        }

        public function fetchRows($selection, $table, $condition='')
        {
            $query = "SELECT $selection FROM $table $condition";
            $queryResult = mysqli_query($this->mydb, $query);
            
            while($row = mysqli_fetch_assoc($queryResult))
            {
                $obj = new LookUp();
                $obj->id = $row['id'];
                $obj->name = $row['name'];
                $this->resultArr[] = $obj;
            }
            return $this->resultArr;
        }

    }
?>
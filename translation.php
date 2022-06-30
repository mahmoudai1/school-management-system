<?php
    require_once 'modules/DB.php';

    class Translation
    {
        public $id;
        public $translation_name;
        public $mydb;

        public function __construct()
        {
            $this->mydb = DB::getInstance();
        }

        public function fetchAll($translation = null)
        {
            $query = "SELECT * FROM translation";
            $queryResult = mysqli_query($this->mydb, $query);
            $tempObj = array();
            while($row = mysqli_fetch_assoc($queryResult))
            {
                $translation = new Translation();
                $translation->id = $row['id'];
                $translation->name = $row['translation_name'];
                $tempObj[] = $translation;
            }
            return $tempObj;
        }
    }
?>
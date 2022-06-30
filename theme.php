<?php
    require_once 'modules/DB.php';
    class Theme
    {
        public $id;
        public $name;
        public $html;
        public $parent_id;
        public $mydb;

        public function __construct()
        {
            $this->mydb = DB::getInstance();
        }

        public function fetchTheme($name)
        {
            $query = "SELECT themeHTML FROM theme WHERE name = '$name'";
            $queryResult = mysqli_query($this->mydb, $query);
            $rows = mysqli_fetch_assoc($queryResult);
            return $rows['themeHTML'];
        }
    }

?>
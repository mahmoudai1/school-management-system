<?php
    require_once 'modules/DB.php';

    class Languages
    {
        public $id;
        public $name;
        public $mydb;

        public function __construct()
        {
            $this->mydb = DB::getInstance();
        }

        public function fetchAll()
        {
            $query = "SELECT * FROM languages";
            $queryResult = mysqli_query($this->mydb, $query);
            $tempObj = array();
            while($row = mysqli_fetch_assoc($queryResult))
            {
                $language = new Languages();
                $language->id = $row['id'];
                $language->name = $row['name'];
                $tempObj[] = $language;
            }
            return $tempObj;
        }

        public function getLanguageOfNow()
        {
            $query = "SELECT * FROM languages";
            $queryResult = mysqli_query($this->mydb, $query);
            while($row = mysqli_fetch_assoc($queryResult))
            {
                if($row['selected'] == 1)
                {
                    return $row['name'];
                    break; // incase :D
                }
                
            }
        }

        public function changeLanguage()
        {
            $query = "SELECT * FROM languages";
            $queryResult = mysqli_query($this->mydb, $query);
            while($row = mysqli_fetch_assoc($queryResult))
            {
                if($row['name'] == "arabic")
                {
                    if($row['selected'] == 1)
                    {
                        $query2 = "UPDATE languages SET selected = 1 WHERE name = 'english'";
                        $query = "UPDATE languages SET selected = 0 WHERE name = 'arabic'";
                        if($this->mydb->query($query) !== true || $this->mydb->query($query2) !== true)
                        {
                            echo mysqli_error($this->mydb);
                        }
                    }
                    else
                    {
                        $query2 = "UPDATE languages SET selected = 0 WHERE name = 'english'";
                        $query = "UPDATE languages SET selected = 1 WHERE name = 'arabic'";
                        if($this->mydb->query($query) !== true || $this->mydb->query($query2) !== true)
                        {
                            echo mysqli_error($this->mydb);
                        }
                    }
                }
                
            }
        }
    }
?>
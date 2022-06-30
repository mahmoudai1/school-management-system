<?php
    require_once 'modules/DB.php';

    class Word{

    public $id;
    public $word;
    public $translation_id;
    public $language_id;
    public $mydb;

    public function __construct()
    {
        $this->mydb = DB::getInstance();
    }

    public function fetchAll()
        {
            $query = "SELECT * FROM word";
            $queryResult = mysqli_query($this->mydb, $query);
            $tempObj = array();
            while($row = mysqli_fetch_assoc($queryResult))
            {
                $word = new Word();
                $word->id = $row['id'];
                $word->name = $row['words'];
                $word->name = $row['translation_id'];
                $word->name = $row['language_id'];
                $tempObj[] = $word;
            }
            return $tempObj;
        }

    public function getSpecificWord($t_name, $language)
    {
        $language = strtolower($language);
        $query = "SELECT words 
                    FROM word w
                    JOIN languages l
                    ON l.id = w.language_id
                    JOIN translation t
                    ON t.id = w.translation_id
                    WHERE t.translation_name = '$t_name' AND l.name = '$language'";
        $queryResult = mysqli_query($this->mydb, $query);
        $rows = mysqli_fetch_assoc($queryResult);
        return $rows['words'];
    }

}
?>
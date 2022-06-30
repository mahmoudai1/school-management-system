<?php
    require_once 'DB.php';
    class SystemLog
    {
        public $id;
        public $message;
        public $mydb;

        public function __construct($message, $userId)
        {
            $this->mydb = DB::getInstance();
            $query = "INSERT INTO system_log (message, user_id) VALUES ('$message', $userId)";
            if($this->mydb->query($query) !== true)
            {
                echo mysqli_error($this->mydb);
            }
        }
    }
?>
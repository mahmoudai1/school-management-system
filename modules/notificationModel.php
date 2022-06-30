<?php
    require_once 'DB.php';
    class NotificationModel
    {
        public $id;
        public $content;
        public $isRead;
        public $userId;
        public $mydb;

        public function __construct()
        {
            $this->mydb = DB::getInstance();
        }

        public function fetchAll($condition = '')
        {
            $query = "SELECT * FROM notification $condition";
            $queryResult = mysqli_query($this->mydb, $query);

            $notifyArr = array();
            while($row = mysqli_fetch_assoc($queryResult))
            {
                $notifyObj = new NotificationModel();
                $notifyObj->id = $row['id'];
                $notifyObj->content = $row['content'];
                $notifyObj->isRead = $row['IsRead'];
                $notifyObj->userId = $row['user_id'];
                $notifyArr[] = $notifyObj;
            }
            return $notifyArr;
        }
    }
?>
<?php

    require_once '../../DB.php';

    interface ISubject{
        public function attach(IObserver $observer);
        public function notify();
    }


    interface IObserver{
        public function update(Subject $subject);
    }

    class Subject implements ISubject
    {
        public $observers = array();
        public $mydb;
        public $content;

        public function __construct()
        {
            $this->mydb = DB::getInstance();
        }

        public function attach(IObserver $observer)
        {
            $this->observers[] = $observer;
        }

        public function notify()
        {
            foreach($this->observers as $obs) {
                $obs->update($this);
            }
        }

        public function getRows()
        {
            return $this->observers[count($this->observers) - 1]->rows;
        }

        public function setNotifyContent($content)
        {
            $this->content = $content;
        }

        public function getNotifyContent()
        {
            return $this->content;
        }
    }

    class NotificationObserver implements IObserver
    {
        public $rows = array();
        public $rowsNo;
        public $mydb;
        public $user_id;
        public $content;
        public $subjectObj;
        public $grade;
        public $outOf;
        public function __construct($id, $type, $subjectObj, $grade, $outOf)
        {
            $this->mydb = DB::getInstance();
            $this->user_id = $id;
            $this->subjectObj = $subjectObj;
            $this->grade = $grade;
            $this->outOf = $outOf;
            $this->content = "Your ".$type." grade for ".$this->subjectObj->Name." ".$this->subjectObj->Code." has been updated. You got $grade out of $outOf";

        }

        public function update(Subject $subject)
        {
            $query = "INSERT INTO notification (content, IsRead, user_id) VALUES ('$this->content', 0, $this->user_id)";
            if($this->mydb->query($query)!==true)
            {
                echo mysqli_error($this->mydb);
            }
        }

        public function delete()
        {

        }
    }

    class EmailObserver implements IObserver
    {  
        public $mydb;

        public function __construct()
        {
            $this->mydb = DB::getInstance();
        }

        public function update(Subject $subject)
        {
            echo "Sending Email... Content: ".$subject->getNotifyContent();
            echo "<br>";
        }
    }

    class SMSObserver implements IObserver
    {  
        public $mydb;

        public function __construct()
        {
            $this->mydb = DB::getInstance();
        }

        public function update(Subject $subject)
        {
            echo "Sending SMS... Content: ".$subject->getNotifyContent();
            echo "<br>";
        }
    }
    
    
    $subject = new Subject();
    //$subject->attach(new NotificationObserver, "emails", "(from_id, to_id, message, isRead)", "(15, 20, 'message200', 0)");

    //$subject->attach(new SmsObserver, "sms", "(from, to, message)", "(test4, test5, test6)");

    ///$subject->attach(new EmailObserver());

    ///$subject->attach(new SMSObserver());

    ///$subject->attach(new NotificationObserver());

    ///$subject->setNotifyContent("Here is the notification content");


    ///$subject->notify();
    
    
    
    //$rows = $subject->getRows();
    //echo $rows[0]['from_id']."<br>";
    //echo $rows[0]['to_id']."<br>";
    //echo $rows[0]['message'];
?>
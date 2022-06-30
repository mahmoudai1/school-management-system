<?php
    require_once 'DB.php';
    require_once 'gradingMethodModel.php';
    require_once 'registrationDetailsModel.php';

    class TempGradingMethodValues{
        public $id;
        public $gradingMethodId;
        public $regDetailsId;
        public $grade;
        public $teacherId;
        public $mydb;
    }
?>
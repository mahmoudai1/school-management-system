<?php
    require_once 'DB.php';
    require_once 'subjectsModel.php';
    class Certificate{
        public $first_name;
        public $second_name;
        public $third_name;
        public $semesterId;
        public $semesterName;
        public $netStudentGrade;
        public $netSubjectsMarks;
        public $subjectsArray = array();
        public $mydb;

        public function __construct()
        {
            $this->mydb = DB::getInstance();
        }

        public function getCertificateObj($certificate, $rows)
        {
                $certificate->first_name = $rows['first_name'];
                $certificate->second_name = $rows['second_name'];
                $certificate->third_name = $rows['third_name'];
                $certificate->semesterName = $rows['name'];
                $certificate->netStudentGrade += $rows['gmvGrade'];

                return $certificate;
        }

        public static function callSubjectObj($subject, $rows)
        {
            return $subject->getSubjectsObj($subject, $rows);
        }
    }
?>
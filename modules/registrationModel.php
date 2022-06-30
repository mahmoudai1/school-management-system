<?php
    class RegistrationModel
    {
        public $id;
        public $student_id;
        public $semester_id;
        public $reg_date;
        public $reg_fees;
        public $mydb;

        function __construct()
        {
            $this->mydb = DB::getInstance();
        }

        public function assignForStudentId($studentId)
        {
            $query = "SELECT * FROM registration WHERE student_id = $studentId";
            $queryResult = mysqli_query($this->mydb, $query);
            $rows = mysqli_fetch_assoc($queryResult);

                $this->id = $rows['id'];
                $this->student_id = $rows['student_id'];
                $this->semester_id = $rows['semester_id'];
                $this->reg_date = $rows['reg_date'];
                $this->reg_fees = $rows['reg_fees'];
        }

        public function regIdForStudent($studentId)
        {
            $registrationObj = new RegistrationModel();
            $registrationObj->assignForStudentId($studentId);
            return $registrationObj->id;
        }

        public function studinfo($studentId)
        {
          $query = "SELECT * FROM registration WHERE student_id = $studentId";
          $queryResult = mysqli_query($this->mydb, $query);
          if($queryResult)
          {
            $rows = mysqli_fetch_assoc($queryResult);
            $studobj=new RegistrationModel();
            $studobj->id=$rows['id'];
            $studobj->student_id=$rows['student_id'];
            $studobj->semester_id=$rows['semester_id'];
            $studobj->reg_date=$rows['reg_date'];
            $studobj->reg_fees=$rows['reg_fees'];
            return $studobj;
          }
        }

        public function fetchDate($studentId)
        {
            $query = "SELECT reg_date FROM registration WHERE student_id=$studentId";
            $queryResult = mysqli_query($this->mydb, $query);
            if($queryResult)
            {
                $rows = mysqli_fetch_assoc($queryResult);
                if($rows)
                return $rows['reg_date'];
            }
            return "";
        }
    }
?>
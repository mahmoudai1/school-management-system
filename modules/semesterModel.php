<?php
    class SemesterModel
    {
        public $id;
        public $name;
        public $fees;
        public $mydb;

        function __construct()
        {
            $this->mydb = DB::getInstance();
        }

        public function selectAllSemesters()
        {
            $semesterArray = array();
            $query = "SELECT * FROM semester ORDER BY id";
            $queryResult = mysqli_query($this->mydb, $query);
            while($rows = mysqli_fetch_assoc($queryResult))
            {
                $semesterObj = new SemesterModel();
                $semesterObj->id = $rows['id'];
                $semesterObj->name = $rows['name'];
                array_push($semesterArray, $semesterObj);
            }
            return $semesterArray;
        }

        public function selectSemesterWithId($id)
        {
            $query = "SELECT r.semester_id 
                        FROM registration r
                        WHERE r.student_id = $id";
            $queryResult = mysqli_query($this->mydb, $query);
            $row = mysqli_fetch_assoc($queryResult);
            if($row)
            {
                $this->id = $row['semester_id'];
                return $this->id;
            }
        }

        public function selectSemesterWithName($user_id)
        {
            $query = "SELECT s.name
                        FROM semester s
                        JOIN registration r
                        ON r.semester_id = s.id
                        WHERE r.student_id = $user_id";
            $queryResult = mysqli_query($this->mydb, $query);
            if($queryResult)
            {
                $row = mysqli_fetch_assoc($queryResult);
                if($row)
                {
                    $this->name = $row['name'];
                    return $this->name;
                }
            }
            
        }

        public function selectSemesterWithFees($user_id)
        {
            $query = "SELECT s.fees
                        FROM semester s
                        JOIN registration r
                        ON r.semester_id = s.id
                        WHERE r.student_id = $user_id";
            $queryResult = mysqli_query($this->mydb, $query);
            $row = mysqli_fetch_assoc($queryResult);
            if($row)
            {
                $this->fees = $row['fees'];
                return $this->fees;
            }
        }
    }

?>
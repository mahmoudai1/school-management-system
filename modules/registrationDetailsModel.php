<?php
    class RegistrationDetailsModel
    {
        public $id;
        public $reg_id;
        public $subject_id;
        public $date;
        public $grade;
        public $mydb;

        function __construct()
        {
            $this->mydb = DB::getInstance();
        }

        public function assignAll()
        {
            $query = "SELECT * FROM registration_details";
            $queryResult = mysqli_query($this->mydb, $query);
            while($rows = mysqli_fetch_assoc($queryResult))
            {
                $this->id = $rows['id'];
                $this->reg_id = $rows['reg_id'];
                $this->subject_id = $rows['subject_id'];
                $this->date = $rows['date'];
                $this->grade = $rows['grade'];
            }
        }

        public function insertRegistrationDetailsToStudents($regId, $subjectId)
        {
            $query = "SELECT * FROM registration_details WHERE reg_id = $regId AND subject_id = $subjectId";
            $queryResult = mysqli_query($this->mydb, $query);
            $numberOfRows = mysqli_num_rows($queryResult);
            if($numberOfRows == 0)
            {
                $query = "INSERT INTO registration_details (reg_id, subject_id) VALUES ($regId, $subjectId)";
                if($this->mydb->query($query) !== true)
                    echo mysqli_error($this->mydb);
                else
                    echo "<div style='text-align:center; color:green;'>Successfully Added.</div>";
            }
            else
            {
                echo "<div style='text-align:center; color:red;'>The subject is already added</div>";
            }
        }

        
    }
?>
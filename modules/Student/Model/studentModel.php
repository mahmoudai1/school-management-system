<?php
    require_once '../../assignInterface.php';
    require_once '../../attendanceInterface.php';
    require_once '../../userModel.php';
    require_once '../../homeworkModel.php';
    require_once '../../semesterModel.php';
    require_once '../../subjectsModel.php';

    class Student
    {
        public $isPaid;
        public $subjectsArray = array();
        public $homeworksArray = array();
        public $whichClass;
        public $noOfDaysAttended;
        public $studentId;
        public $mydb;

        function __construct()
        {
            $this->studentId = $_SESSION['loggedId'];
            $this->mydb = DB::getInstance();
        }

        public function assignAll($homeworkModel = null)     // assign its class variables -- in this we will assign only homework array
        {
            $homeworkModel = new Homework();
            $homeworks = $homeworkModel->assignAll();
            $this->homeworksArray = $homeworks;
        }

        public function getSubjects($obj = null)
        {
            $query2 = "SELECT gmv.grade, s.subject_code, sn.subject_name, gm.name, s.id
                        FROM registration r
                        JOIN registration_details rd
                        ON r.id = rd.reg_id
                        JOIN subjects s
                        ON s.id = rd.subject_id
                        JOIN grading_method_values gmv
                        ON rd.id = gmv.reg_details_id
                        JOIN grading_method gm
                        ON gmv.grading_method_id = gm.id
                        JOIN subjects_names sn
                        ON s.subjects_names_id = sn.id
                        WHERE r.student_id = $this->studentId
                        ORDER BY 3";

            $query = "SELECT s.subject_code, sn.subject_name, s.id
                        FROM registration r
                        JOIN registration_details rd
                        ON r.id = rd.reg_id
                        JOIN subjects s
                        ON s.id = rd.subject_id
                        JOIN subjects_names sn
                        ON s.subjects_names_id = sn.id
                        WHERE r.student_id = $this->studentId
                        ORDER BY 2";

            $queryResult = mysqli_query($this->mydb, $query);
            $rowsArr = array();
            while($row = mysqli_fetch_assoc($queryResult))
            {
                $obj = new SubjectModel();
                $obj->id = $row['id'];
                $obj->Name = $row['subject_name'];
                $obj->Code = $row['subject_code'];
                $query2Result = mysqli_query($this->mydb, $query2);
                while($row2 = mysqli_fetch_assoc($query2Result))
                {
                    if($row['id'] == $row2['id'])
                    {
                        $obj->gradesArr[] = $row2['grade'];
                        $obj->gradingMethodArr[] = $row2['name'];
                    }
                }
                $rowsArr[] = $obj;
            }
            return $rowsArr;
        }

        public function getSemesterName(SemesterModel $semester)
        {
            $semesterId = $semester->selectSemesterWithId($this->studentId);
            $query = "SELECT name FROM semester WHERE id = $semesterId";
            $queryResult = mysqli_query($this->mydb, $query);
            if($queryResult)
            {
                $row = mysqli_fetch_assoc($queryResult);
                if($row)
                {
                    return $row['name'];
                }
            }
        }

        public function checkIfRegistered()
        {
            $id = $_SESSION['loggedId'];
            $query = "SELECT * FROM registration WHERE student_id = $id";
            $queryResult = mysqli_query($this->mydb, $query);
            if($queryResult && mysqli_num_rows($queryResult) == 1)
                return true;
            else
                return false;
        }

        public function decryptImage($strng)
        {
            $ciphering = "AES-128-CTR";
            $decryption_iv = '1234567891011121'; 
            $options = 0;
            $decryption_key = "OOpse314*%*"; 
  
            $decryption = openssl_decrypt ($strng, $ciphering, $decryption_key, $options, $decryption_iv);
            return $decryption;
        }

        public function submitHomework($studentid, $homeworkid, $arrayOfAnswers)
        {
            
        }

        /*public function addAttendance()
        {
            
        }

        public function submitExam()
        {

        }

        public function submitHomework($answers)
        {

        }

        public function displaySchedule($bus)
        {

        }

        public function startExam($exam)
        {

        }

        public function endExam($exam)
        {

        }

        public function nextQuestion($question)
        {

        }

        public function displayGrades()
        {

        }*/
    }
?>
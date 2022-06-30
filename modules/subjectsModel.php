<?php
    require_once 'assignInterface.php';
    require_once 'userModel.php';

    class SubjectModel implements Assign
    {
        public $id;
        public $Name;
        public $Code;
        public $studentMarks;
        public $subjectMarks;
        public $semesterId;
        public $semesterName;
        public $TimingId;
        public $Day;
        public $Time;
        public $mydb;
        public $subjectObj;
        public $subjectsArray = array();

        //for studentModel Help in its function getSubjects()
        public $gradingMethodArr = array();
        public $gradesArr = array();

        function __construct()
        {
            $this->mydb = DB::getInstance();
        }

        public function assignAll()
        {
            $query = "SELECT sem.name, s.id, s.semester_id, s.subject_code, s.marks, sn.subject_name 
                        FROM subjects s 
                        JOIN subjects_names sn 
                        ON s.subjects_names_id = sn.id 
                        JOIN semester sem
                        ON sem.id = s.semester_id
                        ORDER BY s.semester_id";
            $queryResult = mysqli_query($this->mydb, $query);
            
            while($row = mysqli_fetch_assoc($queryResult))
            {
                $tempObj = new SubjectModel();
                $tempObj->id = $row['id'];
                $tempObj->semesterId = $row['semester_id'];
                $tempObj->semesterName = $row['name'];
                $tempObj->Name = $row['subject_name'];
                $tempObj->Code = $row['subject_code'];
                $tempObj->subjectMarks = $row['marks'];
                array_push($this->subjectsArray, $tempObj);
            }

                
        }

        public function selectSpecificSubject($id)
        {
            $query = "SELECT sem.name, s.id, s.semester_id, s.subject_code, s.marks, sn.subject_name 
            FROM subjects s 
            JOIN subjects_names sn 
            ON s.subjects_names_id = sn.id 
            JOIN semester sem
            ON sem.id = s.semester_id
            WHERE s.id = $id
            ORDER BY s.semester_id";

            $queryResult = mysqli_query($this->mydb, $query);
            if($queryResult)
            {
                $row = mysqli_fetch_assoc($queryResult);
                    $tempObj = new SubjectModel();
                    $tempObj->id = $row['id'];
                    $tempObj->Name = $row['subject_name'];
                    $tempObj->Code = $row['subject_code'];
                    $tempObj->semesterId = $row['semester_id'];
                    $tempObj->semesterName = $row['name'];
                    $tempObj->subjectMarks = $row['marks'];
                    return $tempObj;
            }

                
        }

        public function selectAllSubjects()
        {
            $subjects = new SubjectModel();
            $subjects->assignAll();
            $this->subjectObj = $subjects->subjectsArray;
            for($i = 0; $i < count($this->subjectObj); $i++)
            {
                array_push($this->subjectsArray, $this->subjectObj[$i]);
            }
            return $this->subjectsArray;
        }

        public function selectTeacherSubjects($teacherId)
        {
            $query = "SELECT sem.name, s.id, s.semester_id, s.subject_code, s.marks, sn.subject_name  
                        FROM teacher_subjects ts 
                        JOIN subjects s 
                        ON ts.subject_id = s.id 
                        JOIN subjects_names sn 
                        ON s.subjects_names_id = sn.id 
                        JOIN semester sem
                        ON sem.id = s.semester_id
                        WHERE ts.user_id = $teacherId 
                        ORDER BY s.semester_id";

            $queryResult = mysqli_query($this->mydb, $query);
            while($row = mysqli_fetch_assoc($queryResult))
            {
                $tempObj = new SubjectModel();
                $tempObj->id = $row['id'];
                $tempObj->Name = $row['subject_name'];
                $tempObj->Code = $row['subject_code'];
                $tempObj->semesterId = $row['semester_id'];
                $tempObj->semesterName = $row['name'];
                $tempObj->subjectMarks = $row['marks'];
                array_push($this->subjectsArray, $tempObj);
            }
            return $this->subjectsArray; //////////////////////////////////
        }

        public function getStudentsWithSpecificSubject($subjectId)
        {
            $studentsArray = array();
            $query = "SELECT u.id, u.first_name, u.second_name, u.third_name, u.isDeleted
                        FROM users u 
                        JOIN registration r 
                        ON u.id = r.student_id 
                        JOIN registration_details rd 
                        ON r.id = rd.reg_id
                        WHERE rd.subject_id = $subjectId
                        ORDER BY u.first_name, u.second_name, u.third_name, u.id";

            $queryResult = mysqli_query($this->mydb, $query);

            $query2 = "SELECT u.id, u.first_name, u.second_name, u.third_name, u.isDeleted, gmv.grade, gm.name, gm.marks
                        FROM users u 
                        JOIN registration r 
                        ON u.id = r.student_id 
                        JOIN registration_details rd 
                        ON r.id = rd.reg_id 
                        JOIN grading_method_values gmv
                        ON gmv.reg_details_id = rd.id
                        JOIN grading_method gm
                        ON gm.id = gmv.grading_method_id
                        WHERE rd.subject_id = $subjectId
                        ORDER BY u.first_name, u.second_name, u.third_name, u.id";

            
            if($queryResult)
            {
                while($row = mysqli_fetch_assoc($queryResult))
                {
                    if($row['isDeleted'] == 0)
                    {
                        $user = new user();
                        $user->id = $row['id'];
                        $user->first_name = $row['first_name'];
                        $user->second_name = $row['second_name'];
                        $user->third_name = $row['third_name'];
                        $queryResult2 = mysqli_query($this->mydb, $query2);
                        while($row2 = mysqli_fetch_assoc($queryResult2))
                        {
                            if($row['id'] == $row2['id'])
                            {
                                $user->grade[] = $row2['grade'];
                                $user->gradeMethod[] = $row2['name'];
                                $user->outOf[] = $row2['marks'];
                            }
                        }
                            array_push($studentsArray, $user);
                    }
                }
                
            }

            return $studentsArray;
        }

        public function getSubjectsObj($subject, $rows)
        {
            $subject->Name = $rows['subject_name'];
            $subject->Code = $rows['subject_code'];
            $subject->subjectMarks = $rows['marks'];
            $subject->studentMarks = $rows['gmvGrade'];

            return $subject;
        }
    }
?>
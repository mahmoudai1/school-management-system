<?php
    require_once '../../systemLog.php';
    require_once '../../DB.php';
    require_once 'observerdp.php';
    require_once '../../subjectsModel.php';

    $gradingMethodValues = new GradingMethodValues($_REQUEST['gmid'],  $_REQUEST['sg'], $_REQUEST['tid']);
    $NotifiObj= new Subject();
    $subject = new SubjectModel();
    $gradingMethodValues->addGrade($_REQUEST['ss'], $_REQUEST['ssi'], $NotifiObj, $subject);

    class GradingMethodValues
    {
            public $id;
            public $gradingMethodId;
            public $regDetailsId;
            public $grade;
            public $teacherId;

            public function __construct($gmid, $sg, $ti)
            {
                $this->gradingMethodId = $gmid;
                $this->grade = $sg;
                $this->teacherId = $ti;
            }

        public function addGrade($selectedSubjectId, $selectedStudentId, $NotifiObj, $subject)
        {
            $db = DB::getInstance();
            

            if(isset($_REQUEST['v']))
                $v = $_REQUEST['v'];

            $query1 = "SELECT name FROM grading_method WHERE id =$this->gradingMethodId";
            $queryResult1 = mysqli_query($db, $query1);
            $gradingMethod = mysqli_fetch_assoc($queryResult1);
            $gradingMethod = $gradingMethod['name'];
            $gradingMethod = strtolower($gradingMethod);

            
            $query2 = "SELECT rd.id AS regDetId
                        FROM registration_details rd 
                        JOIN registration r 
                        ON r.id = rd.reg_id 
                        WHERE rd.subject_id = $selectedSubjectId AND r.student_id = $selectedStudentId";
            $queryResult2 = mysqli_query($db, $query2);
            $reg_details_id = mysqli_fetch_assoc($queryResult2);
            $reg_details_id = $reg_details_id['regDetId'];

            $query3 = "SELECT grading_method_id FROM grading_method_values WHERE reg_details_id = $reg_details_id";
            $query3Result = mysqli_query($db, $query3);
            $f = 1;
            while($row = mysqli_fetch_assoc($query3Result))
            {
                if($row['grading_method_id'] == $this->gradingMethodId)
                {
                    $f = 0;
                }
            }

            $query4 = "SELECT * FROM grading_method WHERE id = $this->gradingMethodId";
            $query4Result = mysqli_query($db, $query4);
            if($query4Result)
            {
                $rows = mysqli_fetch_assoc($query4Result);
                $outOfMarks = $rows['marks'];
            }
            if($this->grade <= $outOfMarks && $query4Result && $this->grade >= 0 && isset($this->grade))
            {
                if($f == 1)
                {
                    $query4 = "INSERT INTO grading_method_values (grading_method_id, reg_details_id, grade, teacher_id) VALUES ($this->gradingMethodId, $reg_details_id, $this->grade, $this->teacherId)";
                    $subjectObj = $subject->selectSpecificSubject($selectedSubjectId);

                    if($db->query($query4) !== true)
                        echo mysqli_error($db);
                    else
                    {
                        echo "Successfully Added";
                        $NotifiObj->attach(new NotificationObserver($selectedStudentId, $gradingMethod, $subjectObj, $this->grade, $outOfMarks));
                        $NotifiObj->notify();
                        new SystemLog("Teacher Add Grade to Student ".$selectedStudentId." in Subject ".$subjectObj->Name." - ".$subjectObj->Code, $this->teacherId);
                    }
                }
                else
                {
                    $query4 = "UPDATE grading_method_values SET grade = $this->grade, date_updated = CURRENT_TIMESTAMP()
                                WHERE grading_method_id = $this->gradingMethodId AND reg_details_id = $reg_details_id AND teacher_id = $this->teacherId";
                    $subjectObj = $subject->selectSpecificSubject($selectedSubjectId);
                    if($db->query($query4) !== true)
                        echo mysqli_error($db);
                    else
                    {
                        echo "Successfully Updated";
                        $NotifiObj->attach(new NotificationObserver($selectedStudentId, $gradingMethod, $subjectObj, $this->grade, $outOfMarks));
                        $NotifiObj->notify();
                        $tempQuery = "SELECT message FROM system_log WHERE message = 'Teacher Update Grade to Student $selectedStudentId in Subject $subjectObj->Name - $subjectObj->Code' AND user_id = $this->teacherId ORDER BY id DESC LIMIT 1";
                        $tempQueryResult = mysqli_query($db, $tempQuery);
                        
                        if(mysqli_num_rows($tempQueryResult) == 0)
                            new SystemLog("Teacher Update Grade to Student ".$selectedStudentId." in Subject ".$subjectObj->Name." - ".$subjectObj->Code, $this->teacherId);
                    }
                }
            }
            else
            {
                //echo "This Grade cannot exceed its limit, which equals to $outOfMarks";
                //echo $v;
                if($v && $v >= 0)
                {
                    
                    if($f == 1)
                    {
                        $query4 = "INSERT INTO grading_method_values (grading_method_id, reg_details_id, grade, teacher_id) VALUES ($this->gradingMethodId, $reg_details_id, $v, $this->teacherId)";
                        $subjectObj = $subject->selectSpecificSubject($selectedSubjectId);

                        if($db->query($query4) !== true)
                            echo mysqli_error($db);
                        else
                        {
                            echo "Successfully Added";
                        }
                    }
                    else
                    {
                        $query4 = "UPDATE grading_method_values SET grade = $v, date_updated = CURRENT_TIMESTAMP()
                                    WHERE grading_method_id = $this->gradingMethodId AND reg_details_id = $reg_details_id AND teacher_id = $this->teacherId";
                        $subjectObj = $subject->selectSpecificSubject($selectedSubjectId);
                        if($db->query($query4) !== true)
                            echo mysqli_error($db);
                        else
                        {
                            echo "Successfully Updated";
                        }
                    }
                }
            }
        }
    }
        
?>
<?php
    include_once '../../userModel.php';
    include_once '../../assignInterface.php';
    require_once '../../certificateModel.php';
    require_once '../../billModel.php';
    require_once '../../gradingMethodModel.php';
    require_once '../../systemLog.php';
    if(session_status() == PHP_SESSION_NONE){session_start();}

    class EmployeeModel implements Assign
    {
        public $usersObj;
        public $studentsArr = array();
        public $teachersArr = array();
        public $parentsArr = array();
        public $employeesArr = array();
        public $usersArr = array();
        public $specificUser = array();
        public $gradingMethodObj;//
        public $mydb;

        function __construct()
        {
            $this->mydb = DB::getInstance();
        }

        public function selectAllUsers()
        {
            $user = new user();
            $user->assignAll();
            $this->usersObj = $user->usersArray;
            for($i = 0; $i < count($this->usersObj); $i++)
            {
                array_push($this->usersArr, $this->usersObj[$i]);
            }
            return $this->usersArr;
        }

        public function selectAllStudents()
        {
            $user = new user();
            $user->assignAll();
            $this->usersObj = $user->usersArray;
            for($i = 0; $i < count($this->usersObj); $i++)
            {
                if($this->usersObj[$i]->user_type == 3)
                {
                    array_push($this->studentsArr, $this->usersObj[$i]);
                }
            }
            return $this->studentsArr;
        }

        public function selectAllTeachers()
        {
            $user = new user();
            $user->assignAll();
            $this->usersObj = $user->usersArray;
            for($i = 0; $i < count($this->usersObj); $i++)
            {
                if($this->usersObj[$i]->user_type == 2)
                {
                    array_push($this->teachersArr, $this->usersObj[$i]);
                }
            }
            return $this->teachersArr;
        }

        public function selectAllParents()
        {
            $user = new user();
            $user->assignAll();
            $this->usersObj = $user->usersArray;
            for($i = 0; $i < count($this->usersObj); $i++)
            {
                if($this->usersObj[$i]->user_type == 4)
                {
                    array_push($this->parentsArr, $this->usersObj[$i]);
                }
            }
            return $this->parentsArr;
        }

        public function selectAllEmployees()
        {
            $user = new user();
            $user->assignAll();
            $this->usersObj = $user->usersArray;
            for($i = 0; $i < count($this->usersObj); $i++)
            {
                if($this->usersObj[$i]->user_type == 1)
                {
                    array_push($this->employeesArr, $this->usersObj[$i]);
                }
            }
            return $this->employeesArr;
        }

        public function pwdEncryption($pwd)
        {
          $ciphering = "AES-128-CTR";
          
          $iv_length = openssl_cipher_iv_length($ciphering); 
          $options = 0; 
          
          $encryption_iv = '1234567891011121'; 
          
          $encryption_key = "OOpse314*%*"; 
          $encryption = openssl_encrypt($pwd, $ciphering,  $encryption_key, $options, $encryption_iv); 

          return $encryption;
        }

        public function acceptUser($id)
        {
            $query = "UPDATE users SET accepted = 1, date_modified = CURRENT_TIMESTAMP() WHERE id = $id";
            //$employeeModel->createStudent($id);         // --> MUST check if this id refer to a student type or NOT -- LATER
            if($this->mydb->query($query) !== true)
            {
                echo "Something went wrong.";
            }
            header("Refresh:0");
        }

        public function deleteUser($id)
        {
            $query = "UPDATE users SET isDeleted = 1, date_modified = CURRENT_TIMESTAMP() WHERE id = $id";
            if($this->mydb->query($query) !== true)
            {
                echo "Something went wrong";
            }
        }

        public function reActivateUser($id)
        {
            $query = "UPDATE users SET isDeleted = 0, date_modified = CURRENT_TIMESTAMP() WHERE id = $id";
            if($this->mydb->query($query) !== true)
            {
                echo "Something went wrong";
            }
            header("Refresh:0");
        }

        public function assignAll()
        {
        }

        public function aboutUsOldContent()
        {
            $query = "SELECT * FROM about_us";
            $queryResult = mysqli_query($this->mydb, $query);
            $row = mysqli_fetch_assoc($queryResult);
            $row['html_data'];
            if($row['html_data'] == "")
            {
                return "Its your first time to write in this about us page, focus and write something that users should like";
            }
            else
            {
                return $row['html_data'];
            }
        }

        public function editAboutUs($newContent)
        {
            $query = "UPDATE about_us SET html_data = '$newContent' WHERE id = 1";

            if($this->mydb->query($query) !== true)
                echo mysqli_error($this->mydb);
            else
            {
                new SystemLog("Employee Edited About Us Page", $_SESSION['loggedId']);
                echo "<div class='text-primary' style='font-size: 16px; margin-top:20px; text-align:center;'>Successfully edited</div>";
            }
        }

        public function registerStudent($studentId, $semesterName, $regFees)
        {
            $query1 = "SELECT * FROM semester";
            $query1Result = mysqli_query($this->mydb, $query1);
            $numberOfRows = mysqli_num_rows($query1Result);
            $query2 = "SELECT id FROM semester WHERE name = '$semesterName'";
            $query2Result = mysqli_query($this->mydb, $query2);
            $row = mysqli_fetch_assoc($query2Result);
            $semesterId = $row['id'];

            
            if($semesterId <= $numberOfRows && $semesterId > 0)
            {
                $query = "INSERT INTO registration (student_id, semester_id, reg_fees) VALUES ($studentId, $semesterId, $regFees)";
                if($this->mydb->query($query) !== true)
                    echo mysqli_error($this->mydb);

            }
        }

        public function addSubjectsToSystem($semesterName, $subjectCode, $subjectName, $gradingMethodObj = null)
        {
            $query0 = "SELECT id FROM semester WHERE name = '$semesterName'";
            $query0Result = mysqli_query($this->mydb, $query0);
            $row = mysqli_fetch_assoc($query0Result);
            $semesterId = $row['id'];


            $subjectName = strtolower($subjectName);
            $subjectName = ucfirst($subjectName);
            $query1 = "SELECT id, subject_name FROM subjects_names WHERE subject_name = '$subjectName'";
            $query1Result = mysqli_query($this->mydb, $query1);
            $numOfRows = mysqli_num_rows($query1Result);
            $row1 = mysqli_fetch_assoc($query1Result);

            $gradingMethodObj = new GradingMethod();
            $gradingMethods = $gradingMethodObj->getFromDB();

            $subjectMarks = 0;
            if($gradingMethods)
            {
                for($i = 0; $i < count($gradingMethods); $i++)
                {
                    $subjectMarks += $gradingMethods[$i]['marks'];
                }
            
            
                
                if($numOfRows > 0)
                {
                    $subjectNameId = $row1['id'];
                    $query2 = "INSERT INTO subjects (semester_id, subject_code, subjects_names_id, marks) VALUES ($semesterId, '$subjectCode', $subjectNameId, $subjectMarks)";
                    if($this->mydb->query($query2) !== true)
                        echo mysqli_error($this->mydb);
                }
                else
                {
                    $query2 = "INSERT INTO subjects_names (subject_name) VALUE ('$subjectName')";
                    if($this->mydb->query($query2) !== true)
                        echo mysqli_error($this->mydb);

                    $query3 = "SELECT id, subject_name FROM subjects_names WHERE subject_name = '$subjectName'";
                    $query3Result = mysqli_query($this->mydb, $query3);
                    $row2 = mysqli_fetch_assoc($query3Result);
                    $subjectNameId = $row2['id'];
                    $query4 = "INSERT INTO subjects (semester_id, subject_code, subjects_names_id, marks) VALUES ($semesterId, '$subjectCode', $subjectNameId, $subjectMarks)";
                    if($this->mydb->query($query4) !== true)
                        echo mysqli_error($this->mydb);
                }
            }
            
        }

        public function selectStudentSemesterId($id)
        {
            $query = "SELECT semester_id FROM registration WHERE student_id = $id";
            $queryResult = mysqli_query($this->mydb, $query);
            $rows = mysqli_fetch_assoc($queryResult);
            $value = $rows['semester_id'];
            return $value;
        }

        public function insertSubjectsToTeacher($teacherId, $subjectId)
        {
            $query = "SELECT * FROM teacher_subjects WHERE user_id = $teacherId AND subject_id = $subjectId";
            $queryResult = mysqli_query($this->mydb, $query);
            $numberOfRows = mysqli_num_rows($queryResult);
            if($numberOfRows == 0)
            {
                $query = "INSERT INTO teacher_subjects (user_id, subject_id) VALUES ($teacherId, $subjectId)";
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

        public function insertSemesterToTeacher($teacherId, $semesterName)
        {
            $query = "SELECT id FROM semester WHERE name='$semesterName'";
            $queryResult = mysqli_query($this->mydb, $query);
            $rows = mysqli_fetch_assoc($queryResult);
            $semesterId = $rows['id'];

            $query = "SELECT * FROM teacher_semesters WHERE teacher_id=$teacherId AND semester_id=$semesterId";
            $queryResult = mysqli_query($this->mydb, $query);
            $numberOfRows = mysqli_num_rows($queryResult);
            if($numberOfRows == 0)
            {
                $query = "INSERT INTO teacher_semesters (teacher_id, semester_id) VALUES ($teacherId, $semesterId)";
                if($this->mydb->query($query) !== true)
                {
                    $error = mysqli_error($this->mydb);
                    echo "<div style='text-align:center; margin-top:15px;' class='text-danger'>$error</div>";
                }
            }

        }

        public function getCertificate($studentId, $certificate = null, $subject = null)
        {
            $query = "SELECT u.first_name, u.second_name, u.third_name, r.semester_id, sem.name, sn.subject_name, s.subject_code, s.marks, SUM(gmv.grade) AS gmvGrade
                        FROM users u
                        JOIN registration r
                        ON u.id = r.student_id
                        JOIN registration_details rd
                        ON r.id = rd.reg_id
                        JOIN grading_method_values gmv
                        ON gmv.reg_details_id = rd.id
                        JOIN subjects s
                        ON (s.id = rd.subject_id AND s.semester_id = r.semester_id)
                        JOIN subjects_names sn
                        ON s.subjects_names_id = sn.id
                        JOIN semester sem
                        ON sem.id = r.semester_id
                        WHERE u.id = $studentId
                        GROUP BY 1,2,3,4,5,6,7";

            $queryResult = mysqli_query($this->mydb, $query);

            $certificate = new Certificate();
            while($rows = mysqli_fetch_assoc($queryResult))
            {
                $certificate = $certificate->getCertificateObj($certificate, $rows);
                $subject = new SubjectModel();
                $subject = Certificate::callSubjectObj($subject, $rows);
                $certificate->netSubjectsMarks += $subject->subjectMarks;
                array_push($certificate->subjectsArray, $subject);
                
            }
            return $certificate;
        }

        public function TransferStudentToNextSemester($studentId)
        {
            $query = "SELECT semester_id FROM registration WHERE student_id = $studentId";
            $queryResult = mysqli_query($this->mydb, $query);
            $row = mysqli_fetch_assoc($queryResult);
            $semester = $row['semester_id'];
            $semester++;
            $query = "UPDATE registration SET semester_id = $semester WHERE student_id = $studentId";
            if($this->mydb->query($query) !== true)
                echo mysqli_error($this->mydb);
            //else
                //echo "<div style='text-align:center; margin-top:15px;' class='text-primary'>Successfully Transferred</div>";
        }

        public function generateBill($id, $bill = null)
        { 
            $selectQuery = "SELECT * FROM student_bill WHERE student_id=$id";
            $selectQueryResult = mysqli_query($this->mydb, $selectQuery);
            $i = 0;
            $temp2 = array();
            if($selectQueryResult)
            {
                while($row1 = mysqli_fetch_assoc($selectQueryResult))       //loop over a bills specific to the above student
                {
                    $studentBillId = $row1['id'];

                    $query = "SELECT u.id AS user_id, u.first_name, u.second_name, u.third_name, rid.reg_id, r.semester_id, rid.id AS rid_id, rid.item_id
                    , rid.value, r.reg_date, i.id, i.name, sb.date_created, sb.id AS sb_id
                    FROM registration r
                    JOIN registration_item_details rid
                    ON rid.reg_id = r.id
                    JOIN users u
                    ON r.student_id = u.id
                    JOIN items i
                    ON rid.item_id = i.id
                    JOIN student_bill sb
                    ON sb.id = rid.student_bill_id
                    WHERE u.id = $id AND rid.student_bill_id = $studentBillId";
                    $queryResult = mysqli_query($this->mydb, $query);
                    
                    $temp = array();
                    
                    if($queryResult)
                    {
                        while($rows = mysqli_fetch_assoc($queryResult))     // loop over the items for the above specific bill
                        {
                            if($row1['id'] == $rows['sb_id'])
                            {
                                $bill = new Bill();
                                $bill->fetchBills($rows);
                                array_push($temp, $bill);
                            }
                            
                        }
                        array_push($temp2, $temp);
                    }
                    
                }
                

                return $temp2;
            }
        }

        public function getNumberOfUsersInRole($role)
        {
            $query = "SELECT * FROM users WHERE user_type = $role";
            $queryResult = mysqli_query($this->mydb, $query);
            return mysqli_num_rows($queryResult);
        }

        public function addNewGradeType($gradeType, $typeMarks)
        {
            $gradeType = strtolower($gradeType);
            $query = "INSERT INTO grading_method (name, marks) VALUES ('$gradeType', $typeMarks)";
            if(mysqli_query($this->mydb, $query) !== true)
            {
                echo mysqli_error($this->mydb);
            }
            else
            {
               echo "<div style='text-align:center; margin-top:15px;' class='text-success'>Successfully Added</div>";
               header("Refresh:0");

            }
        }

        public function getExistGradeMethods()
        {
            $query = "SELECT * FROM grading_method";
            $queryResult = mysqli_query($this->mydb, $query);
            $rowsArr = array();
            while($row = mysqli_fetch_assoc($queryResult))
            {
                $rowsArr[] = $row;
            }
            return $rowsArr;
        }

        public function addNewSemester($semesterName, $semesterFees)
        {
            $semesterName = strtoupper($semesterName);
            $query = "SELECT * FROM semester WHERE name='$semesterName'";
            $queryResult = mysqli_query($this->mydb, $query);
            if(mysqli_num_rows($queryResult) > 0)
            {
                $query = "UPDATE semester SET fees=$semesterFees WHERE name='$semesterName'";
                if(mysqli_query($this->mydb, $query) !== true)
                {
                    $error = mysqli_error($this->mydb);
                    echo "<div style='text-align:center; margin-top:15px;' class='text-danger'>$error</div>";
                }
                else
                {
                echo "<div style='text-align:center; margin-top:15px;' class='text-success'>Successfully Updated</div>";

                }
            }
            else
            {
                $query = "INSERT INTO semester (name, fees) VALUES ('$semesterName', $semesterFees)";
                if(mysqli_query($this->mydb, $query) !== true)
                {
                    $error = mysqli_error($this->mydb);
                    echo "<div style='text-align:center; margin-top:15px;' class='text-danger'>$error</div>";
                }
                else
                {
                echo "<div style='text-align:center; margin-top:15px;' class='text-success'>Successfully Added</div>";

                }
            }
        }

        public function addMessageToTheSystem($type, $message)
        {
            $query = "INSERT INTO system_messages (type, message) VALUES('$type', '$message')";
            if($this->mydb->query($query) !== true)
            {
                echo mysqli_error($this->mydb);
            }
        }

        public function insertNewPaymentMethod($methodName)
        {
            $methodName = strtolower($methodName);
            $query = "INSERT INTO payment_method (name) VALUES ('$methodName')";
            if($this->mydb->query($query) !== true)
            {
                $error = mysqli_error($this->mydb);
                echo "<div style='text-align:center; margin-top:15px;' class='text-danger'>$error</div>";
            }
            else
            {
                echo "<div style='text-align:center; margin-top:15px;' class='text-success'>Successfully Added</div>";
            }
        }

        public function insertNewPaymentOption($optionName, $optionType, $methodName)
        {
            $optionName = strtolower($optionName);
            $optionType = strtolower($optionType);
            $query = "SELECT id FROM payment_method WHERE name = '$methodName'";
            $queryResult = mysqli_query($this->mydb, $query);
            $row = mysqli_fetch_assoc($queryResult);
            $paymentId = $row['id'];

            $query = "INSERT INTO payment_options (name, payment_id, type) VALUES ('$optionName', $paymentId, '$optionType')";
            if($this->mydb->query($query) !== true)
            {
                $error = mysqli_error($this->mydb);
                echo "<div style='text-align:center; margin-top:15px;' class='text-danger'>$error</div>";
            }
            else
            {
                echo "<div style='text-align:center; margin-top:15px;' class='text-success'>Successfully Added</div>";
            }
        }

        public function updateQRLink($link)
        {
            $query = "UPDATE qr_link SET name='$link'";
            if($this->mydb->query($query) !== true)
            {
                $error = mysqli_error($this->mydb);
                echo "<div style='text-align:center; margin-top:15px;' class='text-danger'>$error</div>";
            }
            else
                echo "<div style='text-align:center; margin-top:15px;' class='text-success'>Successfully Added</div>";

        }
       
    }
?>
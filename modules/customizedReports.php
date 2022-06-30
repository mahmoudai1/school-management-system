<?php

    require_once 'DB.php';
    if(session_status() == PHP_SESSION_NONE){session_start();}

    class CustomizedReports
    {
        public $id;
        public $report_name;
        public $user_id;
        public $sql_statement;
        public $mydb;

        public function __construct()
        {
            $this->mydb = DB::getInstance();
        }

        public function fetchRows()
        {
            $query = "SELECT * FROM customized_reports";
            $queryResult = mysqli_query($this->mydb, $query);
            $reportsArray = array();
            while($row = mysqli_fetch_assoc($queryResult))
            {
                $reportsObj = new CustomizedReports();
                $reportsObj->id = $row['id'];
                $reportsObj->report_name = $row['report_name'];
                $reportsObj->user_id = $row['user_id'];
                $reportsObj->sql_statement = $row['sql_statement'];
                $reportsArray[] = $reportsObj;
            }
            return $reportsArray;
            
        }

        public function sqlStatement($condition, $grade)
        {
            if($condition == "more than")
            {
                $query = "SELECT u.first_name, u.second_name, u.third_name, u.id, sem.name, u.isDeleted, SUM(gmv.grade) AS gmvGrade
                FROM users u
                JOIN registration r
                ON u.id = r.student_id
                JOIN registration_details rd
                ON r.id = rd.reg_id
                JOIN grading_method_values gmv
                ON gmv.reg_details_id = rd.id
                JOIN semester sem
                ON sem.id = r.semester_id
                GROUP BY 1,2,3,4,5,6
                HAVING gmvGrade > $grade";
            }
            else if($condition == "less than")
            {
                $query = "SELECT u.first_name, u.second_name, u.third_name, u.id, sem.name, u.isDeleted, SUM(gmv.grade) AS gmvGrade
                FROM users u
                JOIN registration r
                ON u.id = r.student_id
                JOIN registration_details rd
                ON r.id = rd.reg_id
                JOIN grading_method_values gmv
                ON gmv.reg_details_id = rd.id
                JOIN semester sem
                ON sem.id = r.semester_id
                GROUP BY 1,2,3,4,5,6
                HAVING gmvGrade < $grade";
            }
            else if($condition == "equals")
            {
                $query = "SELECT u.first_name, u.second_name, u.third_name, u.id, sem.name, u.isDeleted, SUM(gmv.grade) AS gmvGrade
                FROM users u
                JOIN registration r
                ON u.id = r.student_id
                JOIN registration_details rd
                ON r.id = rd.reg_id
                JOIN grading_method_values gmv
                ON gmv.reg_details_id = rd.id
                JOIN semester sem
                ON sem.id = r.semester_id
                GROUP BY 1,2,3,4,5,6
                HAVING gmvGrade = $grade";
            }

            $queryResult = mysqli_query($this->mydb, $query);
            if($queryResult)
            {
                $tempArray1 = array();
                if($queryResult && mysqli_fetch_assoc($queryResult))
                {
                    $id = $_SESSION['loggedId'];
                    $query2 = "INSERT INTO customized_reports (report_name, user_id, sql_statement) VALUES ('Grade Report', $id, '$query')";
                    if($this->mydb->query($query2) !== true)
                    {
                        echo mysqli_error($this->mydb);
                    }
                    else
                    {
                        while($row = mysqli_fetch_assoc($queryResult))
                        {
                            $tempArray2 = array();
                            $tempArray2[] = $row['first_name'];
                            $tempArray2[] = $row['second_name'];
                            $tempArray2[] = $row['third_name'];
                            $tempArray2[] = $row['id'];
                            $tempArray2[] = $row['name'];
                            $tempArray2[] = $row['isDeleted'];
                            $tempArray2[] = $row['gmvGrade'];
                            $tempArray1[] = $tempArray2;
                        }

                        return $tempArray1;
                    }
                }
            }
        }
    }

?>
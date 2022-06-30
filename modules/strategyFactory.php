<?php

    interface ILogin
    {
        public function login();
    }

    class TeacherLogin implements ILogin
    {
        public function login()
        {
            header( "refresh:1;url=/PharaohSchoolSystem/modules/Teacher/Controller/teacherController.php?page=Home");
        }
    }

    class StudentLogin implements ILogin
    {
        public function login()
        {
            header( "refresh:1;url=/PharaohSchoolSystem/modules/Student/Controller/studentController.php");
        }
    }

    class ParentLogin implements ILogin
    {
        public function login()
        {
            header( "refresh:1;url=/PharaohSchoolSystem/modules/Parent/Controller/parentController.php?page=Home");
        }
    }

    class LoginCredentials
    {
        public $ref;

        public function setCredentials($x)
        {
            $ref = $x;
            $ref->login();
        }


    }
    
    class StrategyFactory
    {
        public $object;

        public function createObject($type)
        {
            if($type == "Teacher")
            {
                $this->object = new TeacherLogin();
            }
            else if($type == "Student")
            {
                $this->object = new StudentLogin();
            }
            else if($type == "Parent")
            {
                $this->object = new ParentLogin();
            }
            else if($type == "loginCredentials")
            {
                $this->object = new LoginCredentials();
            }
            
            return $this->object;
        }
    }
?>
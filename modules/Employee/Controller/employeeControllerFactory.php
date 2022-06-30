<?php
    require_once '../Model/employeeModel.php';
    require_once '../View/employeeView.php';
    require_once '../../subjectsModel.php';
    require_once '../../semesterModel.php';
    require_once '../../registrationDetailsModel.php';
    require_once '../../registrationModel.php';
    require_once '../../itemModel.php';
    require_once '../../regItemDetailsModel.php';
    require_once '../../lookup.php';
    require_once '../../bus.php';
    require_once '../../customizedReports.php';

    class EmployeeControllerFactory
    {
        public $object;

        public function createObject($type)
        {
            if($type == "employeeModel")
            {
                $this->object = new EmployeeModel();
            }
            else if($type == "semesterModel")
            {
                $this->object = new SemesterModel();
            }
            else if($type == "subjectModel")
            {
                $this->object = new SubjectModel();
            }
            else if($type == "registrationDetailsModel")
            {
                $this->object = new RegistrationDetailsModel();
            }
            else if($type == "registrationModel")
            {
                $this->object = new RegistrationModel();
            }
            else if($type == "registrationItemDetailsModel")
            {
                $this->object = new RegItemDetModel();
            }
            else if($type == "itemModel")
            {
                $this->object = new ItemModel();
            }
            else if($type == "employeeView")
            {
                $this->object = new EmployeeView();
            }
            else if($type == "lookup")
            {
                $this->object = new LookUp();
            }
            else if($type == "bus")
            {
                $this->object = new Bus();
            }
            else if($type == "customizedReports")
            {
                $this->object = new CustomizedReports();
            }

            return $this->object;
        }

    }
?>
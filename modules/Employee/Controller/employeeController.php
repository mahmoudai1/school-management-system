<?php
    require_once 'employeeControllerFactory.php';
    $factory = new EmployeeControllerFactory();
    $employeeModelTemp = $factory->createObject("employeeModel");
    $employees = $employeeModelTemp->selectAllEmployees();

    for($i = 0; $i < count($employees); $i++)
    {
        if($_REQUEST['access'] == $employeeModelTemp->pwdEncryption($employees[$i]->password))
        {
            break;
        }
        die("No Permission");
    }

?>

<!DOCTYPE html>

<html lang="en">


<head>

    <meta name="viewport" content="width=device-width, inital-scale=1.0">
    <meta charset="utf-8">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <script src="https://cdn.ckeditor.com/ckeditor5/23.1.0/classic/ckeditor.js"></script>
    <link rel="stylesheet" type="text/css" href="http://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
    <script src="https://kit.fontawesome.com/4733528720.js" crossorigin="anonymous"></script>

    <title>Employee cPanel</title>

</head>

<body>

<?php

class EmployeeController
{
    public $factory;
    public $employeeModel;
    public $employeeView;
    /*public $subjectsModel = $factory->createObject("subjectModel");
    public $subjectsObj = $subjectsModel->selectAllSubjects();
    public $semestersArray = $semesterModel->selectAllSemesters();
    public $registrationDetailsModel = $factory->createObject("registrationDetailsModel");
    public $registrationModel = $factory->createObject("registrationModel");
    public $regItemModel = $factory->createObject("registrationItemDetailsModel");
    public $itemModel = $factory->createObject("itemModel"); //*/
    //public $busModel = $factory->createObject("bus");

    public function __construct()
    {
        $this->factory = new EmployeeControllerFactory();
        $this->employeeView = $this->factory->createObject("employeeView");
        $this->employeeModel = $this->factory->createObject("employeeModel");
    }

    public function showAllTypesView()
    {
        $this->employeeView->showAllTypes($this->employeeModel->getNumberOfUsersInRole(2), $this->employeeModel->getNumberOfUsersInRole(3), $this->employeeModel->getNumberOfUsersInRole(4));
    }

    public function aboutUsView()
    {
        $oldContent = $this->employeeModel->aboutUsOldContent();
        $this->employeeView->aboutUs($oldContent);
    }

    public function addSubjectsView($semestersArray)
    {
        $this->employeeView->addSubjects($semestersArray);
        if(isset($_POST['addSubjectToSystem']))
        {
            $this->employeeModel->addSubjectsToSystem($_POST['selectedSemester'], $_POST['subjectCode'], $_POST['subjectName']);
            new SystemLog("Employee Add Subject to System", $_SESSION['loggedId']);
        }
    }

    public function billsPageView()
    {
        $this->employeeView->billsPage();
    }

    public function configGradesView()
    {
        $existGrades = $this->employeeModel->getExistGradeMethods();
        $this->employeeView->configGradesPage($existGrades);

        if(isset($_POST['submitGradeType']))
        {
            $this->employeeModel->addNewGradeType($_POST['gradeType'], $_POST['typeMarks']);
            new SystemLog("Employee Add Grade Type", $_SESSION['loggedId']);
        }
    }

    public function addNewSemesterView()
    {
        $this->employeeView->addNewSemesterPage();

        if(isset($_POST['submitSemester']) && strpos($_POST['submitSemester'], "'") === false)
        {
            $this->employeeModel->addNewSemester($_POST['semesterName'], $_POST['semesterFees']);
            new SystemLog("Employee Add New Semester", $_SESSION['loggedId']);
        }
    }

    public function systemMessagesView()
    {
        $this->employeeView->systemMessagesPage();

        if(isset($_POST['submitSystemMessage']))
        {
            $this->employeeModel->addMessageToTheSystem($_POST['messageType'], $_POST['messageContent']);
        }
    }

    public function paymentEavView()
    {
        $this->employeeView->paymentEavPage();
    }

    public function paymentMethodPageView()
    {
        $this->employeeView->paymentMethodPage();

        if(isset($_POST['submitPaymentMethod']))
        {
            $this->employeeModel->insertNewPaymentMethod($_POST['methodName']);
        }
    }

    public function paymentOptionView($lookUp)
    {
        $this->employeeView->paymentOptionPage($lookUp->fetchRows("*", "payment_method"));

        if(isset($_POST['submitPaymentOption']))
        {
            $this->employeeModel->insertNewPaymentOption($_POST['optionName'], $_POST['optionType'], $_POST['methodNameV2']);
        }
    }

    public function qrLinkView()
    {
        $this->employeeView->QrLinkPage();

        if(isset($_POST['updateQR']))
        {
            $this->employeeModel->updateQRLink($_POST['qrLink']);
        }
    }

    public function busView()
    {
        $this->employeeView->busPage();
    }

    public function addNewBusView($lookUp, $busModel)
    {
        $routes = $lookUp->fetchRows("*", "bus_routes");
        $this->employeeView->addNewbusPage($routes);
        if(isset($_POST['submitBus']))
        {
            $busModel->insertNewBus($_POST['selectedRoute'], $_POST['meetAt'], $_POST['busCode'], $_POST['driverName'], $_POST['supervisorName'], $_POST['supervisorPhoneNumber'],$_POST['busSeats'], $_POST['timeMove'], $_POST['timeArrive']);
        }
    }

    public function addNewRouteView($busModel)
    {
        $this->employeeView->addNewRoute();
        if(isset($_POST['submitRoute']))
        {
            $busModel->insertNewRoute($_POST['routeName'], $_POST['routeFees']);
        }
    }

    public function editAboutUsView()
    {
        if(isset($_POST['content']))
        $newContent = $_POST['content'];

        if($newContent)
        {
            $this->employeeModel->editAboutUs($newContent);
        }
    }

    public function studentsView()
    {
        $students = $this->employeeModel->selectAllStudents();
        $this->employeeView->displayAll($students, "Students");
    }

    public function teachersView()
    {
        $teachers = $this->employeeModel->selectAllTeachers();
        $this->employeeView->displayAll($teachers, "Teachers");
    }

    public function parentsView()
    {
        $parents = $this->employeeModel->selectAllParents();
        $this->employeeView->displayAll($parents, "Parents");
    }

    public function createItemView()
    {
        $this->employeeView->createItem();
    }

    public function createBillView($itemModel)
    {
        $itemsObjs = $itemModel->selectallitems();
        $students = $this->employeeModel->selectAllStudents();
        $this->employeeView->createBill($itemsObjs, $students);
    }

    public function searchBillsView()
    {
        $students = $this->employeeModel->selectAllStudents();
        $this->employeeView->SearchBills($students);
    }

    public function displayStudentBillView()
    {
        //$students = $this->employeeModel->selectAllStudents();
        $selectedStudentId = explode(" ", $_POST['selectedStudentId2']);
        $url = $this->employeeView->url."&selected=bills&StudentIdBill=".$selectedStudentId[0];
        new SystemLog("Employee Display Bill", $_SESSION['loggedId']);
        header("location:$url");
    }

    public function nameSearchInputView()
    {
        $employees = $this->employeeModel->selectAllEmployees();
        $encID = $_REQUEST['access'];
        $url = $employees[0]->link."?access=".$encID."&".$_REQUEST['selected']."name";
        $nameArray = explode(" ", $_POST['nameSearchInput']);
        $printedName = "";
        for($i = 0; $i < count($nameArray); $i++)
        {
            if($i > 0)
            {
                $printedName.= "_";
            }
            $printedName.=$nameArray[$i];
        }
        header('location:'.$url.'='.$printedName);
    }

    public function searchWithNameStudentsView()
    {
        $students = $this->employeeModel->selectAllStudents();
        $nameArray = explode("_", $_REQUEST['studentname']);
        $this->employeeView->searchWithName($students, $nameArray);
    }

    public function searchWithNameTeachersView()
    {
        $teachers = $this->employeeModel->selectAllTeachers();
        $nameArray = explode("_", $_REQUEST['teachername']);
        $this->employeeView->searchWithName($teachers, $nameArray);
    }

    public function searchWithNameParentsView()
    {
        $parents = $this->employeeModel->selectAllParents();
        $nameArray = explode("_", $_REQUEST['parentname']);
        $this->employeeView->searchWithName($parents, $nameArray);
    }

    public function displaySpecificUserView()
    {
        $users = $this->employeeModel->selectAllUsers();
        $userType = 0;
        $userObj = null;
        for($i = 0; $i < count($users); $i++)
        {
            if($users[$i]->id == $_REQUEST['id'])
            {
                $userType = $users[$i]->user_type;
                $userObj = $users[$i];
                break;
            }
        }
            $this->employeeView->displaySpecificUser($userObj);
    }

    public function acceptUserView()
    {
        $id = $_REQUEST['id'];
        $this->employeeModel->acceptUser($id);
        new SystemLog("Employee Accept User", $_SESSION['loggedId']);
    }

    public function deleteUserView()
    {
        $id = $_REQUEST['id'];
        $this->employeeModel->deleteUser($id);
        new SystemLog("Employee Delete User", $_SESSION['loggedId']);
    }

    public function reactivateUserView()
    {
        $id = $_REQUEST['id'];
        $this->employeeModel->reActivateUser($id);
        new SystemLog("Employee Re-activate User's Account", $_SESSION['loggedId']);
    }

    public function studentsRegistrationView($userObj, $semestersArray)
    {
        $this->employeeView->studentsRegisterPage($userObj, $semestersArray);
        if(isset($_POST['registerStudent']))
        {
            $this->employeeModel->registerStudent($_REQUEST['id'], $_POST['selectedSemester'], $_POST['regFees']);
            new SystemLog("Employee Register Student", $_SESSION['loggedId']);
        }
    }

    public function subjectsRegistrationForStudentsView($userObj, $subjectsObj, $registrationModel, $registrationDetailsModel)
    {
        $studentSemester = $this->employeeModel->selectStudentSemesterId($_REQUEST['id']);
        $this->employeeView->subjectsRegisterPage("student", $studentSemester, $userObj, $subjectsObj);
        if(isset($_POST['addSubject']))
        {
            $selectedSubject = explode(" ", $_POST['selectedSubject']);
            $regId = $registrationModel->regIdForStudent($_REQUEST['id']);
            $registrationDetailsModel->insertRegistrationDetailsToStudents($regId, $selectedSubject[0]);
            new SystemLog("Employee Add Subject to Student", $_SESSION['loggedId']);
        }
    }

    public function subjectsRegistrationForTeachersView($userObj, $subjectsObj)
    {
        $this->employeeView->subjectsRegisterPage("teacher", null, $userObj, $subjectsObj);
        if(isset($_POST['addSubject']))
        {
            $selectedSubject = explode(" ", $_POST['selectedSubject']);
            $this->employeeModel->insertSubjectsToTeacher($_REQUEST['id'], $selectedSubject[0]);
            $this->employeeModel->insertSemesterToTeacher($_REQUEST['id'], $selectedSubject[count($selectedSubject) - 1]);
            new SystemLog("Employee Add Subject to Teacher", $_SESSION['loggedId']);
        }
    }

    public function studentCertificateView()
    {
        $certificateObj = $this->employeeModel->getCertificate($_REQUEST['id']);
        $this->employeeView->displayStudentCertificate($certificateObj);
        new SystemLog("Employee Generate Certificate", $_SESSION['loggedId']);
        if(isset($_POST['transferStudent']))
        {
            $this->employeeModel->TransferStudentToNextSemester($_REQUEST['id']);
            new SystemLog("Employee Transfer Student to next Semester", $_SESSION['loggedId']);
        }
    }

    public function generateBillView()
    {
        $id = $_REQUEST['StudentIdBill'];
        $bill = $this->employeeModel->generateBill($id);
        $total = 0;
        if($_REQUEST['StudentIdBill'])
        {
            $this->employeeView->showbill($bill,$total);
        }
    }

    public function addItemView($itemModel)
    {
        $itemModel->additems($_POST['itemName'], $_POST['itemValue']);
        new SystemLog("Employee Add New Bills item", $_SESSION['loggedId']);
    }

    public function createBill2View($registrationModel, $itemModel, $regItemModel)
    {
        $selectedStudentId = explode(" ", $_POST['selectedStudentId1']);
        $ct = 0;
        if(isset($_POST['itemscheckbox']))
        {
            foreach($_POST['itemscheckbox'] as $item)
            {
                if($selectedStudentId[0])
                {
                    $StudentObj=$registrationModel->studinfo($selectedStudentId[0]);
                    $ValueObj=$itemModel->getitemvalue($item);
                    
                    $regItemModel->AddRegItemDetails($ct, $StudentObj->id,$item,$ValueObj->price);
                    $ct++;
                }
            }
            new SystemLog("Employee Create New Bill", $_SESSION['loggedId']);
        }
    }

    public function specificResearchView($reports)
    {
        $this->employeeView->specificSearchPage($reports);
    }

    public function specificSearchResultsView($results)
    {
        $this->employeeView->specificSearchResultsView($results);
    }

}
    $employeeController = new EmployeeController();
    $semesterModel = $factory->createObject("semesterModel");
    $employeeModel = $factory->createObject("employeeModel");
    $subjectsModel = $factory->createObject("subjectModel");
    $customizedReports = $factory->createObject("customizedReports");

if(isset($_REQUEST['page']))
{
    if($_REQUEST['page'] == "home")
    {
        $employeeController->showAllTypesView();
    }

    if( $_REQUEST['page'] == "aboutUsEmployee")
    {
        $employeeController->aboutUsView();
    }

    if($_REQUEST['page'] == "addsubjects")
    {
        $employeeController->addSubjectsView($semesterModel->selectAllSemesters());
    }

    if($_REQUEST['page'] == "bills")
    {
        $employeeController->billsPageView();
    }

    if($_REQUEST['page'] == "ConfigGrades")
    {
        $employeeController->configGradesView();
    }

    if($_REQUEST['page'] == "AddNewSemester")
    {
        $employeeController->addNewSemesterView();
    }

    if($_REQUEST['page'] == "SystemMessages")
    {
        $employeeController->systemMessagesView();
    }

    if($_REQUEST['page'] == "PaymentEAV")
    {
        $employeeController->paymentEavView();
    }

    if($_REQUEST['page'] == "PaymentMethods")
    {
        $employeeController->paymentMethodPageView();
    }

    if($_REQUEST['page'] == "PaymentOption")
    {
        $employeeController->paymentOptionView($factory->createObject("lookup"));
    }

    if($_REQUEST['page'] == "QrLink")
    {
        $employeeController->qrLinkView();
    }

    if($_REQUEST['page'] == "Bus")
    {
        $employeeController->busView();
    }

    if($_REQUEST['page'] == "AddNewBus")
    {
        $employeeController->addNewBusView($factory->createObject("lookup"), $factory->createObject("bus"));
    }

    if($_REQUEST['page'] == "AddNewRoute")
    {
        $employeeController->addNewRouteView($factory->createObject("bus"));
    }

    if($_REQUEST['page'] == "SpecificSearch")
    {
        $employeeController->specificResearchView($customizedReports->fetchRows());
        if(isset($_POST['condition']) && isset($_POST['whereGrade']))
        {
            $employeeController->specificSearchResultsView($customizedReports->sqlStatement($_POST['condition'], $_POST['whereGrade']));
        }
    }
}

if(isset($_POST['editAboutUs']))
{
    $employeeController->editAboutUsView();
}

if(isset($_REQUEST['selected']))
{
    if($_REQUEST['selected'] == "student")
    {
        $employeeController->studentsView();
    }
    else if($_REQUEST['selected'] == "teacher")
    {
        $employeeController->teachersView();
    }
    else if($_REQUEST['selected'] == "parent")
    {
        $employeeController->parentsView();
    }
    else if($_REQUEST['selected'] == "additem")
    {
      $employeeController->createItemView();
    }
    else if($_REQUEST['selected'] == "fatora")
    {
      $employeeController->createBillView($factory->createObject("itemModel"));
    }
    else if($_REQUEST['selected'] == "bills")
    {
      $employeeController->searchBillsView();
    }
    
}

if(isset($_POST['displayStudentBill']))
{
    $employeeController->displayStudentBillView();
}

if(isset($_POST['nameSearchInput']))
{
    $employeeController->nameSearchInputView();
}

if(isset($_REQUEST['studentname']))
{
  $employeeController->searchWithNameStudentsView();
}
else if(isset($_REQUEST['teachername']))
{
  $employeeController->searchWithNameTeachersView();
}
else if(isset($_REQUEST['parentname']))
{
  $employeeController->searchWithNameParentsView();
}

if(isset($_REQUEST['id']) && !isset($_REQUEST['action']))
{
    $employeeController->displaySpecificUserView();
}

if(isset($_POST['accept']))
{
    $employeeController->acceptUserView();
}

if(isset($_POST['delete']))
{
    /*$query1 = "DELETE FROM users  WHERE id = $id";
    $query2 = "DELETE FROM address  WHERE user_id = $id";
    $query3 = "DELETE FROM identity_images  WHERE user_id = $id";
    $query4 = "DELETE FROM phone_numbers  WHERE user_id = $id";
    $query5 = "DELETE FROM students_data  WHERE user_id = $id";
    if($mydb->query($query1) !== true || $mydb->query($query2) !== true || $mydb->query($query3) !== true || $mydb->query($query4) !== true || $mydb->query($query5) !== true)
    {
        die("Something went wrong.");
    }
    else
    {
        $encID = $_REQUEST['access'];
        $url = $employees[0]->link."?access=".$encID."&page=home";
        header("location:$url");
    }*/
    $employeeController->deleteUserView();
}

if(isset($_POST['reActivate']))
{
    $employeeController->reactivateUserView();
}

if(isset($_REQUEST['action']))
{
    $users = $employeeModel->selectAllUsers();
    $userType = 0;
        $userObj = null;
        for($i = 0; $i < count($users); $i++)
        {
            if($users[$i]->id == $_REQUEST['id'])
            {
                $userType = $users[$i]->user_type;
                $userObj = $users[$i];
                break;
            }
        }

    if($_REQUEST['action'] == "studentregistration")
    {
        $employeeController->studentsRegistrationView($userObj, $semesterModel->selectAllSemesters());
    }

    if($_REQUEST['action'] == "subjectregistrationForStudents")
    {
        $employeeController->subjectsRegistrationForStudentsView($userObj, $subjectsModel->selectAllSubjects(), $factory->createObject("registrationModel"), $factory->createObject("registrationDetailsModel"));
    }
    else if($_REQUEST['action'] == "subjectregistrationForTeachers")
    {
        $employeeController->subjectsRegistrationForTeachersView($userObj, $subjectsModel->selectAllSubjects());
    }

    if($_REQUEST['action'] == "studentcertificate")
    {
        $employeeController->studentCertificateView();
    }
}

if(isset($_REQUEST['StudentIdBill']) && isset($_REQUEST['selected']))
{
    if($_REQUEST['selected'] == "bills")
    {
        /*for($i = 0; $i < count($bill); $i++)
        {
            //$total += $bill[0][$i]->netamount;
        }*/
        $employeeController->generateBillView();
    }
}

if(isset($_POST['itemadd']))
{
   $employeeController->addItemView($factory->createObject("itemModel"));
}

if(isset($_POST['createbill']))
{
  $employeeController->createBill2View($factory->createObject("registrationModel"), $factory->createObject("itemModel"), $factory->createObject("registrationItemDetailsModel"));
  //echo "<div class='text-success' style='text-align:center; margin-top:30px; margin-bottom: 60px; '>Successfully Created</div>";   
  //NEED TO MAKE SURE IT HAS SUCCEDDED
}
?>


</body>
</html>
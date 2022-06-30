<?php 
    require_once '../View/studentView.php';
    require_once 'finalGrade.php';
    require_once 'assignmentGrade.php';
    require_once 'quizGrade.php';
    require_once 'projectGrade.php';
    require_once '../Model/studentModel.php';
    require_once '../../gradingMethodModel.php';
    require_once '../../semesterModel.php';
    require_once '../../systemLog.php';
    require_once '../../notificationModel.php';
    require_once '../../userModel.php';
    require_once '../../lookup.php';
    require_once '../../registrationModel.php';
    require_once '../../bus.php';
    if(session_status() == PHP_SESSION_NONE){session_start();} 
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
    <link rel="stylesheet" type="text/css" href="http://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
    <script src="https://kit.fontawesome.com/4733528720.js" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css"/>

    <title>Student Dashboard</title>

</head>

<body>

<?php

class StudentController
{
    public $studentView;

    public function __construct()
    {
        $this->studentView = new StudentView();
    }
    
    public function subjectsGradesView($studentModel)
    {
        $studentSubjects = $studentModel->getSubjects();
            $overallGrades = array();
            for($i = 0; $i < count($studentSubjects); $i++)
            {
                $finalGradeModel = new FinalGrade($studentSubjects[$i]->id);
                $finalGradeModel = new Assignment($finalGradeModel, $studentSubjects[$i]->id);
                $finalGradeModel = new Quiz($finalGradeModel, $studentSubjects[$i]->id);
                $finalGradeModel = new Project($finalGradeModel, $studentSubjects[$i]->id);
                $overallGrades[] = $finalGradeModel->upgradeGrade();
            }
           
            
            $gradingMethodModel = new GradingMethod();
            $gradingMethods = $gradingMethodModel->getFromDB();
        
            $this->studentView->showSubjectsWithGrades($studentSubjects, $overallGrades, $gradingMethods);
            new SystemLog("Student Viewed His Grades", $_SESSION['loggedId']);
    }

    public function notificationPageView()
    {
        $notifyObj = new NotificationModel();
        $id = $_SESSION['loggedId'];
        $this->studentView->ShowNotification($notifyObj->fetchAll("WHERE user_id = $id"));
    }

    public function myIDView($studentModel, $semesterModel, $regModel, $user, $lookUp)
    {
            $semesterName = $semesterModel->selectSemesterWithName($_SESSION['loggedId']);
            $regDate = $regModel->fetchDate($_SESSION['loggedId']);
            $qrLink = $lookUp->fetchRows("*", "qr_link");
            $user->assignAll("WHERE id=".$_SESSION['loggedId']);
            if($studentModel->checkIfRegistered())
                $this->studentView->MyIdPage($qrLink[0]->name, $semesterName, $user->usersArray[0], $studentModel->decryptImage($user->usersArray[0]->face_image), $regDate);
            else
                $this->studentView->notRegisteredErrorInIdPage();
    }

    public function registerInBusView($busModel)
    {
        $busesArray = $busModel->fetchAllBuses();
        if(!$checkIfRegistered = $busModel->checkIfStudentRegistered($_SESSION['loggedId']))
            $checkIfRegistered = -1;
        else
            $checkIfRegistered = $checkIfRegistered['bus_id'];

        $this->studentView->registerInBus($busesArray, $checkIfRegistered);
    }

    public function dashboardView($studentModel, $user)
    {
        $notifyObj = new NotificationModel();
        $id = $_SESSION['loggedId'];
        $this->studentView->displayDashboardPage($user->fetchName($id), $studentModel->getSemesterName(new SemesterModel()), $notifyObj->fetchAll("WHERE user_id = $id AND IsRead = 0"));
    }
}

$studentController = new StudentController();

if(isset($_REQUEST['selected']))
    {
        if($_REQUEST['selected'] == "SubjectsGrades")
        {
            $studentController->subjectsGradesView(new Student);
            
        }
        if($_REQUEST['selected'] == "NotificationPage")
        {
           $studentController->notificationPageView();
        }

        if($_REQUEST['selected'] == "MyID")
        {
            $studentController->myIDView(new Student, new SemesterModel, new RegistrationModel, new user, new LookUp);
        }

        if($_REQUEST['selected'] == "RegisterInBus")
        {
           $studentController->registerInBusView(new Bus);
        }
    }
    else
    {
        $studentController->dashboardView(new Student, new user);
    }
?>

</body>


</html>
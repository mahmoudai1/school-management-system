<?php
  require_once '../Model/TeacherModel.php';
  require_once '../View/TeacherView.php';
  require_once '../../subjectsModel.php';
  require_once '../../userModel.php';
  require_once '../../gradingMethodModel.php';
  require_once '../../systemLog.php';
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

     <title>Teacher Dashboard</title>

 </head>
   <body>
<?php

class TeacherController
{
  public function homepageView($teacherView)
  {
    $teacherView->homePage();
  }

  public function selectSubjectsAndStudentsView($subjectModel, $teacherView)
  {
    if(isset($_SESSION["loggedId"]))
      {
        $subjectModel->selectTeacherSubjects($_SESSION["loggedId"]);
        $teacherView->showSubjectsAndStudentsPage($subjectModel->subjectsArray);
        if(isset($_POST["displayStudents"]))
        {
          $selectedSubject = explode(" ", $_POST['selectedSubject']);
          $studentsWithSpecificSubject = $subjectModel->getStudentsWithSpecificSubject($selectedSubject[0]);
          $tempSubjectModel = new SubjectModel();
          $whichSubjectSelected = $tempSubjectModel->selectSpecificSubject($selectedSubject[0]);
          $gradingMethod = new GradingMethod();
          $teacherView->displayStudents($selectedSubject[0], $whichSubjectSelected, $studentsWithSpecificSubject, $gradingMethod->getFromDB());
        }
      }
      else
      {
        echo "You're not logging in an ethical way.";
      }
  }

  public function addHomeworkView($teacherView, $subjectModel, $teacherModel)
  {
    $teacherView->homeworkPage($subjectModel->selectTeacherSubjects($_SESSION['loggedId']));
    if(isset($_POST['next']))
        {
          $hwDegree = $_POST['HWdegree'];
          $hwDetails = $_POST['HWdetails'];
          $hwTitle = $_POST['HWtitle'];
          $hwDeadline = $_POST['deadline'];
          $image = 'test';              //TEMP FOR NOW
          $subjectId = explode(" ", $_POST['selectedSubject']);
          $teacherModel->addHomeWork($subjectId[0], $hwTitle, $hwDegree, $hwDetails, $image, $hwDeadline);
          new SystemLog("Teacher Add Homework", $_SESSION['loggedId']);
        }
  }
}

$teacherController = new TeacherController();
$teacherView = new TeacherView();
$teacherModel = new TeacherModel();
$subjectModel = new SubjectModel();

  if(isset($_REQUEST['page']))
  {
    if($_REQUEST['page'] == "Home")
    {
      $teacherController->homepageView($teacherView);
    }

    if($_REQUEST['page'] == "SelectSubjectAndStudent")
    {
      $teacherController->selectSubjectsAndStudentsView($subjectModel, $teacherView);
    }

    if($_REQUEST['page']=="AddHw")
    {
      $teacherController->addHomeworkView($teacherView, $subjectModel, $teacherModel);
    }

    else if($_REQUEST['page']=="AddExam")
    {

    }

    else if($_REQUEST['page']=="CorrectHomeWork")
    {

    }
  }


  

  if(isset($_REQUEST['step']))
  { 
    //$teacherView->displayQuestionsStep();   LATER ---
  }

  ?>
  </body>
</html>

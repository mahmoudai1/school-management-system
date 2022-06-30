<?php 
    require_once '../View/parentView.php';
    require_once '../../lookup.php';
    require_once 'paymentOptions.php';
    require_once '../Model/parentModel.php';
    require_once '../../regItemDetailsModel.php';
    require_once '../../semesterModel.php';
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
    <title>Parent Dashboard</title>

</head>

<body>


<?php

class ParentController
{
    public function displayDashboardView($parentView)
    {
        $parentView->displayDashboardPage();
    }

    public function payFeesView($lookUp, $parentView, $semesterModel, $parentModel)
    {
        $parentView->payFeesPage($lookUp->fetchRows("*", "payment_method"));
            if(isset($_POST['payNow']))
            {
                $optionValueArr = $_POST['optionValue'];
                $optionIdArr = $_POST['optionId'];
                $methodIdArr = $_POST['methodId'];
                $studentId = $_POST['studentId'];
                $fees = $semesterModel->selectSemesterWithFees($studentId);
                $f = 1;
                for($i = 0; $i < count($optionValueArr); $i++)
                {
                    if(!$parentModel->insertNewFees($methodIdArr[$i], $optionIdArr[$i], $optionValueArr[$i], $studentId))
                        {
                            $f = 0;
                            break;
                        }
                }
                if($f == 1)
                    $parentView->showMsgAfterPay(1, $fees);
                else
                    $parentView->showMsgAfterPay(0, $fees);
            }
    }
}
    

    $parentView = new ParentView();
    $parentModel = new ParentModel();
    $regItemDet = new RegItemDetModel();
    $semesterModel = new SemesterModel();
    $lookUp = new LookUp();
    $parentController = new ParentController();

    if(isset($_REQUEST['page']))
    {
        if($_REQUEST['page'] == "Home")
        {
            $parentController->displayDashboardView($parentView);
        }

        if($_REQUEST['page'] == "PayFees")
        {
            $parentController->payFeesView($lookUp, $parentView, $semesterModel, $parentModel);
        }
    }
?>


</body>


</html>
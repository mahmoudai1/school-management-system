<?php
    require_once 'modules/userModel.php';
    $userObj = new user();

    if(isset($_POST['check']))
    {
        $applicationNumber = $_POST['applicationNumber'];
        $userObj->checkApplicationStatus($applicationNumber);
       
    }

?>
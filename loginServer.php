<?php
    require_once 'modules/userModel.php';
    $userObj = new user();
    $id = "";
    $password = "";

    if(isset($_POST['login']))
    {
        $id = $_POST['id'];
        $password = $_POST['password'];
        $userObj->checkUserInDB($id, $password);
    }

    

?>
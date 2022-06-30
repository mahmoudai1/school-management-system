<?php
     
     if(session_status() == PHP_SESSION_NONE){session_start();}
     require_once 'modules/userModel.php';
     $userObj = new user();


    $frontFaceImg = $_FILES['frontFaceImg']['name'] ?? "";
    $target1 = "resources/images/FrontFace/".date("Y-m-d_h-i-sa")."_".basename($frontFaceImg);
    $image1FileType = strtolower(pathinfo($target1,PATHINFO_EXTENSION));

    $birthCertificateImg = $_FILES['birthCertificateImg']['name'] ?? "";
    $target2 = "resources/images/BirthCertificate/".date("Y-m-d_h-i-sa")."_".basename($birthCertificateImg);
    $image2FileType = strtolower(pathinfo($target2,PATHINFO_EXTENSION));

    $identityFrontImg = $_FILES['identityFrontImg']['name'] ?? "";
    $target3 = "resources/images/IdentityFront/".date("Y-m-d_h-i-sa")."_".basename($identityFrontImg);
    $image3FileType = strtolower(pathinfo($target3,PATHINFO_EXTENSION));

    $identityBackImg = $_FILES['identityBackImg']['name'] ?? "";
    $target4 = "resources/images/IdentityBack/".date("Y-m-d_h-i-sa")."_".basename($identityBackImg);
    $image4FileType = strtolower(pathinfo($target4,PATHINFO_EXTENSION));


    $firstName = "";
    $secondName = "";
    $thirdName = "";
    $email = "";
    $phoneNumber1 = "";
    $phoneNumber2 = "";
    $password = "";
    $confirmPassword = "";
    $city = "";
    $state = "";
    $zip = "";
    $gender = "";
    $dob = "";
    $accepted = 0;
    $application_number = 0;

    if(isset($_POST['apply']))
    {
         $firstName = $_POST['firstName'];
         $secondName = $_POST['secondName'];
         $thirdName = $_POST['thirdName'];
         $email = $_POST['email'];
         $phoneNumber1 = $_POST['phoneNumber1'];
         $phoneNumber2 = $_POST['phoneNumber2'];
         $password = $_POST['password'];
         $confirmPassword = $_POST['confirmPassword'];
         $city = $_POST['city'];
         $state = $_POST['state'];
         $zip = $_POST['zip'];
         $gender = $_POST['selectedGender'];
         $dob = $_POST['dob'];

         $userObj->createAccount($firstName, $secondName, $thirdName, $email, $phoneNumber1, $phoneNumber2, $password, $confirmPassword, $city, $state, $zip, $gender, $dob, $accepted, $application_number,
         $frontFaceImg, $target1, $image1FileType, 
         $birthCertificateImg, $target2, $image2FileType,
         $identityFrontImg, $target3, $image3FileType,
         $identityBackImg, $target4, $image4FileType);
    }

    
?>
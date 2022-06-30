<?php
    require_once 'assignInterface.php';
    include_once 'DB.php';
    require_once 'strategyFactory.php';
    require_once 'systemLog.php';
    
    if(session_status() == PHP_SESSION_NONE){session_start();}

    
    
    class user
    {
        public $id;
        public $user_type;
        public $first_name;
        public $second_name;
        public $third_name;
        public $dob;
        public $password;
        public $email;
        public $gender;
        public $date_created;
        public $accepted;
        public $isDeleted;
        public $application_number;
        public $phone_number1;
        public $phone_number2;
        public $city;
        public $state;
        public $zip;
        public $face_image;
        public $birth_certificate;
        public $identity_front;
        public $identity_back;
        public $mydb;
        public $link;


        public $usersArray = array();

        // to help subjectsModel in its function
        public $grade = array();
        public $gradeMethod = array();

        function __construct()
        {
            $this->mydb = DB::getInstance();
        }

        public function assignAll($condition='')
        {
            $selected1 = $this->select("*", "users u", $condition, 'ORDER BY first_name, second_name, third_name, id');
            while($row1 = mysqli_fetch_assoc($selected1))
            {
                $usersObj = new user();

                $this->assignUsersAttributes($row1, $usersObj);

                $selected2 = $this->select("*", "phone_numbers", "WHERE user_id = ".$usersObj->id);
                $pn = 1;
                while($row2 = mysqli_fetch_assoc($selected2))
                {
                    $this->assignNumberAttributes($pn, $row2, $usersObj);
                    $pn = 2;
                }

                $selected3 = $this->select("*", "address", "WHERE user_id = ".$usersObj->id);
                $rowsArray = array();
                while($row3 = mysqli_fetch_assoc($selected3))
                {
                    $rowsArray[] = $row3;
                }
                $this->assignAddressAttributes($rowsArray, $usersObj);

                $selected4 = $this->select("*", "identity_images", "WHERE user_id = ".$usersObj->id);
                while($row4 = mysqli_fetch_assoc($selected4))
                    $this->assignImagesAttributes($row4, $usersObj);

                $selected5 = $this->select("*", "user_type_links", "WHERE user_type_id = ".$usersObj->user_type);
                while($row5 = mysqli_fetch_assoc($selected5))
                    $this->assignLinksAttributes($row5, $usersObj);

                array_push($this->usersArray, $usersObj);
            }

            
        }

        public function fetchName($id)
        {
            $query = "SELECT first_name, second_name, third_name FROM users WHERE id = $id";
            $queryResult = mysqli_query($this->mydb, $query);
            return $rows = mysqli_fetch_assoc($queryResult);
        }

        public function select($which, $tableName, $condition = '', $order = '')
        {
            $selectQuery = "SELECT $which FROM $tableName $condition $order";
            $selectQueryResult = mysqli_query($this->mydb, $selectQuery);
            return $selectQueryResult;
        }

        public function assignUsersAttributes($row, $usersObj)
        {
                $usersObj->id = $row['id'];
                $usersObj->user_type = $row['user_type'];
                $usersObj->first_name = $row['first_name'];
                $usersObj->second_name = $row['second_name'];
                $usersObj->third_name = $row['third_name'];
                $usersObj->dob = $row['dob'];
                $usersObj->password = $row['password'];
                $usersObj->email = $row['email'];
                $usersObj->gender = $row['gender'];
                $usersObj->date_created = $row['date_created'];
                $usersObj->accepted = $row['accepted'];
                $usersObj->isDeleted = $row['isDeleted'];
                $usersObj->application_number = $row['application_number'];
        }

        public function assignNumberAttributes($pn, $row, $usersObj)
        {
            if($pn == 1)
                $usersObj->phone_number1 = $row['number'];
            else
                $usersObj->phone_number2 = $row['number'];
        }

        public function assignAddressAttributes($rowsArray, $usersObj)      // SELF REFERENCE VALUE - PARENT ID - SELECTION
        {
            for($i = 0; $i < count($rowsArray); $i++)
            {
                switch($i){
                    case 0:
                        $usersObj->city = $rowsArray[$i]['name'];
                        break;
                    case 1:
                        if($rowsArray[$i - 1]['id'] == $rowsArray[$i]['parent_id'])
                           $usersObj->state = $rowsArray[$i]['name'];
                        break;
                    case 2:
                        if($rowsArray[$i - 1]['id'] == $rowsArray[$i]['parent_id'])
                            $usersObj->zip = $rowsArray[$i]['name'];
                     break;
                }
            }
            
        }

        public function assignImagesAttributes($row, $usersObj)
        {
                $usersObj->face_image = $row['face_image'];
                $usersObj->birth_certificate = $row['birth_certificate'];
                $usersObj->identity_front = $row['identity_front'];
                $usersObj->identity_back = $row['identity_back'];
        }

        public function assignLinksAttributes($row, $usersObj)
        {
                $usersObj->link = $row['link'];
        }

        public function createAccount($firstName, $secondName, $thirdName, $email, $phoneNumber1, $phoneNumber2, $password, $confirmPassword, $city, $state, $zip, $gender, $dob, $accepted, $application_number,
                                        $frontFaceImg, $target1, $image1FileType, 
                                        $birthCertificateImg, $target2, $image2FileType,
                                        $identityFrontImg, $target3, $image3FileType,
                                        $identityBackImg, $target4, $image4FileType)
        {
                if (strpos($password, "'") === false && strpos($confirmPassword, "'") === false
            && !empty($firstName) && !empty($secondName) && !empty($thirdName) && !empty($email) && !empty($phoneNumber1) && !empty($password)
            && !empty($city) && !empty($state) && !empty($zip))
            {
            if($password == $confirmPassword || true)              // need to be changed ----
            {
                if($gender == "Male")
                        $gender = 0;
                else
                        $gender = 1;
                
                $enc_pwd = $this->pwdEncryption($password);
                $application_number = $this->generateRandomNumber();
                $_SESSION['app_no'] = $application_number;

                $user_type = 0;
                if($_REQUEST['type'] == "teacher")
                {
                        $user_type = 2;
                }
                else if($_REQUEST['type'] == "student")
                {
                        $user_type = 3;
                }
                else if($_REQUEST['type'] == "parent")
                {
                        $user_type = 4;
                }

                $insertUsersQuery = "INSERT INTO users (user_type, first_name, second_name, third_name, email, password, gender, dob, accepted, application_number, isDeleted) 
                                VALUES ($user_type, '$firstName', '$secondName', '$thirdName', '$email', '$enc_pwd', $gender, '$dob', $accepted, '$application_number', 0)";
                if($this->mydb->query($insertUsersQuery) !== true)
                {
                        echo "Something went wrong -> ";
                        die(mysqli_error($this->mydb));
                }
                else
                {
                        $tempSelectQuery = "SELECT id FROM users WHERE email = '$email'";
                        $tempSelectQueryResult = mysqli_query($this->mydb, $tempSelectQuery);
                        $tempRow = $tempSelectQueryResult ->fetch_assoc();
                        $userId = $tempRow['id'];
                        $addressArray = [$city, $state, $zip];

                        if(!$this->phoneNumberInsertion($userId, $phoneNumber1, $phoneNumber2) || 
                        !$this->addressInsertion($userId, $addressArray) ||
                        !$this->imagesInsertion($userId, $frontFaceImg, $birthCertificateImg, $identityFrontImg, $identityBackImg, $target1, $target2, $target3, $target4,
                        $image1FileType, $image2FileType, $image3FileType, $image4FileType))
                        {
                            $deleteQuery = "DELETE FROM address WHERE user_id = $userId";
                            if($this->mydb->query($deleteQuery) !== true)
                            {
                                die(mysqli_error($this->mydb));
                            }
                            $deleteQuery = "DELETE FROM phone_numbers WHERE user_id = $userId";
                            if($this->mydb->query($deleteQuery) !== true)
                            {
                                die(mysqli_error($this->mydb));
                            }
                            $deleteQuery = "DELETE FROM identity_images WHERE user_id = $userId";
                            if($this->mydb->query($deleteQuery) !== true)
                            {
                                die(mysqli_error($this->mydb));
                            }
                            $deleteQuery = "DELETE FROM users WHERE id = $userId";
                            if($this->mydb->query($deleteQuery) !== true)
                            {
                                die(mysqli_error($this->mydb));
                            }
                            die("Something went wrong.");
                        }

                    }
                }
                else
                {
                    echo "Passwords do not match.";
                }
            }
            else
            {
                echo "Something went wrong.";
            }
        }

        public function employeeLogin($id, $password)
        {
            
            if(!empty($id) && !empty($password))
            {
                if(strpos($id, "'") === false && strpos($id, "'") === false)
                {
                    $password = $this->pwdEncryption($password);
                    $selectQuery = "SELECT id, user_type, password FROM users WHERE id = $id AND password = '$password' AND user_type = 1";
                    $selectQueryResult = mysqli_query($this->mydb, $selectQuery);
                    $row = mysqli_fetch_assoc($selectQueryResult);
                    if(mysqli_num_rows($selectQueryResult))
                    {
                        $userId = $row['id'];
                        $userTypeId = $row['user_type'];
                        $selectQuery = "SELECT link FROM user_type_links WHERE user_type_id = $userTypeId";
                        $selectQueryResult = mysqli_query($this->mydb, $selectQuery);
                        $row = mysqli_fetch_assoc($selectQueryResult);
                        $url = $row['link'];
                        
                        ?>
                        <div style="color:green">
                            <?php echo "Redirecting..."; ?>
                        </div>
                            <?php
                            $accessCode = $this->pwdEncryption($password);
                            $_SESSION['loggedId'] = $userId;
                            new SystemLog("Employee Login", $userId);
                        header( "refresh:1;url=$url?access=$accessCode&page=home");
                    }
                    else
                    {
                        ?>
                        <div style="color:red">
                            <?php echo "Invalid id or password"; ?>
                        </div>
                            <?php
                    }
                }
            }
        }

        public function checkApplicationStatus($applicationNumber)
        {
            if(!empty($applicationNumber) && $applicationNumber != "" && $applicationNumber != null)
            {
                if(strpos($applicationNumber, "'") === false)
                {
                    $selectQuery = "SELECT * FROM users WHERE application_number = $applicationNumber";
                    $selectQueryResult = mysqli_query($this->mydb, $selectQuery);
                    $row = $selectQueryResult -> fetch_assoc();
                    $noOfRows = mysqli_num_rows($selectQueryResult);
                    if($noOfRows == 1)
                    {
                        if($row['accepted'] == 0)
                        {
                            ?> <div style="text-align: center;">
                                    <?php
                                        echo 'This application still in the review. Please try again later.';
                                    ?>
                                </div>
                            <?php
                        }
                        else if($row['accepted'] == 1)
                        {
                            ?> <div style="text-align: center;">
                                    <?php
                                        echo 'You have been '?><strong>ACCEPTED!</strong><?php echo ' Your ID = '?><strong><?php echo $row['id'] ?></strong><br>
                                        <div style="margin-top:8px;">
                                            <?php echo ' Press ' ?> <a href="login.php">here</a> <?php echo ' to Login';?>
                                        </div>
                                </div>
                            <?php
                        }
                    }
                    else
                    {
                        ?> <div style="text-align: center;">
                                    <?php
                                        echo 'Application number not exist.';
                                    ?>
                                </div>
                            <?php
                    }
                }
                else
                {
                    echo "Your input should not include this sympol -> '";
                }
            }
        }

        public function checkUserInDB($id, $password, StrategyFactory $factory = null) 
        {
            $factory = new StrategyFactory();
            if(!empty($id) && !empty($password))
            {
                if(strpos($id, "'") === false && strpos($id, "'") === false)
                {
                    $password = $this->pwdEncryption($password);
                    $selectQuery = "SELECT id, user_type, password FROM users WHERE id = $id AND password = '$password' AND accepted = 1 AND isDeleted = 0";
                    $selectQueryResult = mysqli_query($this->mydb, $selectQuery);
                    $row = mysqli_fetch_assoc($selectQueryResult);
                    
                    if(mysqli_num_rows($selectQueryResult))
                    {
                        $userTypeId = $row['user_type'];
                        $selectQuery = "SELECT link FROM user_type_links WHERE user_type_id = $userTypeId";
                        $selectQueryResult = mysqli_query($this->mydb, $selectQuery);
                        $row = mysqli_fetch_assoc($selectQueryResult);
                        //$url = $row['link'];
                        
                        ?>
                        <div style="color:green">
                            <?php echo "Redirecting..."; ?>
                        </div>
                            <?php
                        
                        $_SESSION['loggedId'] = $id;
                        $loginCredentials = $factory->createObject("loginCredentials");
                        switch($userTypeId){
                            case 2:
                            $loginCredentials->setCredentials($factory->createObject("Teacher"));
                            break;

                            case 3:
                            $loginCredentials->setCredentials($factory->createObject("Student"));
                            break;

                            case 4:
                            $loginCredentials->setCredentials($factory->createObject("Parent"));
                            break;
                        }

                        new SystemLog("User Login", $id);
                    }
                    else
                    {
                        ?>
                        <div style="color:red">
                            <?php echo "Invalid id or password"; ?>
                        </div>
                            <?php
                    }
                }
            }
        }

        public function pwdEncryption($strng)
        {
            $ciphering = "AES-128-CTR";
            
            $iv_length = openssl_cipher_iv_length($ciphering); 
            $options = 0; 
            
            $encryption_iv = '1234567891011121';
            
            $encryption_key = "OOpse314*%*";
            $encryption = openssl_encrypt($strng, $ciphering,  $encryption_key, $options, $encryption_iv); 

            return $encryption;
        }

        public function generateRandomNumber()
        {
            for(;;)
            {
                $application_number_inwork = "";
                for($i = 0; $i < 12; $i++)
                {
                        $application_number_inwork .= rand(0,9);
                }
                $query = "SELECT * FROM users WHERE application_number='$application_number_inwork'";
                $queryResult = mysqli_query($this->mydb, $query);
                if(mysqli_num_rows($queryResult) == 0)
                        break;
            }
            return $application_number_inwork;

        }

        public function phoneNumberInsertion($userId, $phoneNumber1, $phoneNumber2)
        {
            if($phoneNumber2 == "")
                {
                        $insertPhoneQuery = "INSERT INTO phone_numbers (user_id, number) VALUES ($userId, '$phoneNumber1')";
                        if($this->mydb->query($insertPhoneQuery) !== true)
                            return false;
                        else
                            return true;
                }
                else
                {
                        $insertPhoneQuery = "INSERT INTO phone_numbers (user_id, number) VALUES ($userId, '$phoneNumber1')";
                        if($this->mydb->query($insertPhoneQuery) !== true)
                            return false;
                        else
                            return true;

                        $insertPhoneQuery = "INSERT INTO phone_numbers (user_id, number) VALUES ($userId, '$phoneNumber2')";
                        if($this->mydb->query($insertPhoneQuery) !== true)
                            return false;
                        else
                            return true;
                }
        }

        public function addressInsertion($userId, $addressArray)    // SELF REFERENCE VALUE - PARENT ID - INSERTION
        {
            $ct = 0;
            for($i = 0; $i < count($addressArray); $i++)
            {
                if($i == 0)
                    $parentId = 0;

                $name = $addressArray[$i];
                $query = "INSERT INTO address (user_id, name, parent_id) VALUES ($userId, '$name', $parentId)";
                if($this->mydb->query($query) !== true)
                {
                    echo mysqli_error($this->mydb);
                    return false;
                }
                else
                {
                    $ct++;
                }

                $query2 = "SELECT id FROM address WHERE user_id = $userId ORDER BY id DESC LIMIT 1";
                $query2Result = mysqli_query($this->mydb, $query2);
                $row = mysqli_fetch_assoc($query2Result);
                $parentId = $row['id'];
            }
            
            if($ct == count($addressArray))
                return true;
            
        }

        public function imagesInsertion($userId, $frontFaceImg, $birthCertificateImg, $identityFrontImg, $identityBackImg, $target1, $target2, $target3, $target4,
        $imageFileType1, $imageFileType2, $imageFileType3, $imageFileType4)
        {
            if($_REQUEST['type'] == "student")
            {
                if($frontFaceImg != null && $frontFaceImg != ""
                && $birthCertificateImg != null && $birthCertificateImg != "")
                {
                        $frontFaceImg = $this->pwdEncryption($target1);
                        $birthCertificateImg = $this->pwdEncryption($target2);

                        $insertImagesQuery = "INSERT INTO identity_images (user_id, face_image, birth_certificate) VALUES ($userId, '$frontFaceImg', '$birthCertificateImg')";
                        if(($imageFileType1 == "jpg" || $imageFileType1 == "png" || $imageFileType1 == "jpeg")
                        && ($imageFileType2 == "jpg" || $imageFileType2 == "png" || $imageFileType2 == "jpeg"))  
                        {
                            if($_FILES['frontFaceImg']['size'] <  3000000 && $_FILES['birthCertificateImg']['size'] <  3000000 ) {
                                if (move_uploaded_file($_FILES['frontFaceImg']['tmp_name'], $target1) 
                                    && move_uploaded_file($_FILES['birthCertificateImg']['tmp_name'], $target2) ) 
                                {
                                    if ($this->mydb->query($insertImagesQuery) !== true)
                                            return false;
                                    else
                                            return true;
                                }
                                else
                                {
                                    echo "Failed to upload image";
                                }
                            }
                            else
                            {
                                echo 'Files size should be less than or equal 3mb';
                            }
                        }
                        else
                        {
                            echo "Sorry, only JPG, JPEG, PNG files are allowed.";
                        }
                }
            }
            else
            {
                if($frontFaceImg != null && $frontFaceImg != ""
                && $identityFrontImg != null && $identityFrontImg != ""
                && $identityBackImg != null && $identityBackImg != "")
                {
                        $frontFaceImg = $this->pwdEncryption($target1);
                        $identityFrontImg = $this->pwdEncryption($target3);
                        $identityBackImg = $this->pwdEncryption($target4);

                        $insertImagesQuery = "INSERT INTO identity_images (user_id, face_image, identity_front, identity_back) VALUES ($userId, '$frontFaceImg', '$identityFrontImg', '$identityBackImg')";
                        if(($imageFileType1 == "jpg" || $imageFileType1 == "png" || $imageFileType1 == "jpeg")
                        && ($imageFileType3 == "jpg" || $imageFileType3 == "png" || $imageFileType3 == "jpeg")
                        && ($imageFileType4 == "jpg" || $imageFileType4 == "png" || $imageFileType4 == "jpeg"))  
                        {
                            if($_FILES['frontFaceImg']['size'] <  3000000 && $_FILES['identityFrontImg']['size'] <  3000000
                            && $_FILES['identityBackImg']['size'] <  3000000) {
                                if (move_uploaded_file($_FILES['frontFaceImg']['tmp_name'], $target1)
                                    && move_uploaded_file($_FILES['identityFrontImg']['tmp_name'], $target3)
                                    && move_uploaded_file($_FILES['identityBackImg']['tmp_name'], $target4))
                                {
                                    if ($this->mydb->query($insertImagesQuery) !== true)
                                            return false;
                                    else
                                            return true;
                                }
                                else
                                {
                                    echo "Failed to upload image";
                                }
                            }
                            else
                            {
                                echo 'Files size should be less than or equal 3mb';
                            }
                        }
                        else
                        {
                            echo "Sorry, only JPG, JPEG, PNG files are allowed.";
                        }
                }
            }
        }
    }
    
?>
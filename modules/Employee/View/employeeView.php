<?php
    require_once '../Model/employeeModel.php';

    class EmployeeView
    {
        public $employeeModel;
        public $employees;
        public $url;
        public $encID;
        public $imageURL;
        
        function __construct()
        {
            $this->employeeModel = new EmployeeModel();
            $this->employees = $this->employeeModel->selectAllEmployees();
            $this->encID = $_REQUEST['access'];
            $this->url = $this->employees[0]->link."?access=".$this->encID;
            $this->imageURL = "../../../";
        }

        public function showAllTypes($noOfStudents, $noOfTeachers, $noOfParents)
        {
            echo "<h1 style='text-align:left; margin-left:40px; margin-top:40px; margin-bottom: 100px;'>Employee cPanel</h1>";
            ?>

            <div style="width:100%;">
                <div class="d-flex justify-content-center" style="margin: 0 auto;">
                    <div class="col-sm-3">
                        <div class="card text-white bg-success mb-3">
                        <div class="card-body">
                            <h3 class="card-title"><?php echo $noOfStudents ?></h3>
                            <i class="ion-ios-people" style="font-size:30px;"></i>
                            <p class="card-text">Total Number of Students.</p>
                        </div>
                        </div>
                    </div>
                    <div class="col-sm-3">
                        <div class="card text-white bg-danger mb-3">
                        <div class="card-body">
                            <h3 class="card-title"><?php echo $noOfTeachers ?></h3>
                            <i class="ion-person-stalker" style="font-size:30px;"></i>
                            <p class="card-text">Total Number of Teachers.</p>
                        </div>
                        </div>
                    </div>
                    <div class="col-sm-3">
                        <div class="card text-white bg-primary mb-3">
                        <div class="card-body">
                            <h3 class="card-title"><?php echo $noOfParents ?></h3>
                            <i class="ion-ios-person" style="font-size:30px;"></i>
                            <p class="card-text">Total Number of Parents.</p>
                        </div>
                        </div>
                    </div>
                
                </div>

                <div style="width: 75%; margin: 0 auto;">
                    <div class="d-flex justify-content-center" style="margin-top: 50px;">
                            <div class="col-sm-2" style="text-align:center;">
                                <a href="<?php echo $this->url ?>&selected=student">
                                    <button type="button" class="btn btn-outline-dark" style="width: 180px; padding: 15px 0;">
                                        <i class="ion-ios-people" style="font-size:50px;"></i>
                                        <p class="card-text">Students</p>
                                    </button>
                                </a>
                            </div>
                    

                            <div class="col-sm-2" style="text-align:center;">
                                <a href="<?php echo $this->url ?>&selected=teacher">
                                    <button type="button" class="btn btn-outline-dark" style="width: 180px; padding: 15px 0;">
                                        <i class="ion-person-stalker" style="font-size:50px;"></i>
                                        <p class="card-text">Teachers</p>
                                    </button>
                                </a>
                            </div>

                            <div class="col-sm-2" style="text-align:center;">
                                <a href="<?php echo $this->url ?>&selected=parent">
                                    <button type="button" class="btn btn-outline-dark" style="width: 180px; padding: 15px 0;">
                                        <i class="ion-ios-person" style="font-size:50px;"></i>
                                        <p class="card-text">Parents</p>
                                    </button>
                                </a>
                            </div>

                            <div class="col-sm-2" style="text-align:center;">
                                <a href="<?php echo $this->url ?>&page=addsubjects">
                                    <button type="button" class="btn btn-outline-dark" style="width: 180px; padding: 15px 0;">
                                        <i class="ion-android-funnel" style="font-size:50px;"></i>
                                        <p class="card-text">Subjects</p>
                                    </button>
                                </a>
                            </div>

                            <div class="col-sm-2" style="text-align:center;">
                                <a href="<?php echo $this->url ?>&page=bills">
                                    <button type="button" class="btn btn-outline-dark" style="width: 180px; padding: 15px 0;">
                                        <i class="ion-ios-paper" style="font-size:50px;"></i>
                                        <p class="card-text">Bills</p>
                                    </button>
                                </a>
                            </div>

                            <div class="col-sm-2" style="text-align:center;">
                                <a href="<?php echo $this->url ?>&page=AddNewSemester">
                                <button type="button" class="btn btn-outline-dark" style="width: 180px; padding: 15px 0;">
                                <i class="ion-ios-bookmarks" style="font-size:50px;"></i>
                                <p class="card-text">Semesters</p>
                                </button>
                                </a>
                            </div>
                            
                            
                    </div>
                </div>

                <div style="width: 75%; margin: 0 auto;">
                    <div class="d-flex justify-content-left" style="margin-top: 50px;">

                    <div class="col-sm-2" style="text-align:center;">
                            <a href="<?php echo $this->url ?>&page=Bus">
                            <button type="button" class="btn btn-outline-dark" style="width: 180px; padding: 15px 0;">
                             <i class="fa fa-bus-alt" style="font-size:50px;"></i>
                            <p class="card-text">Bus</p>
                           </button>
                            </a>
                      </div>

                        <div class="col-sm-2" style="text-align:center;">
                            <a href="<?php echo $this->url ?>&page=ConfigGrades">
                            <button type="button" class="btn btn-outline-dark" style="width: 180px; padding: 15px 0;">
                             <i class="ion-university" style="font-size:50px;"></i>
                            <p class="card-text">Grades</p>
                           </button>
                            </a>
                      </div>

                      <div class="col-sm-2" style="text-align:center;">
                            <a href="<?php echo $this->url ?>&page=PaymentEAV">
                            <button type="button" class="btn btn-outline-dark" style="width: 180px; padding: 15px 0;">
                             <i class="ion-card" style="font-size:50px;"></i>
                            <p class="card-text">Payment</p>
                           </button>
                            </a>
                      </div>

                      <div class="col-sm-2" style="text-align:center;">
                            <a href="<?php echo $this->url ?>&page=SpecificSearch">
                            <button type="button" class="btn btn-outline-dark" style="width: 180px; padding: 15px 0;">
                             <i class="ion-ios-search-strong" style="font-size:50px;"></i>
                            <p class="card-text">Specific Search</p>
                           </button>
                            </a>
                      </div>

                      <div class="col-sm-2" style="text-align:center;">
                            <a href="<?php echo $this->url ?>&page=SystemMessages">
                            <button type="button" class="btn btn-outline-dark" style="width: 180px; padding: 15px 0;">
                             <i class="ion-ios-cog" style="font-size:50px;"></i>
                            <p class="card-text">System Messages</p>
                           </button>
                            </a>
                      </div>
                      

                      <div class="col-sm-2" style="text-align:center;">
                                <a href="<?php echo $this->url ?>&page=aboutUsEmployee">
                                    <button type="button" class="btn btn-outline-dark" style="width: 180px; padding: 15px 0;">
                                        <i class="ion-edit" style="font-size:50px;"></i>
                                        <p class="card-text">About Us</p>
                                    </button>
                                </a>
                            </div>

                    </div>
                </div>

                <div style="width: 75%; margin: 0 auto;">
                    <div class="d-flex justify-content-left" style="margin-top: 50px;">

                    <div class="col-sm-2" style="text-align:center;">
                            <a href="<?php echo $this->url ?>&page=QrLink">
                            <button type="button" class="btn btn-outline-dark" style="width: 180px; padding: 15px 0;">
                             <i class="fa fa-qrcode" style="font-size:50px;"></i>
                            <p class="card-text">QR-Link</p>
                           </button>
                            </a>
                      </div>

                    </div>
                </div>
                
            </div>


            <?php

            
        }

        public function billsPage()
        {
            echo "<h1 style='font-size:50px; text-align:center;  margin-top:200px;'>Bills</h1>";
            echo "<div style='margin-top:50px; text-align:center;'>";
            echo "<div><a href=$this->url&selected=additem><button type='button' style='width:30%; padding:6px; font-size:18px; margin-bottom:10px;' class='btn btn-outline-dark'>Add Item</button></a></div>";
            echo "<div><a href=$this->url&selected=fatora><button type='button' style='width:30%; padding:6px; font-size:18px; margin-bottom:10px;' class='btn btn-outline-dark'>Add Bill</button></a></div>";
            echo "<div><a href=$this->url&selected=bills><button type='button' style='width:30%; padding:6px; font-size:18px; margin-bottom:10px;' class='btn btn-outline-dark'>View Bills</button></a></div>";
            echo "</div>";
        }

        public function displayAll($userType, $headerTitle)
        {
            echo "<h1 style='text-align:center;  margin-top:35px; '>Pharaohs $headerTitle</h1>";
            ?>
                <form action=" " method="POST" style="margin-left: 10px; margin-bottom:0px;">
                <div class="form-row">
                    <div class="col-md-3">
                        <input type="text" class="form-control" placeholder="Search by name" name="nameSearchInput" required pattern="[a-z | A-Z]+">
                    </div>
                    <div class="col-md-6">
                        <button type="submit" class="btn btn-outline-dark">Search</button>
                    </div>
                </div>
                </form>
            <?php
            

            
            echo "<div style='width:100%; margin-top:40px;' class='list-group'>";
            for($i = 0; $i < count($userType); $i++)
            {
                $fullName = $userType[$i]->first_name." ".$userType[$i]->second_name." ".$userType[$i]->third_name;
                $Id = $userType[$i]->id;

                if($userType[$i]->accepted == 0)
                {
                    echo "<a target=”_blank” href=$this->url&id=".$userType[$i]->id." style='text-decoration: none; margin-bottom:-1px;'><button type='button' class='text-secondary list-group-item list-group-item-action'><strong>NAME: $fullName <br> ID: $Id</strong></button></a>";
                }
                else
                {
                    if($userType[$i]->isDeleted == 0)
                        echo "<a target=”_blank” href=$this->url&id=".$userType[$i]->id." style='text-decoration: none; margin-bottom:-1px;'><button type='button' class='text-success list-group-item list-group-item-action'><strong>NAME: $fullName <br> ID: $Id</strong></button></a>";
                    else
                        echo "<a target=”_blank” href=$this->url&id=".$userType[$i]->id." style='text-decoration: none; margin-bottom:-1px;'><button type='button' class='text-danger list-group-item list-group-item-action'><strong>NAME: $fullName [DELETED]<br> ID: $Id</strong></button></a>";
                }
            }
            echo "</div>";
        }

        public function displaySpecificUser($userType)
        {
            echo "<h1 style='text-align:center;  margin-top:25px; margin-bottom:35px; '>$userType->first_name $userType->second_name $userType->third_name</h1>";
            ?>
                <table class="table">
                <thead class="thead-dark">
                    <tr>
                    <th scope="col">ID</th>
                    <th scope="col">Type</th>
                    <th scope="col">Full Name</th>
                    <th scope="col">DOB</th>
                    <th scope="col">Email</th>
                    <th scope="col">Gender</th>
                    <th scope="col">Date created</th>
                    <th scope="col">Accepted</th>
                    <th scope="col">Application Number</th>
                    <th scope="col">Phone Number(s)</th>
                    <th scope="col">City</th>
                    <th scope="col">State</th>
                    <th scope="col">Zip</th>
                    <th scope="col">Images</th>
                    
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <th scope="row"><?php echo $userType->id ?></th>
                            <td><?php echo $userType->user_type == 3 ? 'Student' : ($userType->user_type == 2 ? 'Teacher' : 'Parent')?></td>
                            <td><?php echo $userType->first_name." ".$userType->second_name." ".$userType->third_name?></td>
                            <td><?php echo $userType->dob?></td>
                            <td><?php echo $userType->email?></td>
                            <td><?php echo $userType->gender == 0 ? 'Male' : 'Female'?></td>
                            <td><?php echo $userType->date_created ?></td>
                            <td><?php echo $userType->accepted == 0 ? 'NO' : 'YES' ?></td>
                            <td><?php echo $userType->application_number ?></td>
                            <td><?php echo $userType->phone_number1 ?></td>
                            <td><?php echo $userType->city ?></td>
                            <td><?php echo $userType->state ?></td>
                            <td><?php echo $userType->zip ?></td>
                            <?php
                                $face_image = $this->decryptImage($userType->face_image);
                                echo "<td><a target='_blank' href=$this->imageURL$face_image>Front Face</a></td>";
                            ?>
                    </tr>

                    <tr>
                        <th colspan="9"></th>
                        <td colspan="4"><?php echo $userType->phone_number2 ?></td>
                        <?php
                        $birth_certificate = $this->decryptImage($userType->birth_certificate);
                        $identity_front = $this->decryptImage($userType->identity_front);

                        if($userType->user_type == 3)
                                echo "<td><a target='_blank' href=$this->imageURL$birth_certificate>Birth Certificate</a></td>";
                            else
                                echo "<td><a target='_blank' href=$this->imageURL$identity_front>Identity Front</a></td>";
                        ?>
                    </tr>

                    <tr>
                        <th colspan="13"></th>
                        <?php
                        $identity_back = $this->decryptImage($userType->identity_back);
                        if($userType->user_type != 3)
                                echo "<td><a target='_blank' href=$this->imageURL$identity_back>Identity Back</a></td>";
                        ?>
                    </tr>
                    
                </tbody>
                </table>

                <form action="" method="POST" style="text-align: center;">

                <?php if($userType->accepted == 0 && $userType->isDeleted == 0): ?>
                    <button type="submit" class="btn btn-success" name="accept">Accept user</button>
                <?php elseif($userType->accepted == 1 && $userType->user_type == 3 && $userType->isDeleted == 0):?>
                    <a href="<?php echo $this->url?>&id=<?php echo $userType->id ?>&action=studentregistration" target="_blank">  <button type="button" class="btn btn-outline-dark" name="studentRegister">Student Registration</button></a>
                    <a href="<?php echo $this->url?>&id=<?php echo $userType->id ?>&action=subjectregistrationForStudents" target="_blank">  <button type="button" class="btn btn-outline-dark" name="subjectRegister">Student Registration Details</button></a>
                    <a href="<?php echo $this->url?>&id=<?php echo $userType->id ?>&action=studentcertificate" target="_blank">  <button type="button" class="btn btn-dark" name="generateCertificate">Generate Certificate</button></a>
                <?php elseif($userType->accepted == 1 && $userType->user_type == 2 && $userType->isDeleted == 0):?>
                    <a href="<?php echo $this->url?>&id=<?php echo $userType->id ?>&action=subjectregistrationForTeachers" target="_blank">  <button type="button" class="btn btn-outline-dark" name="subjectRegister">Teacher Subject Registration</button></a>
                <?php elseif($userType->isDeleted == 1):?>
                    <button type="submit" class="btn btn-success" name="reActivate">Re-activate user</button> 
                    
                <?php endif ?>
                <?php if($userType->isDeleted == 0): ?>
                    <button type="submit" class="btn btn-danger" name="delete">Delete user</button> 
                <?php endif ?>
                </form>
            <?php
        }

        public function searchWithName($userType, $nameArray)
        {
            echo "<h1 style='text-align:center;  margin-top:35px; '>Search Results</h1>";
            echo "<div style='width:100%; margin-top:40px;' class='list-group'>";
            for($i = 0; $i < count($userType); $i++)
            {
                $fullName = $userType[$i]->first_name." ".$userType[$i]->second_name." ".$userType[$i]->third_name;
                $firstName = $userType[$i]->first_name;
                $secondName = $userType[$i]->second_name;
                $thirdName = $userType[$i]->third_name;
                $id = $userType[$i]->id;
                for($k = 0; $k < count($nameArray); $k++)
                {
                    if(strtolower($nameArray[$k]) == strtolower($firstName) || strtolower($nameArray[$k]) == strtolower($secondName)
                    || strtolower($nameArray[$k]) == strtolower($thirdName))
                    {
                        if($userType[$i]->accepted == 0)
                        {
                            echo "<a target=”_blank” href=$this->url&id=".$userType[$i]->id." style='text-decoration: none; margin-bottom:-1px;'><button type='button' class='text-secondary list-group-item list-group-item-action'><strong>NAME: $fullName <br> ID: $id</strong></button></a>";
                        }
                        else
                        {
                            echo "<a target=”_blank” href=$this->url&id=".$userType[$i]->id." style='text-decoration: none; margin-bottom:-1px;'><button type='button' class='text-success list-group-item list-group-item-action'><strong>NAME: $fullName <br> ID: $id</strong></button></a>";
                        }
                    break;
                    }
                }
                   
                
            }
            echo "</div>";
        }

        public function aboutUs($oldContent)
        {
            ?>
            <h1 style="text-align:center;  margin-top:30px; margin-bottom: 30px;">About us editor</h1>
            <form action="#" method="POST">
            <textarea name="content" id="editor" required>
                        &lt;p&gt;<?php echo $oldContent ?>&lt;/p&gt;
            </textarea>
                <div style="text-align:center; margin-top:15px;">
                    <button type="submit" style="width:10%;" class="btn btn-outline-dark" name="editAboutUs" onclick="alert(data);">Edit</button>
                </div>
            </form>

            <script>
                ClassicEditor
                    .create( document.querySelector( '#editor' ) )
                    .catch( error => {
                        console.error( error );
                    } );
            </script>

            <?php
        }

        public function decryptImage($strng)
        {
            $ciphering = "AES-128-CTR";
            $decryption_iv = '1234567891011121'; 
            $options = 0;
            $decryption_key = "OOpse314*%*"; 
  
            $decryption = openssl_decrypt ($strng, $ciphering, $decryption_key, $options, $decryption_iv);
            return $decryption;
        }

        public function subjectsRegisterPage($whichUser, $studentSemester, $userType, $subjectsArray)
        {
            if($userType->user_type == 3)
                echo "<h1 style='text-align:center;  margin-top:40px; margin-bottom: 50px; '>Registration Details to Student $userType->first_name</h1>";
            else if ($userType->user_type == 2)
                echo "<h1 style='text-align:center;  margin-top:40px; margin-bottom: 50px; '>Register Subjects to Teacher $userType->first_name</h1>";


            ?>
            <form action="" style="width: 35%; margin: 50px auto;" method="POST" enctype="multipart/form-data">
                <div class="form-group">
                <select id="inputState" required class="form-control" id="selectId" onclick = "document.getElementById('selectedSubject').value=this.options[this.selectedIndex].text" onchange="document.getElementById('selectedSubject').value=this.options[this.selectedIndex].text">
                    <?php
                    if($whichUser == "student")
                    {
                        echo "<option value='' disabled selected>Subjects:</option>";
                        for($i = 0; $i < count($subjectsArray); $i++)
                        {
                            if($subjectsArray[$i]->semesterId == $studentSemester)
                            {
                                echo "<option>".$subjectsArray[$i]->id." - ".$subjectsArray[$i]->Name. " - ". $subjectsArray[$i]->Code." - ".$subjectsArray[$i]->semesterName."</option>";
                            }
                        }
                    }
                    else if($whichUser == "teacher")
                    {
                        echo "<option value='' disabled selected>Subjects:</option>";
                        for($i = 0; $i < count($subjectsArray); $i++)
                        {
                            echo "<option>".$subjectsArray[$i]->id." - ".$subjectsArray[$i]->Name. " - ". $subjectsArray[$i]->Code." - ".$subjectsArray[$i]->semesterName."</option>";
                            
                        }
                    }
                    ?>
                </select>
                <input type="hidden" name="selectedSubject" id="selectedSubject" value="" />
            </div>


                <button type="submit" name="addSubject" class="btn btn-outline-dark" style="width: 100%;" >Add</button>
                </form>
                <?php
        }

        public function studentsRegisterPage($userType, $semestersArray)
        {
            echo "<h1 style='text-align:center;  margin-top:40px; margin-bottom: 50px; '>Registration to $userType->first_name</h1>";
            ?>
            <form action="" style="width: 35%; margin: 50px auto;" method="POST">
            <div class="form-group">

                <small>Select Semester:</small>
                <select id="inputState" required class="form-control" onclick="document.getElementById('selectedSemester').value=this.options[this.selectedIndex].text" onchange="document.getElementById('selectedSemester').value=this.options[this.selectedIndex].text">
                    <?php
                    echo "<option value='' disabled selected>Semesters:</option>";
                    for($i = 0; $i < count($semestersArray); $i++)
                    {
                      echo "<option>".$semestersArray[$i]->name."</option>";
                    }
                    ?>
                </select>
                <input type="hidden" name="selectedSemester" id="selectedSemester" value="1" />
            </div>
            <div class="form-row">

                <div class="col-md-12 form-group" style="margin-top:0px;">
                    <input type="number" class="form-control"  placeholder="Registration Fees" name="regFees" required>
                </div>
            </div>

                <button type="submit" name="registerStudent" class="btn btn-outline-dark" style="width: 100%;" >Register</button>
            </form>
            <?php
        }

        public function addSubjects($semestersArray)
        {
            echo "<h1 style='text-align:center;  margin-top:40px; margin-bottom: 50px; '>Add Subjects to School</h1>";
            ?>
            <form action="" style="width: 35%; margin: 50px auto;" method="POST">

            <div class="form-group">
                <small>Select Semester:</small>
                <select id="inputState" required class="form-control" onclick="document.getElementById('selectedSemester').value=this.options[this.selectedIndex].text" onchange="document.getElementById('selectedSemester').value=this.options[this.selectedIndex].text">
                    <?php
                    echo "<option value='' disabled selected>Semesters:</option>";
                    for($i = 0; $i < count($semestersArray); $i++)
                    {
                      echo "<option>".$semestersArray[$i]->name."</option>";
                    }
                    ?>
                </select>
                <input type="hidden" name="selectedSemester" id="selectedSemester" value="1" />
            </div>
            
            <div class="form-row">
                <div class="col-md-12 form-group" style="margin-top:4px;">
                    <input type="text" class="form-control"  placeholder="Subject Code" name="subjectCode" required>
                </div>
            </div>

            <div class="form-row">
                <div class="col-md-12 form-group" style="margin-top:4px;">
                    <input type="text" class="form-control"  placeholder="Subject Name" name="subjectName" required>
                </div>
            </div>

                <button type="submit" name="addSubjectToSystem" class="btn btn-outline-dark" style="width: 100%;" >Add to the system</button>
            </form>
            <?php
        }

        public function displayStudentCertificate($certificate)
        {
            if($certificate->first_name != "")
                {
            echo "<h1 style='text-align:left;  margin-left:30px; margin-top:40px; margin-bottom: 60px; '>$certificate->first_name $certificate->second_name $certificate->third_name's Certificate - $certificate->semesterName</h1>";
            ?>
                <table class="table table-bordered" style="margin: 0 auto;  width:600px">
                <tbody>
                    <tr>
                        <th>Courses' Name</th>
                        <th>Courses' Code</th>
                        <th>Marks</th>
                        <th>Out of</th>
                    </tr>
                    <?php
                        $passed = true;
                     for($i = 0; $i < count($certificate->subjectsArray); $i++){ ?>
                    <tr>
                        <td><?php echo $certificate->subjectsArray[$i]->Name ?></td>
                        <td><?php echo $certificate->subjectsArray[$i]->Code ?></td>
                        <td><?php echo $certificate->subjectsArray[$i]->studentMarks ?></td>
                        <td><?php echo $certificate->subjectsArray[$i]->subjectMarks ?></td>
                        <td><?php if($certificate->subjectsArray[$i]->studentMarks >= ($certificate->subjectsArray[$i]->subjectMarks / 2))
                        {
                            echo "<div class='text-success'>Passed</div>";
                        }
                        else
                        {
                            echo "<div class='text-danger'>Failed</div>";
                            $passed = false;
                        }
                         ?>
                         </td>
                    </tr>
                    <?php }?>
                </tbody>
                </table>
                <?php
                
                    $percentage = ($certificate->netStudentGrade / $certificate->netSubjectsMarks) * 100;
                    $percentage = round($percentage, 2);
                    echo "<h2 style='text-align:center;  margin-top:40px; margin-bottom: 45px; '>Total Percentage: $percentage% </h2>";
                    if(!$passed && $percentage >= 50)
                    {
                        echo "<h4 class='text-danger' style='text-align:center; margin-top:30px; margin-bottom: 60px; '>This student cannot be transferred to the next semester </h4>";
                    }
                    else if($passed && $percentage < 50 )
                    {
                        echo "<h4 class='text-danger' style='text-align:center; margin-top:30px; margin-bottom: 60px; '>This student cannot be transferred to the next semester </h4>";
                    }
                    else if(!$passed && $percentage < 50)
                    {
                        echo "<h4 class='text-danger' style='text-align:center; margin-top:30px; margin-bottom: 60px; '>This student cannot be transferred to the next semester </h4>";
                    }
                    else if($passed && $percentage >= 50)
                    {
                        echo "<h4 class='text-success' style='text-align:center; margin-top:30px; margin-bottom: 30px; '>This student can be transferred to the next semester </h4>";
                        ?>
                            <form method="POST" action="" style="text-align:center;">
                            <input type="submit" name="transferStudent" class="btn btn-outline-primary" value="Transfer" style="width: 7%;" >
                            </form>
                        <?php
                    }
                }
                else
                {
                    echo "<h4 class='text-danger' style='text-align:center; margin-top:30px; margin-bottom: 60px; '>This Student has not registered in subjects or has not graded yet </h4>";
                }


               
        }

        /*public function SearchBillbyid($userType, $id)
        {
            echo "<h2 class='text-secondary' style='text-align:center;  margin-top:80px; '>Search Results</h2>";
            echo "<div style='width:100%; margin-top:40px;' class='list-group'>";
            for($i = 0; $i < count($userType); $i++)
            {
                if($userType[$i]->id == $id)
                {
                    $Name=$userType[$i]->first_name." ".$userType[$i]->second_name." ".$userType[$i]->third_name;
                        echo "<a target=”_blank” href=$this->url&StudentidBill=".$userType[$i]->id." style='text-decoration: none; margin-bottom:-1px;'><button type='button' class='text-secondary list-group-item list-group-item-action'><strong>NAME: $Name  <br> ID: $id </strong></button></a>";
                         break;
                }
            }
            echo "</div>";
        }*/

        public function showbill($bill, $total)
        {
            if($bill && isset($bill))
            {
                 $studentName = $bill[0][0]->studentName;
                echo "<h2 class='text-primary' style='text-align:left; margin-left:20px; margin-bottom:10px; margin-top:60px;'>$studentName's Bill(s)</h2>";

          ?>

          <?php for($j = 0; $j < count($bill); $j++){ ?>
              <table class="table table-bordered table-hover" style="margin: 15px 20px;  width:800px; border: 1px solid rgb(224,224,224); border-radius:25px;">
              <caption>Bill <?php echo $j + 1 ?> for <?php echo $studentName ?></caption>
              <tbody>
                  <tr>
                    <th>Bill-id</th>
                    <td><?php echo $bill[$j][0]->id ?></td>
                  </tr>
                  
                  <tr>
                    <th>Student-id</th>
                    <td><?php echo $bill[$j][0]->userId ?></td>
                  </tr>

                  <tr>
                    <th>Name</th>
                    <td><?php echo $bill[$j][0]->studentName ?></td>
                  </tr>

                  <tr>
                    <th>Item(s)</th>
                    <td>
                        <?php
                      for($i = 0; $i < count($bill[$j]); $i++)
                      {
                        echo $bill[$j][$i]->item_name;
                        echo " (".$bill[$j][$i]->netamount.")";
                        if($i != count($bill[$j]) - 1)
                            echo ", ";
                      }
                      ?>
                    </td>
                  </tr>

                  <tr>
                    <th>Semester</th>
                    <td><?php echo $bill[$j][0]->semester_id ?></td>
                  </tr>

                  <tr>
                    <th>Date of Bill</th>
                    <td><?php echo $bill[$j][0]->date ?></td>
                  </tr>

                  <tr>
                    <th>Total items' Prices</th>
                    <td>
                        <?php 
                        $fixNetAmount = 0;
                        for($i = 0; $i < count($bill[$j]); $i++)
                        {
                            $fixNetAmount +=$bill[$j][$i]->netamount;
                        } 
                        echo $fixNetAmount;
                        ?>
                        
                    </td>
                  </tr>

              </tbody>
              </table>
              <br>
              
              <?php
          }
            }
            else
            {
                echo "<h4 class='text-danger' style='text-align:center; margin-top:30px; margin-bottom: 60px; '>This Student has no bills yet </h4>";
            }

        }

        public function createItem()
        {
              echo "<h1 style='text-align:center;  margin-top:40px; margin-bottom: 50px; '>Add Items</h1>";
          ?>
          <form action="" style="width: 35%; margin: 50px auto;" method="POST" >
            <div class="form-group">
              <input type="text" class="form-control"  name="itemName" placeholder="Item Name" required>
            </div>
            <div class="form-group">
              <input type="text" class="form-control"  name="itemValue" placeholder="Item Price" required>
            </div>
            <button type="submit" name="itemadd" class="btn btn-outline-dark" style="width: 100%;" >Add</button>
            </form>

            <?php
        }

        public function createBill($itemsObjs, $students)
        {
            echo "<h1 style='text-align:center;  margin-top:40px; margin-bottom: 50px; '>Create Bill</h1>";
            ?>
            <form action="" style="width: 35%; margin: 50px auto;" method="POST" >
            <div class="form-group">
                <select id="inputState" class="form-control" id="selectionId" onchange="document.getElementById('selectedStudentId1').value=this.options[this.selectedIndex].text" required>
                    <?php
                    echo "<option value='' disabled selected>Students:</option>";
                        for($i = 0; $i < count($students); $i++)
                        {
                            if($students[$i]->isDeleted == 0)
                            {
                                $fullName = $students[$i]->first_name." ".$students[$i]->second_name." ".$students[$i]->third_name;
                                echo "<option>".$students[$i]->id." - ".$fullName."</option>";
                            }
                        }
                    ?>
                </select>
                <input type="hidden" name="selectedStudentId1" id="selectedStudentId1" value="" />
            </div>
            <div class="form-group">
            <?php

            for($i=0;$i<count($itemsObjs);$i++)
            {
                $name=$itemsObjs[$i]->name;
                $id=$itemsObjs[$i]->id;
                echo "<label style='margin:7px; font-size:18px'>$name</label>";
                echo "<input type='checkbox' value='$id' name='itemscheckbox[]' style='margin-right:20px;'>";
            }
            //$countItems = count($itemsObj);
            //echo "<input type='hidden' value='$countItems'>";
            ?>
            </div>
            <button type="submit" name="createbill" class="btn btn-outline-dark" style="width: 100%;" >Create</button>
            </form>
            <?php
        }

        public function SearchBills($students)
        {
          echo "<h1 style='text-align:center;  margin-top:35px; '>View Bills</h1>";
          ?>
          <div style="margin-left:20px;">
              <form action="" method="POST" style="margin-top:40px;">
              <div class="form-row">
                <div class="col-md-4">
                    <select id="inputState" class="form-control" id="selectionId" onchange="document.getElementById('selectedStudentId2').value=this.options[this.selectedIndex].text" required>
                        <?php
                        echo "<option value='' disabled selected>Students:</option>";
                            for($i = 0; $i < count($students); $i++)
                            {
                                if($students[$i]->isDeleted == 0)
                                {
                                    $fullName = $students[$i]->first_name." ".$students[$i]->second_name." ".$students[$i]->third_name;
                                    echo "<option>".$students[$i]->id." - ".$fullName."</option>";
                                }
                            }
                        ?>
                    </select>
                    <input type="hidden" name="selectedStudentId2" id="selectedStudentId2" value="" />
                </div>
                  <div class="col-md-6">
                      <button type="submit" name="displayStudentBill" class="btn btn-outline-dark">Display</button>
                  </div>
              </div>
              </form>
            </div>

          <?php

        }

        public function configGradesPage($existGrades)
        {
            echo "<h1 style='text-align:center;  margin-top:35px; '>Add new Grading Method</h1>";
            ?>
            <form action="" style="width: 35%; margin: 0px auto; margin-top: 50px;" method="POST">
              <div class="form-group">
                <input type="text" class="form-control"  name="gradeType" placeholder="Name" required>
              </div>
              <div class="form-group">
                <input type="text" class="form-control"  name="typeMarks" placeholder="Marks" required>
              </div>
              <button type="submit" name="submitGradeType" class="btn btn-outline-dark" style="width: 100%;" >Add</button>
              </form>

              <form action="" style="width: 35%; margin: 20px auto;" method="POST" >
                    <?php
                        for($i = 0; $i < count($existGrades); $i++)
                        {
                            $existGradeName = $existGrades[$i]['name'];
                            $existGradeId = $existGrades[$i]['id'];
                            echo "<div style='margin-bottom: 5px;'>
                            <i class='ion-android-remove-circle' style='font-size:20px; color:red'></i>
                            <a class='text-danger' style='cursor:pointer;' onclick='xmlUpdate($existGradeId)'>$existGradeName</a>
                            </div>";
                        }
                    ?>
              </form>

              <?php
        }

        public function addNewSemesterPage()
        {
            echo "<h1 style='text-align:center;  margin-top:35px; '>Add new Semester</h1>";
            ?>
            <form action="" style="width: 35%; margin: 50px auto;" method="POST" >
              <div class="form-group">
                <input type="text" class="form-control"  name="semesterName" placeholder="Semester Name" required>
              </div>
              <div class="form-group">
                <input type="number" class="form-control"  name="semesterFees" placeholder="Semester Fees" required>
              </div>
              <button type="submit" name="submitSemester" class="btn btn-outline-dark" style="width: 100%;" >Add</button>
              </form>
  
              <?php
        }

        public function systemMessagesPage()
        {
            echo "<h1 style='text-align:center;  margin-top:35px; '>Add new Message to the System</h1>";
            ?>
            <form action="" style="width: 35%; margin: 50px auto;" method="POST" >
              <div class="form-group">
                <input type="text" class="form-control"  name="messageType" placeholder="Type" required>
              </div>
              <div class="form-group">
                <input type="text" class="form-control"  name="messageContent" placeholder="Message" required>
              </div>
              <button type="submit" name="submitSystemMessage" class="btn btn-outline-dark" style="width: 100%;" >Add</button>
              </form>
  
              <?php
        }

        public function paymentEavPage()
        {
            echo "<h1 style='text-align:center;  margin-bottom:100px; margin-top:60px; '>Payment EAV</h1>";
            ?>
            <div style="width:75%; margin: 0 auto;">
                <div class="d-flex justify-content-center" style="margin: 0 auto;">
                <div class="col-sm-2" style="text-align:center;">
                    <a href="<?php echo $this->url ?>&page=PaymentMethods">
                    <button type="button" class="btn btn-outline-dark" style="width: 180px; padding: 15px 0;">
                    <i class="ion-ios-circle-outline" style="font-size:50px;"></i>
                    <p class="card-text" style="padding-top:10px">Payment Methods</p>
                    </button>
                    </a>
                </div>

                <div class="col-sm-2" style="text-align:center;">
                    <a href="<?php echo $this->url ?>&page=PaymentOption">
                    <button type="button" class="btn btn-outline-dark" style="width: 180px; padding: 15px 0;">
                    <i class="ion-ios-circle-filled" style="font-size:50px;"></i>
                    <p class="card-text"  style="padding-top:10px">Payment Options</p>
                    </button>
                    </a>
                </div>
                </div>
            </div>
            <?php
            
        }

        public function paymentMethodPage()
        {
            echo "<h1 style='text-align:center;  margin-top:35px; '>Add new Payment Method</h1>";
            ?>
            <form action="" style="width: 35%; margin: 50px auto;" method="POST" >
              <div class="form-group">
                <input type="text" class="form-control"  name="methodName" placeholder="Method Name" required>
              </div>
              <button type="submit" name="submitPaymentMethod" class="btn btn-outline-dark" style="width: 100%;" >Add</button>
              </form>
  
              <?php
        }

        public function paymentOptionPage($methods)
        {
            echo "<h1 style='text-align:center;  margin-top:35px; '>Add new Payment Option</h1>";
            ?>
            <form action="" style="width: 35%; margin: 50px auto;" method="POST" >
              <div class="input-group mb-3">
                <input type="text" class="form-control"  name="optionName" placeholder="Option Name" required>
                    <div class="input-group-append">
                        <select class="custom-select" onchange="document.getElementById('optionType').value=this.options[this.selectedIndex].text" required>
                            <option value='' disabled selected>Option Type:</option>
                            <option value="1">text</option>
                            <option value="2">number</option>
                            <option value="2">email</option>
                        </select>
                    </div>
                </div>
                <div class="input-group mb-3">
                    <div class="input-group">
                        <select class="custom-select" onchange="document.getElementById('methodNameV2').value=this.options[this.selectedIndex].text" required>
                            
                            <?php
                        echo "<option value='' disabled selected>Select from Methods:</option>";
                            for($i = 0; $i < count($methods); $i++)
                            {
                                    echo "<option>".$methods[$i]->name."</option>";
                            }
                        ?>
                        </select>
                    </div>
                </div>
              <button type="submit" name="submitPaymentOption" class="btn btn-outline-dark" style="width: 100%;" >Add</button>
              <input type="hidden" id="optionType" name="optionType" value="">
              <input type="hidden" id="methodNameV2" name="methodNameV2" value="">
              </form>
  
              <?php
        }

        public function QrLinkPage()
        {
            echo "<h1 style='text-align:center;  margin-top:35px; '>Add new QR-Link</h1>";
            ?>
            <form action="" style="width: 35%; margin: 50px auto;" method="POST" >
              <div class="form-group">
                <input type="text" class="form-control"  name="qrLink" placeholder="QR Link" required>
              </div>
              <button type="submit" name="updateQR" class="btn btn-outline-dark" style="width: 100%;" >Add</button>
              </form>
  
              <?php
        }

        public function busPage()
        {
            echo "<h1 style='font-size:50px; text-align:center;  margin-top:200px;'>Buses Management</h1>";
            echo "<div style='margin-top:50px; text-align:center;'>";
            echo "<div><a href=$this->url&page=AddNewRoute><button type='button' style='width:30%; padding:6px; font-size:18px; margin-bottom:10px;' class='btn btn-outline-dark'>Add New Route</button></a></div>";
            echo "<div><a href=$this->url&page=AddNewBus><button type='button' style='width:30%; padding:6px; font-size:18px; margin-bottom:10px;' class='btn btn-outline-dark'>Add New Bus</button></a></div>";
            echo "</div>";
        }

        public function addNewRoute()
        {
            echo "<h1 style='text-align:center;  margin-top:35px; '>Add New Bus Route</h1>";
            ?>
            <form action="" style="width: 35%; margin: 50px auto;" method="POST" >
              <div class="form-group">
                <input type="text" class="form-control"  name="routeName" placeholder="Route Name" required>
              </div>
              <div class="form-group">
                <input type="text" class="form-control"  name="routeFees" placeholder="Route Fees" required>
              </div>
              <button type="submit" name="submitRoute" class="btn btn-outline-dark" style="width: 100%;" >Add</button>
              </form>
  
              <?php
        }

        public function addNewBusPage($routes)
        {
            echo "<h1 style='font-size:50px; text-align:center;  margin-top:35px;'>Add New Bus info</h1>";
            ?>
                <form action="" style="width: 35%; margin: 50px auto;" method="POST">
                <div class="form-group">
                    <div class="input-group">
                            <select class="custom-select" onchange="document.getElementById('selectedRoute').value=this.options[this.selectedIndex].text" required>
                                
                                <?php
                            echo "<option value='' disabled selected>Select Route:</option>";
                                for($i = 0; $i < count($routes); $i++)
                                {
                                        echo "<option>".ucfirst($routes[$i]->name)."</option>";
                                }
                            ?>
                            </select>
                    </div>
                </div>

                <div class="form-group">
                        <input type="text" class="form-control"  name="meetAt" placeholder="Meet at" required>
                </div>

                    <div class="form-group">
                        <input type="text" class="form-control"  name="busCode" placeholder="Bus Code" required>
                    </div>

                <div class="form-group">
                        <input type="text" class="form-control"  name="driverName" placeholder="Driver's Name" required>
                </div>

                <div class="form-group">
                        <input type="number" class="form-control"  name="busSeats" placeholder="Bus's Seats" required>
                </div>

                <div class="form-row">
                    <div class="form-group col-md-6">
                        <input type="text" class="form-control"  name="supervisorName" placeholder="Supervisor's Name" required>
                    </div>
                    <div class="form-group col-md-6">
                        <input type="text" class="form-control"  name="supervisorPhoneNumber" placeholder="Supervisor's Phone Number" required>
                    </div>
                </div>


                <div class="form-row">
                    <div class="form-group col-md-6">
                        <input type="text" class="form-control"  name="timeMove" placeholder="First Time 00:00am" pattern="[0-9][0-9]:[0-9][0-9](a|A)(m|M)" required>
                    </div>
                    <div class="form-group col-md-6">
                        <input type="text" class="form-control"  name="timeArrive" placeholder="Second Time 00:00pm" pattern="[0-9][0-9]:[0-9][0-9](p|P)(m|M)" required>
                    </div>
                </div>
                
                <button type="submit" name="submitBus" class="btn btn-outline-dark" style="width: 100%;" >Add</button>
                <input type="hidden" id="selectedRoute" name = "selectedRoute" value="">
                </form>
            <?php
        }

        public function specificSearchPage($reports)
        {
            echo "<h1 style='font-size:50px; text-align:center;  margin-top:35px;'>Specific Search</h1>";
            
            ?>
            <form action="" style="width: 35%; margin: 50px auto;" method="POST">
            <div class="form-group">
                    <div class="input-group mb-4">
                <select id="inputState" class="form-control" onchange="document.getElementById('selectedReport').value=this.options[this.selectedIndex].text">
                    <?php
                    echo "<option value='' disabled selected>Reports:</option>";
                        for($i = 0; $i < count($reports); $i++)
                        {
                            echo "<option>".$reports[$i]->report_name."</option>";
                        }
                    ?>
                </select>
                    </div>
            
            
            <?php
            ?>
                <div class="form-row">
                <div class="form-group col-md-4">
                        <select id="inputState" class="form-control" onchange="document.getElementById('condition').value=this.options[this.selectedIndex].text">
                        <option value='' disabled selected>Condition:</option>
                        <option>more than</option>
                        <option>less than</option>
                        <option>equals</option>
                    </select>
                    </div>

                    <div class="form-group col-md-8">
                        <input type="number" class="form-control"  name="whereGrade" placeholder="Grade">
                    </div>
                    
                </div>
                <button type="submit" name="submitBus" class="btn btn-outline-info" style="width: 100%;" >Search</button>
                <input type="hidden" id="condition" name = "condition" value="">
                <input type="hidden" id="selectedReport" name = "selectedReport" value="">
                </div>
                </form>
            <?php
        }

        public function specificSearchResultsView($results)
        {
            if(isset($results))
            {
                echo "<div style='width:100%; margin-top:40px;' class='list-group'>";
                for($i = 0; $i < count($results); $i++)
                {
                    $fullName = $results[$i][0]." ".$results[$i][1]." ".$results[$i][2];
                    $Id = $results[$i][3];

                    if($results[$i][5] == 0)
                    {
                        echo "<button type='button' class='text-primary list-group-item list-group-item-action'><strong>NAME: $fullName <br> ID: $Id</strong></button>";
                    }
                    else
                    {
                        if($results[$i][5] == 0)
                            echo "<button type='button' class='text-primary list-group-item list-group-item-action'><strong>NAME: $fullName <br> ID: $Id</strong></button>";
                        else
                            echo "<button type='button' class='text-danger list-group-item list-group-item-action'><strong>NAME: $fullName [DELETED]<br> ID: $Id</strong></button>";
                    }
                }
                echo "</div>";
            }
            else
            {
                echo "<h3 style='text-align:center;  margin-top:35px;' class='text-danger'>No Results</h3>";
            }
        }

    }
?>

<script>
    function xmlUpdate(gradeId){
          var xmlhttp = new XMLHttpRequest();
        xmlhttp.onreadystatechange = function() {
            if (this.readyState == 4 && this.status == 200) {
                //alert(this.responseText);
            } else {
                //alert(this.status + " " + this.readyState);
            }
        };
        xmlhttp.open("GET", "delete_grading_method.php?gid=" + gradeId, true);
        xmlhttp.send();
        location.reload();
    }
  </script>
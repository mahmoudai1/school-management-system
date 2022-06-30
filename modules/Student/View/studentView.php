<?php
    class StudentView{
        public $imageURL;

        public function __construct()
        {
            $this->imageURL = "../../../";
        }

        public function displayDashboardPage($student, $semesterName, $notifyArr)
        {
            if($semesterName)
            {
            echo "<h1 style='text-align:left;  margin-top:40px; margin-bottom: 40px; margin-left:25px;'>Student Dashboard - $semesterName</h1>";
            }
            else
            {
                echo "<h1 style='text-align:left;  margin-top:40px; margin-bottom: 40px; margin-left:25px;'>Student Dashboard - Not Registered</h1>";

            }
            echo "<h5 style='text-align:left;  margin-top:10px; margin-bottom: 80px; margin-left:25px;'>Welcome back, ".$student['first_name'].".</h5>";

            ?>
            <div style="width: 75%; margin: 0 auto;">
                <div class="d-flex justify-content-center" style="margin-top: 50px;">
                    <div class="col-sm-2" style="text-align:center;">
                          <a href="?selected=SubjectsGrades">
                        <button type="button" class="btn btn-outline-dark" style="width: 180px; padding: 15px 0;">
                             <i class="ion-university" style="font-size:50px;"></i>
                            <p class="card-text" style="margin-top:10px;">Subjects' Grades</p>
                        </button>
                           </a>
                  </div>

                  <div class="col-sm-2" style="text-align:center;">
                          <a href="?selected=MyID">
                        <button type="button" class="btn btn-outline-dark" style="width: 180px; padding: 15px 0;">
                             <i class="fa fa-id-card" style="font-size:50px;"></i>
                            <p class="card-text" style="margin-top:10px;">My-ID</p>
                        </button>
                           </a>
                  </div>

                  <div class="col-sm-2" style="text-align:center;">
                          <a href="?selected=RegisterInBus">
                        <button type="button" class="btn btn-outline-dark" style="width: 180px; padding: 15px 0;">
                             <i class="fa fa-bus-alt" style="font-size:50px;"></i>
                            <p class="card-text" style="margin-top:10px;">Bus</p>
                        </button>
                           </a>
                  </div>


                <?php if(count($notifyArr) == 0): ?>
                  <div class="col-sm-2" style="text-align:center;">
                        <a href="?selected=NotificationPage">
                      <button type="button" class="btn btn-outline-dark" style="width: 180px; padding: 15px 0;">
                           <i class="ion-ios-bell" style="font-size:50px;"></i>
                          <p class="card-text" style="margin-top:10px;">Notifications</p>
                      </button>
                         </a>
                </div>
                <?php else: ?>
                    <div class="col-sm-2" style="text-align:center;">
                        <a href="?selected=NotificationPage">
                      <button type="button" class="btn btn-danger" style="width: 180px; padding: 15px 0;">
                           <i class="ion-ios-bell" style="font-size:50px;"></i>
                          <p class="card-text" style="margin-top:10px;">Notifications</p>
                      </button>
                         </a>
                </div>
                <?php endif ?>

              </div>
            </div>
            <?php
        }

        public function showSubjectsWithGrades($studentSubjects, $overallGrades, $gradingMethods)
        {
            echo "<h1 style='text-align:center;  margin-top:40px; margin-bottom: 80px; '>Your Subjects' Grades</h1>";

            ?>
            <div class="d-flex justify-content-center">
              <table class="table table-borderless table-hover" style=" margin: 15px 20px;  width:800px;  box-shadow: 0px 4px 8px rgb(235, 235, 235);">
             
              <tbody>
              <tr class="text-white bg-info" style="text-align: center;" >
                    <th>Subject</th>
                    <?php
                    for($i = 0; $i < count($gradingMethods); $i++)
                    {
                        $gradingMethod = ucfirst($gradingMethods[$i]['name']);
                        echo "<th>$gradingMethod</th>";
                    }
                    ?>
                    <th>Overall</th>
            </tr>
                  <?php
                  
                  for($i = 0; $i < count($studentSubjects); $i++)
                  {
                    ?>
                    <tr style="border-bottom: 1px solid rgb(230, 230, 230); text-align: center;">
                        <td><?php echo $studentSubjects[$i]->Name." - ".$studentSubjects[$i]->Code ?></td>
                        <?php for($j = 0; $j < count($gradingMethods); $j++)
                        {
                            $f = 0;
                            for($k = 0; $k < count($studentSubjects[$i]->gradingMethodArr); $k++)
                            {
                                if($studentSubjects[$i]->gradingMethodArr[$k] == $gradingMethods[$j]['name'])
                                {
                                    $f = 1;
                                    if(isset($studentSubjects[$i]->gradesArr[$k]))
                                    {
                                        $grade = $studentSubjects[$i]->gradesArr[$k];
                                        echo "<td>$grade</td>";
                                    }
                                    else
                                    {
                                        echo "<td>Not graded</td>";
                                    }
                                }
                            }
                            if($f == 0) echo "<td>Not graded</td>";         // This line saved my life :D Akheeran
                                
                        }
                        ?>
                        
                        <td><?php echo $overallGrades[$i] ?></td>
                    </tr>

                <?php 
                
                }
                ?>

                  

              </tbody>
              </table>
              </div>
              <?php
            
        }

        public function ShowNotification($notifyArr)
        {
            echo "<h1 style='text-align:center;  margin-top:40px; margin-bottom: 80px;'>Notifications</h1>";

           for($i = 0; $i < count($notifyArr); $i++)
           {
               $notifyId = $notifyArr[$i]->id;
               $notifyIsRead = $notifyArr[$i]->isRead;
               if($notifyArr[$i]->isRead == 1)
               {
               ?>
                    <button type='button' class='text-secondary list-group-item list-group-item-action' onclick="xmlUpdate(<?php echo $notifyId ?>, <?php echo $notifyIsRead ?>)"> <?php echo $notifyArr[$i]->content ?> </button>
                <?php
               }
               else
               {
                ?>
                    <button type='button' class='text-primary list-group-item list-group-item-action' onclick="xmlUpdate(<?php echo $notifyId ?>, <?php echo $notifyIsRead ?>)"> <?php echo $notifyArr[$i]->content ?> </button>
                <?php
               }
           }
        }

        public function MyIdPage($url, $semesterName, $user, $image, $reg_date)
        {
            echo "<h1 style='text-align:center;  margin-top:40px; margin-bottom: 80px;'>My-ID</h1>";
            $fullName = $user->first_name." ".$user->second_name." ".$user->third_name;
            $date = explode(" ", $reg_date);
            $qrURL = $url;
            ?>
                <div class="myId "> <!--animate__animated animate__zoomInDown/flip -->
                    <div class="schoolName"><strong>Pharaohs Experimental Language School</strong></div>
                    <img class="pharaoh_image" src="ph3.png" title="School Logo">
                    <h3><strong>P.E.L.S</strong></h3>
                    <div class="tinyLine"><hr></div>
                    <div class="components">
                        <div class="c name">Name: <strong><?php echo $fullName; ?></strong></div>
                        <div class="c id">ID: <strong><?php echo $user->id; ?></strong></div>
                        <div class="c semester">Semester: <strong><?php echo $semesterName; ?></strong></div>
                        <div class="c date">Date Issued: <strong><?php echo $date[0] ?></strong></div>
                    </div>
                    <img class="student_img" src="<?php echo $this->imageURL.$image; ?>" title="Your Photo">
                    <img class="student_qr" src="<?php echo "https://chart.googleapis.com/chart?chs=300x300&cht=qr&chl=".$qrURL."&choe=UTF-8"?>" title="QR-Link" />
                    
                </div>
            <?php
        }

        public function notRegisteredErrorInIdPage()
        {
            echo "<h1 style='text-align:center;  margin-top:40px; margin-bottom: 80px;'>My-ID</h1>";
            echo "<h3 class='text-danger' style='text-align:center; margin-top:80px; margin-bottom: 60px; '>You are not registered yet </h3>";
        }

        /*public function busPage()
        {
            echo "<h1 style='font-size:50px; text-align:center;  margin-top:200px;'>Buses Area</h1>";
            echo "<div style='margin-top:50px; text-align:center;'>";
            echo "<div><a href=?selected=RegisterInBus><button type='button' style='width:35%; padding:6px; font-size:18px; margin-bottom:16px;' class='btn btn-outline-dark'>Register In School's Bus</button></a></div>";
            echo "<div><a href=?selected=ViewMyBus><button type='button' style='width:35%; padding:6px; font-size:18px; margin-bottom:10px;' class='btn btn-outline-dark'>Display My Bus Schedule</button></a></div>";
            echo "</div>";
        }*/

        /*public function viewMyBus($studentBusSchedule)
        {
            echo "<h1 style='font-size:50px; text-align:center;  margin-top:40px; margin-bottom: 50px;'>Your Bus Schedule</h1>";

            if(!$studentBusSchedule)
            {
                echo "<h5 class='text-danger' style='text-align:center; margin-top:40px; margin-bottom: 60px; '>You are not registered in a Bus Yet, <a href='?selected=RegisterInBus'>Register Now?</a>  </h5>";
            }
        }*/

        public function registerInBus($busesArray, $isRegistered)
        {
            echo "<h1 style='font-size:50px; text-align:center;  margin-top:40px; margin-bottom: 50px;'>Bus Registration</h1>";
            if($isRegistered != -1 && $isRegistered)
            {
                echo "<h6 style='text-align:center;  margin-top:40px; margin-bottom: 50px;'>By Clicking REGISTER again, you're updating your Bus info.</h6>";
            }
            else
            {
                echo "<h6 style='text-align:center;  margin-top:40px; margin-bottom: 50px;'>You are not registered in any of these, click REGISTER to the best one that suite for you.</h6>";
            }

            ?>
            <table  class="table table-borderless" style=" border-radius:30px; margin: 0 auto;  width:85%; box-shadow: -2px 6px 10px rgb(235, 235, 235);">
                <tbody>
                    <tr class="text-white bg-dark" style="text-align: center;">
                        <th></th>
                        <th>Code</th>
                        <th>Route</th>
                        <th>Meeting Point</th>
                        <th>Driver Name</th>
                        <th>Supervisor Name</th>
                        <th>Supervisor Phone Number</th>
                        <th>Seats Left</th>
                        <th>First Time</th>
                        <th>Second Time</th>
                        <th>Fees</th>
                    </tr>
                    <?php
                     for($i = 0; $i < count($busesArray); $i++)
                    { 
                    ?>
                            <?php if($busesArray[$i]->seatsLeft > 0)
                            {
                                if($isRegistered == $busesArray[$i]->id)
                                {
                                    echo "<tr style='text-align: center; box-shadow: 4px 3px 8px 2px rgb(225, 225, 225);' class='text-white bg-primary'>";
                                }
                                else
                                {
                                    echo "<tr style='text-align: center;'>";
                                }
                            }
                            else
                            {
                                echo "<tr style='text-align: center; background-color:rgb(245, 245, 245);' class='text-secondary'>";
                            }
                            ?>

                            <td><?php echo $i+1 ?></td>
                            <td><?php echo $busesArray[$i]->code ?></td>
                            <td><?php echo ucfirst($busesArray[$i]->route) ?></td>
                            <td><?php echo $busesArray[$i]->meetAt ?></td>
                            <td><?php echo $busesArray[$i]->driverName ?></td>
                            <td><?php echo $busesArray[$i]->supervisorName ?></td>
                            <td><?php echo $busesArray[$i]->supervisorPhoneNumber ?></td>
                            <?php if($busesArray[$i]->seatsLeft > 0)
                            {
                                $tempSeatsLeft = $busesArray[$i]->seatsLeft;
                                echo "<td>$tempSeatsLeft</td>";
                            }
                            else
                            {
                                $tempSeatsLeft = $busesArray[$i]->seatsLeft;
                                echo "<td style='font-weight:bold'>$tempSeatsLeft</td>";
                            }
                            ?>
                            <td><?php echo $busesArray[$i]->timeMove ?></td>
                            <td><?php echo $busesArray[$i]->timeArrive ?></td>
                            <td><?php echo $busesArray[$i]->fees ?></td>
                            <?php if($busesArray[$i]->seatsLeft > 0)
                            {
                                $tempStudentId = $_SESSION['loggedId'];
                                $tempBusId = $busesArray[$i]->id;
                                if($isRegistered == $busesArray[$i]->id)
                                {
                                    $action = 0;
                                     echo "<td class='bg-white'> <input type='submit' name='registerInThisBus' id='registerInThisBus' class='btn btn-outline-danger' value='CANCEL' onclick='registerInBus($tempBusId, $tempStudentId, $action)'> </td>";
                                }
                                else
                                {
                                    $action = 1;
                                    echo "<td> <input type='submit' name='registerInThisBus' id='registerInThisBus' class='btn btn-outline-primary' value='REGISTER' onclick='registerInBus($tempBusId, $tempStudentId, $action)'> </td>";
                                }
                            }
                            else
                            {
                                $tempStudentId = $_SESSION['loggedId'];
                                $tempBusId = $busesArray[$i]->id;
                                if($isRegistered == $busesArray[$i]->id)
                                {
                                    $action = 0;
                                    echo "<td class='bg-white'> <input type='submit' name='registerInThisBus' id='registerInThisBus' class='btn btn-outline-danger' value='CANCEL' onclick='registerInBus($tempBusId, $tempStudentId, $action)'> </td>";
                                }
                                else
                                {
                                echo "<td><input type='submit' name='registerInThisBus' class='btn btn-outline-secondary' value='FULL' disabled></td>";
                                }
                            }
                            ?>
                            </tr>
                            <?php
                    }
                        ?>
                    
                  
                </tbody>
                </table>
                    <div id="returnAfterRegister"></div>
                <?php
                        
        
        }
    }
?>

<script>

    function registerInBus(busId, studentId, action)
    {
        var xmlhttp = new XMLHttpRequest();
        xmlhttp.onreadystatechange = function() {
            if (this.readyState == 4 && this.status == 200) {
                //alert(this.responseText);
                //document.getElementById("returnAfterRegister").innerHTML = this.responseText;
                location.reload();
            } else {
                //alert(this.status + " " + this.readyState);
            }
        };
        xmlhttp.open("GET", "registerInBus.php?bid=" + busId + "&sid=" + studentId + "&action=" + action, true);
        xmlhttp.send();
    }

    function xmlUpdate(notifyId, notifyIsRead){

          var xmlhttp = new XMLHttpRequest();
        xmlhttp.onreadystatechange = function() {
            if (this.readyState == 4 && this.status == 200) {
                //alert(this.responseText);
            } else {
                //alert(this.status + " " + this.readyState);
            }
        };
        xmlhttp.open("GET", "update_notification.php?ni=" + notifyId + "&nir=" + notifyIsRead, true);
        xmlhttp.send();
        location.reload();
    }
  </script>

  <style>
      
      table { border-collapse: separate; }
        td { border: solid 1px #000; }
        tr:first-child th:first-child { border-top-left-radius: 20px; }
        tr:first-child th:last-child { border-top-right-radius: 20px; }

      .tinyLine{
          width: 100%;
          color:rgb(230, 230, 230);;
      }
        .myId{
            
            border: 1px solid rgb(220, 220, 220); 
            border-radius: 10px;
            width: 30%; 
            height:220px;
            background-color: #fff;
            margin:0 auto;
            margin-top:160px;
            box-shadow: 2px 2px 5px rgb(230, 230, 230);
            padding: 6px;
            transition: all 0.4s ease;
        }

        .myId:hover {
            transform: translateY(9px);
            transition: all 0.4s ease;
            background-color: rgb(252, 252, 252); 
            box-shadow: 6px 6px 9px rgb(230, 230, 230);
        }

        .student_img, .student_qr{
            width: 75px;
            float:right;
            border-radius: 20px;
            margin-right:18px;
            margin-top: -75px;
            vertical-align:middle;
            
        }

        .student_img{
            height: 70px;
        }

        .student_qr{
            margin-right: 100px;
        }

        .pharaoh_image
        {
            float:left;
            width: 70px;
            position: absolute;
            opacity: 0.1;
            margin-left: 10px;
        }

        .schoolName{
            text-align: center;
            padding-top:4px;
        }

        h3{
            text-align: center;
            margin-top: -5px;
        }

        .components{
            margin-left:8px;
            margin-top:16px;
        }

        .c{
            margin-bottom:1px;
        }
  </style>
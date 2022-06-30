<?php
  require_once '../../userModel.php';
  require_once '../../examModel.php';
  require_once '../../homeworkModel.php';
  require_once '../../questionModel.php';
  require_once '../../attendanceInterface.php';
  require_once '../../assignInterface.php';
  require_once '../../userModel.php';


  class TeacherModel extends user
  {
  	public $usersObj;
  	public $studentsArr=array();
    public $teacherType;
    public $mydb;
    
    public function __construct()
    {
      $this->mydb = DB::getInstance();
    }

  	public function selectAllStudents($user = null)
  	{
  		$user=new user();
  		$user->assignAll();
  		$this->usersObj=$user->usersArray;
  		for($i=0;$i<count($this->usersObj);$i++)
  		{
  			if($this->usersObj[$i]->user_type == 3)
  			{
  				array_push($this->studentsArr,$this->usersObj[$i]);
  			}
  		}
  		return $this->studentsArr;
  	}
  	
    public function SelectHomework($hw = null)
    {
        $hw = new homework();
        $hw->assignAll();
        $this->hw = $hw->hwArr;
        for($i=0;$i<count($this->hw);$i++)
        {
          array_push($this->hwArr,$this->hw[$i]);
        }
    }
    

    public function addHomeWork($subject_id, $title, $degree, $details, $image, $deadline)
    {
        $insertHwQuery = "INSERT INTO homework (subject_id, title, degree, details, image, deadline) 
                         VALUES ($subject_id,'$title', $degree,'$details','$image','$deadline')";
      
      if($this->mydb->query($insertHwQuery) !== true)
      {
        echo"something went wrong ";
        die(mysqli_error($this->mydb));
      }
      else
      {
        echo"<div class='text-success' style='text-align:center;'>Successfully added.</style>";
       // header('location:?step=addquestions');    // with respect homework id -- later
      }

    }

    /*public function selectExams($exam = null)
  	{
        $exam = new Exam();
        $exam->assignAll();
        $this->exam = $exam->questions;
        for($i=0;$i<count($this->exam);$i++)
        {
          array_push($this->qArray,$this->exam[$i]);
        }
        return $this->qArray;
    }*/
    
    /*public function AddExam()
    {

    }

    public function addAttendancePassword()
    {

    }

    public function addAttendance()
    {
      
    }*/

  }

 ?>

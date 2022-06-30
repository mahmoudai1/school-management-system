<?php
    require_once '../../userModel.php';
    if(session_status() == PHP_SESSION_NONE){session_start();}
  
class ParentModel{

  public $studentsArr = array();
  public $parentId;
  public $studentId;
  public $mydb;

  public function __construct()
  {
      $this->mydb = DB::getInstance();
  }

  public function displayStudentPage($studentId)
  {

  }

  public function insertNewFees($methodId, $optionId, $value, $studentId)
  {
      $userId = $_SESSION['loggedId'];

      $query = "SELECT id FROM registration WHERE student_id = $studentId";
      $queryResult = mysqli_query($this->mydb, $query);
      $rows = mysqli_fetch_assoc($queryResult);
      if($queryResult && $rows)
      {
          $reg_id = $rows['id'];

          $query = "INSERT INTO payment_options_values (payment_id, option_id, value, user_id, registration_id) VALUES ($methodId, $optionId, '$value', $userId, $reg_id)";
          if($this->mydb->query($query) !== true)
          {
            $error = mysqli_error($this->mydb);
            echo "<div style='text-align:center; margin-top:15px;' class='text-danger'>$error</div>";
            return false;
          }
          return true;
        }
        else
        {
          return false;
        }
  }
}
  ?>

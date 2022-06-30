<?php
require_once 'addQuestionInterface.php';

class Question implements AddQuestion{
  public $id;
  public $questionType;
  public $questionTitle;
  public $answer;
  public $choices = array();
  public $questionDegree;
  public $mydb;

  function __construct()
  {
    $this->mydb = DB::getInstance();
  }
  
  public function assignAll()
  {
    $selc = $this->select("*","question_bank",'');
    while($row1=mysqli_fetch_assoc($selc))
    {
      $qObj=new question();
      $this->assignQuestion($row1,$qObj);
      array_push($this->qs,$qObj);
    }
  }
  public function assignQuestion($row,$qObj)
  {
    $qObj->question = $row['question'];
    $qObj->type = $row['type'];
    $qObj->answer = $row['answer'];
    $qObj->id = $row['id'];
  }

  public function select($which, $tableName, $condition = '')
  {
         $selectQuery = "SELECT $which FROM $tableName $condition";
         $selectQueryResult = mysqli_query($this->mydb, $selectQuery);
         return $selectQueryResult;
  }

  public function addQuestion()
  {
    
  }

}
?>

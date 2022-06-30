<?php 
  require_once 'addQuestionInterface.php';

 class Exam implements AddQuestion
   {
     public $id;
     public $examdate;
     public $question;
     public $answer;
     public $type;
     public $starttime;
     public $examDuration;
     public $examinfo;
     public $examTitle;
     public $academicYear;
     public $examDegree;
     public $questions = array();
     public $mydb;

     function __construct()
     {
      $this->mydb = DB::getInstance();
     }

     public function assignAll()
     {
     	$selected1 = $this->select("*", "question_bank", '');
	    while($row1 = mysqli_fetch_assoc($selected1))
            {
                $exam = new Exam();
                $this->assignQuestions($row1,$exam);
                array_push($this->questions, $exam);
            }
     }

    public function assignQuestions($row,$exam)
     {
     	$exam->question=$row['question'];
     	$exam->type=$row['type'];
     	$exam->answer=$row['answer'];
     	$exam->id=$row['id'];
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
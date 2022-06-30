<?php
require_once 'questionModel.php';
require_once 'addQuestionInterface.php';
require_once 'assignInterface.php';

class Homework implements AddQuestion, Assign{
  public $id;
  public $type;
  public $title;
  public $degree;
  public $details;
  public $image;
  public $deadline;
  public $mydb;
  public $qArr= array();
  public $hwArr= array();


  function __construct()
  {
    $this->mydb = DB::getInstance();
  }

  public function assignAll()
  {
    $selc=$this->select("*", "homework", '');
    while($row1=mysqli_fetch_assoc($selc))
    {
      $hwObj=new Homework();
      $this->assignHomework($hwObj,$row1);
    }
    array_push($this->hwArr,$hwObj);
  }

  public function select($which, $tableName, $condition = '', $order = '')
  {
      $selectQuery = "SELECT $which FROM $tableName $condition $order";
      $selectQueryResult = mysqli_query($this->mydb, $selectQuery);
      return $selectQueryResult;
  }
  
  public function assignHomework($hwObj,$row1)
  {
    $hwObj->id=$row1['id'];
    $hwObj->type=$row1['type'];
    $hwObj->title=$row1['title'];
    $hwObj->degree=$row1['degree'];
    $hwObj->details=$row1['details'];
    $hwObj->image=$row1['image'];
    $hwObj->deadline=$row1['deadline'];
  }

  public function addQuestion()
  {
    
  }
}
 ?>

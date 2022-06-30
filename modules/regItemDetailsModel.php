<?php

  //require_once 'DB.php';

class RegItemDetModel{
   public $id;
   public $reg_id;
   public $item_id;
   public $value;
   public $DetailsArr=array();
   public $mydb;

   function __construct()
   {
    $this->mydb = DB::getInstance();
   }
   public function AddDetails()
   {

   }

   public function selectRegItemDetails()
   {
     $selected1=$this->select("*","registration_item_details");

     while($row1 = mysqli_fetch_assoc($selected1))
     {
       $DetailsObj = new RegItemDetModel();
       $DetailsObj->id = $row1['id'];
       $DetailsObj->reg_id = $row1['reg_id'];
       $DetailsObj->item_id = $row1['item_id'];
       $$DetailsObj->value = $row1['value'];
       array_push($this->$DetailsArr, $DetailsObj);
     }
     return $this->$DetailsArr;
   }


   public function AddRegItemDetails($ct, $reg_id, $item_id, $value)
   {
    //$selectQuery0 = "SELECT item_id, reg_id FROM registration_item_details WHERE reg_id = $reg_id";
    //$selectQuery0Result = mysqli_query($this->mydb, $selectQuery0);
    //$num0OfRows = mysqli_num_rows($selectQuery0Result);


     $selectQuery = "SELECT student_id FROM registration WHERE id = $reg_id";
     $selectQueryResult = mysqli_query($this->mydb, $selectQuery);

     if($selectQueryResult)
     {
        $row = mysqli_fetch_assoc($selectQueryResult);
        $student_id = $row['student_id'];

        if($ct == 0)
        {
            $insertQuery = "INSERT INTO student_bill (student_id) VALUE ($student_id)";
            if($this->mydb->query($insertQuery) !== true)
            {
                echo mysqli_error($this->mydb);
            }
        }
        $selectQuery3 = "SELECT id FROM student_bill WHERE student_id = $student_id";
        $selectQuery3Result = mysqli_query($this->mydb, $selectQuery3);
        while($row3 = mysqli_fetch_assoc($selectQuery3Result))
        {
          $student_bill_id = $row3['id'];
        }


          $insertQuery2 = "INSERT INTO registration_item_details (reg_id, item_id, value, student_bill_id)
          VALUES ($reg_id, $item_id, $value, $student_bill_id)";
          if($this->mydb->query($insertQuery2) !== true)
          {
                  echo mysqli_error($this->mydb);
          }
    }
   }

   public function select($which, $tableName, $condition='')
   {
     $selectQuery = "SELECT $which FROM $tableName $condition";
     $selectQueryResult = mysqli_query($this->mydb, $selectQuery);
     return $selectQueryResult;
   }
 }
 ?>

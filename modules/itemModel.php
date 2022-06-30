<?php
//require 'Employee/View/employeeView.php';

 class ItemModel{

   public $name;
   public $price;
   public $itemsarray=array();
   public $mydb;

   function __construct()
   {
    $this->mydb = DB::getInstance();
   }

   public function selectall()
   {

   }

   public function additems($itemName, $itemValue)
   {
     $this->name = $itemName;
     $this->price = $itemValue;
     $query = "INSERT INTO items (name,value) VALUES ('$this->name', $this->price)";

     $messageSuccess = mysqli_fetch_assoc($this->select("message", "system_messages", "WHERE type = 'addItemSuccess'"));
     $messageSuccess = $messageSuccess['message'];

     $messageError = mysqli_fetch_assoc($this->select("message", "system_messages", "WHERE type = 'addItemError'"));
     $messageError = $messageError['message'];

     if(isset($this->name) && isset($this->price))
     {
        if(ctype_alpha($this->name) && is_numeric($this->price))
        {
            if($this->mydb->query($query) !==true)
            {
              echo mysqli_error($this->mydb);
              echo "<div class='text-danger' style='text-align:center; margin-top:30px; margin-bottom: 60px; '>$messageError</div>";
              }
            else
            {
              echo "<div class='text-success' style='text-align:center; margin-top:30px; margin-bottom: 60px; '>$messageSuccess</div>";
            }
        }
        else
        {
          echo "<div class='text-danger' style='text-align:center; margin-top:30px; margin-bottom: 60px; '>$messageError</div>";
        }
   }
   }


   public function selectallitems()
   {
     $selected1 = $this->select("*","items",'');

     while($row1 = mysqli_fetch_assoc($selected1))
     {
       $itemsObj = new ItemModel();
       $itemsObj->name=$row1['name'];
       $itemsObj->price=$row1['value'];
       $itemsObj->id=$row1['id'];
       array_push($this->itemsarray,$itemsObj);
     }
     return $this->itemsarray;
   }


   public function getitemvalue($item_id)
   {
     $selectQuery = "SELECT * FROM 	items WHERE id = $item_id ";
     $queryResult = mysqli_query($this->mydb, $selectQuery);
     $rows= mysqli_fetch_assoc($queryResult);
     $obj=new ItemModel();
     $obj->price=$rows['value'];
     return $obj;
   }

   public function select($which,$tableName,$condition='')
   {
     $selectQuery = "SELECT $which FROM $tableName $condition";
     $selectQueryResult = mysqli_query($this->mydb,$selectQuery);
     return $selectQueryResult;
   }
 }

 ?>

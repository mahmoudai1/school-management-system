<?php
class Bill{

  public $billTitle;
  public $billDate;
  public $studentName;
  public $userId;
  public $studentid;
  public $billContent;
  public $netamount;
  public $id;
  public $semester_id;
  public $reg_id;
  public $date;
  public $item_name;

  public function fetchBills($rows)
  {
    $this->studentName=$rows['first_name']." ".$rows['second_name']." ".$rows['third_name'];
    $this->reg_id=$rows['reg_id'];
    $this->userId=$rows['user_id'];
    $this->semester_id=$rows['semester_id'];
    $this->id=$rows['sb_id'];
    $this->netamount=$rows['value'];
    $this->date=$rows['date_created'];
    $this->item_name=$rows['name'];
  }
}
 ?>

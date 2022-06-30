<?php
    require_once '../../DB.php';
    $db = DB::getInstance();

    $studentId = $_REQUEST['sid'];
    $busId = $_REQUEST['bid'];
    $action = $_REQUEST['action'];

    if($action == 1)
    {
        $query = "SELECT * FROM students_bus WHERE student_id = $studentId";
        $queryResult = mysqli_query($db, $query);
        if(mysqli_num_rows($queryResult) > 0)
        {
            $rows = mysqli_fetch_assoc($queryResult);
            $prevBusId = $rows['bus_id'];

            $prevUpdate = "UPDATE bus SET seats_left = seats_left + 1 WHERE id=$prevBusId";
            $update = "UPDATE bus SET seats_left = seats_left - 1 WHERE id=$busId";
            $query = "UPDATE students_bus SET bus_id=$busId, registered_date=CURRENT_TIMESTAMP() WHERE student_id=$studentId";
            if($db->query($query) !== true || $db->query($update) !== true || $db->query($prevUpdate) !== true)
            {
                $error = mysqli_error($this->mydb);
                echo "<div style='text-align:center; font-size: 18px; margin-top:15px;' class='text-danger'><strong>$error</strong></div>";
            }
            else
            {
                echo "<div style='text-align:center;  font-size: 18px; margin-top:15px;' class='text-success'><strong>Successfully Updated</strong></div>";
            }
        }
        else
        {
            $update = "UPDATE bus SET seats_left = seats_left - 1 WHERE id=$busId";
            $query = "INSERT INTO students_bus (bus_id, student_id) VALUES ($busId, $studentId)";
            if($db->query($query) !== true || $db->query($update) !== true)
            {
                $error = mysqli_error($this->mydb);
                echo "<div style='text-align:center;  font-size: 18px; margin-top:15px;' class='text-danger'><strong>$error</strong></div>";
            }
            else
            {
                echo "<div style='text-align:center;  font-size: 18px; margin-top:15px;' class='text-success'><strong>Successfully Registered</strong></div>";
            }
        }
    }
    else if($action == 0)
    {
        $query = "UPDATE bus SET seats_left = seats_left + 1 WHERE id=$busId";
        $query2 = "DELETE FROM students_bus WHERE student_id=$studentId";
        if($db->query($query) !== true || $db->query($query2) !== true)
        {
            $error = mysqli_error($this->mydb);
            echo "<div style='text-align:center;  font-size: 18px; margin-top:15px;' class='text-danger'><strong>$error</strong></div>";
        }
        else
             echo "<div style='text-align:center;  font-size: 18px; margin-top:15px;' class='text-success'><strong>Successfully Cancelled</strong></div>";
    }
?>
<?php
    require_once '../../DB.php';
    $db = DB::getInstance();

    $gradingMethodId = $_REQUEST['gid'];
    $query = "DELETE FROM grading_method WHERE id = $gradingMethodId";
    if(mysqli_query($db, $query) !== true)
    {
        echo "Something went wrong";
    }
    else
    {
        //header("Refresh:0");
        //echo "Deleted";
    }
?>
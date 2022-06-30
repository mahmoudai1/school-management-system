<?php
    require_once '../../DB.php';

    $db = DB::getInstance();
    $notifyId = $_REQUEST['ni'];
    $notifyIsRead = $_REQUEST['nir'];

    if($notifyIsRead == 0)
    {
        $notifyIsRead = 1;
    }

    $query = "UPDATE notification SET IsRead = $notifyIsRead WHERE id = $notifyId";
    if($db->query($query) !== true)
    {
        echo mysqli_error($db);
    }
    
    
?>
<?php
    require_once '../../DB.php';
    require_once 'paymentOptionsView.php';
    $db = DB::getInstance();

    if(isset($_REQUEST['pmn']))
    {
        $paymentMethod = $_REQUEST['pmn'];
        $query0 = "SELECT id FROM payment_method WHERE name='$paymentMethod'";
        $query0Result = mysqli_query($db, $query0);
        $row0 = mysqli_fetch_assoc($query0Result);
        $tempPmID = $row0['id'];
        $query2 = "SELECT HTML FROM payment_rendered_html WHERE payment_method_id = $tempPmID";
        $query2Result = mysqli_query($db, $query2);
        //$tempRow = mysqli_fetch_assoc($query2Result);
        $paymentOptionsView = new PaymentOptionsView();
        if(isset($tempRow))
        {
            ?>
            <?php
                echo $tempRow['HTML'];      // Just Temp...
            ?>
             <?php
        }
        else
        {
            $query = "SELECT po.name, po.type, po.id AS poID, pm.id AS pmID
            FROM payment_options po 
            JOIN payment_method pm
            ON po.payment_id = pm.id
            WHERE pm.name='$paymentMethod'";
            $queryResult = mysqli_query($db, $query);
            if(mysqli_num_rows($queryResult) > 0)
            {
                $paymentOptionsView->startOfPaymentPage();
                while($row = mysqli_fetch_assoc($queryResult))
                {
                    $paymentOptionsView->middleOfPaymentPage($row);
                }
                $paymentOptionsView->buttonOfPayment($paymentMethod);
                $paymentOptionsView->endOfPaymentPage();
            }
        }
    
    }

    
    
?>
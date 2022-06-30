<?php
    class PaymentOptionsView
    {
        public function startOfPaymentPage()
        {
            ?>
            <form action="" style="width: 30%; margin: 0px auto;" method="POST" >
            <div class="input-group mb-3">
                <input type="text" class="form-control"  name="studentId" placeholder="Your Student ID" required>
            </div>
                <div class="input-group mb-3">
                    <div class="input-group" id="options">
            <?php
        }

        public function middleOfPaymentPage($row)
        {
            $type = $row['type'];
            $name = ucfirst($row['name']);
            $poID = $row['poID'];
            $pmID = $row['pmID'];
            echo "<div class='input-group mb-2'>";
            if($name == "MM/YY")
            {
                echo "<input type='$type' class='form-control'  name='optionValue[]' placeholder='$name' required pattern='[0-9][0-9]/[0-9][0-9]'>";
            }
            else
                echo "<input type='$type' class='form-control'  name='optionValue[]' placeholder='$name' required>";
    
            echo "<input type='hidden' name='optionId[]' value='$poID'>";
            echo "<input type='hidden' name='methodId[]' value='$pmID'>";
    
            echo "</div>";
        }

        public function endOfPaymentPage()
        {
            ?>
                </div>
                    </div>
            </form>
            <?php
        }

        public function buttonOfPayment($paymentMethod)
        {
            if($paymentMethod == "paypal")
                echo "<button type='submit' name='payNow' class='btn btn-outline-success' style='width: 100%; margin-top:10px;'><i class='fa fa-paypal' style='font-size:20px;'></i> &nbsp<strong>NEXT</strong></button>";
            else if($paymentMethod == "fawry")
                echo "<button type='submit' name='payNow' class='btn btn-outline-success' style='width: 100%; margin-top:10px;'><i class='fa fa-lock' style='font-size:20px;'></i> &nbsp<strong>CONFIRM</strong></button>";
            else
                echo "<button type='submit' name='payNow' class='btn btn-outline-success' style='width: 100%; margin-top:10px;'><i class='ion-ios-locked' style='font-size:20px;'></i> &nbsp<strong>PAY</strong></button>";
            
        }
    }
    
?>
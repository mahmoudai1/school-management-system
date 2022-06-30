<?php
    class ParentView{

        public function displayDashboardPage()
        {
            echo "<h1 style='text-align:left;  margin-top:40px; margin-bottom: 80px; margin-left:25px;'>Parent Dashboard</h1>";
            ?>
            <div style="width:75%; margin: 0 auto;">
                <div class="d-flex justify-content-center" style="margin: 0 auto;">
                <div class="col-sm-2" style="text-align:center;">
                    <a href="?page=PayFees">
                    <button type="button" class="btn btn-outline-dark" style="width: 180px; padding: 15px 0;">
                    <i class="ion-cash" style="font-size:50px;"></i>
                    <p class="card-text">Pay Fees</p>
                    </button>
                    </a>
                </div>
                </div>
            </div>
            <?php
        }

        public function payFeesPage($methods)
        {
            echo "<h1 style='text-align:center;  margin-top:40px; margin-bottom: 80px;'>Pay Fees</h1>";
            ?>
                <div class="input-group mb-3" style="width: 30%; margin: 0 auto;">
                    <div class="input-group">
                        <select class="custom-select" onchange="document.getElementById('methodNameV2').value=this.options[this.selectedIndex].text; xmlUpdate(this.value);" required>
                            
                            <?php
                        echo "<option value='' disabled selected>Select Payment Method:</option>";
                            for($i = 0; $i < count($methods); $i++)
                            {
                                    echo "<option>".ucfirst($methods[$i]->name)."</option>";
                            }
                        ?>
                        </select>
                    </div>
                </div>
                <div id="options"></div>
              <input type="hidden" id="methodNameV2" name="methodNameV2" value="">

            <?php
        }

        public function showMsgAfterPay($state, $fees)
        {
            if($state == 1)
            {
                echo "<div style='text-align:center; margin-top:15px;' class='text-success'><strong>Successfully Paid EGP$fees, Thank You.</strong></div>";
                header("refresh: 4");
            }
            else
                echo "<div style='text-align:center; margin-top:15px;' class='text-danger'>Process Failed</div>";

            
        }
    }
?>

<script>
    function xmlUpdate(paymentMethod){
          var xmlhttp = new XMLHttpRequest();
        xmlhttp.onreadystatechange = function() {
            if (this.readyState == 4 && this.status == 200) {
                //alert(this.responseText);
                document.getElementById("options").innerHTML = this.responseText;
            } else {
                //alert(this.status + " " + this.readyState);
            }
        };
        xmlhttp.open("GET", "paymentOptions.php?pmn=" + paymentMethod.toLowerCase(), true);
        xmlhttp.send();
    }
  </script>
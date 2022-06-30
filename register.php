<!DOCTYPE html>
<?php require 'registerServer.php'?>

<html lang="en">

<head>
<meta name="viewport" content="width=device-width, inital-scale=1.0">
    <meta charset="utf-8">
    <meta name="description" content="#">
    <meta name="keywords" content="#">

  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>

  <title>Pharaohs Registration</title>
</head>


<body>
        <h1 style="text-align: center; margin-top:80px;">
            <?php echo ucfirst($_REQUEST['type']) ?> Application
        </h1>

    <form action="register.php?type=<?php echo $_REQUEST['type'] ?>" style="width: 35%; margin: 50px auto;" method="POST" enctype="multipart/form-data">
        <div class="form-group">
            <div class="form-row">
                <div class="col-md-4">
                    <input type="text" class="form-control" placeholder="First name" required name="firstName" pattern="[a-z | A-Z][a-z | A-Z][a-z | A-Z]+">
                </div>
                <div class="col-md-4">
                    <input type="text" class="form-control" placeholder="Second name" required name="secondName"  pattern="[a-z | A-Z][a-z | A-Z][a-z | A-Z]+">
                </div>
                <div class="col-md-4">
                    <input type="text" class="form-control" placeholder="Third name" required name="thirdName"  pattern="[a-z | A-Z][a-z | A-Z][a-z | A-Z]+">
                </div>
            </div>
        </div>

        <div class="form-group">
            <input type="email" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Email" required name="email">
        </div>

        <div class="form-row">
            <div class="col-md-6 mb-2">
                <input type="text" class="form-control"  placeholder="Phone number" required maxlength="11" pattern="[0][1][0|1|2|5][0-9][0-9][0-9][0-9][0-9][0-9][0-9][0-9]" name="phoneNumber1">
            </div>
            <div class="col-md-6 mb-2">
                <input type="text" class="form-control"  placeholder="Alternative Phone number"  maxlength="11" pattern="[0][0|1|2|5][0-9][0-9][0-9][0-9][0-9][0-9][0-9][0-9][0-9]" name="phoneNumber2">
            </div>
        </div>

        <div class="form-row">
            <div class="col-md-6 mb-2 form-group" style="margin-top:7px;">
                <input type="password" id="inputPassword5" class="form-control" aria-describedby="passwordHelpBlock" placeholder="Password" name="password" required>
                <small id="passwordHelpBlock" class="form-text text-muted">
                    Your password should be 8-20 characters long, contain letters and numbers.
                </small>
            </div>
            <div class="col-md-6 mb-2 form-group" style="margin-top:7px;">
                <input type="password" id="inputPassword5" class="form-control" aria-describedby="passwordHelpBlock" placeholder="Confirm password" name="confirmPassword">
            </div>
            
        </div>

        <div class="form-row">
            <div class="col-md-6 mb-3">
                <input type="text" class="form-control" id="validationDefault03" placeholder="City" required name="city" pattern="[a-z | A-Z][a-z | A-Z]+">
            </div>
            <div class="col-md-3 mb-3">
                <input type="text" class="form-control" id="validationDefault04" placeholder="State" required name="state" pattern="[a-z | A-Z][a-z | A-Z]+">
            </div>
            <div class="col-md-3 mb-3">
                <input type="text" class="form-control" id="validationDefault05" placeholder="Zip" required name="zip" pattern="[0-9]+">
            </div>
        </div>

        <div class="form-group">
            <input type="text" class="form-control" placeholder="Date of birth" required name="dob">
        </div>

        <div class="form-group">
            <select class="custom-select my-1 mr-sm-2" id="inlineFormCustomSelectPref" name="gender" onchange="document.getElementById('selectedGender').value=this.options[this.selectedIndex].text">
                <option value='' disabled selected>Gender:</option>
                <option value="Male">Male</option>
                <option value="Female">Female</option>
            </select>
            <input type="hidden" name="selectedGender" id="selectedGender" value="" />
        </div>

        <div class="form-group">
                <div class="custom-file">
                    <input type="file" class="custom-file-input" id="customFile1" name="frontFaceImg">
                    <label class="custom-file-label custom-file-label1" for="customFile1">Front Face Image</label>
                </div>
        </div>

        <?php if($_REQUEST['type']=='student'): ?>
        <div class="form-group">
                <div class="custom-file">
                    <input type="file" class="custom-file-input" id="customFile2" name="birthCertificateImg">
                    <label class="custom-file-label custom-file-label2" for="customFile2">Birth Certificate</label>
                </div>
        </div>
        <?php else: ?>
        <div class="form-row">
            <div class="col-md-6 mb-2">
                <div class="custom-file">
                    <input type="file" class="custom-file-input" id="customFile3" name="identityFrontImg">
                    <label class="custom-file-label custom-file-label3" for="customFile3">Identity-Front</label>
                </div>
            </div>
            <div class="col-md-6 mb-2">
                <div class="custom-file">
                    <input type="file" class="custom-file-input" id="customFile4" name="identityBackImg">
                    <label class="custom-file-label custom-file-label4" for="customFile4">Identity-Back</label>
                </div>
            </div>
        </div>
        <?php endif; ?>
        <button type="submit" class="btn btn-primary" style="width: 100%; margin-top:5px;" name="apply">Apply</button>
        
    </form>
    <?php 
        if(isset($_POST['apply']))
        { require 'submitted.php';}; 
    ?>
</body>

<script>
            $('#customFile1').on('change',function(){
                var fileName = $(this).val().replace('C:\\fakepath\\', " ");
                $(this).next('.custom-file-label1').html(fileName);
            })
            $('#customFile2').on('change',function(){
                var fileName = $(this).val().replace('C:\\fakepath\\', " ");
                $(this).next('.custom-file-label2').html(fileName);
            })
            $('#customFile3').on('change',function(){
                var fileName = $(this).val().replace('C:\\fakepath\\', " ");
                $(this).next('.custom-file-label3').html(fileName);
            })
            $('#customFile4').on('change',function(){
                var fileName = $(this).val().replace('C:\\fakepath\\', " ");
                $(this).next('.custom-file-label4').html(fileName);
            })
        </script>
</html>
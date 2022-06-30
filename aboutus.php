<?php require_once 'modules/DB.php';?>

<!DOCTYPE html>

<html lang="en">


<head>

    <meta name="viewport" content="width=device-width, inital-scale=1.0">
    <meta charset="utf-8">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>

    <title>About us</title>

</head>

<body>
<h1 style="text-align:center;  margin-top:30px; margin-bottom: 30px;">About us</h1>
    <div style="text-align:left; margin:0 auto;">
        <?php 
            $db = DB::getInstance();
            $query = "SELECT * FROM about_us";
            $queryResult = mysqli_query($db, $query);
            $row = mysqli_fetch_assoc($queryResult);
            echo $row['html_data'];
        ?>
    </div>
</body>

</html>
<?php 
    require_once 'theme.php';
    $theme = new Theme();

 ?>

<!DOCTYPE html>


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

  <title>Pharaohs Application Status</title>
</head>


<body>
<h1 style="text-align: center; margin-top:80px;">
             Application Status
        </h1>
        <?php echo $theme->fetchTheme("app_status"); ?>
        <?php require_once 'applicationStatusServer.php' ?>
</body>
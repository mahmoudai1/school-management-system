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

  <title>Pharaohs Login</title>

  <body>

  <h1 style="text-align: center; margin-top:250px; font-size:64px;">
             Pharaohs Login
        </h1>

  <form action="" method="POST" style="width: 32%; margin: 30px auto;">
      <div class="form-group">
        <input type="number" class="form-control" placeholder="Enter your id" name="id" required>
      </div>

      <div class="input-group mb-3">
      <input type="password" class="form-control" id="exampleInputPassword1" placeholder="Password" name="password" required>
      <div class="input-group-append">
      <button type="submit" class="btn btn-outline-dark w-100" name="login">Login</button>
    </div>
</div>
<?php require_once 'loginServer.php' ?>
</form>

</body>

<style>
  form{
    padding: 20px 20px 8px 20px;
    border: 1px solid rgb(230, 230, 230);;
    border-radius: 10px;
    box-shadow: 1px 1px 10px rgb(240, 240, 240);
  }
</style>

</head>
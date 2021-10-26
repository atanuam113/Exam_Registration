<?php

session_start();
if (!isset($_SESSION['loggedin']) || $_SESSION['loggedin'] != true) 
{
 header("location: login.php");
  exit;
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Welcome</title>
</head>
<body>
<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-BmbxuPwQa2lc/FVzBcNJ7UAyJxM6wuqIj61tLrc4wSX0szH/Ev+nYRRuWlolflfl" crossorigin="anonymous">

    <title>welcome - <?php $_SESSION['username'] ?></title>
  </head>
  <body>
    <?php 
    require 'component/_navbar.php';
    require 'component/dbconnect.php';
  
    $r = $_SESSION['username'];
    $sql1 = "SELECT reg_no FROM $signup_table WHERE username='$r'";
    $reg=mysqli_query($conn,$sql1);
    $row1 = mysqli_fetch_assoc($reg);
    ?>
   
    <div class="container my-4">
      <div class="alert alert-success" role="alert">
        <h4 class="alert-heading">welcome - <?php echo $_SESSION['username'] ?></h4>
        <p>Hey, welcome to Exam_portal. You are logged in as <?php echo $_SESSION['username'] ?> and your registration number is <strong><?php echo $row1['reg_no'] ?></strong>, your exam will start as per schedule. Your response will save to database for official use . Submit your personal details , so that you can start the exam.</p>
        <hr>
        <p class="mb-0">Please fillup your personal details 
          <a href="form.php"> using this link.</a>
        </p>
      </div>
    </div>
    <!-- Optional JavaScript; choose one of the two! -->

    <!-- Option 1: Bootstrap Bundle with Popper -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta2/dist/js/bootstrap.bundle.min.js" integrity="sha384-b5kHyXgcpbZJO/tY9Ul7kGkf1S0CWuKcCD38l8YkeH8z8QjE0GmW1gYU5S9FOnJ0" crossorigin="anonymous"></script>

    <!-- Option 2: Separate Popper and Bootstrap JS -->
    <!--
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.6.0/dist/umd/popper.min.js" integrity="sha384-KsvD1yqQ1/1+IA7gi3P0tyJcT3vR+NdBTt13hSJ2lnve8agRGXTTyNaBYmCR/Nwi" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta2/dist/js/bootstrap.min.js" integrity="sha384-nsg8ua9HAw1y0W1btsyWgBklPnCUAFLuTMS2G72MMONqmOymq585AcH49TLBQObG" crossorigin="anonymous"></script>
    -->
    
  </body>
</html>
</body>
</html>

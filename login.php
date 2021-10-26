<?php
$login = false;
$showerror = false;
if ($_SERVER["REQUEST_METHOD"] == "POST") 
{
  include 'component/dbconnect.php';

  $username= $_POST["username"];
  $password= $_POST["password"];
  // $reg_no = $_POST["reg_no"];
  // echo $reg_no;

    $sql="SELECT  * FROM $signup_table where username='$username'";
    $result=mysqli_query($conn,$sql);
    // echo $result;
    $num = mysqli_num_rows($result);
    // echo "$password";

    if ($num == 1) 
    {
      while($row = mysqli_fetch_assoc($result))
      {
        
        if (password_verify($password,$row['password'])) 
        {
          
          $login = true; 
          session_start();
          $_SESSION['loggedin'] =true;
          $_SESSION['username'] =$username;
          // $row['reg_no'] = $reg;
          header("location: welcome.php");
        }
        else
          {
            $showerror = "Wrong password";
          }
      }
    }     
  else
  {
    $showerror = "invalid Credentials";
  }
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>login</title>
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
    <title>signup</title>
    
  </head>
  <body>
    <?php require 'component/_navbar.php'?>
    <?php
      if($login)
      {
          echo '<div class="alert alert-success alert-dismissible fade show" role="alert">
                <strong>success!</strong> You are logged in.
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close">
                  <span aria-hidden="true">&times;</span>
                </button>
              </div>';
      }  
      if($showerror)
      {
          echo '<div class="alert alert-danger alert-dismissible fade show" role="alert">
                <strong>error!</strong> '.$showerror.'
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close">
                  <span aria-hidden="true">&times;</span>
                </button>
              </div>';
      }  
    ?>
    <div class="container">
            <h1 class="text-center">Login to our website</h1>
            
          <form action="/exam_portal1/login.php" method="post">
            
            <div class="form-group col-md-6">
              <label for="username" class="form-label">Username</label>
              <input type="text" class="form-control" id="username" name="username" aria-describedby="emailHelp">
              <div id="emailHelp" class="form-text">We'll never share your email with anyone else.</div>
            </div>
            
            <div class="form-group col-md-6">
              <label for="password" class="form-label">Password</label>
              <input type="password" class="form-control" id="password" name="password">
            </div>
            <br>           
            <button type="submit" class="btn btn-primary form-group col md-6">Login</button>
        </form>

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
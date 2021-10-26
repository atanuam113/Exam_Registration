<?php
$showAlert = false;
$showerror = false;
if ($_SERVER["REQUEST_METHOD"] == "POST") 
{
  include 'component/dbconnect.php';

  $username= $_POST["username"];
  $password= $_POST["password"];
  $cpassword= $_POST["cpassword"];
  $reg_no = mt_rand(100000,999999);
  //cheak wheather the username exist
  $sqlexist="SELECT * FROM `$signup_table` WHERE username = '$username'";
  $result=mysqli_query($conn,$sqlexist);
  $numexistrows = mysqli_num_rows($result);
  // echo var_dump($numexistrows);
  if ($numexistrows > 0) 
  {
    //$exists =true;
    $showerror = "username already exist !";
  }
  else
  {
      $exists =false;
        if (($password==$cpassword)) 
        {
          $hash = password_hash($password,PASSWORD_DEFAULT);
          $sql="INSERT INTO `$database`.`$signup_table` (`username`, `password`, `date`, `reg_no`) VALUES ('$username', '$hash', current_timestamp(), '$reg_no')"; 
          $result=mysqli_query($conn,$sql);
          
          if ($result) 
          {
            $showAlert = true;
          }      
          
        }
        else
        {
          $showerror = "Password do not match !";
        }
  }      
        
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>signup</title>
    <style>
       #fm 
            {
                background-image: url(4K_ZmTW2vGMCxtIcw3.jpg);          
                background-repeat: no-repeat;
                height: 600px;
                width: 1350px;
                background-size: cover;
                background-position: center;
                position: left;
            }
      /* .fieldset
      {
        
      }       */
      .container
            {
                border: 3px solid black;
                text-align: left;
                position: fixed;
                /* right: 100px; */
                vertical-align: middle;
                background-position-x: center;
                background-position-y: center;
                margin left: 50% !important;
                /* max-width: 150px; */
                padding: 5px !important;
                color: black;
                font-weight: bolder;
                width: 500px !important;
                height: 560px;
                transform: translate(70%,2%);
                background-color: rgb(253, 400, 249,.3);
                /* margin left:100px; */
                /* display:block; */
                            } 
            #message 
            {
                display:none;
                background: #f1f1f1;
                color: #000;
                position: relative;
                /* padding: 10px; */
                margin-top: 10px;
            }

        #message p 
            {
                padding: 1px 35px;
                font-size: 13px;
            }

        /* Add a green text color and a checkmark when the requirements are right */
        .valid 
            {
                color: green;
            }

        .valid:before 
            {
                position: relative;
                left: -35px;
                content: "✔";
            }

        /* Add a red text color and an "x" when the requirements are wrong */
        .invalid 
            {
                color: red;
            }

        .invalid:before 
            {
                position: relative;
                left: -35px;
                content: "✖";
            }       
    </style>
    
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
      if($showAlert)
      {
          echo '<div class="alert alert-success alert-dismissible fade show" role="alert">
                <strong>success!</strong> Your account is now created and you can login now.
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
    <div id="fm">
            <!-- <h1 class="text-center">signup to our website</h1> -->
            
          <form action="/exam_portal1/signup.php" method="post" class="container">
           <fieldset>
           <!-- <legend>Create a username and password:</legend> -->
           <!-- <p>Create a username and password:</p> -->
           <label for="">Create a username and password:</label>
           <div class="form-group col-md-6">
              <label for="username" class="form-label">Username</label>
              <input type="text" class="form-control" maxlength="20" id="username" name="username" aria-describedby="emailHelp">
              <!-- <div id="emailHelp" class="form-text">We'll never share your email with anyone else.</div> -->
              <small>We'll never share your email.</small>
            </div>
            <div class="form-group col-md-6">
            <label for="password" class="form-label">Password</label>
              <input type="password" maxlength="15" class="form-control" id="password" name="password" pattern="(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{8,}" required>
            </div>
            <input type="checkbox" onclick="myFunction()">Show Password 
            
             <!--Script for pattern matching-->
               <div id="message">
                        <h3>Password must contain the following:</h3>
                        <p id="letter" class="invalid">A <b>lowercase</b> letter</p>
                        <p id="capital" class="invalid">A <b>capital (uppercase)</b> letter</p>
                        <p id="number" class="invalid">A <b>number</b></p>
                        <p id="length" class="invalid">Minimum <b>8 characters</b></p>
                </div>
       
            
            <div class="form-group col-md-6">
              <label for="cpassword" class="form-label">Confirm Password</label>
              <input type="password" class="form-control" id="cpassword" name="cpassword">
              <small>Rewrite the password</small><br>
            </div>
           
            <button type="submit" class="btn btn-primary form-group col md-6">Signup</button>
            <script>
                            function myFunction() 
                            {
                                var x = document.getElementById("password");
                                if (x.type === "password") 
                                {
                                    x.type = "text";
                                } else 
                                {
                                    x.type = "password";
                                }
                            }
              </script>
                <script>
                    var myInput = document.getElementById("password");
                    var letter = document.getElementById("letter");
                    var capital = document.getElementById("capital");
                    var number = document.getElementById("number");
                    var length = document.getElementById("length");
                    
                    // When the user clicks on the password field, show the message box
                    myInput.onfocus = function() 
                    {
                        document.getElementById("message").style.display = "block";
                    }
                    
                    // When the user clicks outside of the password field, hide the message box
                    myInput.onblur = function() 
                    {
                        document.getElementById("message").style.display = "none";
                    }
                    
                    // When the user starts to type something inside the password field
                    myInput.onkeyup = function() 
                    {
                            // Validate lowercase letters
                            var lowerCaseLetters = /[a-z]/g;
                            if(myInput.value.match(lowerCaseLetters)) 
                            {  
                            letter.classList.remove("invalid");
                            letter.classList.add("valid");
                            }
                            else 
                            {
                            letter.classList.remove("valid");
                            letter.classList.add("invalid");
                            }
                            
                            // Validate capital letters
                            var upperCaseLetters = /[A-Z]/g;
                            if(myInput.value.match(upperCaseLetters)) 
                            {  
                            capital.classList.remove("invalid");
                            capital.classList.add("valid");
                            }
                            else 
                            {
                            capital.classList.remove("valid");
                            capital.classList.add("invalid");
                            }
                        
                            // Validate numbers
                            var numbers = /[0-9]/g;
                            if(myInput.value.match(numbers)) 
                            {  
                            number.classList.remove("invalid");
                            number.classList.add("valid");
                            }
                            else 
                            {
                            number.classList.remove("valid");
                            number.classList.add("invalid");
                            }
                            
                            // Validate length
                            if(myInput.value.length >= 8) 
                            {
                            length.classList.remove("invalid");
                            length.classList.add("valid");
                            }
                            else 
                            {
                            length.classList.remove("valid");
                            length.classList.add("invalid");
                            }
                        }
                    </script>
           </fieldset>
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
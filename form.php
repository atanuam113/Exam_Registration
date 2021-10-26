 <?php
session_start();
include 'component/dbconnect.php';
//Store data into database by POST method
if ($_SERVER['REQUEST_METHOD'] == 'POST')
{
    

    //Variables that used to send data into database
    $fname=$_POST['fname']; 
    $lname=$_POST['lname']; 
    $email=$_POST['email']; 
    $mno=$_POST['mno']; 
    $v_reg=$_POST['v_reg_no'];
    $birthday=$_POST['birthday']; 
    $p_add=$_POST['p_add']; 
    $mstatus=$_POST['mstatus']; 
    $lang=$_POST['lang']; 


    //Cheak for Table exist or not
    $scheak ="SELECT * FROM `$database`.`$p_details_table` WHERE ROWNUM=1";
    $rcheak =mysqli_query($conn,$scheak);
    if ($rcheak) 
    {
        echo "<br>Table is already exist !";
    }
    else
    {
        //Create table in the database

        $sql ="CREATE TABLE `users_login`.`$p_details_table` ( `s_no` INT(3) NOT NULL AUTO_INCREMENT ,  `First_name` VARCHAR(15) NOT NULL ,  `Last_name` VARCHAR(15) NOT NULL ,  `Email` VARCHAR(30) NOT NULL ,  `Mobile_number` INT(11) NOT NULL , `v_reg_no` INT(11) NOT NULL ,  `Birthday` DATE NOT NULL ,`Permanent_address` VARCHAR(30) NOT NULL ,  `Marital_status` VARCHAR(10) NOT NULL ,  `Language_know` VARCHAR(30) NOT NULL ,    PRIMARY KEY  (`s_no`)) ENGINE = InnoDB;";
        $result =mysqli_query($conn,$sql);

        //Cheak for table creation
        // if ($result)
        // {
        // echo "<br>The table is created successfully !";
        // }
        // else
        // {
        // echo "<br>The table is not created successfully !";
        // }
    }
    
    // Find the registration number from database
    $r = $_SESSION['username'];
    $sql = "SELECT * FROM $signup_table WHERE username='$r'";
    $reg=mysqli_query($conn,$sql);
    $row1 = mysqli_fetch_assoc($reg);
    $r_no = $row1['reg_no'];
    // check personal details already entered or not
    $table_exist="SELECT * FROM `$p_details_table` WHERE v_reg_no = '$r_no'";
    $result1=mysqli_query($conn,$table_exist);
    $numexistrows1 = mysqli_num_rows($result1);
    if ($numexistrows1 > 0) {
        // echo "Your personal details is already submitted";
        header("location: failed.php");
    }
    else
    {
      if ($row1['reg_no'] == $v_reg) {
    //Send data to database
    $rdb="INSERT INTO `$p_details_table` (`First_name`, `Last_name`, `Email`, `Mobile_number`,`v_reg_no`, `Birthday`,`Permanent_address`, `Marital_status`, `Language_know`) 
    VALUES ('$fname', '$lname', '$email', '$mno', '$v_reg', '$birthday','$p_add', '$mstatus', '$lang')";
    $r_db=mysqli_query($conn,$rdb);
    //Cheak for data insert
    if ($r_db)
    {
        // echo "Your form has been submitted !";
        header("location: success.php");
    }
    else
    {
        echo "We are facing some technical error !";
    }
    }
   else
   {
       echo "Your registration number is wrong";
   } 
} 
}  
?> 



<!DOCTYPE html>
<html>

<head>
    <title>Personal details</title>
    <style type>
    #io {
        p:hover {
            color: red;
            background-color: transparent;
            text-decoration: underline;
        }
    }

    input[type=submit] {
        background-color: #4CAF50;
        color: white;
        padding: 5px 10px;
        border: none;
        border-radius: 4px;
        cursor: pointer;
        float: left;
        margin: 5px 0;
    }

    /*  
    #form {
        /* background-image: url(4K_ZmTW2vGMCxtIcw3.jpg);           */
    background-repeat: no-repeat;
    height: 768px;
    width: 1466px;
    background-size: cover;
    background-position: center;
    position: left;
    }

    .cont {
        text-align: left;
        /* position: fixed; */
        /* right: 590px; */
        /* vertical-align: middle; */
        background-position-x: center;
        background-position-y: center;
        margin: 10px;
        max-width: 500px;
        padding: 5px;
        color: black;
        font-weight: bolder;
        width: 500px;
        height: 200px;
        transform: translate(40%, 70%);
        background-color: rgb(253, 251, 249, .3);
    }

    */
    </style>
    <!-- <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-BmbxuPwQa2lc/FVzBcNJ7UAyJxM6wuqIj61tLrc4wSX0szH/Ev+nYRRuWlolflfl" crossorigin="anonymous"> -->
    <!-- <script>
    function myfn() {
        window.open("exam.php");
    }
    </script> -->
</head>

<body>
    <?php
// require 'component/_navbar.php';
?>
    <div id="form">

        <form action="form.php" method="POST" name="exam_form" class="cont">
            <fieldset>
                <legend>Personal details:</legend>

                <label for="fname">First name:</label><br>
                <input type="text" id="fname" name="fname"><br>

                <label for="lname">Last name:</label><br>
                <input type="text" id="lname" name="lname"><br><br>

                <label for="email">Enter your email:</label>
                <input type="email" id="email" name="email"><br><br>

                <label for="mno">Enter your Mobile Number:</label>
                <input type="tel" id="mno" name="mno" maxlength="10" required><br><br>

                <label for="mno">Enter your registration Number:</label>
                <input type="tel" id="v_reg_no" name="v_reg_no" maxlength="10" required><br><br>

                <label for="birthday">Enter your Birthday:</label>
                <input type="date" id="birthday" name="birthday"> <br>

                <label for="p_add"> Permanent address</label><br>
                <textarea name="p_add" rows="5" cols="15"></textarea><br>

                <p>Marital Status:</p>
                <input type="radio" id="mstatus" name="mstatus" value="married">
                <label for="mstatus">Married</label><br>
                <input type="radio" id="mstatus" name="mstatus" value="unmarried">
                <label for="mstatus">Unmarried</label><br>

                <p>Primary Language:</p>
                <input type="radio" id="lang1" name="lang" value="Bengali">
                <label for="Bengali"> Bengali</label><br>
                <input type="radio" id="lang2" name="lang" value="English">
                <label for="lang2"> English</label><br>
                <input type="radio" id="lang3" name="lang" value="Hindi">
                <label for="lang3"> Hindi</label><br>

                <input type="submit" value="Sbmit details"><br><br>

                <input type="reset" value="clear"><br><br>

                <button onclick="window.print()">Print this page</button>

            </fieldset>

        </form>

    </div>
</body>

</html>
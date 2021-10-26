<?php
$server="localhost";
$username="root";
$password="";
$database="users_login";
$signup_table= "signup_details";
$p_details_table="personal_detail";
$conn= mysqli_connect($server, $username, $password, $database);
if (!$conn) 
{
    die ("error".mysqli_connect_error());
}

//Create table query
$sql1= "CREATE TABLE `$database`.`$signup_table` ( `s_no` INT(3) NOT NULL AUTO_INCREMENT ,  `username` VARCHAR(50) NOT NULL ,  `password` VARCHAR(255) NOT NULL ,  `date` DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP ,  `reg_no` INT(20) NOT NULL ,    PRIMARY KEY  (`s_no`)) ENGINE = InnoDB";
$result1= mysqli_query($conn,$sql1);

?>
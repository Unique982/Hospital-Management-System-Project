<?php 
 $_SERVER = "localhost:3307";
 $user = "root";
 $password = "";
 $dbname = "hospital_management_system";
 $conn = mysqli_connect($_SERVER, $user, $password, $dbname);
if(!$conn){
    die("Could not connect to database");
}
?>
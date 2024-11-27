<?php 
 $hostname = "localhost:3307";
 $user = "root";
 $password = "";
 $dbname = "hospital_management_system";
 $conn = mysqli_connect($hostname, $user, $password, $dbname);
if(!$conn){
    die("Could not connect to database");
}
?>
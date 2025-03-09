<?php
ob_start();
session_start();
include('../database/config.php');

$errors = [
    'name' => '',
    'email' => '',
    'number' => '',
    'message' =>'',

];
if (($_SERVER['REQUEST_METHOD'] === 'POST') && isset($_POST['contact_us'])) {
    $name = mysqli_real_escape_string($conn, $_POST['name']);
    $email = mysqli_real_escape_string($conn, $_POST['email']);
    $number = mysqli_real_escape_string($conn, $_POST['number']);
    $message = mysqli_real_escape_string($conn, $_POST['message']);
    // validation
    if(empty($name)){
        $errors['name'] = "Name is required";
    }
    elseif(!preg_match('/^[a-zA-Z\s]+$/',$name)){
        $errors['name'] = "Only use letter and space allowed";
    }
    if(empty($email)){
        $errors['email'] ='Email is required';
       }
       elseif(!filter_var($email,FILTER_VALIDATE_EMAIL)){
        $errors['email'] ='Invalid Email';
       }
       if(empty($number)){
        $errors['number'] ='Phone number is required';
       }
       elseif(!preg_match('/^\d{10}$/',$number)){
        $errors['number'] ='Please enter a valid phone number';
       }
       if(empty($message)){
        $errors['message'] = 'Message is required';
       }

    if (empty(array_filter($errors))) {
        $insert_sql = "INSERT INTO query_contact (`name`,`email`,`phone`,`message`)
 VALUES('$name','$email','$number','$message')";
        if (mysqli_query($conn, $insert_sql)) {
            $_SESSION['alert'] = "Thank your message successfully!";
            $_SESSION['alert_code'] = "success";
            header('Location: ../index.php');
            exit();
        } else {
            $_SESSION['alert'] = "Failed";
            $_SESSION['alert_code'] = "warning";
            header('Location: ../index.php');
            exit();
        }
    }
    // $_SESSION['errors'] = $errors; 
    // header('location:../index.php#contact');

    // exit();
}

ob_end_flush();
?>
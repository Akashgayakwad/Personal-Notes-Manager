<?php
    include('connection.php');
    session_start();
    $InvalidPassword='<p><strong>Your password should be atleast 6 characters long and include one capital letter and one number!</strong></p>';
    $missingPassword='<p><strong>Please enter a password!</strong></p>';
    $differentPassword='<p><strong>Passwords don\'t match!</strong></p>';
    $differentPassword2='<p><strong>Please confirm your password</strong></p>';
    $errors = '';
    if(!isset($_POST['user_id']) || !isset($_POST['key'])){
        echo '<div class="alert alert-danger">There was an error. Please click on the reset password link you received by email.</div>';
        exit;       
    }
    $user_id = $_POST['user_id'];
    $key = $_POST['key'];
    $time = time() - 86400;
    $user_id = mysqli_real_escape_string($link, $user_id);
    $key = mysqli_real_escape_string($link, $key);
    //Run query: to check database for match of user_id ,key and expiration time
    $sql = "SELECT user_id FROM forgotpassword WHERE rkey='$key' AND user_id='$user_id' AND TIME>'$time' AND status='pending'";
    $result = mysqli_query($link, $sql);
    if(!$result){
        echo '<div class="alert alert-danger">Error running the query!</div>';
        exit;
    }
    $count = mysqli_num_rows($result);
    if($count != 1){
        echo '<div class="alert alert-danger">Please try again.</div>';
        exit;
    }
    if(empty($_POST["password"])){
        $errors .= $missingPassword;
    }
    elseif(!((strlen($_POST["password"])>6) and preg_match('/[A-Z]/',$_POST["password"]) and preg_match('/[0-9]/',$_POST["password"]))){
        $errors .= $InvalidPassword;
    }
    else{
        $password = filter_var($_POST["password"],FILTER_SANITIZE_STRING);
        if(empty($_POST["password2"]))
        {
            $errors .= $differentPassword2;  
        }else{
            $password2 = filter_var($_POST["password2"],FILTER_SANITIZE_STRING);
                if($password !== $password2)
                {
                    $errors .= $differentPassword;
                }
        }
    }
    //display errors(if any)
    if($errors)
    {
        $resultMessage = '<div class="alert alert-danger">' . $errors . '</div>';
        echo $resultMessage;
        exit;
    }


    $password=mysqli_real_escape_string($link,$password);
    //$password = md5($password);
    $password = hash('sha256', $password);
    $user_id=mysqli_real_escape_string($link,$user_id);
    $sql= "UPDATE user SET password='$password'WHERE user_id='$user_id'";
    $result = mysqli_query($link, $sql);
    if(!$result){
        echo '<div class="alert alert-danger">There was a problem updating the password!</div>';
    }
    $sql= "UPDATE forgotpassword SET status='used'WHERE rkey='$key' AND user_id='$user_id'";
    $result = mysqli_query($link, $sql);
    if(!$result){
        echo '<div class="alert alert-danger">Error running the query</div>';
    }else{
          echo '<div class="alert alert-danger">Password updated successfully</div>';
          echo '<a href="index.php">login</a>';
     }
?>
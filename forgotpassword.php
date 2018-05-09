<?php
    //start session
    session_start();
    //connect to database
    include('connection.php');

    //define error messaages
    $errors ="";
    $missingEmail='<p><strong>Please enter your email address!</strong></p>';
    $InvalidEmail='<p><strong>Please enter a valid email address!</strong></p>';   


    //check email input
    if(empty($_POST["forgotemail"])){
        $errors .= $missingEmail;
    }else{
        $email = filter_var($_POST["email"],FILTER_SANITIZE_EMAIL);
            if(!filter_var($email,FILTER_VALIDATE_EMAIL))
            {
                $errors .= $InvalidEmail;
            }
    }

    //display errors(if any)
    if($errors)
    {
        $resultMessage = '<div class="alert alert-danger">' . $errors . '</div>';
        echo $resultMessage;
        exit;
    }

    $email = mysqli_real_escape_string($link,$email);
        

    //run query to check if email exists
    $sql ="SELECT * FROM users WHERE email = '$email'";
    $result = mysqli_query($link, $sql);
    if(!$result){
        echo '<div class="alert alert-danger">Error running the query!</div>';
        exit;
    }
    $count = mysqli_num_rows($result);
    if($count != 1){
        echo '<div class="alert alert-danger">This Email ID is not registeresd</div>';
        exit;
    }

    $row = mysqli_fetch_array($result,MYSQLI_ASSOC);
    $user_id= $row['user_id'];
    //create unique activation code
    $Key = bin2hex(openssl_random_pseudo_bytes(16));
    $time = time();
    $status = 'pending';

    //insert user details and activation key into database
    $sql ="INSERT INTO forgotpassword (user_id,rkey,time,status) VALUES ('$user_id','$key','$time','$status')";
    $result = mysqli_query($link, $sql);
    if(!$result){
        echo '<div class="alert alert-danger">There was an error inserting the user details in the database!</div>';
        exit;
    }
    

    //creating verification email content
    $message ="Please click on this link to reset your password:\n\n";
    $message .= "resetpassword.php?user_id=".$user_id."&key=".$key;
    
    //sending verification email and print success message
    if(mail($email, 'confirm your Registeration',$message,'From:'.'akashgayakwad123@gmail.com')){
        echo "<div class='alert alert-success'>An email has been sent to reset your password. Please click on the link to reset your password.</div>";
    }
?>
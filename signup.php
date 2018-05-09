<?php
    //start session
    session_start();
    //connecting to database
    include('connection.php');
    //define error messages
    $missingUsername='<p><strong>Please enter a username!</strong></p>';
    $missingEmail='<p><strong>Please enter your email address!</strong></p>';
    $InvalidEmail='<p><strong>Please enter a valid email address!</strong></p>';
    $InvalidPassword='<p><strong>Your password should be atleast 6 characters long and include one capital letter and one number!</strong></p>';
    $missingPassword='<p><strong>Please enter a password!</strong></p>';
    $differentPassword='<p><strong>Passwords don\'t match!</strong></p>';
    $differentPassword2='<p><strong>Please confirm your password</strong></p>';
    //define variables
    $errors='';
    $username='';
    $email='';
    $password='';
    //check filter and store username
    if(empty($_POST["username"])){
        $errors .= $missingUsername;
    }else{
        $username = filter_var($_POST["username"],FILTER_SANITIZE_STRING);
    }
    //check filter validate and store email
    if(empty($_POST["email"])){
        $errors .= $missingEmail;
    }else{
        $email = filter_var($_POST["email"],FILTER_SANITIZE_EMAIL);
        if(!filter_var($email,FILTER_VALIDATE_EMAIL))
        {
            $errors .= $InvalidEmail;
        }
    }
    //check,validate,filter and matches password
    if(empty($_POST["password"]))
    {
        $errors .= $missingPassword;
    }
    elseif(!((strlen($_POST["password"])>6) and preg_match('/[A-Z]/',$_POST["password"]) and preg_match('/[0-9]/',$_POST["password"])))
    {
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
    //preparing variables for the queries
    $username = mysqli_real_escape_string($link,$username);
    $email = mysqli_real_escape_string($link,$email);
    $password = mysqli_real_escape_string($link,$password);
    //$password = md5($password);
    $password = hash('sha256', $password);
    //checking if username already taken
    $sql ="SELECT * FROM users WHERE username = '$username'";
    $result = mysqli_query($link, $sql);
    if(!$result){
        echo '<div class="alert alert-danger">Error running the query!</div>';
        echo '<div class="alert alert-danger">' . mysqli_error($link) . '</div>';
        exit;
    }
    $results = mysqli_num_rows($result);
    if($results){
        echo '<div class="alert alert-danger">That username is already registered. Do you want to log in?</div>';
        //echo '<div class="alert alert-danger">' . mysqli_error($link) . '</div>';
        exit;
    }   
    //checking if email is already used
    $sql ="SELECT * FROM users WHERE email = '$email'";
    $result = mysqli_query($link, $sql);
    if(!$result){
        echo '<div class="alert alert-danger">Error running the query!</div>';
        exit;
    }
    $results = mysqli_num_rows($result);
    if($results){
        echo '<div class="alert alert-danger">That email is already registered. Do you want to log in?</div>';
        exit;
    }
    //create unique activation code
    $activationKey = bin2hex(openssl_random_pseudo_bytes(16));
    //insert user details and activation key into database
    $sql ="INSERT INTO users (username,email,password,activation) VALUES ('$username','$email','$password','$activationKey')";
    $result = mysqli_query($link, $sql);
    if(!$result){
        echo '<div class="alert alert-danger">There was an error inserting the user details in the database!</div>';
        exit;
    }
    //creating verification email content
    $message ="Please click on this link to activate your account:\n\n";
    $message .= "activate.php?email=" . urlencode($email) . "&key=$activationKey";
    //sending verification email and print success message
    if(mail($email, 'confirm your Registeration',$message,'From:'.'akashgayakwad123@gmail.com')){
        echo "<div class='alert alert-success'>Thankyou for your registering! A confirmation email has been sent to $email. Please click on the activation link to activate your account.</div>";
    }
?>
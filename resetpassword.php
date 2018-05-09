<?php
    include('connection.php');
    session_start();
?>
<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>Password Reset</title>
        <link href="css/bootstrap.min.css" rel="stylesheet">
        <style>
            h1{
                color:purple;   
            }
            .forgotPasswordForm{
                border:1px solid #7c73f6;
                margin-top: 50px;
                border-radius: 15px;
            }
        </style> 

    </head>
    <body>
        <div class="container-fluid">
            <div class="row">
                <div class="col-sm-offset-1 col-sm-10 forgotPasswordForm">
                    <h1>Reset Your Password!</h1>
                    <div id="resultmessage"></div>
                    <?php
                        if(!isset($_GET['user_id']) || !isset($_GET['key'])){
                            echo '<div class="alert alert-danger">There was an error. Please click on the reset password link you received by email.</div>';
                            exit;
                        }
                        $user_id = $_GET['user_id'];
                        $key = $_GET['key'];
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
            
                        echo '<form method="post" id="passwordresetform">
                        <input type="hidden" name="key" value='.$key.'>
                        <input type="hidden" name="user_id" value='.$user_id.'>
                        <div class="form-group">
                        <label for="password">Enter your new password:</label>
                        <input type="password" name="password" id="password" placeholder="Enter Password" class="form-control">
                        </div>
                        <div class="form-group">
                        <label for="password2">Re-enter password:</label>
                        <input type="password" name="password2" id="password2" placeholder="Re-enter Password" class="form-control">
                        </div>
                        <input type="submit" name="resetpassword" id="password2" placeholder="Re-enter Password" class=" btn btn-success btn-lg" value="Reset Password">
                        </form>';    
                    ?>
                </div>
            </div>
        </div>
        <script src="js/jquery-2.0.3.min.js"></script>
        <script src="js/bootstrap.min.js"></script>
        <script>
            //script for ajax call to storeresetpassword.php to process form data
            $("#passwordresetform").submit(function(event){ 
                event.preventDefault();
                var datatopost = $(this).serializeArray();
                //console.log(datatopost);
                $.ajax({
                        url: "storeresetpassword.php",
                        type: "POST",
                        data: datatopost,
                        success: function(data){
                            $('#resultmessage').html(data);
                        }
                       },
                        error: function(){
                            $("#resultmessage").html("<div class='alert alert-danger'>There was an error with the Ajax Call. Please try again later.</div>");

                        }

                });

            });
        </script>
    </body>
</html>
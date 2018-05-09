<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>Online Notes</title>
        <link href="css/bootstrap.min.css" rel="stylesheet">
          <link href="style.css" rel="stylesheet">
    </head>
    <body>
        <?php
            include('connection.php');
            //session_start();
            if(!isset($_SESSION['user_id']) && !empty($_COOKIE['rememberme'])){
                //extracting authentificators 1&2 from cookie
                list($authentificator1,$authentificator2)=explode(',',$_COOKIE['rememberme']);
                //preparing f2authentificator2 for check
                $authentificator2=hex2bin($authentificator2);
                $f2authentificator2 = hash('sha256',$authentificator2);
                //selecting row of authentificator1
                $sql= "SELECT * FROM rememberme WHERE authentificator1='$authentificator1'";
                $result = mysqli_query($link, $sql);
                if(!$result){
                    echo '<div class="alert alert-danger">There was an error running the query.</div>';
                    exit;
                }
                $count = mysqli_num_rows($result);
                if($count != 1){
                    echo '<div class="alert alert-danger">Remember me process failed!</div>';
                    exit;
                }
                $row = mysqli_fetch_array($result,MYSQLI_ASSOC);
                //matching f2authentificator2
                if(!hash_equals($row['f2authentificator2'], $f2authentificator2)){ 
                    echo '<div class="alert alert-danger">hash_equals returned false</div>';
                }
                else{ //generate new cookie variables
                    $authentificator1 = bin2hex(openssl_random_pseudo_bytes(10)); //hexadecimal 10bytes 80 bits 20 char
                    //2*2*...*2
                    $authentificator2 = openssl_random_pseudo_bytes(20);  //binary 20 bytes 160 bits
                    //Store them in a cookie
                    $cookieValue = $authentificator1 . "," . bin2hex($authentificator2);
                    setcookie(
                                "rememberme",
                                $cookieValue,
                                time() + 1296000
                            );
                    $f2authentificator2 = hash('sha256', $authentificator2);
                    $user_id = $row['user_id'];
                    $expiration = date('Y-m-d H:i:s', time()  + 1296000);
                    $sql = "INSERT INTO rememberme
                    (authentificator1, f2authentificator2, user_id, expires)
                    VALUES
                    ('$authentificator1', '$f2authentificator2', '$user_id', '$expiration')";
                    $result = mysqli_query($link, $sql);
                    if(!$result){
                        echo  '<div class="alert alert-danger">There was an error storing data to remember you next time.</div>';  
                    }    
                    //update session variable
                    $_SESSION['user_id'] = $user_id;
                    //navigate to main notes page   
                    header("location: mainpageloggedin.php");
                }
            }

            /*else{
                echo  '<div class="alert alert-danger" style="margin-top:50px">User Id:' . $_SESSION['user_id'] . '</div>';
                echo  '<div class="alert alert-danger">Cookie value:' . $_COOKIE['rememberme'] . '</div>';
            }*/
        ?>
        <script src="js/jquery-2.0.3.min.js"></script>
        <script src="js/bootstrap.min.js"></script>
        <script src="index.js"></script>
    </body>
</html>
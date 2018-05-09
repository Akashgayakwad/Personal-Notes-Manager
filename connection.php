<?php
    $link = mysqli_connect("localhost","notesmanager","Akash@1998","onlinenotes");
    if(mysqli_connect_error()){
        die("ERROR: Unable to connect:".mysqli_connect_error());
    }
?>
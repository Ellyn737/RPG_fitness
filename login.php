<?php
    
    $servername = "pstud0.mt.haw-hamburg.de";
    $username = "aby369";
    $password = "aby369";
    $dbname = "aby369"

        
    //create connection
    $conn = new mysqli($servername, $username, $password, $dbname);

    //check connection
    if($conn -> connect_error){
        die("Connection failed: " .$conn -> connect_error);
    }
    else{
        echo("Connected");
    }
    
?>
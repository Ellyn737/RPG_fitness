<html>
    <body>
        <?php

            $servername = "localhost";
            $username = "root";
            $password = "";
            $dbname = "rpg_fitness";


            //create connection
            $conn = new mysqli($servername, $username, $password, $dbname);

            //check connection
            if($conn -> connect_error){
                die("Connection failed: " .$conn -> connect_error);
            }
            else{
                echo("Connected ");
            }
        ?>
    </body>
</html>
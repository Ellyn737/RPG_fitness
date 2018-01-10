<html>
    <head>
        <link rel="stylesheet" type="text/css" href="styles.css">
        <title>RPG Fitness-Login</title>
    </head>
    
    <body>
        
        <?php
        
            $namErr = $pwErr = "";
        
            //variables for connection
            $servername = "localhost";
            $username = "root";
            $password = "test";
            $dbname = "rpg_fitness";

            //build connection
            $conn = new mysqli($servername, $username, $password, $dbname);

            //check connection
            if($conn->connect_error){
                die("Connection failed: " . $conn->connect_error);
            }else{
                echo "connected" ."<br>";
            }
            //for variables from other pages
            session_start();
        
            if($_SERVER["REQUEST_METHOD"] == "POST"){
                
                
                
                //get input and trim it
                //if input is empty --> error
                if(empty($_POST["nameLog"])){
                    $namErr = "Please insert your username";
                }else{
                    $name = trim($_POST["nameLog"]);
                }
                if(empty($_POST["pw"])){
                    $pwErr = "Please fill in your password";
                }else{
                   $pw = trim($_POST["pw"]); 
                }
                
                
                //search for matches in db
                $sql = "SELECT USER_ID, USER_NAME, PASSWORD FROM user WHERE USER_NAME = '$name'";
                $result = $conn->query($sql);
                
                if($result->num_rows > 0){
                    while($row = $result->fetch_assoc()){
                        $otherId = $row["USER_ID"];
                        $otherPW = $row["PASSWORD"];
                        
                        //if they match 
                        if($otherPW === $pw && !empty($name)){
                            //set name variable for profile header
                            $_SESSION['nameLog'] = $name;
                            //go to profile
                            header("Location: http://localhost/rpg_fitness/profil2.php");
                        }else{
                            $pwErr = "The passwords don't match";
                        }
                    }
                }else{
                    $namErr = "This user doesn't exist. Please register below";
                }
            }
            
        $conn->close();
        //session beenden
        session_write_close();
            
        ?>
        
        
        
        <div class="wrapper">
            <header>
                <h1>Level up and get strong</h1>
            </header>

            <form action="<?php echo $_SERVER["PHP_SELF"];?>" method="post">
                <label for="name">Username:</label>
                <br>
                <input type="text" name="nameLog">
                <span class="error">* <?php echo $namErr ?></span>
                <br>
                <label for="pw">Password:</label>
                <br>
                <input type="password" name="pw" maxlength="30">
                <span class="error">* <?php echo $pwErr ?></span>
                <br>
                <input type="submit" class="gButtons" name="login" value="Login!">

                <p>If you are not registered yet, do it <a href="registration.php">HERE</a>.</p>
            </form>
        </div>
    </body>
</html>

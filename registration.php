<html>

    <head>
        <link rel="stylesheet" type="text/css" href="styles.css">
        <title>Registration</title>
    </head>
    <body>
        <!--php-->
        
        <?php  
        //to save variables to other pages
        session_start();
        //variables for connection
        $servername = "localhost";
        $username = "root";
        $password = "";
        $dbname = "rpg_fitness";
        
        //build connection
        $conn = new mysqli($servername, $username, $password, $dbname);
        
        //check connection
        if($conn->connect_error){
            die("Connection failed: " . $conn->connect_error);
        }else{
            echo "connected" ."<br>";
        }
        
        //die eingaben von unnötigen Zeichen befreien
        //Fehlermeldungen, wenn etwas fehlt
        //leere variablen definieren
        $nameErr = $pwErr = $pwErr2 = $gendErr = $submitTxt = $name = "";
        
        if($_SERVER["REQUEST_METHOD"] == "POST"){
           
            if(empty($_POST["yName"])){
                $nameErr = "Name is required";
            }else{
                 $name = trim($_POST["yName"]);
            }
            
            if(empty($_POST["pw"])){
                $pwErr = "Password is required";
            }else{
                 $pw1 = trim($_POST["pw"]);
            }
            
            if(empty($_POST["pwAgain"])){
                $pwErr2 = "Repeat the password";
            }else{
                $pw2 = trim($_POST["pwAgain"]);
            }
            
            if(empty($_POST["geschlecht"])){
                $gendErr = "Please specify your gender";
            }else{
                 $gender = trim($_POST["geschlecht"]);
            }
        
            
            //passwords match
            if($pw1 === $pw2){
                //only insert data when all fields are filled
                if($name !='' && $pw1 !='' && $pw2 !='' && $gender !=''){
                    $check = "SELECT * FROM user WHERE USER_NAME = '$name'";
                    $rows = mysqli_query($conn, $check);
                    $data = mysqli_fetch_array($rows, MYSQLI_NUM);
                    
                    //only insert if user does not exist allready
                    if($data[0] <1){
                        
                        //insert data
                        $sql = "INSERT INTO user (USER_NAME, PASSWORD, GENDER, LEVEL, XP) VALUES ('$name', '$pw1', '$gender', 1, 0)";

                        //send data
                       if($conn->query($sql)===TRUE){
                           $submitTxt = "New record created successfully";
                       }else{
                         $submitTxt = "Error: " .$sql ."<br>" .$conn->error;  
                       }

                        //set name variable for chooseCharacter   
                        $_SESSION['yName'] = $name;
                        $_SESSION['geschlecht'] = $gender;
                        //open chooseCharakter page
                        header("Location: http://localhost/rpg_fitness/chooseCharakter.php");
                        //close connection
                        $conn->close();
                        //session beenden
                        session_write_close();
                        }else{
                        $submitTxt = "This user allready exist. Please login <a href='index.php'>HERE</a>.";
                    }
                }else{
                    $submitTxt = "Please fill out ALL fields";
                }
            }else{
                $pwErr2 = "Your passwords do NOT match";
            }
        }
        
        ?>
        
        
        <!--html aufbau-->
        <div class="wrapper">
            <header>
                <h1>Register</h1>
            </header>
            
            <!--PHP_SELF sorgt dafür, dass man in diesem php bleibt-->
            <form method="post" action="<?php echo $_SERVER["PHP_SELF"];?>" >
                <p>Please enter your data:</p>
                <label for="yName">Your Username: </label>
                <br>
                <input type="text" name="yName">
                <span class="error">* <?php echo $nameErr;?></span>
                <br>    
                <label for="pw">Your Password: </label>
                <br>
                <input type="password" name="pw">
                <span class="error">* <?php echo $pwErr;?></span>
                <br>
                <label for="pwAgain">Repeat Your Password: </label>
                <br>
                <input type="password" name="pwAgain">
                <span class="error">* <?php echo $pwErr2;?></span>
                <br>
                <label>Your Gender: </label>
                <br>
                <label><input type="radio" name="geschlecht" value="male">male</label>
                <label><input type="radio" name="geschlecht" value="female">female</label>
                <span class="error">* <?php echo $gendErr;?></span>
                <br>
                <span class="error"><?php echo $submitTxt?></span>
                <br>
                <input type="submit" class="gButtons" value="Registere Here"/>
            </form>    
        </div>
    </body>
</html>

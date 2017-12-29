<!doctype html>
<html>

    <head>
        <link rel="stylesheet" type="text/css" href="styles.css">
        <title>Registration</title>
    </head>
    <body>
        <!--php-->
        
        <?php
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
        }
        
        
        //die eingaben von unnötigen Zeichen befreien
        //Fehlermeldungen, wenn etwas fehlt
        //leere variablen definieren
        $name = $pw1 = $pw2 = $gender = "";
        $nameErr = $pwErr = $pwErr2 = $gendErr = "";
        
        if($_SERVER["REQUEST_METHOD"] == "POST"){
           
            if(empty($_POST["username"])){
                $nameErr = "Name is required";
            }else{
                 $name = trim($_POST["username"]);
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
        
            
            //insert data
            $sql = "INSERT INTO user (USERNAME, PASSWORD, GENDER, LEVEL, XP) VALUES ($name, $pw1, $gender, '0', '0')" ;
            
            //send data
           if($conn->query($sql)===TRUE){
               echo " New record created successfully";
           } else{
             echo "Error: " .$sql ."<br>" .$conn->error;  
           }
            
            //test if data was transfered
            $sqlGet = "SELECT USER_ID, USER_NAME FROM user";
            $resultGet = $conn->query($sqlGet);
            
            if($resultGet->num_rows > 0){
                while ($row = $resultGet->fetch_assoc()){
                    echo "id: " .$row["USER_ID"]. " - Name: " .$row["USER_NAME"]. "<br>";
                }
            }else{
                    echo "0 results..";
                }

            
            //close connection
            $conn->close();
        }
        
        
        
        
        
        
        ?>
        
        
        <!--html aufbau-->
        <div class="wrapper">
            <header>
                <h1>Registrier Dich</h1>
            </header>
            
            <!--PHP_SELF sorgt dafür, dass man in diesem php bleibt-->
            <form method="post" action="<?php echo $_SERVER["PHP_SELF"];?>" >
                <p>Gib hier deine Daten an:</p>
                <div>
                    <label for="username">Dein Username: </label>
                    <br>
                    <input type="text" name="username">
                    <span class="error">* <?php echo $nameErr;?></span>
                    <br>
                    <!--
                    <label for="height">Deine Groesse in Centimetern: </label>
                    <br>
                    <input type="number" name="height">
                    <br>
                    <label for="weight">Dein Gewicht: </label>
                    <br>
                    <input type="number" name="weight">
                    <br>
                    <label for="age">Dein Alter: </label>
                    <br>
                    <input type="number" name="age">
                    <br>
                    -->
                    <label for="pw">Dein Passwort: </label>
                    <br>
                    <input type="password" name="pw">
                    <span class="error">* <?php echo $nameErr;?></span>
                    <br>
                    <label for="pwAgain">Passwort wiederholen: </label>
                    <br>
                    <input type="password" name="pwAgain">
                    <span class="error">* <?php echo $pwErr;?></span>
                    <br>
                    <label>Dein Geschlecht: </label>
                    <br>
                    <label><input type="radio" name="geschlecht" value="männlich">maennlich</label>
                    <label><input type="radio" name="geschlecht" value="weiblich">weiblich</label>
                    <span class="error">* <?php echo $gendErr;?></span>
                    <br>
                    <!--<a href="chooseCharakter.html">--><input type="button" class="gButtons" name="register" value="Registrier Dich!"/><!--</a>-->
                </div>
            </form>    
            
            
        </div>
    </body>
</html>
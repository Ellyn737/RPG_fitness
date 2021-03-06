<!doctype html>
<html>
    <head>
        <link rel="stylesheet" type="text/css" href="styles.css">
        <title>Training</title>
        <?php
        
            //variables for connection
            $servername = "localhost";
            $username = "root";
            $password = "";
            $dbname = "rpg_fitness";

            //build connection
            $conn = new mysqli($servername, $username, $password, $dbname);
/*
            //check connection
            if($conn->connect_error){
                die("Connection failed: " . $conn->connect_error);
            }else{
                echo "connected" ."<br>";
            }
*/
            //headername holen von Profil
            session_start();
            $headerName = $_SESSION['nameLog'];
            $userId = $_SESSION["userId"];
        
            //character_id holen
            $sql1 = "SELECT FIGUREN_ID FROM chosen WHERE USER_ID = '$userId' ";
            $result1 = $conn->query($sql1);
            while($row = $result1->fetch_assoc()){
                $characterId = $row["FIGUREN_ID"];
            }

        
        $monkDes = "You want to become a monk. So, do as I say and you might gain that honor.
                        As monks we are a balancing impact on our people. 
                        We need to keep peace between the protecting, fighting class and the providing, nurturing people.
                        Both are needed, but they feel and speak very differently.
                        To heal others means to heal yourselfe first.
                        As your first quest I want you to find balance within.
                        Blend your inner opposing forces together.";

        $rangerDes = "You want to become a ranger! So, do as I say and you might gain that honor!
                        Your first quest will lead you to the king of Ankhai. 
                        There are rumors he gathers an army around him.
                        His kingdom is not far away, but the forrest is protected by malicious creatures!
                        Take a route through the forrest and make sure you are not seen by anyone.
                        Be back in 30 minutes!" ;
        
        $warriorDes = "You want to become a warrior! So, do as I say and you might gain that honor!
                        Your first quest will lead you through the forrest 
                        and into the territory of the Gorth People.
                        They are not the smartest, but they expanded their hunting grounds 
                        and we can not allow that. 
                        Make your way through the underwood.
                        Find the Gorth People and kick their little butts.
                        On your way back take the route through the caves.
                        It might be narrow, but we gotta check those for enemies, too.";
        
            switch($characterId){
                case("1"):
                    $bild = "images/workout_yoga/workout_yoga1.jpg";
                    $teacher = "images/oldmonk.jpg";
                    $description = $monkDes;
                    break;
                case("2"):
                    $bild = "images/workout_strength/workot_strengthM/workout_strengthM1.1.jpg";
                    $teacher = "images/rangerchief2.jpg";
                    $description = $rangerDes;
                    break;
                case("3"):
                    $bild = "images/workout_strength/workot_strengthM/workout_strengthM1.1.jpg";
                    $teacher = "images/trainer2.jpg";
                    $description = $warriorDes;
                    break;
                case("4"):
                    $bild = "images/workout_yoga/workout_yoga1.jpg";
                    $teacher = "images/oldmonk.jpg";
                    $description = $monkDes;
                    break;
                case("5"):
                    $bild = "images/workout_strength/workot_strengthM/workout_strengthM1.1.jpg";
                    $teacher = "images/rangerchief2.jpg";
                    $description = $rangerDes;
                    break;
                case("6"):
                    $bild = "images/workout_strength/workot_strengthM/workout_strengthM1.1.jpg";
                    $teacher = "images/trainer2.jpg";
                    $description = $warriorDes;
                    break;
                    
            }
            
            //when the button is pushed
            if($_SERVER["REQUEST_METHOD"] == "POST"){
                
                
                $sql2 = "UPDATE user SET XP = XP + 10 WHERE USER_NAME = '$headerName'";
                if($conn->query($sql2) === TRUE){
                    echo "New record created succesfully";
                }else{
                    echo "Error; " .$sql2. "<br>" .$conn->error;    
                }

            

            header("Location: http://localhost/rpg_fitness/profil2.php");

            $conn->close();
            //session beenden
            session_write_close();
            }
        ?>
    </head>
    <body>
        <div class="wrapper">
            <header>
                <h1>Boot Camp</h1>
                <h2>Ready For Your Training?</h2>
            </header>              
            <div class="training">
                <img id="teachers" src="<?php echo $teacher; ?>">
                <p id="instruction"><?php echo $description; ?></p>
                <p id="warning"> But wait! Why get better and stronger if you hurt yourself? So please warm up before you start your training!</p>
                <img src="<?php echo $bild; ?>">
                
                

            </div>

                <div class="buttons">
                    <div class="slider">
                        <input type="checkbox" name="slider" class="slider-checkbox" id="sliderSwitch" onclick="setPoints()" >
                        <label class="slider-label" for="sliderSwitch">
                            <span class="slider-inner"></span>
                            <span class="slider-circle"></span>
                        </label>
                    </div>
                    
                    <p id="gotPoints"></p>
                    <form method="post" onclick="<?php echo $_SERVER["PHP_SELF"];?>">
                        <input type="button" class="gButtons" value="Cancel"  onclick="history.back()">
                        <input type="submit" class="gButtons" value="Finish" id="finish">
                    </form>
            </div>

        </div>
        
        <script type="text/javascript">
            function setPoints(){
                var p = document.getElementById("gotPoints");
                p.innerHTML = "You earned 10 XP";
            }
        </script>
    </body>
</html>

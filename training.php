<!doctype html>
<html>
    <head>
        <link rel="stylesheet" type="text/css" href="styles.css">
        <title>Training</title>

        <script type="text/javascript">

            var character_id ="<?php echo $characterId ?>";
            var bild = document.getElementById("bild");

            switch(character_id){
                    //MONK M
                    case("1"): bild.src="images\workout_yoga/workout_yoga1.jpg";
                    break;
                //Bild für RANGER M
                case("2"):
                 bild.src="images\workout_strength\workot_strengthM/workout_strengthM1.1.jpg";
                    break;
                    //WARRIOR M
                    case("3"):
                    bild.src="images\workout_strength\workot_strengthM/workout_strengthM1.1.jpg";
                    break;
                    //MONK F
                    case("4"):
                    bild.src="images\workout_yoga/workout_yoga1.jpg";
                    break;
                    //BILDER FÜR RANGER F
                    case("5"):
                   bild.src="images\workout_strength\workout_strengthW/workout_strengthW1.jpg";
                    break;
                //WARRIOR F
                case("6"):
                    bild.src="images\workout_strength\workout_strengthW/workout_strengthW1.jpg";
                    break;

            }

        </script>

    </head>
    <body>

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
        }else{
            echo "connected" ."<br>";
        }
        //headername holen von Profil
        //user_id holen
        $sql = "SELECT USER_ID, XP FROM user WHERE USER_NAME = '$headerName' ";
        $result = $conn->query($sql);
        while($row = $result->fetch_assoc()){
            $userId = $row["USER_ID"];
            $xp = $row["XP"];
            echo $userId;
            echo $xp;
        }

        //character_id holen
        $sql = "SELECT CHARACTER_ID FROM user_choose_character WHERE USER_ID = '$userId' ";
        $result = $conn->query($sql);
        while($row = $result->fetch_assoc()){
            $characterId = $row["CHARACTER_ID"];
            echo $characterId;
        }

            if($_SERVER["REQUEST_METHOD"] == "POST"){
                $xp+=10;
                $sql2 = "INSERT INTO user (XP) VALUES ('$xp')";
                if($conn->query($sql) === TRUE){
                    echo "New record created succesfully";
                }else{
                    echo "Error; " .$sql. "<br>" .$conn->error;
                }
            }

              header("Location: http://localhost/rpg_fitness/profil2.php");

            $conn->close();

        ?>
        <div class="wrapper">
            <header>
                <h1>Das Training wartet auf Dich!</h1>
            </header>

            <h2>Bist du bereit für das Training?</h2>
                   <p> Aber Halt! Warte! Was nÜtzt es einem stÄrker und besser zu werden, wenn man sich verletzt? Darum solltest du dich vor jedem Training aufwÄrmen. Damit deine Muskeln ihre volle Leistung bringen kÖnnen und du bereit bist für jede weitere Herausforderung!
                    Wenn du mit dem AufwÄrmen fertig bist beginne das Training:
                    </p>

            <div class="training">
                <!--Hier kommen die Trainingbilder + Beschreibung rein-->
                <img id="bild" src="images/workout_yoga/workout_yoga1.jpg">

                <div class="instruction">
                    <p>Hier kommt die Beschreibung der Trainingseinheit rein!</p>
                </div>

            </div>

                <div class="buttons">
                    <div class="slider">
                        <input type="checkbox" name="slider" class="slider-checkbox" id="sliderSwitch">
                        <label class="slider-label" for="sliderSwitch">
                            <span class="slider-inner"></span>
                            <span class="slider-circle"></span>
                        </label>
                    </div>

                    <form method="post" action="<?php echo $_SERVER["PHP_SELF"];?>">
                        <input type="button" class="gButtons" value="Cancel"  onclick="history.back()">
                        <input type="submit" class="gButtons" value="Finish">
                    </form>
            </div>

        </div>


    </body>
</html>

<!doctype html>
<html>

    <head>
        <link rel="stylesheet" type="text/css" href="styles.css">
        <title>Choose a character</title>
        <script>
            
            //Geschlecht aus DB holen --> richtige Charakterkarten anbieten
            
            /*
            *   changeL() ruft den vorigen Charakter auf
            *   wenn ich auf den linken Button drücke
            */
            function changeL(){
                //variablen mit den einzelnen anzusprechenden Elementen
                //Auswahlbutton
                var btn = document.getElementById("becomeA");

                //Platzhalter für die Charakterkarten
                //Buttons nach links und rechts
                var card = document.getElementById("card");
                var btnL = document.getElementById("btnL");
                var btnR = document.getElementById("btnR");

                //Bilder
                var WImg = "images/warriorCard.png";
                var RImg = "images/rangerCard.png";
                var MImg = "images/monkCard.png";
                var WFImg = "images/warriorFCard.png";
                var RFImg = "images/rangerFCard.png";
                var MFImg = "images/monkFCard.png";
                
                //character
                var character = document.getElementById("character");
                
                //abfragen welche Karte gerade angezeigt wird
                //die vorige Karte als Bild festlegen 
                //den Wert des Auswahlbuttons festlegen
                switch (card.getAttribute("src")){
                    
                    case WImg:
                        card.src = MImg;
                        btn.value = "Become A Monk";
                        character.value = "Monk";
                        break;
                    case RImg:
                        card.src = WImg;
                        btn.value = "Become A Warrior";
                        character.value = "Warrior";
                        break;
                    case MImg:
                        card.src = RImg;
                        btn.value = "Become A Ranger";
                        character.value = "Ranger";                        
                        break;
                }
            }
             
            /*
            *   changeR() ruft den nächsten Charakter auf
            *   wenn ich auf den rechten Button drücke
            */
            function changeR(){
                //Variablen mit den einzelnen anzusprechenden Elementen
                //Auswahlbutton
                var btn = document.getElementById("becomeA");

                //Platzhalter für die Charakterkarten
                //Buttons nach links und rechts
                var card = document.getElementById("card");
                var btnL = document.getElementById("btnL");
                var btnR = document.getElementById("btnR");

                //Bilder
                var WImg = "images/warriorCard.png";
                var RImg = "images/rangerCard.png";
                var MImg = "images/monkCard.png";
                
                //abfragen welche Karte gerade angezeigt wird
                //die vorige Karte als Bild festlegen 
                //den Wert des Auswahlbuttons festlegen
                switch (card.getAttribute("src")){

                    case WImg:
                        card.src = RImg;
                        btn.value = 'Become A Ranger';
                        character.value = "Ranger";
                        break;
                    case RImg:
                        card.src = MImg;
                        btn.value = 'Become A Monk';
                        character.value = "Monk";
                        break;
                    case MImg:
                        card.src = WImg;
                        btn.value = 'Become A Warrior';
                        character.value = "Warrior";
                        break;
                }
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
        
            //for variables from other pages
            session_start();
            $name = $_SESSION['yName'];
            $gend = $_SESSION['gender'];
            echo $name;
        
            if($_SERVER["REQUEST_METHOD"] == "POST"){
                
                //get user_id
                $sql = "SELECT USER_ID FROM user WHERE USER_NAME = '$name'";
                $result = $conn->query(sql);
                
                while($row = $result->fetch_assoc()){
                        $otherId = $row["USER_ID"];
                }
                
                //get html.character -> value
                $strhtml = '<!doctype html>
                <html>
                <head>
                <link rel="stylesheet" type="text/css" href="styles.css">
                <title>Choose a character</title>
                </head>
                <body>
                     <div class="wrapper">
                        <header>
                            <h1>Choose a character</h1>
                        </header>
                        <div id="characterDiv">
                            <input type="button" class="sideBtn" id="btnL" onclick="changeL()" value="<">
                            <img id="card" src="images/warriorCard.png">
                            <input type="button" class="sideBtn" id="btnR" onclick="changeR()" value=">">
                        </div>
                        <br>
                        <form method="post" action="<?php echo $_SERVER["PHP_SELF"];?>">
                            <input type="button" class="gButtons" id="becomeA" name="choose" value="Become A Warrior">
                            <input type="hidden" id="character" value="">
                        </form>
                    </div>     
                </body>
                ';
                $dochtml = new DOMDocument();
                $dochtml->loadHTML($strhtml);
                //fehlt das form?
                $character = $dochtml->getElementById("character");
                $characterValue = $character.getAttribute('value');
                echo $characterValue;
                    
                //get character_id
                $sql3 = "SELECT CHARACTER_ID FROM character WHERE CHARACTER_NAME = '$characterValue'";
                $result3 = $conn->query($sql3);
                
                while($row = $result3->fetch_assoc()){
                    $characterID = $row["CHARACTER_ID"];
                }
                
                
                //get formatted time
                $date = new DateTime();
                $date->getTimestamp();
                $date->format(d-m-Y H:i:s);
                
                //insert ids, timestamp
                $sql2 = "INSERT INTO user_choose_character (CHARACTER_ID, USER_ID, DATE) VALUES ('$characterID', '$otherId', '$date')";
                
                if($conn->query($sql2)===TRUE){
                           echo "New record created successfully";
                       }else{
                         echo "Error: " .$sql ."<br>" .$conn->error;  
                       }
                
                
                //close connection
                $conn->close();
                
                //open login page
                header("Location: http://localhost/rpg_fitness/index.php");
            }
            
        ?>
        
        
        
        <div class="wrapper">
            <header>
                <h1>Choose a character</h1>
            </header>
            <div id="characterDiv">
                <input type="button" class="sideBtn" id="btnL" onclick="changeL()" value="<">
                <img id="card" src="images/warriorCard.png">
                <input type="button" class="sideBtn" id="btnR" onclick="changeR()" value=">">
            </div>
            <br>
            <form method="post" action="<?php echo $_SERVER["PHP_SELF"];?>">
                <input type="button" class="gButtons" id="becomeA" name="choose" value="Become A Warrior">
                <input type="hidden" id="character" value="">
            </form>
        </div>     

    </body>
    
</html>
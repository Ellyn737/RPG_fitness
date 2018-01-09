<html>
    <head>
        <?php
        //for variables from other pages
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

        //get yName from registration
        $yourName = $_SESSION['yName'];
    
        //get gender for right picture
        $sqlG = "SELECT GENDER, USER_ID FROM user WHERE USER_NAME = '$yourName'";
        $result = $conn->query($sqlG);
        if($result->num_rows > 0){
            while($row = $result->fetch_assoc()){
                $otherG = $row["GENDER"]; 
                $otherId = $row["USER_ID"];
            }
        }
        
        
        //if clicked on btn
        if($_SERVER["REQUEST_METHOD"] == "POST"){
            
            //get value from hidden input character
            if(empty($_POST["charVal"])){
                echo "did not recieve the character";
            }else{
                $characterValue = $_POST["charVal"];
            }
          
            
            echo $characterValue;
                
            
            //get character_id
            $sql = "SELECT * FROM figuren WHERE FIGUREN_NAME = '$characterValue'";        
            $result = mysqli_query($conn, $sql);  
                while($row = mysqli_fetch_array($result)){
                    $characterID = $row["FIGUREN_ID"];
            }
           
            
            echo $characterID;
            
        
            $date = date('Y-m-d H:i:s');
            echo $date;
            
            
            //insert ids, timestamp
            $sql2 = "INSERT INTO user_choose_character (CHARACTER_ID, USER_ID, DATE) VALUES ('$characterID', '$otherId', '$date')";

            if($conn->query($sql2)===TRUE){
                echo "New record created successfully";
            }else{
                echo "Error: " .$sql2 ."<br>" .$conn->error;  
            }

            
            //close connection
            $conn->close();

            //open login page
            header("Location: http://localhost/rpg_fitness/index.php");
            
        }
 

    ?>

        <link rel="stylesheet" type="text/css" href="styles.css">
        <title>Choose a character</title>
    </head>
    
    <body> 
        <div class="wrapper">
            <header>
                <h1>Choose a character</h1>
            </header>
            <div id="characterDiv">
                <button class="sideBtn" id="btnL" onclick="changeL()">back</button>
                <img id="card" src="">
                <button class="sideBtn" id="btnR" onclick="changeR()">next</button>
            </div>
            <br>
            <form method="post" action="<?php echo $_SERVER["PHP_SELF"];?>">
                <input type="hidden" name="charVal" id="character" value="">
                <input type="submit" class="gButtons" id="becomeA" name="choose" value="Become A Warrior">
            </form>
        </div>     

        <script>
            
            //variablen mit den einzelnen anzusprechenden Elementen
            //Auswahlbutton
            var btn = document.getElementById("becomeA");

            //Platzhalter für die Charakterkarten
            //Buttons nach links und rechts
            var card = document.getElementById("card");
            var btnL = document.getElementById("btnL");
            var btnR = document.getElementById("btnR");
            //character hidden input
            var character = document.getElementById("character");
            
            //Bilder
            var WImg = "images/warriorCard.png";
            var RImg = "images/rangerCard.png";
            var MImg = "images/monkCard.png";
            var WFImg = "images/warriorFCard.png";
            var RFImg = "images/rangerFCard.png";
            var MFImg = "images/monkFCard.png";

          
            
            //grundbild setzen
            var gender = "<?php echo htmlspecialchars($otherG); ?>";          
            
            if(gender == "male"){
                card.src = "images/warriorCard.png";
                character.value = "Warrior";
            }
            else if(gender == "female"){
                card.src = "images/warriorFCard.png";
                character.value = "WarriorF";
            }
            
            /*
            *   changeL() ruft den vorigen Charakter auf
            *   wenn ich auf den linken Button drücke
            */
            function changeL(){
                //abfragen welche Karte gerade angezeigt wird
                //die vorige Karte als Bild festlegen 
                //den Wert des Auswahlbuttons festlegen
                
               switch (card.getAttribute('src')){
                   case (WImg):        
                        card.src = MImg;
                        btn.value = "Become A Monk";
                        character.value = "Monk";
                        break;
                    case (RImg):
                        card.src = WImg;
                        btn.value = "Become A Warrior";
                        character.value = "Warrior";
                        break;
                    case (MImg):
                        card.src = RImg;
                        btn.value = "Become A Ranger";
                        character.value = "Ranger";                        
                        break;
                    case (WFImg):
                        card.src = MFImg;
                        btn.value = "Become A Monk";
                        character.value = "MonkF";
                        break;
                    case (RFImg):
                        card.src = WFImg;
                        btn.value = "Become A Warrior";
                        character.value = "WarriorF";
                        break;
                    case (MFImg):
                        card.src = RFImg;
                        btn.value = "Become A Ranger";
                        character.value = "RangerF";                        
                        break;
                } 
                
            }
             
            /*
            *   changeR() ruft den nächsten Charakter auf
            *   wenn ich auf den rechten Button drücke
            */
            function changeR(){
                //abfragen welche Karte gerade angezeigt wird
                //die vorige Karte als Bild festlegen 
                //den Wert des Auswahlbuttons festlegen
            
               switch (card.getAttribute('src')){

                    case (WImg):
                        card.src = RImg;
                        btn.value = 'Become A Ranger';
                        character.value = "Ranger";
                        break;
                    case (RImg):
                        card.src = MImg;
                        btn.value = 'Become A Monk';
                        character.value = "Monk";
                        break;
                    case (MImg):
                        card.src = WImg;
                        btn.value = 'Become A Warrior';
                        character.value = "Warrior";
                        break;
                    case (WFImg):
                        card.src = RFImg;
                        btn.value = 'Become A Ranger';
                        character.value = "RangerF";
                        break;
                    case (RFImg):
                        card.src = MFImg;
                        btn.value = 'Become A Monk';
                        character.value = "MonkF";
                        break;
                    case (MFImg):
                        card.src = WFImg;
                        btn.value = 'Become A Warrior';
                        character.value = "WarriorF";
                        break;
                } 
                
            }
                    
        </script>
    </body>
    
</html>
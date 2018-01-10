<html>

<head>
    <link rel="stylesheet" type="text/css" href="styles.css">
    <title>Profile</title>
            <?php

        $characterUrl = $usernameShow = "*";
        //get user id --> charactercard und username
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
        //get name from index.php
        session_start();
        $headerName = $_SESSION['nameLog'];
        $usernameShow = $headerName;
        
        
     
        //get user_id, xp and level from db
        $sql="SELECT XP, LEVEL, USER_ID FROM user WHERE USER_NAME = '$headerName'";
        $result = $conn->query($sql);
        while($row = $result->fetch_assoc()){
            $xp = $row["XP"];
            $level = $row["LEVEL"];
            $userId = $row["USER_ID"];
        }

        $_SESSION["userId"] = $userId;

        //character_id holen
        $sqlF = "SELECT FIGUREN_ID FROM chosen WHERE USER_ID = '$userId'";
        $resultF = $conn->query($sqlF);
        while($rowF = $resultF->fetch_assoc()){
            $characterId = $rowF["FIGUREN_ID"];
        }
            
       

        //character_name holen
        $sql3 = "SELECT FIGUREN_NAME FROM figuren WHERE FIGUREN_ID = '$characterId'";
        $result3 = $conn->query($sql3);
        while($row = $result3->fetch_assoc()){
            $characterName = $row["FIGUREN_NAME"];
        }

         //switch für richtige img_url
        switch($characterName){
            case ("Warrior"):
                //set url
                $characterUrl = "images/warriorCard.png";
                break;
            case ("Ranger"):
                //set url
                $characterUrl = "images/rangerCard.png";
                break;
            case ("Monk"):
                //set url
                $characterUrl = "images/monkCard.png";
                break;
            case ("WarriorF"):
                //set url
                $characterUrl = "images/warriorFCard.png";
                break;
            case ("RangerF"):
                //set url
                $characterUrl = "images/rangerFCard.png";
                break;
            case ("MonkF"):
                //set url
                $characterUrl = "images/monkFCard.png";
                break;
        }
        
        $conn->close();
        //session beenden
        session_write_close();
        
        ?>
</head>
<body>
    <div class="wrapper">
        <header>
            <h1 id="du"><?php echo $usernameShow ?></h1>
        </header>
        
        <div class="level">
            <div id="progress">
                <div id="pos"></div>
            </div>
        </div>

        <div class="display">
            <p id="level">Your Level:
            <br> <?php echo $level ?></p>
            <h2>Be Ready!</h2>
            <h2>The next Challenge is waiting for you!</h2>
            <button id="train" class="gButtons" onclick="window.location.href='training.php'">Start Training</button>
        </div>
        <div class="card" >
            <img id="you" src="<?php echo $characterUrl ?>">
        </div>
    </div>
    
    <script type="text/javascript">

        var points = "<?php echo $xp?>";
        var posDiv = document.getElementById("pos"):      
        posDiv.style.width = points;
        document.write("<br>" + points);

    </script>
</body>
</html>

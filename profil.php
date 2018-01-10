<html>

<head>
    <link rel="stylesheet" type="text/css" href="styles.css">
    <title>Profile</title>
</head>
<body>
    <?php
    
        $characterUrl = $usernameShow = "*";
        //get user id --> charactercard und username
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
    
    
        //get name from index.php
        session_start();
        //$headerName = $_SESSION['nameLog'];
        //$usernameShow = $headerName;
        
    
        //hole xp und level
        $sql = "SELECT XP, LEVEL FROM user WHERE USER_NAME = '$headerName'";
        $result = $conn->query($sql);
        while($row = $result2->fetch_assoc()){
            $xp = $row["XP"];
            $level = $row["LEVEL"];
            echo $xp;
            echo $level;
        }
    
        
    
        /*
        //user_id holen
        $sql = "SELECT USER_ID FROM user WHERE USER_NAME = $headerName";
        $result = $conn->query($sql);
        $row = $result->fetch_assoc();
        $userId = $row["USER_ID"];
        echo $userId;
        
        
        //character_id holen  
        $sql2 = "SELECT CHARACTER_ID FROM user_choose_character WHERE USER_ID = '$userId' ";
        $result2 = $conn->query($sql2);
        while($row = $result2->fetch_assoc()){
            $characterId = $row["CHARACTER_ID"];
            echo $characterId;
        }
    
        //character_name holen
        $sql3 = "SELECT CHARACTER_NAME FROM character WHERE CHARACTER_ID = '$characterId'";
        $result3 = $conn->query($sql3);
        while($row = $result3->fetch_assoc()){
            $characterName = $row["CHARACTER_NAME"];
            echo $characterName;
        }
    
    */
        //switch für richtige img_url
        switch($characterName){
            case ("Warrior"):
                echo "Warrior";
                //set url
                $characterUrl = "images/warriorCard.png";
                break;
            case ("Ranger"):
                echo "Ranger";
                //set url
                $characterUrl = "images/rangerCard.png";
                break;
            case ("Monk"):
                echo "Monk";
                //set url
                $characterUrl = "images/monkCard.png";
                break;
            case ("WarriorF"):
                echo "WarriorF";
                //set url
                $characterUrl = "images/warriorFCard.png";
                break;
            case ("RangerF"):
                echo "RangerF";
                //set url
                $characterUrl = "images/rangerFCard.png";
                break;
            case ("MonkF"):
                echo "MonkF";
                //set url
                $characterUrl = "images/monkFCard.png";
                break;
        }
        
    ?>

    <div class="wrapper">
    <header>
        <h1 id="du"><?php echo $usernameShow ?></h1>
    </header>
    
    <div class="level">


<div id="progress">

<div id="pos">&nbsp;</div>

</div>

<div class="display">

 <p>LEVEL</p>

   </div>


  </div>
        <div class="card" id="you">
            <img src="<?php echo $characterUrl ?>">
            <input type="button" id="train" class="gButtons" value="Your Training" onclick="window.location.href='training.html'">
        </div>
    </div>
</body>
</html>

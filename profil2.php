<html>

<head>
    <link rel="stylesheet" type="text/css" href="styles.css">
    <title>Profile</title>

    <script type="text/javascript">

            var points = "<?php echo $xp?>";
            document.getElementById("pos");
            points.style.width+=points + "%";

                document.write(points);

    </script>

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
        $headerName = $_SESSION['nameLog'];
        $usernameShow = $headerName;

        //get xp and level from db
        $sql="SELECT XP, LEVEL FROM user WHERE USER_NAME = '$headerName'";
        $result = $conn->query($sql);
        while($row = $result->fetch_assoc()){
            $xp = $row["XP"];
            $level = $row["LEVEL"];
            echo $xp;
            echo $level;
        }
        
        //user_id holen
        $sql1 = "SELECT USER_ID FROM user WHERE USER_NAME = '$headerName'";
        $result1 = $conn->query($sql1);
        while($row = $result1->fetch_assoc()){
            $userId = $row["USER_ID"];
            echo $userId;
        }

        //character_id holen
        $sql2 = "SELECT FIGUREN_ID FROM chosen WHERE USER_ID = '$userId' ";
        $result2 = $conn->query($sql2);
        while($row = $result2->fetch_assoc()){
            $characterId = $row["FIGUREN_ID"];
            echo $characterId;
        }

        //character_name holen
        $sql3 = "SELECT FIGUREN_NAME FROM figuren WHERE FIGUREN_ID = '$characterId'";
        $result3 = $conn->query($sql3);
        while($row = $result3->fetch_assoc()){
            $characterName = $row["FIGUREN_NAME"];
            echo $characterName;
        }

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

            <div id="pos">
            </div>

            </div>
               </div>

                        <div class="display">
                                <p id="level">Your Level:
                                <br> <?php echo $level ?></p>
                            <h2>Be Ready!</h2>
                            <h2>The next Challenge is waiting for you!</h2>
                        <input type="button" id="train" class="gButtons" value="Start Training" onclick="window.location.href='training.php'">

                    </div>
                   <div class="card" >
                    <img id="you" src="<?php echo $characterUrl ?>">
                    </div>
                </div>
            </body>
            </html>

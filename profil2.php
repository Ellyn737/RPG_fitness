<html>

<head>
    <link rel="stylesheet" type="text/css" href="styles.css">
    <title>Profile</title>

    <script type="text/javascript">

        var points = "<?php echo $xp ?>";

       // document.getElementById("pos").style.width+=points + "%";

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

        //get name from index.php
        session_start();
        $headerName = $_SESSION['nameLog'];
        $usernameShow = $headerName;

        $sql="SELECT XP, LEVEL FROM user WHERE USER_NAME = '$headerName'";
        $result = $conn->query($sql);
        while($row = $result->fetch_assoc()){
            $xp = $row["XP"];
            $level = $row["LEVEL"];
            echo $xp;
            echo $level;}

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
                    <img id="you" src="images/monkcard.png">
                    </div>
                </div>
            </body>
            </html>

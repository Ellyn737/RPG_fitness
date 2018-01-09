<html>

<head></head>
<body>
    <?php
        $servername = "localhost";
        $username = "root";
        $password = "";
        $dbname = "rpg_fitness";

        $conn = new mysqli($servername, $username, $password, $dbname);

        if($conn->connect_error){
            die("Connection failed: " .$conn->connect_error);
        }else{
            echo "connected";
        }



        //get character_id
        $sql = "SELECT * FROM user WHERE CHARACTER_NAME = 'Ranger'";
        $result = $conn->query($sql);

        if($result->num_rows > 0){
            while($row = $result->fetch_assoc()){
                $characterID = $row["CHARACTER_ID"];
                echo $characterID;
            }
        }



    ?>
</body>

</html>

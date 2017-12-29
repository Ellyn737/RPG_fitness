<html>
    <head></head>
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
        }
        
        
        //variables for sql and validation
        $name = $_POST["username"];
        $pw1 = $_POST["pw"];
        $pw2 = $_POST["pwAgain"];
        $gender = $_POST["geschlecht"]; 
        
        //validation
        //if username does not exist AND passwords match
        if((checkUserExists($name) === true) && (   checkPw($pw1, $pw2) === true){
        
            //insert data
            $sql = "INSERT INTO user (USERNAME, PASSWORD, GENDER, LEVEL, XP) VALUES ($name, $pw1, $gender, '0', '0')" ;
        
        
            //send data
           if($conn->query($sql)===TRUE){
               echo " New record created successfully";
           } else{
             echo "Error: " .$sql ."<br>" .$conn->error;  
           }

            //close connection
            $conn->close();
        
        }
        
        //username allready exists?
        function checkUserExists($uname){
           $sql = "SELECT COUNT(USER_NAME) FROM user WHERE USER_NAME = $uname";
            
            if($conn->query($sql) <= 0){
                return true;
            }
            else{
                return false;
            }
            
        }
        
           
        //passwords match?
        function checkPw($p1, $p2){
            if($p1 === $p2){
                return true;
            }
            else {
                return false;
            }
        }
        
        
        ?>
        
    </body>
</html>
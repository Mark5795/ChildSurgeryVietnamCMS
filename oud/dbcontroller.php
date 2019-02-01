
<?php
    class DBController{
        function connect(){
            //$servername = getenv('localhost');
            //$username = getenv('sm2018a4_a4');
            $servername = getenv('sm2018a4.infhaarlem.nl');            
            //$servername = "localhost";
            $username = "sm2018a4_a4";
            $password = "VO0Pvr3B";
            $database = "sm2018a4_groepa4";
            // Create connection
            $db = new mysqli($servername, $username, $password, $database);
            // Check connection
            if ($db->connect_error) {
                die("Connection failed: " . $db->connect_error);
            } 
            #echo "Connected successfully (".$db->host_info.")";
            
            $con=$db;
            return $db;
        }

        function insertQuery($query){
            
            $db = $this->connect();
            $sql = $query;
            $db->query($sql);
        }

    }
?>
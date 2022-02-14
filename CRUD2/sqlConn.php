<?php
            $servername = "localhost";
            $username = "username";
            $password = "";
            $dbname = "curd";
            // Create connection
            $link = mysqli_connect("localhost", "root", "", "curd");
            
            // Check connection
            if($link === false){
                die("ERROR: Could not connect. " . mysqli_connect_error()); 
            }
                  
        ?>  
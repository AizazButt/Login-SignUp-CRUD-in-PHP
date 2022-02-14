<?php
                $sqlT = "CREATE TABLE IF NOT EXISTS person(
                    id INT NOT NULL PRIMARY KEY AUTO_INCREMENT,
                    names VARCHAR(30) NOT NULL,
                    email VARCHAR(30) NOT NULL,
                    numbers VARCHAR(70) NOT NULL,
                    addresses VARCHAR(30) NOT NULL
                )";
            
                    if ($link->query($sqlT) === TRUE) {
                        // echo "Table created successfully";
                    }
                    else {
                        echo "Error creating table: " . $link->error;
                    }



                    $sqlTableAdmin = "CREATE TABLE IF NOT EXISTS admin(
                        
                        id INT NOT NULL PRIMARY KEY AUTO_INCREMENT,
                        name VARCHAR(30) NOT NULL,
                        email VARCHAR(30) NOT NULL,
                        password VARCHAR(30) NOT NULL
                        )";
                        if ($link->query($sqlTableAdmin) === TRUE){
                            // echo "Admin Table Created Successfully";
                        }else{
                            echo "error creating Admin table" . $link->error;
                        }
?>
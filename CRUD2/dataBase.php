<?php
                    $db = "CREATE DATABASE IF NOT EXISTS curd";
                        if ($link->query($db) === TRUE) {
                           // echo "Database  created successfully";
                        }
                        else
                        {
                           echo "Error creating database: " . $link->error;
                        }
        ?>
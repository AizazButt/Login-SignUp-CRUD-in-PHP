<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>View Record</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <link rel="stylesheet" href="practice.css">

    <style>
        .editbtn{
            text-decoration: none;
            color: green
        }
        .deletebtn{
            text-decoration: none; 
            color: red
        }
        .deletebtn:hover{ 
            color: red
        }
        .editbtn:hover{
            color: green
        }
    
    </style>

</head>

<body>
    
        <?php

            include 'sqlConn.php';
       
            if(isset($_GET['delete'])){
                $id = $_GET['delete'];
       
                $del = "DELETE FROM person WHERE id=$id"; 
                    if (mysqli_query($link, $del)){
                        echo "Record deleted successfully !";
                    }else{
                        echo "Error deleting record: " . mysqli_error($link);
                    }
            }           
        ?> 



                <!-- Form vaidation -->
        <script>
       
            
                function validateForm() {
                let updatedName = document.forms["myForm"]["newName"].value;
                let updatedEmail = document.forms["myForm"]["newEmail"].value;
                let updatedNumber = document.forms["myForm"]["newNumber"].value;
                let updatedAddress = document.forms["myForm"]["newAddress"].value;

                        var nameCheck = /^[a-zA-Z\s]+$/; 
                        var emailCheck = /^\w+([\.-]?\w+)*@\w+([\.-]?\w+)*(\.\w{2,3})+$/;
                        var numCheck = /^[1-9]\d{9}$/;
          
                    if(updatedName == "") {
                        document.getElementById("newNameErr").innerHTML="Name must be filled out";
                        return false;
                    }else if(nameCheck.test(updatedName)===false) {
                        document.getElementById("newNameErr").innerHTML="*Invalid Name! Please filled out correctly";
                        return false;
                    }else if(updatedEmail == "" ){
                        document.getElementById("newEmailErr").innerHTML="Email must be filled out";
                        return false;
                    }else if(emailCheck.test(updatedEmail) === false) {
                        document.getElementById("newEmailErr").innerHTML="*Invalid Email! Please filled out correctly";
                        return false;
                    }else if(updatedNumber == "" ){
                        document.getElementById("newNnumberErr").innerHTML="Number must be filled out";
                        return false;
                    }else if (isNaN(updatedNumber)) {
                        document.getElementById("newNnumberErr").innerHTML="*Invalid Number! Please filled out correctly";
                        return false;
                    }else if(updatedAddress == "" ){
                        document.getElementById("newAddressErr").innerHTML="Address must be filled out";
                        return false;
                    }else{
                        return true;
                    }
                }
        </script>

                <!--  Record Table  -->

        <div class="container py-5" id="table">
            <table class="table table-success table-striped table-hover caption-top ">
                <caption>Record List</caption>
                <thead> 
                    <tr>
                        <th>Id</th>
                        <th>Name</th>
                        <th>Email</th>
                        <th>Phone Number</th>
                        <th>Address</th>
                        <th colspan="2" style="padding-left: 5px">Action</th>
                    </tr>
                </thead>

                 
                <?php 
                    $result = mysqli_query($link,"SELECT * FROM person");
                    while ($row = mysqli_fetch_array($result)) { ?>
                        <tr>
                            <td><?php echo $row['id']; ?></td>  
                            <td><?php echo $row['names']; ?></td>
                            <td><?php echo $row['email']; ?></td>
                            <td><?php echo $row['numbers']; ?></td>
                            <td><?php echo $row['addresses']; ?></td>
                            <td><a id="edit" class="editbtn" href="updateRecord.php?id=<?php echo $row['id']; ?>" > Edit </a></td>
                            <td><a class="deletebtn" href="viewRecord.php?delete=<?php echo $row['id']; ?>">Delete </a></td>
                        </tr>
                      
                <?php  }  ?> 

            </table>
        </div>
    
         <!-- Back button  -->

         <div class="container-fluid">
             <div class="row" id="goBack1">
                 <div class="col-1 px-3">
                   <input type="submit"  name="save" value="Go Back"  onclick="location.href='practice.php';">  
                 </div>
             </div>  
         </div>

 
</body>
</html>
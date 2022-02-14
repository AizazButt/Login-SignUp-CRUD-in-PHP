<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Update Record</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <link rel="stylesheet" href="practice.css">
</head>
<body>
        <?php
           include 'sqlConn.php';

                if(isset($_POST['update'])){
                    $newName = $_POST['newName'];
                    $newEmail = $_POST['newEmail'];
                    $newNumber = $_POST['newNumber'];
                    $newAddress = $_POST['newAddress'];
                    $newId = $_POST['newId'];

                    $results =  "SELECT * FROM person WHERE id='$newId'";
                    if($row = mysqli_query($link, $results)){
                        $rowcount=mysqli_num_rows($row);
                            if($rowcount===0){
                                echo "No record found on this Id";
                            }else{
                                $update = "UPDATE person SET names='$newName', email='$newEmail',   numbers='$newNumber', addresses='$newAddress' WHERE id='$newId'";
                                    if ($link->query($update) === TRUE) {
                                        echo "Record updated successfully";
                                        header('Location: '. "viewRecord.php");
                                    } else {
                                        echo "Error updating record: " . mysqli_error($link);
                                    } 
                            }
                    }else{
                        echo "Error" . mysqli_error($link);
                    }
                }  

                if (isset($_GET['id'])) {
                    $id = $_GET['id']; 
                    $sql = "SELECT * FROM person WHERE id='$id'";
                    $result = $link->query($sql); 
                    if ($result->num_rows > 0) {        
                        while ($row = $result->fetch_assoc()) {
                            $name = $row['names'];
                            $email = $row['email'];
                            $number = $row['numbers'];    
                            $address  = $row['addresses'];
                        } 
                    }
                }
        ?>

          
        <script>
                function validateForm() {
                let updatedName = document.forms["myForm"]["newName"].value;
                let updatedEmail = document.forms["myForm"]["newEmail"].value;
                let updatedNumber = document.forms["myForm"]["newNumber"].value;
                let updatedAddress = document.forms["myForm"]["newAddress"].value;

                        var nameCheck = /^[a-zA-Z\s]+$/; 
                        var emailCheck = /^\w+([\.-]?\w+)*@\w+([\.-]?\w+)*(\.\w{2,3})+$/;
                        var numCheck = /^[1-9]\d{9}$/;
             
                
                    if (updatedName == "") {
                        document.getElementById("newNameErr").innerHTML="Name must be filled out";
                        return false;
                    } else if(nameCheck.test(updatedName)===false) {
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

    <div class="container-fluid">
        <form class="row p-2  gy-2"  action="updateRecord.php" method="post" onsubmit="return validateForm()" name="myForm">
                <h1 style="font-size: 30px" >Edit Record</h1>
                <div class=" col-md-3 col-12">
                    <input type="hidden" class="form-control input" name="newId" value = <?php echo $id ?> >
                    <span id="newIdErr" class="err" ></span>
                </div>
               
                <div class="w-100 d-none d-md-block col-md-3 col-12"></div>
                
                <div class="col-md-3 col-12">
                    <input type="text" class="form-control input" name="newName" placeholder=<?php echo $name; ?>>
                    <span id="newNameErr" class="err" ></span>
                </div>
                
                <div class=" col-md-3 col-12">
                    <input type="input" class="form-control input" name="newEmail" placeholder=<?php echo $email; ?> >
                    <span class="err" id="newEmailErr"></span>
                </div>
                
                <div class="w-100 d-none d-md-block col-md-3 col-12" ></div>
                
                <div class=" col-md-3 col-12">
                    <input type="input" class="form-control input" name = "newNumber" placeholder=<?php echo $number; ?> >
                    <span class="err" id="newNnumberErr"></span>
                </div>
                
                <div class="col-md-3 col-12">
                    <input type="text" class="form-control input" name="newAddress" placeholder=<?php echo $address; ?> >
                    <span class="err" id="newAddressErr"></span>
                </div>
                
                <div class="w-100 d-none d-md-block col-md-3 col-12"></div>
                

                <div class="col-3 px-3 py-2">
                        <input type="submit" name="update" value="Update">  
                </div>
            </div>
        </form>
    </div>
     
      

        <div class="container-fluid px-3">

            <div class="row">
                <div class="col px-3 py-4">
                    <input type="submit" name="save" value="Go Back"  onclick="location.href='viewRecord.php';">  
                </div>
            </div>
        </div>

</body>
</html>

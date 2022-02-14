<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Test</title>
	<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <link rel="stylesheet" href="practice.css">
</head>
<style>
    
</style>
<body>
    
        <?php
            session_start();
            include 'sqlConn.php';
            include 'dataBase.php';
            include 'tableSchema.php';

        if(!isset($_SESSION['email'])){
            header('Location: ' ."loginAdmin.php");
            // echo "Please Login";
        }

            if(isset($_POST['save']))
            {	 
                 $name = $_POST['name'];
                 $email = $_POST['email'];
                 $number = $_POST['number'];
                 $address = $_POST['address'];
                 $sqlInsertion = "INSERT INTO person (names,email,numbers,addresses)
                 VALUES ('$name','$email','$number','$address')";
                 if (mysqli_query($link, $sqlInsertion)) {
                    echo "New record entered successfully !";
                 } else {
                    echo "Error: " . $sqlInsertion . " " . mysqli_error($link);
                 }
            }    

        
        ?> 

        <!-- form validation -->
        <script>
                function validateForm() {
                    let name = document.forms["myForm"]["name"].value;
                    let email = document.forms["myForm"]["email"].value;
                    let number = document.forms["myForm"]["number"].value;
                    let address = document.forms["myForm"]["address"].value; 

         
                    var nameCheck = /^[a-zA-Z\s]+$/; 
                    var emailCheck = /^[a-zA-Z0-9.!#$%&'*+/=?^_`{|}~-]+@[a-zA-Z0-9-]+(?:\.[a-zA-Z0-9-]+)*$/;
                    var numCheck = /^[1-9]\d{9}$/;

                        if(name==""){
                            document.getElementById("nameErr").innerHTML="*Name must be filled out";
                            return false; 
                        }else if(nameCheck.test(name)===false) {
                            document.getElementById("nameErr").innerHTML="*Invalid Name! Please filled out correctly";
                            return false;
                        }
                      
                        else if(email == "") {
                            document.getElementById("emailErr").innerHTML="*Email must be filled out";
                            return false;
                        }else if(emailCheck.test(email) === false) {
                            document.getElementById("emailErr").innerHTML="*Invalid Email! Please filled out correctly";
                            return false;
                        }
                        
                       else if(number == "") {
                            document.getElementById("numberErr").innerHTML="*Number must be filled out";
                            return false;
                        }else if (isNaN(number)) {
                            document.getElementById("numberErr").innerHTML="*Invalid Number! Please filled out correctly";
                            return false;
                        }

                        else if(address == "" ){
                            document.getElementById("addressErr").innerHTML="*Address must be filled out";
                            return false;
                        }

                        else{
                            return true;
                        }
                
                }

        </script>

        <!-- Add record Form -->
        <div class="container-fluid">
         
           <h2> Welcome <?php echo $_SESSION["name"]; ?>!</h2>
    
            <form class="row  p-2  gy-2"  action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" method="post" onsubmit="return validateForm()" name="myForm">
                <h1 style="font-size: 30px">Enter Record</h1>
                
                <div class="col-md-3 col-12">
                    <input type="text" class="form-control input" name="name" placeholder="First name" >
                    <span id="nameErr" class="err" ></span>
                </div>
                
                <div class="col-md-3 col-12">
                    <input type="input" class="form-control input" name="email"  placeholder="Email" >
                    <span class="err" id="emailErr"></span>
                </div>
                
                <div class="w-100 d-none d-md-block"></div>
                
                <div class="col-md-3 col-12">
                    <input type="input" class="form-control input" name = "number" placeholder="Number" >
                    <span class="err" id="numberErr"></span>
                </div>
                
                <div class="col-md-3 col-12">
                    <input type="text" class="form-control input" name="address" placeholder="Address" >
                    <span class="err" id="addressErr"></span>
                </div>
                
                <div class="col-12 px-3 py-0">
                    <div class="row">
                        <div class="col-1">
                         <input type="submit" name="save" value="Submit">  
                        </div>
                    </div>
                </div>
               
            </form>
            
                <div class="row">
                    <div class="col-1 py-5 px-4">
                        <input type="submit" name="view" value="View Record"  onclick="location.href='viewRecord.php';">  
                    </div>
                    <div class="col-1 py-5 px-4">
                        <input type="submit" name="logOut" value="Logout"  onclick="location.href='logout.php';">  
                    </div>
                </div>  

           
         
        </div>

</body>
</html>
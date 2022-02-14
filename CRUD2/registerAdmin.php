<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <title>CRUD</title>
    <link rel="stylesheet" href="practice.css">
</head>
<body>

    <?php
        
        include 'sqlConn.php';

        ?>

                     
        <script>
                function validateForm() {
                let userName = document.forms["myForm"]["userName"].value;
                let email = document.forms["myForm"]["email"].value;
                let password = document.forms["myForm"]["password"].value;

                        var nameCheck = /^[a-zA-Z\s]+$/; 
                        var emailCheck = /^\w+([\.-]?\w+)*@\w+([\.-]?\w+)*(\.\w{2,3})+$/;
             
                
                    if (userName == "") {
                        document.getElementById("userNameErr").innerHTML="Name must be filled out";
                        return false;
                    } else if(nameCheck.test(userName)===false) {
                        document.getElementById("userNameErr").innerHTML="*Invalid Name! Please filled out correctly";
                        return false;
                    }else if(email == "" ){
                        document.getElementById("emailErr").innerHTML="Email must be filled out";
                        return false;
                    }else if(emailCheck.test(email) === false) {
                        document.getElementById("emailErr").innerHTML="*Invalid Email! Please filled out correctly";
                        return false;
                    }else if(password == "" ){
                        document.getElementById("passErr").innerHTML="Number must be filled out";
                        return false;
                    }else{
                        return true;
                    }
                }
        </script>

       <h2>Register Yourself!</h2>

        <form class="w-50 mx-auto py-5 " action="registerAdmin.php" method="post" name="myForm" onsubmit="return validateForm()">

            <div class="row justify-content-center py-1 ">
                <div class="col-6 ">
                    <input type="text" class="form-control" name="userName" placeholder="Enter User Name" >
                    <span id="userNameErr" class="err" ></span>
                </div> 
            </div>

            <div class="row justify-content-center py-1">
                <div class="col-6">
                    <input type="text" class="form-control" name="email" placeholder="Enter Email" >
                    <span id="emailErr" class="err" ></span>
                </div> 
            </div>

            <div class="row justify-content-center">
                <div class="col-6 py-1">
                    <input type="password" class="form-control" name="password" placeholder="Enter Password">
                    <span id="passErr" class="err" ></span>
                </div>
            </div>

            <div class="row justify-content-center">
                <div class="col-6 ">
                    <input type="submit"  name="save" value="Register" >
                </div>
            </div>

        </form>   

        <div class="row justify-content-center w-50 mx-auto">
            <div class="col-6 px-1 ">
                <span>Already have Account!  Click <a href="loginAdmin.php">here</a> to Login </span>
            </div>
        </div>

    <?php
        if(isset($_POST['save'])){	 
            $emailVerify = true;
            $name = $_POST['userName'];
            $email = $_POST['email'];
            $password = $_POST['password'];

            $result = mysqli_query($link,"SELECT * FROM admin");

                while ($row = mysqli_fetch_array($result)){
                    if($email===$row['email']){
                        ?> <script> document.getElementById("emailErr").innerHTML="*Email Already Exist"; </script> <?php
                        $emailVerify = false;
                    }   
                }
                    if($emailVerify === true){
                        $insertion = "INSERT INTO admin (name,email,password)
                        VALUES ('$name','$email','$password')";
                            if (mysqli_query($link, $insertion)){
                                echo "Record entered successfully !";
                                header("Location: ". 'loginAdmin.php');
                            }else {
                                echo "Error: " . $insertion . " " . mysqli_error($link);
                            }
                    }
        }    
        
    ?> 


</body>
</html>
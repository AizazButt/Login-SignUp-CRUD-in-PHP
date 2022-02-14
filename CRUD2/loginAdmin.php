<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">  
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <title>CRUD Login</title>
    <link rel="stylesheet" href="practice.css">
</head>
<body>
   
    <?php 
        include 'sqlConn.php';
    ?>   

            <script>
                function validateForm() {

                let email = document.forms["myForm"]["email"].value;
                let password = document.forms["myForm"]["password"].value;

                    var emailCheck = /^\w+([\.-]?\w+)*@\w+([\.-]?\w+)*(\.\w{2,3})+$/;

                    if(email == "" ){
                        document.getElementById("emailErr").innerHTML="*Email must be filled out";
                        return false;
                    }else if(emailCheck.test(email) === false) {
                        document.getElementById("emailErr").innerHTML="*Invalid Email! Please filled out correctly";
                        return false;
                    }else if(password == "" ){
                        document.getElementById("passErr").innerHTML="*Password must be filled out";
                        return false;
                    }else{
                        return true;
                    }
                }
            </script>


    <!-- Login Form -->

    <h2>Login Page</h2>

    <form class="w-50 mx-auto py-5" action="loginAdmin.php" method="post" name="myForm" onsubmit="return validateForm()">


            <div class="row justify-content-center">
                <div class="col-6 py-1 ">
                    <input type="text" class="form-control" name="email" placeholder="Email" >
                    <span id="emailErr" class="err" ></span>
                </div> 
            </div>

            <div class="row justify-content-center py-1">
                <div class="col-6 ">
                    <input type="password" class="form-control" name="password" placeholder="Password">
                    <span id="passErr" class="err" ></span>
                </div>
            </div>

            <div class="row justify-content-center">
                <div class="col-6 py-1">
                    <input type="submit"  name="login" value="Login" >
                </div>
            </div>

    </form>   

    <div class="row justify-content-center w-50 mx-auto">
                <div class="col-6 px-1">
                    <span>Didn't Have Account?  Click <a href="registerAdmin.php">here</a> to Register </span>
                </div>
    </div>



    <?php

            session_start();

            if(isset($_POST['login'])){
                $email =   $_POST['email'];
                $password = $_POST['password'];

                $result = mysqli_query($link, "SELECT * FROM admin WHERE email='$email' &&  password='$password'");
                $row  = mysqli_fetch_array($result);
               
                $rowcount=mysqli_num_rows($result);
                    if($rowcount>0){
                        $_SESSION['email'] = $row['email'];
                        $_SESSION['password'] = $row['password'];
                        $_SESSION['name'] = $row['name'];
                        header('Location: '. "practice.php");
                    }else{
                    ?> <script>  document.getElementById("emailErr").innerHTML="*Email or Password is incorrect"; </script> <?php
                    }
            }
    ?>

</body>
</html>
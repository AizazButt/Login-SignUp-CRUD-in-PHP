    <?php
                    session_start();
                    unset($_SESSION['email']);
                    unset($_SESSION['password']);
                    unset($_SESSION['name']);
                    session_destroy();
                    header("Location: ". 'loginAdmin.php');
    ?>
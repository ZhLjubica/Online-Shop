<?php
session_start();

require 'config/config.php';
require 'includes/form_handlers/register_handler.php';
require 'includes/form_handlers/login_handler.php';



?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>OnlineShop</title>
    <link href="https://fonts.googleapis.com/css?family=Noto+Serif&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="assets/css/register_style.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
    <script src="assets/js/register.js"></script>
    <!-- Bootstrap -->
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <style>
     
    </style>

</head>
<body>
    <?php
    if(isset($_POST['register_button'])){
        echo '
        <script>
        $(document).ready(function(){
            $("#first").hide();
            $("#second").show();
        });
        </script>
        ';
    }
    ?>
    <nav class="navbar navbar-expand-lg navbar-dark navbar-custom fixed-top">
    <div class="container">
      <a class="navbar-brand" href="#">Handmade shop</a>
      <button class="navbar-toggler navbar-button" type="button" data-toggle="collapse" data-target="#navbarResponsive" aria-controls="navbarResponsive" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>
      <div class="collapse navbar-collapse" id="navbarResponsive">
        <ul class="navbar-nav ml-auto">
            <li class="nav-item">
                <a class="nav-link" href="index.php">Home</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="register.php">Sign up</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="register.php">Log In</a>
            </li>
        </ul>
      </div>
    </div>
  </nav>

    <div class="wrapper">
        <div class="login_box mt-5">
            <div class="login_header">
                <h1>OnlineShop!</h1>
                    Login or sign up below!
            </div>
            <div id="first">
                <form action="register.php" method="POST">
                    <input type="email" name="log_email" id="log_email" placeholder="Email address"  value="<?php 
                        if (isset($_SESSION['log_email'])) {
                            echo $_SESSION['log_email'];
                        }
                    ?>">
                    <br>
                    <input type="password" name="log_password" id="log_password" placeholder="Password">
                    <br>
                    <?php if (in_array("Email or password was incorrect!<br>", $error_array)) {
                        echo "Email or password was incorrect!<br>";
                    }?>
                    <input type="submit" name="login_button" value="Login" >
                    <br>
                    <a href="#" id="signup" class="signup">Need an account? Register here!</a>
                </form>
            </div>
            <div id="second">
                <form action="register.php" method="POST">
                    <input type="text" name="reg_fname" placeholder="First name" value="<?php 
                        if (isset($_SESSION['reg_fname'])) {
                            echo $_SESSION['reg_fname'];
                        }
                    ?>" required>
                    <br>
                    <?php if (in_array("Your first name must be between 2 and 25 characters!<br>", $error_array)) echo  "Your first name must be between 2 and 25 characters!<br>"; ?>
                    <input type="text" name="reg_lname" placeholder="Last name" value="<?php
                        if (isset($_SESSION['reg_lname'])) {
                            echo $_SESSION['reg_lname'];
                        }
                    ?>" required>
                    <br>
                    <?php if (in_array("Your last name must be between 2 and 25 characters!<br>", $error_array)) echo   "Your last name must be between 2 and 25 characters!<br>"; ?>

                    <input type="email" name="reg_email" placeholder="Email" value="<?php
                        if (isset($_SESSION['reg_email'])) {
                            echo $_SESSION['reg_email'];
                        }
                    ?>" required>
                    <br>

                    <input type="email" name="reg_email2" placeholder="Confirm email" value="<?php
                        if (isset($_SESSION['reg_email2'])) {
                            echo $_SESSION['reg_email2'];
                        }
                    ?>" required>
                    <br>
                    <?php if (in_array("Email already in use!<br>", $error_array)) echo "Email already in use!<br>"; 
                else if (in_array("Invalid format of email!<br>", $error_array)) echo "Invalid format of email!<br>";
                else if (in_array("Emails don't match!<br>", $error_array)) echo "Emails don't match!<br>"; ?>

                    <input type="password" name="reg_password" placeholder="Password" required>
                    <br>
                    <input type="password" name="reg_password2" placeholder="Confirm password" required>
                    <br>
                    <?php if (in_array("Your password don't match!<br>", $error_array)) echo "Your password don't match!<br>";
                else if (in_array("Your password can only contain letters and numbers!<br>", $error_array)) echo "Your password can only contain letters and numbers!<br>";
                else if (in_array("Your password must be between 5 and 30 characters!<br>", $error_array)) echo "Your password must be between 5 and 30 characters!<br>"; ?>

                    <input type="submit" name="register_button" value="Register">
                    <br>
                    <?php if (in_array("<span style='color: #14C800;'><br>You're all set! Go ahead and login!</span><br>", $error_array)) echo "<span style='color: #14C800;'><br>You're all set! Go ahead and login!</span><br>"; ?>
                    <a href="#" id="signin" class="signin">Already have an account? Sign in here!</a>
                </form>
        </div>
        </div>
    </div>
</body>
</html>
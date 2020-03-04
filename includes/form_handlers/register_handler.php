<?php
// declaring variables
$fname = ""; // first name
$lname = ""; // last name
$em = ""; // email
$em2 = ""; // email2
$password = ""; // password
$password2 = ""; // password 2
$date = ""; // current date
$error_array = array(); // holds error messages
$profile_pic = "";
$rand = "";

if (isset($_POST['register_button'])) {
    //first name
    $fname = strip_tags($_POST['reg_fname']); //remove html tags
    $fname = str_replace(' ', '', $fname); //replace space with nothing
    $fname = ucfirst(strtolower($fname)); //uppercase first letter
    $_SESSION['reg_fname'] = $fname; // stores first name into session variables

    //last name
    $lname = strip_tags($_POST['reg_lname']); //remove html tags
    $lname = str_replace(' ', '', $lname); //replace space with nothing
    $lname = ucfirst(strtolower($lname)); //uppercase first letter
    $_SESSION['reg_lname'] = $lname; // stores last name into session variables
      
    //email
    $em = strip_tags($_POST['reg_email']); //remove html tags
    $em = str_replace(' ', '', $em); //replace space with nothing
    $em = strtolower($em); //change to lowercase
    $_SESSION['reg_email'] = $em; // stores email into session variables

    //confirmed email
    $em2 = strip_tags($_POST['reg_email2']); //remove html tags
    $em2 = str_replace(' ', '', $em2); //replace space with nothing
    $em2 = strtolower($em2); //change to lowercase
    $_SESSION['reg_email2'] = $em2; //stores email2 into session variables
    //password
    $password = strip_tags($_POST['reg_password']); //remove html tags

  

    //confirmed password
    $password2 = strip_tags($_POST['reg_password2']); //remove html tags

    $date = date("Y-m-d"); //current date

        //are they the same    
    if ($em == $em2) {

            //checking if email is in valid format   
        if (filter_var($em, FILTER_VALIDATE_EMAIL)) {
            $em = filter_var($em, FILTER_VALIDATE_EMAIL);

            //checking if email already exists in database
            $e_check = mysqli_query($link, "SELECT email from users_table WHERE email='$em'");

            $num_rows = mysqli_num_rows($e_check);

            if ($num_rows > 0) {
                array_push($error_array, "Email already in use!<br>");
            }
        }else{
            array_push($error_array, "Invalid format of email!<br>");
        }
    }else{
        array_push($error_array, "Emails don't match!<br>");
    }

    if (strlen($fname) >25 || strlen($fname) < 2) {
        array_push($error_array, "Your first name must be between 2 and 25 characters!<br>");
    }

    if (strlen($lname) >25 || strlen($lname) < 2) {
        array_push($error_array, "Your last name must be between 2 and 25 characters!<br>");
    }

    if ($password != $password2) {
        array_push($error_array, "Your password don't match!<br>");
    }else{
        if (preg_match('/[^A-Za-z0-9]/', $password)) {
            array_push($error_array, "Your password can only contain letters and numbers!<br>");
        }
    }

    if (strlen($password) > 30 || strlen($password) <5 ) {
        array_push($error_array, "Your password must be between 5 and 30 characters!<br>");
    }

    if (empty($error_array)) {
        $password = md5($password); //encrypt password before sending to database

        // generate username by concatenating first name and last name
        $username = strtolower($fname. "_" . $lname);
        $check_username_query = mysqli_query($link, "SELECT username FROM users_table WHERE username ='$username'");

        $i = 0;
      //if username exists add number to username

        while(mysqli_num_rows($check_username_query) !=0){
            $i++;
            $username = $username . "_" . $i;
            $check_username_query = mysqli_query($link, "SELECT username FROM users_table WHERE username ='$username'"); 
        }
        //profile picture assignment
        $rand = rand(1, 2);

        if ($rand == 1) {
            $profile_pic = "assets/images/profile_pics/defaults/head_deep_blue.png";
        }
            else if($rand == 2){
                $profile_pic = "assets/images/profile_pics/defaults/head_nephritis.png";
            }

            //insert values into database
           $query = mysqli_query($link, "INSERT INTO users_table VALUES ('', '$fname', '$lname', '$username', '$em', '$password', '$date', '$profile_pic')"); 
        
           array_push($error_array, "<span style='color: #14C800;'><br>You're all set! Go ahead and login!</span><br>");

           $_SESSION['reg_fname'] = "";
           $_SESSION['reg_lname'] = "";
           $_SESSION['reg_email'] = "";
           $_SESSION['reg_email2'] = "";
        }

    }
?>
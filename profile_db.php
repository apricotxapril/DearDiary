<?php 
    session_start();
    include('server.php');
    if($_SESSION["lang"] == "EN"){
        include("en.php");
    } else{
        include("th.php");
    }
    
    $errors = array();

    if (isset($_POST['update_user'])) {
        $username = mysqli_real_escape_string($conn, $_POST['username']);
        $email = mysqli_real_escape_string($conn, $_POST['email']);
        $password_1 = mysqli_real_escape_string($conn, $_POST['password_1']);
        $password_2 = mysqli_real_escape_string($conn, $_POST['password_2']);
        
        $uid = $_SESSION['uid'];
        $currentUser = $_SESSION['username'];
        $currentEmail = $_SESSION['email'];
        $currentPassword = $_SESSION['password'];
        //$change = '0';

        $user_check_query = "SELECT * FROM user_table WHERE username = '$username' OR email = '$email' LIMIT 1";
        $query = mysqli_query($conn, $user_check_query);
        $result = mysqli_fetch_assoc($query);
        
        //username
        if (empty($username)) {
            //$change = '1';
            $username = $currentUser;
        } 
        else if ($currentUser == $username) {
            array_push($errors, "New username and current username must not be identical.");
            $_SESSION['error'] = $profile_error1;
        }
        else if ($result['username'] == $username ) {
            array_push($errors, "Username already exists");
            $_SESSION['error'] = $_error3;
        }

        //email
        if (empty($email)) {
            //$change = '1';
            $email = $currentEmail;
        }
        else if ($currentEmail == $email) {
            array_push($errors, "New email and current email must not be identical.");
            $_SESSION['error'] = $profile_error2;
        }
        else if ($result['email'] == $email) {
            array_push($errors, "Email already exists");
            $_SESSION['error'] = $_error4;
        }

        //password
        if (empty($password_1)) {
            $password_1 = $currentPassword;
        }
        else if ($currentPassword == md5($password_1)) {
            array_push($errors, "New password and current password must not be identical.");
            $_SESSION['error'] = $profile_error3;
        }
        else if(strlen($password_1)<8){
            array_push($errors, "Password must have 8 or more characters");
            $_SESSION['error'] = $_error5;
        }
        else if ($password_1 != $password_2) {
            array_push($errors, "The two passwords do not match");
            $_SESSION['error'] = $_error6;
        }
        
        
        
        

        /*if ($result) { // if user exists
            if ($result['username'] === $username ) {
                array_push($errors, "Username already exists");
                $_SESSION['error'] = $_error3;
            }
            if ($result['email'] === $email) {
                array_push($errors, "Email already exists");
                $_SESSION['error'] = $_error4;
            }
        }*/

        if (count($errors) == 0) {
            $password = md5($password_1);

            $sql = "UPDATE user_table SET username = '$username', email = '$email', password = '$password' WHERE uid = '$uid'";
            mysqli_query($conn, $sql);
            
            $_SESSION['username'] = $username;
            $_SESSION['email'] = $email;
            $_SESSION['password'] = $password1;
            $_SESSION['success'] = $profile_new;
            header('location: profile.php');
        } else {
            header("location: profile.php");
        }
    }

?>

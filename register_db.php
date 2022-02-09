<?php 
    session_start();
    include('server.php');
    if($_SESSION["lang"] == "EN"){
        include("en.php");
    } else{
        include("th.php");
    }
    
    $errors = array();

    if (isset($_POST['reg_user'])) {
        $username = mysqli_real_escape_string($conn, $_POST['username']);
        $email = mysqli_real_escape_string($conn, $_POST['email']);
        $password_1 = mysqli_real_escape_string($conn, $_POST['password_1']);
        $password_2 = mysqli_real_escape_string($conn, $_POST['password_2']);

        if (empty($username)) {
            array_push($errors, "Username is required");
            $_SESSION['error'] = $_error1;
        }
        else if (empty($email)) {
            array_push($errors, "Email is required");
            $_SESSION['error'] = $regis_error1;
        }
        else if (empty($password_1)) {
            array_push($errors, "Password is required");
            $_SESSION['error'] = $_error2;
        }
        if (empty($username) && empty($email) && empty($password_1)) {
            array_push($errors, "Please complete the form");
            $_SESSION['error'] = $regis_error2;
        }
        if(strlen($password_1)<8){
            array_push($errors, "Password must have 8 or more characters");
            $_SESSION['error'] = $_error5;
        }
        else if ($password_1 != $password_2) {
            array_push($errors, "The two passwords do not match");
            $_SESSION['error'] = $_error6;
        }

        $user_check_query = "SELECT * FROM user_table WHERE username = '$username' OR email = '$email' LIMIT 1";
        $query = mysqli_query($conn, $user_check_query);
        $result = mysqli_fetch_assoc($query);

        if ($result) { // if user exists
            if ($result['username'] === $username) {
                array_push($errors, "Username already exists");
                $_SESSION['error'] = $_error3;
            }
            if ($result['email'] === $email) {
                array_push($errors, "Email already exists");
                $_SESSION['error'] = $_error4;
            }
        }

        if (count($errors) == 0) {
            $password = md5($password_1);

            $sql = "INSERT INTO user_table (username, email, password) VALUES ('$username', '$email', '$password')";
            mysqli_query($conn, $sql);

            $_query = mysqli_query($conn, "SELECT * FROM user_table WHERE username = '$username'");
            $_result = mysqli_fetch_assoc($_query);

            $_SESSION['uid'] = $_result['uid'];
            $_SESSION['username'] = $username;
            $_SESSION['email'] = $email;
            $_SESSION['password'] = $password;
            $_SESSION['success'] = $regis_success;
            header('location: index.php');
        } else {
            header("location: register.php");
        }
    }

?>
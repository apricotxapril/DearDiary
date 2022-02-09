<?php 
    session_start();
    include('server.php');
    if($_SESSION["lang"] == "EN"){
        include("en.php");
    } else{
        include("th.php");
    }

    $errors = array();

    if (isset($_POST['login_user'])) {
        $username = mysqli_real_escape_string($conn, $_POST['username']);
        $password = mysqli_real_escape_string($conn, $_POST['password']);

        if (empty($username)) {
            array_push($errors, "Username is required");
        }

        if (empty($password)) {
            array_push($errors, "Password is required");
        }

        if (count($errors) == 0) {
            $password = md5($password);
            //$query = "SELECT * FROM user_table WHERE username = '$username' AND password = '$password' ";
            $query = mysqli_query($conn, "SELECT * FROM user_table WHERE username = '$username' AND password = '$password' ");
            $result = $result = mysqli_fetch_assoc($query);

            ///////////////////////////////////////////////////////////////////////
            $uid = $result['uid'];
            $email = $result['email'];
            $password = $result['password'];
            

            if (mysqli_num_rows($query) == 1) {

                //$_SESSION['username'] = $username;
                $_SESSION['uid'] = $uid;
                $_SESSION['username'] = $username;
                $_SESSION['email'] = $email;
                $_SESSION['password'] = $password;
                $_SESSION['success'] = $login_success;
                header("location: index.php");
            } else {
                array_push($errors, "Wrong Username or Password");
                $_SESSION['error'] = $login_error1;
                header("location: login.php");
            }
        } else {
            array_push($errors, "Username & Password is required");
            $_SESSION['error'] = $login_error2;
            header("location: login.php");
        }
    }

?>
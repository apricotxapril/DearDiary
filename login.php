<?php
    session_start();
    include('server.php');
    
    if($_SESSION['lang'] == "EN"){
        include("en.php");
    } else{
        include("th.php");
    }
    

?>

<!DOCTYPE html>
<html lang="EN">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Welcome to Powerpuff Girls Diary</title>

    
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/flag-icon-css/2.3.1/css/flag-icon.min.css" rel="stylesheet"/>
    <style>
        *{
            padding: 0;
            margin: 0;
            box-sizing: border-box;
        }
        body{
            background-image: url("./img/pink_2.jpg");

            /* Full height */
            
            /* Center and scale the image nicely */
            background-repeat: no-repeat;
            background-size: cover;
            
        }
        .row{
            background: white;
            border-radius: 30px;
            box-shadow: 12px 12px 22px #6d4646;
        }
        img{
            border-top-left-radius: 30px;
            border-bottom-left-radius: 30px;
        }
        .btn1{
            font-family:minimal;
            background: #98ACB9;
            width: 150px;
            border: 1px solid #98ACB9;
        }
        .btn1:hover{
            background: #869499;
            color: #fff;
            box-shadow: 0 0 10px rgba(0,0,0,0.1);
        }
        @font-face {
            font-family: 'pal';
            src: url(fonts/FCPalette.otf);
            font-style: normal;
            font-weight: 100;
            font-stretch: expanded;
        }

        @font-face {
            font-family: 'ppf';
            src: url(fonts/powerpuff.ttf);
            font-style: normal;
            font-weight: 100;
        }

        @font-face {
            font-family: 'minimal';
            src: url(fonts/minimal.otf);
            font-style: normal;
            font-weight: 100;
        }
    </style>
</head>
<body>
<form action="login_db.php" method="post">
    <section class="Form my-4 mx-5">
        <div class="contain">
            <div class="row no-gutters">
                <div class="col-lg-5">
                    <img src="./img/pwp.jpg" class="img-fluid" alt="">
                </div>
                <div class="col-lg-7 px-5 pt-5">
                    
                        <?php if (isset($_SESSION['error'])) : ?>
                            <div class="error">
                                <h3>
                                    <?php 
                                        echo $_SESSION['error'];
                                        unset($_SESSION['error']);
                                    ?>
                                </h3>
                            </div>
                        <?php endif ?>
                        
                                <div class="text-right fixed-bottom p-2" style="background-color: #97c085;">
                                    <p style="color:#fff; font-family:minimal;"><?php echo $_change;?>
                                    <a href="change.php?lang=EN&filename=login.php" ><i class="text-center" ><span class="flag-icon flag-icon-us"></span></i></a>
                                    <a href="change.php?lang=TH&filename=login.php" ><i class="text-center" ><span class="flag-icon flag-icon-th"></span></i></a></p>
                                </div>
                        <div class="form-row">
                            <div class="col-lg-7">
                                <h1 style="color:#336581; font-family:ppf;" class="font-weight-bold py-3"><?php echo $login_wel;?></h1>
                                <h4 style="color:#5299c1; font-family:minimal;"><?php echo $login_title;?></h4>
                                <input style="font-family:minimal;" type="text"  name="username" placeholder="<?php echo $_username;?> " class="form-control my-3 p-4">
                            </div>
                            <div class="col-lg-7">
                                <input style="font-family:minimal;" type="password" name="password" placeholder="<?php echo $_password;?>" class="form-control my-3 p-4">
                            </div>
                            <div class="col-lg-7">
                                <button type="submit" name="login_user" class="btn1 p-2"><?php echo $login;?></button>
                            </div>
                        </div>
                        <p style="font-family:minimal;"><?php echo $login_member;?> <a href="register.php" style="font-family:minimal;"><?php echo $login_signup;?></a></p>
                        <br>
                </div>
            </div>
        </div>
    </section>
    </form>
   
    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.4.1.slim.min.js" integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>
  </body>
</html>
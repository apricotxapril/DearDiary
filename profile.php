<?php 
    session_start();
    include('server.php');
    require_once('connection.php');

    if($_SESSION["lang"] == "EN"){
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
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/flag-icon-css/2.3.1/css/flag-icon.min.css" rel="stylesheet"/>
    <link href="https://fonts.googleapis.com/css2?family=Libre+Baskerville:wght@700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
    
    <link href="https://fonts.googleapis.com/css2?family=Libre+Baskerville:wght@700&display=swap" rel="stylesheet">
    <script type="text/javascript" src="lib/bootstrap-datepicker.js"></script>
	<link rel="stylesheet" type="text/css" href="lib/bootstrap-datepicker.css" >
    
    <title>Profile Page</title>

    <style>
        *{
            padding: 0;
            margin: 0;
            box-sizing: border-box;
        }
        /*body{
            background: #97c085;
        }*/
        body, html {
            height: 100%;
            margin: 0;
        }

        .bg {
            /* The image used */
            background-image: url("./img/cozy_2.jpg");

            /* Full height */
            height: 100%; 

            /* Center and scale the image nicely */
            background-position: center;
            background-repeat: no-repeat;
            background-size: cover;
        }
        .row{
            background: white;
            border-radius: 30px;
            box-shadow: 12px 12px 22px #566d46;
        }
        img{
            border-top-left-radius: 30px;
            border-bottom-left-radius: 30px;
        }
        .btn1{
            font-family:minimal;
            background: #DABDBF;
            width: 150px;
            border: 1px solid #DABDBF;
        }
        .btn1:hover{
            background: #B19095;
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
    <style>
        nav{
            display: flex;
            justify-content: space-around;
            align-items: center;
            min-height: 8vh;
            font-family: 'Libre Baskerville', serif;
        }
    </style>
    
    <div class="bg">
    <nav class="navbar navbar-expand-md navbar-light bg-light">
        
        <a class="navbar-brand" href="#">My Journal.</a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNavDropdown" aria-controls="navbarNavDropdown" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
            <div class="collapse navbar-collapse justify-content-end" id="navbarNavDropdown">
                <ul class="navbar-nav">
                <li class="nav-item">
                    <a class="nav-link" href="index.php"><?php echo $nav_diary;?></a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="to-do-list.php"><?php echo $_todo;?></a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="search.php"><?php echo $_search;?></a>
                </li>
                <li class="nav-item active dropdown">
                    <a class="nav-link dropdown-toggle" href="#" id="navbarDropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    <?php echo $nav_user;?> <!-- ?php echo $_SESSION['name'];? -->
                    </a>
                    <div class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink">
                        <a class="dropdown-item" href="profile.php"><?php echo $_profile;?></a>
                        <div class="dropdown-divider"></div>
                        <a class="dropdown-item" href="index.php?logout='1'"><?php echo $nav_logout;?></a>
                    </div>
                </li>
                </ul>
            </div>
            <div class="text-right">
                <a href="change.php?lang=EN&filename=profile.php" ><i class="text-center" ><span class="flag-icon flag-icon-us"></span></i></a> <a href="change.php?lang=TH&filename=profile.php" ><i class="text-center" ><span class="flag-icon flag-icon-th"></span></i></a>
            </div>
        </nav>

    
   
    <form action="profile_db.php" method="post">
    <section class="Form my-4 mx-5">
        <div class="contain">
            <div class="row no-gutters">
                <div class="col-lg-5">
                    <img src="./img/ppf.jpg" class="img-fluid" alt="">
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
                        
                                
                        <div class="form-row">
                            <div class="col-lg-7">
                                <h1 style="color:#ba8387; font-family:ppf;" class="font-weight-bold py-3"><?php echo $_profile;?></h1>
                            </div>
                            <div class="col-lg-7">
                            <?php 
                                $currentUID = $_SESSION['uid'];
                                $select_stmt = $db->prepare("SELECT * FROM user_table WHERE uid = '$currentUID'");
                                $select_stmt->execute();

                                while ($row = $select_stmt->fetch(PDO::FETCH_ASSOC)) {
                            ?>
                                
                                <div class="row1">
                                    <div style="font-family:minimal;" class="col-md-3">
                                        <h5><?php echo $_username;?></h5>
                                    </div>
                                    <div class="col-md-9 text-secondary">
                                        <?php echo $row["username"]; ?><br>
                                    </div>
                                </div>
                                <br>
                                <div class="row1">
                                    <div style="font-family:minimal;" class="col-md-3">
                                        <h5><?php echo $_email;?></h5>
                                    </div>
                                    <div class="col-md-9 text-secondary">
                                        <?php echo $row["email"]; ?>
                                    </div>
                                </div>
                                <br>
                                
                            <?php } ?>
                                </div>

                        </div>

                        
                        <!-- Button trigger modal -->
                        <button style="font-family:minimal;" type="button" class="btn btn-success" data-toggle="modal" data-target="#exampleModalCenter">
                            <?php echo $_edit;?>
                        </button>

                        <!-- Modal -->
                        <form method="post" class="form-horizontal mt-5">
                        <div class="modal fade" id="exampleModalCenter" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
                            <div class="modal-dialog modal-dialog-centered" role="document">
                                <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="exampleModalLongTitle"><?php echo $profile_edit;?></h5>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                                <div class="modal-body">
                                    
                                    
                                    <div class="form-row">
                                        <div class="col-lg-7">
                                            <input style="font-family:minimal;" type="text"  name="username" placeholder="<?php echo $_username;?> " class="form-control my-3 p-4">
                                        </div>
                                        <div class="col-lg-7">
                                            <input style="font-family:minimal;" type="email" name="email" placeholder="<?php echo $_email;?>" class="form-control my-3 p-4">
                                        </div>
                                        <div class="col-lg-7">
                                            <input style="font-family:minimal;" type="password" name="password_1" placeholder="<?php echo $_password;?>" class="form-control my-3 p-4">
                                        </div>
                                        <div class="col-lg-7">
                                            <input style="font-family:minimal;" type="password" name="password_2" placeholder="<?php echo $_confirm;?>" class="form-control my-3 p-4">
                                        </div>
                                    </div>
                            
                                </div>
                                <div class="modal-footer">
                                    <div class="input-group">
                                        <button type="submit" name="update_user" class="btn"><?php echo $profile_update;?></button>
                                    </div>
                                </div>
                                
                                </div>
                            </div>
                        </div>
                </div>
            </div>
        </div>
    </section>
    </form>
    </div>

    

    <script src="https://code.jquery.com/jquery-3.4.1.slim.min.js" integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>

</body>
</html>
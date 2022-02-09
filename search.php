<?php 
    session_start();
    require_once('connection.php');

    if($_SESSION["lang"] == "EN"){
        include("en.php");
    } else{
        include("th.php");
    }

    if (isset($_REQUEST['delete_id'])) {
        $id = $_REQUEST['delete_id'];

        $select_stmt = $db->prepare("SELECT * FROM diary_table WHERE id = :id");
        $select_stmt->bindParam(':id', $id);
        $select_stmt->execute();
        $row = $select_stmt->fetch(PDO::FETCH_ASSOC);

        // Delete an original record from db
        $delete_stmt = $db->prepare('DELETE FROM diary_table WHERE id = :id');
        $delete_stmt->bindParam(':id', $id);
        $delete_stmt->execute();

        header('Location:search.php');
    }
?>

<!DOCTYPE html>
<html lang="EN">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://fonts.googleapis.com/css2?family=Libre+Baskerville:wght@700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/flag-icon-css/2.3.1/css/flag-icon.min.css" rel="stylesheet"/>
    <title>Search</title>
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
        body {
            background-image: url('./img/bg2.png');
            background-repeat: no-repeat;
            background-size: 1500px 900px;;
        }
        .navbar {
            background-color: transparent;
        }
        .search{
            font-family: 'Libre Baskerville', serif;
        }
    </style>

    <nav class="navbar navbar-expand-md navbar-light">
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
            <li class="nav-item active">
                <a class="nav-link" href="search.php"><?php echo $_search;?></a>
            </li>
            <li class="nav-item dropdown">
                <a class="nav-link dropdown-toggle" href="#" id="navbarDropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                <?php echo $nav_user;?> <!-- ?php echo $_SESSION['name'];? -->
                </a>
                <div class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink">
                    <a class="dropdown-item" href="profile.php"><?php echo $_profile?></a>
                    <div class="dropdown-divider"></div>
                    <a class="dropdown-item" href="index.php?logout='1'"><?php echo $nav_logout;?></a>
                </div>
            </li>
            </ul>
        </div>
        <div class="text-right">
            <a href="change.php?lang=EN&filename=search.php" ><i class="text-center" ><span class="flag-icon flag-icon-us"></span></i></a> <a href="change.php?lang=TH&filename=search.php" ><i class="text-center" ><span class="flag-icon flag-icon-th"></span></i></a>
        </div>
    </nav>

    <div class="container">
        <br><br>
        <div class="search text-center">
            <h2><?php echo $_search;?></h2>
        </div>
        <br>
        <!--
        <div class="input-group mb-3">
            <input type="text" class="form-control" placeholder="Type your keyword here..." aria-label="Recipient's username" aria-describedby="basic-addon2">
            <div class="input-group-append">
                <button class="btn btn-outline-secondary" type="button">Search</button>
            </div>
        </div>-->

        <form action="" method="GET">
            <div class="input-group mb-3">
                <input type="text" name="search" required value="<?php if(isset($_GET['search'])){echo $_GET['search']; } ?>" class="form-control" placeholder="Search data">
                <button type="submit" class="btn btn-primary"><?php echo $_search;?></button>
            </div>
        </form>

        <table class="table table-striped table-bordered table-hover">
            <thead>
                <tr>
                    <!-- <th>Diary #ID</th> -->
                    <th><?php echo $_title;?></th>
                    <th><?php echo $_date;?></th>
                    <th><?php echo $_view;?></th>
                    <th><?php echo $_delete;?></th>
                </tr>
            </thead>

            <tbody>
            <?php 

                $connect = mysqli_connect($db_host, $db_user, $db_password);
                $connection = mysqli_select_db($connect, $db_name);

                if(isset($_GET['search']))
                {
                    $filtervalues = $_GET['search'];
                    $query = "SELECT * FROM diary_table WHERE CONCAT(title,diary_text) LIKE '%$filtervalues%' ";
                    $query_run = mysqli_query($connect, $query);

                    if(mysqli_num_rows($query_run) > 0)
                    {
                        foreach($query_run as $items)
                        {
                            ?>
                            <tr>
                                <!-- <td><?= $items['id']; ?></td> -->
                                <td><?= $items['title']; ?></td>
                                <td><?= $items['diary_date']; ?></td>
                                <td><a href="view_diary.php?view_id=<?php echo $items["id"]; ?>" class="btn btn-primary"><?php echo $_view;?></a></td>
                                <td><a href="?delete_id=<?php echo $items["id"]; ?>" class="btn btn-danger"><?php echo $_delete;?></a></td>
                            </tr>
                            <?php
                        }
                    }
                    else
                    {
                        ?>
                            <tr>
                                <td colspan="4"><?php echo $search_fail;?></td>
                            </tr>
                        <?php
                    }
                }
            ?>

            </tbody>
        </table>

    </div>

    <script src="https://code.jquery.com/jquery-3.4.1.slim.min.js" integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>
</body>

</html>
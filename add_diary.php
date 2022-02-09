<?php 
    session_start();    
    require_once('connection.php');

    if($_SESSION["lang"] == "EN"){
        include("en.php");
    } else{
        include("th.php");
    }

    // Insert Diary
    if (isset($_REQUEST['btn_insert'])) {
        $title = $_REQUEST['txt_title'];
        $diary_text = $_REQUEST['txt_diary_text'];
        $uid = $_SESSION['uid'];


        if (empty($title)) {
            $errorMsg = $diary_error;
        } else {
            try {
                if (!isset($errorMsg)) {
                    $insert_stmt = $db->prepare("INSERT INTO diary_table(uid, title, diary_text) VALUES (:uid, :title, :diary_text)");
                    $insert_stmt->bindParam(':uid', $uid);
                    $insert_stmt->bindParam(':title', $title);
                    $insert_stmt->bindParam(':diary_text', $diary_text);

                    if ($insert_stmt->execute()) {
                        $insertMsg = $diary_success;
                        header("refresh:1;index.php");
                    }
                }
            } catch (PDOException $e) {
                echo $e->getMessage();
            }
        }
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
    <title>Main</title>

    
</head>

<body>
    <style>
        body {
            background-image: url('./img/bg2.png');
            background-repeat: no-repeat;
            background-size: 1500px 900px;
        }
        .my-diary{
            font-family: 'Libre Baskerville', serif;
        }
    </style>

    <div class="container">
        <br><br>
        <div class="my-diary text-center">
            <h2><?php echo $diary_add;?></h2>
        </div>

        <?php 
            if (isset($errorMsg)) {
        ?>
            <div class="alert alert-danger">
                <strong><?php echo $_wrong;?> <?php echo $errorMsg; ?></strong>
            </div>
        <?php } ?>

        <?php 
            if (isset($insertMsg)) {
        ?>
            <div class="alert alert-success">
                <strong><?php echo $_success;?> <?php echo $insertMsg; ?></strong>
            </div>
        <?php } ?>

        <form method="post" class="form-horizontal mt-5">
                
                <div class="form-group text-center">
                    <div class="row">
                        <label for="title" class="col-sm-3 control-label"><?php echo $_title;?></label>
                        <div class="col-sm-9">
                            <input type="text" name="txt_title" class="form-control" placeholder=<?php echo $diary_title;?>>
                        </div>
                    </div>
                </div>
                <div class="form-group text-center">
                    <div class="row">
                        <label for="diary_text" class="col-sm-3 control-label"><?php echo $_text;?></label>
                        <div class="col-sm-9">
                            <textarea name="txt_diary_text" cols="30" rows="15" class="form-control" placeholder=<?php echo $diary_text1;?>></textarea>
                            <!--<input type="text" name="txt_diary_text" class="form-control" value="<?php echo $diary_text; ?>">-->
                        </div>
                    </div>
                </div>

                <div class="fixed-bottom">
                    <div class="form-group text-center">
                        <div class="col-md-12 mt-3">
                            <input type="submit" name="btn_insert" class="btn btn-success" value=<?php echo $_insert?>>
                            <a href="index.php" class="btn btn-danger"><?php echo $diary_cancel;?></a>
                        </div>
                    </div>
                </div>
        </form>

    </div>

    <script src="//cdn.ckeditor.com/4.17.1/standard/ckeditor.js"></script>
    <script>
        CKEDITOR.replace('txt_diary_text', {
        height: 350
    } );
    </script>
    <script src="https://code.jquery.com/jquery-3.4.1.slim.min.js" integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>
</body>

</html>
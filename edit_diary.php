<?php 
    session_start();
    require_once('connection.php');

    if($_SESSION["lang"] == "EN"){
        include("en.php");
    } else{
        include("th.php");
    }

    if (isset($_REQUEST['update_id'])) {
        try {
            $id = $_REQUEST['update_id'];
            $select_stmt = $db->prepare("SELECT * FROM diary_table WHERE id = :id");
            $select_stmt->bindParam(':id', $id);
            $select_stmt->execute();
            $row = $select_stmt->fetch(PDO::FETCH_ASSOC);
            extract($row);
        } catch(PDOException $e) {
            $e->getMessage();
        }
    }

    if (isset($_REQUEST['btn_update'])) {
        $title_up = $_REQUEST['txt_title'];
        $diary_text_up = $_REQUEST['txt_diary_text'];

        if (empty($title_up)) {
            $errorMsg = $diary_error;
        } else {
            try {
                if (!isset($errorMsg)) {
                    $update_stmt = $db->prepare("UPDATE diary_table SET title = :tt_up, diary_text = :dt_up WHERE id = :id");
                    $update_stmt->bindParam(':tt_up', $title_up);
                    $update_stmt->bindParam(':dt_up', $diary_text_up);
                    $update_stmt->bindParam(':id', $id);

                    if ($update_stmt->execute()) {
                        $updateMsg = "Record update successfully...";
                        header("refresh:1;index.php");
                    }
                }
            } catch(PDOException $e) {
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
    <title>Edit diary</title>
</head>

<body>
    <style>
        body {
            background-image: url('./img/bg2.png');
            background-repeat: no-repeat;
            background-size: 1500px 900px;
        }
    </style>

    <style>
        .my-diary{
            font-family: 'Libre Baskerville', serif;
        }
    </style>

    <div class="container">
    <br><br>
    <div class="my-diary text-center">
        <h2><?php echo $diary_edit;?></h2>
    </div>

    <?php 
         if (isset($errorMsg)) {
    ?>
        <div class="alert alert-danger">
            <strong><?php echo $_wrong;?> <?php echo $errorMsg; ?></strong>
        </div>
    <?php } ?>

    <?php 
         if (isset($updateMsg)) {
    ?>
        <div class="alert alert-success">
            <strong><?php echo $_success;?> <?php echo $updateMsg; ?></strong>
        </div>
    <?php } ?>

    <form method="post" class="form-horizontal mt-5">
            
            <div class="form-group text-center">
                <div class="row">
                    <label for="title" class="col-sm-3 control-label"><?php echo $_title;?></label>
                    <div class="col-sm-9">
                        <input type="text" name="txt_title" class="form-control" value="<?php echo $title; ?>">
                    </div>
                </div>
            </div>
            <div class="form-group text-center">
                <div class="row">
                    <label for="diary_text" class="col-sm-3 control-label"><?php echo $_text;?></label>
                    <div class="col-sm-9">
                        <textarea name="txt_diary_text" cols="30" rows="20" class="form-control"><?php echo $diary_text; ?></textarea>
                        <!--<input type="text" name="txt_diary_text" class="form-control" value="<?php echo $diary_text; ?>">-->
                    </div>
                </div>
            </div>
            <div class="form-group text-center">
                <div class="col-md-12 mt-3">
                    <input type="submit" name="btn_update" class="btn btn-success" value="<?php echo $diary_update; ?>">
                    <a href="index.php" class="btn btn-dark"><?php echo $_back;?></a>
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